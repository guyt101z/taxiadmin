<?php

namespace TaxiAdmin\MovilBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MantenimientoType extends AbstractType {

    private $moviles;

    public function __construct($moviles) {
        $this->moviles = $moviles;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
        ->add('motivoIngreso',        'textarea', array('attr' => array('class' => 'form-control', 'placeholder' => 'Motivo del ingreso', 'autofocus' => '')))
        ->add('kmIngreso',            'integer', array('attr' => array('class' => 'form-control', 'placeholder' => 'Km de Ingreso'), 'required' => false)) 
        ->add('taller',               'text', array('attr' => array('class' => 'form-control', 'placeholder' => 'Taller'), 'required' => false))
        ->add('descripcionTrabajo',   'textarea', array('attr' => array('class' => 'form-control', 'placeholder' => 'Descripción del trabajo'), 'required' => false))
        ->add('costo',                'integer', array('attr' => array('class' => 'form-control', 'placeholder' => 'Costo', 'min' => 0)))
        ->add('fechaIngreso',         'date', array('widget' => 'single_text', 'format' => 'dd/MM/yyyy', 'attr' => array('class' => 'form-control', 'data-date' => '')))
        ->add('fechaFinalizado',      'date', array('widget' => 'single_text', 'format' => 'dd/MM/yyyy', 'attr' => array('class' => 'form-control', 'data-date' => ''), 'required' => false))
        ->add('fechaPago',            'date', array('widget' => 'single_text', 'format' => 'dd/MM/yyyy', 'attr' => array('class' => 'form-control', 'data-date' => ''), 'required' => false))
        ->add('fechaVencimiento',     'date', array('widget' => 'single_text', 'format' => 'dd/MM/yyyy', 'attr' => array('class' => 'form-control', 'data-date' => ''), 'required' => false))
        ;

        if (count($this->moviles) > 1) {
            $builder->add('movil', 'entity', array('class' => 'TaxiAdminMovilBundle:Movil', 'choices' => $this->moviles, 'empty_value' => 'Seleccione un Movil'));
        } else {
            $builder->add('movil', 'entity', array('class' => 'TaxiAdminMovilBundle:Movil', 'choices' => $this->moviles));
        }
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'TaxiAdmin\MovilBundle\Entity\Mantenimiento'
            ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'mantenimiento_';
    }
}
