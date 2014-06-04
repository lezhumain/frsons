<?php

namespace Design\InitializrBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Instrument
 *
 * @ORM\Table(name="instrument")
 * @ORM\Entity
 */
class Instrument
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom_instrument", type="string", length=25, nullable=false)
     */
    private $nomInstrument;

    /**
     * @var string
     *
     * @ORM\Column(name="description_instrument", type="text", nullable=true)
     */
    private $descriptionInstrument;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_instrument", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idInstrument;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Design\InitializrBundle\Entity\Personne", mappedBy="idInstrumentPratique")
     */
    private $idPersonnePratique;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Design\InitializrBundle\Entity\Stage", mappedBy="idInstrumentPortesur")
     */
    private $idStagePortesur;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idPersonnePratique = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idStagePortesur = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set nomInstrument
     *
     * @param string $nomInstrument
     * @return Instrument
     */
    public function setNomInstrument($nomInstrument)
    {
        $this->nomInstrument = $nomInstrument;

        return $this;
    }

    /**
     * Get nomInstrument
     *
     * @return string 
     */
    public function getNomInstrument()
    {
        return $this->nomInstrument;
    }

    /**
     * Set descriptionInstrument
     *
     * @param string $descriptionInstrument
     * @return Instrument
     */
    public function setDescriptionInstrument($descriptionInstrument)
    {
        $this->descriptionInstrument = $descriptionInstrument;

        return $this;
    }

    /**
     * Get descriptionInstrument
     *
     * @return string 
     */
    public function getDescriptionInstrument()
    {
        return $this->descriptionInstrument;
    }

    /**
     * Get idInstrument
     *
     * @return integer 
     */
    public function getIdInstrument()
    {
        return $this->idInstrument;
    }

    /**
     * Add idPersonnePratique
     *
     * @param \Design\InitializrBundle\Entity\Personne $idPersonnePratique
     * @return Instrument
     */
    public function addIdPersonnePratique(\Design\InitializrBundle\Entity\Personne $idPersonnePratique)
    {
        $this->idPersonnePratique[] = $idPersonnePratique;

        return $this;
    }

    /**
     * Remove idPersonnePratique
     *
     * @param \Design\InitializrBundle\Entity\Personne $idPersonnePratique
     */
    public function removeIdPersonnePratique(\Design\InitializrBundle\Entity\Personne $idPersonnePratique)
    {
        $this->idPersonnePratique->removeElement($idPersonnePratique);
    }

    /**
     * Get idPersonnePratique
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdPersonnePratique()
    {
        return $this->idPersonnePratique;
    }

    /**
     * Add idStagePortesur
     *
     * @param \Design\InitializrBundle\Entity\Stage $idStagePortesur
     * @return Instrument
     */
    public function addIdStagePortesur(\Design\InitializrBundle\Entity\Stage $idStagePortesur)
    {
        $this->idStagePortesur[] = $idStagePortesur;

        return $this;
    }

    /**
     * Remove idStagePortesur
     *
     * @param \Design\InitializrBundle\Entity\Stage $idStagePortesur
     */
    public function removeIdStagePortesur(\Design\InitializrBundle\Entity\Stage $idStagePortesur)
    {
        $this->idStagePortesur->removeElement($idStagePortesur);
    }

    /**
     * Get idStagePortesur
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdStagePortesur()
    {
        return $this->idStagePortesur;
    }
    
    public function toArray()
    {
    	return array("id"  => $this->idInstrument,
    				"nom" => $this->nomInstrument);
    }
}
