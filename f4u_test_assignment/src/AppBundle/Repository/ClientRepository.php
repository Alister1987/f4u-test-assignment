<?php
declare(strict_types=1);

namespace AppBundle\Repository;

use AppBundle\Entity\Client;
use Doctrine\ORM\EntityRepository;

class ClientRepository extends EntityRepository
{
    public function findById(int $clientId): ?Client
    {
        return $this->createQueryBuilder('c')
            ->where('c.id = :clientId')
            ->setParameter('clientId', $clientId)
            ->getQuery()
            ->setMaxResults(1)
            ->getOneOrNullResult()
            ;
    }
}
