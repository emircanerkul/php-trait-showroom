<?php

namespace App\Entity;

use App\Repository\RepositoryEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RepositoryEntityRepository::class)]
class RepositoryEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $url;

    #[ORM\OneToMany(mappedBy: 'repositoryEntity', targetEntity: TraitEntity::class)]
    private $traitEntities;

    public function __construct()
    {
        $this->traitEntities = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return Collection<int, TraitEntity>
     */
    public function getTraitEntities(): Collection
    {
        return $this->traitEntities;
    }

    public function addTraitEntities(TraitEntity $traitEntities): self
    {
        if (!$this->traitEntities->contains($traitEntities)) {
            $this->traitEntities[] = $traitEntities;
            $traitEntities->setRepositoryEntity($this);
        }

        return $this;
    }

    public function removeTraitEntities(TraitEntity $traitEntities): self
    {
        if ($this->traitEntities->removeElement($traitEntities)) {
            // set the owning side to null (unless already changed)
            if ($traitEntities->getRepositoryEntity() === $this) {
                $traitEntities->setRepositoryEntity(null);
            }
        }

        return $this;
    }
}
