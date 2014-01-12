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
 * @Route("/usuario")
 */
class UsuarioController extends Controller {

    /**
     * Creates a new Usuario entity.
     *
     * @Route("/registrarse", name="usuario_create")
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
            $password = $this->encriptarClave($entity->getPassword(), $entity->getSalt());
            $entity->setPassword($password);

            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('msg_success', 'Felicidades eres el mas nuevo usuario de TaxiAdmin! Logueate y comienza a disfrutar.');
        } else {
            // echo $form->getErrorsAsString();
            //TODO Brus, Loguear los errores
            $this->get('session')->getFlashBag()->add('msg_error', 'Ups, estamos teniendo problemas para crear su usuario, por favor inténtelo mas tarde.');
        }
        return $this->redirect($this->generateUrl('sitio_home'));
    }

    

    /**
     * Show Usuario dashboard.
     *
     * @Route("/dashboard", name="usuario_dashboard")
     * @Method("GET")
     * @Template("")
     */
    public function dashboardAction(Request $request) { }


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
     *
     * @Route("/changePassword", name="changePassword")
     * @Method("POST|GET")
     * @Template("TaxiAdminUsuarioBundle:Usuario:changePassword.html.twig")
     */
    public function changePasswordAction(Request $request) { }


    /**
     * Finds and displays a Usuario entity.
     *
     * @Route("/perfil", name="perfil")
     * @Method("GET")
     * @Template("TaxiAdminUsuarioBundle:Usuario:perfil.html.twig")
     */
    public function perfilAction() {
        $usuario = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();

        return array( 'usuario' => $usuario );
    }

    /**
     * Edits an existing Usuario entity.
     *
     * @Route("/{id}", name="usuario_update")
     * @Method("PUT")
     * @Template("TaxiAdminUsuarioBundle:Usuario:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
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
    * Creates a form to create a Usuario entity.
    *
    * @param Usuario $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Usuario $entity) {
        $form = $this->createForm(new UsuarioType(), $entity, array(
            'action' => $this->generateUrl('usuario_create'),
            'method' => 'POST',
            ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }
    
    /**
    * Creates a form to edit a Usuario entity.
    *
    * @param Usuario $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Usuario $entity) {
        $form = $this->createForm(new UsuarioType(), $entity, array(
            'action' => $this->generateUrl('usuario_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    private function encriptarClave($pass, $salt){
        // codificamos la clave del usaurio
        $factory =  $this->get('security.encoder_factory');
        $codificador = $factory->getEncoder(new Usuario());
        return $codificador->encodePassword($pass, $salt);
    }

}
