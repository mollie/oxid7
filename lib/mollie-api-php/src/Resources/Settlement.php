<?php

namespace Mollie\Api\Resources;

use Mollie\Api\Exceptions\ApiException;
use Mollie\Api\MollieApiClient;
use Mollie\Api\Types\SettlementStatus;
class Settlement extends \Mollie\Api\Resources\BaseResource
{
    /**
     * ID of the settlement.
     *
     * @var string
     */
    public $id;
    /**
     * The settlement reference. This corresponds to an invoice that's in your Dashboard.
     *
     * @var string
     */
    public $reference;
    /**
     * UTC datetime the payment was created in ISO-8601 format.
     *
     * @example "2013-12-25T10:30:54+00:00"
     * @var string
     */
    public $createdAt;
    /**
     * The date on which the settlement was settled, in ISO 8601 format. When requesting the open settlement or next settlement the return value is null.
     *
     * @example "2013-12-25T10:30:54+00:00"
     * @var string|null
     */
    public $settledAt;
    /**
     * Status of the settlement.
     *
     * @var string
     */
    public $status;
    /**
     * Total settlement amount in euros.
     *
     * @var \stdClass
     */
    public $amount;
    /**
     * Revenues and costs nested per year, per month, and per payment method.
     *
     * @var \stdClass
     */
    public $periods;
    /**
     * The ID of the invoice on which this settlement is invoiced, if it has been invoiced.
     *
     * @var string|null
     */
    public $invoiceId;
    /**
     * @var \stdClass
     */
    public $_links;
    /**
     * Is this settlement still open?
     *
     * @return bool
     */
    public function isOpen()
    {
        return $this->status === \Mollie\Api\Types\SettlementStatus::STATUS_OPEN;
    }
    /**
     * Is this settlement pending?
     *
     * @return bool
     */
    public function isPending()
    {
        return $this->status === \Mollie\Api\Types\SettlementStatus::STATUS_PENDING;
    }
    /**
     * Is this settlement paidout?
     *
     * @return bool
     */
    public function isPaidout()
    {
        return $this->status === \Mollie\Api\Types\SettlementStatus::STATUS_PAIDOUT;
    }
    /**
     * Is this settlement failed?
     *
     * @return bool
     */
    public function isFailed()
    {
        return $this->status === \Mollie\Api\Types\SettlementStatus::STATUS_FAILED;
    }
    /**
     * Retrieves all payments associated with this settlement
     *
     * @param int|null $limit
     * @param array $parameters
     * @return PaymentCollection
     * @throws \Mollie\Api\Exceptions\ApiException
     */
    public function payments(int $limit = null, array $parameters = []) : \Mollie\Api\Resources\PaymentCollection
    {
        return $this->client->settlementPayments->pageForId($this->id, null, $limit, $parameters);
    }
    /**
     * Retrieves all refunds associated with this settlement
     *
     * @return RefundCollection
     * @throws ApiException
     */
    public function refunds()
    {
        if (!isset($this->_links->refunds->href)) {
            return new \Mollie\Api\Resources\RefundCollection($this->client, 0, null);
        }
        $result = $this->client->performHttpCallToFullUrl(\Mollie\Api\MollieApiClient::HTTP_GET, $this->_links->refunds->href);
        return \Mollie\Api\Resources\ResourceFactory::createCursorResourceCollection($this->client, $result->_embedded->refunds, \Mollie\Api\Resources\Refund::class, $result->_links);
    }
    /**
     * Retrieves all chargebacks associated with this settlement
     *
     * @return ChargebackCollection
     * @throws ApiException
     */
    public function chargebacks()
    {
        if (!isset($this->_links->chargebacks->href)) {
            return new \Mollie\Api\Resources\ChargebackCollection($this->client, 0, null);
        }
        $result = $this->client->performHttpCallToFullUrl(\Mollie\Api\MollieApiClient::HTTP_GET, $this->_links->chargebacks->href);
        return \Mollie\Api\Resources\ResourceFactory::createCursorResourceCollection($this->client, $result->_embedded->chargebacks, \Mollie\Api\Resources\Chargeback::class, $result->_links);
    }
    /**
     * Retrieves all captures associated with this settlement
     *
     * @return CaptureCollection
     * @throws ApiException
     */
    public function captures()
    {
        if (!isset($this->_links->captures->href)) {
            return new \Mollie\Api\Resources\CaptureCollection($this->client, 0, null);
        }
        $result = $this->client->performHttpCallToFullUrl(\Mollie\Api\MollieApiClient::HTTP_GET, $this->_links->captures->href);
        return \Mollie\Api\Resources\ResourceFactory::createCursorResourceCollection($this->client, $result->_embedded->captures, \Mollie\Api\Resources\Capture::class, $result->_links);
    }
}
