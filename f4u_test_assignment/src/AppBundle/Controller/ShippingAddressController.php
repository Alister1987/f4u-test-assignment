<?php

namespace AppBundle\Controller;

//use App\Service\ShippingAddressService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\DTO\ShippingAddressDTO;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Service\ShippingAddressService;
use Symfony\Component\HttpFoundation\Response;

class ShippingAddressController
{
    /**
     * @var ShippingAddressService
     */
    private $shippingAddressService;

    /**
     * @param ShippingAddressService $shippingAddressService
     */
    public function __construct()
    {
//        $this->shippingAddressService = $shippingAddressService;
    }
    /**
     * @Route("/api/shipping_address/{clientId}/add", name="add_shipping_address", requirements={"clientId"="\d+"})
     * @throws \Exception
     */
    public function add(
        Request $request,
        string $clientId,
        ShippingAddressService $shippingAddressService
    ): JsonResponse {
        $dto = ShippingAddressDTO::fromArray($request->request->all());
        $dto->clientId = $clientId;

        $shippingAddressService->add($dto, $clientId);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}