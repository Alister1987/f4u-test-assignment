<?php
declare(strict_types=1);

namespace AppBundle\Exception;

use Throwable;

class ShippingAddressNotFoundException extends \Exception
{
    public function __construct($message = null, $code = 404, Throwable $previous = null)
    {
        parent::__construct($message ?? 'Shipping Address Not Found', $code, $previous);
    }
}