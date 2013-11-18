<?php

namespace TaxiAdmin\SitioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('TaxiAdminSitioBundle:Default:index.html.twig', array('name' => $name));
    }
}
