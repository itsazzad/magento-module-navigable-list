<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Controller\Adminhtml\Size;

use Magento\Framework\App\Action\HttpPostActionInterface;

class MassDelete extends \Harriswebworks\Sizing\Controller\Adminhtml\MassDelete implements HttpPostActionInterface
{
    public const ADMIN_RESOURCE = 'Harriswebworks_Sizing::sizing_size';
}
