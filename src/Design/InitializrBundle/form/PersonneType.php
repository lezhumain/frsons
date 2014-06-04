<?php

// src/Design/InitializrBundle/Form/PersonneType.php
namespace Design\InitializrBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PersonneType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('nom', 'text');
    	$builder->add('prenom', 'text');
    	$builder->add('mail', 'email');
    	$builder->add('tel', 'text', array('required' => false));
	}

	public function getName()
	{
		return 'personne';
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(	array('data_class' => 'Design\InitializrBundle\Entity\Personne')	);
	}
	
}
?>