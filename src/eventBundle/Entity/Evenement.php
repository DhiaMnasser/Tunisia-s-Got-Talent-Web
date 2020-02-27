<?php

namespace eventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;
use SBC\NotificationsBundle\Builder\NotificationBuilder;
use SBC\NotificationsBundle\Model\NotifiableInterface;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity(repositoryClass="eventBundle\Repository\EvenementRepository")
 */
class Evenement implements NotifiableInterface , \JsonSerializable
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
     * @OneToOne(targetEntity="Region",mappedBy="Evenement")
     * @JoinColumn(name="region_id",referencedColumnName="id")
     */
    private $region ;

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param mixed $region
     */
    public function setRegion($region)
    {
        $this->region = $region;
    }


    /**
     * @var string
     *
     * @ORM\Column(name="Duree", type="string", length=255)
     */
    private $duree;

    /**
     * @var int
     *
     * @ORM\Column(name="MaxParticipants", type="integer")
     */

    private $maxParticipants;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_d", type="date")
     */
    private $dateD;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_f", type="date")
     */
    private $dateF;

    /**
     * @var string
     *
     * @ORM\Column(name="Gagnant", type="string", length=255)
     */
    private $gagnant;

    /**
     * @var int
     *
     * @ORM\Column(name="Etat", type="integer")
     */
    private $etat;


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
     * Set duree
     *
     * @param string $duree
     *
     * @return Evenement
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return string
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set maxParticipants
     *
     * @param integer $maxParticipants
     *
     * @return Evenement
     */
    public function setMaxParticipants($maxParticipants)
    {
        $this->maxParticipants = $maxParticipants;

        return $this;
    }

    /**
     * Get maxParticipants
     *
     * @return int
     */
    public function getMaxParticipants()
    {
        return $this->maxParticipants;
    }

    /**
     * Set dateD
     *
     * @param \DateTime $dateD
     *
     * @return Evenement
     */
    public function setDateD($dateD)
    {
        $this->dateD = $dateD;

        return $this;
    }

    /**
     * Get dateD
     *
     * @return \DateTime
     */
    public function getDateD()
    {
        return $this->dateD;
    }

    /**
     * Set dateF
     *
     * @param \DateTime $dateF
     *
     * @return Evenement
     */
    public function setDateF($dateF)
    {
        $this->dateF = $dateF;

        return $this;
    }

    /**
     * Get dateF
     *
     * @return \DateTime
     */
    public function getDateF()
    {
        return $this->dateF;
    }

    /**
     * Set gagnant
     *
     * @param string $gagnant
     *
     * @return Evenement
     */
    public function setGagnant($gagnant)
    {
        $this->gagnant = $gagnant;

        return $this;
    }

    /**
     * Get gagnant
     *
     * @return string
     */
    public function getGagnant()
    {
        return $this->gagnant;
    }

    /**
     * Set etat
     *
     * @param integer $etat
     *
     * @return Evenement
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return int
     */
    public function getEtat()
    {
        return $this->etat;
    }
    /**
     * @var string
     *
     * @ORM\Column(name="nomevent", type="string", length=255)
     */
    private $nomevent ;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=500)
     */
    private $image ;

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getNomevent()
    {
        return $this->nomevent;
    }

    /**
     * @param string $nomevent
     */
    public function setNomevent($nomevent)
    {
        $this->nomevent = $nomevent;
    }
    public function __toString(){
        // to show the name of the Category in the select
        return (string)"evenement".$this->id;
        // to show the id of the Category in the select
        // return $this->id;
    }

    public function notificationsOnCreate(NotificationBuilder $builder)
    {
       $notification = new Notif() ;
       $notification
           ->setTitle('Notification événement')
           ->setDescription($this->nomevent)
           ->setRoute('evenement_showadmin')
           ->setParameters(array('id' => $this->id)) ;
       $builder->addNotification($notification) ;
       return $builder ;


    }

    public function notificationsOnUpdate(NotificationBuilder $builder)
    {
        $notification = new Notif() ;
        $notification
            ->setTitle('Notification événement')
            ->setDescription($this->nomevent)
            ->setRoute('evenement_showadmin')
            ->setParameters(array('id' => $this->id)) ;
        $builder->addNotification($notification) ;
        return $builder ;
    }

    public function notificationsOnDelete(NotificationBuilder $builder)
    {
        // TODO: Implement notificationsOnDelete() method.
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
       return get_object_vars($this) ;
    }
}

