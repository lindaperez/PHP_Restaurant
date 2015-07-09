<?php

namespace V\ValoraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use V\ValoraBundle\Entity\TbRelPaqueteProducto;
use V\ValoraBundle\Form\TbRelPaqueteProductoType;

/**
 * TbRelPaqueteProducto controller.
 *
 */
class TbRelPaqueteProductoController extends Controller
{

    /**
     * Lists all TbRelPaqueteProducto entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('VValoraBundle:TbRelPaqueteProducto')->findAll();

        return $this->render('VValoraBundle:TbRelPaqueteProducto:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new TbRelPaqueteProducto entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new TbRelPaqueteProducto();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('RelPaqueteProducto_show', array('id' => $entity->getId())));
        }

        return $this->render('VValoraBundle:TbRelPaqueteProducto:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a TbRelPaqueteProducto entity.
     *
     * @param TbRelPaqueteProducto $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TbRelPaqueteProducto $entity)
    {
        $form = $this->createForm(new TbRelPaqueteProductoType(), $entity, array(
            'action' => $this->generateUrl('RelPaqueteProducto_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TbRelPaqueteProducto entity.
     *
     */
    public function newAction()
    {
        $entity = new TbRelPaqueteProducto();
        $form   = $this->createCreateForm($entity);

        return $this->render('VValoraBundle:TbRelPaqueteProducto:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TbRelPaqueteProducto entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VValoraBundle:TbRelPaqueteProducto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbRelPaqueteProducto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('VValoraBundle:TbRelPaqueteProducto:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TbRelPaqueteProducto entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VValoraBundle:TbRelPaqueteProducto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbRelPaqueteProducto entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('VValoraBundle:TbRelPaqueteProducto:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a TbRelPaqueteProducto entity.
    *
    * @param TbRelPaqueteProducto $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TbRelPaqueteProducto $entity)
    {
        $form = $this->createForm(new TbRelPaqueteProductoType(), $entity, array(
            'action' => $this->generateUrl('RelPaqueteProducto_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TbRelPaqueteProducto entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VValoraBundle:TbRelPaqueteProducto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbRelPaqueteProducto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('RelPaqueteProducto_edit', array('id' => $id)));
        }

        return $this->render('VValoraBundle:TbRelPaqueteProducto:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a TbRelPaqueteProducto entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('VValoraBundle:TbRelPaqueteProducto')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TbRelPaqueteProducto entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('RelPaqueteProducto'));
    }

    /**
     * Creates a form to delete a TbRelPaqueteProducto entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('RelPaqueteProducto_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
