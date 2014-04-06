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
     * @Route("/empresa/{empresa}", name="gasto_empresa_create", defaults={ "empresa" = 0 })
     * @Method("POST|GET")
     * @Template("TaxiAdminGastoBundle:GastoEmpresa:new.html.twig")
     */
    public function createAction(Request $request, $empresa ) {
        $em = $this->getDoctrine()->getManager();

        $entity = new GastoEmpresa();
        $idUsuario = $this->get('security.context')->getToken()->getUser()->getId();
        $empresas = null;

        if ($empresa == 0 ) {
                # busco todos las empresas
            $empresas = $em->getRepository('TaxiAdminEmpresaBundle:Empresa')->findBy(array('idUsuario' => $idUsuario));

        } elseif ($empresa > 0 ) {
                # busco la empresa
            $empresa   = $em->getRepository('TaxiAdminEmpresaBundle:Empresa')->findOneBy(array('idUsuario' => $idUsuario, 'id' => $empresa));
            $empresas = array($empresa);
        }

        if ($this->getRequest()->isXmlHttpRequest()) {

            $form = $this->createCreateForm($entity, $empresas, $empresa);

            return array( 'form'  => $form->createView() );

        } else if ($request->isMethod('POST')) {
            $form = $this->createCreateForm($entity, $empresas, $empresa);
            $form->handleRequest($request);

            if ($form->isValid()) {

                if ($form["fechaPago"]->getData() != null && $entity->getDiaVencimiento() == null) {
                    // si tiene una fecha de pago pero no tiene un dia de vencimiento, es un gasto puntual,
                    // por lo tanto  le agrego la fecha de pago al gasto
                    $entity->setFechaPago($form["fechaPago"]->getData());
                    $em->persist($entity);
                    $em->flush();
                } else if ($form["fechaPago"]->getData() != null && $entity->getDiaVencimiento() != null) {
                    // es un gasto mensual y el primer ya esta pago

                    // guardo el gasto para poder obtener el id
                    $em->persist($entity);
                    $em->flush();

                    $pago = new PagoGastoEmpresa();
                    $pago->setCosto($entity->getCosto());
                    $pago->setFechaPago($form["fechaPago"]->getData());
                    $pago->setEmpresaId($entity->getId());
                    
                    $em->persist($pago);
                    $em->flush();
                } else {
                    // si llega aca es por que:
                    // es un gasto mensual pero el primero no esta pago
                    // o es un gasto que no tiene fecha de pago ni dia de vencimiento
                    // por ahora para estos dos casos se procede igual

                    $em->persist($entity);
                    $em->flush();
                }


                $this->get('session')->getFlashBag()->add('msg_success', 'Se ha agregado el gasto.');

                return $this->redirect($this->getRedirect($empresa, $entity));
            } else {
                // echo $form->getErrorsAsString();
                foreach ($form->getErrors() as $error) {
                    $message = $this->container->get('translator')->trans($error->getMessage(), array(), 'validators');
                    echo $message;
                }
            }
        }
    }

    /**
     * Finds and displays a GastoEmpresa entity.
     *
     * @Route("/{id}", name="gastoempresa_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TaxiAdminGastoBundle:GastoEmpresa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GastoEmpresa entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            );
    }

    /**
     * Edits an existing GastoEmpresa entity.
     *
     * @Route("/{id}", name="gastoempresa_update")
     * @Method("PUT")
     * @Template("TaxiAdminGastoBundle:GastoEmpresa:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TaxiAdminGastoBundle:GastoEmpresa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GastoEmpresa entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('gastoempresa_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            );
    }
    /**
     * Deletes a GastoEmpresa entity.
     *
     * @Route("/{id}", name="gastoempresa_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TaxiAdminGastoBundle:GastoEmpresa')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find GastoEmpresa entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('gastoempresa'));
    }


    /**
    * Creates a form to create a GastoEmpresa entity.
    *
    * @param GastoEmpresa $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(GastoEmpresa $entity, $empresas, $empresa) {
        $form = $this->createForm(new GastoEmpresaType($empresas), $entity, array(
            'action' => $this->generateUrl('gasto_empresa_create', array('empresa' => $empresa)),
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
        $form = $this->createForm(new GastoEmpresaType(), $entity, array(
            'action' => $this->generateUrl('gastoempresa_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            ));

        $form->add('submit', 'submit', array('label' => 'Update'));

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
