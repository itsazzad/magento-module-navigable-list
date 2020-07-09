<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Test\Unit\Block\Adminhtml\Button;

use Harriswebworks\Sizing\Block\Adminhtml\Button\Back;
use Harriswebworks\Sizing\Ui\EntityUiConfig;
use Magento\Framework\UrlInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class BackTest extends TestCase
{
    /**
     * @var UrlInterface | MockObject
     */
    private $url;
    /**
     * @var EntityUiConfig | MockObject
     */
    private $uiConfig;

    /**
     * setup tests
     */
    protected function setUp(): void
    {
        $this->url = $this->createMock(UrlInterface::class);
        $this->uiConfig = $this->createMock(EntityUiConfig::class);
    }

    /**
     * @covers \Harriswebworks\Sizing\Block\Adminhtml\Button\Back::getButtonData
     * @covers \Harriswebworks\Sizing\Block\Adminhtml\Button\Back::getLabel
     * @covers \Harriswebworks\Sizing\Block\Adminhtml\Button\Back::__construct
     */
    public function testGetButtonData()
    {
        $back = new Back($this->url, $this->uiConfig);
        $this->uiConfig->method('getBackLabel')->willReturn('Back to list');
        $this->url->method('getUrl')->willReturn('url');
        $result = $back->getButtonData();
        $this->assertEquals('Back to list', $result['label']);
        $this->assertEquals("location.href = 'url';", $result['on_click']);
    }

    /**
     * @covers \Harriswebworks\Sizing\Block\Adminhtml\Button\Back::getButtonData
     * @covers \Harriswebworks\Sizing\Block\Adminhtml\Button\Back::getLabel
     * @covers \Harriswebworks\Sizing\Block\Adminhtml\Button\Back::__construct
     */
    public function testGetButtonDataNoUiConfig()
    {
        $back = new Back($this->url);
        $this->url->method('getUrl')->willReturn('url');
        $result = $back->getButtonData();
        $this->assertEquals('Back', $result['label']);
        $this->assertEquals("location.href = 'url';", $result['on_click']);
    }
}
