<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CandidateRepository")
 */
class Candidate
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
     * @Assert\NotBlank()
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastname;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $note;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     */
    private $job_title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $job_description;

    /**
     * @ORM\Column(type="boolean", nullable=true, options={"default": false})
     */
    private $in_post;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\File(
     *     maxSize = "5M",
     *     mimeTypes={"image/*"},
     *     mimeTypesMessage = "Veuillez télécharger une image valide !"
     * )
     */
    private $avatar;

    /**
     * @var $level
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Level", inversedBy="candidate", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $level;

    /**
     * @var $cv
     *
     * @ORM\OneToMany(targetEntity="App\Entity\CurriculumVitae", mappedBy="candidate", cascade={"persist", "remove"})
     */
    private $cv;

    /**
     * @var $cc
     *
     * @ORM\OneToMany(targetEntity="App\Entity\CandidateCustomer", mappedBy="candidate", cascade={"persist"})
     */
    private $cc;

    /**
     * @var $campaignCandidate
     *
     * @ORM\OneToMany(targetEntity="App\Entity\CampaignCandidate", mappedBy="candidate", cascade={"persist"})
     */
    private $campaignCandidate;

    public function __construct()
    {
        $this->cc = new ArrayCollection();
        $this->cv = new ArrayCollection();
        $this->campaignCandidate = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getJobTitle(): ?string
    {
        return $this->job_title;
    }

    public function setJobTitle(?string $job_title): self
    {
        $this->job_title = $job_title;

        return $this;
    }

    public function getJobDescription(): ?string
    {
        return $this->job_description;
    }

    public function setJobDescription(?string $job_description): self
    {
        $this->job_description = $job_description;

        return $this;
    }

    public function getInPost(): ?bool
    {
        return $this->in_post;
    }

    public function setInPost(?bool $in_post): self
    {
        $this->in_post = $in_post;

        return $this;
    }

    public function getLevel(): ?Level
    {
        return $this->level;
    }

    public function setLevel(?Level $level): self
    {
        $this->level = $level;

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
            $cc->setCandidate($this);
        }

        return $this;
    }

    public function removeCc(CandidateCustomer $cc): self
    {
        if ($this->cc->contains($cc)) {
            $this->cc->removeElement($cc);
            // set the owning side to null (unless already changed)
            if ($cc->getCandidate() === $this) {
                $cc->setCandidate(null);
            }
        }

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function setCv(?object $cv): self
    {
        return $this;
    }

    /**
     * @return Collection|CurriculumVitae[]
     */
    public function getCv(): Collection
    {
        return $this->cv;
    }

    public function addCv(CurriculumVitae $cv): self
    {
        if (!$this->cv->contains($cv)) {
            $this->cv[] = $cv;
            $cv->setCandidate($this);
        }

        return $this;
    }

    public function removeCv(CurriculumVitae $cv): self
    {
        if ($this->cv->contains($cv)) {
            $this->cv->removeElement($cv);
            // set the owning side to null (unless already changed)
            if ($cv->getCandidate() === $this) {
                $cv->setCandidate(null);
            }
        }

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
            $campaignCandidate->setCandidate($this);
        }

        return $this;
    }

    public function removeCampaignCandidate(CampaignCandidate $campaignCandidate): self
    {
        if ($this->campaignCandidate->contains($campaignCandidate)) {
            $this->campaignCandidate->removeElement($campaignCandidate);
            // set the owning side to null (unless already changed)
            if ($campaignCandidate->getCandidate() === $this) {
                $campaignCandidate->setCandidate(null);
            }
        }

        return $this;
    }
}
