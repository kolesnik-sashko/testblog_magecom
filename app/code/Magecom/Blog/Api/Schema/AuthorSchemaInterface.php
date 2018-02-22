<?php

namespace Magecom\Blog\Api\Schema;

interface BlogAuthorSchemaInterface
{
    const TABLE_NAME        = 'magecom_blog_author';
    
    const ID_COLUMN         = 'entity_id';
    const FIRST_NAME_COLUMN = 'first_name';
    const LAST_NAME_COLUMN  = 'last_name';
}