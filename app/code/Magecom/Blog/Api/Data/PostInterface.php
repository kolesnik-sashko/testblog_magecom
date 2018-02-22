<?php

namespace Magecom\Blog\Api\Data;


interface PostInterface
{
    const CACHE_TAG = 'blog_post';
    
    /**
     * @return integer
     */
    public function getId();

    /**
     * @return integer
     */
    public function getAuthorId();

    /**
     * @param integer $authorId
     * @return PostInterface
     */
    public function setAuthorId($authorId);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return PostInterface
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @param string $description
     * @return PostInterface
     */
    public function setDescription($description);

    /**
     * @return string
     */
    public function getUrlKey();

    /**
     * @param string $urlKey
     * @return PostInterface
     */
    public function setUrlKey($urlKey);

    /**
     * @return string
     */
    public function getImage();

    /**
     * @param string $image
     * @return PostInterface
     */
    public function setImage($image);

    /**
     * @return integer
     */
    public function getStatus();

    /**
     * @param integer $status
     * @return PostInterface
     */
    public function setStatus($status);

    /**
     * @return mixed
     */
    public function getCreatedAt();

    /**
     * @param $createdAt
     * @return PostInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * @return mixed
     */
    public function getUpdatedAt();

    /**
     * @param $updatedAt
     * @return mixed
     */
    public function setUpdatedAt($updatedAt);
}