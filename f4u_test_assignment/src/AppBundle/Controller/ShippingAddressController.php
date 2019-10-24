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
     * @Route("/api/shipping_address/{clientId}/create", name="create_shipping_address", requirements={"clientId"="\d+"})
     * @throws \Exception
     */
    public function create(
        Request $request,
        int $clientId,
        ShippingAddressService $shippingAddressService
    ): JsonResponse {
        $dto = ShippingAddressDTO::fromArray($request->request->all());
        $dto->clientId = $clientId;

        $shippingAddressService->add($dto, $clientId);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route("/api/shipping_address/{addressId}/update", name="update_shipping_address", requirements={"clientId"="\d+"})
     * @throws \Exception
     */
    public function update(
        Request $request,
        int $addressId,
        ShippingAddressService $shippingAddressService
    ): JsonResponse {
        $dto = ShippingAddressDTO::fromArray($request->request->all());

        $shippingAddressService->update($dto, $addressId);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

}