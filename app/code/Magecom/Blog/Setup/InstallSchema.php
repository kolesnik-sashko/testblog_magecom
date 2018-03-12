<?php
namespace Magecom\Blog\Setup;

use \Magento\Framework\DB\Ddl\Table;
use \Magento\Framework\Setup\InstallSchemaInterface;
use \Magento\Framework\Setup\SchemaSetupInterface;
use \Magento\Framework\Setup\ModuleContextInterface;

use \Magecom\Blog\Api\Schema\AuthorSchemaInterface;
use \Magecom\Blog\Api\Schema\PostCommentSchemaInterface;
use \Magecom\Blog\Api\Schema\PostSchemaInterface;
use \Magecom\Blog\Api\Schema\PostToStoreSchemaInterface;

class InstallSchema implements InstallSchemaInterface
{

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        if (!$installer->tableExists(AuthorSchemaInterface::TABLE_NAME)) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable(AuthorSchemaInterface::TABLE_NAME)
            )
                ->addColumn(
                    AuthorSchemaInterface::ID_COLUMN,
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                    ],
                    'Author ID'
                )
                ->addColumn(
                    AuthorSchemaInterface::FIRST_NAME_COLUMN,
                    Table::TYPE_TEXT,
                    20,
                    ['nullable' => false],
                    'Author First Name'
                )
                ->addColumn(
                    AuthorSchemaInterface::LAST_NAME_COLUMN,
                    Table::TYPE_TEXT,
                    20,
                    [],
                    'Author Last Name'
                )
                ->setComment('Author Table');
            $installer->getConnection()->createTable($table);
        }
        if (!$installer->tableExists(PostSchemaInterface::TABLE_NAME)) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable(PostSchemaInterface::TABLE_NAME)
            )
                ->addColumn(
                    PostSchemaInterface::ID_COLUMN,
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                    ],
                    'Post ID'
                )
                ->addColumn(
                    PostSchemaInterface::AUTHOR_ID_COLUMN,
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'nullable' => false,
                        'unsigned' => true
                    ],
                    'Author ID'
                )
                ->addColumn(
                    PostSchemaInterface::NAME_COLUMN,
                    Table::TYPE_TEXT,
                    255,
                    [],
                    'Post Title Name'
                )
                ->addColumn(
                    PostSchemaInterface::DESCRIPTION_COLUMN,
                    Table::TYPE_TEXT,
                    '64k',
                    [],
                    'Post description'
                )
                ->addColumn(
                    PostSchemaInterface::URL_KEY_COLUMN,
                    Table::TYPE_TEXT,
                    30,
                    [],
                    'Url key'
                )
                ->addColumn(
                    PostSchemaInterface::IMAGE_COLUMN,
                    Table::TYPE_TEXT,
                    30,
                    [],
                    'Image'
                )
                ->addColumn(
                    PostSchemaInterface::STATUS_COLUMN,
                    Table::TYPE_SMALLINT,
                    1,
                    [],
                    'Status'
                )
                ->addColumn(
                    PostSchemaInterface::CREATED_AT_COLUMN,
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                    'Created At'
                )
                ->addColumn(
                    PostSchemaInterface::UPDATED_AT_COLUMN,
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE],
                    'Updated At')
                ->addForeignKey(
                    $installer->getFkName(
                        PostSchemaInterface::TABLE_NAME,
                        PostSchemaInterface::AUTHOR_ID_COLUMN,
                        AuthorSchemaInterface::TABLE_NAME,
                        AuthorSchemaInterface::ID_COLUMN
                    ),
                    PostSchemaInterface::AUTHOR_ID_COLUMN,
                    $installer->getTable(AuthorSchemaInterface::TABLE_NAME),
                    AuthorSchemaInterface::ID_COLUMN,
                    Table::ACTION_CASCADE
                )
                ->setComment('Posts Table');
            $installer->getConnection()->createTable($table);
        }
        if (!$installer->tableExists(PostCommentSchemaInterface::TABLE_NAME)) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable(PostCommentSchemaInterface::TABLE_NAME)
            )
                ->addColumn(
                    PostCommentSchemaInterface::ID_COLUMN,
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                    ],
                    'Comment ID'
                )
                ->addColumn(
                    PostCommentSchemaInterface::POST_ID_COLUMN,
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'nullable' => false,
                        'unsigned' => true
                    ],
                    'Post ID'
                )
                ->addColumn(
                    PostCommentSchemaInterface::AUTHOR_ID_COLUMN,
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'nullable' => false,
                        'unsigned' => true
                    ],
                    'Author ID'
                )
                ->addColumn(
                    PostCommentSchemaInterface::COMMENT_TEXT_COLUMN,
                    Table::TYPE_TEXT,
                    255,
                    [],
                    'Comment description'
                )
                ->addColumn(
                    PostCommentSchemaInterface::STATUS_COLUMN,
                    Table::TYPE_SMALLINT,
                    1,
                    [],
                    'Status'
                )
                ->addColumn(
                    PostCommentSchemaInterface::CREATED_AT_COLUMN,
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                    'Created At'
                )
                ->addForeignKey(
                    $installer->getFkName(
                        PostCommentSchemaInterface::TABLE_NAME,
                        PostCommentSchemaInterface::AUTHOR_ID_COLUMN,
                        AuthorSchemaInterface::TABLE_NAME,
                        AuthorSchemaInterface::ID_COLUMN
                    ),
                    PostCommentSchemaInterface::AUTHOR_ID_COLUMN,
                    $installer->getTable(AuthorSchemaInterface::TABLE_NAME),
                    AuthorSchemaInterface::ID_COLUMN,
                    Table::ACTION_CASCADE
                )
                ->addForeignKey(
                    $installer->getFkName(
                        PostCommentSchemaInterface::TABLE_NAME,
                        PostCommentSchemaInterface::POST_ID_COLUMN,
                        PostSchemaInterface::TABLE_NAME,
                        PostSchemaInterface::ID_COLUMN
                    ),
                    PostCommentSchemaInterface::POST_ID_COLUMN,
                    $installer->getTable(PostSchemaInterface::TABLE_NAME),
                    PostSchemaInterface::ID_COLUMN,
                    Table::ACTION_CASCADE
                )
                ->setComment('Comments Table');
            $installer->getConnection()->createTable($table);
        }
        if (!$installer->tableExists(PostToStoreSchemaInterface::TABLE_NAME)) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable(PostToStoreSchemaInterface::TABLE_NAME)
            )
                ->addColumn(
                    PostToStoreSchemaInterface::POST_ID_COLUMN,
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'nullable' => false,
                        'unsigned' => true
                    ],
                    'Post ID'
                )
                ->addColumn(
                    PostToStoreSchemaInterface::STORE_ID_COLUMN,
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'nullable' => false,
                        'unsigned' => true
                    ],
                    'Store ID'
                )
//                ->addForeignKey(
//                    $installer->getFkName('magecom_blog_post_to_store', 'post_id', 'magecom_blog_post', 'entity_id'),
//                    'post_id',
//                    $installer->getTable('magecom_blog_post'),
//                    'entity_id',
//                    Table::ACTION_CASCADE
//                )
//                ->addForeignKey(
//                    $installer->getFkName('magecom_blog_post_to_store', 'store_id', 'store', 'store_id'),
//                    'store_id',
//                    $installer->getTable('store'),
//                    'store_id',
//                    Table::ACTION_CASCADE
//                )
                ->setComment('Post-to-store Table');
            $installer->getConnection()->createTable($table);
        }
        $installer->endSetup();
    }
}
