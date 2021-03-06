<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Test\Unit\Model\ResourceModel;

use Harriswebworks\Sizing\Model\ResourceModel\StoreAwareAbstractModel;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Select;
use Magento\Framework\EntityManager\EntityManager;
use Magento\Framework\EntityManager\EntityMetadataInterface;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Store\Model\StoreManagerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class StoreAwareAbstractModelTest extends TestCase
{
    /**
     * @var Context | MockObject
     */
    private $context;
    /**
     * @var EntityManager | MockObject
     */
    private $entityManager;
    /**
     * @var MetadataPool | MockObject
     */
    private $metadataPool;
    /**
     * @var StoreManagerInterface | MockObject
     */
    private $storeManager;
    /**
     * @var AbstractModel | MockObject
     */
    private $object;
    /**
     * @var StoreAwareAbstractModel
     */
    private $storeAwareAbstractModel;
    /**
     * @var AdapterInterface | MockObject
     */
    private $connection;
    /**
     * @var EntityMetadataInterface | MockObject
     */
    private $metadata;
    /**
     * @var Select | MockObject
     */
    private $select;
    /**
     * @var ResourceConnection | MockObject
     */
    private $resource;

    /**
     * setup tests
     */
    protected function setUp(): void
    {
        $this->context = $this->createMock(Context::class);
        $this->entityManager = $this->createMock(EntityManager::class);
        $this->metadataPool = $this->createMock(MetadataPool::class);
        $this->storeManager = $this->createMock(StoreManagerInterface::class);
        $this->object = $this->createMock(AbstractModel::class);
        $this->connection = $this->createMock(AdapterInterface::class);
        $this->select = $this->createMock(Select::class);
        $this->metadata = $this->createMock(EntityMetadataInterface::class);
        $this->metadata->method('getEntityConnection')->willReturn($this->connection);
        $this->metadataPool->method('getMetadata')->willReturn($this->metadata);
        $this->resource = $this->createMock(ResourceConnection::class);
        $this->context->method('getResources')->willReturn($this->resource);
        $modelClass = new class (
            $this->context,
            $this->entityManager,
            $this->metadataPool,
            'interfaceName',
            $this->storeManager,
            'store_table'
        ) extends StoreAwareAbstractModel
        {
            //phpcs:disable PSR2.Methods.MethodDeclaration.Underscore,PSR12.Methods.MethodDeclaration.Underscore
            protected function _construct()
            {
                $this->_setMainTable('main_table');
            }
            //phpcs:enable
        };
        $this->storeAwareAbstractModel = new $modelClass(
            $this->context,
            $this->entityManager,
            $this->metadataPool,
            'interfaceName',
            $this->storeManager,
            'store_table'
        );
    }

    /**
     * @covers \Harriswebworks\Sizing\Model\ResourceModel\StoreAwareAbstractModel::load
     * @covers \Harriswebworks\Sizing\Model\ResourceModel\StoreAwareAbstractModel::getEntityId
     * @covers \Harriswebworks\Sizing\Model\ResourceModel\StoreAwareAbstractModel::_getLoadSelect
     * @covers \Harriswebworks\Sizing\Model\ResourceModel\StoreAwareAbstractModel::__construct
     */
    public function testLoad()
    {
        $this->connection->method('select')->willReturn($this->select);
        $this->select->method('from')->willReturnSelf();
        $this->select->method('join')->willReturnSelf();
        $this->select->method('where')->willReturnSelf();
        $this->select->method('columns')->willReturnSelf();
        $this->object->method('getData')->with('store_id')->willReturn(1);
        $this->connection->method('fetchCol')->willReturn([1, 2]);
        $this->metadata->method('getLinkField')->willReturn('link_field');
        $this->entityManager->expects($this->once())->method('load')->with($this->object, 1);
        $this->storeAwareAbstractModel->load($this->object, 1);
    }

    /**
     * @covers \Harriswebworks\Sizing\Model\ResourceModel\StoreAwareAbstractModel::load
     * @covers \Harriswebworks\Sizing\Model\ResourceModel\StoreAwareAbstractModel::getEntityId
     * @covers \Harriswebworks\Sizing\Model\ResourceModel\StoreAwareAbstractModel::_getLoadSelect
     * @covers \Harriswebworks\Sizing\Model\ResourceModel\StoreAwareAbstractModel::__construct
     */
    public function testLoadNoResult()
    {
        $this->connection->method('select')->willReturn($this->select);
        $this->select->method('from')->willReturnSelf();
        $this->select->method('join')->willReturnSelf();
        $this->select->method('where')->willReturnSelf();
        $this->select->method('columns')->willReturnSelf();
        $this->object->method('getData')->with('store_id')->willReturn(1);
        $this->connection->method('fetchCol')->willReturn([]);
        $this->metadata->method('getLinkField')->willReturn('link_field');
        $this->entityManager->expects($this->never())->method('load');
        $this->storeAwareAbstractModel->load($this->object, 1, 'field');
    }

    /**
     * @covers \Harriswebworks\Sizing\Model\ResourceModel\StoreAwareAbstractModel::lookupStoreIds
     * @covers \Harriswebworks\Sizing\Model\ResourceModel\StoreAwareAbstractModel::__construct
     */
    public function testLookupStoreIds()
    {
        $this->resource->method('getTableName')->willReturn('main_table');
        $this->connection->expects($this->once())->method('select')->willReturn($this->select);
        $this->select->expects($this->once())->method('from');
        $this->select->expects($this->once())->method('join');
        $this->connection->expects($this->once())->method('fetchCol')->willReturn([1, 2, 3]);
        $this->assertEquals([1, 2, 3], $this->storeAwareAbstractModel->lookupStoreIds(1));
    }
}
