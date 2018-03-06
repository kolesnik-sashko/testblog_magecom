<?php

namespace Magecom\Blog\Ui;

use Magento\Ui\DataProvider\AbstractDataProvider;

use Magecom\Blog\Model\ResourceModel\Post\CollectionFactory;

class PostDataProvider extends AbstractDataProvider
{
    protected $_loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $postCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $postCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $post) {
            $this->_loadedData[$post->getId()] = $post->getData();
        }
        return $this->_loadedData;
    }
}