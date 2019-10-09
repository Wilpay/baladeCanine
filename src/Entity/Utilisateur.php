<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @UniqueEntity(fields={"mail"}, message="Cet email est déja enregistrer!")
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
 */
class Utilisateur implements UserInterface
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
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @Assert\NotBlank(message="Votre email ne doit pas être vide!")
     * @Assert\Email(message="Mail non valide!")
     *
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $mail;

    /**
     * @Assert\NotBlank(message="Votre numéro de téléphone ne doit pas être vide")
     * @Assert\Regex(pattern="/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/i", message="Téléphone non valide!")
     *
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     *
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    private $passwordPlain;
    /**
     * @ORM\Column(name="roles", type="json_array")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codePostal;

    /**
     * @ORM\Column(type="boolean")
     */
    private $vip;

    /**
     * @ORM\Column(type="boolean")
     */
    private $prenium;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Sexe", cascade={"persist", "remove"})
     */
    private $sexe;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Animal", mappedBy="maitre")
     */
    private $animals;

    public function __construct()
    {
        $this->animals = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     */
    public function setTelephone($telephone): void
    {
        $this->telephone = $telephone;
    }

    /**
     * @return mixed
     */
    public function getPasswordPlain()
    {
        return $this->passwordPlain;
    }

    /**
     * @param mixed $passwordPlain
     */
    public function setPasswordPlain($passwordPlain): void
    {
        $this->passwordPlain = $passwordPlain;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     */
    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }


    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getVip(): ?bool
    {
        return $this->vip;
    }

    public function setVip(bool $vip): self
    {
        $this->vip = $vip;

        return $this;
    }

    public function getPrenium(): ?bool
    {
        return $this->prenium;
    }

    public function setPrenium(bool $prenium): self
    {
        $this->prenium = $prenium;

        return $this;
    }

    public function getSexe(): ?Sexe
    {
        return $this->sexe;
    }

    public function setSexe(?Sexe $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * @return Collection|Animal[]
     */
    public function getAnimals(): Collection
    {
        return $this->animals;
    }

    public function addAnimal(Animal $animal): self
    {
        if (!$this->animals->contains($animal)) {
            $this->animals[] = $animal;
            $animal->setMaitre($this);
        }

        return $this;
    }

    public function removeAnimal(Animal $animal): self
    {
        if ($this->animals->contains($animal)) {
            $this->animals->removeElement($animal);
            // set the owning side to null (unless already changed)
            if ($animal->getMaitre() === $this) {
                $animal->setMaitre(null);
            }
        }

        return $this;
    }
    
}
