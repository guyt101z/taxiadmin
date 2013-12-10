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
 * @Route("/empresas")
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
            'form'     => $this->createCreateForm(new Empresa())->createView(),
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

            return $this->redirect($this->generateUrl('empresa_show', array('razonSocial' => $empresa->getRazonSocial())));
        }
        //TODO Brus, loguear los errores
        $this->get('session')->getFlashBag()->add('msg_error', 'Ups, estamos teniendo problemas para crear su Empresa, por favor contacte con Soporte.');

        return $this->redirect($this->generateUrl('empresa'));
    }

    /**
     * Edits an existing Empresa entity.
     *
     * @Route("/{id}", requirements={"id" = "\d+"}, name="empresa_update")
     * @Method("PUT")
     * @Template("")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $idUsuario = $this->get('security.context')->getToken()->getUser()->getId();
        $entity = $em->getRepository('TaxiAdminEmpresaBundle:Empresa')->findOneBy(array('id' => $id, 'idUsuario' => $idUsuario));

        if (!$entity) {
            $this->get('session')->getFlashBag()->add('msg_error', 'Ups, no hemos encontrado la Empresa solicitada. Update');
            return $this->redirect($this->generateUrl('empresa'));
        }

        $form = $this->createEditForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();
            
            return $this->redirect($this->generateUrl('empresa_show', array('razonSocial' => $entity->getRazonSocial())));
        }

        //TODO Brus, loguear el error del formulario
        $this->get('session')->getFlashBag()->add('msg_error', 'Ups, no hemos podido modificar la Empresa solicitada. Update2');
        // return $this->redirect($this->generateUrl('empresa'));
    }

    /**
     * Finds and displays a Empresa entity.
     *
     * @Route("/show/{razonSocial}", name="empresa_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($razonSocial) {

        $em = $this->getDoctrine()->getManager();

        $idUsuario = $this->get('security.context')->getToken()->getUser()->getId();
        $entity = $em->getRepository('TaxiAdminEmpresaBundle:Empresa')->findOneBy(array('razonSocial' => $razonSocial, 'idUsuario' => $idUsuario));

        if (!$entity) {
            $this->get('session')->getFlashBag()->add('msg_error', 'Ups, no hemos encontrado la Empresa solicitada.');
            return $this->redirect($this->generateUrl('empresa'));
        }

        $form = $this->createEditForm($entity);
        return array(
            'form' => $form->createView(),
            'entity' => $entity,
            );
    }

    /**
     * Creates a new Empresa entity.
     *
     * @Route("/add_propietario", name="empresa_add_propietario")
     * @Method("GET")
     * @Template("TaxiAdminEmpresaBundle:Empresa:_addPropietario.html.twig")
     */
    public function addPropietarioAction(Request $request) {

        if ($this->getRequest()->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getEntityManager();
            $idUsuario = $this->get('security.context')->getToken()->getUser()->getId();
            $data = $em->getRepository('TaxiAdminPropietarioBundle:Propietario')->getPropietariosByUsuario($idUsuario);
            return array(
                'propietarios' => $data,
                );
            return new Response(json_encode(array('propietarios' => $data)));
        } else if ($request->isMethod('POST')) {

            $this->get('session')->getFlashBag()->add('msg_succes', 'Se ha agregado el nuevo Propietario a la Empresa.');
        }
    }

    /**
    * Creates a form to create a Empresa entity.
    *
    * @param Empresa $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Empresa $entity) {
        $form = $this->createForm(new EmpresaType(), $entity, array(
            'action' => $this->generateUrl('empresa_create'),
            'method' => 'POST',
            ));

        return $form;
    }

    /**
    * Creates a form to edit a Empresa entity.
    *
    * @param Empresa $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Empresa $entity) {
        $form = $this->createForm(new EmpresaType(), $entity, array(
            'action' => $this->generateUrl('empresa_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            ));

        return $form;
    }

}
