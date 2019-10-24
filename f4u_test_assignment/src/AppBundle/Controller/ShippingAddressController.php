<?php

namespace AppBundle\Controller;

//use App\Service\ShippingAddressService;
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
//    public function __construct(ShippingAddressService $shippingAddressService)
//    {
//        $this->shippingAddressService = $shippingAddressService;
//    }
    /**
     * @Route("/api/shipping_address/{clientId}/add", name="add_shipping_address", requirements={"clientId"="\d+"})
     * @param Request $request
     * @param string $clientId
     * @return JsonResponse
     * @throws \Exception
     */
    public function add(Request $request, string $clientId)
    {
        $dto = ShippingAddress::fromArray($request->request->all());
        echo __FILE__.' '.__LINE__.'<pre>';print_r($dto).'</pre>';die;

        $response = 'ad';
//        $response = $this->shippingAddressService->add($dto, $clientId);

        return new JsonResponse([
            "response" => $response
        ]);
    }
}