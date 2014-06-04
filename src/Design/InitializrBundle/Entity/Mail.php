<?php

namespace Design\InitializrBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mail
 *
 * @ORM\Table(name="mail", indexes={@ORM\Index(name="FK_mail_personne", columns={"id_personne_mail"})})
 * @ORM\Entity
 */
class Mail
{
    /**
     * @var string
     *
     * @ORM\Column(name="objet", type="string", length=256, nullable=true)
     */
    private $objet;

    /**
     * @var string
     *
     * @ORM\Column(name="texte", type="text", nullable=false)
     */
    private $texte;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_envoi", type="date", nullable=false)
     */
    private $dateEnvoi;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_mail", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMail;

    /**
     * @var \Design\InitializrBundle\Entity\Personne
     *
     * @ORM\ManyToOne(targetEntity="Design\InitializrBundle\Entity\Personne")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_personne_mail", referencedColumnName="id_personne")
     * })
     */
    private $idPersonneMail;



    /**
     * Set objet
     *
     * @param string $objet
     * @return Mail
     */
    public function setObjet($objet)
    {
        $this->objet = $objet;

        return $this;
    }

    /**
     * Get objet
     *
     * @return string 
     */
    public function getObjet()
    {
        return $this->objet;
    }

    /**
     * Set texte
     *
     * @param string $texte
     * @return Mail
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get texte
     *
     * @return string 
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * Set dateEnvoi
     *
     * @param \DateTime $dateEnvoi
     * @return Mail
     */
    public function setDateEnvoi($dateEnvoi)
    {
        $this->dateEnvoi = $dateEnvoi;

        return $this;
    }

    /**
     * Get dateEnvoi
     *
     * @return \DateTime 
     */
    public function getDateEnvoi()
    {
        return $this->dateEnvoi;
    }

    /**
     * Get idMail
     *
     * @return integer 
     */
    public function getIdMail()
    {
        return $this->idMail;
    }

    /**
     * Set idPersonneMail
     *
     * @param \Design\InitializrBundle\Entity\Personne $idPersonneMail
     * @return Mail
     */
    public function setIdPersonneMail(\Design\InitializrBundle\Entity\Personne $idPersonneMail = null)
    {
        $this->idPersonneMail = $idPersonneMail;

        return $this;
    }

    /**
     * Get idPersonneMail
     *
     * @return \Design\InitializrBundle\Entity\Personne 
     */
    public function getIdPersonneMail()
    {
        return $this->idPersonneMail;
    }
}
