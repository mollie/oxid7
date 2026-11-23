<?php

namespace Mollie\Payment\Tests\Unit\migration\data;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Schema\Schema;
use Mollie\Payment\Migrations\Version20250527120000;
use OxidEsales\TestingLibrary\UnitTestCase;
use Psr\Log\NullLogger;

require_once __DIR__ . '/../../../../migration/data/Version20250527120000.php'; // migrations are loaded by path, not by the autoloader

class Version20250527120000Test extends UnitTestCase
{
    public function testUpUsesOnlyMigrationConnection()
    {
        // separate in-memory DB, so the migration can't use the shop DB through the OXID framework
        $oConnection = DriverManager::getConnection(['driver' => 'pdo_sqlite', 'memory' => true]);
        $oConnection->executeStatement('CREATE TABLE molliepaymentconfig (OXID VARCHAR(32) PRIMARY KEY, API VARCHAR(32), CONFIG TEXT NOT NULL)');
        $oConnection->executeStatement(
            "INSERT INTO molliepaymentconfig VALUES ('molliecreditcard', 'payment', ?)",
            [json_encode(['creditcard_capture_method' => 'creditcard_manual_capture', 'creditcard_data_input' => 'hosted_checkout'])]
        );
        $oConnection->executeStatement("INSERT INTO molliepaymentconfig VALUES ('mollieklarna', 'payment', '[]')");

        $oMigration = new Version20250527120000($oConnection, new NullLogger());
        $oMigration->up(new Schema());

        $aStatements = [];
        $aParameters = [];
        foreach ($oMigration->getSql() as $oQuery) {
            $aStatements[] = $oQuery->getStatement();
            $aParameters[] = $oQuery->getParameters();
        }

        $this->assertSame([
            "UPDATE molliepaymentconfig SET API = 'order' WHERE OXID = 'mollieklarna'",
            "INSERT INTO molliepaymentconfig (OXID, API, CONFIG) VALUES ('molliein3', 'order', '[]')",
            "INSERT INTO molliepaymentconfig (OXID, API, CONFIG) VALUES ('molliebillie', 'order', '[]')",
            "INSERT INTO molliepaymentconfig (OXID, API, CONFIG) VALUES ('mollieriverty', 'order', '[]')",
            "UPDATE molliepaymentconfig SET CONFIG = ? WHERE OXID = 'molliecreditcard'",
        ], $aStatements);

        $this->assertSame(['creditcard_data_input' => 'hosted_checkout', 'capture_method' => 'manual_capture'], json_decode($aParameters[4][0], true));
    }
}
