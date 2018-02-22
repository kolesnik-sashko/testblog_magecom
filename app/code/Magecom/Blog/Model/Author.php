<?php

namespace Magecom\Blog\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;

use Magecom\Blog\Api\Data\AuthorInterface;
use Magecom\Blog\Api\Schema\AuthorSchemaInterface;
use Magecom\Blog\Model\ResourceModel\Author as ResourceModel;

class Author 
    extends AbstractModel
    implements IdentityInterface, AuthorInterface
{
    public function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /** {@inheritdoc} */
    public function getFirstName()
    {
        return $this->_getData(AuthorSchemaInterface::FIRST_NAME_COLUMN);
    }

    /** {@inheritdoc} */
    public function setFirstName($firstName)
    {
        $this->setData(AuthorSchemaInterface::FIRST_NAME_COLUMN, $firstName);
        
        return $this;
    }

    /** {@inheritdoc} */
    public function getLastName()
    {
        return $this->_getData(AuthorSchemaInterface::LAST_NAME_COLUMN);
    }

    /** {@inheritdoc} */
    public function setLastName($lastName)
    {
        $this->setData(AuthorSchemaInterface::LAST_NAME_COLUMN, $lastName);

        return $this;
    }

    /** {@inheritdoc} */
    public function getIdentities()
    {
        return [sprintf("%s_%s", AuthorInterface::CACHE_TAG, $this->getId())];
    }
}