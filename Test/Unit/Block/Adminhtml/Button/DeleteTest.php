<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Test\Unit\Block\Adminhtml\Button;

use Harriswebworks\Sizing\Block\Adminhtml\Button\Delete;
use Harriswebworks\Sizing\Ui\EntityUiConfig;
use Harriswebworks\Sizing\Ui\EntityUiManagerInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\UrlInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class DeleteTest extends TestCase
{
    /**
     * @var RequestInterface | MockObject
     */
    private $request;
    /**
     * @var EntityUiManagerInterface | MockObject
     */
    private $entityUiManager;
    /**
     * @var EntityUiConfig | MockObject
     */
    private $uiConfig;
    /**
     * @var UrlInterface | MockObject
     */
    private $url;
    /**
     * @var Delete
     */
    private $delete;

    /**
     * setup tests
     */
    protected function setUp(): void
    {
        $this->request = $this->createMock(RequestInterface::class);
        $this->entityUiManager = $this->createMock(EntityUiManagerInterface::class);
        $this->uiConfig = $this->createMock(EntityUiConfig::class);
        $this->url = $this->createMock(UrlInterface::class);
        $this->delete = new Delete(
            $this->request,
            $this->entityUiManager,
            $this->uiConfig,
            $this->url
        );
    }

    /**
     * @covers \Harriswebworks\Sizing\Block\Adminhtml\Button\Delete::getButtonData
     * @covers \Harriswebworks\Sizing\Block\Adminhtml\Button\Delete::getDeleteUrl
     * @covers \Harriswebworks\Sizing\Block\Adminhtml\Button\Delete::getEntityId
     * @covers \Harriswebworks\Sizing\Block\Adminhtml\Button\Delete::__construct
     */
    public function testGetButtonData()
    {
        $entity = $this->createMock(AbstractModel::class);
        $entity->method('getId')->willReturn(1);
        $this->entityUiManager->method('get')->willReturn($entity);
        $this->url->expects($this->once())->method('getUrl')->willReturn('url');
        $result = $this->delete->getButtonData();
        $this->assertArrayHasKey('label', $result);
        $this->assertArrayHasKey('on_click', $result);
    }

    /**
     * @covers \Harriswebworks\Sizing\Block\Adminhtml\Button\Delete::getButtonData
     * @covers \Harriswebworks\Sizing\Block\Adminhtml\Button\Delete::getEntityId
     * @covers \Harriswebworks\Sizing\Block\Adminhtml\Button\Delete::__construct
     */
    public function testGetButtonNoEntity()
    {
        $this->entityUiManager->method('get')->willThrowException(
            $this->createMock(NoSuchEntityException::class)
        );
        $this->url->expects($this->never())->method('getUrl');
        $this->assertEquals([], $this->delete->getButtonData());
    }
}
