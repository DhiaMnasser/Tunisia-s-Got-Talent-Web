<?php

namespace AssistanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Appreciation
 *
 * @ORM\Table(name="appreciation")
 * @ORM\Entity(repositoryClass="AssistanceBundle\Repository\AppreciationRepository")
 */
class Appreciation
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
     * @var int
     *
     * @ORM\Column(name="dislike", type="integer")
     */
    private $dislike;
    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="EvaluationBundle\Entity\Publication")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $publication;

    /**
     * @return mixed
     */
    public function getPublication()
    {
        return $this->publication;
    }

    /**
     * @param mixed $Publication
     */
    public function setPublication($Publication)
    {
        $this->publication = $Publication;
    }

    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="likes", type="integer")
     */
    private $likes;


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
     * Set dislike
     *
     * @param integer $dislike
     *
     * @return Appreciation
     */
    public function setDislike($dislike)
    {
        $this->dislike = $dislike;

        return $this;
    }

    /**
     * Get dislike
     *
     * @return int
     */
    public function getDislike()
    {
        return $this->dislike;
    }

    /**
     * Set likes
     *
     * @param integer $likes
     *
     * @return Appreciation
     */
    public function setLikes($likes)
    {
        $this->likes = $likes;

        return $this;
    }

    /**
     * Get likes
     *
     * @return int
     */
    public function getLikes()
    {
        return $this->likes;
    }


}

