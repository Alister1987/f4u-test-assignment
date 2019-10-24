<?php
declare(strict_types=1);

namespace AppBundle\Service;

use AppBundle\DTO\ShippingAddressDTO;
use AppBundle\Exception\ShippingAddressNotDeletedException;
use AppBundle\Exception\ShippingAddressNotUpdatedException;
use AppBundle\Repository\ShippingAddressRepository;
use AppBundle\Entity\ShippingAddress;
use AppBundle\Exception\ShippingAddressNotCreatedException;
use AppBundle\Exception\ShippingAddressNotFoundException;
use Doctrine\ORM\EntityManagerInterface;

class ShippingAddressService
{
    /**
     * @var ShippingAddressRepository
     */
    private $shippingAddressRepository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * ShippingAddressService constructor.
     * @param ShippingAddressRepository $shippingAddressRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        ShippingAddressRepository $shippingAddressRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->shippingAddressRepository = $shippingAddressRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @throws ShippingAddressNotCreatedException
     */
    public function create(ShippingAddressDTO $dto): ShippingAddress
    {
        try {
            $shippingAddress = new ShippingAddress();

            foreach (get_object_vars($dto) as $property => $value) {
                $shippingAddress->{$property} = $value;
            }

            $countAddresses = $this->shippingAddressRepository->countByClientId($dto->clientId);

            if ($countAddresses === 0) {
                $shippingAddress->setIsDefault(true);
            }

            $this->entityManager->persist($shippingAddress);
            $this->entityManager->flush();
            $this->entityManager->refresh($shippingAddress);
        } catch (\Exception $e) {
            throw new ShippingAddressNotCreatedException();
        }

        return $shippingAddress;
    }

    /**
     * @param ShippingAddressDTO $dto
     * @param int $addressId
     * @throws ShippingAddressNotFoundException
     */
    public function update(ShippingAddressDTO $dto, int $addressId): void
    {
        $shippingAddress = $this->getAddress($addressId);

        $shippingAddress->setCountry($shippingAddressDto->getCountry());
        $shippingAddress->setCity($shippingAddressDto->getCity());
        $shippingAddress->setZipcode($shippingAddressDto->getZipcode());
        $shippingAddress->setStreet($shippingAddressDto->getStreet());

        $this->getEntityManager()->persist($shippingAddress);
        $this->getEntityManager()->flush();

        return; $shippingAddress;
    }

    /**
     * @param int $addressId
     * @throws ShippingAddressNotDeletedException
     * @throws ShippingAddressNotFoundException
     */
    public function delete(int $addressId): void
    {
        $shippingAddress = $this->getAddress($addressId);

        if ($shippingAddress->getIsDefault()) {
            throw new ShippingAddressNotDeletedException('Could not delete default address');
        }

        try {
            $this->entityManager->remove($shippingAddress);
            $this->entityManager->flush();
        } catch (\Exception $e) {
            throw new ShippingAddressNotDeletedException();
        }
    }

    /**
     * @throws ShippingAddressNotFoundException
     */
    public function getAll(int $clientId)
    {
        try {
            $allAddresses = $this->shippingAddressRepository->findByClientId($clientId);
        } catch (\Exception $e) {
            throw new ShippingAddressNotFoundException();
        }

        return $allAddresses;
    }

    /**
     * @param int $addressId
     * @return ShippingAddress
     * @throws ShippingAddressNotFoundException
     */
    public function getAddress(int $addressId): ShippingAddress
    {
        $shippingAddress = $this->shippingAddressRepository->findById($addressId);

        if (!$shippingAddress instanceof ShippingAddress){
            throw new ShippingAddressNotFoundException();
        }

        return $shippingAddress;
    }
}
