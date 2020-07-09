<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Ui;

interface SaveDataProcessorInterface
{
    /**
     * @param array $aata
     * @return array
     */
    public function modifyData(array $data): array;
}
