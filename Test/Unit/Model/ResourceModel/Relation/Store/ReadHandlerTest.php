<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Test\Unit\Model\ResourceModel\Relation\Store;

use Harriswebworks\Sizing\Model\ResourceModel\Relation\Store\ReadHandler;
use Harriswebworks\Sizing\Model\ResourceModel\StoreAwareAbstractModel;
use Magento\Framework\Model\AbstractModel;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ReadHandlerTest extends TestCase
{
    /**
     * @var StoreAwareAbstractModel | MockObject
     */
    private $resource;
    /**
     * @var ReadHandler
     */
    private $readHandler;

    /**
     * setup tests
     */
    protected function setUp(): void
    {
        $this->resource = $this->createMock(StoreAwareAbstractModel::class);
        $this->readHandler = new ReadHandler($this->resource);
    }

    /**
     * @covers \Harriswebworks\Sizing\Model\ResourceModel\Relation\Store\ReadHandler::execute
     * @covers \Harriswebworks\Sizing\Model\ResourceModel\Relation\Store\ReadHandler::__construct
     */
    public function testExecute()
    {
        $entity = $this->createMock(AbstractModel::class);
        $entity->method('getId')->willReturn(1);
        $this->resource->expects($this->once())->method('lookupStoreIds')->willReturn([1, 3]);
        $entity->expects($this->once())->method('setData')->with('store_id', [1, 3]);
        $this->assertEquals($entity, $this->readHandler->execute($entity));
    }

    /**
     * @covers \Harriswebworks\Sizing\Model\ResourceModel\Relation\Store\ReadHandler::execute
     * @covers \Harriswebworks\Sizing\Model\ResourceModel\Relation\Store\ReadHandler::__construct
     */
    public function testExecuteNoId()
    {
        $entity = $this->createMock(AbstractModel::class);
        $entity->method('getId')->willReturn(null);
        $this->resource->expects($this->never())->method('lookupStoreIds');
        $entity->expects($this->never())->method('setData');
        $this->assertEquals($entity, $this->readHandler->execute($entity));
    }
}
