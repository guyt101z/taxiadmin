<?php

namespace TaxiAdmin\ChoferBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use TaxiAdmin\ChoferBundle\Entity\Chofer;
use TaxiAdmin\ChoferBundle\Form\ChoferType;
use TaxiAdmin\ChoferBundle\Form\AdelantoType;
use TaxiAdmin\ChoferBundle\Entity\Adelanto;

/**
 * Chofer controller.
 *
 * @Route("/choferes")
 */
class ChoferController extends Controller {

    /**
     * Lists all Chofer entities.
     *
     * @Route("/", name="chofer")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $idUsuario = $this->get('security.context')->getToken()->getUser()->getId();
        $entities = $em->getRepository('TaxiAdminChoferBundle:Chofer')->findBy(array('idUsuario' => $idUsuario));
        return array(
            'form'     => $this->createCreateForm(new Chofer())->createView(),
            'entities' => $entities,
            );
    }

    /**
     * Creates a new Chofer entity.
     *
     * @Route("/", name="chofer_create")
     * @Method("POST")
     * @Template()
     */
    public function createAction(Request $request) {
        $entity = new Chofer();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $entity->setIdUsuario($this->get('security.context')->getToken()->getUser()->getId());
            $entity->setHabilitado(true);
            $entity->setFechaAlta(new \DateTime());

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('chofer_show', array('nombre' => $entity->getNombre(), 'apellido' => $entity->getApellido())));
        }
        //TODO Brus, loguear los errores
        $this->get('session')->getFlashBag()->add('msg_error', 'Ups, estamos teniendo problemas para crear su nuevo Chofer, por favor contacte con Soporte.');

        return $this->redirect($this->generateUrl('chofer'));
    }

    /**
     * Finds and displays a Chofer entity.
     *
     * @Route("/{nombre}/{apellido}", name="chofer_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($nombre, $apellido) {
        $em = $this->getDoctrine()->getManager();

        $idUsuario = $this->get('security.context')->getToken()->getUser()->getId();
        $chofer = $em->getRepository('TaxiAdminChoferBundle:Chofer')->findOneBy(array('nombre' => $nombre, 'apellido' => $apellido, 'idUsuario' => $idUsuario));

        if (!$chofer) {
            throw $this->createNotFoundException('Unable to find Chofer.');
        }

        $form = $this->createEditForm($chofer);
        $adelanto = new AdelantoController();
        $adelantoForm = $this->createForm(new AdelantoType(array(1 => $chofer)), new Adelanto(), array('action' => $this->generateUrl('adelanto_create'), 'method' => 'POST'));
        
        return array(
            'entity'        => $chofer,
            'form'          => $form->createView(),
            'adelantoForm'  => $adelantoForm->createView(),
            );
    }

    /**
     * Edits an existing Chofer entity.
     *
     * @Route("/{id}", name="chofer_update")
     * @Method("PUT")
     * @Template("TaxiAdminChoferBundle:Chofer:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $idUsuario = $this->get('security.context')->getToken()->getUser()->getId();
        $chofer = $em->getRepository('TaxiAdminChoferBundle:Chofer')->findOneBy(array( 'id' => $id, 'idUsuario' => $idUsuario));

        if (!$chofer) {
            throw $this->createNotFoundException('Unable to find Chofer entity.');
        }

        $editForm = $this->createEditForm($chofer);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add('msg_success', 'Chofer modificado con éxito.');
            return $this->redirect($this->generateUrl('chofer_show', array('nombre' => $chofer->getNombre(), 'apellido' => $chofer->getApellido())));
        }

        //TODO Brus, loguear los errores
        $this->get('session')->getFlashBag()->add('msg_error', 'Ups, estamos teniendo problemas para modificar su Chofer, por favor contacte con Soporte.');

        return $this->redirect($this->generateUrl('chofer'));
    }



    /**
    * Creates a form to edit a Chofer entity.
    *
    * @param Chofer $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Chofer $entity) {
        $form = $this->createForm(new ChoferType(), $entity, array(
            'action' => $this->generateUrl('chofer_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            ));

        return $form;
    }

    /**
    * Creates a form to create a Chofer entity.
    *
    * @param Chofer $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Chofer $entity) {
        $form = $this->createForm(new ChoferType(), $entity, array(
            'action' => $this->generateUrl('chofer_create'),
            'method' => 'POST',
            ));

        return $form;
    }
}
