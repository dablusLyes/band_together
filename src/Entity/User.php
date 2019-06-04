<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"email"}, message="L'adresse email est déjà utilisée")
 * @UniqueEntity(fields={"username"}, message="Ce nom d'utilisateur est déjà utilisé")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank(message = "Merci de renseigner une adresse email")
     * @Assert\Email(message="Veuillez renseigner un email valide",groups={"registration"})
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     *
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message = "Merci de choisir un mot de passe", groups={"registration"})
     * @Assert\EqualTo(propertyPath="passwordConfirm", message="Les mots de passe ne correspondent pas")
     * @Assert\Length(
     *      min = 8,
     *      max = 30,
     *      minMessage = "Le mot de passe doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Le mot de passe ne doit pas faire plus de {{ limit }} caractères"
     * )
     */
    private $password;

    /*
     * @Assert\EqualTo(propertyPath="password", message="Les mots de passe ne correspondent pas")
     */
    public $passwordConfirm;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $token;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="Merci de choisir un nom d'utilisateur",groups={"registration","Profil"})
     * @Assert\Length(
     *      groups={"registration","Profil"},
     *      min = 4,
     *      max = 30,
     *      minMessage = "Le nom d'utilisateur doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Le nom d'utilisateur doit faire moins de {{ limit }} caractères"
     * )
     */
    private $username;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;


    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Instruments", inversedBy="users")
     */
    private $instruments;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Departements", inversedBy="users")
     */
    private $departement;


    public function __construct()
    {
        $this->instruments = new ArrayCollection();

    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password = null): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken()
    {
        $strings = 'azertTYUIOplqsdfg2654786589BVDSqksppkfdsq';
        $token = '';

        for ($i=0; $i < 100; $i++) {
          $token .= $strings[rand(0, strlen($strings) - 1)];
        }

        $this->token = $token;
    }

    public function setUsername(string $username = null): self
    {
        $this->username = $username;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }



    /**
     * @return Collection|Instruments[]
     */
    public function getInstruments(): Collection
    {
        return $this->instruments;
    }

    public function addInstrument(Instruments $instrument): self
    {
        if (!$this->instruments->contains($instrument)) {
            $this->instruments[] = $instrument;
        }

        return $this;
    }

    public function removeInstrument(Instruments $instrument): self
    {
        if ($this->instruments->contains($instrument)) {
            $this->instruments->removeElement($instrument);
        }

        return $this;
    }

    public function getDepartement(): ?Departements
    {
        return $this->departement;
    }

    public function setDepartement(?Departements $departement): self
    {
        $this->departement = $departement;

        return $this;
    }



}
