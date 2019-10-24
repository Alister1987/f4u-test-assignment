<?php

namespace AppBundle\Tests\Service;

use AppBundle\Entity\Client;
use AppBundle\Repository\ClientRepository;
use AppBundle\Service\ClientService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ClientServiceTest extends WebTestCase
{
    public function testGet()
    {
        /** @var ClientService $clientService */
        $clientService = $this->container->get(ClientService::class);
        /** @var EntityManagerInterface $entityManager */
        $entityManager = $this->container->get(EntityManagerInterface::class);
        /** @var ClientRepository $clientRepository */
        $clientRepository = $this->container->get(ClientRepository::class);

        $client = new Client();
        $client->setFirstName('First name');
        $client->setLastName('Last name');

        $entityManager->persist($client);
        $entityManager->refresh($client);
        $entityManager->flush();

        $client = $clientRepository->findById($client->getId());

        $this->assertInstanceOf(Client::class, $client);
    }
}
