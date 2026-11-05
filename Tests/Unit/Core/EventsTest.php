<?php


namespace Mollie\Payment\Tests\Unit\Core;


use Mollie\Payment\Application\Helper\Payment;
use OxidEsales\TestingLibrary\UnitTestCase;

class EventsTest extends UnitTestCase
{
    protected function setUp(): void
    {
        parent::setUp(); // first, so the test database is restored after the test

        \OxidEsales\Eshop\Core\DatabaseProvider::getDB()->execute("DELETE FROM oxpayments WHERE oxid LIKE '%mollie%'");
        \OxidEsales\Eshop\Core\DatabaseProvider::getDB()->execute("DELETE FROM oxobject2group WHERE oxobjectid LIKE '%mollie%'");
        \OxidEsales\Eshop\Core\DatabaseProvider::getDB()->execute("DELETE FROM oxobject2payment WHERE oxpaymentid LIKE '%mollie%'");
    }

    public function testOnActivate()
    {
        \OxidEsales\Eshop\Core\DatabaseProvider::getDB()->execute("ALTER TABLE oxorder DROP COLUMN MOLLIEAPI");
        // migrations are only executed once, so the migration which adds the column has to be executed again
        \OxidEsales\Eshop\Core\DatabaseProvider::getDB()->execute("DELETE FROM oxmigrations_mollie WHERE version = ?", ['Mollie\Payment\Migrations\Version20241009120000']);

        \Mollie\Payment\Core\Events::onActivate();

        $oDbMetaDataHandler = oxNew(\OxidEsales\Eshop\Core\DbMetaDataHandler::class);
        $oDb = \OxidEsales\Eshop\Core\DatabaseProvider::getDb();

        $this->assertTrue($oDbMetaDataHandler->tableExists('molliepaymentconfig'));
        $this->assertTrue($oDbMetaDataHandler->tableExists('mollierequestlog'));
        $this->assertTrue($oDbMetaDataHandler->tableExists('molliecronjob'));

        $this->assertTrue($oDbMetaDataHandler->fieldExists('MOLLIEDELCOSTREFUNDED', 'oxorder'));
        $this->assertTrue($oDbMetaDataHandler->fieldExists('MOLLIEPAYCOSTREFUNDED', 'oxorder'));
        $this->assertTrue($oDbMetaDataHandler->fieldExists('MOLLIEWRAPCOSTREFUNDED', 'oxorder'));
        $this->assertTrue($oDbMetaDataHandler->fieldExists('MOLLIEGIFTCARDREFUNDED', 'oxorder'));
        $this->assertTrue($oDbMetaDataHandler->fieldExists('MOLLIEVOUCHERDISCOUNTREFUNDED', 'oxorder'));
        $this->assertTrue($oDbMetaDataHandler->fieldExists('MOLLIEDISCOUNTREFUNDED', 'oxorder'));
        $this->assertTrue($oDbMetaDataHandler->fieldExists('MOLLIEMODE', 'oxorder'));
        $this->assertTrue($oDbMetaDataHandler->fieldExists('MOLLIESECONDCHANCEMAILSENT', 'oxorder'));
        $this->assertTrue($oDbMetaDataHandler->fieldExists('MOLLIEQUANTITYREFUNDED', 'oxorderarticles'));
        $this->assertTrue($oDbMetaDataHandler->fieldExists('MOLLIEAMOUNTREFUNDED', 'oxorderarticles'));
        $this->assertTrue($oDbMetaDataHandler->fieldExists('MOLLIEAPI', 'oxorder'));
        $this->assertTrue($oDbMetaDataHandler->fieldExists('MOLLIECUSTOMERID', 'oxuser'));

        $iCount = $oDb->getOne("SELECT COUNT(OXID) FROM oxpayments WHERE oxid LIKE '%mollie%'");
        $this->assertEquals(count(Payment::getInstance()->getMolliePaymentMethods()), $iCount);

        $sExpected = 'molliesecondchanceemail';
        $sOxid = $oDb->getOne("SELECT oxid FROM oxcontents WHERE oxid = '{$sExpected}'");
        $this->assertEquals($sExpected, $sOxid);
    }

    public function testOnDeactivate()
    {
        file_put_contents(getShopBasePath().'/tmp/smarty/unitTestClean.php', "delete me");

        \Mollie\Payment\Core\Events::onDeactivate();

        $iCount = \OxidEsales\Eshop\Core\DatabaseProvider::getDb()->getOne("SELECT COUNT(OXID) FROM oxpayments WHERE oxid LIKE '%mollie%' AND oxactive = 1");
        $this->assertEquals(0, $iCount);
    }
}