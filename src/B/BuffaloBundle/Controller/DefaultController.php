<?php

namespace B\BuffaloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use B\BuffaloBundle\Entity\TbPersona;

class DefaultController extends Controller
{
        public function indexAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        
       // print_r("Begin");
        //Se busca y define el tipo de Rol del usuario
        $user = $this->getUser();
        if($user!=null){
            //Se extrae Rol, Tipo de Rol, y Estatus
            $em = $this->getDoctrine()->getManager();
            
            $usuario_acceso = $em->getRepository('BBuffaloBundle:TbPersona')
               ->findOneBy(array('icedula'=> $user->getIcedula()));   
            //print_r($usuario_acceso->getFkIidRol()->getVdescripcion());
            $rol=$usuario_acceso->getFkIidTipoPersona()->getVtitulo();
            $session->set('usuario_rol',$rol);   
            
            $estatus= $usuario_acceso->getFkIidEstadoPersona()->getVdescripcion();
       /*     print " ::".$rol." ; ";
            print $tipo_rol." ; ";
            print $estatus." :: ";   
        * */
            
            $session->set('usuario_estatus_registro',$estatus);   
            $session->set('usuario_ci',$user->getIcedula());   
            // Se deben agregar las Funciones para ese usuario dado el Rol
            // que posee
            
            if($estatus=="Anulado" ){
                
                return $this->render('BBuffaloBundle:Default:erroracceso.html.twig');
            }
        }else{
                return $this->render('BBuffaloBundle:Default:erroracceso.html.twig');
        }
        
                return $this->render('BBuffaloBundle:Default:index.html.twig');
    }
 


   
        
    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
 
        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
            
          
        }
             
        return $this->render('BBuffaloBundle:Default:login.html.twig', array(
            // last username entered by the user
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        ));
    }
       public function erroraccesoAction()
    {
        return $this->render('BBuffaloBundle:Default:erroracceso.html.twig');
       
    }

}
