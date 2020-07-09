<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Test\Unit\ViewModel\Size;

use Harriswebworks\Sizing\Model\ResourceModel\Size\Collection;
use Harriswebworks\Sizing\Model\ResourceModel\Size\CollectionFactory;
use Harriswebworks\Sizing\ViewModel\Size\ListSize;
use Magento\Framework\View\Element\BlockFactory;
use Magento\Store\Api\Data\StoreInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Theme\Block\Html\Pager;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ListSizeTest extends TestCase
{
    /**
     * @var StoreManagerInterface | MockObject
     */
    private $storeManager;
    /**
     * @var CollectionFactory | MockObject
     */
    private $collectionFactory;
    /**
     * @var BlockFactory | MockObject
     */
    private $blockFactory;
    /**
     * @var Collection
     */
    private $collection;
    /**
     * @var ListSize
     */
    private $listSize;
    /**
     * @var Pager | MockObject
     */
    private $pager;

    /**
     * setup tests
     */
    protected function setUp(): void
    {
        $this->storeManager = $this->createMock(StoreManagerInterface::class);
        $this->storeManager->method('getStore')->willReturn($this->createMock(StoreInterface::class));
        $this->collectionFactory = $this->createMock(CollectionFactory::class);
        $this->blockFactory = $this->createMock(BlockFactory::class);
        $this->collection = $this->createMock(Collection::class);
        $this->pager = $this->createMock(Pager::class);
        $this->listSize = new ListSize(
            $this->storeManager,
            $this->collectionFactory,
            $this->blockFactory
        );
    }

    /**
     * @covers \Harriswebworks\Sizing\ViewModel\Size\ListSize::getCollection
     * @covers \Harriswebworks\Sizing\ViewModel\Size\ListSize::processCollection
     * @covers \Harriswebworks\Sizing\ViewModel\Size\ListSize::__construct
     */
    public function testGetSizeCollection()
    {
        $this->collectionFactory->expects($this->once())->method('create')->willReturn($this->collection);
        $this->collection->expects($this->once())->method('addStoreFilter');
        $this->collection->expects($this->once())->method('addFieldToFilter');
        $this->blockFactory->expects($this->once())->method('createBlock')->willReturn($this->pager);
        $this->assertEquals($this->collection, $this->listSize->getCollection());
        //call twice to test memoizing
        $this->assertEquals($this->collection, $this->listSize->getCollection());
    }

    /**
     * @covers \Harriswebworks\Sizing\ViewModel\Size\ListSize::getPagerHtml
     * @covers \Harriswebworks\Sizing\ViewModel\Size\ListSize::processCollection
     * @covers \Harriswebworks\Sizing\ViewModel\Size\ListSize::__construct
     */
    public function testGetPagerHtml()
    {
        $this->pager->method('toHtml')->willReturn('pager_html');
        $this->collectionFactory->expects($this->once())->method('create')->willReturn($this->collection);
        $this->blockFactory->expects($this->once())->method('createBlock')->willReturn($this->pager);
        $this->assertEquals('pager_html', $this->listSize->getPagerHtml());
        //call twice to test memoizing
        $this->assertEquals('pager_html', $this->listSize->getPagerHtml());
    }
}
