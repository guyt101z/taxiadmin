<?php

namespace TaxiAdmin\EmpresaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use TaxiAdmin\EmpresaBundle\Entity\Empresa;
use TaxiAdmin\EmpresaBundle\Form\EmpresaType;

/**
 * Empresa controller.
 *
 * @Route("/empresas")
 */
class EmpresaController extends Controller {

    /**
     * Lists all Empresa entities for Usuario.
     *
     * @Route("/", name="empresa")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {

        $idUsuario = $this->get('security.context')->getToken()->getUser()->getId();        
        $query = $this->getDoctrine()->getManager()->getRepository('TaxiAdminEmpresaBundle:Empresa')->getIndexDQL($idUsuario);
        $sortOrder = array('defaultSortFieldName' => 'e.nombre', 'defaultSortDirection' => 'asc');
        $page = $this->get('request')->query->get('page', 1);
        
        $pagination = $this->get('ta_pagination')->getPagination($query, $page, $sortOrder);

        return array(
            'form'       => $this->createCreateForm(new Empresa())->createView(),
            'pagination' => $pagination
            );
    }


    /**
     * Creates a new Empresa entity.
     *
     * @Route("/", name="empresa_create")
     * @Method("POST")
     * @Template("TaxiAdminEmpresaBundle:Empresa:new.html.twig")
     */
    public function createAction(Request $request) {
        $empresa = new Empresa();
        $form = $this->createForm(new EmpresaType(), $empresa);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $empresa->setIdUsuario($this->get('security.context')->getToken()->getUser()->getId());
            $empresa->setHabilitado(true);
            $empresa->setFechaAlta(new \DateTime());

            $em->persist($empresa);
            $em->flush();

            return $this->redirect($this->generateUrl('empresa_show', array('razonSocial' => $empresa->getRazonSocial())));
        }
        //TODO Brus, loguear los errores
        $this->get('session')->getFlashBag()->add('msg_error', 'Ups, estamos teniendo problemas para crear su Empresa, por favor contacte con Soporte.');

        return $this->redirect($this->generateUrl('empresa'));
    }

    /**
     * Edits an existing Empresa entity.
     *
     * @Route("/{id}", requirements={"id" = "\d+"}, name="empresa_update")
     * @Method("PUT")
     * @Template("")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $idUsuario = $this->get('security.context')->getToken()->getUser()->getId();
        $entity = $em->getRepository('TaxiAdminEmpresaBundle:Empresa')->findOneBy(array('id' => $id, 'idUsuario' => $idUsuario));

        if (!$entity) {
            $this->get('session')->getFlashBag()->add('msg_error', 'Ups, no hemos encontrado la Empresa solicitada.');
            return $this->redirect($this->generateUrl('empresa'));
        }

        $form = $this->createEditForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();
            
            return $this->redirect($this->generateUrl('empresa_show', array('razonSocial' => $entity->getRazonSocial())));
        }

        //TODO Brus, loguear el error del formulario
        $this->get('session')->getFlashBag()->add('msg_error', 'Ups, no hemos podido modificar la Empresa solicitada. Update2');
        // return $this->redirect($this->generateUrl('empresa'));
    }

    /**
     * Finds and displays a Empresa entity.
     *
     * @Route("/show/{razonSocial}", name="empresa_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($razonSocial) {

        $em = $this->getDoctrine()->getManager();

        $idUsuario = $this->get('security.context')->getToken()->getUser()->getId();
        $entity = $em->getRepository('TaxiAdminEmpresaBundle:Empresa')->findOneBy(array('razonSocial' => $razonSocial, 'idUsuario' => $idUsuario));

        if (!$entity) {
            $this->get('session')->getFlashBag()->add('msg_error', 'Ups, no hemos encontrado la Empresa solicitada.');
            return $this->redirect($this->generateUrl('empresa'));
        }

        $form = $this->createEditForm($entity);
        return array(
            'form' => $form->createView(),
            'entity' => $entity,
            );
    }

    /**
     * add propietario in Empresa entity.
     *
     * @Route("/add_propietario/{razonSocial}", name="empresa_add_propietario")
     * @Method("POST|GET")
     * @Template("TaxiAdminEmpresaBundle:Empresa:_addPropietario.html.twig")
     */
    public function addPropietarioAction(Request $request, $razonSocial = null) {

        $em = $this->getDoctrine()->getManager();
        $idUsuario = $this->get('security.context')->getToken()->getUser()->getId();
        if ($this->getRequest()->isXmlHttpRequest()) {
            // $empresa = $em->getRepository('TaxiAdminEmpresaBundle:Empresa')->findOneBy(array('razonSocial' => $razonSocial, 'idUsuario' => $idUsuario));
            $data = $em->getRepository('TaxiAdminPropietarioBundle:Propietario')->getPropietariosSinEmpresa($idUsuario, $razonSocial);
            return array(
                'propietarios' => $data,
                'razonSocial'  => $razonSocial,
                );
            return new Response(json_encode(array('propietarios' => $data)));
        } else if ($request->isMethod('POST')) {
            // echo '<pre>'. print_r($request->request->get('propietarios'), 1) . '</pre> <br/>';
            // echo 'razonSocial ' . $razonSocial;
            $propietarios = $request->request->get('propietarios');
            $razonSocial = $request->request->get('razonSocial');
            // verifico que los datos que vienen del formulario esta completos con algo
            if (count($propietarios) && !empty($razonSocial)) {
                // voy a buscar a la empresa
                $empresa = $em->getRepository('TaxiAdminEmpresaBundle:Empresa')->findOneBy(array('razonSocial' => $razonSocial, 'idUsuario' => $idUsuario));
                // para cada propietario lo busco en la bd y lo asigno a la empresa
                foreach ($propietarios as $propId) {
                    $propietario = $em->getRepository('TaxiAdminPropietarioBundle:Propietario')->findOneBy(array('id' => $propId, 'idUsuario' => $idUsuario));
                    if (!empty($propietario)) {
                        $empresa->addPropietario($propietario);
                    }
                }

                // para finalizar guardo la entidad empresa
                $em->persist($empresa);
                $em->flush();

                if (count($propietarios) == 1) {
                    $this->get('session')->getFlashBag()->add('msg_success', 'Se ha agregado el nuevo Propietario a la Empresa.');
                } else {
                    $this->get('session')->getFlashBag()->add('msg_success', 'Se han agregado los nuevos Propietarios a la Empresa.');
                }
                
                return $this->redirect($this->generateUrl('empresa_show', array('razonSocial' => $razonSocial)));

            }

        }
    }

    
    /**
     * remove propietario the Empresa entity.
     *
     * @Route("/remove_propietario/{razonSocial}/{idPropietario}", name="empresa_remove_propietario")
     * @Method("GET")
     * @Template("")
     */
    public function removePropietarioAction(Request $request, $razonSocial, $idPropietario) {
        $em = $this->getDoctrine()->getManager();
        $idUsuario = $this->get('security.context')->getToken()->getUser()->getId();

        $empresa = $em->getRepository('TaxiAdminEmpresaBundle:Empresa')->findOneBy(array('razonSocial' => $razonSocial, 'idUsuario' => $idUsuario));
        $propietario = $em->getRepository('TaxiAdminPropietarioBundle:Propietario')->findOneBy(array('id' => $idPropietario, 'idUsuario' => $idUsuario));

        if ($empresa && $propietario) {
            // si ninguno es vacio quito el propietario de la empresa
            $empresa->removePropietario($propietario);
            // para finalizar guardo la entidad empresa
            $em->persist($empresa);
            $em->flush();

            $this->get('session')->getFlashBag()->add('msg_success', 'Se ha elimiando al Propietario de la Empresa.');
        }
        
        return $this->redirect($this->generateUrl('empresa_show', array('razonSocial' => $razonSocial)));
    }


    /**
     * add chofer in Empresa entity.
     *
     * @Route("/add_chofer/{razonSocial}", name="empresa_add_chofer")
     * @Method("POST|GET")
     * @Template("TaxiAdminEmpresaBundle:Empresa:_addChofer.html.twig")
     */
    public function addChoferAction(Request $request, $razonSocial = null) {

        $em = $this->getDoctrine()->getManager();
        $idUsuario = $this->get('security.context')->getToken()->getUser()->getId();

        if ($this->getRequest()->isXmlHttpRequest()) {
            $data = $em->getRepository('TaxiAdminChoferBundle:Chofer')->getChoferesSinEmpresa($idUsuario, $razonSocial);
            return array(
                'choferes' => $data,
                'razonSocial'  => $razonSocial,
                );
            return new Response(json_encode(array('choferes' => $data)));

        } else if ($request->isMethod('POST')) {
            $choferes = $request->request->get('choferes');
            $razonSocial = $request->request->get('razonSocial');
            // verifico que los datos que vienen del formulario esta completos con algo
            if (count($choferes) && !empty($razonSocial)) {
                // voy a buscar a la empresa
                $empresa = $em->getRepository('TaxiAdminEmpresaBundle:Empresa')->findOneBy(array('razonSocial' => $razonSocial, 'idUsuario' => $idUsuario));
                // para cada chofer lo busco en la bd y lo asigno a la empresa
                foreach ($choferes as $propId) {
                    $chofer = $em->getRepository('TaxiAdminChoferBundle:Chofer')->findOneBy(array('id' => $propId, 'idUsuario' => $idUsuario));
                    if (!empty($chofer)) {
                        $empresa->addChofer($chofer);
                    }
                }

                // para finalizar guardo la entidad empresa
                $em->persist($empresa);
                $em->flush();

                if (count($choferes) == 1) {
                    $this->get('session')->getFlashBag()->add('msg_success', 'Se ha agregado el nuevo Chofer a la Empresa.');
                } else {
                    $this->get('session')->getFlashBag()->add('msg_success', 'Se han agregado los nuevos Choferes a la Empresa.');
                }
                
                return $this->redirect($this->generateUrl('empresa_show', array('razonSocial' => $razonSocial)));

            }

        }
    }

    
    /**
     * remove chofer the Empresa entity.
     *
     * @Route("/remove_chofer/{razonSocial}/{idChofer}", name="empresa_remove_chofer")
     * @Method("GET")
     * @Template("")
     */
    public function removeChoferAction(Request $request, $razonSocial, $idChofer) {
        $em = $this->getDoctrine()->getManager();
        $idUsuario = $this->get('security.context')->getToken()->getUser()->getId();

        $empresa = $em->getRepository('TaxiAdminEmpresaBundle:Empresa')->findOneBy(array('razonSocial' => $razonSocial, 'idUsuario' => $idUsuario));
        $chofer = $em->getRepository('TaxiAdminChoferBundle:Chofer')->findOneBy(array('id' => $idChofer, 'idUsuario' => $idUsuario));

        if ($empresa && $chofer) {
            // si ninguno es vacio quito el chofer de la empresa
            $empresa->removeChofer($chofer);
            // para finalizar guardo la entidad empresa
            $em->persist($empresa);
            $em->flush();

            $this->get('session')->getFlashBag()->add('msg_success', 'Se ha elimiando al Chofer de la Empresa.');
        }
        
        return $this->redirect($this->generateUrl('empresa_show', array('razonSocial' => $razonSocial)));
    }










    /**
    * Creates a form to create a Empresa entity.
    *
    * @param Empresa $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Empresa $entity) {
        $form = $this->createForm(new EmpresaType(), $entity, array(
            'action' => $this->generateUrl('empresa_create'),
            'method' => 'POST',
            ));

        return $form;
    }

    /**
    * Creates a form to edit a Empresa entity.
    *
    * @param Empresa $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Empresa $entity) {
        $form = $this->createForm(new EmpresaType(), $entity, array(
            'action' => $this->generateUrl('empresa_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            ));

        return $form;
    }

}
