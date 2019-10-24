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
        $dto = new self();

        $dto->country = $array['country'];
        $dto->city = $array['city'];
        $dto->zipcode = $array['zipcode'];
        $dto->street = $array['street'];

        return $dto;
    }
}
