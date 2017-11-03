<?php

namespace Demo\AffiliateMembers\Model;

use Demo\AffiliateMembers\Api\AffiliatemembersManagementInterface;

class AffiliatemembersManagement
    extends \Demo\AffiliateMembers\Model\AffiliatemembersRepository
    implements AffiliatemembersManagementInterface
{

    /**
     * {@inheritdoc}
     */
    public function getAffiliatemembers()
    {
        return $this->getItems();
    }
}