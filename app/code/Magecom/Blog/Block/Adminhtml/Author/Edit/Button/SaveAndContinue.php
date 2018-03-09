<?php

namespace Magecom\Blog\Block\Adminhtml\Author\Edit\Button;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveAndContinue extends Generic implements ButtonProviderInterface
{
    
    public function getButtonData()
    {
        return [
            'label' => __('Save And Continue'),
            'class' => 'primary',
            'url'   => $this->getSaveUrl(),
            'data_attribute' => [
                'mage-init' => [
                    'button' => ['event' => 'saveAndContinueEdit'],
                ],
            ],
            'sort_order' => 100
        ];


        return;
    }

    public function getSaveUrl()
    {
        return $this->getUrl('*/*/save', ['entity_id' => $this->getAuthorId(), 'back' => false]);
    }
}