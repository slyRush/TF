<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CampaignCandidateRepository")
 */
class CampaignCandidate
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $validByCustomer;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $entryDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $outDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Candidate", inversedBy="campaignCandidate")
     * @ORM\JoinColumn(name="candidate_id", referencedColumnName="id")
     */
    protected $candidate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Campaign", inversedBy="campaignCandidate")
     * @ORM\JoinColumn(name="campaign_id", referencedColumnName="id")
     */
    protected $campaign;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValidByCustomer(): ?bool
    {
        return $this->validByCustomer;
    }

    public function setValidByCustomer(?bool $validByCustomer): self
    {
        $this->validByCustomer = $validByCustomer;

        return $this;
    }

    public function getEntryDate(): ?\DateTimeInterface
    {
        return $this->entryDate;
    }

    public function setEntryDate(?\DateTimeInterface $entryDate): self
    {
        $this->entryDate = $entryDate;

        return $this;
    }

    public function getOutDate(): ?\DateTimeInterface
    {
        return $this->outDate;
    }

    public function setOutDate(?\DateTimeInterface $outDate): self
    {
        $this->outDate = $outDate;

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

    public function getCampaign(): ?Campaign
    {
        return $this->campaign;
    }

    public function setCampaign(?Campaign $campaign): self
    {
        $this->campaign = $campaign;

        return $this;
    }
}
