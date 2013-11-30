<?php

namespace TaxiAdmin\EmpresaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use TaxiAdmin\EmpresaBundle\Entity\Empresa;
use TaxiAdmin\EmpresaBundle\Form\EmpresaType;

/**
 * Empresa controller.
 *
 * @Route("/empresa")
 */
class EmpresaController extends Controller {

    /**
     * Lists all Empresa entities for Usuario.
     *
     * @Route("/", name="empresa")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $idUsuario = $this->get('security.context')->getToken()->getUser()->getId();
        $entities = $em->getRepository('TaxiAdminEmpresaBundle:Empresa')->findBy(array('idUsuario' => $idUsuario));

        return array(
            'form'     => $this->createForm(new EmpresaType(), new Empresa)->createView(),
            'entities' => $entities,
            );
    }


    /**
     * Creates a new Empresa entity.
     *
     * @Route("/", name="empresa_create")
     * @Method("POST")
     * @Template("TaxiAdminEmpresaBundle:Empresa:new.html.twig")
     */
    public function createAction(Request $request) {
        $empresa = new Empresa();
        $form = $this->createForm(new EmpresaType(), $empresa);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $empresa->setIdUsuario($this->get('security.context')->getToken()->getUser()->getId());
            $empresa->setHabilitado(true);
            $empresa->setFechaAlta(new \DateTime());

            $em->persist($empresa);
            $em->flush();

            return $this->redirect($this->generateUrl('empresa_show', array('id' => $empresa->getId())));
        }
        //TODO Brus, loguear los errores
        $this->get('session')->getFlashBag()->add('msg_error', 'Ups, estamos teniendo problemas para crear su Empresa, por favor contacte con Soporte.');

        return $this->redirect($this->generateUrl('empresa'));
    }

    /**
     * Finds and displays a Empresa entity.
     *
     * @Route("/{id}", name="empresa_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {

        $em = $this->getDoctrine()->getManager();
        $idUsuario = $this->get('security.context')->getToken()->getUser()->getId();
        $entity = $em->getRepository('TaxiAdminEmpresaBundle:Empresa')->findBy(array('id' => $id, 'idUsuario' => $idUsuario));

        if (!$entity) {
            $this->get('session')->getFlashBag()->add('msg_error', 'Ups, no hemos encontrado la Empresa solicitada.');
            return $this->redirect($this->generateUrl('empresa'));
        }

        return array(
            'entity' => $entity,
            );
    }

    /**
     * Displays a form to edit an existing Empresa entity.
     *
     * @Route("/{id}/edit", name="empresa_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $idUsuario = $this->get('security.context')->getToken()->getUser()->getId();
        $entity = $em->getRepository('TaxiAdminEmpresaBundle:Empresa')->findBy(array('id' => $id, 'idUsuario' => $idUsuario));

        if (!$entity) {
            $this->get('session')->getFlashBag()->add('msg_error', 'Ups, no hemos encontrado la Empresa solicitada.');
            return $this->redirect($this->generateUrl('empresa'));
        }

        return array(
            'form' => $this->createForm(new EmpresaType(), $entity)->createView(),
            );
    }

    /**
     * Edits an existing Empresa entity.
     *
     * @Route("/{id}", name="empresa_update")
     * @Method("PUT")
     * @Template("")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $idUsuario = $this->get('security.context')->getToken()->getUser()->getId();
        $entity = $em->getRepository('TaxiAdminEmpresaBundle:Empresa')->findBy(array('id' => $id, 'idUsuario' => $idUsuario));

        if (!$entity) {
            $this->get('session')->getFlashBag()->add('msg_error', 'Ups, no hemos encontrado la Empresa solicitada.');
            return $this->redirect($this->generateUrl('empresa'));
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            
            $this->get('session')->getFlashBag()->add('msg_success', 'La Empresa fue modificada correctamente.');
            return $this->redirect($this->generateUrl('empresa_show', array('id' => $id)));
        } 

        //TODO Brus, loguear el error del formulario
        $this->get('session')->getFlashBag()->add('msg_error', 'Ups, no hemos podido modificar la Empresa solicitada.');
        return $this->redirect($this->generateUrl('empresa'));
    }

}
