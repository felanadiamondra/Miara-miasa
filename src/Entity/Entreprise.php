<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EntrepriseRepository::class)
 */
class Entreprise
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $Adresse;


    /**
     * @ORM\Column(type="integer")
     *  @Assert\Length(min=3, max=3)
     */
    private $Code;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $Ville;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Length(min="8", minMessage="Password must have 8 characters")
     * @Assert\EqualTo(propertyPath="confirmpass", message="Two password doesn't match")
     */

    private $Password;
    /**
     * @Assert\EqualTo(propertyPath="Password", message="Two password doesn't match")
     */
    private $confirmpass; // confirm password n'a rien avoir avec la base de onnée donc pas de @ORM

    /**
     * @ORM\Column(type="text")
     */
    private $Description;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $Email;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="entreprises")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getCode(): ?int
    {
        return $this->Code;
    }

    public function setCode(int $Code): self
    {
        $this->Code = $Code;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->Ville;
    }

    public function setVille(string $Ville): self
    {
        $this->Ville = $Ville;

        return $this;
    }
    public function getPassword(): ?string
    {
        return $this->Password;
    }

    public function setPassword(string $Password): self
    {
        $this->Password = $Password;

        return $this;
    }
    public function getConfirmpass(): ?string
    {
        return $this->confirmpass;
    }

    public function setConfirmpass(string $cpassword): self
    {
        $this->confirmpass = $cpassword;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
