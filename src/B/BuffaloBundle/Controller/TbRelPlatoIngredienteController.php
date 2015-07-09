<?php

namespace B\BuffaloBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use B\BuffaloBundle\Entity\TbRelPlatoIngrediente;
use B\BuffaloBundle\Form\TbRelPlatoIngredienteType;

/**
 * TbRelPlatoIngrediente controller.
 *
 */
class TbRelPlatoIngredienteController extends Controller
{

    /**
     * Lists all TbRelPlatoIngrediente entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BBuffaloBundle:TbRelPlatoIngrediente')->findAll();

        return $this->render('BBuffaloBundle:TbRelPlatoIngrediente:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new TbRelPlatoIngrediente entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new TbRelPlatoIngrediente();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ens_inventario_show', array('id' => $entity->getId())));
        }

        return $this->render('BBuffaloBundle:TbRelPlatoIngrediente:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a TbRelPlatoIngrediente entity.
     *
     * @param TbRelPlatoIngrediente $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TbRelPlatoIngrediente $entity)
    {
        $form = $this->createForm(new TbRelPlatoIngredienteType(), $entity, array(
            'action' => $this->generateUrl('ens_inventario_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TbRelPlatoIngrediente entity.
     *
     */
    public function newAction()
    {
        $entity = new TbRelPlatoIngrediente();
        $form   = $this->createCreateForm($entity);

        return $this->render('BBuffaloBundle:TbRelPlatoIngrediente:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TbRelPlatoIngrediente entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BBuffaloBundle:TbRelPlatoIngrediente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbRelPlatoIngrediente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BBuffaloBundle:TbRelPlatoIngrediente:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TbRelPlatoIngrediente entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BBuffaloBundle:TbRelPlatoIngrediente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbRelPlatoIngrediente entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BBuffaloBundle:TbRelPlatoIngrediente:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a TbRelPlatoIngrediente entity.
    *
    * @param TbRelPlatoIngrediente $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TbRelPlatoIngrediente $entity)
    {
        $form = $this->createForm(new TbRelPlatoIngredienteType(), $entity, array(
            'action' => $this->generateUrl('ens_inventario_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TbRelPlatoIngrediente entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BBuffaloBundle:TbRelPlatoIngrediente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbRelPlatoIngrediente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('ens_inventario_edit', array('id' => $id)));
        }

        return $this->render('BBuffaloBundle:TbRelPlatoIngrediente:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a TbRelPlatoIngrediente entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BBuffaloBundle:TbRelPlatoIngrediente')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TbRelPlatoIngrediente entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ens_inventario'));
    }

    /**
     * Creates a form to delete a TbRelPlatoIngrediente entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ens_inventario_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
