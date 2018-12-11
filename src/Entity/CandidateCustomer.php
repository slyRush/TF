<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CandidateCustomerRepository")
 */
class CandidateCustomer
{
    use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     */
    private $affectedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $rejectedAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Candidate", inversedBy="cc")
     * @ORM\JoinColumn(name="candidate_id", referencedColumnName="id")
     */
    protected $candidate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer", inversedBy="cc")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     * */
    protected $customer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAffectedAt(): ?\DateTimeInterface
    {
        return $this->affectedAt;
    }

    public function setAffectedAt(\DateTimeInterface $affectedAt): self
    {
        $this->affectedAt = $affectedAt;

        return $this;
    }

    public function getRejectedAt(): ?\DateTimeInterface
    {
        return $this->rejectedAt;
    }

    public function setRejectedAt(?\DateTimeInterface $rejectedAt): self
    {
        $this->rejectedAt = $rejectedAt;

        return $this;
    }

    public function getCandidate(): ?Candidate
    {
        return $this->candidate;
    }

    public function setCandidate(?Candidate $candidate): self
    {
        $this->candidate = $candidate;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }
}
