<?php

namespace Magecom\Blog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

use Magecom\Blog\Api\Schema\AuthorSchemaInterface;

class Author extends AbstractDb
{
    /** {@inheritdoc} */
    protected function _construct()
    {
        $this->_init(AuthorSchemaInterface::TABLE_NAME, AuthorSchemaInterface::ID_COLUMN);
    }
}
