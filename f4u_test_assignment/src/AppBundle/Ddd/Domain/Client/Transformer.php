<?php

namespace AppBundle\Ddd\Domain\Client;

class Transformer
{
    /**
     * @param ShippingAddress $shippingAddress
     * @return array
     */
    public static function prepareEntity(ShippingAddress $shippingAddress): array
    {
        return [
            'id' => $shippingAddress->getId(),
            'clinet_id' => $shippingAddress->getClientId(),
            'country' => $shippingAddress->getCountry(),
            'city' => $shippingAddress->getCity(),
            'street' => $shippingAddress->getStreet(),
            'zip' => $shippingAddress->getZipcode(),
            'isDefault' => $shippingAddress->getIsDefault(),
        ];
    }
}