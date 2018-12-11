<?php

namespace App\Manager;

use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class CustomerManager
 * @package App\Manager
 */
class CustomerManager extends BaseManager
{
    /**
     * CustomerManager constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry);
        $this->repository = $this->doctrine->getRepository('App:Customer');
    }
}