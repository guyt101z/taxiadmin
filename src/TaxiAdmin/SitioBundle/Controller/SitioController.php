<?php

namespace TaxiAdmin\SitioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SitioController extends Controller {

	public function homeAction() {
		return $this->render('TaxiAdminSitioBundle:Sitio:home.html.twig');
	}
	
}