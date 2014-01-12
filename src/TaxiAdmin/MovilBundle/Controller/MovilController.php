<?php

namespace TaxiAdmin\MovilBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use TaxiAdmin\MovilBundle\Entity\Movil;
use TaxiAdmin\MovilBundle\Form\MovilType;

/**
 * Movil controller.
 *
 * @Route("/moviles")
 */
class MovilController extends Controller {

    /**
     * Lists all Movil entities.
     *
     * @Route("/", name="movil")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $idUsuario = $this->get('security.context')->getToken()->getUser()->getId();
        $moviles = $em->getRepository('TaxiAdminMovilBundle:Movil')->findBy(array('idUsuario' => $idUsuario));
        $empresas = $em->getRepository('TaxiAdminEmpresaBundle:Empresa')->findBy(array('idUsuario' => $idUsuario));
        
        return array(
            'form'     => $this->createCreateForm(new Movil(), $empresas)->createView(),
            'entities' => $moviles,
            );
    }
    /**
     * Creates a new Movil entity.
     *
     * @Route("/", name="movil_create")
     * @Method("POST")
     * @Template()
     */
    public function createAction(Request $request) {
        $entity = new Movil();
        $form = $this->createCreateForm($entity, null);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $entity->setIdUsuario($this->get('security.context')->getToken()->getUser()->getId());
            $entity->setHabilitado(true);
            $entity->setFechaAlta(new \DateTime());
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('movil_show', array('matricula' => $entity->getMatricula())));
        }
        //TODO Brus, loguear los errores
        $this->get('session')->getFlashBag()->add('msg_error', 'Ups, estamos teniendo problemas para crear su nuevo Móvil, por favor contacte con Soporte.');

        return $this->redirect($this->generateUrl('movil'));
    }

    /**
     * Finds and displays a Movil entity.
     *
     * @Route("/{matricula}", name="movil_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($matricula) {
        $em = $this->getDoctrine()->getManager();

        $idUsuario = $this->get('security.context')->getToken()->getUser()->getId();
        $movil = $em->getRepository('TaxiAdminMovilBundle:Movil')->findOneBy(array('matricula' => $matricula, 'idUsuario' => $idUsuario));

        if (!$movil) {
            throw $this->createNotFoundException('Unable to find Movil movil.');
        }
        
        $empresas = $em->getRepository('TaxiAdminEmpresaBundle:Empresa')->findBy(array('idUsuario' => $idUsuario));
        $form = $this->createEditForm($movil, $empresas);

        return array(
            'entity'      => $movil,
            'form' => $form->createView(),
            );
    }

    /**
     * Edits an existing Movil entity.
     *
     * @Route("/{id}", name="movil_update")
     * @Method("PUT")
     * @Template("TaxiAdminMovilBundle:Movil:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $idUsuario = $this->get('security.context')->getToken()->getUser()->getId();
        $movil = $em->getRepository('TaxiAdminMovilBundle:Movil')->findOneBy(array( 'id' => $id, 'idUsuario' => $idUsuario));

        if (!$movil) {
            throw $this->createNotFoundException('Unable to find movil entity.');
        }

        $editForm = $this->createEditForm($movil, null);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add('msg_success', 'Móvil modificado con éxito.');
            return $this->redirect($this->generateUrl('movil_show', array('matricula' => $movil->getMatricula())));
        }

        //TODO Brus, loguear los errores
        $this->get('session')->getFlashBag()->add('msg_error', 'Ups, estamos teniendo problemas para modificar su Móvil, por favor contacte con Soporte.');

        return $this->redirect($this->generateUrl('movil'));
    }

    /**
    * Creates a form to create a Movil entity.
    *
    * @param Movil $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Movil $entity, $empresas) {
        $form = $this->createForm(new MovilType($empresas), $entity, array(
            'action' => $this->generateUrl('movil_create'),
            'method' => 'POST',
            ));

        return $form;
    }

    /**
    * Creates a form to edit a Movil entity.
    *
    * @param Movil $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Movil $entity, $empresas) {
        $form = $this->createForm(new MovilType($empresas), $entity, array(
            'action' => $this->generateUrl('movil_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            ));

        return $form;
    }   
}
