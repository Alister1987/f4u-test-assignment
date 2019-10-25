<?php
declare(strict_types=1);

namespace AppBundle\Ddd\Domain\ShippingAddress\Exception;

use Throwable;

class ShippingAddressNotUpdatedException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct('Shipping Address Not Updated', $code, $previous);
    }
}