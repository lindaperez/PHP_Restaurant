<?php

namespace V\ValoraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TbRelPaqueteProductoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('icantidadProductoPaquete')
            ->add('fkPaquete')
            ->add('fkProducto')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'V\ValoraBundle\Entity\TbRelPaqueteProducto'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'v_valorabundle_tbrelpaqueteproducto';
    }
}
