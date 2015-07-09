<?php

namespace V\ValoraBundle\Form;

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
            ->add('vruc')
            ->add('vnombre')
            ->add('vapellido')
            ->add('icorreo')
            ->add('vclave')
            ->add('fkTipopersona')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'V\ValoraBundle\Entity\TbPersona'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'v_valorabundle_tbpersona';
    }
}
