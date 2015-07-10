<?php

namespace V\ValoraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use V\ValoraBundle\Entity\TbServicio;
use V\ValoraBundle\Form\TbServicioType;
use DateTime;
use V\ValoraBundle\Entity\TbPaquete;
use V\ValoraBundle\Entity\TbRelPaqueteProducto;

/**
 * TbServicio controller.
 *
 */
class TbServicioController extends Controller {

    /**
     * Lists all TbServicio entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('VValoraBundle:TbServicio')->findAll();
        $arrayEntities = Array();
        $inc = 0;
        $precio = 0;
        //calculo de facturacion por paquete 
        foreach ($entities as $entity) {
            $paquete=$entity->getFkPaquete();
            $relProPaq = $em->getRepository('VValoraBundle:TbRelPaqueteProducto')->
                    findBy(array('fkPaquete' => $paquete));

            foreach ($relProPaq as $rel) {
                $precio = $precio + $rel->getIcantidadProductoPaquete() * $rel->getFkProducto()->getVprecio();
            }
            $arrayEntities[$inc++] = Array($entity, $precio);
            $precio = 0;
        }
        return $this->render('VValoraBundle:TbServicio:index.html.twig', array(
                    'entities' => $arrayEntities,
        ));
    }

    /**
     * Creates a new TbServicio entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new TbServicio();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        $paquete = new TbPaquete();
        $paquete->setVtitulo('Usuario ' . $entity->getTbCliente()->getVnombre() . ' ' .
                $entity->getTbCliente()->getVapellido());
        $paquete->setVdescripcion($paquete->getVtitulo());
        $em->persist($paquete);
        $swith = false;
        foreach ($_POST as $clave => $prod) {
            $a = strpos($clave, 'p_');
            if ($a !== false && $prod > 0) {
                //Crear Relacion y asociar al paquete
                $relacion = new TbRelPaqueteProducto();
                $relacion->setFkPaquete($paquete);
                $relacion->setIcantidadProductoPaquete($prod);

                //$producto= $em->getRepository('VValoraBundle:TbProducto')->find(substr($clave, 2));
                $producto = $em->getRepository('VValoraBundle:TbProducto')->find(substr($clave, 2));
                $producto->setVcantidad($producto->getVcantidad() - $prod);

                $relacion->setFkProducto($producto);

                $em->persist($relacion);
                $swith = true;
            }
        }
        if ($swith == true) {
            $entity->setFkPaquete($paquete);
        }


        if ($form->isValid()) {

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('Servicio_show', array('id' => $entity->getId())));
        }

        return $this->render('VValoraBundle:TbServicio:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a TbServicio entity.
     *
     * @param TbServicio $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TbServicio $entity) {
        $form = $this->createForm(new TbServicioType(), $entity, array(
            'action' => $this->generateUrl('Servicio_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TbServicio entity.
     *
     */
    public function newAction() {
        $entity = new TbServicio();
        $em = $this->getDoctrine()->getManager();

        $productos = $em->getRepository('VValoraBundle:TbProducto')->findAll();
        date_default_timezone_set('America/Caracas');
        $date = new DateTime('NOW');
        $entity->setDfechaSolicitud($date);
        $entity->setDfechaCierre(Null);
        $entityEdoServicio = $em->getRepository('VValoraBundle:TbEdoServicio')->find(3);
        $entity->setDestatusServicio($entityEdoServicio);

        $form = $this->createCreateForm($entity);

        return $this->render('VValoraBundle:TbServicio:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                    'Productos' => $productos,
        ));
    }

    /**
     * Finds and displays a TbServicio entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VValoraBundle:TbServicio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbServicio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('VValoraBundle:TbServicio:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TbServicio entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VValoraBundle:TbServicio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbServicio entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('VValoraBundle:TbServicio:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a TbServicio entity.
     *
     * @param TbServicio $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(TbServicio $entity) {
        $form = $this->createForm(new TbServicioType(), $entity, array(
            'action' => $this->generateUrl('Servicio_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing TbServicio entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VValoraBundle:TbServicio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbServicio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('Servicio_edit', array('id' => $id)));
        }

        return $this->render('VValoraBundle:TbServicio:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a TbServicio entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('VValoraBundle:TbServicio')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TbServicio entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('Servicio'));
    }

    /**
     * Creates a form to delete a TbServicio entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('Servicio_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

}
