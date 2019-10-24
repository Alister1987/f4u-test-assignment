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
        $shippingAddress = ShippingAddress::createFromDto($dto);

        $this->getEntityManager()->persist($shippingAddress);
        $this->getEntityManager()->flush();
    }
    public function updateAddress(ShippingAddressDTO $dto, ShippingAddress $shippingAddress)
    {
        $shippingAddressDto = ShippingAddress::createFromDto($dto);

        /** @var ShippingAddress $shippingAddress */
        $shippingAddress->setCountry($shippingAddressDto->getCountry());
        $shippingAddress->setCity($shippingAddressDto->getCity());
        $shippingAddress->setZipcode($shippingAddressDto->getZipcode());
        $shippingAddress->setStreet($shippingAddressDto->getStreet());

        $this->getEntityManager()->persist($shippingAddress);
        $this->getEntityManager()->flush();
    }
    public function delete(ShippingAddress $shippingAddress)
    {
        $this->getEntityManager()->remove($shippingAddress);
        $this->getEntityManager()->flush();
    }
    public function findById(int $shippingAddressId)
    {
        return $this->createQueryBuilder('sa')
            ->where('sa.id = :shippingAddressId')
            ->setParameter('shippingAddressId', $shippingAddressId)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
    public function findByClientId(int $clientId)
    {
        return $this->createQueryBuilder('sa')
            ->where('sa.clientId = :client_id')
            ->setParameter('client_id', $clientId)
            ->getQuery()
            ->getResult()
            ;
    }
    public function countByClientId(int $clientId)
    {
        return $this->createQueryBuilder('sa')
            ->select('count(sa.id)')
            ->where('sa.clientId = :client_id')
            ->setParameter('client_id', $clientId)
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }
}
