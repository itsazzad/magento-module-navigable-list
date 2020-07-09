<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Ui\Form\DataModifier;

use Harriswebworks\Sizing\Ui\Form\DataModifierInterface;
use Magento\Framework\Model\AbstractModel;

class NullModifier implements DataModifierInterface
{
    /**
     * @param AbstractModel $model
     * @param array $data
     * @return array
     */
    public function modifyData(AbstractModel $model, array $data): array
    {
        return $data;
    }
}
