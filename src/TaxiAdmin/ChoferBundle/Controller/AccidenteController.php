<?php

namespace TaxiAdmin\ChoferBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use TaxiAdmin\ChoferBundle\Entity\Accidente;
use TaxiAdmin\ChoferBundle\Form\AccidenteType;

/**
 * Accidente controller.
 *
 * @Route("/accidente")
 */
class AccidenteController extends Controller {

    /**
     * Creates a new Accidente entity.
     *
     * @Route("/chofer/{idChofer}/movil/{idMovil}", name="accidente_create", defaults={ "idChofer" = 0, "idMovil" = 0 })
     * @Method("POST|GET")
     * @Template("TaxiAdminChoferBundle:Accidente:new.html.twig")
     */
    public function createAction(Request $request, $idChofer, $idMovil) {
        $em = $this->getDoctrine()->getManager();

        $entity = new Accidente();
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

                $this->get('session')->getFlashBag()->add('msg_success', 'Se ha agregado el accidente.');

                if ($idChofer == 0 && $idMovil == 0) {
                    # no tiene id ninguno viene desde el dashboard
                    return $this->redirect($this->generateUrl('usuario_dashboard'));

                } elseif ($idChofer > 0 && $idMovil == 0) {
                    # tiene idChofer, redirecciono a la pagina del chofer
                    return $this->redirect($this->generateUrl('chofer_show', array('nombre' => $entity->getChofer()->getNombre(), 'apellido' => $entity->getChofer()->getApellido())));

                } elseif ($idChofer == 0 && $idMovil > 0) {
                    # tiene idMovil, redirecciono a la pagina del movil
                    return $this->redirect($this->generateUrl('movil_show', array('matricula' => $entity->getMovil()->getMatricula())));
                }

            }

        }
    }

    /**
     * Finds and displays a Accidente entity.
     *
     * @Route("/{id}", name="accidente_show")
     * @Method("GET")
     * @Template("TaxiAdminChoferBundle:Accidente:show.html.twig")
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TaxiAdminChoferBundle:Accidente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Accidente entity.');
        }

        return array(
            'entity' => $entity,
            );
    }

    /**
     * Edits an existing Accidente entity.
     *
     * @Route("/{id}", name="accidente_update")
     * @Method("PUT")
     * @Template("TaxiAdminChoferBundle:Accidente:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TaxiAdminChoferBundle:Accidente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Accidente entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('accidente_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            );
    }

    /**
     * Deletes a Accidente entity.
     *
     * @Route("/{id}/{vista}", name="accidente_delete", requirements={"vista" = "\d+"})
     * @Method("GET")
     */
    public function deleteAction(Request $request, $id, $vista) {
        
        // vista = 0 viene de chofer vista = 1 viene de movil
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('TaxiAdminChoferBundle:Accidente')->find($id);

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

       $this->get('session')->getFlashBag()->add('msg_success', 'Se ha eliminado el accidente.');

       return $this->redirect($url);
   }

    /**
    * Creates a form to edit a Accidente entity.
    *
    * @param Accidente $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Accidente $entity) {
        $form = $this->createForm(new AccidenteType(), $entity, array(
            'action' => $this->generateUrl('accidente_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
    * Creates a form to create a Accidente entity.
    *
    * @param Accidente $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Accidente $entity, $choferes, $moviles, $idChofer, $idMovil) {
        $form = $this->createForm(new AccidenteType($choferes, $moviles), $entity, array(
            'action' => $this->generateUrl('accidente_create', array('idChofer' => $idChofer, 'idMovil' => $idMovil)),
            'method' => 'POST',
            ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array('class' => 'btn btn-default')));

        return $form;
    }

}
