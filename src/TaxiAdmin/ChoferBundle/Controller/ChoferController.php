<?php

namespace TaxiAdmin\ChoferBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use TaxiAdmin\ChoferBundle\Entity\Chofer;
use TaxiAdmin\ChoferBundle\Form\ChoferType;

/**
 * Chofer controller.
 *
 * @Route("/chofer")
 */
class ChoferController extends Controller
{

    /**
     * Lists all Chofer entities.
     *
     * @Route("/", name="chofer")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TaxiAdminChoferBundle:Chofer')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Chofer entity.
     *
     * @Route("/", name="chofer_create")
     * @Method("POST")
     * @Template("TaxiAdminChoferBundle:Chofer:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Chofer();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('chofer_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Chofer entity.
    *
    * @param Chofer $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Chofer $entity)
    {
        $form = $this->createForm(new ChoferType(), $entity, array(
            'action' => $this->generateUrl('chofer_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Chofer entity.
     *
     * @Route("/new", name="chofer_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Chofer();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Chofer entity.
     *
     * @Route("/{id}", name="chofer_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TaxiAdminChoferBundle:Chofer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Chofer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Chofer entity.
     *
     * @Route("/{id}/edit", name="chofer_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TaxiAdminChoferBundle:Chofer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Chofer entity.');
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
    * Creates a form to edit a Chofer entity.
    *
    * @param Chofer $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Chofer $entity)
    {
        $form = $this->createForm(new ChoferType(), $entity, array(
            'action' => $this->generateUrl('chofer_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Chofer entity.
     *
     * @Route("/{id}", name="chofer_update")
     * @Method("PUT")
     * @Template("TaxiAdminChoferBundle:Chofer:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TaxiAdminChoferBundle:Chofer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Chofer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('chofer_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Chofer entity.
     *
     * @Route("/{id}", name="chofer_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TaxiAdminChoferBundle:Chofer')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Chofer entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('chofer'));
    }

    /**
     * Creates a form to delete a Chofer entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('chofer_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
