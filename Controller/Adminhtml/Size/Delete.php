<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Controller\Adminhtml\Size;

use Magento\Framework\App\Action\HttpPostActionInterface;

class Delete extends \Harriswebworks\Sizing\Controller\Adminhtml\Delete implements HttpPostActionInterface
{
    public const ADMIN_RESOURCE = 'Harriswebworks_Sizing::sizing_size';
}
