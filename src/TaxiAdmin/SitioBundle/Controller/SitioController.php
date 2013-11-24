<?php

namespace TaxiAdmin\SitioBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/", name="siti_ohome")
     * @Method("GET")
     * @Template("")
     */
	public function homeAction() {
		$form = $this->createForm(new UsuarioType(), new Usuario);
		return array(
				'formUsuario'   => $form->createView(),
			);
	}
	
}