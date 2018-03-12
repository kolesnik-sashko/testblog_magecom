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
        $globalPostIndex = 1;
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

                $post->setAuthorId($author->getId())
                     ->setName(sprintf('Post Name #%d', $globalPostIndex))
                     ->setDescription(sprintf('Post Description #%d', $globalPostIndex))
                     ->setUrlKey(sprintf('post%d', $globalPostIndex))
                     ->setImage(sprintf('postimage%d.jpg', $globalPostIndex))
                     ->setStatus(Post::STATUS_ENABLE);
//                     ->setCreatedAt('0000-00-00 00-00')
//                     ->setUpdatedAt('0000-00-00 00-00');

                try{
                    $post->save();
                    $globalPostIndex++;
                }catch (\Exception $e){
                    $this->logger->error($e);
                }
                for ($commentIndex = 1; $commentIndex <= 10; $commentIndex++)
                {
                    $comment = $this->postCommentFactory->create();
                    
                    $comment->setPostId($post->getId())
                            ->setAuthorId($author->getId())
                            ->setCommentText(sprintf('Comment #%d to post #%d', $commentIndex, $post->getId()));
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