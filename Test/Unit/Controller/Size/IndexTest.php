<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Test\Unit\Controller\Size;

use Harriswebworks\Sizing\Controller\Size\Index;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\LayoutInterface;
use Magento\Framework\View\Page\Config;
use Magento\Framework\View\Page\Title;
use Magento\Framework\View\Result\Page;
use Magento\Theme\Block\Html\Breadcrumbs;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class IndexTest extends TestCase
{
    /**
     * arvar Context | MockObject
     */
    private $context;
    /**
     * @var ScopeConfigInterface | MockObject
     */
    private $scopeConfig;
    /**
     * @var RequestInterface | MockObject
     */
    private $request;
    /**
     * @var ResultFactory | MockObject
     */
    private $resultFactory;
    /**
     * @var Page | MockObject
     */
    private $result;
    /**
     * @var Config | MockObject
     */
    private $pageConfig;
    /**
     * @var Title | MockObject
     */
    private $pageTitle;
    /**
     * @var LayoutInterface | MockObject
     */
    private $layout;
    /**
     * @var UrlInterface | MockObject
     */
    private $url;
    /**
     * @var Index
     */
    private $index;

    /**
     * setup tests
     */
    protected function setUp(): void
    {
        $this->context = $this->createMock(Context::class);
        $this->layout = $this->createMock(LayoutInterface::class);
        $this->scopeConfig = $this->createMock(ScopeConfigInterface::class);
        $this->request = $this->createMock(RequestInterface::class);
        $this->resultFactory = $this->createMock(ResultFactory::class);
        $this->result = $this->createMock(Page::class);
        $this->resultFactory->method('create')->willReturn($this->result);
        $this->context->method('getResultFactory')->willReturn($this->resultFactory);
        $this->pageConfig = $this->createMock(Config::class);
        $this->result->method('getConfig')->willReturn($this->pageConfig);
        $this->pageTitle = $this->createMock(Title::class);
        $this->pageConfig->method('getTitle')->willReturn($this->pageTitle);
        $this->result->method('getLayout')->willReturn($this->layout);
        $this->url = $this->createMock(UrlInterface::class);
        $this->context->method('getUrl')->willReturn($this->url);

        $this->index = new Index(
            $this->context,
            $this->scopeConfig
        );
    }

    /**
     * @covers \Harriswebworks\Sizing\Controller\Size\Index::execute
     * @covers \Harriswebworks\Sizing\Controller\Size\Index::__construct
     */
    public function testExecute()
    {
        $this->pageTitle->expects($this->once())->method('set');
        $this->pageConfig->expects($this->once())->method('setDescription');
        $this->pageConfig->expects($this->once())->method('setKeywords');
        $this->scopeConfig->method('isSetFlag')->willReturn(true);
        $crumbs = $this->createMock(Breadcrumbs::class);
        $this->layout->expects($this->once())->method('getBlock')->willReturn($crumbs);
        $crumbs->expects($this->exactly(2))->method('addCrumb');
        $this->assertEquals($this->result, $this->index->execute());
    }

    /**
     * @covers \Harriswebworks\Sizing\Controller\Size\Index::execute
     * @covers \Harriswebworks\Sizing\Controller\Size\Index::__construct
     */
    public function testExecuteNoBreadcrumbs()
    {
        $this->scopeConfig->method('isSetFlag')->willReturn(false);
        $this->layout->expects($this->never())->method('getBlock');
        $this->assertEquals($this->result, $this->index->execute());
    }
}
