<?php

namespace B\BuffaloBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TbPersonaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('icedula')
            ->add('vnombre')
            ->add('vapellido')
            ->add('vcorreo')
            ->add('itelefono')
            ->add('vdireccion')
            ->add('vclave')
            ->add('fkIidTipoPersona')
            ->add('fkIidEstadoPersona')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'B\BuffaloBundle\Entity\TbPersona'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'b_buffalobundle_tbpersona';
    }
}
