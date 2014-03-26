<?php

namespace TaxiAdmin\GastoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GastoEmpresaType extends AbstractType {

    private $empresas;

    public function __construct($empresas) {
        $this->empresas = $empresas;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
        ->add('costo',              'integer', array('attr' => array('class' => 'form-control', 'placeholder' => 'Costo', 'min' => 0)))
        ->add('descripcion',        'textarea', array('attr' => array('class' => 'form-control', 'placeholder' => 'Descripción'), 'required' => false))
        ->add('rubro',              'text', array('attr' => array('class' => 'form-control', 'placeholder' => 'Rubro'), 'required' => false))
        ->add('fechaVencimiento',   'date', array('widget' => 'single_text', 'attr' => array('class' => 'form-control'), 'required' => false))
        ->add('fechaPago',          'date', array('widget' => 'single_text', 'attr' => array('class' => 'form-control'), 'required' => false))
        ->add('mensual',            'checkbox', array('label' => 'Gasto Mensual', 'required'  => false))
        ->add('diaVencimiento',     'integer', array('attr' => array('class' => 'form-control', 'placeholder' => 'Día de Vencimiento', 'min' => 1, 'max' => 30), 'required' => false));

        if (count($this->empresas) > 1) {
            $builder->add('empresa', 'entity', array('class' => 'TaxiAdminEmpresaBundle:Empresa', 'choices' => $this->empresas, 'empty_value' => 'Seleccione una Empresa'));
        } else if (count($this->empresas) == 1) { 
            $builder->add('empresa', 'entity', array('class' => 'TaxiAdminEmpresaBundle:Empresa', 'choices' => $this->empresas ));

        }
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'TaxiAdmin\GastoBundle\Entity\GastoEmpresa'
            ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'gastoempresa_';
    }
}
