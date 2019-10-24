<?php

namespace AppBundle\Tests\Service;

use AppBundle\DTO\ShippingAddressDTO;
use AppBundle\Entity\Client;
use AppBundle\Entity\ShippingAddress;
use AppBundle\Exception\ShippingAddressNotFoundException;
use AppBundle\Repository\ShippingAddressRepository;
use AppBundle\Service\ShippingAddressService;
use AppBundle\Tests\AbstractTest;
use Doctrine\ORM\EntityManagerInterface;

class ShippingAddressServiceTest extends AbstractTest
{
    public function testCreate()
    {
        /** @var ShippingAddressService $shippingAddressService */
        $shippingAddressService = $this->container->get(ShippingAddressService::class);
        $entityManager = $this->container->get(EntityManagerInterface::class);
        $shippingAddressRepository = $this->container->get(ShippingAddressRepository::class);

        $client = new Client();
        $client->setFirstName('First name');
        $client->setLastName('Last name');

        $entityManager->persist($client);
        $entityManager->flush();

        $dto = new ShippingAddressDTO();
        $dto->country = 'Test country';
        $dto->city = 'Test city';
        $dto->zipcode = '1234456';
        $dto->street = 'Test street';
        $dto->clientId = $client->getId();

        $shippingAddressService->create($dto);

        /** @var ShippingAddress $shippingAddress */
        $shippingAddress = $shippingAddressRepository->createQueryBuilder('sa')
            ->getQuery()
            ->setMaxResults(1)
            ->getOneOrNullResult();

        $this->assertInstanceOf(ShippingAddress::class, $shippingAddress);

        $this->assertEquals($dto->country, $shippingAddress->getCountry());
        $this->assertEquals($dto->city, $shippingAddress->getCity());
        $this->assertEquals($dto->zipcode, $shippingAddress->getZipcode());
        $this->assertEquals($dto->street, $shippingAddress->getStreet());
        $this->assertEquals($dto->clientId, $shippingAddress->getClientId());
    }

    public function testUpdate()
    {
        /** @var ShippingAddressService $shippingAddressService */
        $shippingAddressService = $this->container->get(ShippingAddressService::class);
        $entityManager = $this->container->get(EntityManagerInterface::class);
        $shippingAddressRepository = $this->container->get(ShippingAddressRepository::class);

        $client = new Client();
        $client->setFirstName('First name');
        $client->setLastName('Last name');

        $entityManager->persist($client);
        $entityManager->flush();

        $dto = new ShippingAddressDTO();
        $dto->country = 'Test country';
        $dto->city = 'Test city';
        $dto->zipcode = '1234456';
        $dto->street = 'Test street';
        $dto->clientId = $client->getId();

        $shippingAddress = $shippingAddressService->create($dto);

        $dto->country = 'Test country 2';
        $dto->city = 'Test city 2';
        $dto->zipcode = '1234456 2';
        $dto->street = 'Test street 2';

        $shippingAddress = $shippingAddressService->update($dto, $shippingAddress->getId());

        $this->assertInstanceOf(ShippingAddress::class, $shippingAddress);

        $this->assertEquals($dto->country, $shippingAddress->getCountry());
        $this->assertEquals($dto->city, $shippingAddress->getCity());
        $this->assertEquals($dto->zipcode, $shippingAddress->getZipcode());
        $this->assertEquals($dto->street, $shippingAddress->getStreet());
        $this->assertEquals($dto->clientId, $shippingAddress->getClientId());
    }

    public function testDelete()
    {
        /** @var ShippingAddressService $shippingAddressService */
        $shippingAddressService = $this->container->get(ShippingAddressService::class);
        $entityManager = $this->container->get(EntityManagerInterface::class);
        $shippingAddressRepository = $this->container->get(ShippingAddressRepository::class);

        $client = new Client();
        $client->setFirstName('First name');
        $client->setLastName('Last name');

        $entityManager->persist($client);
        $entityManager->flush();

        $dto = new ShippingAddressDTO();
        $dto->country = 'Test country';
        $dto->city = 'Test city';
        $dto->zipcode = '1234456';
        $dto->street = 'Test street';
        $dto->clientId = $client->getId();

        $shippingAddress = $shippingAddressService->create($dto);

        $addressId = $shippingAddress->getId();

        $shippingAddress = $shippingAddressService->delete($addressId);

        $this->expectException(ShippingAddressNotFoundException::class);

        $shippingAddressService->getAddress($addressId);
    }

    public function testGet()
    {
        /** @var ShippingAddressService $shippingAddressService */
        $shippingAddressService = $this->container->get(ShippingAddressService::class);
        $entityManager = $this->container->get(EntityManagerInterface::class);
        $shippingAddressRepository = $this->container->get(ShippingAddressRepository::class);

        $client = new Client();
        $client->setFirstName('First name');
        $client->setLastName('Last name');

        $entityManager->persist($client);
        $entityManager->flush();

        $dto = new ShippingAddressDTO();
        $dto->country = 'Test country';
        $dto->city = 'Test city';
        $dto->zipcode = '1234456';
        $dto->street = 'Test street';
        $dto->clientId = $client->getId();

        $shippingAddress = $shippingAddressService->create($dto);

        $addressId = $shippingAddress->getId();

        $shippingAddress = $shippingAddressService->getAddress($addressId);

        $this->assertInstanceOf(ShippingAddress::class, $shippingAddress);
    }
}
