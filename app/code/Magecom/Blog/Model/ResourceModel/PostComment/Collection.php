<?php

namespace Magecom\Blog\Model\ResourceModel\PostComment;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

use Magecom\Blog\Model\PostComment as Model;
use Magecom\Blog\Model\ResourceModel\PostComment as ResourceModel;

class Collection extends AbstractCollection
{
    /** {@inheritdoc} */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}