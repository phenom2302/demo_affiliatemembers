<?php

namespace Demo\AffiliateMembers\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\InstallSchemaInterface;
use Demo\AffiliateMembers\Api\Data\AffiliatemembersInterface;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();

        $table = $setup->getConnection()->newTable(
            $setup->getTable('affiliate_members')
        );

        $table->addColumn(
            AffiliatemembersInterface::ID,
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            array('identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true),
            'Entity ID'
        );

        $table->addColumn(
            AffiliatemembersInterface::NAME,
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'Name'
        );

        $table->addColumn(
            AffiliatemembersInterface::PROFILE_IMAGE,
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'Profile Image'
        );

        $table->addColumn(
            AffiliatemembersInterface::STATUS,
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'Status'
        );

        $table->addColumn(
            AffiliatemembersInterface::CREATED,
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
            'Created'
        );

        $table->addColumn(
            AffiliatemembersInterface::MODIFIED,
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
            'Modified'
        );

        $setup->getConnection()->createTable($table);

        $setup->endSetup();
    }
}