<?php

namespace AppBundle\Controller;

use AppBundle\Service\ClientService;
use AppBundle\Service\ShippingAddressService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ClientController
{
    /**
     * @Route("/api/client/{clientId}/get", name="get_client", requirements={"clientId"="\d+"})
     * @throws \Exception
     */
    public function get(
        int $clientId,
        ClientService $clientService
    ): JsonResponse {
        $response = $clientService->getClient($clientId);

        return new JsonResponse($response);
    }
}
