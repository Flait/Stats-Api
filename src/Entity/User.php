<?php

namespace App\Entity;

use App\Entity\Attribute\Weight;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    private ?string $name = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $registrationDate = null;

    /**
     * @var Collection<int, Weight>
     */
    #[ORM\OneToMany(targetEntity: Weight::class, mappedBy: 'user')]
    private Collection $weights;

    public function __construct()
    {
        $this->weights = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getRegistrationDate(): ?\DateTimeImmutable
    {
        return $this->registrationDate;
    }

    public function setRegistrationDate(\DateTimeImmutable $registrationDate): static
    {
        $this->registrationDate = $registrationDate;

        return $this;
    }

    /**
     * @return Collection<int, Weight>
     */
    public function getWeights(): Collection
    {
        return $this->weights;
    }

    public function addWeight(Weight $weight): static
    {
        if (!$this->weights->contains($weight)) {
            $this->weights->add($weight);
            $weight->setUser($this);
        }

        return $this;
    }

    public function removeWeight(Weight $weight): static
    {
        if ($this->weights->removeElement($weight)) {
            // set the owning side to null (unless already changed)
            if ($weight->getUser() === $this) {
                $weight->setUser(null);
            }
        }

        return $this;
    }
}
