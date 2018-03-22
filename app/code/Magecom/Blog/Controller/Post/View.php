<?php

namespace Magecom\Blog\Controller\Post;

use Psr\Log\LoggerInterface;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;
use Magento\Customer\Model\Session;

use Magecom\Blog\Helper\Data;
use Magecom\Blog\Api\Repository\PostInterface as PostRepositoryInterface;
use Magecom\Blog\Api\Data\PostInterface;

class View extends Action
{

    const QUERY_PARAM_ID        = 'id';
    
    protected $registry;
    
    protected $_pageFactory;
    
    protected $helper;
    
    protected $modelFactory;
    
    protected $model;
    
    protected $resultPage;
   
    protected $repository;
    
    protected $logger;
    
    protected $_session;

    public function __construct(
        Context     $context,
        PageFactory $pageFactory,
        PostRepositoryInterface $postRepository,
        Registry $registry,
        Data $helper,
        Session $customerSession,
        LoggerInterface $logger
    )
    {
        $this->registry       = $registry;
        $this->repository     = $postRepository;
        $this->helper         = $helper;
        $this->logger         = $logger;
        $this->_pageFactory   = $pageFactory;
        $this->_session       = $customerSession;
        return parent::__construct($context);
    }

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

        return $this->_pageFactory->create();
    }

    protected function redirectToPosts()
    {
        return $this->_redirect('*/');
    }

    public function getJsLayout()

    {

        foreach ($this->_layoutProcessors as $processor) {

            $this->jsLayout = $processor->process($this->jsLayout);

        }

        return parent::getJsLayout();

    }

}