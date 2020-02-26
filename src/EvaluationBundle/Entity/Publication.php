<?php

namespace EvaluationBundle\Entity;

use Symfony\Component\HttpFoundation\File\File;
use Doctrine\ORM\Mapping as ORM;
use Gth\UploadBundle\Annotation\Uploadable;
use Gth\UploadBundle\Annotation\UploadableField;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Publication
 *
 * @ORM\Table(name="publication")
 * @ORM\Entity(repositoryClass="EvaluationBundle\Repository\PublicationRepository")
 * @Uploadable()
 */
class Publication
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
     * @Assert\NotBlank()
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="autheur", type="string", length=255)
     */
    private $author;


    /**
     * @var boolean
     * @ORM\Column(name="valide", type="boolean",options={"default":false })
     */
    private $valide;


    /**
     *
     * @ORM\ManyToOne(targetEntity="Evenement")
     * @ORM\JoinColumn(name="evenement_id",referencedColumnName="id")
     */
    private $evenement;

    /**
     * @return mixed
     */
    public function getEvenement()
    {
        return $this->evenement;
    }

    /**
     * @param mixed $evenement
     * @return Publication
     */
    public function setEvenement($evenement)
    {
        $this->evenement = $evenement;
        return $this;
    }

    /**
     * @return bool
     */
    public function isValide(): bool
    {
        return $this->valide;
    }

    /**
     * @param bool $valide
     * @return Publication
     */
    public function setValide(bool $valide): Publication
    {
        $this->valide = $valide;
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param string $author
     * @return Publication
     */
    public function setAuthor(string $author): Publication
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="Nb_Vote", type="integer")
     */
    private $nbrVote;


    /**
     * @return int
     */
    public function getNbrVote()
    {
        return $this->nbrVote;
    }

    /**
     * @param int $nbrVote
     */
    public function setNbrVote($nbrVote)
    {
        $this->nbrVote = $nbrVote;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="buz", type="integer")
     */
    private $buz;

    /**
     * @return int
     */
    public function getBuz(): int
    {
        return $this->buz;
    }

    /**
     * @param int $buz
     * @return Publication
     */
    public function setBuz(int $buz): Publication
    {
        $this->buz = $buz;
        return $this;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="like", type="integer")
     */
    private $like;

    /**
     * @return int
     */
    public function getLike(): int
    {
        return $this->like;
    }

    /**
     * @param int $like
     * @return Publication
     */
    public function setLike(int $like): Publication
    {
        $this->like = $like;
        return $this;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="unlike", type="integer")
     */
    private $unlike;

    /**
     * @return int
     */
    public function getUnlike(): int
    {
        return $this->unlike;
    }

    /**
     * @param int $unlike
     * @return Publication
     */
    public function setUnlike(int $unlike): Publication
    {
        $this->unlike = $unlike;
        return $this;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=255)
     */
    private $categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="video", type="string", length=255)
     * @Assert\Valid()
     */
    private $video;


    /**
     * @UploadableField(filename="file",path="uploads")
     *
     */
    private $file;

    /**
     * @return File/null
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param File $file/null
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;


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
     * Set titre
     *
     * @param string $titre
     *
     * @return Publication
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set categorie
     *
     * @param string $categorie
     *
     * @return Publication
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }


    /**
     * Set description
     *
     * @param string $description
     *
     * @return Publication
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set video
     *
     * @param string $video
     *
     * @return Publication
     */
    public function setVideo($video)
    {
        $this->video = $video;
    }

    /**
     * Get video
     *
     * @return string
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @return string
     */
    public function getVideoFile()
    {
        return $this->video;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function __construct()
    {
        $this->updatedAt= new \datetime('now');
        $this->nbrVote=0;
    }

    public function setVideoFile($video)
    {
        $this->video = $video;
    }

}

