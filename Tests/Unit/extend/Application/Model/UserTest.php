<?php


namespace Mollie\Payment\Tests\Unit\extend\Application\Model;


use OxidEsales\TestingLibrary\UnitTestCase;

class UserTest extends UnitTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        \OxidEsales\Eshop\Core\DatabaseProvider::getDb()->execute("DELETE FROM oxobject2group WHERE oxobjectid = 'testUserId'");
    }

    protected function tearDown(): void
    {
        \OxidEsales\Eshop\Core\DatabaseProvider::getDb()->execute("DELETE FROM oxobject2group WHERE oxobjectid = 'testUserId'");

        parent::tearDown();
    }

    public function testMollieSetAutoGroups()
    {
        $sUserId = "testUserId";

        // "testcountry" is no home country, so the user is assigned to the standard group for foreign customers
        $oGroup = oxNew(\OxidEsales\Eshop\Application\Model\Groups::class);
        if ($oGroup->load('oxidforeigncustomer') === false) {
            $oGroup->setId('oxidforeigncustomer');
            $oGroup->oxgroups__oxactive = new \OxidEsales\Eshop\Core\Field(1);
            $oGroup->oxgroups__oxtitle = new \OxidEsales\Eshop\Core\Field('Foreign customer');
            $oGroup->save();
        }

        $oUser = new \Mollie\Payment\extend\Application\Model\User();
        $oUser->setId($sUserId);
        $oUser->oxuser__oxcountryid = new \OxidEsales\Eshop\Core\Field("testcountry");

        $oUser->mollieSetAutoGroups();

        $iCount = \OxidEsales\Eshop\Core\DatabaseProvider::getDb()->getOne("SELECT COUNT(OXID) FROM oxobject2group WHERE oxobjectid = ?", array($sUserId));

        $this->assertGreaterThan(0, $iCount);
    }
}