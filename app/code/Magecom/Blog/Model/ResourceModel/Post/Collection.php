<?php

namespace Magecom\Blog\Model\ResourceModel\Post;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magento\Framework\Data\Collection\EntityFactoryInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

use Magecom\Blog\Model\Post as Model;
use Magecom\Blog\Model\ResourceModel\Post as ResourceModel;
use Magecom\Blog\Api\Schema\AuthorSchemaInterface;
use Magecom\Blog\Api\Schema\PostSchemaInterface;

class Collection extends AbstractCollection
{
    protected $_idFieldName = PostSchemaInterface::ID_COLUMN;
    
    /** {@inheritdoc} */
    public function __construct(
        EntityFactoryInterface $entityFactory,
        LoggerInterface $logger,
        FetchStrategyInterface $fetchStrategy,
        ManagerInterface $eventManager,
        StoreManagerInterface $storeManager,
        AdapterInterface $connection = null,
        AbstractDb $resource = null
    )
    {
        $this->_init(Model::class, ResourceModel::class);
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource);
        $this->storeManager = $storeManager;
    }

    protected function _initSelect()
    {
        parent::_initSelect();

        $this->getSelect()->joinLeft(
            ['authorTable' => $this->getTable(AuthorSchemaInterface::TABLE_NAME)],
            'main_table.author_id = authorTable.entity_id',
            [
                'author_name' => "CONCAT(authorTable.first_name, ' ', authorTable.last_name)"
            ]
        );
    }
}