<?php

namespace Design\InitializrBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Admin
 *
 * @ORM\Table(name="admin")
 * @ORM\Entity
 */
class Admin
{
    /**
     * @var string
     *
     * @ORM\Column(name="mdp_admin", type="string", length=128, nullable=false)
     */
    private $mdpAdmin;

    /**
     * @var string
     *
     * @ORM\Column(name="salt_admin", type="string", length=128, nullable=false)
     */
    private $saltAdmin;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active_admin", type="boolean", nullable=false)
     */
    private $activeAdmin;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_admin", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAdmin;



    /**
     * Set mdpAdmin
     *
     * @param string $mdpAdmin
     * @return Admin
     */
    public function setMdpAdmin($mdpAdmin)
    {
        $this->mdpAdmin = $mdpAdmin;

        return $this;
    }

    /**
     * Get mdpAdmin
     *
     * @return string 
     */
    public function getMdpAdmin()
    {
        return $this->mdpAdmin;
    }

    /**
     * Set saltAdmin
     *
     * @param string $saltAdmin
     * @return Admin
     */
    public function setSaltAdmin($saltAdmin)
    {
        $this->saltAdmin = $saltAdmin;

        return $this;
    }

    /**
     * Get saltAdmin
     *
     * @return string 
     */
    public function getSaltAdmin()
    {
        return $this->saltAdmin;
    }

    /**
     * Set activeAdmin
     *
     * @param boolean $activeAdmin
     * @return Admin
     */
    public function setActiveAdmin($activeAdmin)
    {
        $this->activeAdmin = $activeAdmin;

        return $this;
    }

    /**
     * Get activeAdmin
     *
     * @return boolean 
     */
    public function getActiveAdmin()
    {
        return $this->activeAdmin;
    }

    /**
     * Get idAdmin
     *
     * @return integer 
     */
    public function getIdAdmin()
    {
        return $this->idAdmin;
    }
}
