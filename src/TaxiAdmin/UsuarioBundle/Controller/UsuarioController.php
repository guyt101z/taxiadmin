<?php

namespace TaxiAdmin\UsuarioBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use TaxiAdmin\UsuarioBundle\Entity\Usuario;
use TaxiAdmin\UsuarioBundle\Form\UsuarioType;

/**
 * Usuario controller.
 *
 * @Route("/")
 */
class UsuarioController extends Controller {

    /**
     * Creates a new Usuario entity.
     *
     * @Route("/usuario/create", name="usuario_create")
     * @Method("POST")
     * @Template("TaxiAdminUsuarioBundle:Usuario:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Usuario();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $entity->setFechaAlta(new \DateTime());
            $entity->setHabilitado(true);
            $entity->setRol($this->container->getParameter('rol_admin'));

            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('msg_success', 'Felicidades eres el mas nuevo usuario de TaxiAdmin! Logueate y comienza a disfrutar.');
        }

        foreach ($form->getErrors() as $key => $value) {
            echo $key . '<br>';
            echo $value;
        }
            
        return $this->redirect($this->generateUrl('sitio_home'));
    }

    /**
    * Creates a form to create a Usuario entity.
    *
    * @param Usuario $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Usuario $entity)
    {
        $form = $this->createForm(new UsuarioType(), $entity, array(
            'action' => $this->generateUrl('usuario_create'),
            'method' => 'POST',
            ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Show Usuario dashboard.
     *
     * @Route("/dashboard", name="usuario_dashboard")
     * @Method("GET")
     * @Template("TaxiAdminUsuarioBundle:Usuario:dashboard.html.twig")
     */
    public function dashboardAction(Request $request) {

    }


    /**
     * Show Usuario dashboard.
     *
     * @Route("/logout", name="usuario_logout")
     * @Method("GET")
     */
    public function logoutAction(Request $request) {
        return $this->redirect($this->generateUrl('sitio_home'));
    }

















    /**
     * Finds and displays a Usuario entity.
     *
     * @Route("/{id}", name="usuario_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TaxiAdminUsuarioBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuario entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            );
    }

    /**
     * Displays a form to edit an existing Usuario entity.
     *
     * @Route("/{id}/edit", name="usuario_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TaxiAdminUsuarioBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuario entity.');
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
    * Creates a form to edit a Usuario entity.
    *
    * @param Usuario $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Usuario $entity)
    {
        $form = $this->createForm(new UsuarioType(), $entity, array(
            'action' => $this->generateUrl('usuario_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Usuario entity.
     *
     * @Route("/{id}", name="usuario_update")
     * @Method("PUT")
     * @Template("TaxiAdminUsuarioBundle:Usuario:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TaxiAdminUsuarioBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuario entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('usuario_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            );
    }
    /**
     * Deletes a Usuario entity.
     *
     * @Route("/{id}", name="usuario_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TaxiAdminUsuarioBundle:Usuario')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Usuario entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('usuario'));
    }

    /**
     * Creates a form to delete a Usuario entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
        ->setAction($this->generateUrl('usuario_delete', array('id' => $id)))
        ->setMethod('DELETE')
        ->add('submit', 'submit', array('label' => 'Delete'))
        ->getForm()
        ;
    }
}
