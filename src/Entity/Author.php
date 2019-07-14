<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\ORM\Mapping as ORM;

  /**
    * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="article")
    */

class Author
{
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


//    Articles methods
    
    private $articles;

    public function __construct() {
        return $this->articles = new ArrayCollection();
    }

    public function getArticles(): Collection {
        return $this-articles;
    }

    // Add methods for addArticle and removeArticle below

}
