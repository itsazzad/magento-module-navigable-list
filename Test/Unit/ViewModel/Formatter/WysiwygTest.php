<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Test\Unit\ViewModel\Formatter;

use Harriswebworks\Sizing\ViewModel\Formatter\Wysiwyg;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class WysiwygTest extends TestCase
{
    /**
     * @var \Zend_Filter_Interface | MockObject
     */
    private $filter;
    /**
     * @var Wysiwyg
     */
    private $wysiwyg;

    /**
     * setup tests
     */
    protected function setUp(): void
    {
        $this->filter = $this->createMock(\Zend_Filter_Interface::class);
        $this->wysiwyg = new Wysiwyg($this->filter);
    }

    /**
     * @covers \Harriswebworks\Sizing\ViewModel\Formatter\Wysiwyg::formatHtml
     * @covers \Harriswebworks\Sizing\ViewModel\Formatter\Wysiwyg::__construct
     */
    public function testFormatHtml()
    {
        $this->filter->expects($this->once())->method('filter')->willReturn('filtered');
        $this->assertEquals('filtered', $this->wysiwyg->formatHtml('value'));
    }
}
