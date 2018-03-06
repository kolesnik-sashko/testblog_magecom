<?php

namespace Magecom\Blog\Controller\Adminhtml\Post;

use Magento\Framework\Exception\NoSuchEntityException;

use Magecom\Blog\Api\Data\PostInterface;
use Magecom\Blog\Controller\Adminhtml\PostAbstract;

class Edit extends PostAbstract
{
    const ACL_RESOURCE      = 'Magecom_Blog::post_edit';
    const PAGE_TITLE        = 'Edit Post';
    const BREADCRUMB_TITLE  = 'Edit Post';

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
            $this->messageManager->addErrorMessage("Post not found");
            return $this->redirectToGrid();
        }

        $data = $this->_session->getFormData(true);

        if (!empty($data)) {
            $model->setData($data);
        }

        $this->registry->register(PostInterface::REGISTRY_KEY, $model);

        return parent::execute();
    }
}