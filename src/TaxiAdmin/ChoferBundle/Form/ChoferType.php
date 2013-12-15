<?php

namespace TaxiAdmin\ChoferBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChoferType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('aporteLeyes')
            ->add('porcentajeLiquidacion')
            ->add('vencCarneSalud')
            ->add('vencLibretaConducir')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TaxiAdmin\ChoferBundle\Entity\Chofer'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'taxiadmin_choferbundle_chofer';
    }
}
