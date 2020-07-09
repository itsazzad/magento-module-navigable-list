<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Ui\SaveDataProcessor;

use Harriswebworks\Sizing\Ui\SaveDataProcessorInterface;

class NullProcessor implements SaveDataProcessorInterface
{
    /**
     * @param array $data
     * @return array
     */
    public function modifyData(array $data): array
    {
        return $data;
    }
}
