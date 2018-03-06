<?php

namespace Magecom\Blog\Controller\Adminhtml\Comment;

use Magecom\Blog\Controller\Adminhtml\CommentAbstract;

class Index extends CommentAbstract
{
    const ACL_RESOURCE      = 'Magecom_Blog::comment_grid';
    const PAGE_TITLE        = 'Comments Grid';
    const BREADCRUMB_TITLE  = 'Comments Grid';
}