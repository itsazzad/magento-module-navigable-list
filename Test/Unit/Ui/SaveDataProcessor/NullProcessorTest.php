<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Test\Unit\Ui\SaveDataProcessor;

use Harriswebworks\Sizing\Ui\SaveDataProcessor\NullProcessor;
use PHPUnit\Framework\TestCase;

class NullProcessorTest extends TestCase
{
    /**
     * @covers \Harriswebworks\Sizing\Ui\SaveDataProcessor\NullProcessor
     */
    public function testModifyData()
    {
        $data = ['dummy'];
        $this->assertEquals($data, (new NullProcessor())->modifyData($data));
    }
}
