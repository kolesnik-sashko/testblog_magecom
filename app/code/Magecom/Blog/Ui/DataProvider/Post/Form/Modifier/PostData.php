<?php

namespace Magecom\Blog\Ui\DataProvider\Post\Form\Modifier;

use Magento\Ui\DataProvider\Modifier\ModifierInterface;

use Magecom\Blog\Model\ResourceModel\Post\CollectionFactory;

class PostData implements ModifierInterface
{
    protected $collection;

    public function __construct(
        CollectionFactory $postCollectionFactory
    ) {
        $this->collection = $postCollectionFactory->create();
    }
    
    public function modifyData(array $data)
    {
        
        $items = $this->collection->getItems();
        foreach ($items as $post) {
            $_data = $post->getData();
            if (isset($_data['image'])) {
                $imageArr = [];
                $imageArr[0]['name'] = 'Image';
                $imageArr[0]['url'] = $post->getImageUrl();
                $_data['image'] = $imageArr;
            }
            $post->setData($_data);
            $data[$post->getId()] = $_data;
        }
        return $data; 
    }

    public function modifyMeta(array $meta)
    {
        return $meta;
    }
}