<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Api\Data;

use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * @api
 */
interface SizeSearchResultInterface
{
    /**
     * get items
     *
     * @return \Harriswebworks\Sizing\Api\Data\SizeInterface[]
     */
    public function getItems();

    /**
     * Set items
     *
     * @param \Harriswebworks\Sizing\Api\Data\SizeInterface[] $items
     * @return $this
     */
    public function setItems(array $items);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return $this
     */
    public function setSearchCriteria(SearchCriteriaInterface $searchCriteria);

    /**
     * @param int $count
     * @return $this
     */
    public function setTotalCount($count);
}
