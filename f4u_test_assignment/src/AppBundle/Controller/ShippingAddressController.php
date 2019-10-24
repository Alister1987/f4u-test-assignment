<?php

namespace AppBundle\Controller;

//use App\Service\ShippingAddressService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\DTO\ShippingAddress;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Service\ShippingAddressService;

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
    public function add(Request $request, string $clientId, ShippingAddressService $shippingAddressService): JsonResponse
    {
        $dto = ShippingAddress::fromArray($request->request->all());

        $response = $shippingAddressService->add($dto, $clientId);
        echo __FILE__.' '.__LINE__.'<pre>';print_r($dto).'</pre>';die;

        return new JsonResponse([
            "response" => $response
        ]);
    }
}