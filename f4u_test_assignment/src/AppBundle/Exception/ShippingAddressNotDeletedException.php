<?php
declare(strict_types=1);

namespace AppBundle\Exception;

use Throwable;

class ShippingAddressNotDeletedException extends \Exception
{
    public function __construct($message = null, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message ?? 'Shipping Address Not Deleted', $code, $previous);
    }
}