<?php

namespace B\BuffaloBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use B\BuffaloBundle\Entity\TbMesa;
use B\BuffaloBundle\Form\TbMesaType;

/**
 * TbMesa controller.
 *
 */
class TbMesaController extends Controller
{

    /**
     * Lists all TbMesa entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BBuffaloBundle:TbMesa')->findAll();

        return $this->render('BBuffaloBundle:TbMesa:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new TbMesa entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new TbMesa();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ens_mesas_show', array('id' => $entity->getId())));
        }

        return $this->render('BBuffaloBundle:TbMesa:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a TbMesa entity.
     *
     * @param TbMesa $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TbMesa $entity)
    {
        $form = $this->createForm(new TbMesaType(), $entity, array(
            'action' => $this->generateUrl('ens_mesas_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TbMesa entity.
     *
     */
    public function newAction()
    {
        $entity = new TbMesa();
        $form   = $this->createCreateForm($entity);

        return $this->render('BBuffaloBundle:TbMesa:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TbMesa entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BBuffaloBundle:TbMesa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbMesa entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BBuffaloBundle:TbMesa:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TbMesa entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BBuffaloBundle:TbMesa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbMesa entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BBuffaloBundle:TbMesa:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a TbMesa entity.
    *
    * @param TbMesa $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TbMesa $entity)
    {
        $form = $this->createForm(new TbMesaType(), $entity, array(
            'action' => $this->generateUrl('ens_mesas_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TbMesa entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BBuffaloBundle:TbMesa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbMesa entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('ens_mesas_edit', array('id' => $id)));
        }

        return $this->render('BBuffaloBundle:TbMesa:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a TbMesa entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BBuffaloBundle:TbMesa')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TbMesa entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ens_mesas'));
    }

    /**
     * Creates a form to delete a TbMesa entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ens_mesas_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
