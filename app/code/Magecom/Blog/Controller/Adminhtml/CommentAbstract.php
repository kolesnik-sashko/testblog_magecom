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

use Magecom\Blog\Api\Data\PostCommentInterface;
use Magecom\Blog\Api\Repository\PostCommentInterface as PostCommentRepositoryInterface;
use Magecom\Blog\Helper\Data;
use Magecom\Blog\Model\PostCommentFactory;

abstract class CommentAbstract extends Action
{
    const ACL_RESOURCE          = 'Magecom_Blog::comment';
    const MENU_ITEM             = 'Magecom_Blog::blog';
    const PAGE_TITLE            = 'Blog Comments';
    const BREADCRUMB_TITLE      = 'Comments';
    const QUERY_PARAM_ID        = 'id';

    /** @var Registry  */
    protected $registry;

    /** @var PageFactory  */
    protected $pageFactory;

    /** @var Data  */
    protected $helper;

    /** @var  PostCommentFactory */
    protected $modelFactory;

    /** @var PostCommentInterface */
    protected $model;

    /** @var Page */
    protected $resultPage;

    /** @var PostCommentRepositoryInterface */
    protected $repository;

    /** @var LoggerInterface */
    protected $logger;

    /**
     * Lessons constructor.
     * @param Context                         $context
     * @param Registry                        $registry
     * @param PageFactory                     $pageFactory
     * @param PostCommentRepositoryInterface  $postCommentRepository
     * @param PostCommentFactory              $factory
     * @param Data                            $helper
     * @param LoggerInterface                 $logger
     */
    public function __construct(
        Context $context,
        Registry $registry,
        PageFactory $pageFactory,
        PostCommentRepositoryInterface $postCommentRepository,
        PostCommentFactory $factory,
        Data $helper,
        LoggerInterface $logger
    ){
        $this->registry       = $registry;
        $this->pageFactory    = $pageFactory;
        $this->repository     = $postCommentRepository;
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

    /** @return PostCommentInterface */
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