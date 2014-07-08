<?php

namespace B\BuffaloBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use B\BuffaloBundle\Entity\TbRelCompraPlato;
use B\BuffaloBundle\Form\TbRelCompraPlatoType;

/**
 * TbRelCompraPlato controller.
 *
 */
class TbRelCompraPlatoController extends Controller
{

    /**
     * Lists all TbRelCompraPlato entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BBuffaloBundle:TbRelCompraPlato')->findAll();

        return $this->render('BBuffaloBundle:TbRelCompraPlato:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new TbRelCompraPlato entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new TbRelCompraPlato();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ens_pedidos_show', array('id' => $entity->getId())));
        }

        return $this->render('BBuffaloBundle:TbRelCompraPlato:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a TbRelCompraPlato entity.
     *
     * @param TbRelCompraPlato $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TbRelCompraPlato $entity)
    {
        $form = $this->createForm(new TbRelCompraPlatoType(), $entity, array(
            'action' => $this->generateUrl('ens_pedidos_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TbRelCompraPlato entity.
     *
     */
    public function newAction()
    {
        $entity = new TbRelCompraPlato();
        $form   = $this->createCreateForm($entity);

        return $this->render('BBuffaloBundle:TbRelCompraPlato:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TbRelCompraPlato entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BBuffaloBundle:TbRelCompraPlato')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbRelCompraPlato entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BBuffaloBundle:TbRelCompraPlato:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TbRelCompraPlato entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BBuffaloBundle:TbRelCompraPlato')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbRelCompraPlato entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BBuffaloBundle:TbRelCompraPlato:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a TbRelCompraPlato entity.
    *
    * @param TbRelCompraPlato $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TbRelCompraPlato $entity)
    {
        $form = $this->createForm(new TbRelCompraPlatoType(), $entity, array(
            'action' => $this->generateUrl('ens_pedidos_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TbRelCompraPlato entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BBuffaloBundle:TbRelCompraPlato')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbRelCompraPlato entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('ens_pedidos_edit', array('id' => $id)));
        }

        return $this->render('BBuffaloBundle:TbRelCompraPlato:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a TbRelCompraPlato entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BBuffaloBundle:TbRelCompraPlato')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TbRelCompraPlato entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ens_pedidos'));
    }

    /**
     * Creates a form to delete a TbRelCompraPlato entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ens_pedidos_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
