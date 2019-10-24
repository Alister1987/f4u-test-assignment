<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use AppBundle\DTO\ShippingAddressDTO;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ShippingAddressController
{
    /**
     * @Route("/api/shipping_address/{clientId}/add", name="add_shipping_address", requirements={"clientId"="\d+"})
     * @param Request $request
     * @param string $clientId
     * @return JsonResponse
     * @throws \Exception
     */
    public function add(Request $request, string $clientId)
    {
        $dto = ShippingAddressDTO::fromArray($request->request->all());
        echo __FILE__.' '.__LINE__.'<pre>';print_r($dto).'</pre>';die;

        $response = $this->shippingAddressService->add($dto, $clientId);

        return new JsonResponse([
            "response" => $response
        ]);
    }
}