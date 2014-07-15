<?php

namespace B\BuffaloBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use B\BuffaloBundle\Entity\TbRelCompraPlato;
use B\BuffaloBundle\Form\TbRelCompraPlatoType;
use Doctrine\ORM\EntityRepository;

class TbCompraType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dtfechaCompra','date', array('required' => false,'label'=> 'Fecha Registro:',
           'widget' => 'single_text'
           // this is actually the default format for single_text
           ))
            ->add('fkIidPersona','entity', array('empty_value'=>'Seleccionar',
                'class' => 'B\BuffaloBundle\Entity\TbPersona',
                'query_builder' => function (EntityRepository $repository){
                $qb = $repository->createQueryBuilder('q')                        
                ;
                
                return $qb;
                
            }
              ))
            ->add('fkIidMesa','entity', array('empty_value'=>'Seleccionar',
                'class' => 'B\BuffaloBundle\Entity\TbMesa',
                'query_builder' => function (EntityRepository $repository){
                $qb = $repository->createQueryBuilder('q')
                        ->where('q.fkIidEstadoMesa= :id')
                        ->setParameter('id', 1)
                ;
                
                return $qb;
                
            }
              ))
            ->add('dcosto')
            ->add('fkIidEstadoCompra')
            ->add('fkIidMesero','entity', array('empty_value'=>'Seleccionar',
                'class' => 'B\BuffaloBundle\Entity\TbPersona',
                'query_builder' => function (EntityRepository $repository){
                $qb = $repository->createQueryBuilder('q')
                        ->where('q.fkIidTipoPersona= :id')
                        ->setParameter('id', 3)
                ;
                
                return $qb;
                
            }
              ))
            ->add('platos','collection',
           array('type'=> new TbRelCompraPlatoType(),
           'label' => ' ',
           'by_reference' => false,
           'prototype' => new TbRelCompraPlato(),
           'allow_add' => true, 
           'allow_delete' => true,
           'required' =>false,
           ))
                
               ;
        
       
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'B\BuffaloBundle\Entity\TbCompra'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'b_buffalobundle_tbcompra';
    }
}
