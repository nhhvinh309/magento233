<?php

namespace Custom\Uiform\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $eavTable = $setup->getTable('form_block');
            $connection = $setup->getConnection();  
            if ($setup->getConnection()->isTableExists($eavTable) == true) {
                $connection->dropColumn($eavTable, 'file_ext');
            }
        }

        if (version_compare($context->getVersion(), '1.0.2', '<')) {
            $setup->startSetup();
            $eavTable = $setup->getTable('form_block');
            $connection = $setup->getConnection();  
            if ($setup->getConnection()->isTableExists($eavTable) == true) {
                $connection->addColumn(
                    $eavTable,
                    'category_ids',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    null,
                    ['nullable' => true,'default' => null],
                    'Category Ids'
                );
            }
            $setup->endSetup();
        }  
    }
}