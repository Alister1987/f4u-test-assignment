<?php
declare(strict_types=1);

namespace AppBundle\DTO;

class ShippingAddress
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
     * @param $array
     * @return ShippingAddress
     */
    public static function fromArray($array)
    {
        $self = new self();

        $self->country = $array['country'];
        $self->city = $array['city'];
        $self->zipcode = $array['zipcode'];
        $self->street = $array['street'];

        return $self;
    }
}