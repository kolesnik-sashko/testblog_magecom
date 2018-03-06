<?php

namespace Magecom\Blog\Controller\Adminhtml\Comment;

use Magento\Framework\Exception\NoSuchEntityException;

use Magecom\Blog\Api\Data\PostCommentInterface;
use Magecom\Blog\Controller\Adminhtml\CommentAbstract;

class Edit extends CommentAbstract
{
    const ACL_RESOURCE      = 'Magecom_Blog::comment_edit';
    const PAGE_TITLE        = 'Edit Comment';
    const BREADCRUMB_TITLE  = 'Edit Comment';

    /** {@inheritdoc} */
    public function execute()
    {
        $id = $this->getRequest()->getParam(static::QUERY_PARAM_ID);

        if (!empty($id)) {
            try {
                $model = $this->repository->get($id);
            } catch (NoSuchEntityException $exception) {
                $this->logger->error($exception->getMessage());
                $this->messageManager->addErrorMessage(__('Entity with id %1 not found', $id));
                return $this->redirectToGrid();
            }

        } else {
            $this->logger->error(
                sprintf("Require parameter `%s` is missing", static::QUERY_PARAM_ID)
            );
            $this->messageManager->addErrorMessage("Comment not found");
            return $this->redirectToGrid();
        }

        $data = $this->_session->getFormData(true);

        if (!empty($data)) {
            $model->setData($data);
        }

        $this->registry->register(PostCommentInterface::REGISTRY_KEY, $model);

        return parent::execute();
    }
}