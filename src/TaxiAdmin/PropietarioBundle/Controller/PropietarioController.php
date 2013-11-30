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
 * @Route("/propietario")
 */
class PropietarioController extends Controller
{

    /**
     * Lists all Propietario entities.
     *
     * @Route("/", name="propietario")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TaxiAdminPropietarioBundle:Propietario')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Propietario entity.
     *
     * @Route("/", name="propietario_create")
     * @Method("POST")
     * @Template("TaxiAdminPropietarioBundle:Propietario:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Propietario();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('propietario_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Propietario entity.
    *
    * @param Propietario $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Propietario $entity)
    {
        $form = $this->createForm(new PropietarioType(), $entity, array(
            'action' => $this->generateUrl('propietario_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Propietario entity.
     *
     * @Route("/new", name="propietario_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Propietario();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Propietario entity.
     *
     * @Route("/{id}", name="propietario_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TaxiAdminPropietarioBundle:Propietario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Propietario entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Propietario entity.
     *
     * @Route("/{id}/edit", name="propietario_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TaxiAdminPropietarioBundle:Propietario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Propietario entity.');
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
    * Creates a form to edit a Propietario entity.
    *
    * @param Propietario $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Propietario $entity)
    {
        $form = $this->createForm(new PropietarioType(), $entity, array(
            'action' => $this->generateUrl('propietario_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Propietario entity.
     *
     * @Route("/{id}", name="propietario_update")
     * @Method("PUT")
     * @Template("TaxiAdminPropietarioBundle:Propietario:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TaxiAdminPropietarioBundle:Propietario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Propietario entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('propietario_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Propietario entity.
     *
     * @Route("/{id}", name="propietario_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TaxiAdminPropietarioBundle:Propietario')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Propietario entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('propietario'));
    }

    /**
     * Creates a form to delete a Propietario entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('propietario_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
