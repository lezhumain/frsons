<?php

namespace Design\InitializrBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cours
 *
 * @ORM\Table(name="cours")
 * @ORM\Entity
 */
class Cours
{
    /**
     * @var integer
     *
     * @ORM\Column(name="periodicite", type="integer", nullable=false)
     */
    private $periodicite;

    /**
     * @var \Design\InitializrBundle\Entity\Stage
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Design\InitializrBundle\Entity\Stage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_stage_cours", referencedColumnName="id_stage")
     * })
     */
    private $idStageCours;



    /**
     * Set periodicite
     *
     * @param integer $periodicite
     * @return Cours
     */
    public function setPeriodicite($periodicite)
    {
        $this->periodicite = $periodicite;

        return $this;
    }

    /**
     * Get periodicite
     *
     * @return integer 
     */
    public function getPeriodicite()
    {
        return $this->periodicite;
    }

    /**
     * Set idStageCours
     *
     * @param \Design\InitializrBundle\Entity\Stage $idStageCours
     * @return Cours
     */
    public function setIdStageCours(\Design\InitializrBundle\Entity\Stage $idStageCours)
    {
        $this->idStageCours = $idStageCours;

        return $this;
    }

    /**
     * Get idStageCours
     *
     * @return \Design\InitializrBundle\Entity\Stage 
     */
    public function getIdStageCours()
    {
        return $this->idStageCours;
    }
    
    public function __construct()
    {
    	$this->idStageCours->setDuree(0);
    }
    
    public function toArray()
    {
    	$ar = $this->idStageCours->toArray();
		
    	$ar["endDate"] = $ar["startDate"];
    	$ar["periodicite"] = $this->periodicite;
    	
    	return $ar;
    }
}
