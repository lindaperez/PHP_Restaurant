<?php

namespace B\BuffaloBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use B\BuffaloBundle\Entity\TbMedida;
use B\BuffaloBundle\Form\TbMedidaType;

/**
 * TbMedida controller.
 *
 */
class TbMedidaController extends Controller
{

    /**
     * Lists all TbMedida entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BBuffaloBundle:TbMedida')->findAll();

        return $this->render('BBuffaloBundle:TbMedida:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new TbMedida entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new TbMedida();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ens_medidas_show', array('id' => $entity->getId())));
        }

        return $this->render('BBuffaloBundle:TbMedida:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a TbMedida entity.
     *
     * @param TbMedida $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TbMedida $entity)
    {
        $form = $this->createForm(new TbMedidaType(), $entity, array(
            'action' => $this->generateUrl('ens_medidas_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TbMedida entity.
     *
     */
    public function newAction()
    {
        $entity = new TbMedida();
        $form   = $this->createCreateForm($entity);

        return $this->render('BBuffaloBundle:TbMedida:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TbMedida entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BBuffaloBundle:TbMedida')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbMedida entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BBuffaloBundle:TbMedida:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TbMedida entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BBuffaloBundle:TbMedida')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbMedida entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BBuffaloBundle:TbMedida:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a TbMedida entity.
    *
    * @param TbMedida $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TbMedida $entity)
    {
        $form = $this->createForm(new TbMedidaType(), $entity, array(
            'action' => $this->generateUrl('ens_medidas_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TbMedida entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BBuffaloBundle:TbMedida')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbMedida entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('ens_medidas_edit', array('id' => $id)));
        }

        return $this->render('BBuffaloBundle:TbMedida:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a TbMedida entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BBuffaloBundle:TbMedida')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TbMedida entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ens_medidas'));
    }

    /**
     * Creates a form to delete a TbMedida entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ens_medidas_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
