<?php

namespace TaxiAdmin\MovilBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MovilType extends AbstractType {

    public $empresas;
    public $radios;
    public $combustible;

    public function __construct($emp, $radios, $combustible) {
        $this->empresas = $emp;
        $this->radios = $radios;
        $this->combustible = $combustible;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
        ->add('matricula',      'text', array('attr' => array('class' => 'form-control', 'placeholder' => 'Matrícula', 'autofocus' => '')))
        ->add('marca',          'text', array('attr' => array('class' => 'form-control', 'placeholder' => 'Marca')))
        ->add('modelo',         'text', array('attr' => array('class' => 'form-control', 'placeholder' => 'Modelo')))
        ->add('anio',           'integer', array('attr' => array('min' => '1990', 'class' => 'form-control', 'placeholder' => 'Año')))
        ->add('numChasis',      'text', array('required' => true, 'attr' => array('class' => 'form-control', 'placeholder' => 'Num. de Chasis'), 'required' => false))
        ->add('numMovil',       'text', array('attr' => array('class' => 'form-control', 'placeholder' => 'Num. de Móvil')))
        ->add('despacho',       'text', array('attr' => array('class' => 'form-control', 'placeholder' => 'Despacho')))
        ->add('radio',          'choice', array('choices' => $this->radios))
        ->add('combustible',    'choice', array('choices' => $this->combustible))
        ->add('empresa',        'entity', array('class' => 'TaxiAdminEmpresaBundle:Empresa', 'choices' => $this->empresas, 'empty_value' => 'Seleccione una Empresa'))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'TaxiAdmin\MovilBundle\Entity\Movil'
            ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'movil_';
    }
}
