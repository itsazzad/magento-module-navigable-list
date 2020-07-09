<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Controller\Adminhtml\Size;

use Magento\Framework\App\Action\HttpGetActionInterface;

class NewAction extends \Harriswebworks\Sizing\Controller\Adminhtml\NewAction implements HttpGetActionInterface
{
    public const ADMIN_RESOURCE = 'Harriswebworks_Sizing::sizing_size';
}
