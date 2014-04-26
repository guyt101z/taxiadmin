<?php

namespace TaxiAdmin\PropietarioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PropietarioType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', 'text', array('attr' => array('class' => 'form-control', 'placeholder' => 'Nombre')))
            ->add('apellido', 'text', array('attr' => array('class' => 'form-control', 'placeholder' => 'Apellido')))
            ->add('email', 'email', array('required' => false, 'attr' => array('class' => 'form-control', 'placeholder' => 'Email')))
            ->add('telefono', 'text', array('required' => false, 'attr' => array('class' => 'form-control', 'placeholder' => 'Teléfono')))
            ->add('celular', 'text', array('required' => false, 'attr' => array('class' => 'form-control', 'placeholder' => 'Celular')))
            ->add('direccion', 'text', array('required' => false, 'attr' => array('class' => 'form-control', 'placeholder' => 'Dirección')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TaxiAdmin\PropietarioBundle\Entity\Propietario'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'propietario_';
    }
}
