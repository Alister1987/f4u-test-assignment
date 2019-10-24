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

        $shippingAddressService->create($dto, $clientId);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route("/api/shipping_address/{addressId}/update", name="update_shipping_address", requirements={"addressId"="\d+"})
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

    /**
     * @Route("/api/shipping_address/{clientId}/{addressId}/delete", name="delete_shipping_address", requirements={"clientId"="\d+", "addressId"="\d+"})
     * @throws \Exception
     */
    public function delete(
        int $clientId,
        int $addressId,
        ShippingAddressService $shippingAddressService
    ): JsonResponse {
        $shippingAddressService->delete($clientId, $addressId);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route("/api/shipping_address/{clientId}/get_all", name="get_all_shipping_address", requirements={"clientId"="\d+"})
     * @throws \Exception
     */
    public function getAll(
        int $clientId,
        ShippingAddressService $shippingAddressService
    ): JsonResponse {
        $shippingAddressService->getAll($clientId);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

}