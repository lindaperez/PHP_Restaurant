<?php

namespace B\BuffaloBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use B\BuffaloBundle\Entity\TbIngrediente;
use B\BuffaloBundle\Form\TbIngredienteType;

/**
 * TbIngrediente controller.
 *
 */
class TbIngredienteController extends Controller
{

    /**
     * Lists all TbIngrediente entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BBuffaloBundle:TbIngrediente')->findAll();

        return $this->render('BBuffaloBundle:TbIngrediente:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new TbIngrediente entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new TbIngrediente();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ens_ingredientes_show', array('id' => $entity->getId())));
        }

        return $this->render('BBuffaloBundle:TbIngrediente:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a TbIngrediente entity.
     *
     * @param TbIngrediente $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TbIngrediente $entity)
    {
        $form = $this->createForm(new TbIngredienteType(), $entity, array(
            'action' => $this->generateUrl('ens_ingredientes_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TbIngrediente entity.
     *
     */
    public function newAction()
    {
        $entity = new TbIngrediente();
        $form   = $this->createCreateForm($entity);

        return $this->render('BBuffaloBundle:TbIngrediente:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TbIngrediente entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BBuffaloBundle:TbIngrediente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbIngrediente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BBuffaloBundle:TbIngrediente:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TbIngrediente entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BBuffaloBundle:TbIngrediente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbIngrediente entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BBuffaloBundle:TbIngrediente:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a TbIngrediente entity.
    *
    * @param TbIngrediente $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TbIngrediente $entity)
    {
        $form = $this->createForm(new TbIngredienteType(), $entity, array(
            'action' => $this->generateUrl('ens_ingredientes_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TbIngrediente entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BBuffaloBundle:TbIngrediente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbIngrediente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('ens_ingredientes_edit', array('id' => $id)));
        }

        return $this->render('BBuffaloBundle:TbIngrediente:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a TbIngrediente entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BBuffaloBundle:TbIngrediente')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TbIngrediente entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ens_ingredientes'));
    }

    /**
     * Creates a form to delete a TbIngrediente entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ens_ingredientes_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
