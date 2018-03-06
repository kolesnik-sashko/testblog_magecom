<?php

namespace Magecom\Blog\Ui;

use Magento\Ui\DataProvider\AbstractDataProvider;

use Magecom\Blog\Model\ResourceModel\PostComment\CollectionFactory;

class CommentDataProvider extends AbstractDataProvider
{
    protected $_loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $commentCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $commentCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $comment) {
            $this->_loadedData[$comment->getId()] = $comment->getData();
        }
        return $this->_loadedData;
    }
}