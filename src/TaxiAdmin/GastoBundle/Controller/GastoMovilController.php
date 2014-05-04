<?php

namespace TaxiAdmin\GastoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use TaxiAdmin\GastoBundle\Entity\GastoMovil;
use TaxiAdmin\GastoBundle\Entity\PagoGastoMovil;
use TaxiAdmin\GastoBundle\Form\PagoGastoMovilType;
use TaxiAdmin\GastoBundle\Form\GastoMovilType;

/**
 * GastoMovil controller.
 *
 * @Route("/gastomovil")
 */
class GastoMovilController extends Controller {

    /**
     * @Route("/movil/{movil}/{mensual}", name="gasto_movil_create", defaults={ "movil" = 0, "mensual" = 0 })
     * @Method("GET|POST")
     * @Template("TaxiAdminGastoBundle:GastoMovil:new.html.twig")
     */
    public function createAction(Request $request, $movil, $mensual) {
        $em = $this->getDoctrine()->getManager();

        $entity = new GastoMovil();

        if ( $this->getRequest()->isXmlHttpRequest()) {

            $form = $this->createCreateForm($entity, $movil, $mensual);
            return array(
                'form'      => $form->createView(),
                'isMensual' => $mensual,
                );

        } else if ($request->isMethod('POST')) {

            $form = $this->createCreateForm($entity, $movil, $mensual);
            $form->handleRequest($request);

            if ($form->isValid()) {

                $idUsuario = $this->get('security.context')->getToken()->getUser()->getId();
                $movil   = $em->getRepository('TaxiAdminMovilBundle:Movil')->findOneBy(array('idUsuario' => $idUsuario, 'id' => $movil));
                $entity->setIsMensual($mensual);
                if ($mensual) {
                    $entity->setCosto(0);
                }
                $entity->setMovil($movil);

                $em->persist($entity);
                $em->flush();

                $this->get('session')->getFlashBag()->add('msg_success', 'Se ha agregado el gasto.');

                return $this->redirect($this->getRedirect($movil, $entity));
            } else {
                // echo $form->getErrorsAsString();
                // foreach ($form->getErrors() as $error) {
                //     $message = $this->container->get('translator')->trans($error->getMessage(), array(), 'validators');
                //     echo $message;
                // }
            }
        }
    }

    /**
     * Finds and displays a GastoMovil entity.
     *
     * @Route("/show/{id}", name="gasto_movil_show")
     * @Method("GET")
     * @Template("TaxiAdminGastoBundle:GastoMovil:show.html.twig")
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TaxiAdminGastoBundle:GastoMovil')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GastoMovil entity.');
        }

        return array('entity' => $entity);
    }

    /**
     * Edits an existing GastoMovil entity.
     *
     * @Route("/update/{id}", name="gasto_movil_update")
     * @Method("GET|PUT")
     * @Template("TaxiAdminGastoBundle:GastoMovil:new.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TaxiAdminGastoBundle:GastoMovil')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GastoMovil entity.');
        }

        if ($this->getRequest()->isXmlHttpRequest()) {

            $form = $this->createEditForm($entity);
            return array(
                'form'   => $form->createView(),
                'isMensual' => $entity->getIsMensual(),
                );

        } else if ($request->isMethod('PUT')) {

            $form = $this->createEditForm($entity);
            $form->handleRequest($request);

            if ($form->isValid()) {

                $em->persist($entity);
                $em->flush();

                $this->get('session')->getFlashBag()->add('msg_success', 'El gasto se ha modificado con éxito.');
                return $this->redirect($this->generateUrl('movil_show', array('matricula' => $entity->getMovil()->getMatricula())));
            }
        }
    }

    /**
     *
     * @Route("/add_pago/{gasto}", name="gasto_movil_addpago")
     * @Method("GET|POST")
     * @Template("TaxiAdminGastoBundle:PagoGastoMovil:new.html.twig")
     */
    public function addPagoAction(Request $request, $gasto) {
        $em = $this->getDoctrine()->getManager();
        $pago = new PagoGastoMovil();
        $form = $this->createForm(new PagoGastoMovilType(), $pago , array(
            'action' => $this->generateUrl('gasto_movil_addpago', array('gasto' => $gasto)),
            'method' => 'POST',
            ));

        if ( $this->getRequest()->isXmlHttpRequest()) {
            $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array('class' => 'btn btn-default')));
            return array(
                'form' => $form->createView(),
                );
        } else if ($request->isMethod('POST')) {

            $form->handleRequest($request);

            $gastoMovil = $em->getRepository('TaxiAdminGastoBundle:GastoMovil')->find($gasto);

            $pago->setGastoMovil($gastoMovil);
            $gastoMovil->addPago($pago);

            $em->persist($pago);
            $em->persist($gastoMovil);
            
            $em->flush();

            $this->get('session')->getFlashBag()->add('msg_success', 'El pago se ha agregado con éxito.');
            return $this->redirect($this->generateUrl('movil_show', array('matricula' => $gastoMovil->getMovil()->getMatricula())));
        }
    }

    /**
     *
     * @Route("/remove_pago/{idpago}/{id}", name="gasto_movil_removepago")
     * @Method("GET")
     * @Template()
     */
    public function removePagoAction($idpago, $id) {
        $em = $this->getDoctrine()->getManager();

        $gastoMovil = $em->getRepository('TaxiAdminGastoBundle:GastoMovil')->find($id);
        $pago = $em->getRepository('TaxiAdminGastoBundle:PagoGastoMovil')->findOneBy(array('id' => $idpago));

        if (!$pago) {
            throw $this->createNotFoundException('Unable to find GastoMovil entity.');
        }

        $gastoMovil->removePago($pago);

        $em->remove($pago);
        $em->persist($gastoMovil);
        $em->flush();
        
        $this->get('session')->getFlashBag()->add('msg_success', 'El pago se ha eliminado con éxito.');
        return $this->redirect($this->generateUrl('movil_show', array('matricula' => $gastoMovil->getMovil()->getMatricula())));
    }

    /**
     *
     * @Route("/remove_gastomovil/{id}", name="gasto_movil_remove")
     * @Method("GET")
     * @Template()
     */
    public function removeGastoAction($id) {
        $em = $this->getDoctrine()->getManager();

        $gastoMovil = $em->getRepository('TaxiAdminGastoBundle:GastoMovil')->find($id);

        if (!$gastoMovil) {
            throw $this->createNotFoundException('Unable to find GastoMovil entity.');
        }

        $matricula = $gastoMovil->getMovil()->getMatricula();

        $em->remove($gastoMovil);
        $em->flush();

        $this->get('session')->getFlashBag()->add('msg_success', 'El gasto se ha eliminado con éxito.');
        return $this->redirect($this->generateUrl('movil_show', array('matricula' => $matricula )));
    }

    /**
    * Creates a form to create a GastoMovil entity.
    *
    * @param GastoMovil $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(GastoMovil $entity, $movil, $mensual) {
        $form = $this->createForm(new GastoMovilType(), $entity, array(
            'action' => $this->generateUrl('gasto_movil_create', array('movil' => $movil, 'mensual' => $mensual)),
            'method' => 'POST',
            ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array('class' => 'btn btn-default')));

        return $form;
    }

    /**
    * Creates a form to edit a GastoMovil entity.
    *
    * @param GastoMovil $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
        private function createEditForm(GastoMovil $entity) {
            $form = $this->createForm(new GastoMovilType($entity), $entity, array(
                'action' => $this->generateUrl('gasto_movil_update', array('id' => $entity->getId())),
                'method' => 'PUT',
                ));

            $form->add('submit', 'submit', array('label' => 'Update', 'attr' => array('class' => 'btn btn-default')));

            return $form;
        }

        private function getRedirect($movil, $entity){
            if (empty($movil) ) {
            # no tiene id viene desde el dashboard
                return $this->generateUrl('usuario_dashboard');
            } else {
            # tiene movil, redirecciono a la pagina del movil
                return $this->generateUrl('movil_show', array('matricula' => $entity->getMovil()->getMatricula()));
            }
        }

    }
