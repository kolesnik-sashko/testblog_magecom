<?php

namespace Magecom\Blog\Controller\Adminhtml;

use Psr\Log\LoggerInterface;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;

use Magecom\Blog\Api\Data\PostInterface;
use Magecom\Blog\Api\Repository\PostInterface as PostRepositoryInterface;
use Magecom\Blog\Helper\Data;
use Magecom\Blog\Model\PostFactory;

abstract class PostAbstract extends Action
{
    const ACL_RESOURCE          = 'Magecom_Blog::post';
    const MENU_ITEM             = 'Magecom_Blog::blog';
    const PAGE_TITLE            = 'Blog Posts';
    const BREADCRUMB_TITLE      = 'Posts';
    const QUERY_PARAM_ID        = 'id';

    /** @var Registry  */
    protected $registry;

    /** @var PageFactory  */
    protected $pageFactory;

    /** @var Data  */
    protected $helper;

    /** @var  PostFactory */
    protected $modelFactory;

    /** @var PostInterface */
    protected $model;

    /** @var Page */
    protected $resultPage;

    /** @var PostRepositoryInterface */
    protected $repository;

    /** @var LoggerInterface */
    protected $logger;

    /**
     * Lessons constructor.
     * @param Context                       $context
     * @param Registry                      $registry
     * @param PageFactory                   $pageFactory
     * @param PostRepositoryInterface       $postRepository
     * @param PostFactory                   $factory
     * @param Data                          $helper
     * @param LoggerInterface               $logger
     */
    public function __construct(
        Context $context,
        Registry $registry,
        PageFactory $pageFactory,
        PostRepositoryInterface $postRepository,
        PostFactory $factory,
        Data $helper,
        LoggerInterface $logger
    ){
        $this->registry       = $registry;
        $this->pageFactory    = $pageFactory;
        $this->repository     = $postRepository;
        $this->modelFactory   = $factory;
        $this->helper         = $helper;
        $this->logger         = $logger;
        parent::__construct($context);
    }

    /** {@inheritdoc} */
    public function execute()
    {
        $this->_setPageData();

        return $this->resultPage;
    }

    /** {@inheritdoc} */
    protected function _isAllowed()
    {
        $result = parent::_isAllowed();
        $result = $result && $this->_authorization->isAllowed(static::ACL_RESOURCE);

        return $result;
    }

    /**
     * @return Page
     */
    protected function _getResultPage()
    {
        if (null === $this->resultPage) {
            $this->resultPage = $this->pageFactory->create();
        }

        return $this->resultPage;
    }

    /**
     * @return AuthorAbstract
     */
    protected function _setPageData()
    {
        $resultPage = $this->_getResultPage();
        $resultPage->setActiveMenu(static::MENU_ITEM);
        $resultPage->getConfig()->getTitle()->prepend((__(static::PAGE_TITLE)));
        $resultPage->addBreadcrumb(__(static::BREADCRUMB_TITLE), __(static::BREADCRUMB_TITLE));
        $resultPage->addBreadcrumb(__(static::BREADCRUMB_TITLE), __(static::BREADCRUMB_TITLE));

        return $this;
    }

    /** @return PostInterface */
    protected function getModel()
    {
        if (null === $this->model) {
            $this->model = $this->modelFactory->create();
        }

        return $this->model;
    }

    /**
     * @return ResultInterface
     */
    protected function doRefererRedirect()
    {
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $redirect->setUrl($this->_redirect->getRefererUrl());

        return $redirect;
    }

    /**
     * @return ResponseInterface
     */
    protected function redirectToGrid()
    {
        return $this->_redirect('*/*/');
    }
}