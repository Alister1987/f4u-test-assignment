<?php
declare(strict_types=1);

namespace AppBundle\Ddd\Domain\Client;

use AppBundle\Ddd\Infrastructure\Client\Repository\ClientRepository;
use AppBundle\Ddd\Domain\Client\Exception\ClientNotFoundException;
use AppBundle\Ddd\Infrastructure\Client\Repository\ClientRepository;
use AppBundle\Ddd\Infrastructure\ShippingAddress\Repository\ShippingAddressRepository;

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
