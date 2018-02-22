<?php

namespace Magecom\Blog\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Stdlib\DateTime;

use Magecom\Blog\Api\Data\PostInterface;
use Magecom\Blog\Api\Schema\PostSchemaInterface;
use Magecom\Blog\Model\ResourceModel\Post as ResourceModel;

class Post 
    extends AbstractModel
    implements IdentityInterface, PostInterface
{
    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;
    
    public function _construct()
    {
        $this->_init(ResourceModel::class);
    }
    
    /** {@inheritdoc} */
    public function getAuthorId()
    {
        return $this->_getData(PostSchemaInterface::AUTHOR_ID_COLUMN);
    }

    /** {@inheritdoc} */
    public function setAuthorId($authorId)
    {
        $this->setData(PostSchemaInterface::AUTHOR_ID_COLUMN, $authorId);

        return $this;
    }

    /** {@inheritdoc} */
    public function getName()
    {
        return $this->_getData(PostSchemaInterface::NAME_COLUMN);
    }

    /** {@inheritdoc} */
    public function setName($name)
    {
        $this->setData(PostSchemaInterface::NAME_COLUMN, $name);

        return $this;
    }

    /** {@inheritdoc} */
    public function getDescription()
    {
        return $this->_getData(PostSchemaInterface::DESCRIPTION_COLUMN);
    }

    /** {@inheritdoc} */
    public function setDescription($description)
    {
        $this->setData(PostSchemaInterface::DESCRIPTION_COLUMN, $description);

        return $this;
    }

    /** {@inheritdoc} */
    public function getUrlKey()
    {
        return $this->_getData(PostSchemaInterface::URL_KEY_COLUMN);
    }

    /** {@inheritdoc} */
    public function setUrlKey($urlKey)
    {
        $this->setData(PostSchemaInterface::URL_KEY_COLUMN, $urlKey);

        return $this;
    }

    /** {@inheritdoc} */
    public function getImage()
    {
        return $this->_getData(PostSchemaInterface::IMAGE_COLUMN);
    }

    /** {@inheritdoc} */
    public function setImage($image)
    {
        $this->setData(PostSchemaInterface::IMAGE_COLUMN, $image);

        return $this;
    }

    /** {@inheritdoc} */
    public function getStatus()
    {
        return $this->_getData(PostSchemaInterface::STATUS_COLUMN);
    }

    /** {@inheritdoc} */
    public function setStatus($status)
    {
        $this->setData(PostSchemaInterface::STATUS_COLUMN, $status);

        return $this;
    }

    /** {@inheritdoc} */
    public function getCreatedAt()
    {
        return $this->_getData(PostSchemaInterface::CREATED_AT_COLUMN);
    }

    /** {@inheritdoc} */
    public function setCreatedAt($createdAt)
    {
        $this->setData(PostSchemaInterface::CREATED_AT_COLUMN, $createdAt);

        return $this;
    }

    /** {@inheritdoc} */
    public function getUpdatedAt()
    {
        return $this->_getData(PostSchemaInterface::UPDATED_AT_COLUMN);
    }

    /** {@inheritdoc} */
    public function setUpdatedAt($updatedAt)
    {
        $this->setData(PostSchemaInterface::UPDATED_AT_COLUMN, $updatedAt);

        return $this;
    }

    /** {@inheritdoc} */
    public function getIdentities()
    {
        return [sprintf("%s_%s", PostInterface::CACHE_TAG, $this->getId())];
    }
}