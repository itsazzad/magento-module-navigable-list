<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Model;

use Harriswebworks\Sizing\Api\Data\SizeInterface;
use Harriswebworks\Sizing\Api\SizeRepositoryInterface;
use Harriswebworks\Sizing\Ui\EntityUiManagerInterface;

class SizeUiManager implements EntityUiManagerInterface
{
    /**
     * @var SizeRepositoryInterface
     */
    private $repository;
    /**
     * @var SizeFactory
     */
    public $factory;

    /**
     * @param SizeRepositoryInterface $repository
     * @param SizeFactory $factory
     */
    public function __construct(
        SizeRepositoryInterface $repository,
        SizeFactory $factory
    ) {
        $this->repository = $repository;
        $this->factory = $factory;
    }

    /**
     * @param int|null $id
     * @return \Magento\Framework\Model\AbstractModel | Size | SizeInterface;
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get(?int $id)
    {
        return ($id)
            ? $this->repository->get($id)
            : $this->factory->create();
    }

    /**
     * @param \Magento\Framework\Model\AbstractModel $size
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\Magento\Framework\Model\AbstractModel $size)
    {
        $this->repository->save($size);
    }

    /**
     * @param int $id
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(int $id)
    {
        $this->repository->deleteById($id);
    }
}
