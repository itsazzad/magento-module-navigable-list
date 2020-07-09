<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Test\Unit\Model;

use Harriswebworks\Sizing\Model\ResourceModel\Size\Collection;
use Harriswebworks\Sizing\Model\ResourceModel\Size\CollectionFactory;
use Harriswebworks\Sizing\Model\SizeUiCollectionProvider;
use PHPUnit\Framework\TestCase;

class SizeUiCollectionProviderTest extends TestCase
{
    /**
     * @covers \Harriswebworks\Sizing\Model\SizeUiCollectionProvider
     */
    public function testGetCollection()
    {
        $factory = $this->createMock(CollectionFactory::class);
        $collection = $this->createMock(Collection::class);
        $factory->expects($this->once())->method('create')->willReturn($collection);
        $provider = new sizeUiCollectionProvider($factory);
        $this->assertEquals($collection, $provider->getCollection());
    }
}
