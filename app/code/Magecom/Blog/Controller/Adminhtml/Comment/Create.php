<?php

namespace Magecom\Blog\Controller\Adminhtml\Comment;

use Magecom\Blog\Controller\Adminhtml\CommentAbstract;
use Magecom\Blog\Api\Data\PostCommentInterface;

class Create extends CommentAbstract
{
    const ACL_RESOURCE      = 'Magecom_Blog::comment_create';
    const PAGE_TITLE        = 'Add Comment';
    const BREADCRUMB_TITLE  = 'Add Comment';

    public function execute()
    {
        $model = $this->getModel();

        $data = $this->_session->getFormData(true);

        if (!empty($data)) {
            $model->setData($data);
        }
        $this->registry->register(PostCommentInterface::REGISTRY_KEY, $model);

        return parent::execute();
    }
}