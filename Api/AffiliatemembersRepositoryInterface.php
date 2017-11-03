<?php

namespace Demo\AffiliateMembers\Api;

interface AffiliatemembersRepositoryInterface
{
    /**
     * Return affiliate members items.
     *
     * @return \Demo\AffiliateMembers\Api\Data\AffiliatemembersSearchResultsInterface
     */
    public function getAffiliatemembers();

    /**
     * Save item.
     *
     * @param \Demo\AffiliateMembers\Api\Data\AffiliatemembersInterface $affiliatemember
     *
     * @return \Demo\AffiliateMembers\Api\Data\AffiliatemembersInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\Demo\AffiliateMembers\Api\Data\AffiliatemembersInterface $affiliatemember);

    /**
     * Retrieve item by id.
     *
     * @param string $affiliatememberId
     *
     * @return \Demo\AffiliateMembers\Api\Data\AffiliatemembersInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($affiliatememberId);

    /**
     * Retrieve item matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     *
     * @return \Demo\AffiliateMembers\Api\Data\AffiliatemembersSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete item.
     *
     * @param \Demo\AffiliateMembers\Api\Data\AffiliatemembersInterface $affiliatemember
     *
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\Demo\AffiliateMembers\Api\Data\AffiliatemembersInterface $affiliatemember);

    /**
     * Delete item by ID.
     *
     * @param string $affiliatememberId
     *
     * @return bool
     *
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($affiliatememberId);

}