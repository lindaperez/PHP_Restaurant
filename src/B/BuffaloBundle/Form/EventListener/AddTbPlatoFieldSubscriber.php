<?php

namespace B\BuffaloBundle\Form\EventListener;
 
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Doctrine\ORM\EntityRepository;



class AddTbPlatoFieldSubscriber implements EventSubscriberInterface
{
    
    private $propertyPathToTbPlato;
 
    public function __construct($propertyPathToTbPlato)
    {
        
    $this->propertyPathToTbPlato = $propertyPathToTbPlato;
        
    }
 
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_SUBMIT   => 'preSubmit'
        );
    }
 
    private function addTbPlatoForm($form, $tbplato=null)
    {    
        
        $formOptions = array(
            'class'         => 'BBuffaloBundle:TbPlato',
            'mapped'         => true,
            'label'         => 'Platos: ',
            'empty_value'   => 'Seleccionar',
            'invalid_message' => 'El valor de Plato no puede ser vacio',
            'attr'          => array(
            'class' => 'platos_selector'),
               'query_builder' => function (EntityRepository $repository){
                $qb = $repository->createQueryBuilder('q')
                        ->where('q.fkIidEstado= :id')
                        ->setParameter('id', 1)
                ;
                
                return $qb;
                
            }
        );
        
                if ($tbplato) {
            $formOptions['data'] = $tbplato;
         //  print $tbplato;
        }
    
        $form->add('fkIidCplato', 'entity', $formOptions);
    }
 
    public function preSetData(FormEvent $event)
    {
       // print "HILa";
        
        $data = $event->getData();
        //print_r($data);  
        $form = $event->getForm();
      
   $this->addTbPlatoForm($form);
  
    }
 
    public function preSubmit(FormEvent $event)
    {
        
        $data = $event->getData();
        //print_r($data['fkIidCplato']);
        $form = $event->getForm();
        $value =array_key_exists('fkIidCplato', $data) ? $data['fkIidCplato'] : null;
       // print_r($value);
        
          $this->addTbPlatoForm($form,$value);
    
    }
}