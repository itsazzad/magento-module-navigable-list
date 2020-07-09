<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Test\Unit\ViewModel\Size;

use Harriswebworks\Sizing\Api\Data\SizeInterface;
use Harriswebworks\Sizing\ViewModel\Size\Url;
use Magento\Framework\UrlInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class UrlTest extends TestCase
{
    /**
     * @var UrlInterface | MockObject
     */
    private $urlBuilder;
    /**
     * @var SizeInterface | MockObject
     */
    private $size;
    /**
     * @var Url
     */
    private $url;

    /**
     * setup tests
     */
    protected function setUp(): void
    {
        $this->urlBuilder = $this->createMock(UrlInterface::class);
        $this->size = $this->createMock(SizeInterface::class);
        $this->url = new Url($this->urlBuilder);
    }

    /**
     * @covers \Harriswebworks\Sizing\ViewModel\Size\Url::getListUrl
     * @covers \Harriswebworks\Sizing\ViewModel\Size\Url::__construct
     */
    public function testGetListUrl()
    {
        $this->urlBuilder->expects($this->once())->method('getUrl')->willReturnArgument(0);
        $this->assertEquals('sizing/size/index', $this->url->getListUrl());
    }

    /**
     * @covers \Harriswebworks\Sizing\ViewModel\Size\Url::getSizeUrl
     * @covers \Harriswebworks\Sizing\ViewModel\Size\Url::getSizeUrlById
     * @covers \Harriswebworks\Sizing\ViewModel\Size\Url::__construct
     */
    public function testGetSizeUrl()
    {
        $size = $this->createMock(SizeInterface::class);
        $size->method('getId')->willReturn(1);
        $this->urlBuilder->expects($this->once())->method('getUrl')
            ->with('sizing/size/view', ['id' => 1])
            ->willReturn('url');
        $this->assertEquals('url', $this->url->getSizeUrl($size));
    }

    /**
     * @covers \Harriswebworks\Sizing\ViewModel\Size\Url::getSizeUrlById
     * @covers \Harriswebworks\Sizing\ViewModel\Size\Url::__construct
     */
    public function testGetSizeUrlById()
    {
        $this->urlBuilder->expects($this->once())->method('getUrl')
            ->with('sizing/size/view', ['id' => 1])
            ->willReturn('url');
        $this->assertEquals('url', $this->url->getSizeUrlById(1));
    }
}
