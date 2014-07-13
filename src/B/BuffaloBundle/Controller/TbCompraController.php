<?php

namespace B\BuffaloBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use B\BuffaloBundle\Entity\TbCompra;
use B\BuffaloBundle\Form\TbCompraType;
use B\BuffaloBundle\Entity\TbRelCompraPlato;
use B\BuffaloBundle\Entity\TbEstadoCompra;
use DateTime;
/**
 * TbCompra controller.
 *
 */
class TbCompraController extends Controller
{

    /**
     * Lists all TbCompra entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BBuffaloBundle:TbCompra')->findAll();

        return $this->render('BBuffaloBundle:TbCompra:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new TbCompra entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new TbCompra();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
          
        //Verificar que el arreglo de platos no este vacio.       
        $platos = $entity->getPlatos();
        
        if(count($platos)==0){
          $message_error = "No debe agregar platos vacios. Elija los Platos que requiere."
                        . "y quite los que no va a asociar al comprador.";
                $this->get('session')->getFlashBag()->add('flash_error', $message_error);

                return $this->render('BBuffaloBundle:TbCompra:new.html.twig', array(
                'entity' => $entity,
                'form'   => $form->createView(),
                ));
        }
        $i = 0;
        foreach ($platos as &$plato) {
            //print "1";
            
            $i = $i + 1;
            if ($plato == null) {
                  //print "3";
                $message_error = "No debe agregar platos vacios. Elija los Platos que requiere."
                        . "y quite los que no va a asociar al comprador.";
                $this->get('session')->getFlashBag()->add('flash_error', $message_error);

                return $this->render('BBuffaloBundle:TbCompra:new.html.twig', array(
                'entity' => $entity,
                'form'   => $form->createView(),
                ));
            } else {
                 
                if(($plato->getFkIidCplato() == null) && $i==1) {
                //print "c";
                    $message_error = "No Puede agregar Platos vacios.";
                    $this->get('session')->getFlashBag()->add('flash_error', $message_error);

                    return $this->render('BBuffaloBundle:TbCompra:new.html.twig', array(
                        'entity' => $entity,
                        'form'   => $form->createView(),
                    ));
                //  print "2";
                }
                
            }
        }
        if ($form->isValid()) {
             $costototal=0;
            
                foreach ($platos as &$plato) {
                           //Buscar la cantidad de plato//
                 $relPlatoIngA= $em->getRepository('BBuffaloBundle:TbRelPlatoIngrediente')->
                         findBy(array('fkIidPlato'=> $plato->getFkIidCplato()));
                 
               //Buscar el ingrediente
                 foreach ($relPlatoIngA as &$ing) { 
                    $ingCant= $em->getRepository('BBuffaloBundle:TbIngrediente')->
                            find($ing->getFkIidIngrediente());

                    $cant=($ingCant->getIcantidad()-($plato->getIcantidad())*$ing->getDcantidad());
                  //Restar la cantidad del plato
                    $ingCant->setIcantidad($cant);
                       $em->flush();
                 }
                //Fin cant ing por Comp
                    if ($plato != null && $plato->getFkIidCplato() != null) {
                    $relplato=new TbRelCompraPlato();
                    $relplato->setFkIidCompra($entity);
                    $relplato->setFkIidCplato($plato->getFkIidCplato());
                    $relplato->setIcantidad($plato->getIcantidad());
                    $costototal=$costototal+$plato->getIcantidad()*($plato->getFkIidCplato()->getdPrecio()
                            +($plato->getFkIidCplato()->getdPrecio()*0.25));
                    $em->persist($relplato);
                     //Cantidad de ingredientes por compra//
                //Restar lo precios de la relacion platoing a los ing
                
               //print_r($plato);
        
               
                    }
                }
                $entity->setDcosto($costototal);
            //Ocupar Mesa
            $mesa= $em->getRepository('BBuffaloBundle:TbMesa')->
                    find($entity->getFkIidMesa());
             //Buscar estado de la mesa disponible
            $edo_mesa= $em->getRepository('BBuffaloBundle:TbEstadoMesa')->
                    find(2);
            $mesa->setFkIidEstadoMesa($edo_mesa);
            //Fin de Ocupar Mesa
                
            $em->persist($entity);
            $em->flush();

        return $this->render('BBuffaloBundle:TbCompra:show.html.twig', array(
            'entity' => $entity,
        ));    
        }
        
        return $this->render('BBuffaloBundle:TbCompra:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a TbCompra entity.
     *
     * @param TbCompra $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TbCompra $entity)
    {
        $form = $this->createForm(new TbCompraType(), $entity, array(
            'action' => $this->generateUrl('ens_solicitud_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TbCompra entity.
     *
     */
    public function newAction()
    {
        $entity = new TbCompra();
        
        $em = $this->getDoctrine()->getManager();

        $estadoC = $em->getRepository('BBuffaloBundle:TbEstadoCompra')->find(2);
             //Buscar los platos 
        date_default_timezone_set('America/Caracas');
        $date = new DateTime('NOW');
        $entity->setDtfechaCompra($date);
        $entity->setFkIidEstadoCompra($estadoC);
        $entity->setDcosto(0);
     
        $form   = $this->createCreateForm($entity);
        
        return $this->render('BBuffaloBundle:TbCompra:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TbCompra entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BBuffaloBundle:TbCompra')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbCompra entity.');
        }
        
        //Buscar los platos en la TbRelCompraPlato
        $listaCompraPlato = $em->getRepository('BBuffaloBundle:TbRelCompraPlato')->
                findBy(array('fkIidCompra'=>$entity));
        $entity->setPlatos($listaCompraPlato);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BBuffaloBundle:TbCompra:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TbCompra entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BBuffaloBundle:TbCompra')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbCompra entity.');
        }
        $listaCompraPlato = $em->getRepository('BBuffaloBundle:TbRelCompraPlato')->
                findBy(array('fkIidCompra'=>$entity));
        $entity->setPlatos($listaCompraPlato);
        
        
        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BBuffaloBundle:TbCompra:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a TbCompra entity.
    *
    * @param TbCompra $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TbCompra $entity)
    {
        $form = $this->createForm(new TbCompraType(), $entity, array(
            'action' => $this->generateUrl('ens_solicitud_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TbCompra entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BBuffaloBundle:TbCompra')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbCompra entity.');
        }
        
        //Buscar estado orden = servida 
        //Buscar estado de la mesa         
        
         if ($entity->getFkIidEstadoCompra()->getId()==1){
             //Buscar la Mesa
            $mesa= $em->getRepository('BBuffaloBundle:TbMesa')->
                    find($entity->getFkIidMesa());
             //Buscar estado de la mesa disponible
            $edo_mesa= $em->getRepository('BBuffaloBundle:TbEstadoMesa')->
                    find(1);
            $mesa->setFkIidEstadoMesa($edo_mesa);
            
         }
         //
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('ens_solicitud_edit', array('id' => $id)));
        }

        return $this->render('BBuffaloBundle:TbCompra:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a TbCompra entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BBuffaloBundle:TbCompra')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TbCompra entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ens_solicitud'));
    }

    /**
     * Creates a form to delete a TbCompra entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ens_solicitud_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
