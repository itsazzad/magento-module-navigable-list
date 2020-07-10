<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\ViewModel\Size;

use Harriswebworks\Sizing\Api\Data\SizeInterface;
use Harriswebworks\Sizing\Model\ResourceModel\Size\Collection;
use Harriswebworks\Sizing\Model\ResourceModel\Size\CollectionFactory;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\BlockFactory;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Theme\Block\Html\Pager;

class ListSize implements ArgumentInterface
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
     * ListSize constructor.
     * @param StoreManagerInterface $storeManager
     * @param CollectionFactory $collectionFactory
     * @param BlockFactory $blockFactory
     */
    public function __construct(
        StoreManagerInterface $storeManager,
        CollectionFactory $collectionFactory,
        BlockFactory $blockFactory
    ) {
        $this->storeManager = $storeManager;
        $this->collectionFactory = $collectionFactory;
        $this->blockFactory = $blockFactory;
    }

    /**
     * @return Collection
     * @throws NoSuchEntityException
     */
    public function getCollection()
    {
        $this->processCollection();
        return $this->sizeCollection;
    }

    /**
     * @return string
     * @throws NoSuchEntityException
     */
    public function getPagerHtml()
    {
        $this->processCollection();
        return $this->pager->toHtml();
    }

    /**
     * prepare collection and pager
     * @throws NoSuchEntityException
     */
    private function processCollection()
    {
        if ($this->sizeCollection === null) {
            $this->sizeCollection = $this->collectionFactory->create();
            $this->sizeCollection->addFieldToSelect(SizeInterface::SIZE_ID);
            $this->sizeCollection->addFieldToSelect(SizeInterface::SIZE);
            $this->sizeCollection->addFieldToFilter(SizeInterface::IS_ACTIVE, 1);
            $this->sizeCollection->addStoreFilter($this->storeManager->getStore()->getId());
            $this->sizeCollection->setOrder(SizeInterface::SIZE, SortOrder::SORT_ASC);
            $this->pager = $this->blockFactory->createBlock(Pager::class);
            $this->pager->setCollection($this->sizeCollection);
        }
    }
}
