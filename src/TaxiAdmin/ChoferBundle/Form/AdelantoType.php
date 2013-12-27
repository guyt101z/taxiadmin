<?php

namespace TaxiAdmin\ChoferBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdelantoType extends AbstractType {

    private $choferes;

    public function __construct($choferes) {
        $this->choferes = $choferes;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
        ->add('chofer',   'entity', array('class' => 'TaxiAdminChoferBundle:Chofer', 'choices' => $this->choferes, 'empty_value' => 'Seleccione un Chofer'))
        ->add('fecha',    'date', array('widget' => 'single_text', 'attr' => array('class' => 'form-control', 'placeholder' => 'Fecha', 'autofocus' => '')))
        ->add('monto',    'integer', array('attr' => array('class' => 'form-control', 'placeholder' => 'Monto', 'min' => 0)))
        ->add('detalle',  'textarea', array('attr' => array('class' => 'form-control', 'placeholder' => 'Detalle')))
        ;
    }

    /**
    * @param OptionsResolverInterface $resolver
    */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'TaxiAdmin\ChoferBundle\Entity\Adelanto'
            ));
    }

    /**
    * @return string
    */
    public function getName() {
        return 'chofer_adelanto';
    }
}
