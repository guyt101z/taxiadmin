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
     * Show the homepage 
     *
     * @Route("/", name="login_check")
     * @Method("POST")
     * @Template("")
     */
	// public function homeAction() {
	// 	$form = $this->createForm(new UsuarioType(), new Usuario);
	// 	return array(
	// 			'formUsuario'   => $form->createView(),
	// 		);
	// }

	/**
     * Show Usuario dashboard.
     *
     * @Route("/", name="sitio_home")
     * @Method("GET")
     * @Template("TaxiAdminSitioBundle:Sitio:home.html.twig")
     */
    public function homeAction() {
        $request = $this->getRequest();
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
                );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

		return array(
				'formUsuario'   => $this->createForm(new UsuarioType(), new Usuario)->createView(),
				'last_username' => $session->get(SecurityContext::LAST_USERNAME),
				'error'         => $error,
			);
    }
	
}