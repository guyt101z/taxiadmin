<?php

namespace TaxiAdmin\GastoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GastoMovilType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
        ->add('costo',          'integer', array('attr' => array('class' => 'form-control', 'placeholder' => 'Costo', 'min' => 0)))
        ->add('descripcion',    'textarea', array('attr' => array('class' => 'form-control', 'placeholder' => 'Descripción'), 'required' => false))
        ->add('rubro',          'text', array('attr' => array('class' => 'form-control', 'placeholder' => 'Rubro'), 'required' => false))
        ->add('fechaPago',      'date', array('widget' => 'single_text', 'format' => 'dd/MM/yyyy', 'attr' => array('class' => 'form-control', 'data-date' => ''), 'required' => false))
        ->add('diaVencimiento', 'integer', array('attr' => array('class' => 'form-control', 'placeholder' => 'Día de Vencimiento', 'min' => 1, 'max' => 30), 'required' => false));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'TaxiAdmin\GastoBundle\Entity\GastoMovil'
            ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'gastomovil_';
    }
}
