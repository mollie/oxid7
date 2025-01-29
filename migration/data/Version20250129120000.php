<?php

namespace Mollie\Payment\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\DatabaseProvider;
use Mollie\Payment\Application\Helper\Payment;
use Mollie\Payment\Application\Model\BaseMigration;
use Mollie\Payment\Application\Model\PaymentConfig;
use Mollie\Payment\Application\Model\RequestLog;
use Mollie\Payment\Application\Model\Cronjob;

class Version20250129120000 extends BaseMigration
{
    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $this->connection->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');

        $this->addSql('UPDATE `oxcontents` SET OXCONTENT = "Hallo {{ order.oxorder__oxbillsal.value|translate_salutation }} {{ order.oxorder__oxbillfname.value }} {{ order.oxorder__oxbilllname.value }},<br>\r\n<br>\r\nVielen Dank für Ihren Einkauf bei {{ shop.oxshops__oxname.value }}!<br>\r\n<br>\r\nSie k&ouml;nnen Ihren Bestellvorgang abschlie&szlig;en indem Sie auf <a href=\'{{ sFinishPaymentUrl }}\'>diesen Link</a> klicken." WHERE oxid = "molliesecondchanceemail"');
        $this->addSql('UPDATE `oxcontents` SET OXCONTENT_1 = "Hello {{ order.oxorder__oxbillsal.value|translate_salutation }} {{ order.oxorder__oxbillfname.value }} {{ order.oxorder__oxbilllname.value }},<br>\r\n<br>\r\nThank you for shopping with {{ shop.oxshops__oxname.value }}!<br>\r\n<br>\r\nYou can now finish your order by clicking <a href=\'{{ sFinishPaymentUrl }}\'>here</a>" WHERE oxid = "molliesecondchanceemail"');
    }
}
