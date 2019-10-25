<?php

namespace AppBundle\Ddd\Domain\ShippingAddress\Transformer;

class ShippingAddressTransformer
{
    /**
     * @param ShippingAddress $shippingAddress
     * @return array
     */
    public function prepareEntity(ShippingAddress $shippingAddress): array
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