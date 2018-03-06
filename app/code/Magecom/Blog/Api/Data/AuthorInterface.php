<?php

namespace Magecom\Blog\Api\Data;

interface AuthorInterface
{
    const CACHE_TAG     = 'blog_author';

    const REGISTRY_KEY  = 'magecom_blog_author';
    
    /**
     * @return integer
     */
    public function getId();

    /**
     * @return string
     */
    public function getFirstName();

    /**
     * @param string $firstName
     * @return AuthorInterface
     */
    public function setFirstName($firstName);

    /**
     * @return string
     */
    public function getLastName();

    /**
     * @param string $lastName
     * @return AuthorInterface
     */
    public function setLastName($lastName);
}