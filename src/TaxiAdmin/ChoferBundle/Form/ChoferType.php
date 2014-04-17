<?php

namespace TaxiAdmin\ChoferBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChoferType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
            ->add('nombre',                'text', array('attr' => array('class' => 'form-control', 'placeholder' => 'Nombre')))
            ->add('apellido',              'text', array('attr' => array('class' => 'form-control', 'placeholder' => 'Apellido')))
            ->add('email',                 'email', array('required' => false, 'attr' => array('class' => 'form-control', 'placeholder' => 'Email')))
            ->add('telefono',              'text', array('required' => false, 'attr' => array('class' => 'form-control', 'placeholder' => 'Teléfono')))
            ->add('celular',               'text', array('required' => true, 'attr' => array('class' => 'form-control', 'placeholder' => 'Celular')))
            ->add('direccion',             'text', array('required' => false, 'attr' => array('class' => 'form-control', 'placeholder' => 'Dirección')))
            ->add('fechaIngreso',           'date', array('required' => false, 'widget' => 'single_text', 'format' => 'dd/MM/yyyy', 'attr' => array('class' => 'form-control', 'data-date' => '', 'placeholder' => 'Fecha Ingreso')))
            ->add('aporteLeyes',           'number', array('required' => true, 'attr' => array('class' => 'form-control', 'placeholder' => 'Aporte Leyes')))
            ->add('porcentajeLiquidacion', 'number', array('required' => true, 'attr' => array('class' => 'form-control', 'placeholder' => 'Liquidación')))
            ->add('vencCarneSalud',        'date', array('required' => false, 'widget' => 'single_text', 'format' => 'dd/MM/yyyy', 'attr' => array('class' => 'form-control', 'data-date' => '', 'placeholder' => 'Venci. Carne Salud')))
            ->add('vencLibretaConducir',   'date', array('required' => false, 'widget' => 'single_text', 'format' => 'dd/MM/yyyy', 'attr' => array('class' => 'form-control', 'data-date' => '', 'placeholder' => 'Venc. Libreta Conducir')))
            ;
        }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TaxiAdmin\ChoferBundle\Entity\Chofer'
            ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'chofer_';
    }
}
