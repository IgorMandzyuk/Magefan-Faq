<?php
namespace Magefan\Faq\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        $table = $installer->getConnection()->newTable(
            $installer->getTable('magefan_faq')
        )->addColumn(
            'id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true],
            'ID'
        )->addColumn(
            'question',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'Question'
        )->addColumn(
            'answer',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'Answer'
        )->addColumn(
            'product_sku',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'Product sku'
        )->addColumn(
            'status',
            \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
            null,
            ['default' => 1],
            'Status'
        );

        $installer->endSetup();
        $installer->getConnection()->createTable($table);
    }
}