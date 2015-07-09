<?php

namespace V\ValoraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use V\ValoraBundle\Entity\TbPersona;
use V\ValoraBundle\Form\TbPersonaType;

/**
 * TbPersona controller.
 *
 */
class TbPersonaController extends Controller
{

    /**
     * Lists all TbPersona entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('VValoraBundle:TbPersona')->findAll();

        return $this->render('VValoraBundle:TbPersona:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new TbPersona entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new TbPersona();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('Persona_show', array('id' => $entity->getId())));
        }

        return $this->render('VValoraBundle:TbPersona:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a TbPersona entity.
     *
     * @param TbPersona $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TbPersona $entity)
    {
        $form = $this->createForm(new TbPersonaType(), $entity, array(
            'action' => $this->generateUrl('Persona_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TbPersona entity.
     *
     */
    public function newAction()
    {
        $entity = new TbPersona();
        $entity->setVclave(0000);           
        $form   = $this->createCreateForm($entity);

        return $this->render('VValoraBundle:TbPersona:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TbPersona entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VValoraBundle:TbPersona')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbPersona entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('VValoraBundle:TbPersona:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TbPersona entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VValoraBundle:TbPersona')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbPersona entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('VValoraBundle:TbPersona:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a TbPersona entity.
    *
    * @param TbPersona $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TbPersona $entity)
    {
        $form = $this->createForm(new TbPersonaType(), $entity, array(
            'action' => $this->generateUrl('Persona_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TbPersona entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VValoraBundle:TbPersona')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbPersona entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('Persona_edit', array('id' => $id)));
        }

        return $this->render('VValoraBundle:TbPersona:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a TbPersona entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('VValoraBundle:TbPersona')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TbPersona entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('Persona'));
    }

    /**
     * Creates a form to delete a TbPersona entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('Persona_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
