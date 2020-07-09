<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Model\ResourceModel\Size;

use Harriswebworks\Sizing\Model\ResourceModel\Collection\StoreAwareAbstractCollection;

/**
 * @api
 */
class Collection extends StoreAwareAbstractCollection
{
    /**
     * @var string
     * phpcs:disable PSR2.Classes.PropertyDeclaration.Underscore,PSR12.Classes.PropertyDeclaration.Underscore
     */
    protected $_idFieldName = 'size_id';
    //phpcs: enable

    /**
     * Define resource model
     *
     * @return void
     * @codeCoverageIgnore
     * //phpcs:disable PSR2.Methods.MethodDeclaration.Underscore,PSR12.Methods.MethodDeclaration.Underscore
     */
    protected function _construct()
    {
        $this->_init(
            \Harriswebworks\Sizing\Model\Size::class,
            \Harriswebworks\Sizing\Model\ResourceModel\Size::class
        );
        $this->_map['fields']['store_id'] = 'store_table.store_id';
        $this->_map['fields']['size_id'] = 'main_table.size_id';
        //phpcs: enable
    }
}
