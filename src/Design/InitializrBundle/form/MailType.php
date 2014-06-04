<?php
// src/Design/InitializrBundle/Form/MailType.php

namespace Design\InitializrBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MailType extends AbstractType
{
	/**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        	->add('personne', new PersonneType(), array('mapped' => false))
            ->add('objet', 'text')
            ->add('texte', 'textarea')
/*          ->add('expediteur')			// ca sera l'entite Personne creee
/*          ->add('dateEnvoi', 'date')	//date du jour ajoutée dans le controller  		*/
        	->add('save', 'submit');
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Design\InitializrBundle\Entity\Mail'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mail';
    }
}
