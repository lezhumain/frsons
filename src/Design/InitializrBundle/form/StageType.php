<?php

namespace Design\InitializrBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\DataTransformer\IntegerToLocalizedStringTransformer;

class StageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomStage', "text")
            ->add('dateDebut', "date")
            ->add('duree', 'integer', array(
            			'max_length'=>2,
            			'rounding_mode'=>IntegerToLocalizedStringTransformer::ROUND_HALFDOWN))
            ->add('description', "textarea")
            ->add('idInstrumentPortesur', 'entity', array(
					    'class' => 'DesignInitializrBundle:Instrument',
					    'property' => 'nomInstrument'))
            ->add('save', 'submit');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Design\InitializrBundle\Entity\Stage'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'stage';
    }
}