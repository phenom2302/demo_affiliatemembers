<?php

namespace Demo\AffiliateMembers\Api\Data;

interface AffiliatemembersSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get affiliate members list.
     *
     * @return \Demo\AffiliateMembers\Api\Data\AffiliatemembersInterface[]
     */
    public function getItems();

    /**
     * Set affiliate members list.
     *
     * @param \Demo\AffiliateMembers\Api\Data\AffiliatemembersInterface[] $items
     *
     * @return void
     */
    public function setItems(array $items);
}