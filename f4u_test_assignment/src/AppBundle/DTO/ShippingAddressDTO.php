<?php
declare(strict_types=1);

namespace AppBundle\DTO;

class ShippingAddressDTO
{
    /**
     * @var string
     */
    public $country;

    /**
     * @var string
     */
    public $city;

    /**
     * @var string
     */
    public $zipcode;

    /**
     * @var string
     */
    public $street;

    /**
     * @var int
     */
    public $clientId;

    public static function fromArray(array $array): ShippingAddressDTO
    {
        $self = new self();

        $self->country = $array['country'];
        $self->city = $array['city'];
        $self->zipcode = $array['zipcode'];
        $self->street = $array['street'];

        return $self;
    }
}
