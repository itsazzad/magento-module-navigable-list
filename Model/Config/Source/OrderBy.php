<?php
namespace Harriswebworks\Sizing\Model\Config\Source;

/**
 * @api
 * @since 100.0.2
 */
class OrderBy implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'size', 'label' => __('Size')],
            ['value' => 'order', 'label' => __('Ordering')],
        ];
    }
}
