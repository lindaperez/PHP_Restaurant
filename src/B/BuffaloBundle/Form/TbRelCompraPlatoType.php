<?php

namespace B\BuffaloBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use B\BuffaloBundle\Form\EventListener\AddTbPlatoFieldSubscriber;
class TbRelCompraPlatoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $propertyPathToTbPlato = 'fkIidCplato';
        $builder
            ->addEventSubscriber(new AddTbPlatoFieldSubscriber($propertyPathToTbPlato))
            ->add('fkIidCplato')
            ->add('fkIidCompra')
            ->add('icantidad')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'B\BuffaloBundle\Entity\TbRelCompraPlato'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'b_buffalobundle_tbrelcompraplato';
    }
}
