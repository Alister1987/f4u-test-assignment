<?php

namespace AppBundle\Ddd\Application\Client;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Ddd\Domain\Client\ClientManager;

class ClientController
{
    /**
     * @Route("/api/ddd/{clientId}", name="get_client", requirements={"clientId"="\d+"})
     * @throws \Exception
     */
    public function get(
        int $clientId,
        ClientManager $clientManager
    ): JsonResponse {
        dump($clientManager);die();
        $response = $clientManager->getClient($clientId);

        return new JsonResponse($response);
    }
}
