<?php

namespace B\BuffaloBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TbIngredienteType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('vnombre')
            ->add('icantidad')
            ->add('dcosto')
            ->add('fkIidEstadoIng')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'B\BuffaloBundle\Entity\TbIngrediente'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'b_buffalobundle_tbingrediente';
    }
}
