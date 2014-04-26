<?php

namespace TaxiAdmin\GastoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use TaxiAdmin\GastoBundle\Form\GastoEmpresaType;
use TaxiAdmin\GastoBundle\Entity\GastoEmpresa;
use TaxiAdmin\GastoBundle\Entity\PagoGastoEmpresa;

/**
 * GastoEmpresa controller.
 *
 * @Route("/gastoempresa")
 */
class GastoEmpresaController extends Controller {

    /**
     * Creates a new Gasto entity.
     *
     * @Route("/empresa/{empresa}/{mensual}", name="gasto_empresa_create", defaults={ "empresa" = 0, "mensual" = 0 })
     * @Method("POST|GET")
     * @Template("TaxiAdminGastoBundle:GastoEmpresa:new.html.twig")
     */
    public function createAction(Request $request, $empresa, $mensual ) {
        $em = $this->getDoctrine()->getManager();

        $entity = new GastoEmpresa();

        if ( $this->getRequest()->isXmlHttpRequest()) {

            $form = $this->createCreateForm($entity, $empresa, $mensual);
            return array(
                'form'      => $form->createView(),
                'isMensual' => $mensual,
                );

        } else if ($request->isMethod('POST')) {

            $form = $this->createCreateForm($entity, $empresa, $mensual);
            $form->handleRequest($request);

            if ($form->isValid()) {

                $idUsuario = $this->get('security.context')->getToken()->getUser()->getId();
                $empresa   = $em->getRepository('TaxiAdminEmpresaBundle:Empresa')->findOneBy(array('idUsuario' => $idUsuario, 'id' => $empresa));
                $entity->setIsMensual($mensual);
                $entity->setEmpresa($empresa);

                $em->persist($entity);
                $em->flush();

                $this->get('session')->getFlashBag()->add('msg_success', 'Se ha agregado el gasto.');

                return $this->redirect($this->getRedirect($empresa, $entity));
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
     * Finds and displays a GastoEmpresa entity.
     *
     * @Route("/show/{id}", name="gastoempresa_show")
     * @Method("GET")
     * @Template("TaxiAdminGastoBundle:GastoEmpresa:show.html.twig")
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TaxiAdminGastoBundle:GastoEmpresa')->find($id);
        // $pagos = $em->getRepository('TaxiAdminGastoBundle:PagoGastoEmpresa')->findBy(array('gastoempresa_id' => $id));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GastoEmpresa entity.');
        }

        return array(
            'entity' => $entity,
            // 'pagos' => $pagos,
            );
    }

    /**
     * Edits an existing GastoEmpresa entity.
     *
     * @Route("/update/{id}", name="gastoempresa_update")
     * @Method("GET|PUT")
     * @Template("TaxiAdminGastoBundle:GastoEmpresa:new.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TaxiAdminGastoBundle:GastoEmpresa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GastoEmpresa entity.');
        }

        if ($this->getRequest()->isXmlHttpRequest()) {

            echo $entity->getDiaVencimiento();
            $form = $this->createEditForm($entity);
            return array(
                'form'   => $form->createView(),
                'isMensual' => $entity->getIsMensual(),
                );

        } else if ($request->isMethod('PUT')) {

            $form = $this->createEditForm($entity);
            $form->handleRequest($request);

            if ($form->isValid()) {

                if ($form["fechaPago"]->getData() != null && $entity->getDiaVencimiento() != null) {
                    // es un gasto mensual y el primer ya esta pago

                    $entity->setFechaPago(null);
                    $pago = new PagoGastoEmpresa();
                    $pago->setCosto($entity->getCosto());
                    $pago->setFechaPago($form["fechaPago"]->getData());
                    $pago->setGastoempresaId($entity->getId());
                    
                    $em->persist($entity);
                    $em->persist($pago);

                    $em->flush();
                }

                $em->flush();

                $this->get('session')->getFlashBag()->add('msg_success', 'El gasto se ha modificado con éxito.');
                return $this->redirect($this->generateUrl('empresa_show', array('razonSocial' => $entity->getEmpresa()->getRazonSocial())));
            }
        }

    }

    /**
     *
     * @Route("/remove_pago/{idpago}/{id}", name="gastoempresa_removepago")
     * @Method("GET")
     * @Template()
     */
    public function removePagoAction($idpago, $id) {
        $em = $this->getDoctrine()->getManager();

        $gastoEmpresa = $em->getRepository('TaxiAdminGastoBundle:GastoEmpresa')->find($id);
        $pago = $em->getRepository('TaxiAdminGastoBundle:PagoGastoEmpresa')->findOneBy(array('id' => $idpago, 'gastoempresa_id' => $id));

        if (!$pago) {
            throw $this->createNotFoundException('Unable to find GastoEmpresa entity.');
        }

        $em->remove($pago);
        $em->flush();
        
        $this->get('session')->getFlashBag()->add('msg_success', 'El pago se ha eliminado con éxito.');
        return $this->redirect($this->generateUrl('empresa_show', array('razonSocial' => $gastoEmpresa->getEmpresa()->getRazonSocial())));
    }

    /**
     *
     * @Route("/remove_gastoempresa/{id}", name="gastoempresa_remove")
     * @Method("GET")
     * @Template()
     */
    public function removeGastoAction($id) {
        $em = $this->getDoctrine()->getManager();

        $gastoEmpresa = $em->getRepository('TaxiAdminGastoBundle:GastoEmpresa')->find($id);
        $pagos = $em->getRepository('TaxiAdminGastoBundle:PagoGastoEmpresa')->findBy(array('gastoempresa_id' => $id));

        if (!$gastoEmpresa) {
            throw $this->createNotFoundException('Unable to find GastoEmpresa entity.');
        }

        $razonSocial = $gastoEmpresa->getEmpresa()->getRazonSocial();

        foreach ($pagos as $pago) {
            $em->remove($pago);
        }

        $em->remove($gastoEmpresa);
        $em->flush();

        $this->get('session')->getFlashBag()->add('msg_success', 'El gasto se ha eliminado con éxito.');
        return $this->redirect($this->generateUrl('empresa_show', array('razonSocial' => $razonSocial )));
    }

    /**
    * Creates a form to create a GastoEmpresa entity.
    *
    * @param GastoEmpresa $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(GastoEmpresa $entity, $empresa, $mensual) {
        $form = $this->createForm(new GastoEmpresaType(), $entity, array(
            'action' => $this->generateUrl('gasto_empresa_create', array('empresa' => $empresa, 'mensual' => $mensual)),
            'method' => 'POST',
            ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array('class' => 'btn btn-default')));

        return $form;
    }

    /**
    * Creates a form to edit a GastoEmpresa entity.
    *
    * @param GastoEmpresa $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(GastoEmpresa $entity) {
        $form = $this->createForm(new GastoEmpresaType($entity), $entity, array(
            'action' => $this->generateUrl('gastoempresa_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            ));

        $form->add('submit', 'submit', array('label' => 'Update', 'attr' => array('class' => 'btn btn-default')));

        return $form;
    }

    private function getRedirect($empresa, $entity){
        if (empty($empresa) ) {
            # no tiene id ninguno viene desde el dashboard
            return $this->generateUrl('usuario_dashboard');
        } else {
            # tiene empresa, redirecciono a la pagina de la empresa
            return $this->generateUrl('empresa_show', array('razonSocial' => $entity->getEmpresa()->getRazonSocial()));
        }
    }
}
