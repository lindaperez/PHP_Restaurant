<?php

namespace V\ValoraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use V\ValoraBundle\Entity\TbProducto;
use V\ValoraBundle\Form\TbProductoType;

/**
 * TbProducto controller.
 *
 */
class TbProductoController extends Controller
{

    /**
     * Lists all TbProducto entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('VValoraBundle:TbProducto')->findAll();

        return $this->render('VValoraBundle:TbProducto:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new TbProducto entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new TbProducto();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('Producto_show', array('id' => $entity->getId())));
        }

        return $this->render('VValoraBundle:TbProducto:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a TbProducto entity.
     *
     * @param TbProducto $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TbProducto $entity)
    {
        $form = $this->createForm(new TbProductoType(), $entity, array(
            'action' => $this->generateUrl('Producto_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TbProducto entity.
     *
     */
    public function newAction()
    {
        $entity = new TbProducto();
        $form   = $this->createCreateForm($entity);

        return $this->render('VValoraBundle:TbProducto:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TbProducto entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VValoraBundle:TbProducto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbProducto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('VValoraBundle:TbProducto:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TbProducto entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VValoraBundle:TbProducto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbProducto entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('VValoraBundle:TbProducto:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a TbProducto entity.
    *
    * @param TbProducto $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TbProducto $entity)
    {
        $form = $this->createForm(new TbProductoType(), $entity, array(
            'action' => $this->generateUrl('Producto_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TbProducto entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VValoraBundle:TbProducto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbProducto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('Producto_edit', array('id' => $id)));
        }

        return $this->render('VValoraBundle:TbProducto:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a TbProducto entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('VValoraBundle:TbProducto')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TbProducto entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('Producto'));
    }

    /**
     * Creates a form to delete a TbProducto entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('Producto_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
