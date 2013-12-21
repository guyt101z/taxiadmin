<?php

namespace TaxiAdmin\MovilBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MovilType extends AbstractType {

    public $empresas;

    public function __construct($emp) {
        $this->empresas = $emp;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('matricula',      'text', array('attr' => array('class' => 'form-control', 'placeholder' => 'Matrícula', 'autofocus' => '')))
        ->add('marca',          'text', array('attr' => array('class' => 'form-control', 'placeholder' => 'Marca')))
        ->add('modelo',         'text', array('attr' => array('class' => 'form-control', 'placeholder' => 'Modelo')))
        ->add('anio',           'integer', array('attr' => array('min' => '1990', 'class' => 'form-control', 'placeholder' => 'Año')))
        ->add('numChasis',      'text', array('required' => true, 'attr' => array('class' => 'form-control', 'placeholder' => 'Num. de Chasis')))
        ->add('numMovil',       'text', array('attr' => array('class' => 'form-control', 'placeholder' => 'Num. de Móvil')))
        ->add('despacho',       'text', array('attr' => array('class' => 'form-control', 'placeholder' => 'Despacho')))
        ->add('radio',          'text', array('attr' => array('class' => 'form-control', 'placeholder' => 'Radio')))
        ->add('combustible',    'text', array('attr' => array('class' => 'form-control', 'placeholder' => 'Combustible')))
        ->add('empresa',        'entity', array('class' => 'TaxiAdminEmpresaBundle:Empresa', 'choices' => $this->empresas, 'empty_value' => 'Seleccione una Empresa'))
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
        return 'movil_';
    }
}
