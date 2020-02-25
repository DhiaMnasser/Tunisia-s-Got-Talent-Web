<?php

namespace TgtBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="region_origine", type="string", length=255)
     */
    private $region;

    /**
     * @var boolean
     * @ORM\Column(name="jury", type="boolean",options={"default":false })
     */
    private $jury;

    /**
     * @var boolean
     * @ORM\Column(name="participant", type="boolean",options={"default":false })
     */
    private $participant;

    /**
     * @return bool
     */
    public function isParticipant()
    {
        return $this->participant;
    }

    /**
     * @param bool $participant
     */
    public function setParticipant($participant)
    {
        $this->participant = $participant;
    }

    /**
     * @return bool
     */
    public function isJury()
    {
        return $this->jury;
    }

    /**
     * @param bool $jury
     */
    public function setJury($jury)
    {
        $this->jury = $jury;
    }

    /**
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param string $region
     * @return User
     */
    public function setRegion($region)
    {
        $this->region = $region;
        return $this;
    }

    public function __construct()
    {
        parent::__construct();
        // your own logic
        $this->jury= 0;
        $this->participant= 0;
    }

}