<?php

namespace Design\InitializrBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Musicien
 *
 * @ORM\Table(name="musicien")
 * @ORM\Entity
 */
class Musicien
{
    /**
     * @var \Design\InitializrBundle\Entity\Personne
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Design\InitializrBundle\Entity\Personne")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_musicien", referencedColumnName="id_personne")
     * })
     */
    private $idMusicien;



    /**
     * Set idMusicien
     *
     * @param \Design\InitializrBundle\Entity\Personne $idMusicien
     * @return Musicien
     */
    public function setIdMusicien(\Design\InitializrBundle\Entity\Personne $idMusicien)
    {
        $this->idMusicien = $idMusicien;

        return $this;
    }

    /**
     * Get idMusicien
     *
     * @return \Design\InitializrBundle\Entity\Personne 
     */
    public function getIdMusicien()
    {
        return $this->idMusicien;
    }
}
