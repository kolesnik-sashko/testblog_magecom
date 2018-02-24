<?php

namespace Magecom\Blog\Model\Repository;

use Magecom\Blog\Api\Data\PostCommentInterface as PostCommentDataInterface;
use Magecom\Blog\Api\Repository\PostCommentInterface;
use Magecom\Blog\Model\ResourceModel\PostComment\Collection as PostCommentCollection;
use Magecom\Blog\Model\ResourceModel\PostComment\CollectionFactory;
use Magecom\Blog\Model\PostCommentFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magecom\Blog\Model\ResourceModel\Post as ResourceModel;
use Magecom\Blog\Model\PostComment as PostCommentModel;

class PostComment implements PostCommentInterface
{

    /**
     * @var PostCommentFactory
     */
    protected $objectFactory;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var ResourceModel
     */
    protected $resourceModel;

    /**
     * PostComment constructor.
     * @param PostCommentFactory $objectFactory
     * @param CollectionFactory $collectionFactory
     * @param ResourceModel $resourceModel
     */
    public function __construct(
        PostCommentFactory $objectFactory,
        CollectionFactory $collectionFactory,
        ResourceModel $resourceModel
    ){
        $this->objectFactory     = $objectFactory;
        $this->collectionFactory = $collectionFactory;
        $this->resourceModel     = $resourceModel;
    }

    /**
     * @param integer $id
     * @return PostCommentDataInterface
     */
    public function get($id)
    {
        $postComment = $this->getPostCommentObject();

        return $this->resourceModel->load($postComment, $id);
    }

    /**
     * @param SearchCriteriaInterface $criteria
     * @return PostCommentCollection
     */
    public function getList(SearchCriteriaInterface $criteria)
    {
        return $this->getCollection();
    }

    /**
     * @param PostCommentDataInterface $postComment
     * @return PostCommentInterface
     */
    public function delete(PostCommentDataInterface $postComment)
    {
        $this->resourceModel->delete($postComment);
        return $this;
    }

    /**
     * @param integer $id
     * @return PostCommentInterface
     */
    public function deleteById($id)
    {
        return $this->delete($this->get($id));
    }

    /**
     * @param PostCommentDataInterface $postComment
     * @return PostCommentInterface
     */
    public function save(PostCommentDataInterface $postComment)
    {
        $this->resourceModel->save($postComment);

        return $this;
    }

    /**
     * @return PostCommentModel
     */
    protected function getPostCommentObject()
    {
        return $this->objectFactory->create();
    }

    /**
     * @return PostCommentCollection
     */
    protected function getCollection()
    {
        return $this->collectionFactory->create();
    }
}