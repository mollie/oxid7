<?php

namespace Mollie\Api\Resources;

class Capture extends \Mollie\Api\Resources\BaseResource
{
    /**
     * Always 'capture' for this object
     *
     * @var string
     */
    public $resource;
    /**
     * ID of the capture
     * @var string
     */
    public $id;
    /**
     * Mode of the capture, either "live" or "test" depending on the API Key that was used.
     *
     * @var string
     */
    public $mode;
    /**
     * Amount object containing the value and currency
     *
     * @var \stdClass
     */
    public $amount;
    /**
     * Amount object containing the settlement value and currency
     *
     * @var \stdClass
     */
    public $settlementAmount;
    /**
     * ID of the capture's payment (on the Mollie platform).
     *
     * @var string
     */
    public $paymentId;
    /**
     * ID of the capture's shipment (on the Mollie platform).
     *
     * @var string
     */
    public $shipmentId;
    /**
     * ID of the capture's settlement (on the Mollie platform).
     *
     * @var string
     */
    public $settlementId;
    /**
     * @var string
     */
    public $createdAt;
    /**
     * @var \stdClass
     */
    public $_links;
}
