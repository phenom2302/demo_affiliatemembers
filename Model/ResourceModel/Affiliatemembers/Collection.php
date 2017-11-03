<?php

namespace Demo\AffiliateMembers\Model\ResourceModel\Affiliatemembers;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Define resource model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'Demo\AffiliateMembers\Model\Affiliatemembers',
            'Demo\AffiliateMembers\Model\ResourceModel\Affiliatemembers'
        );
    }
}
