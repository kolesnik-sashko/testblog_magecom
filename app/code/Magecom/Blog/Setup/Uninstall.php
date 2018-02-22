<?php

namespace Magecom\Blog\Setup;

use Magento\Framework\Setup\UninstallInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

use \Magecom\Blog\Api\Schema\AuthorSchemaInterface;
use \Magecom\Blog\Api\Schema\PostCommentSchemaInterface;
use \Magecom\Blog\Api\Schema\PostSchemaInterface;
use \Magecom\Blog\Api\Schema\PostToStoreSchemaInterface;

class Uninstall implements UninstallInterface
{
    public function uninstall(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        if ($installer->tableExists(PostToStoreSchemaInterface::TABLE_NAME))
        {
            $installer->getConnection()->dropTable(PostToStoreSchemaInterface::TABLE_NAME);
        }
        if ($installer->tableExists(PostCommentSchemaInterface::TABLE_NAME))
        {
            $installer->getConnection()->dropTable(PostCommentSchemaInterface::TABLE_NAME);
        }
        if ($installer->tableExists(PostSchemaInterface::TABLE_NAME))
        {
            $installer->getConnection()->dropTable(PostSchemaInterface::TABLE_NAME);
        }
        if ($installer->tableExists(AuthorSchemaInterface::TABLE_NAME))
        {
            $installer->getConnection()->dropTable(AuthorSchemaInterface::TABLE_NAME);
        }
        $installer->endSetup();
    }
}