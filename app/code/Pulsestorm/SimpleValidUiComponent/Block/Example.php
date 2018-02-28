<?php
namespace Pulsestorm\SimpleValidUiComponent\Block;

use Magento\Framework\View\Element\BlockInterface;

class Example extends \Magento\Framework\View\Element\AbstractBlock
{
    public function toHtml()
    {
        return '<h1>Hello PHP Block Rendered in JS</h1>';
    }
}    