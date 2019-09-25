<?php
namespace Synolia\Recrutement\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Zend_Db_Exception
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        if (version_compare($context->getVersion(), '1.0.0', '<')) {
            if (!$installer->tableExists('customer_ip_address')) {
                $table = $installer->getConnection()->newTable(
                    $installer->getTable('customer_ip_address')
                )
                    ->addColumn(
                        'id',
                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        null,
                        [
                            'identity' => true,
                            'nullable' => false,
                            'primary' => true,
                            'unsigned' => true,
                        ],
                        'id'
                    )
                    ->addColumn(
                        'ip_address',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        ['nullable => false'],
                        'Ip address'
                    )
                    ->addColumn(
                        'last_visited',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                        null,
                        ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                        'Date of last visit'
                    )
                    ->addColumn(
                        'nb_visit',
                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        null,
                        [],
                        'Number of visit'
                    );
                $installer->getConnection()->createTable($table);

                $installer->getConnection()->addIndex(
                    $installer->getTable('customer_ip_address'),
                    $setup->getIdxName(
                        $installer->getTable('customer_ip_address'),
                        ['ip_address', 'nb_visit'],
                        \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                    ),
                    ['ip_address', 'nb_visit'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                );
            }
        }

        $installer->endSetup();
    }
}