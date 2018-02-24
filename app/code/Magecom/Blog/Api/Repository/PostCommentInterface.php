<?php


namespace Magecom\Blog\Api\Repository;

use Magento\Framework\Api\SearchCriteriaInterface;

use Magecom\Blog\Api\Data\PostCommentInterface as PostCommentDataInterface;
use Magecom\Blog\Model\ResourceModel\PostComment\Collection as PostCommentCollection;


interface PostCommentInterface
{
    /**
     * @param integer $id
     * @return PostCommentDataInterface
     */
    public function get($id);

    /**
     * @param SearchCriteriaInterface $criteria
     * @return PostCommentCollection
     */
    public function getList(SearchCriteriaInterface $criteria);

    /**
     * @param PostCommentDataInterface $postComment
     * @return PostCommentInterface
     */
    public function delete(PostCommentDataInterface $postComment);

    /**
     * @param integer $id
     * @return PostCommentInterface
     */
    public function deleteById($id);

    /**
     * @param PostCommentDataInterface $postComment
     * @return PostCommentInterface
     */
    public function save(PostCommentDataInterface $postComment);
}