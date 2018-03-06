<?php

namespace Magecom\Blog\Model\Repository;

use Magento\Framework\Api\SearchCriteriaInterface;

use Magecom\Blog\Api\Data\PostInterface as PostDataInterface;
use Magecom\Blog\Api\Repository\PostInterface;
use Magecom\Blog\Model\ResourceModel\Post\Collection as PostCollection;
use Magecom\Blog\Model\ResourceModel\Post\CollectionFactory;
use Magecom\Blog\Model\PostFactory;
use Magecom\Blog\Model\ResourceModel\Post as ResourceModel;
use Magecom\Blog\Model\Post as PostModel;

class Post implements PostInterface
{

    /**
     * @var PostFactory
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
     * Post constructor.
     * @param PostFactory $objectFactory
     * @param CollectionFactory $collectionFactory
     * @param ResourceModel $resourceModel
     */
    public function __construct(
        PostFactory       $objectFactory,
        CollectionFactory $collectionFactory,
        ResourceModel     $resourceModel
    ){
        $this->objectFactory     = $objectFactory;
        $this->collectionFactory = $collectionFactory;
        $this->resourceModel     = $resourceModel;
    }

    /**
     * @param integer $id
     * @return PostDataInterface
     */
    public function get($id)
    {
        $post = $this->getPostObject();
        
        $this->resourceModel->load($post, $id);
        
        return $post;
    }

    /**
     * @param SearchCriteriaInterface $criteria
     * @return PostCollection
     */
    public function getList(SearchCriteriaInterface $criteria)
    {
        return $this->getCollection();
    }

    /**
     * @param PostDataInterface $post
     * @return PostInterface
     */
    public function delete(PostDataInterface $post)
    {
        $this->resourceModel->delete($post);
        
        return $this;
    }

    /**
     * @param integer $id
     * @return PostInterface
     */
    public function deleteById($id)
    {
        return $this->delete($this->get($id));
    }

    /**
     * @param PostDataInterface $post
     * @return PostInterface
     */
    public function save(PostDataInterface $post)
    {
        $this->resourceModel->save($post);

        return $this;
    }

    /**
     * @return PostModel
     */
    protected function getPostObject()
    {
        return $this->objectFactory->create();
    }

    /**
     * @return PostCollection
     */
    public function getCollection()
    {
        return $this->collectionFactory->create();
    }
}