<?php

namespace Magecom\Blog\Api\Schema;

interface BlogPostToStoreSchemaInterface
{
    const TABLE_NAME      = 'magecom_blog_post_to_store';
    
    const POST_ID_COLUMN  = 'post_id';
    const STORE_ID_COLUMN = 'store_id';
}