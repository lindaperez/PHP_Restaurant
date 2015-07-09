<?php

namespace B\BuffaloBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use B\BuffaloBundle\Entity\TbEstadoIng;
use B\BuffaloBundle\Form\TbEstadoIngType;

/**
 * TbEstadoIng controller.
 *
 */
class TbEstadoIngController extends Controller
{

    /**
     * Lists all TbEstadoIng entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BBuffaloBundle:TbEstadoIng')->findAll();

        return $this->render('BBuffaloBundle:TbEstadoIng:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new TbEstadoIng entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new TbEstadoIng();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ens_edoIngrediente_show', array('id' => $entity->getId())));
        }

        return $this->render('BBuffaloBundle:TbEstadoIng:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a TbEstadoIng entity.
     *
     * @param TbEstadoIng $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TbEstadoIng $entity)
    {
        $form = $this->createForm(new TbEstadoIngType(), $entity, array(
            'action' => $this->generateUrl('ens_edoIngrediente_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TbEstadoIng entity.
     *
     */
    public function newAction()
    {
        $entity = new TbEstadoIng();
        $form   = $this->createCreateForm($entity);

        return $this->render('BBuffaloBundle:TbEstadoIng:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TbEstadoIng entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BBuffaloBundle:TbEstadoIng')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbEstadoIng entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BBuffaloBundle:TbEstadoIng:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TbEstadoIng entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BBuffaloBundle:TbEstadoIng')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbEstadoIng entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BBuffaloBundle:TbEstadoIng:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a TbEstadoIng entity.
    *
    * @param TbEstadoIng $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TbEstadoIng $entity)
    {
        $form = $this->createForm(new TbEstadoIngType(), $entity, array(
            'action' => $this->generateUrl('ens_edoIngrediente_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TbEstadoIng entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BBuffaloBundle:TbEstadoIng')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbEstadoIng entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('ens_edoIngrediente_edit', array('id' => $id)));
        }

        return $this->render('BBuffaloBundle:TbEstadoIng:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a TbEstadoIng entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BBuffaloBundle:TbEstadoIng')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TbEstadoIng entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ens_edoIngrediente'));
    }

    /**
     * Creates a form to delete a TbEstadoIng entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ens_edoIngrediente_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
