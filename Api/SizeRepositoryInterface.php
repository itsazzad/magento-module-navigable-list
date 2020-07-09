<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Api;

use Harriswebworks\Sizing\Api\Data\SizeInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * @api
 */
interface SizeRepositoryInterface
{
    /**
     * @param SizeInterface $size
     * @return SizeInterface
     */
    public function save(SizeInterface $size);

    /**
     * @param int $sizeId
     * @return SizeInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get(int $sizeId);

    /**
     * @param SizeInterface $size
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(SizeInterface $size);

    /**
     * @param int $sizeId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById(int $sizeId);

    /**
     * clear caches instances
     * @return void
     */
    public function clear();
}
