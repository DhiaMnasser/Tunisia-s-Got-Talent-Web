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
