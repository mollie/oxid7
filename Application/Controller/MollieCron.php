<?php

namespace Mollie\Payment\Application\Controller;

use OxidEsales\Eshop\Application\Controller\FrontendController;
use OxidEsales\Eshop\Core\Registry;
use Mollie\Payment\Application\Model\Cronjob\Scheduler;
use Mollie\Payment\Application\Helper\Payment;

class MollieCron extends FrontendController
{
    /**
     * @var string
     */
    protected $_sThisTemplate = '@molliepayment/frontend/mollie_cron_over_url';

    public function render()
    {
        $sSecureKey = Registry::getRequest()->getRequestEscapedParameter("secureKey");

        $sConfiguredSecureKey = Payment::getInstance()->getShopConfVar('sMollieCronSecureKey');
        if (!empty($sSecureKey) && is_string($sSecureKey) && !empty($sConfiguredSecureKey) && hash_equals((string)$sConfiguredSecureKey, $sSecureKey)) {
            // is called via webserver and secureKey param is given and matches configured secure key
            $oScheduler = oxNew(Scheduler::class);
            $oScheduler->start(false);
        } else {
            die('<h1>Permission denied</h1>');
        }

        return $this->_sThisTemplate;
    }
}