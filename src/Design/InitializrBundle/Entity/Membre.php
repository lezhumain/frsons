<?php

namespace Design\InitializrBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Design\InitializrBundle\Resources\Logger;

/**
 * Membre
 *
 * @ORM\Table(name="membre")
 * @ORM\Entity(repositoryClass="Design\InitializrBundle\Entity\MembreRepository")
 */
class Membre implements AdvancedUserInterface, \Serializable
{
    /**
     * @var string
     *
     * @ORM\Column(name="mdp_membre", type="string", length=128, nullable=false)
     */
    private $mdpMembre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_naissance", type="date", nullable=false)
     */
    private $dateNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=128, nullable=false)
     */
    private $adresse;

    /**
     * @var boolean
     *
     * @ORM\Column(name="est_valide_membre", type="boolean", nullable=false)
     */
    private $estValideMembre;

    /**
     * @var string
     *
     * @ORM\Column(name="salt_membre", type="string", length=128, nullable=false)
     */
    private $saltMembre;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active_membre", type="boolean", nullable=true)
     */
    private $activeMembre;

    /**
     * @var \Design\InitializrBundle\Entity\Personne
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Design\InitializrBundle\Entity\Personne")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_personne_membre", referencedColumnName="id_personne")
     * })
     */
    private $idPersonneMembre;

	/**
     * Set mdpMembre
     *
     * @param string $mdpMembre
     * @return Membre
     */
    public function setMdpMembre($mdpMembre)
    {
        $this->mdpMembre = $mdpMembre;

        return $this;
    }

    /**
     * Get mdpMembre
     *
     * @return string 
     */
    public function getMdpMembre()
    {
        return $this->mdpMembre;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     * @return Membre
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime 
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Membre
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set estValideMembre
     *
     * @param boolean $estValideMembre
     * @return Membre
     */
    public function setEstValideMembre($estValideMembre)
    {
        $this->estValideMembre = $estValideMembre;

        return $this;
    }

    /**
     * Get estValideMembre
     *
     * @return boolean 
     */
    public function getEstValideMembre()
    {
        return $this->estValideMembre;
    }

    /**
     * Set saltMembre
     *
     * @param string $saltMembre
     * @return Membre
     */
    public function setSaltMembre($saltMembre)
    {
        $this->saltMembre = $saltMembre;

        return $this;
    }

    /**
     * Get saltMembre
     *
     * @return string 
     */
    public function getSaltMembre()
    {
        return $this->saltMembre;
    }

    /**
     * Set activeMembre
     *
     * @param boolean $activeMembre
     * @return Membre
     */
    public function setActiveMembre($activeMembre)
    {
        $this->activeMembre = $activeMembre;

        return $this;
    }

    /**
     * Get activeMembre
     *
     * @return boolean 
     */
    public function getActiveMembre()
    {
        return $this->activeMembre;
    }

    /**
     * Set idPersonneMembre
     *
     * @param \Design\InitializrBundle\Entity\Personne $idPersonneMembre
     * @return Membre
     */
    public function setIdPersonneMembre(\Design\InitializrBundle\Entity\Personne $idPersonneMembre)
    {
        $this->idPersonneMembre = $idPersonneMembre;

        return $this;
    }

    /**
     * Get idPersonneMembre
     *
     * @return \Design\InitializrBundle\Entity\Personne 
     */
    public function getIdPersonneMembre()
    {
        return $this->idPersonneMembre;
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
    	$this->activeMembre = true;
    	$this->estValideMembre = false;
    }
    
    public function isEqualTo(UserInterface $user)
    {
    	return $this->getUsername() === $user->getUsername();
    }
    
    public function toString()
    {
    	if($this->idPersonneMembre == null)
    		return "[Membre]:null"; //throw new \Exception("idPersonneMembre == null...");
    		
    	return "[Membre]:"."<nom>:".$this->idPersonneMembre->getNom()."<prenom>:".$this->idPersonneMembre->getPrenom()."<username>:".$this->getUsername();
    }
    
    public function getClass()
    {
    	return "Membre";
    }
    
    /*****************************/    
    /* methode de user interface */
    /*****************************/
    
    /*
     * username : le mail de la personne liee au membre
     */
    public function getUsername()
    {
    	if($this->idPersonneMembre == null)
    		return "null";
    	else
	    	return $this->idPersonneMembre->getMail();
    }
    
    /*
     * Equivalent de getSaltMembre
     */
    public function getSalt()
    {
    	return $this->saltMembre;
    }
    
    /*
     * Equivalent de getMdpMembre
     */
    public function getPassword()
    {
    	return $this->mdpMembre;
    }
    
    public function getRoles()
    {
    	return array('ROLE_USER');
    }
    
    public function eraseCredentials()
    {
    }
    
    /*****************************/
    /*****************************/
    /*****************************/
    
    /*****************************/
    /*    methode de Advanced    */
    /*****************************/
    public function isAccountNonExpired()
    {
    	return true;
    }
    
    public function isAccountNonLocked()
    {
    	return true;
    }
    
    public function isCredentialsNonExpired()
    {
    	return true;
    }
    
    public function isEnabled()
    {
    	/* !$this->isActive || */
    	if( !$this->estValideMembre )
    		return false;
    	else
    		return true;
    }
    
    /*****************************/
    /*****************************/
    /*****************************/
    
    /*****************************/
    /*   methode de \Serialize   */
    /*****************************/

    /*
     * see \Serializable::serialize()
     */
    public function serialize()
    {
    	Logger::getInstance()
    		->log(" - Membre::serialize()\n - tostring: " . $this->toString());

    	return serialize(array(
    			$this->saltMembre,
    	));
    }
    
    /*
     * see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
    	Logger::getInstance()
	    	->log(" - Membre::unserialize()\n - tostring: " . $this->toString().
    			"\n - tostring: " . $serialized);

    	list (
    			$this->saltMembre,
    	) = unserialize($serialized);
    }
    
    /*****************************/
    /*****************************/
    /*****************************/
    
}
