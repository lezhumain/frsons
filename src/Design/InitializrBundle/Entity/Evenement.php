<?php

namespace Design\InitializrBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement", indexes={@ORM\Index(name="FK_evenement_personne", columns={"id_personne_evenement"})})
 * @ORM\Entity
 */
class Evenement
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom_evenement", type="string", length=25, nullable=false)
     */
    private $nomEvenement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_evenement", type="date", nullable=false)
     */
    private $dateEvenement;

    /**
     * @var integer
     *
     * @ORM\Column(name="duree_evenement", type="integer", nullable=false)
     */
    private $dureeEvenement;

    /**
     * @var string
     *
     * @ORM\Column(name="description_evenement", type="text", nullable=false)
     */
    private $descriptionEvenement;

    /**
     * @var boolean
     *
     * @ORM\Column(name="est_valide_evenement", type="boolean", nullable=false)
     */
    private $estValideEvenement;

    /**
     * @var string
     *
     * @ORM\Column(name="type_evenement", type="string", length=1, nullable=false)
     */
    private $typeEvenement;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_evenement", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEvenement;

    /**
     * @var \Design\InitializrBundle\Entity\Personne
     *
     * @ORM\ManyToOne(targetEntity="Design\InitializrBundle\Entity\Personne")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_personne_evenement", referencedColumnName="id_personne")
     * })
     */
    private $idPersonneEvenement;



    /**
     * Set nomEvenement
     *
     * @param string $nomEvenement
     * @return Evenement
     */
    public function setNomEvenement($nomEvenement)
    {
        $this->nomEvenement = $nomEvenement;

        return $this;
    }

    /**
     * Get nomEvenement
     *
     * @return string 
     */
    public function getNomEvenement()
    {
        return $this->nomEvenement;
    }

    /**
     * Set dateEvenement
     *
     * @param \DateTime $dateEvenement
     * @return Evenement
     */
    public function setDateEvenement($dateEvenement)
    {
        $this->dateEvenement = $dateEvenement;

        return $this;
    }

    /**
     * Get dateEvenement
     *
     * @return \DateTime 
     */
    public function getDateEvenement()
    {
        return $this->dateEvenement;
    }

    /**
     * Set dureeEvenement
     *
     * @param integer $dureeEvenement
     * @return Evenement
     */
    public function setDureeEvenement($dureeEvenement)
    {
        $this->dureeEvenement = $dureeEvenement;

        return $this;
    }

    /**
     * Get dureeEvenement
     *
     * @return integer 
     */
    public function getDureeEvenement()
    {
        return $this->dureeEvenement;
    }

    /**
     * Set descriptionEvenement
     *
     * @param string $descriptionEvenement
     * @return Evenement
     */
    public function setDescriptionEvenement($descriptionEvenement)
    {
        $this->descriptionEvenement = $descriptionEvenement;

        return $this;
    }

    /**
     * Get descriptionEvenement
     *
     * @return string 
     */
    public function getDescriptionEvenement()
    {
        return $this->descriptionEvenement;
    }

    /**
     * Set estValideEvenement
     *
     * @param boolean $estValideEvenement
     * @return Evenement
     */
    public function setEstValideEvenement($estValideEvenement)
    {
        $this->estValideEvenement = $estValideEvenement;

        return $this;
    }

    /**
     * Get estValideEvenement
     *
     * @return boolean 
     */
    public function getEstValideEvenement()
    {
        return $this->estValideEvenement;
    }

    /**
     * Set typeEvenement
     *
     * @param string $typeEvenement
     * @return Evenement
     */
    public function setTypeEvenement($typeEvenement)
    {
        $this->typeEvenement = $typeEvenement;

        return $this;
    }

    /**
     * Get typeEvenement
     *
     * @return string 
     */
    public function getTypeEvenement()
    {
        return $this->typeEvenement;
    }

    /**
     * Get idEvenement
     *
     * @return integer 
     */
    public function getIdEvenement()
    {
        return $this->idEvenement;
    }

    /**
     * Set idPersonneEvenement
     *
     * @param \Design\InitializrBundle\Entity\Personne $idPersonneEvenement
     * @return Evenement
     */
    public function setIdPersonneEvenement(\Design\InitializrBundle\Entity\Personne $idPersonneEvenement = null)
    {
        $this->idPersonneEvenement = $idPersonneEvenement;

        return $this;
    }

    /**
     * Get idPersonneEvenement
     *
     * @return \Design\InitializrBundle\Entity\Personne 
     */
    public function getIdPersonneEvenement()
    {
        return $this->idPersonneEvenement;
    }
}
