<?php

namespace Magecom\Blog\Controller\Adminhtml\Author;

use Magecom\Blog\Controller\Adminhtml\AuthorAbstract;
use Magecom\Blog\Api\Schema\AuthorSchemaInterface;

class Save extends AuthorAbstract
{
    /** {@inheritdoc} */
    public function execute()
    {
        $isPost = $this->getRequest()->getPost();

        if ($isPost) {
            $model = $this->getModel();
            $formData = $this->getRequest()->getParams();

            if(!empty($formData[AuthorSchemaInterface::ID_COLUMN])) {
                $id = $formData[AuthorSchemaInterface::ID_COLUMN];
                $model = $this->repository->get($id);
            }

            $model->setData($formData);

            try {
                $this->repository->save($model);
                $this->messageManager->addSuccessMessage(__('Author has been saved.'));
                if ($this->getRequest()->getParam('back')) {
                    return $this->_redirect('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }

                return $this->redirectToGrid();
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
                $this->messageManager->addErrorMessage(__('Author doesn\'t save' ));
            }

            $this->_getSession()->setFormData($formData);

            return (!empty($model->getId())) ?
                $this->_redirect('*/*/edit', ['id' => $model->getId()])
                : $this->_redirect('*/*/create');
        }

        return $this->doRefererRedirect();
    }
}