<?php

namespace Mollie\Payment\extend\Core;

use OxidEsales\Eshop\Core\Registry;
use OxidEsales\EshopCommunity\Core\ShopVersion;
use OxidEsales\EshopCommunity\Internal\Framework\Templating\TemplateRendererBridgeInterface;
use OxidEsales\Facts\Facts;

class Email extends Email_parent
{
    protected $_sMollieSecondChanceTemplate = '@molliepayment/email/mollie_second_chance';

    protected $_sMollieSupportEmail = '@molliepayment/email/mollie_support_email';

    /**
     * Renders the template with old or current method
     *
     * @param \OxidEsales\EshopCommunity\Internal\Framework\Templating\TemplateRendererInterface|\Smarty $oRenderer
     * @param string $sTemplate
     * @return string
     */
    protected function mollieRenderTemplate($oRenderer, $sTemplate)
    {
        if (method_exists($this, 'getRenderer')) { // mechanism changed in Oxid 6.2
            return $oRenderer->renderTemplate($sTemplate, $this->getViewData());
        }
        return $oRenderer->fetch($sTemplate);
    }

    /**
     * Sends second chance email to customer
     *
     * @param object $oOrder
     * @param string $sFinishPaymentUrl
     * @return bool
     */
    public function mollieSendSecondChanceEmail($oOrder, $sFinishPaymentUrl)
    {
        $myConfig = Registry::getConfig();

        $blIsAdmin = isAdmin();

        // shop info
        $shop = $this->getShop();

        //set mail params (from, fromName, smtp )
        $this->setMailParams($shop);

        // create messages
        $oRenderer = $this->getRenderer();

        $subject = Registry::getLang()->translateString('MOLLIE_SECOND_CHANCE_MAIL_SUBJECT', null, false) . " " . $shop->oxshops__oxname->getRawValue() . " (#" . $oOrder->oxorder__oxordernr->value . ")";

        $this->setViewData("order", $oOrder);
        $this->setViewData("shopTemplateDir", $myConfig->getTemplateDir(false));
        $this->setViewData("shop", $shop);
        $this->setViewData("subject", $subject);
        $this->setViewData("sFinishPaymentUrl", $sFinishPaymentUrl);

        // Process view data array through oxOutput processor
        $this->processViewArray();

        // force non admin to get correct paths (tpl, img)
        $myConfig->setAdminMode(false);
        Registry::set(\OxidEsales\Eshop\Core\Config::class, $myConfig);

        $this->setBody($oRenderer->renderTemplate($this->_sMollieSecondChanceTemplate, $this->getViewData()));
        $this->setSubject($subject);

        if ($blIsAdmin === true) {
            // reset container to admin mode to render backend template
            \OxidEsales\EshopCommunity\Internal\Container\ContainerFactory::resetContainer();
            $myConfig->setAdminMode(true);
            Registry::set(\OxidEsales\Eshop\Core\Config::class, $myConfig);
        }

        $fullName = $oOrder->oxorder__oxbillfname->getRawValue() . " " . $oOrder->oxorder__oxbilllname->getRawValue();

        $this->setRecipient($oOrder->oxorder__oxbillemail->value, $fullName);
        $this->setReplyTo($shop->oxshops__oxorderemail->value, $shop->oxshops__oxname->getRawValue());

        if (defined('OXID_PHP_UNIT')) { // dont send email when unittesting
            return true;
        }

        return $this->send();
    }

    public function mollieSendSupportEmail($sName, $sEmail, $sSubject, $sEnquiryText, $sModuleVersion, $sAttachmentPath = false)
    {
        // add user defined stuff if there is any
        #$user = $this->_addUserRegisterEmail($user);

        // shop info
        $shop = $this->getShop();

        //set mail params (from, fromName, smtp )
        $this->setMailParams($shop);

        // create messages
        $oRenderer = $this->getRenderer();

        $this->setViewData("shop", $shop);
        $this->setViewData("subject", "");
        $this->setViewData("enquiry", $sEnquiryText);
        $this->setViewData("shopversion", (new Facts())->getEdition()." ".ShopVersion::getVersion());
        $this->setViewData("moduleversion", $sModuleVersion);
        $this->setViewData("contact_name", $sName);
        $this->setViewData("contact_email", $sEmail);

        // Process view data array through oxOutput processor
        $this->processViewArray();

        $oConfig = Registry::getConfig();
        $oConfig->setAdminMode(false);

        $this->setBody($this->mollieRenderTemplate($oRenderer, $this->_sMollieSupportEmail));
        $this->setSubject("Mollie Support Oxid: ".$sSubject);

        if ($sAttachmentPath !== false) {
            $this->addAttachment($sAttachmentPath, 'Mollie.log');
        }

        $oConfig->setAdminMode(true);

        $this->setRecipient("support@mollie.com", "Mollie Support");
        $this->setRecipient($sEmail, $sName);
        $this->setReplyTo($shop->oxshops__oxorderemail->value, $shop->oxshops__oxname->getRawValue());

        if (defined('OXID_PHP_UNIT')) { // dont send email when unittesting
            return true;
        }

        return $this->send();
    }
}
