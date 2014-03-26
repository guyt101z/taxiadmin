<?php

namespace TaxiAdmin\GastoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use TaxiAdmin\GastoBundle\Entity\Gasto;
use TaxiAdmin\GastoBundle\Form\GastoType;

/**
 * Gasto controller.
 *
 * @Route("/gasto")
 */
class GastoController extends Controller {

    // /**
    //  * Creates a new Gasto entity.
    //  *
    //  * @Route("/empresa/{empresa}/movil/{movil}", name="gasto_create", defaults={ "empresa" = 0, "movil" = 0 })
    //  * @Method("POST|GET")
    //  * @Template("TaxiAdminMovilBundle:Gasto:new.html.twig")
    //  */
    // public function createAction(Request $request, $empresa, $movil) {
    //     $em = $this->getDoctrine()->getManager();

    //     $entity = new Gasto();
    //     $idUsuario = $this->get('security.context')->getToken()->getUser()->getId();
    //     $empresas = null;
    //     $moviles  = null;

    //     if ($empresa == 0 && $movil == 0) {
    //             # busco todos las empresas y todos los moviles
    //         $moviles  = $em->getRepository('TaxiAdminMovilBundle:Movil')->findBy(array('idUsuario' => $idUsuario));
    //         $choferes = $em->getRepository('TaxiAdminEmpresaBundle:Empresa')->findBy(array('idUsuario' => $idUsuario));

    //     } elseif ($empresa > 0 && $movil == 0) {
    //             # busco la empresa
    //         $empresa   = $em->getRepository('TaxiAdminEmpresaBundle:Empresa')->findOneBy(array('idUsuario' => $idUsuario, 'id' => $empresa));
    //         $empresas = array($empresa);

    //     } elseif ($empresa == 0 && $movil > 0) {
    //             # busco un movil
    //         $movil   = $em->getRepository('TaxiAdminMovilBundle:Movil')->findOneBy(array('idUsuario' => $idUsuario, 'id' => $movil));
    //         $moviles = array($movil);
    //     }

    //     if ($this->getRequest()->isXmlHttpRequest()) {

    //         $form = $this->createCreateForm($entity, $empresas, $moviles, $empresa, $movil);

    //         return array( 'form'  => $form->createView() );

    //     } else if ($request->isMethod('POST')) {
    //         $form = $this->createCreateForm($entity, $empresas, $moviles, $empresa, $movil);
    //         $form->handleRequest($request);

    //         if ($form->isValid()) {

    //             $em->persist($entity);
    //             $em->flush();

    //             $this->get('session')->getFlashBag()->add('msg_success', 'Se ha agregado el gasto.');

    //             return $this->redirect($this->getRedirect($idChofer, $idMovil, $entity));
    //         } else {
    //             // echo $form->getErrorsAsString();
    //             foreach ($form->getErrors() as $error) {
    //                 $message = $this->container->get('translator')->trans($error->getMessage(), array(), 'validators');
    //                 echo $message;
    //             }
    //         }
    //     }
    // }

    // /**
    //  * Finds and displays a Gasto entity.
    //  *
    //  * @Route("/{id}", name="gasto_show")
    //  * @Method("GET")
    //  * @Template()
    //  */
    // public function showAction($id) {
    //     $em = $this->getDoctrine()->getManager();

    //     $entity = $em->getRepository('TaxiAdminMovilBundle:Gasto')->find($id);

    //     if (!$entity) {
    //         throw $this->createNotFoundException('Unable to find Gasto entity.');
    //     }

    //     $deleteForm = $this->createDeleteForm($id);

    //     return array(
    //         'entity'      => $entity,
    //         'delete_form' => $deleteForm->createView(),
    //         );
    // }

    // /**
    //  * Edits an existing Gasto entity.
    //  *
    //  * @Route("/{id}", name="gasto_update")
    //  * @Method("PUT")
    //  * @Template("TaxiAdminMovilBundle:Gasto:edit.html.twig")
    //  */
    // public function updateAction(Request $request, $id) {
    //     $em = $this->getDoctrine()->getManager();

    //     $entity = $em->getRepository('TaxiAdminMovilBundle:Gasto')->find($id);

    //     if (!$entity) {
    //         throw $this->createNotFoundException('Unable to find Gasto entity.');
    //     }

    //     $deleteForm = $this->createDeleteForm($id);
    //     $editForm = $this->createEditForm($entity);
    //     $editForm->handleRequest($request);

    //     if ($editForm->isValid()) {
    //         $em->flush();

    //         return $this->redirect($this->generateUrl('gasto_edit', array('id' => $id)));
    //     }

    //     return array(
    //         'entity'      => $entity,
    //         'edit_form'   => $editForm->createView(),
    //         'delete_form' => $deleteForm->createView(),
    //         );
    // }

    // /**
    //  * Deletes a Gasto entity.
    //  *
    //  * @Route("/{id}", name="gasto_delete")
    //  * @Method("DELETE")
    //  */
    // public function deleteAction(Request $request, $id) {
    //     $form = $this->createDeleteForm($id);
    //     $form->handleRequest($request);

    //     if ($form->isValid()) {
    //         $em = $this->getDoctrine()->getManager();
    //         $entity = $em->getRepository('TaxiAdminMovilBundle:Gasto')->find($id);

    //         if (!$entity) {
    //             throw $this->createNotFoundException('Unable to find Gasto entity.');
    //         }

    //         $em->remove($entity);
    //         $em->flush();
    //     }

    //     return $this->redirect($this->generateUrl('gasto'));
    // }

    // private function getRedirect($empresa, $movil, $entity){
    //     if ($empresa == 0 && $movil == 0) {
    //         # no tiene id ninguno viene desde el dashboard
    //         return $this->generateUrl('usuario_dashboard');
    //     } elseif ($empresa > 0 && $movil == 0) {
    //         # tiene empresa, redirecciono a la pagina de la empresa
    //         return $this->generateUrl('empresa_show', array('razonSocial' => $entity->getEmpresa()->getRazonSocial()));
    //     } elseif ($empresa == 0 && $movil > 0) {
    //         # tiene idMovil, redirecciono a la pagina del movil
    //         return $this->generateUrl('movil_show', array('matricula' => $entity->getMovil()->getMatricula()));
    //     }
    // }

    // /**
    // * Creates a form to create a Gasto entity.
    // *
    // * @param Gasto $entity The entity
    // *
    // * @return \Symfony\Component\Form\Form The form
    // */
    // private function createCreateForm(Gasto $entity, $empresas, $moviles, $empresa, $movil) {
    //     $form = $this->createForm(new GastoType($empresas, $moviles), $entity, array(
    //         'action' => $this->generateUrl('gasto_create', array('empresa' => $empresa, 'movil' => $movil)),
    //         'method' => 'POST',
    //         ));

    //     $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array('class' => 'btn btn-default')));

    //     return $form;
    // }

    // /**
    // * Creates a form to edit a Gasto entity.
    // *
    // * @param Gasto $entity The entity
    // *
    // * @return \Symfony\Component\Form\Form The form
    // */
    // private function createEditForm(Gasto $entity) {
    //     $form = $this->createForm(new GastoType(), $entity, array(
    //         'action' => $this->generateUrl('gasto_update', array('id' => $entity->getId())),
    //         'method' => 'PUT',
    //         ));

    //     $form->add('submit', 'submit', array('label' => 'Update'));

    //     return $form;
    // }

    // /**
    //  * Creates a form to delete a Gasto entity by id.
    //  *
    //  * @param mixed $id The entity id
    //  *
    //  * @return \Symfony\Component\Form\Form The form
    //  */
    // private function createDeleteForm($id) {
    //     return $this->createFormBuilder()
    //     ->setAction($this->generateUrl('gasto_delete', array('id' => $id)))
    //     ->setMethod('DELETE')
    //     ->add('submit', 'submit', array('label' => 'Delete'))
    //     ->getForm()
    //     ;
    // }
}
