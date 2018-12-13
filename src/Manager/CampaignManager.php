<?php

namespace App\Manager;

use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class CampaignManager
 * @package App\Manager
 */
class CampaignManager extends BaseManager
{
    /**
     * CampaignManager constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry);
        $this->repository = $this->doctrine->getRepository('App:Campaign');
    }
}