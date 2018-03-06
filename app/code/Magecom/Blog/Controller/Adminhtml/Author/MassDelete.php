<?php

namespace Magecom\Blog\Controller\Adminhtml\Author;

use Magecom\Blog\Controller\Adminhtml\AuthorAbstract;

class MassDelete extends AuthorAbstract
{
    public function execute()
    {
        $ids = $this->getRequest()->getParam('selected');
        if (count($ids)) {
            foreach ($ids as $id) {
                try {
                    $this->repository->deleteById($id);
                } catch (\Exception $e) {
                    $this->logger->error($e->getMessage());
                    $this->logger->critical(
                        sprintf("Can't delete author: %d", $id)
                    );
                    $this->messageManager->addErrorMessage(__('Author with id %1 not deleted', $id));
                }
            }
            $this->messageManager->addSuccessMessage(
                __('A total of %1 record(s) has been deleted.', count($ids))
            );
        } else {
            $this->logger->error("Parameter ids must be array and not empty");
            $this->messageManager->addWarningMessage("Please select items to delete");
        }

        return $this->redirectToGrid();
    }
}