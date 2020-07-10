<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\ViewModel\Size;

use Harriswebworks\Sizing\Api\Data\SizeInterface;
use Harriswebworks\Sizing\Api\SizeRepositoryInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class View implements ArgumentInterface
{
    /**
     * @var RequestInterface
     */
    private $request;
    /**
     * @var SizeRepositoryInterface
     */
    private $sizeRepository;
    /**
     * @var SizeInterface|bool
     */
    private $size;

    /**
     * @var int
     */
    private $serial;

    /**
     * View constructor.
     * @param RequestInterface $request
     * @param SizeRepositoryInterface $sizeRepository
     */
    public function __construct(
        RequestInterface $request,
        SizeRepositoryInterface $sizeRepository
        )
    {
        $this->request = $request;
        $this->sizeRepository = $sizeRepository;
    }

    /**
     * @return bool|SizeInterface
     */
    public function getSize()
    {
        if ($this->size === null) {
            $id = (int)$this->request->getParam('id');
            if ($id) {
                try {
                    $this->size = $this->sizeRepository->get($id);
                } catch (NoSuchEntityException $e) {
                    $this->size = false;
                }
            } else {
                $this->size = false;
            }
        }
        return $this->size;
    }

    /**
     * @return int|null
     */
    public function getSerial()
    {
        if (!$this->serial || $this->serial <= 0) {
            $serial = (int)$this->request->getParam('s');
            if ($serial) {
                $this->serial = $serial;
            } else {
                $this->serial = null;
            }
        }
        return $this->serial;
    }
}
