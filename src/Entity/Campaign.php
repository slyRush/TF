<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CampaignRepository")
 */
class Campaign
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
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $moneyIn;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $moneyOut;

    /**
     * @var $customer
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer", inversedBy="campaign")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=true)
     */
    private $customer;

    /**
     * @var $campaignCandidate
     *
     * @ORM\OneToMany(targetEntity="App\Entity\CampaignCandidate", mappedBy="campaign", cascade={"persist"})
     */
    private $campaignCandidate;

    public function __construct()
    {
        $this->campaignCandidate = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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

    /**
     * @return Collection|CampaignCandidate[]
     */
    public function getCampaignCandidate(): Collection
    {
        return $this->campaignCandidate;
    }

    public function addCampaignCandidate(CampaignCandidate $campaignCandidate): self
    {
        if (!$this->campaignCandidate->contains($campaignCandidate)) {
            $this->campaignCandidate[] = $campaignCandidate;
            $campaignCandidate->setCampaign($this);
        }

        return $this;
    }

    public function removeCampaignCandidate(CampaignCandidate $campaignCandidate): self
    {
        if ($this->campaignCandidate->contains($campaignCandidate)) {
            $this->campaignCandidate->removeElement($campaignCandidate);
            // set the owning side to null (unless already changed)
            if ($campaignCandidate->getCampaign() === $this) {
                $campaignCandidate->setCampaign(null);
            }
        }

        return $this;
    }

    public function getMoneyIn(): ?float
    {
        return $this->moneyIn;
    }

    public function setMoneyIn(?float $moneyIn): self
    {
        $this->moneyIn = $moneyIn;

        return $this;
    }

    public function getMoneyOut(): ?float
    {
        return $this->moneyOut;
    }

    public function setMoneyOut(?float $moneyOut): self
    {
        $this->moneyOut = $moneyOut;

        return $this;
    }
}
