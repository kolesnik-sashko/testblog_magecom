<?php

namespace Magecom\Blog\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magecom\Blog\Model\ResourceModel\Post\CollectionFactory as PostCollectionFactory;

class Blog extends Template
{
    /** @var PostCollectionFactory  */
    protected $postCollectionFactory;

    public function __construct(
        Context $context,
        PostCollectionFactory $postCollectionFactory,
        array $data
    ){
        $this->postCollectionFactory = $postCollectionFactory;
        parent::__construct($context, $data);
    }

    public function getPosts(){
        return $this->postCollectionFactory->create();
    }
}