<?php

namespace Magecom\Blog\Model\Repository;

use Magento\Framework\Api\SearchCriteriaInterface;

use Magecom\Blog\Api\Data\AuthorInterface as AuthorDataInterface;
use Magecom\Blog\Api\Repository\AuthorInterface;
use Magecom\Blog\Model\ResourceModel\Author as ResourceModel;
use Magecom\Blog\Model\ResourceModel\Author\Collection as AuthorCollection;
use Magecom\Blog\Model\ResourceModel\Author\CollectionFactory;
use Magecom\Blog\Model\AuthorFactory;
use Magecom\Blog\Model\Author as AuthorModel;


class Author implements AuthorInterface
{

    /**
     * @var AuthorFactory
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
     * Author constructor.
     * @param CollectionFactory $collectionFactory
     * @param AuthorFactory $objectFactory
     * @param ResourceModel $resourceModel
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        AuthorFactory $objectFactory,
        ResourceModel $resourceModel
    ){
        $this->collectionFactory = $collectionFactory;
        $this->objectFactory     = $objectFactory;
        $this->resourceModel     = $resourceModel;
    }

    /**
     * @param integer $id
     * @return AuthorDataInterface
     */
    public function get($id)
    {
        $author =  $this->getAuthorObject();

        return $this->resourceModel->load($author, $id);
    }

    /**
     * @param SearchCriteriaInterface $criteria
     * @return AuthorCollection
     */
    public function getList(SearchCriteriaInterface $criteria)
    {
        return $this->getCollection();
    }

    /**
     * @param AuthorDataInterface $author
     * @return AuthorInterface
     */
    public function delete(AuthorDataInterface $author)
    {
        $this->resourceModel->delete($author);

        return $this;
    }

    /**
     * @param integer $id
     * @return AuthorInterface
     */
    public function deleteById($id)
    {
        return $this->delete($this->get($id));
    }

    /**
     * @param AuthorDataInterface $author
     * @return AuthorInterface
     */
    public function save(AuthorDataInterface $author)
    {
        $this->resourceModel->save($author);

        return $this;
    }

    /**
     * @return AuthorModel
     */
    protected function getAuthorObject()
    {
        return $this->objectFactory->create();
    }

    /**
     * @return AuthorCollection
     */
    protected function getCollection()
    {
        return $this->collectionFactory->create();
    }
}