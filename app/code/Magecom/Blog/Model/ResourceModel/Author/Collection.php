<?php

namespace Magecom\Blog\Model\ResourceModel\Author;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

use Magecom\Blog\Model\Author as Model;
use Magecom\Blog\Model\ResourceModel\Author as ResourceModel;

class Collection extends AbstractCollection
{
    /** {@inheritdoc} */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}