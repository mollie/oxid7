[{$smarty.block.parent}]
[{if $oViewConf->mollieShowApplePayButtonOnBasket()}]
    [{oxscript include=$oViewConf->getModuleUrl('molliepayment','js/mollie.js')}]
    [{oxstyle include=$oViewConf->getModuleUrl('molliepayment','css/mollie.css')}]

    [{oxid_include_dynamic file="mollieapplepaybutton.tpl" type="mollie" position="BasketTop" payment_price=$oViewConf->mollieGetApplePayBasketSum() delivery_costs=$oxcmp_basket->getDeliveryCosts() shipping_id=$oxcmp_basket->getShippingId()}]
[{/if}]