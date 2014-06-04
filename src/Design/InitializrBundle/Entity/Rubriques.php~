<?php

namespace Design\InitializrBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rubriques
 *
 * @ORM\Table(name="rubriques")
 * @ORM\Entity
 */
class Rubriques
{
    /**
     * @var string
     *
     * @ORM\Column(name="description_rubrique", type="text", nullable=true)
     */
    private $descriptionRubrique;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_rubrique", type="string", length=25)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $nomRubrique;



    /**
     * Set descriptionRubrique
     *
     * @param string $descriptionRubrique
     * @return Rubriques
     */
    public function setDescriptionRubrique($descriptionRubrique)
    {
        $this->descriptionRubrique = $descriptionRubrique;

        return $this;
    }

    /**
     * Get descriptionRubrique
     *
     * @return string 
     */
    public function getDescriptionRubrique()
    {
        return $this->descriptionRubrique;
    }

    /**
     * Get nomRubrique
     *
     * @return string 
     */
    public function getNomRubrique()
    {
        return $this->nomRubrique;
    }
}
