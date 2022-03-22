<?php

namespace App\Entity;

use App\Repository\TraitEntityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TraitEntityRepository::class)]
class TraitEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: RepositoryEntity::class, inversedBy: 'code')]
    private $repositoryEntity;

    #[ORM\Column(type: 'text')]
    private $code;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRepositoryEntity(): ?RepositoryEntity
    {
        return $this->repositoryEntity;
    }

    public function setRepo(?RepositoryEntity $repositoryEntity): self
    {
        $this->repositoryEntity = $repositoryEntity;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }
}
