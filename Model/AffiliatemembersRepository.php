<?php

namespace Demo\AffiliateMembers\Model;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Reflection\DataObjectProcessor;
use Demo\AffiliateMembers\Api\Data\AffiliatemembersInterfaceFactory;
use Demo\AffiliateMembers\Api\AffiliatemembersRepositoryInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\NoSuchEntityException;
use Demo\AffiliateMembers\Model\ResourceModel\Affiliatemembers\CollectionFactory as AffiliatemembersCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Demo\AffiliateMembers\Api\Data\AffiliatemembersSearchResultsInterfaceFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Demo\AffiliateMembers\Model\ResourceModel\Affiliatemembers as ResourceAffiliatemembers;
use Demo\AffiliateMembers\Model\Status\Options as statusOptions;

class AffiliatemembersRepository implements AffiliatemembersRepositoryInterface
{
    protected $dataAffiliatemembersFactory;

    protected $affiliatemembersFactory;

    protected $dataObjectProcessor;

    protected $searchResultsFactory;

    protected $resource;

    protected $affiliatemembersCollectionFactory;

    protected $dataObjectHelper;

    protected $statusOptions;

    private $storeManager;


    /**
     * Construct.
     *
     * @param ResourceAffiliatemembers                      $resource
     * @param AffiliatemembersFactory                       $affiliatemembersFactory
     * @param AffiliatemembersInterfaceFactory              $dataAffiliatemembersFactory
     * @param AffiliatemembersCollectionFactory             $affiliatemembersCollectionFactory
     * @param AffiliatemembersSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper                              $dataObjectHelper
     * @param DataObjectProcessor                           $dataObjectProcessor
     * @param StoreManagerInterface                         $storeManager
     */
    public function __construct(
        ResourceAffiliatemembers $resource,
        AffiliatemembersFactory $affiliatemembersFactory,
        AffiliatemembersInterfaceFactory $dataAffiliatemembersFactory,
        AffiliatemembersCollectionFactory $affiliatemembersCollectionFactory,
        AffiliatemembersSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        statusOptions $statusOptions

    ) {
        $this->resource = $resource;
        $this->affiliatemembersFactory = $affiliatemembersFactory;
        $this->affiliatemembersCollectionFactory = $affiliatemembersCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataAffiliatemembersFactory = $dataAffiliatemembersFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->statusOptions = $statusOptions;
    }

    /**
     * Return affiliate members items.
     *
     * @return \Demo\AffiliateMembers\Api\Data\AffiliatemembersSearchResultsInterface
     */
    public function getAffiliatemembers()
    {
        $collection = $this->affiliatemembersCollectionFactory->create();

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setItems($collection->getItems());
        return $searchResults;
    }

    /**
     * Save item.
     *
     * @param \Demo\AffiliateMembers\Api\Data\AffiliatemembersInterface $affiliatemembers
     *
     * @return \Demo\AffiliateMembers\Api\Data\AffiliatemembersInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\Demo\AffiliateMembers\Api\Data\AffiliatemembersInterface $affiliatemembers)
    {
        try {
            $this->resource->save($affiliatemembers);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __(
                    'Could not save item: %1',
                    $exception->getMessage()
                )
            );
        }
        return $affiliatemembers;
    }

    /**
     * Retrieve item by id.
     *
     * @param string $affiliatememberId
     *
     * @return \Demo\AffiliateMembers\Api\Data\AffiliatemembersInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($affiliatememberId)
    {
        $affiliatemembers = $this->affiliatemembersFactory->create();
        $this->resource->load($affiliatemembers, $affiliatememberId);
        if (!$affiliatemembers->getId()) {
            throw new NoSuchEntityException(__('Member with id "%1" does not exist.', $affiliatememberId));
        }
        return $affiliatemembers;
    }

    /**
     * Retrieve item matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     *
     * @return \Demo\AffiliateMembers\Api\Data\AffiliatemembersSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->affiliatemembersCollectionFactory->create();
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                if ($filter->getField() === 'store_id') {
                    $collection->addStoreFilter($filter->getValue(), false);
                    continue;
                }
                $condition = $filter->getConditionType() ?: 'eq';
                if ($filter->getField() === 'status') {
                    $status_options = $this->statusOptions->getOptionArray();
                    $status_value = array_search(ucfirst($filter->getValue()), $status_options);
                    $collection->addFieldToFilter($filter->getField(), [$condition => $status_value]);
                } else {
                    $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
                }
            }
        }

        $sortOrders = $searchCriteria->getSortOrders();
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }

        $collection->setCurPage($searchCriteria->getCurrentPage());
        $collection->setPageSize($searchCriteria->getPageSize());

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setItems($collection->getItems());

        return $searchResults;
    }

    /**
     * Delete item.
     *
     * @param \Demo\AffiliateMembers\Api\Data\AffiliatemembersInterface $affiliatemember
     *
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\Demo\AffiliateMembers\Api\Data\AffiliatemembersInterface $affiliatemember)
    {
        try {
            $this->resource->delete($affiliatemember);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(
                __(
                    'Could not delete item: %1',
                    $exception->getMessage()
                )
            );
        }
        return true;
    }

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
    public function deleteById($affiliatememberId)
    {
        return $this->delete($this->getById($affiliatememberId));
    }

    /**
     * {@inheritdoc}
     */
    public function getItems()
    {
        $collection = $this->affiliatemembersCollectionFactory->create();
        return $collection->getItems();
    }
}