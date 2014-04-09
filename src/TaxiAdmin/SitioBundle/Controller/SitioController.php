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
     * @Method("GET")
     */
    public function soporteAction() {
        $message = \Swift_Message::newInstance()
        ->setSubject('Hello Email')
        ->setFrom('taxiadmin@byg.com.uy')
        ->setTo('brunovierag@gmail.com')
        ->setBody('Hello Brus')
        ;
        $this->get('mailer')->send($message);

        return null;

    }

}