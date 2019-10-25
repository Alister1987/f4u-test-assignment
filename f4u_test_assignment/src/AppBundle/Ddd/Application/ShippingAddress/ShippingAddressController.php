<?php

namespace AppBundle\Ddd\Application\ShippingAddress;

use AppBundle\Ddd\Domain\ShippingAddress\Transformer;
use AppBundle\Tests\Service\ShippingAddressServiceTest;
use AppBundle\Ddd\Domain\ShippingAddress\Entity\ShippingAddress;
use AppBundle\Ddd\Domain\ShippingAddress\Exception\ShippingAddressNotDeletedException;
use AppBundle\Ddd\Domain\ShippingAddress\Exception\ShippingAddressNotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Ddd\Domain\ShippingAddress\DTO\ShippingAddressDTO;
use AppBundle\Ddd\Domain\ShippingAddress\ShippingAddressManager;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class ShippingAddressController
{
    /**
     * @Route("/api/shipping_address/{addressId}", methods={"get"}, name="create_shipping_address", requirements={"addressId"="\d+"})
     * @throws \Exception
     */
    public function getOne($addressId, ShippingAddressManager $shippingAddressService): JsonResponse
    {
        try {
            $shippingAddress = $shippingAddressService->getAddress($addressId);
        } catch (ShippingAddressNotFoundException $exception) {
            return new JsonResponse(['error' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse(Transformer::prepareEntity($shippingAddress));
    }

    /**
     * @Route("/api/shipping_address/{addressId}", methods={"put"}, name="update_shipping_address", requirements={"addressId"="\d+"})
     * @throws \Exception
     */
    public function update(
        Request $request,
        int $addressId,
        ShippingAddressManager $shippingAddressService
    ): JsonResponse {
        $dto = ShippingAddressDTO::fromArray($request->request->all());

        try {
            $shippingAddress = $shippingAddressService->update($dto, $addressId);
        } catch (ShippingAddressNotFoundException $exception) {
            return new JsonResponse(['error' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse(Transformer::prepareEntity($shippingAddress), Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route("/api/shipping_address/{addressId}", methods={"delete"}, name="delete_shipping_address", requirements={"addressId"="\d+"})
     * @throws \Exception
     */
    public function delete(
        int $addressId,
        ShippingAddressManager $shippingAddressService
    ): JsonResponse {
        try {
            $shippingAddressService->delete($addressId);
        } catch (ShippingAddressNotDeletedException $exception) {
            return new JsonResponse(['error' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (ShippingAddressNotFoundException $exception) {
            return new JsonResponse(['error' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route("/api/shipping_address/{clientId}/get_all", name="get_all_shipping_address", requirements={"clientId"="\d+"})
     * @throws \Exception
     */
    public function getAll(
        int $clientId,
        ShippingAddressManager $shippingAddressService
    ): JsonResponse {
        $response = $shippingAddressService->getAll($clientId);

        return new JsonResponse($response);
    }

    /**
     * @Route("/api/shipping_address", methods={"post"})
     * @throws \Exception
     */
    public function create(
        Request $request,
        ShippingAddressManager $shippingAddressService
    ): JsonResponse {
        $dto = ShippingAddressDTO::fromArray($request->request->all());

        $shippingAddress = $shippingAddressService->create($dto);

        return new JsonResponse(Transformer::prepareEntity($shippingAddress), Response::HTTP_CREATED);
    }

}