<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\ViewModel\Size;

use Harriswebworks\Sizing\Api\Data\SizeInterface;
use Harriswebworks\Sizing\Model\ResourceModel\Size\Collection;
use Harriswebworks\Sizing\Model\ResourceModel\Size\CollectionFactory;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\BlockFactory;
use Magento\Theme\Block\Html\Pager;
use Magento\Store\Model\ScopeInterface;

class ListSizeForNext extends ListSize
{
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;
    /**
     * @var BlockFactory
     */
    private $blockFactory;
    /**
     * @var Collection
     */
    private $sizeCollection;
    /**
     * @var Pager
     */
    private $pager;

    /**
     * prepare collection and pager
     * @throws NoSuchEntityException
     */
    private function processCollection($serial = null)
    {
        if ($this->sizeCollection === null) {
            $orderBy = $this->scopeConfig->getValue(self::ORDER_BY_CONFIG_PATH, ScopeInterface::SCOPE_STORE);
            $this->sizeCollection = $this->collectionFactory->create();
            $this->sizeCollection->addFieldToSelect(SizeInterface::SIZE_ID);
            $this->sizeCollection->addFieldToSelect(SizeInterface::SIZE);
            $this->sizeCollection->addFieldToFilter(SizeInterface::IS_ACTIVE, 1);
            $this->sizeCollection->addStoreFilter($this->storeManager->getStore()->getId());
            $this->sizeCollection->setOrder($orderBy ? $orderBy : SizeInterface::SIZE, SortOrder::SORT_ASC);
            if($serial > 0){
                $this->sizeCollection->getSelect()->limit(1, $serial);
            }else{
                $this->pager = $this->blockFactory->createBlock(Pager::class);
                $this->pager->setCollection($this->sizeCollection);
            }
        }
    }
}
