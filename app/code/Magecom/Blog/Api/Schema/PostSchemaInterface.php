<?php

namespace Magecom\Blog\Api\Schema;


interface PostSchemaInterface
{
    const TABLE_NAME         = 'magecom_blog_post';
    
    const ID_COLUMN          = 'entity_id';
    const AUTHOR_ID_COLUMN   = 'author_id';
    const NAME_COLUMN        = 'name';
    const DESCRIPTION_COLUMN = 'description';
    const URL_KEY_COLUMN     = 'url_key';
    const IMAGE_COLUMN       = 'image';
    const STATUS_COLUMN      = 'status';
    const CREATED_AT_COLUMN  = 'created_at';
    const UPDATED_AT_COLUMN  = 'updated_at';
}