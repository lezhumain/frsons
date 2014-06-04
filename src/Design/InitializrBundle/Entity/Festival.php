<?php

namespace Design\InitializrBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Festival
 *
 * @ORM\Table(name="festival")
 * @ORM\Entity
 */
class Festival
{
    /**
     * @var \Design\InitializrBundle\Entity\Evenement
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Design\InitializrBundle\Entity\Evenement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_festival", referencedColumnName="id_evenement")
     * })
     */
    private $idFestival;



    /**
     * Set idFestival
     *
     * @param \Design\InitializrBundle\Entity\Evenement $idFestival
     * @return Festival
     */
    public function setIdFestival(\Design\InitializrBundle\Entity\Evenement $idFestival)
    {
        $this->idFestival = $idFestival;

        return $this;
    }

    /**
     * Get idFestival
     *
     * @return \Design\InitializrBundle\Entity\Evenement 
     */
    public function getIdFestival()
    {
        return $this->idFestival;
    }
}
