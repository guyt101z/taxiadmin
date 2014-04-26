<?php

namespace TaxiAdmin\UsuarioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsuarioType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('nombre', 'text', array('attr' => array('class' => 'form-control', 'placeholder' => 'Nombre')))
            ->add('apellido', 'text', array('attr' => array('class' => 'form-control', 'placeholder' => 'Apellido')))
            ->add('telefono', 'text', array('required' => false, 'attr' => array('class' => 'form-control', 'placeholder' => 'Teléfono')))
            ->add('celular', 'text', array('attr' => array('class' => 'form-control', 'placeholder' => 'Celular')))
            ->add('direccion', 'text', array('attr' => array('class' => 'form-control', 'placeholder' => 'Dirección')))
            ->add('email', 'email', array('attr' => array('class' => 'form-control', 'placeholder' => 'Email')))
            ->add('password', 'password', array('attr' => array('class' => 'form-control', 'placeholder' => 'Clave')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'TaxiAdmin\UsuarioBundle\Entity\Usuario'
            ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'registro';
    }
}
