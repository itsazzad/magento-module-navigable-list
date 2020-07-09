<?php
namespace Harriswebworks\Sizing\ViewModel;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class SystemConfig implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    /**
     * @var string
     */
    public const SHORT_DESCRIPTION_CONFIG_PATH = 'sizing/size/short_description';

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
      ScopeConfigInterface $scopeConfig
  ) {
      $this->scopeConfig = $scopeConfig;
  }

    public function getShortDescription()
    {
      return $this->scopeConfig->getValue(self::SHORT_DESCRIPTION_CONFIG_PATH, ScopeInterface::SCOPE_STORE);
    }
}
