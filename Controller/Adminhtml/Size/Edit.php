<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Controller\Adminhtml\Size;

use Magento\Framework\App\Action\HttpGetActionInterface;

class Edit extends \Harriswebworks\Sizing\Controller\Adminhtml\Edit implements HttpGetActionInterface
{
    public const ADMIN_RESOURCE = 'Harriswebworks_Sizing::sizing_size';
}
