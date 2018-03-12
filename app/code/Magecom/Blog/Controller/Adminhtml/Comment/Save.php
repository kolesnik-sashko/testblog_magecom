<?php

namespace Magecom\Blog\Controller\Adminhtml\Comment;

use Magecom\Blog\Controller\Adminhtml\CommentAbstract;
use Magecom\Blog\Api\Schema\PostCommentSchemaInterface;

class Save extends CommentAbstract
{
    /** {@inheritdoc} */
    public function execute()
    {
        $isPost = $this->getRequest()->getPost();

        if ($isPost) {
            $model = $this->getModel();
            $formData = $this->getRequest()->getParams();

            if(!empty($formData[PostCommentSchemaInterface::ID_COLUMN])) {
                $id = $formData[PostCommentSchemaInterface::ID_COLUMN];
                $model = $this->repository->get($id);
            }

            $model->setData($formData);

            try {
                $this->repository->save($model);
                $this->messageManager->addSuccessMessage(__('Comment has been saved.'));
                if ($this->getRequest()->getParam('back')) {
                    return $this->_redirect('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }

                return $this->redirectToGrid();
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
                $this->messageManager->addErrorMessage(__('Comment doesn\'t save' ));
            }

            $this->_getSession()->setFormData($formData);

            return (!empty($model->getId())) ?
                $this->_redirect('*/*/edit', ['id' => $model->getId()])
                : $this->_redirect('*/*/create');
        }

        return $this->doRefererRedirect();
    }
}