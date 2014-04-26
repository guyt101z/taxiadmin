<?php

namespace TaxiAdmin\PropietarioBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use TaxiAdmin\PropietarioBundle\Entity\Propietario;
use TaxiAdmin\PropietarioBundle\Form\PropietarioType;

/**
 * Propietario controller.
 *
 * @Route("/propietarios")
 */
class PropietarioController extends Controller {

    /**
     * Lists all Propietario entities.
     *
     * @Route("/", name="propietario")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $idUsuario = $this->get('security.context')->getToken()->getUser()->getId();
        $entities = $em->getRepository('TaxiAdminPropietarioBundle:Propietario')->findBy(array('idUsuario' => $idUsuario));

        return array(
            'form'     => $this->createCreateForm(new Propietario())->createView(),
            'entities' => $entities,
            );
    }

    /**
     * Creates a new Propietario entity.
     *
     * @Route("/", name="propietario_create")
     * @Method("POST")
     * @Template()
     */
    public function createAction(Request $request) {
        $propietario = new Propietario();
        $form = $this->createCreateForm($propietario);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $propietario->setIdUsuario($this->get('security.context')->getToken()->getUser()->getId());
            $propietario->setHabilitado(true);
            $propietario->setFechaAlta(new \DateTime());

            $em->persist($propietario);
            $em->flush();

            return $this->redirect($this->generateUrl('propietario_show', array('nombre' => $propietario->getNombre(), 'apellido' => $propietario->getApellido())));
        }
        //TODO Brus, loguear los errores
        $this->get('session')->getFlashBag()->add('msg_error', 'Ups, estamos teniendo problemas para crear su Propietario, por favor contacte con Soporte.');

        return $this->redirect($this->generateUrl('propietario'));
    }

    /**
     * Finds and displays a Propietario entity.
     *
     * @Route("/{nombre}/{apellido}", name="propietario_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($nombre, $apellido) {
        $em = $this->getDoctrine()->getManager();

        $idUsuario = $this->get('security.context')->getToken()->getUser()->getId();
        $propietario = $em->getRepository('TaxiAdminPropietarioBundle:Propietario')->findOneBy(array('nombre' => $nombre, 'apellido' => $apellido, 'idUsuario' => $idUsuario));

        if (!$propietario) {
            throw $this->createNotFoundException('Unable to find Propietario.');
        }
        
        $form = $this->createEditForm($propietario);
        return array(
            'entity'   => $propietario,
            'form'     => $form->createView(),
            );
    }

    /**
     * Edits an existing Propietario entity.
     *
     * @Route("/{id}", name="propietario_update")
     * @Method("PUT")
     * @Template("")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $idUsuario = $this->get('security.context')->getToken()->getUser()->getId();
        $propietario = $em->getRepository('TaxiAdminPropietarioBundle:Propietario')->findOneBy(array( 'id' => $id, 'idUsuario' => $idUsuario));

        if (!$propietario) {
            throw $this->createNotFoundException('Unable to find Propietario entity.');
        }

        $editForm = $this->createEditForm($propietario);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add('msg_success', 'Propietario modificado con éxito.');
            return $this->redirect($this->generateUrl('propietario_show', array('nombre' => $propietario->getNombre(), 'apellido' => $propietario->getApellido())));
        }

        //TODO Brus, loguear los errores
        $this->get('session')->getFlashBag()->add('msg_error', 'Ups, estamos teniendo problemas para modificar su Propietario, por favor contacte con Soporte.');

        return $this->redirect($this->generateUrl('propietario'));
    }


    /**
    * Creates a form to create a Propietario entity.
    *
    * @param Propietario $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Propietario $entity) {
        $form = $this->createForm(new PropietarioType(), $entity, array(
            'action' => $this->generateUrl('propietario_create'),
            'method' => 'POST',
            ));

        return $form;
    }

    /**
    * Creates a form to edit a Propietario entity.
    *
    * @param Propietario $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Propietario $entity) {
        $form = $this->createForm(new PropietarioType(), $entity, array(
            'action' => $this->generateUrl('propietario_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            ));

        return $form;
    }
    
}
