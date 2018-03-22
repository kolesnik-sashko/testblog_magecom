<?php

namespace Magecom\Blog\Block\Post;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Checkout\Model\CompositeConfigProvider;
use Magecom\Blog\Model\ResourceModel\Post\Grid\CollectionFactory;

class View extends Template
{
    protected $configProvider;

    protected $layoutProcessors;

    protected $collection;
    
    public function __construct(
        Context $context,
        CompositeConfigProvider $configProvider,
        CollectionFactory $factory,
        array $layoutProcessors = [],
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->configProvider = $configProvider;
        $this->layoutProcessors = $layoutProcessors;
        $this->collection = $factory->create();
    }

    public function getJsLayout()
    {

        foreach ($this->layoutProcessors as $processor) {
            $this->jsLayout = $processor->process($this->jsLayout);
        }

        return parent::getJsLayout();
    }
}