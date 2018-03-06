<?php

namespace Magecom\Blog\Ui;

use Magento\Ui\DataProvider\AbstractDataProvider;

use Magecom\Blog\Model\ResourceModel\Author\CollectionFactory;

class AuthorDataProvider extends AbstractDataProvider
{
    protected $_loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $authorCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $authorCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $author) {
            $this->_loadedData[$author->getId()] = $author->getData();
        }
        return $this->_loadedData;
    }
}