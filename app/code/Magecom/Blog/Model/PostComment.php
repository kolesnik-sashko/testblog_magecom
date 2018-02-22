<?php

namespace Magecom\Blog\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Stdlib\DateTime;

use Magecom\Blog\Api\Data\PostCommentInterface;
use Magecom\Blog\Api\Schema\PostCommentSchemaInterface;
use Magecom\Blog\Model\ResourceModel\PostComment as ResourceModel;

class PostComment
    extends AbstractModel
    implements IdentityInterface, PostCommentInterface
{

    public function _construct()
    {
        $this->_init(ResourceModel::class);
    }

        /** {@inheritdoc} */
    public function getPostId()
    {
        return $this->_getData(PostCommentSchemaInterface::POST_ID_COLUMN);
    }

    /** {@inheritdoc} */
    public function setPostId($postId)
    {
        $this->setData(PostCommentSchemaInterface::POST_ID_COLUMN, $postId);

        return $this;
    }

    /** {@inheritdoc} */
    public function getAuthorId()
    {
        return $this->_getData(PostCommentSchemaInterface::AUTHOR_ID_COLUMN);
    }

    /** {@inheritdoc} */
    public function setAuthorId($authorId)
    {
        $this->setData(PostCommentSchemaInterface::AUTHOR_ID_COLUMN, $authorId);

        return $this;
    }

    /** {@inheritdoc} */
    public function getCommentText()
    {
        return $this->_getData(PostCommentSchemaInterface::COMMENT_TEXT_COLUMN);
    }

    /** {@inheritdoc} */
    public function setCommentText($commentText)
    {
        $this->setData(PostCommentSchemaInterface::COMMENT_TEXT_COLUMN, $commentText);

        return $this;
    }

    /** {@inheritdoc} */
    public function getCreatedAt()
    {
        return $this->_getData(PostCommentSchemaInterface::CREATED_AT_COLUMN);
    }

    /** {@inheritdoc} */
    public function setCreatedAt($createdAt)
    {
        $this->setData(PostCommentSchemaInterface::CREATED_AT_COLUMN, $createdAt);

        return $this;
    }

    /** {@inheritdoc} */
    public function getIdentities()
    {
        return [sprintf("%s_%s", PostCommentInterface::CACHE_TAG, $this->getId())];
    }

}