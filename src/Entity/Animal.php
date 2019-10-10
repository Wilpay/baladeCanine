<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="animals")
     */
    private $maitre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    private $file;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CategorieAnimal", inversedBy="animals")
     */
    private $categorie;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Caractere", inversedBy="animals")
     */
    private $caracteres;


    public function __construct()
    {
        $this->caracteres = new ArrayCollection();
    }

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

    public function getCategorie(): ?CategorieAnimal
    {
        return $this->categorie;
    }

    public function setCategorie(?CategorieAnimal $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection|Caractere[]
     */
    public function getCaracteres(): Collection
    {
        return $this->caracteres;
    }

    public function addCaractere(Caractere $caractere): self
    {
        if (!$this->caracteres->contains($caractere)) {
            $this->caracteres[] = $caractere;
        }

        return $this;
    }

    public function removeCaractere(Caractere $caractere): self
    {
        if ($this->caracteres->contains($caractere)) {
            $this->caracteres->removeElement($caractere);
        }

        return $this;
    }




}
