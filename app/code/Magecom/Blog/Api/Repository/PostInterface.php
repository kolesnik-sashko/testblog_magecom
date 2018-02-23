<?php

namespace Magecom\Blog\Api\Repository;

use Magento\Framework\Api\SearchCriteriaInterface;

use Magecom\Blog\Api\Data\PostInterface as PostDataInterface;
use Magecom\Blog\Model\ResourceModel\Post\Collection as PostCollection;

interface PostInterface
{
    /**
     * @param integer $id
     * @return PostDataInterface
     */
    public function get($id);

    /**
     * @param SearchCriteriaInterface $criteria
     * @return PostCollection
     */
    public function getList(SearchCriteriaInterface $criteria);

    /**
     * @param PostDataInterface $post
     * @return PostInterface
     */
    public function delete(PostDataInterface $post);

    /**
     * @param integer $id
     * @return PostInterface
     */
    public function deleteById($id);

    /**
     * @param PostDataInterface $post
     * @return PostInterface
     */
    public function save(PostDataInterface $post);
}