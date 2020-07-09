<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\Result\Forward;

class NewAction extends Action
{
    /**
     * @return Forward
     */
    public function execute()
    {
        /** @var Forward $forward */
        $forward = $this->resultFactory->create(ResultFactory::TYPE_FORWARD);
        $forward->forward('edit');
        return $forward;
    }
}
