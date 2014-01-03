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
     * @Route("/chofer/{idChofer}/movil/{idMovil}", name="accidente_create")
     * @Method("POST|GET")
     * @Template("TaxiAdminChoferBundle:Accidente:new.html.twig")
     */
    public function createAction(Request $request, $idChofer = null, $idMovil = null) {
        $em = $this->getDoctrine()->getManager();


        echo 'choferes ' . $idChofer . '<br>' ;
        echo 'moviles ' . $idMovil;

        $entity = new Accidente();
        $idUsuario = $this->get('security.context')->getToken()->getUser()->getId();

        if ($this->getRequest()->isXmlHttpRequest()) {
            $entity->setFecha(new \DateTime());

            if ($idChofer == null && $idMovil == null) {
                echo 'entrooooo';
                # busco todos los choferes y todos los moviles
                $moviles  = $em->getRepository('TaxiAdminMovilBundle:Movil')->findBy(array('idUsuario' => $idUsuario));
                $choferes = $em->getRepository('TaxiAdminChoferBundle:Chofer')->findBy(array('idUsuario' => $idUsuario));

            } elseif ($idChofer != null && $idMovil == null) {
                # busco un chofer y todos los moviles
                $chofer   = $em->getRepository('TaxiAdminChoferBundle:Chofer')->findOneBy(array('idUsuario' => $idUsuario, 'id' => $idChofer));
                $choferes = array($chofer);

                $moviles = $em->getRepository('TaxiAdminMovilBundle:Movil')->findBy(array('idUsuario' => $idUsuario));

            } elseif ($idChofer == null && $idMovil != null) {
                # busco todos los choferes y un movil
                $choferes = $em->getRepository('TaxiAdminChoferBundle:Chofer')->findBy(array('idUsuario' => $idUsuario));

                $movil   = $em->getRepository('TaxiAdminMovilBundle:Movil')->findOneBy(array('idUsuario' => $idUsuario, 'id' => $idMovil));
                $moviles = array($movil);
            }

            echo 'new choferes ' . $choferes; 
            $form = $this->createCreateForm($entity, $choferes, $moviles);

            return array(
                'form'  => $form->createView(),
                );

        } else if ($request->isMethod('POST')) {
            $form = $this->createCreateForm($entity, null);
            $form->handleRequest($request);

            if ($form->isValid()) {
                $entity->setPago(false);
                $entity->setSaldo($entity->getMonto());

                $em->persist($entity);
                $em->flush();

                if ($idChofer == null && $idMovil == null) {
                    # no tiene id ninguno viene desde el dashboard
                    return $this->redirect($this->generateUrl('usuario_dashboard'));

                } elseif ($idChofer != null && $idMovil == null) {
                    # tiene idChofer, redirecciono a la pagina del chofer
                    return $this->redirect($this->generateUrl('chofer_show', array('nombre' => $entity->getChofer()->getNombre(), 'apellido' => $entity->getChofer()->getApellido())));

                } elseif ($idChofer == null && $idMovil != null) {
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
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TaxiAdminChoferBundle:Accidente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Accidente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            );
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
    private function createCreateForm(Accidente $entity, $choferes, $moviles) {
        $form = $this->createForm(new AccidenteType($choferes, $moviles), $entity, array(
            'action' => $this->generateUrl('accidente_create'),
            'method' => 'POST',
            ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'class' => 'btn btn-default'));

        return $form;
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

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('accidente_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            );
    }

    /**
     * Deletes a Accidente entity.
     *
     * @Route("/{id}", name="accidente_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TaxiAdminChoferBundle:Accidente')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Accidente entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('accidente'));
    }

}
