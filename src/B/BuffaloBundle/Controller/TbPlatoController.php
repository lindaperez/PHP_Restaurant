<?php

namespace B\BuffaloBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use B\BuffaloBundle\Entity\TbPlato;
use B\BuffaloBundle\Form\TbPlatoType;

/**
 * TbPlato controller.
 *
 */
class TbPlatoController extends Controller
{

    /**
     * Lists all TbPlato entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BBuffaloBundle:TbPlato')->findAll();

        return $this->render('BBuffaloBundle:TbPlato:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new TbPlato entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new TbPlato();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ens_platos_show', array('id' => $entity->getId())));
        }

        return $this->render('BBuffaloBundle:TbPlato:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a TbPlato entity.
     *
     * @param TbPlato $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TbPlato $entity)
    {
        $form = $this->createForm(new TbPlatoType(), $entity, array(
            'action' => $this->generateUrl('ens_platos_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TbPlato entity.
     *
     */
    public function newAction()
    {
        $entity = new TbPlato();
        $form   = $this->createCreateForm($entity);

        return $this->render('BBuffaloBundle:TbPlato:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TbPlato entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BBuffaloBundle:TbPlato')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbPlato entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BBuffaloBundle:TbPlato:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TbPlato entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BBuffaloBundle:TbPlato')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbPlato entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BBuffaloBundle:TbPlato:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a TbPlato entity.
    *
    * @param TbPlato $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TbPlato $entity)
    {
        $form = $this->createForm(new TbPlatoType(), $entity, array(
            'action' => $this->generateUrl('ens_platos_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TbPlato entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BBuffaloBundle:TbPlato')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbPlato entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('ens_platos_edit', array('id' => $id)));
        }

        return $this->render('BBuffaloBundle:TbPlato:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a TbPlato entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BBuffaloBundle:TbPlato')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TbPlato entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ens_platos'));
    }

    /**
     * Creates a form to delete a TbPlato entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ens_platos_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
