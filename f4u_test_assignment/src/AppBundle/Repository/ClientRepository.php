<?php
declare(strict_types=1);

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ClientRepository extends EntityRepository
{
    public function findById(int $clientId)
    {
        return $this->createQueryBuilder('c')
            ->where('c.id = :clientId')
            ->setParameter('clientId', $clientId)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
}
