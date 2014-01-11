<?php

namespace TaxiAdmin\ChoferBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MultaType extends AbstractType {

    private $choferes;
    private $moviles;

    public function __construct($choferes, $moviles) {
        $this->choferes = $choferes;
        $this->moviles = $moviles;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
        ->add('fecha',              'date', array('widget' => 'single_text', 'attr' => array('class' => 'form-control')))
        ->add('fechaPago',          'date', array('widget' => 'single_text', 'attr' => array('class' => 'form-control'), 'required' => false))
        ->add('fechaVencimiento',   'date', array('widget' => 'single_text', 'attr' => array('class' => 'form-control'), 'required' => false))
        ->add('lugar',              'textarea', array('attr' => array('class' => 'form-control', 'placeholder' => 'Lugar')))
        ->add('descripcion',        'textarea', array('attr' => array('class' => 'form-control', 'placeholder' => 'Descripción')))
        ->add('costo',              'integer', array('attr' => array('class' => 'form-control', 'placeholder' => 'Monto', 'min' => 0)))
        ;
        if (count($this->choferes) > 1) {
            $builder->add('chofer', 'entity', array('class' => 'TaxiAdminChoferBundle:Chofer', 'choices' => $this->choferes, 'empty_value' => 'Seleccione un Chofer'));
        } else {
            $builder->add('chofer', 'entity', array('class' => 'TaxiAdminChoferBundle:Chofer', 'choices' => $this->choferes));
        }

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
            'data_class' => 'TaxiAdmin\ChoferBundle\Entity\Multa'
            ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'multa_';
    }
}
