<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Test\Unit\ViewModel\Size;

use Harriswebworks\Sizing\Api\Data\SizeInterface;
use Harriswebworks\Sizing\Api\SizeRepositoryInterface;
use Harriswebworks\Sizing\ViewModel\Size\View;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ViewTest extends TestCase
{
    /**
     * @var RequestInterface | MockObject
     */
    private $request;
    /**
     * @var SizeRepositoryInterface | MockObject
     */
    private $sizeRepository;
    /**
     * @var View
     */
    private $view;

    /**
     * setup tests
     */
    protected function setUp(): void
    {
        $this->request = $this->createMock(RequestInterface::class);
        $this->sizeRepository = $this->createMock(SizeRepositoryInterface::class);
        $this->view = new View(
            $this->request,
            $this->sizeRepository
        );
    }

    /**
     * @covers \Harriswebworks\Sizing\ViewModel\Size\View::getSize
     * @covers \Harriswebworks\Sizing\ViewModel\Size\View::__construct
     */
    public function testGetSize()
    {
        $this->request->expects($this->once())->method('getParam')->willReturn(1);
        $size = $this->createMock(SizeInterface::class);
        $this->sizeRepository->expects($this->once())->method('get')->willReturn($size);
        $this->assertEquals($size, $this->view->getSize());
        //call twice to test memoizing
        $this->assertEquals($size, $this->view->getSize());
    }

    /**
     * @covers \Harriswebworks\Sizing\ViewModel\Size\View::getSize
     * @covers \Harriswebworks\Sizing\ViewModel\Size\View::__construct
     */
    public function testGetSizeWithException()
    {
        $this->request->expects($this->once())->method('getParam')->willReturn(1);
        $this->sizeRepository->expects($this->once())->method('get')->willThrowException(
            $this->createMock(NoSuchEntityException::class)
        );
        $this->assertFalse($this->view->getSize());
        //call twice to test memoizing
        $this->assertFalse($this->view->getSize());
    }

    /**
     * @covers \Harriswebworks\Sizing\ViewModel\Size\View::getSize
     * @covers \Harriswebworks\Sizing\ViewModel\Size\View::__construct
     */
    public function testGetSizeNoId()
    {
        $this->request->expects($this->once())->method('getParam')->willReturn(null);
        $this->sizeRepository->expects($this->never())->method('get');
        $this->assertFalse($this->view->getSize());
        //call twice to test memoizing
        $this->assertFalse($this->view->getSize());
    }
}
