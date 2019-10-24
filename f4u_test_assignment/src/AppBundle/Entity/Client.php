<?php
declare(strict_types=1);

namespace App\Entity;

use DateTime;

class Client
{
    /**
     * @var FirstName
     */
    protected $first_name;

    /**
     * @var LastName
     */
    protected $last_name;

    /**
     * @var DateTime
     */
    protected $created_at;


    /**
     * Client constructor.
     * @param FirstName $firstname
     * @param LastName $lastname
     */
    public function __construct($first_name, $last_name)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
    }

}
