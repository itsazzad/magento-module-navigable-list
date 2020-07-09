<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Test\Unit\Model;

use Harriswebworks\Sizing\Api\Data\SizeSearchResultInterface;
use Harriswebworks\Sizing\Api\Data\SizeSearchResultInterfaceFactory;
use Harriswebworks\Sizing\Model\ResourceModel\Size\Collection;
use Harriswebworks\Sizing\Model\ResourceModel\Size\CollectionFactory;
use Harriswebworks\Sizing\Model\Size;
use Harriswebworks\Sizing\Model\SizeListRepo;
use Magento\Framework\Api\Filter;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\Search\FilterGroup;
use Magento\Framework\Api\SortOrder;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class SizeListRepoTest extends TestCase
{
    /**
     * @var SizeSearchResultInterfaceFactory | MockObject
     */
    private $searchResultsFactory;
    /**
     * @var CollectionFactory | MockObject
     */
    private $collectionFactory;
    /**
     * @var SearchCriteriaInterface | MockObject
     */
    private $searchCriteria;
    /**
     * @var FilterGroup | MockObject
     */
    private $filterGroup;
    /**
     * @var Collection | MockObject
     */
    private $collection;
    /**
     * @var SizeListRepo
     */
    private $sizeListRepo;

    /**
     * setup tests
     */
    protected function setUp(): void
    {
        $this->searchResultsFactory = $this->createMock(SizeSearchResultInterfaceFactory::class);
        $this->collectionFactory = $this->createMock(CollectionFactory::class);
        $this->searchCriteria = $this->createMock(SearchCriteriaInterface::class);
        $this->filterGroup = $this->createMock(FilterGroup::class);
        $this->collection = $this->createMock(Collection::class);
        $this->sizeListRepo = new SizeListRepo(
            $this->searchResultsFactory,
            $this->collectionFactory
        );
    }

    /**
     * @covers \Harriswebworks\Sizing\Model\SizeListRepo::getList
     * @covers \Harriswebworks\Sizing\Model\SizeListRepo::addFilterGroupToCollection
     * @covers \Harriswebworks\Sizing\Model\SizeListRepo::__construct
     */
    public function testGetList()
    {
        /** @var SearchCriteriaInterface | MockObject $searchCriteria */
        $searchCriteria = $this->createMock(SearchCriteriaInterface::class);
        $searchResults = $this->createMock(SizeSearchResultInterface::class);
        $searchResults->expects($this->once())->method('setSearchCriteria');
        $this->searchResultsFactory->method('create')->willReturn($searchResults);

        $searchCriteria->method('getFilterGroups')->willReturn($this->getGroupFiltersMock());
        $searchCriteria->method('getSortOrders')->willReturn($this->getSortOrdersMock());

        $collection = $this->createMock(Collection::class);
        $collection->method('getItems')->willReturn([
            $this->getSizeMock(),
            $this->getSizeMock(),
        ]);
        $collection->expects($this->once())->method('addStoreFilter');
        $collection->expects($this->once())->method('addFieldToFilter');
        $collection->expects($this->exactly(2))->method('addOrder');
        $this->collectionFactory->method('create')->willReturn($collection);

        $searchResults->expects($this->once())->method('setTotalCount');
        $searchResults->expects($this->once())->method('setItems')->willReturnSelf();

        $this->assertEquals($searchResults, $this->sizeListRepo->getList($searchCriteria));
    }

    /**
     * @return array
     */
    private function getGroupFiltersMock(): array
    {
        $filterGroup = $this->createMock(FilterGroup::class);
        $filter1 = $this->createMock(Filter::class);
        $filter2 = $this->createMock(Filter::class);
        $filter2->method('getField')->willReturn('store');
        $filterGroup->method('getFilters')->willReturn([
            $filter1,
            $filter2
        ]);
        return [$filterGroup];
    }

    /**
     * @return array
     */
    private function getSortOrdersMock(): array
    {
        return [
            $this->createMock(SortOrder::class),
            $this->createMock(SortOrder::class)
        ];
    }

    /**
     * @return MockObject
     */
    private function getSizeMock(): MockObject
    {
        $mock = $this->createMock(Size::class);
        $mock->method('getData')->willReturn([]);
        return $mock;
    }
}
