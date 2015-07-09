<?php

namespace B\BuffaloBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use B\BuffaloBundle\Entity\TbEstadoPersona;
use B\BuffaloBundle\Form\TbEstadoPersonaType;

/**
 * TbEstadoPersona controller.
 *
 */
class TbEstadoPersonaController extends Controller
{

    /**
     * Lists all TbEstadoPersona entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BBuffaloBundle:TbEstadoPersona')->findAll();

        return $this->render('BBuffaloBundle:TbEstadoPersona:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new TbEstadoPersona entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new TbEstadoPersona();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ens_edoPersona_show', array('id' => $entity->getId())));
        }

        return $this->render('BBuffaloBundle:TbEstadoPersona:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a TbEstadoPersona entity.
     *
     * @param TbEstadoPersona $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TbEstadoPersona $entity)
    {
        $form = $this->createForm(new TbEstadoPersonaType(), $entity, array(
            'action' => $this->generateUrl('ens_edoPersona_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TbEstadoPersona entity.
     *
     */
    public function newAction()
    {
        $entity = new TbEstadoPersona();
        $form   = $this->createCreateForm($entity);

        return $this->render('BBuffaloBundle:TbEstadoPersona:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TbEstadoPersona entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BBuffaloBundle:TbEstadoPersona')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbEstadoPersona entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BBuffaloBundle:TbEstadoPersona:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TbEstadoPersona entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BBuffaloBundle:TbEstadoPersona')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbEstadoPersona entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BBuffaloBundle:TbEstadoPersona:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a TbEstadoPersona entity.
    *
    * @param TbEstadoPersona $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TbEstadoPersona $entity)
    {
        $form = $this->createForm(new TbEstadoPersonaType(), $entity, array(
            'action' => $this->generateUrl('ens_edoPersona_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TbEstadoPersona entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BBuffaloBundle:TbEstadoPersona')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbEstadoPersona entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('ens_edoPersona_edit', array('id' => $id)));
        }

        return $this->render('BBuffaloBundle:TbEstadoPersona:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a TbEstadoPersona entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BBuffaloBundle:TbEstadoPersona')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TbEstadoPersona entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ens_edoPersona'));
    }

    /**
     * Creates a form to delete a TbEstadoPersona entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ens_edoPersona_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
