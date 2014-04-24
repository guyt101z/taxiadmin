<?php

namespace TaxiAdmin\SitioBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use TaxiAdmin\UsuarioBundle\Entity\Usuario;
use TaxiAdmin\UsuarioBundle\Form\UsuarioType;

/**
 * Sitio controller.
 *
 * @Route("/")
 */
class SitioController extends Controller {

	/**
     * Show Usuario dashboard.
     *
     * @Route("/", name="sitio_home")
     * @Method("GET")
     * @Template("TaxiAdminSitioBundle:Sitio:home.html.twig")
     */
    public function homeAction() {
        $session = $this->getRequest()->getSession();

        return array(
            'formUsuario'   => $this->createForm(new UsuarioType(), new Usuario)->createView(),
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => NULL,
            );
    }

    /**
     *
     * @Route("/soporte", name="sitio_soporte")
     * @Method("GET|POST")
     * @Template("TaxiAdminSitioBundle:Sitio:soporte.html.twig")
     */
    public function soporteAction(Request $request) {

        $form = $this->createFormBuilder()
        ->setAction($this->generateUrl('sitio_soporte'))
        ->setMethod('POST')
        ->add('asunto', 'text', array('attr' => array('class' => 'form-control', 'placeholder' => 'Asunto', 'autofocus' => '')))
        ->add('mensaje', 'textarea', array('attr' => array('class' => 'form-control', 'placeholder' => 'Mensaje')))
        ->add('submit', 'submit', array('attr' => array('class' => 'btn btn-default')))
        ->getForm();

        if ($this->getRequest()->isXmlHttpRequest()) {
            return array(
                'form'  => $form->createView(),
                );

        } else if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $data = $form->getData();

                $usuario = $this->get('security.context')->getToken()->getUser();
                $mensaje = "De parte de " . $usuario->getNombre() . " " . $usuario->getApellido() . "\r\n";
                $mensaje .= "Asunto" . "\r\n" . $data['asunto'] . "\r\n" . "Mensaje:" . "\r\n" . $data['mensaje'];

                $message = \Swift_Message::newInstance()
                ->setSubject('Soporte TaxiAdmin')
                ->setFrom($usuario->getEmail())
                ->setTo('bviera@byg.com.uy')
                ->setBody($mensaje);

                $this->get('mailer')->send($message);
                $this->get('session')->getFlashBag()->add('msg_success', 'Se ha enviado el email a soporte, pronto estaremos en contacto.');

                return $this->redirect($request->headers->get('referer'));

            }
        }
    }

    /**
     *
     * @Route("/contacto", name="home_contacto")
     * @Method("POST")
     */
    public function contactoAction(Request $request) {


        $email = $request->request->get('email');
        $mensaje = "De parte de " . $email . "\r\n";
        $mensaje .= "Asunto" . "\r\n" . $request->request->get('asunto') . "\r\n" . "Mensaje:" . "\r\n" . $request->request->get('mensaje');

        $message = \Swift_Message::newInstance()
        ->setSubject('Soporte TaxiAdmin')
        ->setFrom($email)
        ->setTo('bviera@byg.com.uy')
        ->setBody($mensaje);

        $this->get('mailer')->send($message);

        $this->get('session')->getFlashBag()->add('msg_success', 'Gracias por contactar con TaxiAdmin, pronto responderemos a su solicitud.');

        return $this->redirect($this->generateUrl('sitio_home'));
    }

}