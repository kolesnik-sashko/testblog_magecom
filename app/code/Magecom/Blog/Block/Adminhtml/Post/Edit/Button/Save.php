<?php

namespace Magecom\Blog\Block\Adminhtml\Post\Edit\Button;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Save extends Generic implements ButtonProviderInterface
{    
    public function getButtonData()
    {

        return [
            'label' => __('Save'),
            'class' => 'primary',
            'url'   => $this->getSaveUrl(),
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']]               
            ],
            'sort_order' => 100
        ];
        

        return;
    }

    public function getSaveUrl()
    {
        return $this->getUrl('*/*/save', ['id' => $this->getPostId(), 'back' => true]);
    }
}