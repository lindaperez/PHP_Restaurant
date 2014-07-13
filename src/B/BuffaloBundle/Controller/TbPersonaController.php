<?php

namespace B\BuffaloBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use B\BuffaloBundle\Entity\TbPersona;
use B\BuffaloBundle\Form\TbPersonaType;

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

        $entities = $em->getRepository('BBuffaloBundle:TbPersona')->findAll();

        return $this->render('BBuffaloBundle:TbPersona:index.html.twig', array(
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
            
            /*Gestion de Clave cifrada*/
            $g_userName = $entity->getIcedula();
            $g_password = $this->makekey();
            $g_userInter = $this->makepassword($g_userName, $g_password);    
            $entity->setVclave($g_userInter->getVclave());
            /*Fin de Clave cifrada*/
            $em = $this->getDoctrine()->getManager();
            //tipo-persona
            
            $estado_persona= $em->getRepository('BBuffaloBundle:TbEstadoPersona')->find(1);
            $entity->setFkIidEstadoPersona($estado_persona);
            
            
            $em->persist($entity);
            $em->flush();
                //Envio de correo de confirmacion
             
             $this->mailer($entity, $g_password, $entity->getVcorreo());
            return $this->redirect($this->generateUrl('ens_personas_show', array('id' => $entity->getId())));
        }

        return $this->render('BBuffaloBundle:TbPersona:new.html.twig', array(
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
            'action' => $this->generateUrl('ens_personas_create'),
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
        
        return $this->render('BBuffaloBundle:TbPersona:new.html.twig', array(
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

        $entity = $em->getRepository('BBuffaloBundle:TbPersona')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbPersona entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BBuffaloBundle:TbPersona:show.html.twig', array(
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

        $entity = $em->getRepository('BBuffaloBundle:TbPersona')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbPersona entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BBuffaloBundle:TbPersona:edit.html.twig', array(
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
            'action' => $this->generateUrl('ens_personas_update', array('id' => $entity->getId())),
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

        $entity = $em->getRepository('BBuffaloBundle:TbPersona')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbPersona entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('ens_personas_edit', array('id' => $id)));
        }

        return $this->render('BBuffaloBundle:TbPersona:edit.html.twig', array(
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
            $entity = $em->getRepository('BBuffaloBundle:TbPersona')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TbPersona entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ens_personas'));
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
            ->setAction($this->generateUrl('ens_personas_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
    
    
    /*Metodos para la Clave*/
     protected function makekey() {
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $cad = "";
        for ($i = 0; $i < 6; $i++) {
            $cad .= substr($str, rand(0, 61), 1);
        }
        return $cad;
    }

    protected function makepassword($username, $password) {
        $user = new TbPersona();
        $user->setUsername($username);
        // encode the password

        $factory = $this->get('security.encoder_factory');
        $encoder = $factory->getEncoder($user);
        $encodedPassword = $encoder->encodePassword($password, $user->getSalt());
        $user->setPassword($encodedPassword);
        return $user;
    }

    
    /**/
    
     public function mailer($entity, $pass, $to) {

        $message = \Swift_Message::newInstance()
                ->setSubject('Empresa Buffalo Registro exitoso')
                ->setFrom('rosmery.p.p@gmail.com')
                ->setTo($to)
                ->setBody(
                $this->renderView(
                        'BBuffaloBundle:Default:mail.html.twig', array('entity' => $entity, 'pass' => $pass)
                )
                , 'text/html')
        ;
        $this->get('mailer')->send($message);
    }

}
