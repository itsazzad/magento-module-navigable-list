<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Test\Unit\Model\ResourceModel\Relation\Store;

use Harriswebworks\Sizing\Model\ResourceModel\Relation\Store\SaveHandler;
use Harriswebworks\Sizing\Model\ResourceModel\StoreAwareAbstractModel;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\EntityManager\EntityMetadataInterface;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\Model\AbstractModel;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class SaveHandlerTest extends TestCase
{
    /**
     * @var MetadataPool | MockObject
     */
    private $metadataPool;
    /**
     * @var StoreAwareAbstractModel | MockObject
     */
    private $resource;
    /**
     * @var SaveHandler
     */
    private $saveHandler;
    /**
     * @var EntityMetadataInterface | MockObject
     */
    private $metadata;
    /**
     * @var AdapterInterface | MockObject
     */
    private $connection;
    /**
     * @var AbstractModel | MockObject
     */
    private $entity;

    /**
     * setup tests
     */
    protected function setUp(): void
    {
        $this->metadataPool = $this->createMock(MetadataPool::class);
        $this->resource = $this->createMock(StoreAwareAbstractModel::class);
        $this->metadata = $this->createMock(EntityMetadataInterface::class);
        $this->metadataPool->method('getMetadata')->willReturn($this->metadata);
        $this->connection = $this->createMock(AdapterInterface::class);
        $this->resource->method('getConnection')->willReturn($this->connection);
        $this->entity = $this->createMock(AbstractModel::class);
        $this->saveHandler = new SaveHandler(
            $this->metadataPool,
            $this->resource,
            'entityType',
            'store_table',
            'store_id'
        );
    }

    /**
     * @covers \Harriswebworks\Sizing\Model\ResourceModel\Relation\Store\SaveHandler::execute
     * @covers \Harriswebworks\Sizing\Model\ResourceModel\Relation\Store\SaveHandler::__construct
     */
    public function testExecute()
    {
        $this->metadata->method('getLinkField')->willReturn('entity_id');
        $this->resource->method('lookupStoreIds')->willReturn([1, 2, 3]);
        $this->entity->method('getData')->willReturnMap([
            ['store_id', null, [1, 2, 4, 5]],
            ['entity_id', null, 1]
        ]);
        $this->connection->expects($this->once())->method('delete');
        $this->connection->expects($this->once())->method('insertMultiple');
        $this->saveHandler->execute($this->entity);
    }

    /**
     * @covers \Harriswebworks\Sizing\Model\ResourceModel\Relation\Store\SaveHandler::execute
     * @covers \Harriswebworks\Sizing\Model\ResourceModel\Relation\Store\SaveHandler::__construct
     */
    public function testExecuteNoInsert()
    {
        $this->resource->method('lookupStoreIds')->willReturn([1, 2, 3]);
        $this->entity->method('getData')->willReturnMap([
            ['store_id', null, [1, 2]],
            ['entity_id', null, 1]
        ]);
        $this->connection->expects($this->once())->method('delete');
        $this->connection->expects($this->never())->method('insertMultiple');
        $this->saveHandler->execute($this->entity);
    }
}
