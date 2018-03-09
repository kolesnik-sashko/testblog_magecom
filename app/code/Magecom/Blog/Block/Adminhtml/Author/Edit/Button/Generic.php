<?php

namespace Magecom\Blog\Block\Adminhtml\Author\Edit\Button;

use Magento\Backend\Block\Widget\Context;
use Magecom\Blog\Api\Repository\AuthorInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class Generic
{
    protected $context;
    
    protected $authorRepository;
    
    public function __construct(
        Context $context,
        AuthorInterface $authorRepository
    ) {
        $this->context = $context;
        $this->authorRepository = $authorRepository;
    }

    public function getAuthorId()
    {
        try {
            return $this->authorRepository->get(
                $this->context->getRequest()->getParam('entity_id')
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