<?php

namespace Magecom\Blog\Controller\Adminhtml\Comment;

use Magecom\Blog\Controller\Adminhtml\CommentAbstract;

class Delete extends CommentAbstract
{
    public function execute()
    {
        $id = $this->getRequest()->getParam(static::QUERY_PARAM_ID);

        if (!empty($id)) {
            try {
                $this->repository->deleteById($id);
                $this->messageManager->addSuccessMessage(__('Comment has been deleted.'));
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
                $this->messageManager->addErrorMessage(_('Comment can\'t delete'));return $this->doRefererRedirect();
            }
        } else {
            $this->logger->error(
                sprintf("Require parameter `%s` is missing", static::QUERY_PARAM_ID)
            );
            $this->messageManager->addMessage(__('No item to delete'));
        }

        return $this->redirectToGrid();
    }
}