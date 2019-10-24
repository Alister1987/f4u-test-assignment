<?php
declare(strict_types=1);

namespace AppBundle\Service;

use AppBundle\Exception\ClientNotFoundException;
use AppBundle\Repository\ClientRepository;
use AppBundle\Repository\ShippingAddressRepository;

class ClientService
{
    private $shippingAddressRepository;

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
