<?php

namespace AppBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class AbstractTest extends WebTestCase
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function setUp(): void
    {
        $this->container = static::getKernelClass()->getContainer();
    }
}
