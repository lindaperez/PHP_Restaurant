<?php

namespace B\BuffaloBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use B\BuffaloBundle\Entity\TbTipoPersona;
use B\BuffaloBundle\Form\TbTipoPersonaType;

/**
 * TbTipoPersona controller.
 *
 */
class TbTipoPersonaController extends Controller
{

    /**
     * Lists all TbTipoPersona entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BBuffaloBundle:TbTipoPersona')->findAll();

        return $this->render('BBuffaloBundle:TbTipoPersona:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new TbTipoPersona entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new TbTipoPersona();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ens_roles_show', array('id' => $entity->getId())));
        }

        return $this->render('BBuffaloBundle:TbTipoPersona:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a TbTipoPersona entity.
     *
     * @param TbTipoPersona $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TbTipoPersona $entity)
    {
        $form = $this->createForm(new TbTipoPersonaType(), $entity, array(
            'action' => $this->generateUrl('ens_roles_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TbTipoPersona entity.
     *
     */
    public function newAction()
    {
        $entity = new TbTipoPersona();
        $form   = $this->createCreateForm($entity);

        return $this->render('BBuffaloBundle:TbTipoPersona:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TbTipoPersona entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BBuffaloBundle:TbTipoPersona')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbTipoPersona entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BBuffaloBundle:TbTipoPersona:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TbTipoPersona entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BBuffaloBundle:TbTipoPersona')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbTipoPersona entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BBuffaloBundle:TbTipoPersona:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a TbTipoPersona entity.
    *
    * @param TbTipoPersona $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TbTipoPersona $entity)
    {
        $form = $this->createForm(new TbTipoPersonaType(), $entity, array(
            'action' => $this->generateUrl('ens_roles_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TbTipoPersona entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BBuffaloBundle:TbTipoPersona')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbTipoPersona entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('ens_roles_edit', array('id' => $id)));
        }

        return $this->render('BBuffaloBundle:TbTipoPersona:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a TbTipoPersona entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BBuffaloBundle:TbTipoPersona')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TbTipoPersona entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ens_roles'));
    }

    /**
     * Creates a form to delete a TbTipoPersona entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ens_roles_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
