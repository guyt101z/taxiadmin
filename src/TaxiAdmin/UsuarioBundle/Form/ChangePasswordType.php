<?php

namespace TaxiAdmin\UsuarioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChangePasswordType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('password',                'password', array('attr' => array('class' => 'form-control', 'placeholder' => 'Clave')))
            ->add('newPassword',          'password', array('attr' => array('class' => 'form-control', 'placeholder' => 'Nueva Clave')))
            ->add('confirmNewPassword',   'password', array('mapped' => false, 'attr' => array('class' => 'form-control', 'placeholder' => 'Confirmar Nueva Clave')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    // public function setDefaultOptions(OptionsResolverInterface $resolver) {
        // $resolver->setDefaults(array(
        //     'data_class' => 'TaxiAdmin\UsuarioBundle\Entity\Usuario'
        //     ));
    // }

    /**
     * @return string
     */
    public function getName() {
        return 'changePassword';
    }
}
