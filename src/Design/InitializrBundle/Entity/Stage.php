<?php

namespace Design\InitializrBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stage
 *
 * @ORM\Table(name="stage")
 * @ORM\Entity
 */
class Stage
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom_stage", type="string", length=25, nullable=true)
     */
    private $nomStage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date", nullable=false)
     */
    private $dateDebut;

    /**
     * @var integer
     *
     * @ORM\Column(name="duree", type="integer", nullable=false)
     */
    private $duree;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_stage", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idStage;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Design\InitializrBundle\Entity\Instrument", inversedBy="idStagePortesur")
     * @ORM\JoinTable(name="portesur",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_stage_portesur", referencedColumnName="id_stage")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_instrument_portesur", referencedColumnName="id_instrument")
     *   }
     * )
     */
    private $idInstrumentPortesur;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Design\InitializrBundle\Entity\Personne", inversedBy="idStageParticipe")
     * @ORM\JoinTable(name="participe",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_stage_participe", referencedColumnName="id_stage")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_personne_participe", referencedColumnName="id_personne")
     *   }
     * )
     */
    private $idPersonneParticipe;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idInstrumentPortesur = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idPersonneParticipe = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set nomStage
     *
     * @param string $nomStage
     * @return Stage
     */
    public function setNomStage($nomStage)
    {
        $this->nomStage = $nomStage;

        return $this;
    }

    /**
     * Get nomStage
     *
     * @return string 
     */
    public function getNomStage()
    {
        return $this->nomStage;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return Stage
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime 
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set duree
     *
     * @param integer $duree
     * @return Stage
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return integer 
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Stage
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
     * Get idStage
     *
     * @return integer 
     */
    public function getIdStage()
    {
        return $this->idStage;
    }
    
    /**
     * Has idInstrumentPortesur
     *
     * @param \Design\InitializrBundle\Entity\Instrument $idInstrumentPortesur
     * @return Bool
     */
    public function hasIdInstrumentPortesur(\Design\InitializrBundle\Entity\Instrument $idInstrumentPortesur)
    {
    	foreach ($this->idInstrumentPortesur as $instr)
    		if ($instr == $idInstrumentPortesur)
    			return true;
    		
    	return false;
    }

    /**
     * Add idInstrumentPortesur
     *
     * @param \Design\InitializrBundle\Entity\Instrument $idInstrumentPortesur
     * @return Stage
     */
    public function addIdInstrumentPortesur(\Design\InitializrBundle\Entity\Instrument $idInstrumentPortesur)
    {
        $this->idInstrumentPortesur[] = $idInstrumentPortesur;

        return $this;
    }
    
    /**
     * Set idInstrumentPortesur
     *
     * @param \Design\InitializrBundle\Entity\Instrument $idInstrumentPortesur
     * @return Stage
     */
    public function setIdInstrumentPortesur($idInstrumentPortesur)
    {
    	if(!$this->hasIdInstrumentPortesur($idInstrumentPortesur))
    		return $this->addIdInstrumentPortesur($idInstrumentPortesur);
    	else
    		return $this;
    }

    /**
     * Remove idInstrumentPortesur
     *
     * @param \Design\InitializrBundle\Entity\Instrument $idInstrumentPortesur
     */
    public function removeIdInstrumentPortesur(\Design\InitializrBundle\Entity\Instrument $idInstrumentPortesur)
    {
        $this->idInstrumentPortesur->removeElement($idInstrumentPortesur);
    }

    /**
     * Get idInstrumentPortesur
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdInstrumentPortesur()
    {
        return $this->idInstrumentPortesur;
    }

    /**
     * Add idPersonneParticipe
     *
     * @param \Design\InitializrBundle\Entity\Personne $idPersonneParticipe
     * @return Stage
     */
    public function addIdPersonneParticipe(\Design\InitializrBundle\Entity\Personne $idPersonneParticipe)
    {
        $this->idPersonneParticipe[] = $idPersonneParticipe;

        return $this;
    }

    /**
     * Remove idPersonneParticipe
     *
     * @param \Design\InitializrBundle\Entity\Personne $idPersonneParticipe
     */
    public function removeIdPersonneParticipe(\Design\InitializrBundle\Entity\Personne $idPersonneParticipe)
    {
        $this->idPersonneParticipe->removeElement($idPersonneParticipe);
    }

    /**
     * Get idPersonneParticipe
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdPersonneParticipe()
    {
        return $this->idPersonneParticipe;
    }
    
    public function toArray()
    {
    	$arr = array("id"  => $this->idStage,
				    "title" => $this->nomStage,
				    "startDate" => $this->dateDebut->format('Y-m-d'),
	    			"endDate" => $this->dateDebut->add(new \DateInterval('P'. $this->duree .'D'))->format('Y-m-d'),
				    "description"   => $this->description);
    	
    	$arr["instruments"] = array();
    	
    	foreach ($this->idInstrumentPortesur as $instru)
    		$arr["instruments"][] = $instru->toArray();
    		
    	return $arr;
    }
}
