<?php

namespace Magecom\Blog\Controller\Adminhtml\Post;

use Magecom\Blog\Controller\Adminhtml\PostAbstract;

class Index extends PostAbstract
{
    const ACL_RESOURCE      = 'Magecom_Blog::post_grid';
    const PAGE_TITLE        = 'Posts Grid';
    const BREADCRUMB_TITLE  = 'Posts Grid';
}