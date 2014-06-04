<?php

// src/Design/InitializrBundle/Form/MembreType.php
namespace Design\InitializrBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MembreType extends AbstractType
{	
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('personne', new PersonneType(), array('mapped' => false))
                ->add('mdpMembre', 'password')
                ->add('dateNaissance', 'date')
                ->add('adresse', 'text')
                ->add('save', 'submit');
	}

	public function getName()
	{
		return 'membre';
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(	array(	'data_class' => 'Design\InitializrBundle\Entity\Membre' ));
	}
}
?>