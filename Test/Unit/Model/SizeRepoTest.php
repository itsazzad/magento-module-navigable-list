<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Test\Unit\Model;

use Harriswebworks\Sizing\Api\Data\SizeInterfaceFactory;
use Harriswebworks\Sizing\Model\ResourceModel\Size;
use Harriswebworks\Sizing\Model\SizeRepo;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class SizeRepoTest extends TestCase
{
    /**
     * @var SizeInterfaceFactory | MockObject
     */
    private $factory;
    /**
     * @var Size | MockObject
     */
    private $resource;
    /**
     * @var \Harriswebworks\Sizing\Model\Size | MockObject
     */
    private $size;
    /**
     * @var SizeRepo
     */
    private $sizeRepo;

    /**
     * setup tests
     */
    protected function setUp(): void
    {
        $this->factory = $this->createMock(SizeInterfaceFactory::class);
        $this->resource = $this->createMock(Size::class);
        $this->size = $this->createMock(\Harriswebworks\Sizing\Model\Size::class);
        $this->sizeRepo = new SizeRepo(
            $this->factory,
            $this->resource
        );
    }

    /**
     * @covers \Harriswebworks\Sizing\Model\SizeRepo::save
     * @covers \Harriswebworks\Sizing\Model\SizeRepo::__construct
     */
    public function testSave()
    {
        $this->resource->expects($this->once())->method('save');
        $this->assertEquals($this->size, $this->sizeRepo->save($this->size));
    }

    /**
     * @covers \Harriswebworks\Sizing\Model\SizeRepo::save
     * @covers \Harriswebworks\Sizing\Model\SizeRepo::__construct
     */
    public function testSaveWithSaveError()
    {
        $this->expectException(CouldNotSaveException::class);
        $this->resource->expects($this->once())->method('save')->willThrowException(new \Exception());
        $this->sizeRepo->save($this->size);
    }

    /**
     * @covers \Harriswebworks\Sizing\Model\SizeRepo::get
     * @covers \Harriswebworks\Sizing\Model\SizeRepo::__construct
     */
    public function testGet()
    {
        $this->resource->expects($this->once())->method('load');
        $this->factory->method('create')->willReturn($this->size);
        $this->size->method('getId')->willReturn(1);
        $this->assertEquals($this->size, $this->sizeRepo->get(1));
        //call twice to test memoizing
        $this->assertEquals($this->size, $this->sizeRepo->get(1));
    }

    /**
     * @covers \Harriswebworks\Sizing\Model\SizeRepo::get
     * @covers \Harriswebworks\Sizing\Model\SizeRepo::__construct
     */
    public function testGetWithMissingId()
    {
        $this->resource->expects($this->once())->method('load');
        $this->factory->method('create')->willReturn($this->size);
        $this->size->method('getId')->willReturn(null);
        $this->expectException(NoSuchEntityException::class);
        $this->sizeRepo->get(1);
    }

    /**
     * @covers \Harriswebworks\Sizing\Model\SizeRepo::delete
     * @covers \Harriswebworks\Sizing\Model\SizeRepo::__construct
     */
    public function testDelete()
    {
        $this->resource->expects($this->once())->method('delete');
        $this->assertTrue($this->sizeRepo->delete($this->size));
    }

    /**
     * @covers \Harriswebworks\Sizing\Model\SizeRepo::delete
     * @covers \Harriswebworks\Sizing\Model\SizeRepo::__construct
     */
    public function testDeleteWithError()
    {
        $this->resource->expects($this->once())->method('delete')->willThrowException(new \Exception());
        $this->expectException(CouldNotDeleteException::class);
        $this->sizeRepo->delete($this->size);
    }

    /**
     * @covers \Harriswebworks\Sizing\Model\SizeRepo::deleteById
     * @covers \Harriswebworks\Sizing\Model\SizeRepo::__construct
     */
    public function testDeleteById()
    {
        $this->resource->expects($this->once())->method('load');
        $this->factory->method('create')->willReturn($this->size);
        $this->size->method('getId')->willReturn(1);
        $this->resource->expects($this->once())->method('delete');
        $this->assertTrue($this->sizeRepo->deleteById(1));
    }

    /**
     * @covers \Harriswebworks\Sizing\Model\SizeRepo::clear
     * @covers \Harriswebworks\Sizing\Model\SizeRepo::__construct
     */
    public function testClear()
    {
        $this->assertEquals([], $this->sizeRepo->clear());
    }
}
