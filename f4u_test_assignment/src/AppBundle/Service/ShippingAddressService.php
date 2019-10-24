<?php
declare(strict_types=1);

namespace AppBundle\Service;

use AppBundle\DTO\ShippingAddressDTO;
use AppBundle\Repository\ShippingAddressRepository;
use AppBundle\Repository\ClientRepository;
use AppBundle\Entity\ShippingAddress;
use AppBundle\Exception\ShippingAddressNotCreatedException;

class ShippingAddressService
{
    /**
     * @var ClientRepository
     */
    private $clientRepository;

    /**
     * @var ShippingAddressRepository
     */
    private $shippingAddressRepository;

    public function __construct(
        ClientRepository $clientRepository,
        ShippingAddressRepository $shippingAddressRepository
    ) {
        $this->clientRepository = $clientRepository;
        $this->shippingAddressRepository = $shippingAddressRepository;
    }

    /**
     * @throws ShippingAddressNotCreatedException
     */
    public function add(ShippingAddressDTO $dto, int $clientId): void
    {
        try {
            $this->shippingAddressRepository->addAddress($dto);
        } catch (\Exception $e) {
            throw new ShippingAddressNotCreatedException();
        }
    }

    /**
     * @param integer $clientId
     * @return mixed
     * @throws ClientNotFoundException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Exception
     */
    private function getClient(int $clientId)
    {
        $client = $this->clientRepository->findById($clientId);

        if (!$client) {
            throw new ClientNotFoundException;
        }

        return $client;
    }
}
