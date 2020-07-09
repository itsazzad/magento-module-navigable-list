<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Test\Unit\Ui\Form;

use Harriswebworks\Sizing\Ui\CollectionProviderInterface;
use Harriswebworks\Sizing\Ui\EntityUiConfig;
use Harriswebworks\Sizing\Ui\Form\DataModifierInterface;
use Harriswebworks\Sizing\Ui\Form\DataProvider;
use Magento\Framework\Api\Filter;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class DataProviderTest extends TestCase
{
    /**
     * @var CollectionProviderInterface | MockObject
     */
    private $collectionProvider;
    /**
     * @var DataPersistorInterface | MockObject
     */
    private $dataPersistor;
    /**
     * @var DataModifierInterface | MockObject
     */
    private $dataModifier;
    /**
     * @var EntityUiConfig | MockObject
     */
    private $uiConfig;
    /**
     * @var Filter | MockObject
     */
    private $filter;
    /**
     * @var DataProvider
     */
    private $dataProvider;
    /**
     * @var AbstractDb | MockObject
     */
    private $collection;

    /**
     * setup tests
     */
    protected function setUp(): void
    {
        $this->collectionProvider = $this->createMock(CollectionProviderInterface::class);
        $this->dataPersistor = $this->createMock(DataPersistorInterface::class);
        $this->dataModifier = $this->createMock(DataModifierInterface::class);
        $this->uiConfig = $this->createMock(EntityUiConfig::class);
        $this->filter = $this->createMock(Filter::class);
        $om = new ObjectManager($this);
        $this->collection = $om->getCollectionMock(
            AbstractDb::class,
            [
                $this->getModelMock(1, ['field1' => 'value1']),
                $this->getModelMock(2, ['field2' => 'value2'])
            ]
        );
        $this->collectionProvider->method('getCollection')->willReturn($this->collection);
        $this->dataProvider = new DataProvider(
            'data-provider',
            $this->collectionProvider,
            $this->dataPersistor,
            $this->dataModifier,
            $this->uiConfig,
            [],
            []
        );
    }

    /**
     * @covers \Harriswebworks\Sizing\Ui\Form\DataProvider::getData
     * @covers \Harriswebworks\Sizing\Ui\Form\DataProvider::__construct
     */
    public function testGetData()
    {
        $this->dataModifier->expects($this->exactly(2))->method('modifyData')->willReturnArgument(1);
        $expected = [
            1 => ['field1' => 'value1'],
            2 => ['field2' => 'value2'],
        ];
        $this->assertEquals($expected, $this->dataProvider->getData());
        //call twice to test memoizing
        $this->assertEquals($expected, $this->dataProvider->getData());
    }

    /**
     * @covers \Harriswebworks\Sizing\Ui\Form\DataProvider::getData
     * @covers \Harriswebworks\Sizing\Ui\Form\DataProvider::__construct
     */
    public function testGetDataWithPersistor()
    {
        $newInstance = $this->getModelMock(1, ['field3' => 'value3']);
        $this->collection->method('getNewEmptyItem')->willReturn($newInstance);
        $this->dataPersistor->method('get')->willReturn(['not_empty']);
        $this->dataPersistor->expects($this->once())->method('clear');
        $this->dataModifier->expects($this->exactly(2))->method('modifyData')->willReturnArgument(1);
        $expected = [
            1 => ['field3' => 'value3'],
            2 => ['field2' => 'value2'],
        ];
        $this->assertEquals($expected, $this->dataProvider->getData());
        //call twice to test memoizing
        $this->assertEquals($expected, $this->dataProvider->getData());
    }

    /**
     * @param $id
     * @param $data
     * @return MockObject
     */
    private function getModelMock($id, $data)
    {
        $mock = $this->createMock(AbstractModel::class);
        $mock->method('getId')->willReturn($id);
        $mock->method('getData')->willReturn($data);
        return $mock;
    }
}
