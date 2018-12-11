<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CustomerRepository")
 */
class Customer
{
    use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $company_name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $company_description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $manager_fullname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $manager_tel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $manager_linkedin;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $manager_fb;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CandidateCustomer", mappedBy="customer", cascade={"persist"})
     * */
    protected $cc;

    public function __construct()
    {
        $this->cc = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanyName(): ?string
    {
        return $this->company_name;
    }

    public function setCompanyName(string $company_name): self
    {
        $this->company_name = $company_name;

        return $this;
    }

    public function getCompanyDescription(): ?string
    {
        return $this->company_description;
    }

    public function setCompanyDescription(?string $company_description): self
    {
        $this->company_description = $company_description;

        return $this;
    }

    public function getManagerFullname(): ?string
    {
        return $this->manager_fullname;
    }

    public function setManagerFullname(string $manager_fullname): self
    {
        $this->manager_fullname = $manager_fullname;

        return $this;
    }

    public function getManagerTel(): ?string
    {
        return $this->manager_tel;
    }

    public function setManagerTel(?string $manager_tel): self
    {
        $this->manager_tel = $manager_tel;

        return $this;
    }

    public function getManagerLinkedin(): ?string
    {
        return $this->manager_linkedin;
    }

    public function setManagerLinkedin(?string $manager_linkedin): self
    {
        $this->manager_linkedin = $manager_linkedin;

        return $this;
    }

    public function getManagerFb(): ?string
    {
        return $this->manager_fb;
    }

    public function setManagerFb(?string $manager_fb): self
    {
        $this->manager_fb = $manager_fb;

        return $this;
    }

    /**
     * @return Collection|CandidateCustomer[]
     */
    public function getCc(): Collection
    {
        return $this->cc;
    }

    public function addCc(CandidateCustomer $cc): self
    {
        if (!$this->cc->contains($cc)) {
            $this->cc[] = $cc;
            $cc->setCustomer($this);
        }

        return $this;
    }

    public function removeCc(CandidateCustomer $cc): self
    {
        if ($this->cc->contains($cc)) {
            $this->cc->removeElement($cc);
            // set the owning side to null (unless already changed)
            if ($cc->getCustomer() === $this) {
                $cc->setCustomer(null);
            }
        }

        return $this;
    }
}
