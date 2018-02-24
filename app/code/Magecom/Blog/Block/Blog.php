<?php

namespace Magecom\Blog\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magecom\Blog\Model\Repository\Post as PostRepository;

class Blog extends Template
{
    /** @var PostRepository  */
    protected $postRepository;

    public function __construct(
        Context $context,
        PostRepository $postRepository,
        array $data
    ){
        $this->postRepository = $postRepository;
        parent::__construct($context, $data);
    }

    public function getPosts(){
        return $this->postRepository->getCollection();
    }
}