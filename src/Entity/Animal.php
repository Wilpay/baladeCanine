<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnimalRepository")
 */
class Animal
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="date")
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $poids;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\CategorieAnimal", cascade={"persist", "remove"})
     */
    private $Categorie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="animals")
     */
    private $maitre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    private $file;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * @param mixed $dateNaissance
     */
    public function setDateNaissance($dateNaissance): void
    {
        $this->dateNaissance = $dateNaissance;
    }



    public function getPoids(): ?float
    {
        return $this->poids;
    }

    public function setPoids(?float $poids): self
    {
        $this->poids = $poids;

        return $this;
    }

    public function getCategorie(): ?CategorieAnimal
    {
        return $this->Categorie;
    }

    public function setCategorie(?CategorieAnimal $Categorie): self
    {
        $this->Categorie = $Categorie;

        return $this;
    }

    public function getMaitre(): ?Utilisateur
    {
        return $this->maitre;
    }

    public function setMaitre(?Utilisateur $maitre): self
    {
        $this->maitre = $maitre;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file): void
    {
        $this->file = $file;
    }


}
