<?php
declare(strict_types=1);

namespace App\Entity;

use Symfony\Component\Validator\Constraints\Country;

class ShippingAddress
{
    /**
     * @var Country
     */
    protected $country;

    /**
     * @var City
     */
    protected $city;

    /**
     * @var Zipcode
     */
    protected $zipcode;

    /**
     * @var Street
     */
    protected $street;

    /**
     * ShippingAddress constructor.
     * @param Country
     * @param City
     * @param Zipcode
     * @param Street
     */
    public function __construct($country, $city, $zipcode, $street)
    {
        $this->country = $country;
        $this->city = $city;
        $this->zipcode = $zipcode;
        $this->street = $street;
    }

}
