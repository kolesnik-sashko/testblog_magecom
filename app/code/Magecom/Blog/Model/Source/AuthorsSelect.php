<?php

namespace Magecom\Blog\Model\Source;

use Magento\Framework\Option\ArrayInterface;

use Magecom\Blog\Model\ResourceModel\Author\CollectionFactory;

class AuthorsSelect implements ArrayInterface
{
    protected $authorCollection;

    public function __construct(
        CollectionFactory $factory
    )
    {
        $this->authorCollection = $factory->create();
    }

    public function toOptionArray()
    {
        $result = [];

        foreach ($this->authorCollection->getData() as $item)
        {
            $result[] = ['value' => $item['entity_id'], 'label' => $item['first_name'] . ' ' . $item['last_name']];
        }
        return $result;
    }
}