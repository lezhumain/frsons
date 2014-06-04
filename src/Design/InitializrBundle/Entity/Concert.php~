<?php

namespace Design\InitializrBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Concert
 *
 * @ORM\Table(name="concert")
 * @ORM\Entity
 */
class Concert
{
    /**
     * @var \Design\InitializrBundle\Entity\Evenement
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Design\InitializrBundle\Entity\Evenement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_concert", referencedColumnName="id_evenement")
     * })
     */
    private $idConcert;



    /**
     * Set idConcert
     *
     * @param \Design\InitializrBundle\Entity\Evenement $idConcert
     * @return Concert
     */
    public function setIdConcert(\Design\InitializrBundle\Entity\Evenement $idConcert)
    {
        $this->idConcert = $idConcert;

        return $this;
    }

    /**
     * Get idConcert
     *
     * @return \Design\InitializrBundle\Entity\Evenement 
     */
    public function getIdConcert()
    {
        return $this->idConcert;
    }
}
