<?php

namespace App\Manager;

use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class CandidateManager
 * @package App\Manager
 */
class CandidateManager extends BaseManager
{
    /**
     * CandidateManager constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry);
        $this->repository = $this->doctrine->getRepository('App:Candidate');
    }
}