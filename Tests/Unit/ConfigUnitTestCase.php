<?php

namespace Mollie\Payment\Tests\Unit;

use OxidEsales\TestingLibrary\UnitTestCase;
use Mollie\Payment\Application\Helper\Payment;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Configuration\Bridge\ModuleConfigurationDaoBridge;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Configuration\DataObject\ModuleConfiguration;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ConfigUnitTestCase extends UnitTestCase
{
    protected function initMockChain($blHasModuleSetting, $sReturnValue = false)
    {
        $oSetting = $this->getMockBuilder(\OxidEsales\EshopCommunity\Internal\Framework\Module\Setting\Setting::class)->disableOriginalConstructor()->getMock();
        $oSetting->method('getValue')->willReturn($sReturnValue);

        $oModuleConfig = $this->getMockBuilder(ModuleConfiguration::class)->disableOriginalConstructor()->getMock();
        $oModuleConfig->method('hasModuleSetting')->willReturn($blHasModuleSetting);
        $oModuleConfig->method('getModuleSetting')->willReturn($oSetting);

        $oModuleConfigBridge = $this->getMockBuilder(ModuleConfigurationDaoBridge::class)->disableOriginalConstructor()->getMock();
        $oModuleConfigBridge->method('get')->willReturn($oModuleConfig);

        $oContainer = $this->getMockBuilder(ContainerBuilder::class)->disableOriginalConstructor()->getMock();
        $oContainer->method('get')->willReturn($oModuleConfigBridge);

        $oPayment = Payment::getInstance();
        $oPayment->setContainer($oContainer);
    }

    public function initModuleSettingMock($sReturnValue)
    {
        $this->initMockChain(true, $sReturnValue);
    }

    public function initNoModuleSettingMock()
    {
        $this->initMockChain(false);
    }
}