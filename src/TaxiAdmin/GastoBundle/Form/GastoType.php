<?php

namespace TaxiAdmin\MovilBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GastoType extends AbstractType {

    private $empresas;
    private $moviles;

    public function __construct($empresas, $moviles) {
        $this->empresas = $empresas;
        $this->moviles = $moviles;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
        ->add('costo',              'integer', array('attr' => array('class' => 'form-control', 'placeholder' => 'Costo', 'min' => 0)))
        ->add('descripcion',        'textarea', array('attr' => array('class' => 'form-control', 'placeholder' => 'Descripción'), 'required' => false))
        ->add('fechaVencimiento',   'date', array('widget' => 'single_text', 'attr' => array('class' => 'form-control'), 'required' => false))
        ->add('mensual',            'checkbox', array('label' => 'Gasto Mensual', 'required'  => false))
        ->add('diaVencimiento',     'integer', array('attr' => array('class' => 'form-control', 'placeholder' => 'Día de Vencimiento', 'min' => 1, 'max' => 30), 'required' => false));

        if (count($this->empresas) > 1) {
            $builder->add('empresa', 'entity', array('class' => 'TaxiAdminEmpresaBundle:Empresa', 'choices' => $this->empresas, 'empty_value' => 'Seleccione una Empresa'));
            $builder->add('movil', 'entity', array('class' => 'TaxiAdminMovilBundle:Movil', 'choices' => $this->moviles, 'attr' => array('class' => 'hide')));
        } else if (count($this->empresas) == 1) { 
            $builder->add('empresa', 'entity', array('class' => 'TaxiAdminEmpresaBundle:Empresa', 'choices' => $this->empresas ));
            $builder->add('movil', 'entity', array('class' => 'TaxiAdminMovilBundle:Movil', 'choices' => $this->moviles, 'attr' => array('class' => 'hide'), 'required' => false));

        } else if (count($this->moviles) > 1) {
            $builder->add('movil', 'entity', array('class' => 'TaxiAdminMovilBundle:Movil', 'choices' => $this->moviles, 'empty_value' => 'Seleccione un Movil'));

        } else if (count($this->moviles) == 1) {
            $builder->add('movil', 'entity', array('class' => 'TaxiAdminMovilBundle:Movil', 'choices' => $this->moviles));
        }
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'TaxiAdmin\MovilBundle\Entity\Gasto'
            ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'gasto_';
    }
}
