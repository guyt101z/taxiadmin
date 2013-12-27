<?php

namespace TaxiAdmin\ChoferBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use TaxiAdmin\ChoferBundle\Entity\Adelanto;
use TaxiAdmin\ChoferBundle\Form\AdelantoType;

/**
 * Adelanto controller.
 *
 * @Route("/adelanto")
 */
class AdelantoController extends Controller {

    /**
     * Creates a new Adelanto entity.
     *
     * @Route("/", name="adelanto_create")
     * @Method("POST")
     * @Template("")
     */
    public function createAction(Request $request) {
        $entity = new Adelanto();
        $form = $this->createCreateForm($entity, null);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('chofer_show', array('nombre' => $entity->getChofer()->getNombre(), 'apellido' => $entity->getChofer()->getApellido())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Adelanto entity.
    *
    * @param Adelanto $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Adelanto $entity, $choferes) {
        $form = $this->createForm(new AdelantoType($choferes), $entity, array(
            'action' => $this->generateUrl('adelanto_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Finds and displays a Adelanto entity.
     *
     * @Route("/{id}", name="adelanto_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TaxiAdminChoferBundle:Adelanto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Adelanto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Adelanto entity.
    *
    * @param Adelanto $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Adelanto $entity) {
        $form = $this->createForm(new AdelantoType(), $entity, array(
            'action' => $this->generateUrl('adelanto_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Adelanto entity.
     *
     * @Route("/{id}", name="adelanto_update")
     * @Method("PUT")
     * @Template("TaxiAdminChoferBundle:Adelanto:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TaxiAdminChoferBundle:Adelanto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Adelanto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('adelanto_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
}
