<?php

namespace Magecom\Blog\Block\Adminhtml\Post\Edit\Button;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Delete extends Generic implements ButtonProviderInterface
{
    
    public function getButtonData()
    {
        return [
            'label' => __('Delete'),
            'class' => 'delete',
            'on_click' => 'deleteConfirm(\'' . __(
                    'Are you sure you want to do this?'
                ) . '\', \'' . $this->getDeleteUrl() . '\')',
            'sort_order' => 100
        ];


        return;
    }
    
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['id' => $this->getPostId()]);
    }
}