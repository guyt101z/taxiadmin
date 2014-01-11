<?php

namespace TaxiAdmin\ChoferBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use TaxiAdmin\ChoferBundle\Entity\Multa;
use TaxiAdmin\ChoferBundle\Form\MultaType;

/**
 * Multa controller.
 *
 * @Route("/multa")
 */
class MultaController extends Controller {

    /**
     * Creates a new Multa entity.
     *
     * @Route("/chofer/{idChofer}/movil/{idMovil}", name="multa_create", defaults={ "idChofer" = 0, "idMovil" = 0 })
     * @Method("POST|GET")
     * @Template("TaxiAdminChoferBundle:Multa:new.html.twig")
     */
    public function createAction(Request $request, $idChofer, $idMovil) {
        $em = $this->getDoctrine()->getManager();

        $entity = new Multa();
        $idUsuario = $this->get('security.context')->getToken()->getUser()->getId();

        if ($this->getRequest()->isXmlHttpRequest()) {
            $entity->setFecha(new \DateTime());

            if ($idChofer == 0 && $idMovil == 0) {
                # busco todos los choferes y todos los moviles
                $moviles  = $em->getRepository('TaxiAdminMovilBundle:Movil')->findBy(array('idUsuario' => $idUsuario));
                $choferes = $em->getRepository('TaxiAdminChoferBundle:Chofer')->findBy(array('idUsuario' => $idUsuario));

            } elseif ($idChofer > 0 && $idMovil == 0) {
                # busco un chofer y todos los moviles
                $chofer   = $em->getRepository('TaxiAdminChoferBundle:Chofer')->findOneBy(array('idUsuario' => $idUsuario, 'id' => $idChofer));
                $choferes = array($chofer);

                $moviles = $em->getRepository('TaxiAdminMovilBundle:Movil')->findBy(array('idUsuario' => $idUsuario));

            } elseif ($idChofer == 0 && $idMovil > 0) {
                # busco todos los choferes y un movil
                $choferes = $em->getRepository('TaxiAdminChoferBundle:Chofer')->findBy(array('idUsuario' => $idUsuario));

                $movil   = $em->getRepository('TaxiAdminMovilBundle:Movil')->findOneBy(array('idUsuario' => $idUsuario, 'id' => $idMovil));
                $moviles = array($movil);
            }

            $form = $this->createCreateForm($entity, $choferes, $moviles, $idChofer, $idMovil);

            return array(
                'form'  => $form->createView(),
                );

        } else if ($request->isMethod('POST')) {
            $form = $this->createCreateForm($entity, null, null, $idChofer, $idMovil);
            $form->handleRequest($request);

            if ($form->isValid()) {

                $em->persist($entity);
                $em->flush();

                $this->get('session')->getFlashBag()->add('msg_success', 'Se ha agregado la multa.');

                return $this->redirect($this->getRedirect($idChofer, $idMovil, $entity));

            }
        }
    }

    /**
     * Finds and displays a Multa entity.
     *
     * @Route("/{id}", name="multa_show")
     * @Method("GET")
     * @Template("TaxiAdminChoferBundle:Multa:show.html.twig")
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TaxiAdminChoferBundle:Multa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Multa entity.');
        }

        return array(
            'entity' => $entity,
            );
    }
    
    /**
     * Edits an existing Multa entity.
     *
     * @Route("/update/chofer/{idChofer}/movil/{idMovil}/multa/{id}", name="multa_update", defaults={ "idChofer" = 0, "idMovil" = 0 })
     * @Method("PUT|GET")
     * @Template("TaxiAdminChoferBundle:Multa:new.html.twig")
     */
    public function updateAction(Request $request, $idChofer, $idMovil, $id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('TaxiAdminChoferBundle:Multa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Multa entity.');
        }

        $idUsuario = $this->get('security.context')->getToken()->getUser()->getId();

        if ($this->getRequest()->isXmlHttpRequest()) {

            # busco todos los choferes y todos los moviles
            $moviles  = $em->getRepository('TaxiAdminMovilBundle:Movil')->findBy(array('idUsuario' => $idUsuario));
            $choferes = $em->getRepository('TaxiAdminChoferBundle:Chofer')->findBy(array('idUsuario' => $idUsuario));

            $form = $this->createEditForm($entity, $choferes, $moviles, $idChofer, $idMovil);

            return array(
                'form'  => $form->createView(),
                );

        } else if ($request->isMethod('PUT')) {

            $editForm = $this->createEditForm($entity, null, null, $idChofer, $idMovil, '');
            $editForm->handleRequest($request);

            if ($editForm->isValid()) {
                $em->flush();
                $url = $this->getRedirect($idChofer, $idMovil, $entity);

                return $this->redirect($url);
            }

            $this->redirectShow($idChofer, $idMovil, $Entity);
        }
    }

    /**
     * Deletes a Multa entity.
     *
     * @Route("/{id}/{vista}", name="multa_delete", requirements={"vista" = "\d+"})
     * @Method("GET")
     */
    public function deleteAction(Request $request, $id, $vista) {

        // vista = 0 viene de chofer vista = 1 viene de movil
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('TaxiAdminChoferBundle:Multa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Accidente entity.');
        }

        if ($vista) {
            $matricula = $entity->getMovil()->getMatricula();
            $url = $this->generateUrl('movil_show', array('matricula' => $matricula));
        } else {
            $nombre   = $entity->getChofer()->getNombre();
            $apellido = $entity->getChofer()->getApellido();

            $url = $this->generateUrl('chofer_show', array('nombre' => $nombre, 'apellido' => $apellido ));
        }
        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('msg_success', 'Se ha eliminado la multa.');

        return $this->redirect($url);
    }

    private function getRedirect($idChofer, $idMovil, $entity){
        if ($idChofer == 0 && $idMovil == 0) {
            # no tiene id ninguno viene desde el dashboard
            return $this->generateUrl('usuario_dashboard');
        } elseif ($idChofer > 0 && $idMovil == 0) {
            # tiene idChofer, redirecciono a la pagina del chofer
            return $this->generateUrl('chofer_show', array('nombre' => $entity->getChofer()->getNombre(), 'apellido' => $entity->getChofer()->getApellido()));
        } elseif ($idChofer == 0 && $idMovil > 0) {
            # tiene idMovil, redirecciono a la pagina del movil
            return $this->generateUrl('movil_show', array('matricula' => $entity->getMovil()->getMatricula()));
        }
    }


    /**
    * Creates a form to create a Multa entity.
    *
    * @param Multa $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Multa $entity, $choferes, $moviles, $idChofer, $idMovil) {
        $form = $this->createForm(new MultaType($choferes, $moviles), $entity, array(
            'action' => $this->generateUrl('multa_create', array('idChofer' => $idChofer, 'idMovil' => $idMovil)),
            'method' => 'POST',
            ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array('class' => 'btn btn-default')));

        return $form;
    }

    /**
    * Creates a form to edit a Multa entity.
    *
    * @param Multa $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Multa $entity, $choferes, $moviles, $idChofer, $idMovil) {
        $form = $this->createForm(new MultaType($choferes, $moviles), $entity, array(
            'action' => $this->generateUrl('multa_update', array('idChofer' => $idChofer, 'idMovil' => $idMovil, 'id' => $entity->getId() )),
            'method' => 'PUT',
            ));

        $form->add('submit', 'submit', array('label' => 'Guardar', 'attr' => array('class' => 'btn btn-default')));


        return $form;
    }
}