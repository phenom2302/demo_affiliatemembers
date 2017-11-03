<?php

namespace Demo\AffiliateMembers\Model\ResourceModel;

class Affiliatemembers extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Define resource model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('affiliate_members', 'affiliatemember_id');
    }
}