<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Controller\Adminhtml\Size;

use Magento\Framework\App\Action\HttpGetActionInterface;

class Index extends \Harriswebworks\Sizing\Controller\Adminhtml\Index implements HttpGetActionInterface
{
    public const ADMIN_RESOURCE = 'Harriswebworks_Sizing::sizing_size';
}
