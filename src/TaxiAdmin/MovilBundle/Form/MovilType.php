<?php

namespace TaxiAdmin\MovilBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MovilType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matricula')
            ->add('marca')
            ->add('modelo')
            ->add('anio')
            ->add('numChasis')
            ->add('combustible')
            ->add('numMovil')
            ->add('despacho')
            ->add('fechaAlta')
            ->add('fechaBaja')
            ->add('habilitado')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TaxiAdmin\MovilBundle\Entity\Movil'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'taxiadmin_movilbundle_movil';
    }
}
