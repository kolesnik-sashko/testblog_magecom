<?php

namespace Magecom\Blog\Ui;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Ui\DataProvider\Modifier\PoolInterface;

use Magecom\Blog\Model\ResourceModel\Post\CollectionFactory;

class PostDataProvider extends AbstractDataProvider
{
    protected $_loadedData;

    protected $pool;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $postCollectionFactory,
        PoolInterface $pool,
        array $meta = [],
        array $data = []
    ) {
        $this->collection   = $postCollectionFactory->create();
        $this->pool         = $pool;
        $this->meta         = $this->prepareMeta($this->meta);
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function prepareMeta(array $meta)
    {
        $meta = parent::getMeta();
        
        foreach ($this->pool->getModifiersInstances() as $modifier) {
            $meta = $modifier->modifyMeta($meta);
        }
        return $meta;
    }

    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        
        foreach ($this->pool->getModifiersInstances() as $modifier) {
            $this->_loadedData = $modifier->modifyData($this->data);
        }
        return $this->_loadedData;
    }
}