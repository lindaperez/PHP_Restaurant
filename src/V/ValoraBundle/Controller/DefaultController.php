<?php
namespace V\ValoraBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use B\BuffaloBundle\Entity\TbPersona;
use Doctrine\DBAL\Query\QueryBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;
use B\BuffaloBundle\Form\ForgotpassType;

class DefaultController extends Controller
{
        public function indexAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        
        //Se busca y define el tipo de Rol del usuario
        $user = $this->getUser();
        if($user!=null){
            //Se extrae Rol, Tipo de Rol, y Estatus
            $em = $this->getDoctrine()->getManager();
            
            $usuario_acceso = $em->getRepository('VValoraBundle:TbPersona')
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
                
                return $this->render('VValoraBundle:Default:erroracceso.html.twig');
            }
        }else{
                return $this->render('VValoraBundle:Default:index.html.twig');
        }
        
                return $this->render('VValoraBundle:Default:index.html.twig');
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
             
        return $this->render('VValoraBundle:Default:login.html.twig', array(
            // last username entered by the user
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        ));
    }
       public function erroraccesoAction()
    {
        return $this->render('VValoraBundle:Default:erroracceso.html.twig');
       
    }
    //Envio de contrasena
    
/*Forgot Password method*/
    public function  newforgotAction() {
        $request = $this->getRequest();
        $session = $request->getSession();
      
        // Llenar entity con el usuario que olvido su clave
        // Muestra campos del formulario
        
        $data = array();
        $form = $this->createForm(new ForgotpassType(),$data,array(
            'action' => $this->generateUrl('createforgot'),
            'method' => 'POST',
        
            ));
        $form->add('submit', 'submit', array('label' => 'Enviar'));
        
        
        return $this->render('VValoraBundle:Default:envioOlvidoContrasena.html.twig', array(
                    'entity' => $data,
                    'form' => $form->createView(),
        ));
    }

     public function createforgotAction() {
        
        $request = $this->getRequest();
        $data = array();
  
        $form = $this->createForm(new ForgotpassType(), $data, array(
            'action' => $this->generateUrl('createforgot'),
            'method' => 'POST',
        
            ));
        $form->add('submit', 'submit', array('label' => 'Enviar'));
        $form->handleRequest($request);
   
        
        if ($form->isValid()) {
        //Buscar usuario con ese correo especifico
            
            //$usuario= new \Tech\TBundle\Entity\Tbdetusuariodatos();
            $em = $this->getDoctrine()->getManager();
            $usuario = $em->getRepository('VValoraBundle:TbPersona')
        ->findOneBy(array('vcorreo' => $form['vcorreo']->getData(),
            'icedula' => $form['icedula']->getData()));
        
            if ($usuario!=null){
            
                          /* Generacion de clave */
                $g_userName = $usuario->getIcedula();
                $g_password = $this->makekey();
                $g_userInter = $this->makepassword($g_userName, $g_password);
                $usuario->setVclave($g_userInter->getVclave());  
                //print $g_password;
                //print "---";
                //print $usuario->getVclave();
                
                //Enviar correo
                //Si se envio entonces guardar sino reportar error
                $result=$this->mailerPass($usuario->getVnombre(),
                        $g_userName, $g_password,$usuario->getVcorreo());
                
                if($result==1){
                    $em->flush();
                
                $message_success = "Su contraseña ha sido restablecida exitosamente";
                $message_info = "Recuerde revisar su correo electrónico para poder ingresar al sistema.";
                $this->get('session')->getFlashBag()->add('flash_success', $message_success);
                $this->get('session')->getFlashBag()->add('flash_info', $message_info);
                
                return $this->render('VValoraBundle:Default:successOlvidoContrasena.html.twig',array(
                             'entity' => $usuario,
                ));
                }
                
            }
        }
        //Converion de contra a SHA2 
          $message_error = "Ocurrió un error con sus datos o envío de los mismos. "
                        . "Su contraseña no fue restablecida.";
          $message_info = "Revise que el correo electrónico que introdujo exista.";
          $this->get('session')->getFlashBag()->add('flash_info', $message_info);
                $this->get('session')->getFlashBag()->add('flash_error', $message_error);
           return $this->render('VValoraBundle:Default:envioOlvidoContrasena.html.twig', array(
                    'entity' => $data,
                    'form' => $form->createView(),
        ));
         
    }
     public function mailerPass($vnombre, $icedula, $pass,$to) {

        $message = \Swift_Message::newInstance()
                ->setSubject('Empresa Buffalo envio contraseña exitoso')
                ->setFrom('rosmery.p.p@gmail.com')
                ->setTo($to)
                ->setBody(
                $this->renderView(
                        'VValoraBundle:Default:mailcontrasena.html.twig',
                        array('vnombre' => $vnombre,'icedula' => $icedula, 'pass' => $pass)
                )
                , 'text/html')
        ;
        $result=$this->get('mailer')->send($message);
        
        return $result;
    }
    //
    
    
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
        //
    //Especificaciones
    
    //TERMINANTEMENTE PROHIBIDO LOS PRINT PARA EL JSON RESPONSE
 
//    public function maxplatosAction(Request $request)
        public function maxplatosAction()
{
       $ago = new \DateTime('30 days ago');
       $now = new \DateTime('now');
       $em = $this->getDoctrine()->getManager();
       $qb=$em->getRepository('VValoraBundle:TbRelCompraPlato')->createQueryBuilder('r');
       $qb->addselect('p.vnombre');
       $qb->addselect('r.icantidad');
       $qb->addselect('c.dtfechaCompra');
       $qb->join('VValoraBundle:TbPlato', 'p', 'WITH', 'p.id=r.fkIidCplato');
       $qb->join('VValoraBundle:TbCompra', 'c', 'WITH', 'c.id=r.fkIidCompra');
       $qb->where('c.dtfechaCompra BETWEEN :ago AND :now');
       $qb->setParameter('ago', $ago->format('Y-m-d'));
       $qb->setParameter('now', $now->format('Y-m-d'));
       //$qb->addGroupBy('c.dtfechaCompra');
       $qb->addGroupBy('p.vnombre');
       $qb->addGroupBy('r.icantidad');
       $qb->OrderBy('c.dtfechaCompra','ASC');
       $query_pages=$qb->getQuery();     
       $entities =$query_pages->execute();
       
       //DATE_SUB(CURDATE(),INTERVAL 30 DAY) <= date_col
               
       $data=array();
        if ($entities!=null){      
            for ($i = 0; $i < count($entities); $i++) {
            $data[$i]=array('id'=>$entities[$i][0]->getId(),
                            'idc'=>$entities[$i][0]->getfkIidCompra()->getId(),
                            'name'=>$entities[$i][0]->getfkIidCplato()->getVnombre(),
                            'cant'=>$entities[$i][0]->getIcantidad(),
                            'dia'=>$entities[$i][0]->getfkIidCompra()->getdtfechaCompra()->format('d'),
                            'mes'=>$entities[$i][0]->getfkIidCompra()->getdtfechaCompra()->format('m'),
                            'ano'=>$entities[$i][0]->getfkIidCompra()->getdtfechaCompra()->format('Y'),
                    );
            
            }
            
       return new JsonResponse($data);
        }else{
       return new JsonResponse(null);    
        }
}

 public function platosSolicitadosAction()
    {
        
        return $this->render('VValoraBundle:Default:platosSolicitados.html.twig');
    
 
    }
    public function gananciasMesDiaAction()
{
       $ago = new \DateTime('60 days ago');
       $now = new \DateTime('now');
       $em = $this->getDoctrine()->getManager();
       
       $dql = "SELECT c.id,c.dtfechaCompra,SUM(c.dcosto) AS costo FROM B\BuffaloBundle\Entity\TbCompra c "
               . "JOIN B\BuffaloBundle\Entity\TbEstadoCompra e WITH e.id=c.fkIidEstadoCompra " .
                " WHERE e.id=?1"
               ." GROUP BY c.dtfechaCompra ORDER BY c.dtfechaCompra ASC";
       
       $suma = $em->createQuery($dql)
              ->setParameter(1, 1)
       //       ->setParameter('ago', $ago->format('Y-m-d'))
         //     ->setParameter('now', $now->format('Y-m-d'))
              ->getResult();
         
       $data=array();
        if ($suma!=null){      
            for ($i = 0; $i < count($suma); $i++) {
            $data[$i]=array('id'=>$suma[$i]['id'],
                            'costo'=>intval($suma[$i]['costo']),
                            'dia'=>$suma[$i]['dtfechaCompra']->format('d'),
                            'mes'=>$suma[$i]['dtfechaCompra']->format('m'),
                            'ano'=>$suma[$i]['dtfechaCompra']->format('Y'),
                    );
            
            }
            
       return new JsonResponse($data);
        }else{
       return new JsonResponse(null);    
        }
}

 public function gananciasAction()
    {
        
        return $this->render('VValoraBundle:Default:ganancias.html.twig');
    
 
    }
        public function gananciasMesAction()
{
       $ago = new \DateTime('30 days ago');
       $now = new \DateTime('now');
       $em = $this->getDoctrine()->getManager();
       
       $dql = "SELECT MONTH(c.dtfechaCompra) as month, c.id,c.dtfechaCompra,SUM(c.dcosto) AS costo FROM B\BuffaloBundle\Entity\TbCompra c "
               . "JOIN B\BuffaloBundle\Entity\TbEstadoCompra e WITH e.id=c.fkIidEstadoCompra " .
                " WHERE e.id=?1 GROUP BY month ORDER BY month";
       $suma = $em->createQuery($dql)
              ->setParameter(1, 1)
              ->getResult();
 
       $data=array();
        if ($suma!=null){      
            for ($i = 0; $i < count($suma); $i++) {
            $data[$i]=array('id'=>$suma[$i]['id'],
                            'costo'=>intval($suma[$i]['costo']),
                            'dia'=>$suma[$i]['dtfechaCompra']->format('d'),
                            'mes'=>$suma[$i]['dtfechaCompra']->format('m'),
                            'ano'=>$suma[$i]['dtfechaCompra']->format('Y'),
                    );
            
            }
            
       return new JsonResponse($data);
        }else{
       return new JsonResponse(null);    
        }
}

 public function gananciasMes2Action()
    {
        
        return $this->render('VValoraBundle:Default:gananciasMes.html.twig');
    
 
    }
            public function comensalesPersonalAction()
{
       $em = $this->getDoctrine()->getManager();
       $dql = "SELECT COUNT(c.id) as cantidad, m.id, m.vnombre, m.vapellido "
               . "FROM B\BuffaloBundle\Entity\TbCompra c "
               . "JOIN B\BuffaloBundle\Entity\TbPersona m WITH m.id = c.fkIidMesero "
               . "GROUP BY c.fkIidMesero ";
       $suma = $em->createQuery($dql)
              ->getResult();
 
       $data=array();
        if ($suma!=null){      
            for ($i = 0; $i < count($suma); $i++) {
            $data[$i]=array('id'=>intval($suma[$i]['id']),
                            'cantidad'=>intval($suma[$i]['cantidad']),
                            'nombre'=>$suma[$i]['vnombre'],
                            'apellido'=>$suma[$i]['vapellido'],
                    );
            
            }
            
       return new JsonResponse($data);
        }else{
       return new JsonResponse(null);    
        }
}

 public function comensalesPorPersonalAction()
    {
        
        return $this->render('VValoraBundle:Default:comensalesPersonal.html.twig');
    
 
    }
}

