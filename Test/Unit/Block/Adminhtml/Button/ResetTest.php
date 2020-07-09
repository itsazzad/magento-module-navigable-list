<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Test\Unit\Block\Adminhtml\Button;

use Harriswebworks\Sizing\Block\Adminhtml\Button\Reset;
use PHPUnit\Framework\TestCase;

class ResetTest extends TestCase
{
    /**
     * @covers \Harriswebworks\Sizing\Block\Adminhtml\Button\Reset::getButtonData
     */
    public function testGetButtonData()
    {
        $reset = new Reset();
        $result = $reset->getButtonData();
        $this->assertEquals(__('Reset'), $result['label']);
        $this->assertEquals("location.reload();", $result['on_click']);
    }
}
