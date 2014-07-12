<?php

namespace B\BuffaloBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use B\BuffaloBundle\Entity\TbEstadoCompra;
use B\BuffaloBundle\Form\TbEstadoCompraType;

/**
 * TbEstadoCompra controller.
 *
 */
class TbEstadoCompraController extends Controller
{

    /**
     * Lists all TbEstadoCompra entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BBuffaloBundle:TbEstadoCompra')->findAll();

        return $this->render('BBuffaloBundle:TbEstadoCompra:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new TbEstadoCompra entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new TbEstadoCompra();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ens_edoCompra_show', array('id' => $entity->getId())));
        }

        return $this->render('BBuffaloBundle:TbEstadoCompra:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a TbEstadoCompra entity.
     *
     * @param TbEstadoCompra $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TbEstadoCompra $entity)
    {
        $form = $this->createForm(new TbEstadoCompraType(), $entity, array(
            'action' => $this->generateUrl('ens_edoCompra_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TbEstadoCompra entity.
     *
     */
    public function newAction()
    {
        $entity = new TbEstadoCompra();
        $form   = $this->createCreateForm($entity);

        return $this->render('BBuffaloBundle:TbEstadoCompra:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TbEstadoCompra entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BBuffaloBundle:TbEstadoCompra')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbEstadoCompra entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BBuffaloBundle:TbEstadoCompra:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TbEstadoCompra entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BBuffaloBundle:TbEstadoCompra')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbEstadoCompra entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BBuffaloBundle:TbEstadoCompra:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a TbEstadoCompra entity.
    *
    * @param TbEstadoCompra $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TbEstadoCompra $entity)
    {
        $form = $this->createForm(new TbEstadoCompraType(), $entity, array(
            'action' => $this->generateUrl('ens_edoCompra_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TbEstadoCompra entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BBuffaloBundle:TbEstadoCompra')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbEstadoCompra entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('ens_edoCompra_edit', array('id' => $id)));
        }

        return $this->render('BBuffaloBundle:TbEstadoCompra:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a TbEstadoCompra entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BBuffaloBundle:TbEstadoCompra')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TbEstadoCompra entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ens_edoCompra'));
    }

    /**
     * Creates a form to delete a TbEstadoCompra entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ens_edoCompra_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
