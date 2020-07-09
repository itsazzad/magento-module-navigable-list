<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Controller\Size;

use Harriswebworks\Sizing\Api\SizeRepositoryInterface;
use Harriswebworks\Sizing\ViewModel\Size\Url;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\Result\Forward;
use Magento\Framework\View\Result\Page;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;

class View extends Action
{
    /**
     * @var string
     */
    public const BREADCRUMBS_CONFIG_PATH = 'harriswebworks_sizing/size/breadcrumbs';
    /**
     * @var SizeRepositoryInterface
     */
    private $sizeRepository;
    /**
     * @var Url
     */
    protected $urlModel;
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @param Context $context
     * @param SizeRepositoryInterface $sizeRepository
     * @param Url $urlModel
     * @param StoreManagerInterface $storeManager
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        Context $context,
        SizeRepositoryInterface $sizeRepository,
        Url $urlModel,
        StoreManagerInterface $storeManager,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->sizeRepository = $sizeRepository;
        $this->urlModel = $urlModel;
        $this->storeManager = $storeManager;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\Controller\Result\Forward|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        try {
            $sizeId = (int)$this->getRequest()->getParam('id');
            $size = $this->sizeRepository->get($sizeId);

            if (!$size->getIsActive()) {
                return $this->getNoRouteResult();
            }
            $validStores = [$this->storeManager->getStore()->getId(), 0];
            if (!count(array_intersect($validStores, $size->getStoreId()))) {
                return $this->getNoRouteResult();
            }
        } catch (\Exception $e) {
            return $this->getNoRouteResult();
        }

        /** @var Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->setDescription($size->getMetaDescription());
        $resultPage->getConfig()->setKeywords($size->getMetaKeywords());
        $title = $size->getMetaTitle();
        if (!$title) {
            $title = $size->getSize();
        }
        $resultPage->getConfig()->getTitle()->set($title);
        $pageMainTitle = $resultPage->getLayout()->getBlock('page.main.title');
        if ($pageMainTitle && $pageMainTitle instanceof \Magento\Theme\Block\Html\Title) {
            $pageMainTitle->setPageTitle($size->getSize());
        }
        if ($this->scopeConfig->isSetFlag(self::BREADCRUMBS_CONFIG_PATH, ScopeInterface::SCOPE_STORE)) {
            /** @var \Magento\Theme\Block\Html\Breadcrumbs $breadcrumbsBlock */
            $breadcrumbsBlock = $resultPage->getLayout()->getBlock('breadcrumbs');
            if ($breadcrumbsBlock) {
                $breadcrumbsBlock->addCrumb(
                    'home',
                    [
                        'label' => __('Home'),
                        'link'  => $this->_url->getUrl('')
                    ]
                );
                $breadcrumbsBlock->addCrumb(
                    'sizes',
                    [
                        'label' => __('Sizes'),
                        'link'  => $this->urlModel->getListUrl()
                    ]
                );
                $breadcrumbsBlock->addCrumb(
                    'size-' . $size->getId(),
                    [
                        'label' => $size->getSize()
                    ]
                );
            }
        }
        return $resultPage;
    }

    /**
     * @return \Magento\Framework\Controller\Result\Forward
     */
    private function getNoRouteResult()
    {
        /** @var Forward $resultForward */
        $resultForward = $this->resultFactory->create(ResultFactory::TYPE_FORWARD);
        $resultForward->forward('noroute');
        return $resultForward;
    }
}
