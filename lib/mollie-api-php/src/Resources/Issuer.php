<?php

namespace Mollie\Api\Resources;

class Issuer extends \Mollie\Api\Resources\BaseResource
{
    /**
     * ID of the issuer.
     *
     * @var string
     */
    public $id;
    /**
     * Name of the issuer.
     *
     * @var string
     */
    public $name;
    /**
     * The payment method this issuer belongs to.
     *
     * @see Mollie_API_Object_Method
     * @var string
     */
    public $method;
    /**
     * Object containing a size1x or size2x image
     *
     * @var \stdClass
     */
    public $image;
}
