<?php

namespace V\ValoraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use V\ValoraBundle\Entity\TbEdoServicio;
use V\ValoraBundle\Form\TbEdoServicioType;

/**
 * TbEdoServicio controller.
 *
 */
class TbEdoServicioController extends Controller
{

    /**
     * Lists all TbEdoServicio entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('VValoraBundle:TbEdoServicio')->findAll();

        return $this->render('VValoraBundle:TbEdoServicio:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new TbEdoServicio entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new TbEdoServicio();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('EdoServicio_show', array('id' => $entity->getId())));
        }

        return $this->render('VValoraBundle:TbEdoServicio:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a TbEdoServicio entity.
     *
     * @param TbEdoServicio $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TbEdoServicio $entity)
    {
        $form = $this->createForm(new TbEdoServicioType(), $entity, array(
            'action' => $this->generateUrl('EdoServicio_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TbEdoServicio entity.
     *
     */
    public function newAction()
    {
        $entity = new TbEdoServicio();
        $form   = $this->createCreateForm($entity);

        return $this->render('VValoraBundle:TbEdoServicio:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TbEdoServicio entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VValoraBundle:TbEdoServicio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbEdoServicio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('VValoraBundle:TbEdoServicio:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TbEdoServicio entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VValoraBundle:TbEdoServicio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbEdoServicio entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('VValoraBundle:TbEdoServicio:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a TbEdoServicio entity.
    *
    * @param TbEdoServicio $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TbEdoServicio $entity)
    {
        $form = $this->createForm(new TbEdoServicioType(), $entity, array(
            'action' => $this->generateUrl('EdoServicio_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TbEdoServicio entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VValoraBundle:TbEdoServicio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbEdoServicio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('EdoServicio_edit', array('id' => $id)));
        }

        return $this->render('VValoraBundle:TbEdoServicio:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a TbEdoServicio entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('VValoraBundle:TbEdoServicio')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TbEdoServicio entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('EdoServicio'));
    }

    /**
     * Creates a form to delete a TbEdoServicio entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('EdoServicio_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
