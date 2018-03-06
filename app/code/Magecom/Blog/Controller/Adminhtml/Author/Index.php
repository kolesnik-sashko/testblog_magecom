<?php

namespace Magecom\Blog\Controller\Adminhtml\Author;

use Magecom\Blog\Controller\Adminhtml\AuthorAbstract;

class Index extends AuthorAbstract
{
    const ACL_RESOURCE      = 'Magecom_Blog::author_grid';    
    const PAGE_TITLE        = 'Authors Grid';
    const BREADCRUMB_TITLE  = 'Authors Grid';
}