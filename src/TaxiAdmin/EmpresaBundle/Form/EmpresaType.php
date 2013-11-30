<?php

namespace TaxiAdmin\EmpresaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmpresaType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('nombre', 'text', array('attr' => array('class' => 'form-control', 'placeholder' => 'Nombre')))
            ->add('razonSocial', 'text', array('attr' => array('class' => 'form-control', 'placeholder' => 'Razon Social')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'TaxiAdmin\EmpresaBundle\Entity\Empresa'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'empresa_new';
    }
}
