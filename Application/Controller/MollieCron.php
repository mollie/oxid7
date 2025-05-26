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

        if (!empty($sSecureKey) && $sSecureKey == Payment::getInstance()->getShopConfVar('sMollieCronSecureKey')) {
            // is called via webserver and secureKey param is given and matches configured secure key
            $oScheduler = oxNew(Scheduler::class);
            $oScheduler->start(false);
        } else {
            die('<h1>Permission denied</h1>');
        }

        return $this->_sThisTemplate;
    }
}