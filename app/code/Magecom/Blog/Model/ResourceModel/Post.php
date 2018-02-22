<?php

namespace Magecom\Blog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

use Magecom\Blog\Api\Schema\PostSchemaInterface;

class Post extends AbstractDb
{
    /** {@inheritdoc} */
    protected function _construct()
    {
        $this->_init(PostSchemaInterface::TABLE_NAME, PostSchemaInterface::ID_COLUMN);
    }
}