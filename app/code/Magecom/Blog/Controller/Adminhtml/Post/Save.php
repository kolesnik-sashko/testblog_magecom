<?php

namespace Magecom\Blog\Controller\Adminhtml\Post;

use Magecom\Blog\Controller\Adminhtml\PostAbstract;
use Magecom\Blog\Api\Schema\PostSchemaInterface;

class Save extends PostAbstract
{
    /** {@inheritdoc} */
    public function execute()
    {
        $isPost = $this->getRequest()->getPost();

        if ($isPost) {
            $model = $this->getModel();
            $formData = $this->getRequest()->getParams();

            if(!empty($formData[PostSchemaInterface::ID_COLUMN])) {
                $id = $formData[PostSchemaInterface::ID_COLUMN];
                $model = $this->repository->get($id);
            }

            $model->setData($formData);

            try {
                $this->repository->save($model);
                $this->messageManager->addSuccessMessage(__('Post has been saved.'));
                if ($this->getRequest()->getParam('back')) {
                    return $this->_redirect('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }

                return $this->redirectToGrid();
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
                $this->messageManager->addErrorMessage(__('Post doesn\'t save' ));
            }

            $this->_getSession()->setFormData($formData);

            return (!empty($model->getId())) ?
                $this->_redirect('*/*/edit', ['id' => $model->getId()])
                : $this->_redirect('*/*/create');
        }

        return $this->doRefererRedirect();
    }
}