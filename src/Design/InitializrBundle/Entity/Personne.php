<?php

namespace Design\InitializrBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Personne
 *
 * @ORM\Table(name="personne")
 * @ORM\Entity
 */
class Personne
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=25, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=25, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=50, nullable=false)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=10, nullable=true)
     */
    private $tel;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_personne", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idPersonne;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Design\InitializrBundle\Entity\Instrument", inversedBy="idPersonnePratique")
     * @ORM\JoinTable(name="pratique",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_personne_pratique", referencedColumnName="id_personne")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_instrument_pratique", referencedColumnName="id_instrument")
     *   }
     * )
     */
    private $idInstrumentPratique;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Design\InitializrBundle\Entity\Stage", mappedBy="idPersonneParticipe")
     */
    private $idStageParticipe;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idInstrumentPratique = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idStageParticipe = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function persInit($nom, $prenom, $mail, $tel)
    {
    	$this->nom = $nom;
    	$this->prenom = $prenom;
    	$this->mail = $mail;
    	$this->tel = $tel;
    }

    public function getClass()
    {
    	return "Personne";
    }
    
    /**
     * Set nom
     *
     * @param string $nom
     * @return Personne
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return Personne
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return Personne
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set tel
     *
     * @param string $tel
     * @return Personne
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string 
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Get idPersonne
     *
     * @return integer 
     */
    public function getIdPersonne()
    {
        return $this->idPersonne;
    }

    /**
     * Add idInstrumentPratique
     *
     * @param \Design\InitializrBundle\Entity\Instrument $idInstrumentPratique
     * @return Personne
     */
    public function addIdInstrumentPratique(\Design\InitializrBundle\Entity\Instrument $idInstrumentPratique)
    {
        $this->idInstrumentPratique[] = $idInstrumentPratique;

        return $this;
    }

    /**
     * Remove idInstrumentPratique
     *
     * @param \Design\InitializrBundle\Entity\Instrument $idInstrumentPratique
     */
    public function removeIdInstrumentPratique(\Design\InitializrBundle\Entity\Instrument $idInstrumentPratique)
    {
        $this->idInstrumentPratique->removeElement($idInstrumentPratique);
    }

    /**
     * Get idInstrumentPratique
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdInstrumentPratique()
    {
        return $this->idInstrumentPratique;
    }

    /**
     * Add idStageParticipe
     *
     * @param \Design\InitializrBundle\Entity\Stage $idStageParticipe
     * @return Personne
     */
    public function addIdStageParticipe(\Design\InitializrBundle\Entity\Stage $idStageParticipe)
    {
        $this->idStageParticipe[] = $idStageParticipe;

        return $this;
    }

    /**
     * Remove idStageParticipe
     *
     * @param \Design\InitializrBundle\Entity\Stage $idStageParticipe
     */
    public function removeIdStageParticipe(\Design\InitializrBundle\Entity\Stage $idStageParticipe)
    {
        $this->idStageParticipe->removeElement($idStageParticipe);
    }

    /**
     * Get idStageParticipe
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdStageParticipe()
    {
        return $this->idStageParticipe;
    }
}
