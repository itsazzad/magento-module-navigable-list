<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Model;

use Harriswebworks\Sizing\Api\Data\SizeSearchResultInterfaceFactory;
use Harriswebworks\Sizing\Api\SizeListRepositoryInterface;
use Harriswebworks\Sizing\Model\ResourceModel\Size\Collection;
use Harriswebworks\Sizing\Model\ResourceModel\Size\CollectionFactory;
use Magento\Framework\Api\Search\FilterGroup;
use Magento\Framework\Api\SortOrder;

class SizeListRepo implements SizeListRepositoryInterface
{
    /**
     * @var SizeSearchResultInterfaceFactory
     */
    private $searchResultFactory;
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @param SizeSearchResultInterfaceFactory $searchResultFactory
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        SizeSearchResultInterfaceFactory $searchResultFactory,
        CollectionFactory $collectionFactory
    ) {
        $this->searchResultFactory = $searchResultFactory;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return SizeSearchResultInterfaceFactory
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        /** @var SizeSearchResultInterfaceFactory $searchResult */
        $searchResult = $this->searchResultFactory->create();
        $searchResult->setSearchCriteria($searchCriteria);

        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();
        foreach ($searchCriteria->getFilterGroups() as $group) {
            $this->addFilterGroupToCollection($group, $collection);
        }
        $sortOrders = $searchCriteria->getSortOrders();
        if ($sortOrders) {
            foreach ($searchCriteria->getSortOrders() as $sortOrder) {
                $field = $sortOrder->getField();
                $direction = $sortOrder->getDirection();
                $collection->addOrder(
                    $field,
                    ($direction === SortOrder::SORT_ASC) ? SortOrder::SORT_ASC : SortOrder::SORT_DESC
                );
            }
        }
        $collection->setCurPage($searchCriteria->getCurrentPage());
        $collection->setPageSize($searchCriteria->getPageSize());
        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setItems($collection->getItems());
        return $searchResult;
    }

    /**
     * Helper function that adds a FilterGroup to the collection.
     *
     * @param FilterGroup $filterGroup
     * @param Collection $collection
     * @return $this
     * @throws \Magento\Framework\Exception\InputException
     */
    private function addFilterGroupToCollection(
        FilterGroup $filterGroup,
        Collection $collection
    ) {
        $fields = [];
        $conditions = [];
        foreach ($filterGroup->getFilters() as $filter) {
            if ($filter->getField() === 'store') {
                $collection->addStoreFilter($filter->getValue(), true);
            } else {
                $condition = $filter->getConditionType() ? $filter->getConditionType() : 'eq';
                $fields[] = $filter->getField();
                $conditions[] = [$condition => $filter->getValue()];
            }
        }
        if ($fields) {
            $collection->addFieldToFilter($fields, $conditions);
        }
        return $this;
    }
}
