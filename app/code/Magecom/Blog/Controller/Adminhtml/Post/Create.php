<?php

namespace Magecom\Blog\Controller\Adminhtml\Post;

use Magecom\Blog\Controller\Adminhtml\PostAbstract;
use Magecom\Blog\Api\Data\PostInterface;

class Create extends PostAbstract
{
    const ACL_RESOURCE      = 'Magecom_Blog::post_create';
    const PAGE_TITLE        = 'Add Post';
    const BREADCRUMB_TITLE  = 'Add Post';

    public function execute()
    {
        $model = $this->getModel();

        $data = $this->_session->getFormData(true);

        if (!empty($data)) {
            $model->setData($data);
        }
        $this->registry->register(PostInterface::REGISTRY_KEY, $model);

        return parent::execute();
    }
}