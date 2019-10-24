<?php
declare(strict_types=1);

namespace AppBundle\Service;

use AppBundle\DTO\ShippingAddress;
use AppBundle\Repository\ShippingAddressRepository;
use AppBundle\Repository\ClientRepository;

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

    /**
     * @param ClientRepository $clientRepository
     * @param ShippingAddressRepository $shippingAddressRepository
     */
    public function __construct(ClientRepository $clientRepository, ShippingAddressRepository $shippingAddressRepository)
    {
//        echo __FILE__.' '.__LINE__.'<pre>';print_r('ads').'</pre>';die;
        $this->clientRepository = $clientRepository;
        $this->shippingAddressRepository = $shippingAddressRepository;
    }

    /**
     * @param ShippingAddressDTO $dto
     * @param $clientId
     * @return string
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Exception
     */
    public function add(ShippingAddress $dto, int $clientId)
    {
        $client = $this->getClient($clientId);
        echo __FILE__.' '.__LINE__.'<pre>';print_r('$dto').'</pre>';die;
        $shippingAddressId = ShippingAddressId::next();
        /** @var ShippingAddressId $shippingAddressId */
        /** @var Client $client */
        $shippingAddress = new ShippingAddress(
            $shippingAddressId,
            new Address(
                $dto->country,
                $dto->city,
                $dto->zipCode,
                $dto->street
            ),
            $client
        );

        try {
            $client->addShippingAddress($shippingAddress);
            $this->shippingAddressRepository->save($shippingAddress);
        } catch (\Exception $e) {
            throw new UnableToCreateShippingAddressException;
        }

        return true;
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
        dump($client);die;

        if (!$client) {
            throw new ClientNotFoundException;
        }

        return $client;
    }
}
