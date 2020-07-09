<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Test\Unit\Model\Search;

use Harriswebworks\Sizing\Model\ResourceModel\Size\Collection;
use Harriswebworks\Sizing\Model\ResourceModel\Size\CollectionFactory;
use Harriswebworks\Sizing\Model\Search\Size;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Magento\Framework\UrlInterface;
use PHPUnit\Framework\TestCase;

class SizeTest extends TestCase
{
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;
    /**
     * @var UrlInterface
     */
    private $url;
    /**
     * @var Size
     */
    private $size;

    /**
     * setup tests
     */
    protected function setUp(): void
    {
        $this->collectionFactory = $this->createMock(CollectionFactory::class);
        $this->url = $this->createMock(UrlInterface::class);
        $this->size = new Size($this->collectionFactory, $this->url, []);
    }

    /**
     * @covers \Harriswebworks\Sizing\Model\Search\Size::load
     * @covers \Harriswebworks\Sizing\Model\Search\Size::__construct
     */
    public function testLoadNotValid()
    {
        $this->collectionFactory->expects($this->never())->method('create');
        $this->assertEquals($this->size, $this->size->load());
    }

    /**
     * @covers \Harriswebworks\Sizing\Model\Search\Size::load
     * @covers \Harriswebworks\Sizing\Model\Search\Size::__construct
     */
    public function testLoad()
    {
        $om = new ObjectManager($this);
        $collection = $om->getCollectionMock(
            Collection::class,
            [
                $this->createMock(\Harriswebworks\Sizing\Model\Size::class),
                $this->createMock(\Harriswebworks\Sizing\Model\Size::class)
            ]
        );
        $this->collectionFactory->expects($this->once())->method('create')->willReturn($collection);
        $this->url->expects($this->exactly(3))->method('getUrl');
        $this->size->addData(['start' => 1, 'limit' => 1, 'query' => 'q']);
        $this->assertEquals($this->size, $this->size->load());
    }
}
