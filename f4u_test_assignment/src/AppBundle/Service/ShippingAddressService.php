<?php
declare(strict_types=1);

namespace AppBundle\Service;

use AppBundle\DTO\ShippingAddressDTO;
use AppBundle\Exception\ShippingAddressNotUpdatedException;
use AppBundle\Repository\ShippingAddressRepository;
use AppBundle\Repository\ClientRepository;
use AppBundle\Entity\ShippingAddress;
use AppBundle\Exception\ShippingAddressNotCreatedException;
use AppBundle\Exception\ShippingAddressNotFoundException;

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
    public function create(ShippingAddressDTO $dto, int $clientId): void
    {
        try {
            $this->shippingAddressRepository->addAddress($dto);
        } catch (\Exception $e) {
            throw new ShippingAddressNotCreatedException();
        }
    }

    /**
     * @throws ShippingAddressNotCreatedException
     */
    public function update(ShippingAddressDTO $dto, int $addressId): void
    {
        try {
            $shippingAddress = $this->getAddress($addressId);
            $this->shippingAddressRepository->updateAddress($dto, $shippingAddress);
        } catch (\Exception $e) {
            throw new ShippingAddressNotUpdatedException();
        }
    }

    /**
     * @throws ShippingAddressNotDeletedException
     */
    public function delete(int $clientId, int $addressId): void
    {
        try {
            $countAddresses = $this->shippingAddressRepository->countByClientId($clientId);
            if ($countAddresses > 1) {
                $shippingAddress = $this->getAddress($addressId);
                $this->shippingAddressRepository->delete($shippingAddress);
            }
        } catch (\Exception $e) {
            throw new ShippingAddressNotDeletedException();
        }
    }

    /**
     * @throws ShippingAddressNotFoundException
     */
    public function getAddress(int $addressId): ShippingAddress
    {
        try {
            $shippingAddress = $this->shippingAddressRepository->findById($addressId);
        } catch (\Exception $e) {
            throw new ShippingAddressNotFoundException();
        }

        return $shippingAddress;
    }

//    /**
//     * @param integer $clientId
//     * @return mixed
//     * @throws ClientNotFoundException
//     * @throws \Doctrine\ORM\NonUniqueResultException
//     * @throws \Exception
//     */
//    private function getClient(int $clientId)
//    {
//        $client = $this->clientRepository->findById($clientId);
//
//        if (!$client) {
//            throw new ClientNotFoundException;
//        }
//
//        return $client;
//    }
}
