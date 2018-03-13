<?php

namespace Magecom\Blog\Controller\Adminhtml\Post;

use Psr\Log\LoggerInterface;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Api\DataObjectHelper;

use Magecom\Blog\Controller\Adminhtml\PostAbstract;
use Magecom\Blog\Api\Schema\PostSchemaInterface;
use Magecom\Blog\Api\Repository\PostInterface as PostRepositoryInterface;
use Magecom\Blog\Model\PostFactory;
use Magecom\Blog\Helper\Data;
use Magecom\Blog\Model\UploaderPool;
use Magecom\Blog\Api\Data\PostInterface;


class Save extends PostAbstract
{
    protected $dataObjectHelper;
   
    protected $uploaderPool;

    public function __construct(
        Context $context,
        Registry $registry,
        PageFactory $pageFactory,
        PostRepositoryInterface $postRepository,
        PostFactory $factory,
        Data $helper,
        LoggerInterface $logger,
        DataObjectHelper $dataObjectHelper,
        UploaderPool $uploaderPool
    )
    {
        parent::__construct($context, $registry, $pageFactory, $postRepository, $factory, $helper, $logger);
        $this->dataObjectHelper  = $dataObjectHelper;
        $this->uploaderPool      = $uploaderPool;
    }

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

            $image = $this->getUploader('image')->uploadFileAndGetName('image', $formData);
            $formData['image'] = $image;

            $this->dataObjectHelper->populateWithArray($model, $formData, PostInterface::class);

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

    protected function getUploader($type)
    {
        return $this->uploaderPool->getUploader($type);
    }
}