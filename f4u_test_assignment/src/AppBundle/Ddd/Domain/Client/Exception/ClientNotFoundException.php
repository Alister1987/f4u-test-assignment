<?php
declare(strict_types=1);

namespace AppBundle\Ddd\Domain\Client\Exception;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ClientNotFoundException extends NotFoundHttpException
{
    public function __construct()
    {
        parent::__construct("Client not found");
    }
}
