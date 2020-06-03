<?php
	// src/eventBundle/Entity/User.php

	namespace eventBundle\Entity;

	use FOS\UserBundle\Model\User as BaseUser;
	use Doctrine\ORM\Mapping as ORM;
    use Doctrine\ORM\Mapping\ManyToOne;
    use Doctrine\ORM\Mapping\OneToMany;
    use Doctrine\ORM\Mapping\JoinColumn;


	/**
•	 * @ORM\Entity
•	 * @ORM\Table(name="fos_user")
•	 */
	class User extends BaseUser
	{
    	    /**
    	     * @ORM\Id
    •	     * @ORM\Column(type="integer")
    •	     * @ORM\GeneratedValue(strategy="AUTO")
    •	     */
	    protected $id;

        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @param mixed $id
         */
        public function setId($id)
        {
            $this->id = $id;
        }
        /**
         * @ORM\ManyToOne(targetEntity="eventBundle\Entity\Evenement")
         * @ORM\JoinColumn(name="event_id",referencedColumnName="id")
         */
	    private $event ;

        /**
         * @return mixed
         */
        public function getEvent()
        {
            return $this->event;
        }

        /**
         * @param mixed $event
         */
        public function setEvent($event)
        {
            $this->event = $event;
        }

	    public function __construct()
	    {
        	        parent::__construct();
	        // your own logic
	    }
        public function __toString(){
            // to show the name of the Category in the select
            return (string)"user".$this->id;
            // to show the id of the Category in the select
            // return $this->id;
        }
	}
