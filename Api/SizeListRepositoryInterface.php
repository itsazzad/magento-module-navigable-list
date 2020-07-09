<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Api;

use Harriswebworks\Sizing\Api\Data\SizeSearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;

interface SizeListRepositoryInterface
{
    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return SizeSearchResultInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
