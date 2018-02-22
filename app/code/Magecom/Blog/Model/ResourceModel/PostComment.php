<?php

namespace Magecom\Blog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

use Magecom\Blog\Api\Schema\PostCommentSchemaInterface;

class PostComment extends AbstractDb
{
    /** {@inheritdoc} */
    protected function _construct()
    {
        $this->_init(PostCommentSchemaInterface::TABLE_NAME, PostCommentSchemaInterface::ID_COLUMN);
    }
}