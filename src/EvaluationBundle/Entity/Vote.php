<?php

namespace EvaluationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vote
 *
 * @ORM\Table(name="vote")
 * @ORM\Entity(repositoryClass="EvaluationBundle\Repository\VoteRepository")
 */
class Vote
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
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $user;

    /**
     * @return int
     */
    public function getUser(): int
    {
        return $this->user;
    }

    /**
     * @param int $user
     * @return Vote
     */
    public function setUser(int $user): Vote
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="publication_id", type="integer")
     */
    private $publication;

    /**
     * @return int
     */
    public function getPublication(): int
    {
        return $this->publication;
    }

    /**
     * @param int $publication
     * @return Vote
     */
    public function setPublication(int $publication): Vote
    {
        $this->publication = $publication;
        return $this;
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
}

