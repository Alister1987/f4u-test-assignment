<?php
declare(strict_types=1);

namespace AppBundle\Repository;

use AppBundle\DTO\ShippingAddressDTO;
use AppBundle\Entity\ShippingAddress;
use Doctrine\ORM\EntityRepository;

class ShippingAddressRepository extends EntityRepository
{
    public function addAddress(ShippingAddressDTO $dto)
    {
        $shippingAddress = new ShippingAddress();

        $shippingAddress = ShippingAddress::createFromDto($dto);

        $this->getEntityManager()->persist($shippingAddress);
        $this->getEntityManager()->flush($shippingAddress);
    }
}
