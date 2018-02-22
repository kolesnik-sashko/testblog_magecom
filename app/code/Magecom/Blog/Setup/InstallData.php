<?php

namespace Magecom\Blog\Setup;

use PSR\Log\LoggerInterface;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\InstallDataInterface;

use Magecom\Blog\Model\Author;
use Magecom\Blog\Model\AuthorFactory;
use Magecom\Blog\Model\Post;
use Magecom\Blog\Model\PostFactory;
use Magecom\Blog\Model\PostComment;
use Magecom\Blog\Model\PostCommentFactory;


class InstallData implements InstallDataInterface
{
    /** @var  AuthorFactory */
    protected $authorFactory;

    /** @var  PostFactory */
    protected $postFactory;

    /** @var  PostCommentFactory */
    protected $postCommentFactory;

    /** @var  LoggerInterface */
    protected $logger;

    public function __construct(
        AuthorFactory      $authorFactory,
        PostFactory        $postFactory,
        PostCommentFactory $postCommentFactory,
        LoggerInterface    $logger
    )
    {
        $this->authorFactory      = $authorFactory;
        $this->postFactory        = $postFactory;
        $this->postCommentFactory = $postCommentFactory;
        $this->logger             = $logger;
    }

    /** {@inheritdoc} */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        for ($authorIndex = 1; $authorIndex <= 10; $authorIndex++)
        {
            $author = $this->authorFactory->create();
            
            $author->setFirstName(sprintf('FName #%d', $authorIndex))
                   ->setLastName(sprintf('LName #%d', $authorIndex));
            try{
                $author->save();
            }catch (\Exception $e){
                $this->logger->error($e);
            }
            for ($postIndex = 1; $postIndex <= 10; $postIndex++)
            {
                $post = $this->postFactory->create();

                $post->setAuthorId($authorIndex)
                     ->setName(sprintf('Post Name #%d', $postIndex))
                     ->setDescription(sprintf('Post Description #%d', $postIndex))
                     ->setUrlKey(sprintf('post%d', $postIndex))
                     ->setImage(sprintf('postimage%d.jpg', $postIndex))
                     ->setStatus(Post::STATUS_ENABLE);
//                     ->setCreatedAt('0000-00-00 00-00')
//                     ->setUpdatedAt('0000-00-00 00-00');

                try{
                    $post->save();
                }catch (\Exception $e){
                    $this->logger->error($e);
                }
                for ($commentIndex = 1; $commentIndex <= 10; $commentIndex++)
                {
                    $comment = $this->postCommentFactory->create();
                    
                    $comment->setPostId($postIndex)
                            ->setAuthorId($authorIndex)
                            ->setCommentText(sprintf('Comment #%d to post #d', $commentIndex, $postIndex));
//                            ->setCreatedAt('0000-00-00 00-00');
                    try{
                        $comment->save();
                    }catch (\Exception $e){
                        $this->logger->error($e);
                    }
                }
            }
        }
        
    }
}