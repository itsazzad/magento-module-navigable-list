<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Model;

use Harriswebworks\Sizing\Api\Data\SizeInterface;
use Harriswebworks\Sizing\Model\ResourceModel\Size as SizeResourceModel;
use Magento\Framework\Model\AbstractModel;

class Size extends AbstractModel implements SizeInterface
{
    /**
     * Cache tag
     *
     * @var string
     */
    public const CACHE_TAG = 'harriswebworks_sizing_size';
    /**
     * Cache tag
     *
     * @var string
     * phpcs:disable PSR2.Classes.PropertyDeclaration.Underscore,PSR12.Classes.PropertyDeclaration.Underscore
     */
    protected $_cacheTag = self::CACHE_TAG;
    /**
     * Event prefix
     *
     * @var string
     */
    protected $_eventPrefix = 'harriswebworks_sizing_size';
    /**
     * Event object
     *
     * @var string
     */
    protected $_eventObject = 'size';
    //phpcs:enable
    /**
     * Initialize resource model
     *
     * @return void
     * phpcs:disable PSR2.Methods.MethodDeclaration.Underscore,PSR12.Methods.MethodDeclaration.Underscore
     */
    protected function _construct()
    {
        $this->_init(SizeResourceModel::class);
        //phpcs:enable
    }

    /**
     * Get Size id
     *
     * @return array
     */
    public function getSizeId()
    {
        return $this->getData(SizeInterface::SIZE_ID);
    }

    /**
     * set Size id
     *
     * @param  int $sizeId
     * @return SizeInterface
     */
    public function setSizeId($sizeId)
    {
        return $this->setData(SizeInterface::SIZE_ID, $sizeId);
    }

    /**
     * @param string $size
     * @return SizeInterface
     */
    public function setSize($size)
    {
        return $this->setData(self::SIZE, $size);
    }

    /**
     * @return string
     */
    public function getSize()
    {
        return $this->getData(self::SIZE);
    }

    /**
     * @param string $description
     * @return SizeInterface
     */
    public function setDescription($description)
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->getData(self::DESCRIPTION);
    }

    /**
     * @param int $ordering
     * @return SizeInterface
     */
    public function setOrdering($ordering)
    {
        return $this->setData(self::ORDERING, $ordering);
    }

    /**
     * @return int
     */
    public function getOrdering()
    {
        return $this->getData(self::ORDERING);
    }

    /**
     * @param array $storeId
     * @return SizeInterface
     */
    public function setStoreId($storeId)
    {
        return $this->setData(SizeInterface::STORE_ID, $storeId);
    }

    /**
     * @return int[]
     */
    public function getStoreId()
    {
        return $this->getData(SizeInterface::STORE_ID);
    }

    /**
     * @param string $metaTitle
     * @return SizeInterface
     */
    public function setMetaTitle($metaTitle)
    {
        return $this->setData(SizeInterface::META_TITLE, $metaTitle);
    }

    /**
     * @return string
     */
    public function getMetaTitle()
    {
        return $this->getData(SizeInterface::META_TITLE);
    }

    /**
     * @param string $metaDescription
     * @return SizeInterface
     */
    public function setMetaDescription($metaDescription)
    {
        return $this->setData(SizeInterface::META_DESCRIPTION, $metaDescription);
    }

    /**
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->getData(SizeInterface::META_DESCRIPTION);
    }

    /**
     * @param string $metaKeywords
     * @return SizeInterface
     */
    public function setMetaKeywords($metaKeywords)
    {
        return $this->setData(SizeInterface::META_KEYWORDS, $metaKeywords);
    }

    /**
     * @return string
     */
    public function getMetaKeywords()
    {
        return $this->getData(SizeInterface::META_KEYWORDS);
    }

    /**
     * @param int $isActive
     * @return SizeInterface
     */
    public function setIsActive($isActive)
    {
        return $this->setData(SizeInterface::IS_ACTIVE, $isActive);
    }

    /**
     * @return int
     */
    public function getIsActive()
    {
        return $this->getData(SizeInterface::IS_ACTIVE);
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
