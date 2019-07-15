<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\AuthorRepository")
 */

class Author
{

   /**
    * @ORM\OneToMany(targetEntity="Article", mappedBy="author")
    */
    private $articles;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        return $this->name = $name;
    }

    public function __construct() {
        $this->articles = new ArrayCollection();
    }

    /**
     * @return Collection|articles[]
     */

    // public function getArticles(): Collection {
        // return $this->articles;
    // }

}
