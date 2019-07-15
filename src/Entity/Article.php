<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */

class Article
{

    /**
     * @ORM\ManyToOne(targetEntity="Author",inversedBy="articles")
     *  @ORM\JoinColumn(name="author_id", referencedColumnName="id", nullable=true)
    */
    private $author;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", length = 100)
     */
    private $title;

   /**
    * @ORM\Column(type="text")
    */
   private $body;

   // Getters and setters

   public function getId() {
       return $this->id;
   }

   public function getTitle() {
       return $this->title;
   }

   public function setTitle($title) {
       $this->title = $title;
   }
   
   public function getBody() {
       return $this->body;
   }

   public function setBody($body) {
       return $this->body = $body;
   }

   public function getAuthor(): ?Author {
       return $this->author;
   }

   public function setAuthor(?Author $author): self {
       $this->author = $author;
       return $this;
   }
}
