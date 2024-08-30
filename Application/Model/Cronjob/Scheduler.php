<?php


namespace Mollie\Payment\Application\Model\Cronjob;


use OxidEsales\Eshop\Core\Registry;

class Scheduler
{
    /**
     * List of all existing cronjobs
     *
     * @var array
     */
    protected $aCronjobs = [
        OrderCapture::class,
        OrderExpiry::class,
        FinishOrders::class,
        SecondChance::class,
        OrderShipment::class,
    ];

    /**
     * Returns list of all cronjobs
     *
     * @return array
     */
    protected function getCronjobs()
    {
        return $this->aCronjobs;
    }

    /**
     * Check if cronjob is due again
     *
     * @param  Base $oCronjob
     * @return bool
     */
    protected function isCronjobDue(Base $oCronjob)
    {
        $iGracePeriod = 5; // Grace period timer to prevent cronjob not starting when crontab timer and minute invterval are exactly the same
        if (empty($oCronjob->getLastRunDateTime()) || (strtotime($oCronjob->getLastRunDateTime()) - $iGracePeriod) <= (time() - ($oCronjob->getMinuteInterval() * 60))) {
            return true;
        }
        return false;
    }

    /**
     * Starts all cronjobs
     *
     * @param  int|false $iShopId
     * @param  bool $blCallOverUrl
     * @return void
     */
    public function start($iShopId = false, $blCallOverUrl = false)
    {
        if(!$blCallOverUrl) {
            Base::outputInfo("START MOLLIE CRONJOB EXECUTION");
        } else {
            echo "<p>" . Base::outputInfo("START MOLLIE CRONJOB EXECUTION") . "</p>";
        }

        if ($iShopId !== false) {
            $oConfig = Registry::getConfig();
            $oConfig->setShopId($iShopId);
            Registry::set(\OxidEsales\Eshop\Core\Config::class, $oConfig);
        }

        foreach ($this->getCronjobs() as $sCronjobClass) {
            $oCronjob = oxNew($sCronjobClass, $iShopId);
            if ($oCronjob->isCronjobActivated() && $this->isCronjobDue($oCronjob)) {
                $oCronjob->startCronjob();
            }
        }

        if(!$blCallOverUrl) {
            Base::outputInfo("FINISHED MOLLIE CRONJOB EXECUTION");
        } else {
            echo "<p>" . Base::outputInfo("FINISHED MOLLIE CRONJOB EXECUTION") . "</p>";
        }
    }
}
