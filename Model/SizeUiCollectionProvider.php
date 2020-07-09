<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Model;

use Harriswebworks\Sizing\Model\ResourceModel\Size\CollectionFactory;
use Harriswebworks\Sizing\Ui\CollectionProviderInterface;

class SizeUiCollectionProvider implements CollectionProviderInterface
{
    /**
     * @var CollectionFactory
     */
    private $factory;

    /**
     * @param CollectionFactory $factory
     */
    public function __construct(CollectionFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @return \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
     */
    public function getCollection()
    {
        return $this->factory->create();
    }
}
