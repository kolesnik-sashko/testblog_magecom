<?php

namespace Magecom\Blog\Block\Adminhtml\Post\Edit\Button;

use Magento\Backend\Block\Widget\Context;
use Magecom\Blog\Api\Repository\PostInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class Generic
{
    protected $context;
    
    protected $postRepository;
    
    public function __construct(
        Context $context,
        PostInterface $postRepository
    ) {
        $this->context = $context;
        $this->postRepository = $postRepository;
    }

    public function getPostId()
    {
        try {
            return $this->postRepository->get(
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