<?php

namespace TaxiAdmin\MovilBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use TaxiAdmin\MovilBundle\Entity\Mantenimiento;
use TaxiAdmin\MovilBundle\Form\MantenimientoType;

/**
 * Mantenimiento controller.
 *
 * @Route("/mantenimiento")
 */
class MantenimientoController extends Controller {

    /**
     * Creates a new Mantenimiento entity.
     *
     * @Route("/movil/{idMovil}", name="mantenimiento_create", defaults={"idMovil" = 0 })
     * @Method("POST|GET")
     * @Template("TaxiAdminMovilBundle:Mantenimiento:new.html.twig")
     */
    public function createAction(Request $request, $idMovil) {
        $em = $this->getDoctrine()->getManager();

        $entity = new Mantenimiento();
        $idUsuario = $this->get('security.context')->getToken()->getUser()->getId();

        if ($this->getRequest()->isXmlHttpRequest()) {
            $entity->setFechaIngreso(new \DateTime());
            if ($idMovil != 0 ) {
                $movil   = $em->getRepository('TaxiAdminMovilBundle:Movil')->findOneBy(array('idUsuario' => $idUsuario, 'id' => $idMovil));
                $moviles = array($movil);
            } else {
                $moviles = $em->getRepository('TaxiAdminMovilBundle:Movil')->findBy(array('idUsuario' => $idUsuario));
            }
            
            $form = $this->createCreateForm($entity, $moviles, $idMovil);

            return array( 'form'  => $form->createView());

        } else if ($request->isMethod('POST')) {
            $form = $this->createCreateForm($entity, null, $idMovil);
            $form->handleRequest($request);

            if ($form->isValid()) {

                $em->persist($entity);
                $em->flush();

                $this->get('session')->getFlashBag()->add('msg_success', 'Se ha agregado el mantenimiento.');

                return $this->redirect($this->generateUrl('movil_show', array('matricula' => $entity->getMovil()->getMatricula())));

            }
        }
    }

    /**
    * Creates a form to create a Mantenimiento entity.
    *
    * @param Mantenimiento $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Mantenimiento $entity, $moviles, $idMovil) {
        $form = $this->createForm(new MantenimientoType($moviles), $entity, array(
            'action' => $this->generateUrl('mantenimiento_create', array('idMovil' => $idMovil)),
            'method' => 'POST',
            ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array('class' => 'btn btn-default')));

        return $form;
    }

    /**
     * Displays a form to create a new Mantenimiento entity.
     *
     * @Route("/new", name="mantenimiento_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction() {
      $entity = new Mantenimiento();
      $form   = $this->createCreateForm($entity);

      return array(
        'entity' => $entity,
        'form'   => $form->createView(),
        );
  }

    /**
     * Finds and displays a Mantenimiento entity.
     *
     * @Route("/{id}", name="mantenimiento_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
      $em = $this->getDoctrine()->getManager();

      $entity = $em->getRepository('TaxiAdminMovilBundle:Mantenimiento')->find($id);

      if (!$entity) {
        throw $this->createNotFoundException('Unable to find Mantenimiento entity.');
    }

    $deleteForm = $this->createDeleteForm($id);

    return array(
        'entity'      => $entity,
        'delete_form' => $deleteForm->createView(),
        );
}

    /**
     * Displays a form to edit an existing Mantenimiento entity.
     *
     * @Route("/{id}/edit", name="mantenimiento_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
      $em = $this->getDoctrine()->getManager();

      $entity = $em->getRepository('TaxiAdminMovilBundle:Mantenimiento')->find($id);

      if (!$entity) {
        throw $this->createNotFoundException('Unable to find Mantenimiento entity.');
    }

    $editForm = $this->createEditForm($entity);
    $deleteForm = $this->createDeleteForm($id);

    return array(
        'entity'      => $entity,
        'edit_form'   => $editForm->createView(),
        'delete_form' => $deleteForm->createView(),
        );
}

    /**
    * Creates a form to edit a Mantenimiento entity.
    *
    * @param Mantenimiento $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Mantenimiento $entity) {
      $form = $this->createForm(new MantenimientoType(), $entity, array(
        'action' => $this->generateUrl('mantenimiento_update', array('id' => $entity->getId())),
        'method' => 'PUT',
        ));

      $form->add('submit', 'submit', array('label' => 'Update'));

      return $form;
  }

    /**
     * Edits an existing Mantenimiento entity.
     *
     * @Route("/{id}", name="mantenimiento_update")
     * @Method("PUT")
     * @Template("TaxiAdminMovilBundle:Mantenimiento:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
      $em = $this->getDoctrine()->getManager();

      $entity = $em->getRepository('TaxiAdminMovilBundle:Mantenimiento')->find($id);

      if (!$entity) {
        throw $this->createNotFoundException('Unable to find Mantenimiento entity.');
    }

    $deleteForm = $this->createDeleteForm($id);
    $editForm = $this->createEditForm($entity);
    $editForm->handleRequest($request);

    if ($editForm->isValid()) {
        $em->flush();

        return $this->redirect($this->generateUrl('mantenimiento_edit', array('id' => $id)));
    }

    return array(
        'entity'      => $entity,
        'edit_form'   => $editForm->createView(),
        'delete_form' => $deleteForm->createView(),
        );
}

    /**
     * Deletes a Mantenimiento entity.
     *
     * @Route("/{id}", name="mantenimiento_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
      $form = $this->createDeleteForm($id);
      $form->handleRequest($request);

      if ($form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('TaxiAdminMovilBundle:Mantenimiento')->find($id);

        if (!$entity) {
          throw $this->createNotFoundException('Unable to find Mantenimiento entity.');
      }

      $em->remove($entity);
      $em->flush();
  }

  return $this->redirect($this->generateUrl('mantenimiento'));
}

    /**
     * Creates a form to delete a Mantenimiento entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
      return $this->createFormBuilder()
      ->setAction($this->generateUrl('mantenimiento_delete', array('id' => $id)))
      ->setMethod('DELETE')
      ->add('submit', 'submit', array('label' => 'Delete'))
      ->getForm()
      ;
  }
}
