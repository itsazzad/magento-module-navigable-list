<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\ViewModel\Size;

use Harriswebworks\Sizing\Api\Data\SizeInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Url implements ArgumentInterface
{
    /**
     * url builder
     *
     * @var UrlInterface
     */
    private $urlBuilder;

    /**
     * @param UrlInterface $urlBuilder
     */
    public function __construct(
        UrlInterface $urlBuilder
    ) {
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * @return string
     */
    public function getListUrl()
    {
        return $this->urlBuilder->getUrl('sizing/size/index');
    }

    /**
     * @param SizeInterface|int $size
     * @param int $serial
     * @return string
     */
    public function getSizeUrl($size, int $serial = null)
    {
        if (gettype($size) === 'object') {
            return $this->getSizeUrlById((int)$size->getId(), $serial);
        } else {
            return $this->getSizeUrlById((int)$size, $serial);
        }
    }

    /**
     * @param int $id
     * @return string
     */
    public function getSizeUrlById(int $id, int $serial = null)
    {
        return $this->urlBuilder->getUrl('sizing/size/view', ['id' => $id, '_query'=>['s' => $serial]]);
    }
}
