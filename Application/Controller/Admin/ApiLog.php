<?php

namespace Mollie\Payment\Application\Controller\Admin;

use OxidEsales\Eshop\Application\Controller\Admin\AdminController;

class ApiLog extends AdminController
{
    protected $_sThisTemplate = '@molliepayment/logTemplate/mollie_apilog';
}