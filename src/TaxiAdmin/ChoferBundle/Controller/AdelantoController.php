<?php

namespace TaxiAdmin\ChoferBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use TaxiAdmin\ChoferBundle\Entity\Adelanto;
use TaxiAdmin\ChoferBundle\Form\AdelantoType;
use TaxiAdmin\ChoferBundle\Entity\PagoAdelanto;
use TaxiAdmin\ChoferBundle\Form\PagoAdelantoType;

/**
 * Adelanto controller.
 *
 * @Route("/adelanto")
 */
class AdelantoController extends Controller {

    /**
     * Creates a new Adelanto entity.
     *
     * @Route("/{idChofer}", name="adelanto_create")
     * @Method("POST|GET")
     * @Template("TaxiAdminChoferBundle:Chofer:addAdelanto.html.twig")
     */
    public function createAction(Request $request, $idChofer = null) {

        $em = $this->getDoctrine()->getManager();
        $entity = new Adelanto();
        $idUsuario = $this->get('security.context')->getToken()->getUser()->getId();

        if ($this->getRequest()->isXmlHttpRequest()) {
            $entity->setFecha(new \DateTime());

            if ($idChofer != null) {
                $chofer = $em->getRepository('TaxiAdminChoferBundle:Chofer')->findOneBy(array('idUsuario' => $idUsuario, 'id' => $idChofer));
                $choferes = array($chofer);
            } else {
                $choferes = $em->getRepository('TaxiAdminChoferBundle:Chofer')->findBy(array('idUsuario' => $idUsuario));
            }

            $adelantoForm = $this->createCreateForm($entity, $choferes);

            return array(
                'adelantoForm'  => $adelantoForm->createView(),
                );

        } else if ($request->isMethod('POST')) {
            $form = $this->createCreateForm($entity, null);
            $form->handleRequest($request);

            if ($form->isValid()) {
                $entity->setPago(false);
                $entity->setSaldo($entity->getMonto());

                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('chofer_show', array('nombre' => $entity->getChofer()->getNombre(), 'apellido' => $entity->getChofer()->getApellido())));
            }

        }

    }

    /**
     * Finds and displays a Adelanto entity.
     *
     * @Route("/show/{id}", name="adelanto_show")
     * @Method("GET")
     * @Template("TaxiAdminChoferBundle:Chofer:showAdelanto.html.twig")
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TaxiAdminChoferBundle:Adelanto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Adelanto entity.');
        }

        return array('entity' => $entity );
    }

    /**
     * Creates a new pago for a Adelanto entity.
     *
     * @Route("/addPago/{idAdelanto}", name="adelanto_add_pago")
     * @Method("POST|GET")
     * @Template("TaxiAdminChoferBundle:Chofer:addPago.html.twig")
     */
    public function addPagoAction(Request $request, $idAdelanto = null) {

        $em = $this->getDoctrine()->getManager();
        $entity = new PagoAdelanto();
        // obtengo el adelanto
        $adelanto = $em->getRepository('TaxiAdminChoferBundle:Adelanto')->find($idAdelanto);
        $entity->setAdelanto($adelanto);

        if ($this->getRequest()->isXmlHttpRequest()) {
            $entity->setFecha(new \DateTime());

            $form = $this->createForm(new PagoAdelantoType($adelanto->getSaldo()), $entity, array(
                'action' => $this->generateUrl('adelanto_add_pago', array('idAdelanto' => $idAdelanto)),
                'method' => 'POST',
                ));

            return array(
                'form'  => $form->createView(),
                );

        } else if ($request->isMethod('POST')) {
            $form = $this->createForm(new PagoAdelantoType($adelanto->getSaldo()), $entity);
            $form->handleRequest($request);

            if ($form->isValid()) {

                // actualizo el saldo al adelanto
                $saldo = $adelanto->getSaldo() - $entity->getMonto();
                
                $adelanto->setSaldo($saldo);

                // guardo todo
                $em->persist($entity);
                $em->persist($adelanto);

                $em->flush();

                $this->get('session')->getFlashBag()->add('msg_success', 'El pago se ha agregado exitosamente.');
                return $this->redirect($this->generateUrl('chofer_show', array('nombre' => $adelanto->getChofer()->getNombre(), 'apellido' => $adelanto->getChofer()->getApellido())));
            }

        }

    }

    /**
     * Deletes a Usuario entity.
     *
     * @Route("/delete/{id}", name="adelanto_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('TaxiAdminChoferBundle:Adelanto')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuario entity.');
        }
        $nombre   = $entity->getChofer()->getNombre();
        $apellido = $entity->getChofer()->getApellido();

        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('msg_success', 'El adelanto se ha eliminado exitosamente.');
        return $this->redirect($this->generateUrl('chofer_show', array('nombre' => $nombre, 'apellido' => $apellido )));
    }





    private function createEditForm(Adelanto $entity) {
        $form = $this->createForm(new AdelantoType(), $entity, array(
            'action' => $this->generateUrl('adelanto_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            ));

        return $form;
    }

    private function createCreateForm(Adelanto $entity, $choferes) {
        $form = $this->createForm(new AdelantoType($choferes), $entity, array(
            'action' => $this->generateUrl('adelanto_create'),
            'method' => 'POST',
            ));

        return $form;
    }
}
