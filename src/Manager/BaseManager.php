<?php

namespace App\Manager;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class BaseManager
 * @package App\Manager
 */
class BaseManager
{
    /**
     * @var ObjectRepository
     */
    protected $repository;

    /**
     * @var ObjectManager
     */
    protected $doctrine;

    /**
     * BaseManager constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        $this->doctrine = $registry->getManager();
    }

    /**
     * @return ObjectRepository
     */
    public function getRepository(): ObjectRepository
    {
        return $this->repository;
    }

    /**
     * @return ObjectManager
     */
    public function getDoctrine(): ObjectManager
    {
        return $this->doctrine;
    }

    /**
     * Persist and flush new entry
     * @param $entity
     */
    public function register($entity): void
    {
        $this->doctrine->persist($entity);
        $this->doctrine->flush();
    }
}