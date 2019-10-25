<?php
declare(strict_types=1);

namespace AppBundle\Ddd\Domain\Client;

use AppBundle\Ddd\Infrastructure\Client\Repository\ClientRepository;
//use AppBundle\Exception\ClientNotFoundException;
//use AppBundle\Repository\ClientRepository;
//use AppBundle\Repository\ShippingAddressRepository;

class ClientManager
{
    private $clientRepository;

    public function __construct(
        ClientRepository $clientRepository
    ) {
        $this->clientRepository = $clientRepository;
    }

    /**
     * @param integer $clientId
     * @return mixed
     * @throws ClientNotFoundException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Exception
     */
    public function getClient(int $clientId)
    {
        $client = $this->clientRepository->findById($clientId);

        if (!$client) {
            throw new ClientNotFoundException;
        }

        return $client;
    }
}
