<?php


namespace Mollie\Payment\Tests\Unit\extend\Core;


use Mollie\Payment\Application\Helper\Payment;
use Mollie\Payment\Application\Model\Payment\Banktransfer;
use Mollie\Payment\Tests\Unit\ConfigUnitTestCase;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\UtilsObject;
use OxidEsales\TestingLibrary\UnitTestCase;

class ViewConfigTest extends ConfigUnitTestCase
{
    public function testMollieShowIcons()
    {
        $expected = true;

        $this->initModuleSettingMock($expected);

        $oViewConfig = new \Mollie\Payment\extend\Core\ViewConfig();
        $result = $oViewConfig->mollieShowIcons();

        $this->assertEquals($expected, $result);

        Payment::destroyInstance();
    }

    public function testMollieCanShowApplePayButton()
    {
        $this->initModuleSettingMock('live');

        $oPaymentModel = $this->getMockBuilder(Banktransfer::class)->disableOriginalConstructor()->getMock();
        $oPaymentModel->method('isMolliePaymentActive')->willReturn(true);
        $oPaymentModel->method('mollieIsBasketSumInLimits')->willReturn(true);

        $oPayment = $this->getMockBuilder(\OxidEsales\Eshop\Application\Model\Payment::class)->disableOriginalConstructor()->getMock();
        $oPayment->method('load')->willReturn(true);
        $oPayment->method('__get')->willReturnMap([
            ['oxpayments__oxactive', new \OxidEsales\Eshop\Core\Field(1)],
            ['oxpayments__oxfromamount', new \OxidEsales\Eshop\Core\Field(20)],
            ['oxpayments__oxtoamount', new \OxidEsales\Eshop\Core\Field(100000)],
        ]);
        $oPayment->method('getMolliePaymentModel')->willReturn($oPaymentModel);

        UtilsObject::setClassInstance(\OxidEsales\Eshop\Application\Model\Payment::class, $oPayment);

        $oViewConfig = new \Mollie\Payment\extend\Core\ViewConfig();
        $result = $oViewConfig->mollieCanShowApplePayButton(50);

        $this->assertTrue($result);

        $result = $oViewConfig->mollieCanShowApplePayButton(10);

        $this->assertFalse($result);

        Payment::destroyInstance();
    }

    public function testMollieGetHomeCountryCode()
    {
        $expected = 'test';

        $oConfig = $this->getMockBuilder(\OxidEsales\Eshop\Core\Config::class)->disableOriginalConstructor()->getMock();
        $oConfig->method('getConfigParam')->willReturn(['homeCountryId']);

        $oCountry = $this->getMockBuilder(\OxidEsales\Eshop\Application\Model\Country::class)->disableOriginalConstructor()->getMock();
        $oCountry->method('load')->willReturn(true);
        $oCountry->method('__get')->willReturn(new \OxidEsales\Eshop\Core\Field($expected));

        UtilsObject::setClassInstance(\OxidEsales\Eshop\Application\Model\Country::class, $oCountry);

        Registry::set(\OxidEsales\Eshop\Core\Config::class, $oConfig);

        $oViewConfig = new \Mollie\Payment\extend\Core\ViewConfig();
        $result = $oViewConfig->mollieGetHomeCountryCode();

        $this->assertEquals($expected, $result);
    }

    public function testMollieGetHomeCountryCodeFalse()
    {
        $oConfig = $this->getMockBuilder(\OxidEsales\Eshop\Core\Config::class)->disableOriginalConstructor()->getMock();
        $oConfig->method('getConfigParam')->willReturn(false);

        Registry::set(\OxidEsales\Eshop\Core\Config::class, $oConfig);

        $oViewConfig = new \Mollie\Payment\extend\Core\ViewConfig();
        $result = $oViewConfig->mollieGetHomeCountryCode();

        $this->assertFalse($result);
    }

    public function testMollieGetCurrentCurrency()
    {
        $expected = "Test";

        $oCurrency = new \stdClass();
        $oCurrency->name = $expected;

        $oConfig = $this->getMockBuilder(\OxidEsales\Eshop\Core\Config::class)->disableOriginalConstructor()->getMock();
        $oConfig->method('getActShopCurrencyObject')->willReturn($oCurrency);

        Registry::set(\OxidEsales\Eshop\Core\Config::class, $oConfig);

        $oViewConfig = new \Mollie\Payment\extend\Core\ViewConfig();
        $result = $oViewConfig->mollieGetCurrentCurrency();

        $this->assertEquals($expected, $result);
    }

    public function testMollieGetShopUrl()
    {
        $expected = "https://www.mollie.com/";

        $oConfig = $this->getMockBuilder(\OxidEsales\Eshop\Core\Config::class)->disableOriginalConstructor()->getMock();
        $oConfig->method('getSslShopUrl')->willReturn("https://www.mollie.com");

        Registry::set(\OxidEsales\Eshop\Core\Config::class, $oConfig);

        $oViewConfig = new \Mollie\Payment\extend\Core\ViewConfig();
        $result = $oViewConfig->mollieGetShopUrl();

        $this->assertEquals($expected, $result);
    }

    public function testMollieShowApplePayButtonOnBasket()
    {
        $expected = true;

        $oConfig = $this->getMockBuilder(\OxidEsales\Eshop\Core\Config::class)->disableOriginalConstructor()->getMock();
        $oConfig->method('getShopConfVar')->willReturn($expected);

        Registry::set(\OxidEsales\Eshop\Core\Config::class, $oConfig);

        $oViewConfig = new \Mollie\Payment\extend\Core\ViewConfig();
        $result = $oViewConfig->mollieShowApplePayButtonOnBasket();

        $this->assertEquals($expected, $result);
    }

    public function testMollieShowApplePayButtonOnDetails()
    {
        $expected = true;

        $oConfig = $this->getMockBuilder(\OxidEsales\Eshop\Core\Config::class)->disableOriginalConstructor()->getMock();
        $oConfig->method('getShopConfVar')->willReturn($expected);

        Registry::set(\OxidEsales\Eshop\Core\Config::class, $oConfig);

        $oViewConfig = new \Mollie\Payment\extend\Core\ViewConfig();
        $result = $oViewConfig->mollieShowApplePayButtonOnDetails();

        $this->assertEquals($expected, $result);
    }
}