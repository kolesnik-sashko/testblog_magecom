<?php

namespace Magecom\Blog\Api\Data;


interface PostCommentInterface
{
    const CACHE_TAG = 'post_comment';

    const REGISTRY_KEY  = 'magecom_blog_post_comment';
    
    /**
     * @return integer
     */
    public function getId();

    /**
     * @return integer
     */
    public function getPostId();

    /**
     * @param integer $postId
     * @return PostCommentInterface
     */
    public function setPostId($postId);

    /**
     * @return integer
     */
    public function getAuthorId();

    /**
     * @param integer $authorId
     * @return PostCommentInterface
     */
    public function setAuthorId($authorId);

    /**
     * @return string
     */
    public function getCommentText();

    /**
     * @param string $commentText
     * @return PostCommentInterface
     */
    public function setCommentText($commentText);

    /**
     * @return mixed
     */
    public function getCreatedAt();

    /**
     * @param $createdAt
     * @return mixed
     */
    public function setCreatedAt($createdAt);
}