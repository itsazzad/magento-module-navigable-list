<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Model;

use Harriswebworks\Sizing\Api\Data\SizeInterface;
use Harriswebworks\Sizing\Api\Data\SizeInterfaceFactory;
use Harriswebworks\Sizing\Api\SizeRepositoryInterface;
use Harriswebworks\Sizing\Model\ResourceModel\Size as SizeResourceModel;

class SizeRepo implements SizeRepositoryInterface
{
    /**
     * @var SizeInterfaceFactory
     */
    private $factory;
    /**
     * @var SizeResourceModel
     */
    private $resource;
    /**
     * @var SizeInterface[]
     */
    private $cache = [];

    /**
     *
     */
    public function __construct(
        SizeInterfaceFactory $factory,
        SizeResourceModel $resource
    ) {
        $this->factory = $factory;
        $this->resource = $resource;
    }

    /**
     * @inheritdoc
     */
    public function save(SizeInterface $size)
    {
        try {
            $this->resource->save($size);
        } catch (\Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotSaveException(
                __($exception->getMessage())
            );
        }
        return $size;
    }

    /**
     * @inheritdoc
     */
    public function get(int $sizeId)
    {
        if (!isset($this->cache[$sizeId])) {
            $size = $this->factory->create();
            $this->resource->load($size, $sizeId);
            if (!$size->getId()) {
                throw new \Magento\Framework\Exception\NoSuchEntityException(
                    __('The Size with the ID "%1" does not exist . ', $sizeId)
                );
            }
            $this->cache[$sizeId] = $size;
        }
        return $this->cache[$sizeId];
    }

    /**
     * @inheritdoc
     */
    public function delete(SizeInterface $size)
    {
        try {
            $id = $size->getId();
            $this->resource->delete($size);
            unset($this->cache[$id]);
        } catch (\Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotDeleteException(
                __($exception->getMessage())
            );
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public function deleteById(int $sizeId)
    {
        return $this->delete($this->get($sizeId));
    }

    /**
     * @inheritdoc
     */
    public function clear()
    {
        return $this->cache = [];
    }
}
