<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 */
class Contact
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $client;

    /**
     * @ORM\Column(type="integer")
     */
    private $idOwner;
    private $contact;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?int
    {
        return $this->client;
    }

    public function setClient(int $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getIdOwner(): ?int
    {
        return $this->idOwner;
    }

    public function setIdOwner(int $idOwner): self
    {
        $this->idOwner = $idOwner;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->$contact;
    }

    public function setContact(string $contact): self
    {
        $this->contact= $contact;
        return $this;
    }
}
