<?php

namespace EvaluationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire")
 * @ORM\Entity(repositoryClass="EvaluationBundle\Repository\CommentaireRepository")
 */
class Commentaire
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="texte", type="text")
     */
    private $texte;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $author;

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param string $author
     * @return Commentaire
     */
    public function setAuthor(string $author): Commentaire
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateC", type="datetime")
     */
    private $dateC;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Publication")
     * @ORM\JoinColumn(name="publication_id",referencedColumnName="id")
     */
    private $publication;

    /**
     * Get publication
     *
     * @return int
     */
    public function getPublication()
    {
        return $this->publication;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set texte
     *
     * @param string $texte
     *
     * @return Commentaire
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get texte
     *
     * @return string
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * Set dateC
     *
     * @param \DateTime $dateC
     *
     * @return Commentaire
     */
    public function setDateC($dateC)
    {
        $this->dateC = $dateC;

        return $this;
    }

    /**
     * Get dateC
     *
     * @return \DateTime
     */
    public function getDateC()
    {
        return $this->dateC;
    }
    public function __construct()
    {
        $this->dateC= new \datetime('now');
    }
}

