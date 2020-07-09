<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Test\Unit\Ui\Form\DataModifier;

use Harriswebworks\Sizing\Ui\Form\DataModifier\NullModifier;
use Magento\Framework\Model\AbstractModel;
use PHPUnit\Framework\TestCase;

class NullModifierTest extends TestCase
{
    /**
     * @covers \Harriswebworks\Sizing\Ui\Form\DataModifier\NullModifier::modifyData
     */
    public function testModifyData()
    {
        $model = $this->createMock(AbstractModel::class);
        $data = ['dummy'];
        $this->assertEquals($data, (new NullModifier())->modifyData($model, $data));
    }
}
