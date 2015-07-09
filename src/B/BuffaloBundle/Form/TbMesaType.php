<?php

namespace B\BuffaloBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TbMesaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('inroMesa')
            ->add('destatus')
            ->add('fkIidEstadoMesa')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'B\BuffaloBundle\Entity\TbMesa'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'b_buffalobundle_tbmesa';
    }
}
