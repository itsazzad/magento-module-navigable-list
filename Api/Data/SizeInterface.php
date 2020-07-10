<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Api\Data;

/**
 * @api
 */
interface SizeInterface
{
    public const SIZE_ID = 'size_id';
    public const SIZE = 'size';
    public const DESCRIPTION = 'description';
    public const ORDER = 'order';
    public const STORE_ID = 'store_id';
    public const META_TITLE = 'meta_title';
    public const META_DESCRIPTION = 'meta_description';
    public const META_KEYWORDS = 'meta_keywords';
    public const IS_ACTIVE = 'is_active';
    public const STATUS_ENABLED = 1;
    public const STATUS_DISABLED = 0;

    /**
     * @param int $id
     * @return SizeInterface
     */
    public function setId($id);

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     * @return SizeInterface
     */
    public function setSizeId($id);

    /**
     * @return int
     */
    public function getSizeId();

    /**
     * @param string $size
     * @return SizeInterface
     */
    public function setSize($size);

    /**
     * @return string
     */
    public function getSize();

    /**
     * @param string $description
     * @return SizeInterface
     */
    public function setDescription($description);

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @param int $order
     * @return SizeInterface
     */
    public function setOrder($order);

    /**
     * @return int
     */
    public function getOrder();

    /**
     * @param int[] $store
     * @return SizeInterface
     */
    public function setStoreId($store);

    /**
     * @return int[]
     */
    public function getStoreId();

    /**
     * @param string $metaTitle
     * @return SizeInterface
     */
    public function setMetaTitle($metaTitle);

    /**
     * @return string
     */
    public function getMetaTitle();

    /**
     * @param string $metaDescription
     * @return SizeInterface
     */
    public function setMetaDescription($metaDescription);

    /**
     * @return string
     */
    public function getMetaDescription();

    /**
     * @param string $metaKeywords
     * @return SizeInterface
     */
    public function setMetaKeywords($metaKeywords);

    /**
     * @return string
     */
    public function getMetaKeywords();

    /**
     * @param int $isActive
     * @return SizeInterface
     */
    public function setIsActive($isActive);

    /**
     * @return int
     */
    public function getIsActive();
}
