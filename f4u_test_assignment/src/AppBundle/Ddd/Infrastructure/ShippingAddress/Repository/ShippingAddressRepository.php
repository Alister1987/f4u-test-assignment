<?php
declare(strict_types=1);

namespace AppBundle\Ddd\Infrastructure\ShippingAddress\Repository;

use AppBundle\DTO\ShippingAddressDTO;
use AppBundle\Entity\ShippingAddress;
use Doctrine\ORM\EntityRepository;

class ShippingAddressRepository extends EntityRepository
{
    public function findById(int $shippingAddressId): ?ShippingAddress
    {
        return $this->createQueryBuilder('sa')
            ->where('sa.id = :shippingAddressId')
            ->setParameter('shippingAddressId', $shippingAddressId)
            ->getQuery()
            ->setMaxResults(1)
            ->getOneOrNullResult()
            ;
    }

    public function findByClientId(int $clientId)
    {
        return $this->createQueryBuilder('sa')
            ->where('sa.clientId = :client_id')
            ->setParameter('client_id', $clientId)
            ->getQuery()
            ->getArrayResult()
            ;
    }

    public function countByClientId(int $clientId): int
    {
        return (int) $this->createQueryBuilder('sa')
            ->select('count(sa.id)')
            ->where('sa.clientId = :client_id')
            ->setParameter('client_id', $clientId)
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }
}
