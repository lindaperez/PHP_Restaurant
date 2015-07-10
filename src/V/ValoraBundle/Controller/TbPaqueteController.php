<?php

namespace V\ValoraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use V\ValoraBundle\Entity\TbPaquete;
use V\ValoraBundle\Form\TbPaqueteType;
use V\ValoraBundle\Entity\TbRelPaqueteProducto;

/**
 * TbPaquete controller.
 *
 */
class TbPaqueteController extends Controller
{

    /**
     * Lists all TbPaquete entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('VValoraBundle:TbPaquete')->findAll();

        return $this->render('VValoraBundle:TbPaquete:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new TbPaquete entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new TbPaquete();
        $em = $this->getDoctrine()->getManager();
        
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        
        foreach ($_POST as $clave => $prod) {
                $a = strpos($clave, 'p_');
                if ($a !== false) {
                    //Crear Relacion y asociar al paquete
                    $relacion = new TbRelPaqueteProducto();
                    $relacion->setFkPaquete($entity);
                    $relacion->setIcantidadProductoPaquete(1);
                    //$producto= $em->getRepository('VValoraBundle:TbProducto')->find(substr($clave, 2));
                    print_r($prod);
                    $producto= $em->getRepository('VValoraBundle:TbProducto')->find($prod);
                    $relacion->setFkProducto($producto);
                    $em->persist($relacion);
                    
                }
            }
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('Paquete_show', array('id' => $entity->getId())));
        }

        return $this->render('VValoraBundle:TbPaquete:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a TbPaquete entity.
     *
     * @param TbPaquete $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TbPaquete $entity)
    {
        $form = $this->createForm(new TbPaqueteType(), $entity, array(
            'action' => $this->generateUrl('Paquete_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TbPaquete entity.
     *
     */
    public function newAction()
    {
        $entity = new TbPaquete();
        $em = $this->getDoctrine()->getManager();

        $productos= $em->getRepository('VValoraBundle:TbProducto')->findAll();
        $form   = $this->createCreateForm($entity);

        return $this->render('VValoraBundle:TbPaquete:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'Productos' => $productos,
        ));
    }

    /**
     * Finds and displays a TbPaquete entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VValoraBundle:TbPaquete')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbPaquete entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('VValoraBundle:TbPaquete:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TbPaquete entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VValoraBundle:TbPaquete')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbPaquete entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('VValoraBundle:TbPaquete:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a TbPaquete entity.
    *
    * @param TbPaquete $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TbPaquete $entity)
    {
        $form = $this->createForm(new TbPaqueteType(), $entity, array(
            'action' => $this->generateUrl('Paquete_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TbPaquete entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VValoraBundle:TbPaquete')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbPaquete entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('Paquete_edit', array('id' => $id)));
        }

        return $this->render('VValoraBundle:TbPaquete:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a TbPaquete entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('VValoraBundle:TbPaquete')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TbPaquete entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('Paquete'));
    }

    /**
     * Creates a form to delete a TbPaquete entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('Paquete_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
