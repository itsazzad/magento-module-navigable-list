<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Test\Unit\Model\ResourceModel;

use Harriswebworks\Sizing\Model\ResourceModel\AbstractModel;
use Magento\Framework\EntityManager\EntityManager;
use Magento\Framework\EntityManager\EntityMetadataInterface;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\Model\AbstractModel as FrameworkAbstractModel;
use Magento\Framework\Model\ResourceModel\Db\Context;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class AbstractModelTest extends TestCase
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
     * @var FrameworkAbstractModel | MockObject
     */
    private $object;
    /**
     * @var EntityMetadataInterface | MockObject
     */
    private $metadata;
    /**
     * @var object
     */
    private $abstractModelClass;
    /**
     * @var AbstractModel
     */
    private $abstractModel;

    /**
     * setup tests
     */
    protected function setUp(): void
    {
        $this->context = $this->createMock(Context::class);
        $this->entityManager = $this->createMock(EntityManager::class);
        $this->metadataPool = $this->createMock(MetadataPool::class);
        $this->object = $this->createMock(FrameworkAbstractModel::class);
        $this->metadata = $this->createMock(EntityMetadataInterface::class);
        $this->abstractModelClass = new class (
            $this->context,
            $this->entityManager,
            $this->metadataPool,
            'InterfaceName'
        ) extends AbstractModel
        {
            //phpcs:disable PSR2.Methods.MethodDeclaration.Underscore,PSR12.Methods.MethodDeclaration.Underscore
            protected function _construct()
            {
            }
            //phpcs:enable
        };
        $this->abstractModel = new $this->abstractModelClass(
            $this->context,
            $this->entityManager,
            $this->metadataPool,
            'InterfaceName'
        );
    }

    /**
     * @covers \Harriswebworks\Sizing\Model\ResourceModel\AbstractModel::save
     * @covers \Harriswebworks\Sizing\Model\ResourceModel\AbstractModel::__construct
     */
    public function testSave()
    {
        $this->entityManager->expects($this->once())->method('save');
        $this->assertEquals($this->abstractModel, $this->abstractModel->save($this->object));
    }

    /**
     * @covers \Harriswebworks\Sizing\Model\ResourceModel\AbstractModel::delete
     * @covers \Harriswebworks\Sizing\Model\ResourceModel\AbstractModel::__construct
     */
    public function testDelete()
    {
        $this->entityManager->expects($this->once())->method('delete');
        $this->assertEquals($this->abstractModel, $this->abstractModel->delete($this->object));
    }

    /**
     * @covers \Harriswebworks\Sizing\Model\ResourceModel\AbstractModel::load
     * @covers \Harriswebworks\Sizing\Model\ResourceModel\AbstractModel::__construct
     */
    public function testLoad()
    {
        $this->entityManager->expects($this->once())->method('load');
        $this->assertEquals($this->abstractModel, $this->abstractModel->load($this->object, 1));
    }

    /**
     * @covers \Harriswebworks\Sizing\Model\ResourceModel\AbstractModel::getConnection
     * @covers \Harriswebworks\Sizing\Model\ResourceModel\AbstractModel::__construct
     */
    public function testGetConnection()
    {
        $this->metadataPool->expects($this->once())->method('getMetadata')->with('InterfaceName')
            ->willReturn($this->metadata);
        $this->metadata->expects($this->once())->method('getEntityConnection')->willReturn('connection');
        $this->assertEquals('connection', $this->abstractModel->getConnection());
    }
}
