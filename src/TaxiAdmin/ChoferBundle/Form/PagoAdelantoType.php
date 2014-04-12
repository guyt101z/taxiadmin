<?php

namespace TaxiAdmin\ChoferBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PagoAdelantoType extends AbstractType {

    private $saldo;

    public function __construct($saldo) {
        $this->saldo = $saldo;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('fecha',  'date', array('widget' => 'single_text','format' => 'dd/MM/yyyy', 'attr' => array('class' => 'form-control', 'data-date' => '', 'placeholder' => 'Fecha')))
            ->add('monto',  'integer', array('attr' => array('class' => 'form-control', 'placeholder' => 'Monto del pago', 'min' => 0, 'max' => $this->saldo, 'autofocus' => '')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'TaxiAdmin\ChoferBundle\Entity\PagoAdelanto'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'pagoadelanto_';
    }
}
