<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Test\Unit\Model;

use Harriswebworks\Sizing\Api\sizeRepositoryInterface;
use Harriswebworks\Sizing\Model\Size;
use Harriswebworks\Sizing\Model\SizeFactory;
use Harriswebworks\Sizing\Model\SizeUiManager;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class SizeUiManagerTest extends TestCase
{
    /**
     * @var SizeRepositoryInterface | MockObject
     */
    private $repository;
    /**
     * @var SizeFactory | MockObject
     */
    private $factory;
    /**
     * @var Size | MockObject
     */
    private $size;
    /**
     * @var SizeUiManager
     */
    private $sizeUiManager;

    /**
     * setup tests
     */
    protected function setUp(): void
    {
        $this->repository = $this->createMock(SizeRepositoryInterface::class);
        $this->factory = $this->createMock(SizeFactory::class);
        $this->size = $this->createMock(Size::class);
        $this->sizeUiManager = new SizeUiManager(
            $this->repository,
            $this->factory
        );
    }

    /**
     * @covers \Harriswebworks\Sizing\Model\SizeUiManager::get
     * @covers \Harriswebworks\Sizing\Model\SizeUiManager::__construct
     */
    public function testGetWithId()
    {
        $this->repository->expects($this->once())->method('get')->with(1)->willReturn($this->size);
        $this->factory->expects($this->never())->method('create');
        $this->assertEquals($this->size, $this->sizeUiManager->get(1));
    }

    /**
     * @covers \Harriswebworks\Sizing\Model\SizeUiManager::get
     * @covers \Harriswebworks\Sizing\Model\SizeUiManager::__construct
     */
    public function testGetWithoutId()
    {
        $this->repository->expects($this->never())->method('get');
        $this->factory->expects($this->once())->method('create')->willReturn($this->size);
        $this->assertEquals($this->size, $this->sizeUiManager->get(null));
    }

    /**
     * @covers \Harriswebworks\Sizing\Model\SizeUiManager::save
     * @covers \Harriswebworks\Sizing\Model\SizeUiManager::__construct
     */
    public function testSave()
    {
        $this->repository->expects($this->once())->method('save');
        $this->sizeUiManager->save($this->size);
    }

    /**
     * @covers \Harriswebworks\Sizing\Model\SizeUiManager::delete
     * @covers \Harriswebworks\Sizing\Model\SizeUiManager::__construct
     */
    public function testDelete()
    {
        $this->repository->expects($this->once())->method('deleteById')->with(1);
        $this->sizeUiManager->delete(1);
    }
}
