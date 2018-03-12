<?php

namespace Magecom\Blog\Block\Adminhtml\Comment\Edit\Button;

use Magento\Backend\Block\Widget\Context;
use Magecom\Blog\Api\Repository\PostCommentInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class Generic
{
    protected $context;
    
    protected $commentRepository;
    
    public function __construct(
        Context $context,
        PostCommentInterface $commentRepository
    ) {
        $this->context = $context;
        $this->commentRepository = $commentRepository;
    }

    public function getCommentId()
    {
        try {
            return $this->commentRepository->get(
                $this->context->getRequest()->getParam('id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}