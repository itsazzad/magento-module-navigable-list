<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Ui;

interface CollectionProviderInterface
{
    /**
     * @return \Harriswebworks\Sizing\Model\ResourceModel\AbstractCollection
     */
    public function getCollection();
}
