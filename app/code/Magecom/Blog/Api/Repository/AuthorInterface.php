<?php

namespace Magecom\Blog\Api\Repository;

use Magento\Framework\Api\SearchCriteriaInterface;

use Magecom\Blog\Api\Data\AuthorInterface as AuthorDataInterface;
use Magecom\Blog\Model\ResourceModel\Author\Collection as AuthorCollection;

interface AuthorInterface
{
    /**
     * @param integer $id
     * @return AuthorDataInterface
     */
    public function get($id);

    /**
     * @param SearchCriteriaInterface $criteria
     * @return AuthorCollection
     */
    public function getList(SearchCriteriaInterface $criteria);

    /**
     * @param AuthorDataInterface $author
     * @return AuthorInterface
     */
    public function delete(AuthorDataInterface $author);

    /**
     * @param integer $id
     * @return AuthorInterface
     */
    public function deleteById($id);

    /**
     * @param AuthorDataInterface $author
     * @return AuthorInterface
     */
    public function save(AuthorDataInterface $author);
}