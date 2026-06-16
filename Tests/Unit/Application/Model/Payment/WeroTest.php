<?php

namespace Mollie\Payment\Tests\Unit\Application\Model\Payment;

use Mollie\Api\Endpoints\MethodEndpoint;
use Mollie\Payment\Application\Helper\Payment;
use Mollie\Payment\Application\Model\Payment\Wero;
use Mollie\Payment\Tests\Unit\ConfigUnitTestCase;
use OxidEsales\Eshop\Core\UtilsObject;

class WeroTest extends ConfigUnitTestCase
{
    public function testGetOxidPaymentId()
    {
        $oPayment = new Wero();
        $this->assertEquals('molliewero', $oPayment->getOxidPaymentId());
    }

    public function testGetMolliePaymentCode()
    {
        $oPayment = new Wero();
        $this->assertEquals('wero', $oPayment->getMolliePaymentCode());
    }

    public function testAllowedCurrenciesContainsEur()
    {
        $oPayment = new Wero();
        $this->assertTrue($oPayment->isCurrencySupported('EUR'));
    }

    public function testNonEurCurrencyNotSupported()
    {
        $oPayment = new Wero();
        $this->assertFalse($oPayment->isCurrencySupported('CHF'));
    }

    public function testCountryRestrictionAllowsDE()
    {
        $oPayment = new Wero();
        $this->assertTrue($oPayment->mollieIsMethodAvailableForCountry('DE'));
    }

    public function testCountryRestrictionAllowsBE()
    {
        $oPayment = new Wero();
        $this->assertTrue($oPayment->mollieIsMethodAvailableForCountry('BE'));
    }

    public function testCountryRestrictionAllowsFR()
    {
        $oPayment = new Wero();
        $this->assertTrue($oPayment->mollieIsMethodAvailableForCountry('FR'));
    }

    public function testCountryRestrictionAllowsLU()
    {
        $oPayment = new Wero();
        $this->assertTrue($oPayment->mollieIsMethodAvailableForCountry('LU'));
    }

    public function testCountryRestrictionBlocksOtherCountry()
    {
        $oPayment = new Wero();
        $this->assertFalse($oPayment->mollieIsMethodAvailableForCountry('US'));
    }

    public function testIsMolliePaymentActiveInGeneralReturnsFalseWhenNotActive()
    {
        $oMethods = $this->getMockBuilder(MethodEndpoint::class)->disableOriginalConstructor()->getMock();
        $oMethods->method('all')->willReturn([]);

        $oMollieApi = $this->getMockBuilder(\Mollie\Api\MollieApiClient::class)->disableOriginalConstructor()->getMock();
        $oMollieApi->methods = $oMethods;

        UtilsObject::setClassInstance(\Mollie\Api\MollieApiClient::class, $oMollieApi);

        $oPayment = new Wero();
        $this->assertFalse($oPayment->isMolliePaymentActiveInGeneral());

        Payment::destroyInstance();
    }

    public function testIsMolliePaymentActiveInGeneralReturnsTrueWhenActive()
    {
        $oImage = new \stdClass();
        $oImage->size2x = 'img.png';

        $oItem = $this->getMockBuilder(\Mollie\Api\Resources\Method::class)->disableOriginalConstructor()->getMock();
        $oItem->id = 'wero';
        $oItem->description = 'Wero';
        $oItem->image = $oImage;

        $oMethods = $this->getMockBuilder(MethodEndpoint::class)->disableOriginalConstructor()->getMock();
        $oMethods->method('all')->willReturn([$oItem]);

        $oMollieApi = $this->getMockBuilder(\Mollie\Api\MollieApiClient::class)->disableOriginalConstructor()->getMock();
        $oMollieApi->methods = $oMethods;

        UtilsObject::setClassInstance(\Mollie\Api\MollieApiClient::class, $oMollieApi);

        $oPayment = new Wero();
        $this->assertTrue($oPayment->isMolliePaymentActiveInGeneral());

        Payment::destroyInstance();
    }

    public function testIsRegisteredInPaymentHelper()
    {
        $aMethods = Payment::getInstance()->getMolliePaymentMethods();
        $this->assertArrayHasKey('molliewero', $aMethods);
        $this->assertEquals('Wero', $aMethods['molliewero']);

        Payment::destroyInstance();
    }
}
