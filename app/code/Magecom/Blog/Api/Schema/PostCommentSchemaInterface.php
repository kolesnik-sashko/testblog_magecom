<?php

namespace Magecom\Blog\Api\Schema;

interface BlogPostCommentSchemaInterface
{
    const TABLE_NAME          = 'magecom_blog_post_comment';
    
    const ID_COLUMN           = 'entity_id';
    const POST_ID_COLUMN      = 'post_id';
    const AUTHOR_ID_COLUMN    = 'author_id';
    const COMMENT_TEXT_COLUMN = 'comment_text';
    const CREATED_AT_COLUMN   = 'created_at';
}