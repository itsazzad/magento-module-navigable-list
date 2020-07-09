<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Controller\Adminhtml\Size;

use Magento\Framework\App\Action\HttpPostActionInterface;

class InlineEdit extends \Harriswebworks\Sizing\Controller\Adminhtml\InlineEdit implements HttpPostActionInterface
{
    public const ADMIN_RESOURCE = 'Harriswebworks_Sizing::sizing_size';
}
