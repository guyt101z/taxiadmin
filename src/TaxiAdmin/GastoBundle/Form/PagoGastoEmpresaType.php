<?php

namespace TaxiAdmin\GastoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PagoGastoEmpresaType extends AbstractType {
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('fechaPago',   'date', array('widget' => 'single_text', 'format' => 'dd/MM/yyyy', 'attr' => array('class' => 'form-control', 'data-date' => '')))
            ->add('costo',       'integer', array('attr' => array('class' => 'form-control', 'placeholder' => 'Costo', 'min' => 0)))
            ->add('descripcion', 'textarea', array('attr' => array('class' => 'form-control', 'placeholder' => 'Descripción'), 'required' => false));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'TaxiAdmin\GastoBundle\Entity\PagoGastoEmpresa'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'taxiadmin_gastobundle_pagogastoempresa';
    }
}
