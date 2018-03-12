<?php

namespace Magecom\Blog\Model\Source;

use Magento\Framework\Option\ArrayInterface;

use Magecom\Blog\Model\ResourceModel\Post\CollectionFactory;

class PostsSelect implements ArrayInterface
{
    protected $postCollection;

    public function __construct(
        CollectionFactory $factory
    )
    {
        $this->postCollection = $factory->create();
    }

    public function toOptionArray()
    {
        $result = [];

        foreach ($this->postCollection->getData() as $item)
        {
            $result[] = ['value' => $item['entity_id'], 'label' => $item['name']];
        }
        return $result;
    }
}