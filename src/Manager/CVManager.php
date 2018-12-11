<?php

namespace App\Manager;

use App\Entity\CurriculumVitae;
use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class CVManager
 * @package App\Manager
 */
class CVManager extends BaseManager
{
    /**
     * CustomerManager constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry);
        $this->repository = $this->doctrine->getRepository('App:CurriculumVitae');
    }

    /**
     * @param string $filename
     * @return CurriculumVitae
     */
    public function create(string $filename): CurriculumVitae
    {
        $cv = new CurriculumVitae();
        $cv->setFilename($filename);

        $this->register($cv);

        return $cv;
    }
}