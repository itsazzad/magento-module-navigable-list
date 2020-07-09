<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Test\Unit\Model;

use Harriswebworks\Sizing\Model\Size;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class SizeTest extends TestCase
{
    /**
     * @var Context | MockObject
     */
    private $context;
    /**
     * @var Registry | MockObject
     */
    private $registry;
    /**
     * @var AbstractResource | MockObject
     */
    private $resource;
    /**
     * @var AbstractDb | MockObject
     */
    private $resourceCollection;
    /**
     * @var Size
     */
    private $size;

    /**
     * setup tests
     */
    protected function setUp(): void
    {
        $this->context = $this->createMock(Context::class);
        $this->registry = $this->createMock(Registry::class);
        $this->resource = $this->createMock(\Harriswebworks\Sizing\Model\ResourceModel\Size::class);
        $this->resourceCollection = $this->createMock(AbstractDb::class);
        $this->size = new Size(
            $this->context,
            $this->registry,
            $this->resource,
            $this->resourceCollection,
            []
        );
    }

    /**
     * @covers \Harriswebworks\Sizing\Model\Size::getSizeId
     * @covers \Harriswebworks\Sizing\Model\Size::setSizeId
     * @covers \Harriswebworks\Sizing\Model\Size::_construct
     */
    public function testGetSizeId()
    {
        $this->size->setSizeId(1);
        $this->assertEquals(1, $this->size->getSizeId());
    }

    /**
     * @covers \Harriswebworks\Sizing\Model\Size::setSize
     * @covers \Harriswebworks\Sizing\Model\Size::getSize
     * @covers \Harriswebworks\Sizing\Model\Size::_construct
     */
    public function testSetSize()
    {
        $this->size->setSize('size');
        $this->assertEquals('size', $this->size->getSize());
    }

    /**
     * @covers \Harriswebworks\Sizing\Model\Size::setDescription
     * @covers \Harriswebworks\Sizing\Model\Size::getDescription
     * @covers \Harriswebworks\Sizing\Model\Size::_construct
     */
    public function testSetDescription()
    {
        $this->size->setDescription('description');
        $this->assertEquals('description', $this->size->getDescription());
    }

    /**
     * @covers \Harriswebworks\Sizing\Model\Size::setOrder
     * @covers \Harriswebworks\Sizing\Model\Size::getOrder
     * @covers \Harriswebworks\Sizing\Model\Size::_construct
     */
    public function testSetOrder()
    {
        $this->size->setOrder('order');
        $this->assertEquals('order', $this->size->getOrder());
    }

    /**
     * @covers \Harriswebworks\Sizing\Model\Size::setStoreId
     * @covers \Harriswebworks\Sizing\Model\Size::getStoreId
     * @covers \Harriswebworks\Sizing\Model\Size::_construct
     */
    public function testSetStoreId()
    {
        $this->size->setStoreId([0, 1]);
        $this->assertEquals([0, 1], $this->size->getStoreId());
    }

    /**
     * @covers \Harriswebworks\Sizing\Model\Size::setMetaTitle
     * @covers \Harriswebworks\Sizing\Model\Size::getMetaTitle
     * @covers \Harriswebworks\Sizing\Model\Size::_construct
     */
    public function testSetMetaTitle()
    {
        $this->size->setMetaTitle('meta_title');
        $this->assertEquals('meta_title', $this->size->getMetaTitle());
    }

    /**
     * @covers \Harriswebworks\Sizing\Model\Size::setMetaKeywords
     * @covers \Harriswebworks\Sizing\Model\Size::getMetaKeywords
     * @covers \Harriswebworks\Sizing\Model\Size::_construct
     */
    public function testSetMetaKeywords()
    {
        $this->size->setMetaKeywords('meta_keywords');
        $this->assertEquals('meta_keywords', $this->size->getMetaKeywords());
    }

    /**
     * @covers \Harriswebworks\Sizing\Model\Size::getMetaDescription
     * @covers \Harriswebworks\Sizing\Model\Size::setMetaDescription
     * @covers \Harriswebworks\Sizing\Model\Size::_construct
     */
    public function testSetMetaDescription()
    {
        $this->size->setMetaDescription('meta_description');
        $this->assertEquals('meta_description', $this->size->getMetaDescription());
    }

    /**
     * @covers \Harriswebworks\Sizing\Model\Size::getIsActive
     * @covers \Harriswebworks\Sizing\Model\Size::setIsActive
     * @covers \Harriswebworks\Sizing\Model\Size::_construct
     */
    public function testSetIsActive()
    {
        $this->size->setIsActive(1);
        $this->assertEquals(1, $this->size->getIsActive());
    }

    /**
     * @covers \Harriswebworks\Sizing\Model\Size::getIdentities
     * @covers \Harriswebworks\Sizing\Model\Size::_construct
     */
    public function testGetIdentities()
    {
        $this->assertEquals(['harriswebworks_sizing_size_'], $this->size->getIdentities());
        $this->size->setId(1);
        $this->assertEquals(['harriswebworks_sizing_size_1'], $this->size->getIdentities());
    }
}
