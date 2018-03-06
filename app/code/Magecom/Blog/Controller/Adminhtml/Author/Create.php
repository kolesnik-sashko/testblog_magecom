<?php

namespace Magecom\Blog\Controller\Adminhtml\Author;

use Magecom\Blog\Controller\Adminhtml\AuthorAbstract;
use Magecom\Blog\Api\Data\AuthorInterface;

class Create extends AuthorAbstract
{
    const ACL_RESOURCE      = 'Magecom_Blog::author_create';
    const MENU_ITEM         = 'Magecom_Blog::author_create';
    const PAGE_TITLE        = 'Add Author';
    const BREADCRUMB_TITLE  = 'Add Author';

    public function execute()
    {
        $model = $this->getModel();

        $data = $this->_session->getFormData(true);

        if (!empty($data)) {
            $model->setData($data);
        }
        $this->registry->register(AuthorInterface::REGISTRY_KEY, $model);

        return parent::execute();
    }
}