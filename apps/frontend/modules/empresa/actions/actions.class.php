<?php

/**
 * empresa actions.
 *
 * @package    taxi
 * @subpackage empresa
 * @author     Brus
 */
class empresaActions extends sfActions {

    //** Páginas **//

    public function executeIndex(sfWebRequest $request) {
        $idUsuario = $this->getUser()->getAttribute('id');

        $this->pager = new sfPropelPager('Empresa', ConstantesFrontEnd::$CANTIDAD_EMPRESAS_PAGINADO);
        $this->pager->setCriteria(EmpresaPeer::getEmpresasParaUsuarioCriteria($idUsuario));
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }

    public function executeShow(sfWebRequest $request) {
        $idUsuario = $this->getUser()->getAttribute('id');
        $idEmpresa = $request->getParameter('id');

        $this->empresa = EmpresaPeer::getEmpresaByPK($idEmpresa, $idUsuario);
        $this->csrfToken = $this->getCSRFToken();

        $this->forward404Unless($this->empresa);
    }

    public function executeNew(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $this->form = new EmpresaForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->form = new EmpresaForm();
        return $this->altaEmpresa($request, $this->form);
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute("id");
        $idEmpresa = $request->getParameter('id');
        $this->forward404Unless($empresa = EmpresaPeer::getEmpresaByPK($idEmpresa, $idUsuario), sprintf('Object empresa does not exist (%s).', $idEmpresa));
        $this->form = new EmpresaForm($empresa);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute("id");
        $idEmpresa = $request->getParameter('id');
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($empresa = EmpresaPeer::getEmpresaByPK($idEmpresa, $idUsuario), sprintf('Object empresa does not exist (%s).', $idEmpresa));
        $this->form = new EmpresaForm($empresa);
        return $this->modificarEmpresa($request, $this->form);
    }

    public function executeErase(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute('id');
        $idEmpresa = $request->getParameter('id');
        $this->empresa = EmpresaPeer::getEmpresaByPK($idEmpresa, $idUsuario);
    }

    public function executeDelete(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $request->checkCSRFProtection();

        $idUsuario = $this->getUser()->getAttribute("id");
        $idEmpresa = $request->getParameter('id');

        $this->forward404Unless($empresa = EmpresaPeer::getEmpresaByPK($idEmpresa, $idUsuario), sprintf('Object empresa does not exist (%s).', $idEmpresa));

        $empresa->setFechabaja(new DateTime());
        $empresa->setHabilitado(FALSE);
        $empresa->save();

        $respuesta_ajax = array(
            "ok" => "true",
            "url" => $this->getController()->genUrl('empresa/index', TRUE)
        );

        return $this->renderText(json_encode($respuesta_ajax));
    }

    public function executeAgregarPropietario(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute('id');
        $idEmpresa = $request->getParameter('id');
        $this->empresa = EmpresaPeer::getEmpresaByPK($idEmpresa, $idUsuario);
        $this->propietarios = $this->empresa->getPropietariosSinRelacion($idUsuario);
    }

    public function executeGuardarPropietario(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        return $this->agregarPropietarios($request->getParameter('ids'), $request->getParameter('id'), $this->getUser()->getAttribute('id'));
    }

    public function executeQuitarPropietario(sfWebRequest $request) {
        $this->deshabilitarPropietario($request->getParameter('ide'), $request->getParameter('idp'));
    }

    public function executeAgregarChofer(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute('id');
        $idEmpresa = $request->getParameter('id');
        $this->empresa = EmpresaPeer::getEmpresaByPK($idEmpresa, $idUsuario);
        $this->choferes = $this->empresa->getChoferesSinRelacion($idUsuario);
    }

    public function executeGuardarChofer(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        return $this->agregarChofer($request->getParameter('ids'), $request->getParameter('id'), $this->getUser()->getAttribute('id'));
    }

    public function executeQuitarChofer(sfWebRequest $request) {
        $this->deshabilitarChofer($request->getParameter('ide'), $request->getParameter('idc'));
    }

    public function executeAgregarMovil(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute('id');
        $idEmpresa = $request->getParameter('id');
        $this->empresa = EmpresaPeer::getEmpresaByPK($idEmpresa, $idUsuario);
        $this->moviles = $this->empresa->getMovilesSinRelacion($idUsuario);
    }

    public function executeGuardarMovil(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        return $this->agregarMovil($request->getParameter('ids'), $request->getParameter('id'), $this->getUser()->getAttribute('id'));
    }

    public function executeQuitarMovil(sfWebRequest $request) {
        $this->deshabilitarMovil($request->getParameter('ide'), $request->getParameter('idm'));
    }

    public function executeListaEmpresas(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute('id');
        $this->empresas = EmpresaPeer::getByUsuario($idUsuario);
        return $this->renderPartial('listaEmpresas', array('empresas' => $this->empresas));
    }

    public function executeListaGastos(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute('id');
        $idEmpresa = $request->getParameter('id');

        $this->empresa = EmpresaPeer::getEmpresaByPK($idEmpresa, $idUsuario);
        $this->csrfToken = $this->getCSRFToken();

        return $this->renderPartial('listaGastos', array('empresa' => $this->empresa, 'csrfToken' => $this->csrfToken));
    }

    public function executeDetalleEmpresa(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute('id');
        $idEmpresa = $request->getParameter('id');
        $this->empresa = EmpresaPeer::getEmpresaByPK($idEmpresa, $idUsuario);
        return $this->renderPartial('detalleEmpresa', array('empresa' => $this->empresa));
    }

    public function executeListaPropietarios(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute('id');
        $idEmpresa = $request->getParameter('id');
        $this->empresa = EmpresaPeer::getEmpresaByPK($idEmpresa, $idUsuario);
        return $this->renderPartial('listaPropietarios', array('empresa' => $this->empresa));
    }

    public function executeListaMoviles(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute('id');
        $idEmpresa = $request->getParameter('id');
        $this->empresa = EmpresaPeer::getEmpresaByPK($idEmpresa, $idUsuario);
        return $this->renderPartial('listaMoviles', array('empresa' => $this->empresa));
    }

    public function executeListaChoferes(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute('id');
        $idEmpresa = $request->getParameter('id');
        $this->empresa = EmpresaPeer::getEmpresaByPK($idEmpresa, $idUsuario);
        return $this->renderPartial('listaChoferes', array('empresa' => $this->empresa));
    }

    //***************************  LOGICA  ****************************//
    //*** EMPRESA ***//
    protected function altaEmpresa(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        // si el formulario es válido, sigo con el alta
        if ($form->isValid()) {
            $empresa = $this->form->getValues();

            // verifico que no exista para ese usuario otra empresa con el mismo nombre o razon social
            /* esto ahora lo estoy haciendo con validator en el config del formulario, vamos a ver si funciona esto lo podemos sacar */
            if (EmpresaPeer::getEmpresaByNombreAndRazonSocial($empresa['nombre'], $empresa['razonSocial'], $this->getUser()->getAttribute('id')) == null) {
                $Empresa = new Empresa();
                $Empresa->setNombre($empresa['nombre']);
                $Empresa->setRazonsocial($empresa['razonSocial']);
                $Empresa->setIdbanco($empresa['idBanco']);
                $Empresa->setNumerocuenta($empresa['numeroCuenta']);
                $Empresa->setFechaalta(new DateTime());
                $Empresa->setHabilitado(TRUE);
                $Empresa->setUsuario($this->getUser()->getAttribute('id'));
                $Empresa->save();

                // si lo puedo guardar sin problemas ahora creo el evento para registrar el alta
                Evento::crearEvento($Empresa->getUsuario(), "Se creo una nueva empresa id " . $Empresa->getId());

                $respuesta_ajax = array(
                    "ok" => "true",
                    "url" => $this->getController()->genUrl('empresa/index', TRUE)
                );

                // ver por errores
                //if ($this->form->hasErrors()) {
                //$respuesta_ajax['tip'] = 'Nombre: ' . $this->form['nombre']->renderError();
                //}
            } else {
                // si ya existe el nombre o razon social, también lo envio a la página de alta con un mensaje de error
                $respuesta_ajax = array(
                    "ok" => "false",
                    "tip" => "El Nombre o Razón Social ya existe en el Sistema."
                );
            }
        } else {
            // sino es válido, envío al usuario nuevamente a la página de alta con un mensaje de error
            $respuesta_ajax = array(
                "ok" => "false",
                "tip" => "Error al procesar los datos, verifique e intente nuevamente."
            );
        }

        return $this->renderText(json_encode($respuesta_ajax));
    }

    protected function modificarEmpresa(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        if ($form->isValid()) {
            $Empresa = $form->save();

            //si lo puedo guardar sin problemas ahora creo el evento para registrar la modificación
            Evento::crearEvento($Empresa->getUsuario(), "Se modificó la empresa id " . $Empresa->getId());

            $respuesta_ajax = array(
                "ok" => "true"
            );
        } else {
            $respuesta_ajax = array(
                "ok" => "false",
                "tip" => "Error al procesar los datos, verifique e intente nuevamente."
            );
        }

        return $this->renderText(json_encode($respuesta_ajax));
    }

    //*** PROPIETARIO ***//
    protected function deshabilitarPropietario($empresa, $propietario) {
        try {
            // obtengo el objeto empresaPropietario
            $empresaPropietario = EmpresaPropietarioPeer::getByPropietariosEmpresa($empresa, $propietario);

            $empresaPropietario->setHabilitado(false);
            $empresaPropietario->setfechaBaja(new DateTime());
            $empresaPropietario->save();

            $this->getUser()->setFlash("msgPropietario", "Se quito el propietario exitosamente.");
        } catch (Exception $exc) {
            $this->getUser()->setFlash("errorPropietario", "Se generó un error al procesar su solicitud, intentelo nuevamente");
        }
        $this->redirect('empresa/show?id=' . $empresa);
    }

    protected function agregarPropietarios($ids, $idEmpresa, $idUsuario) {
        if ($ids) {
            foreach ($ids as $idPropietario) {
                $empresaPropietario = EmpresaPropietarioPeer::getByPropietariosEmpresa($idEmpresa, $idPropietario);
                // si no existe en la BD no creo
                if ($empresaPropietario == null) {
                    $empresaPropietario = new EmpresaPropietario();
                    $empresaPropietario->setIdpropietario($idPropietario);
                    $empresaPropietario->setIdempresa($idEmpresa);

                    $empresaPropietario->setUsuario($idUsuario);
                    $empresaPropietario->setFechaalta(new DateTime());
                    $empresaPropietario->setHabilitado(true);
                } else {
                    // si ya existe lo paso a habilitado
                    $empresaPropietario->setHabilitado(true);
                    $empresaPropietario->setFechabaja(null);
                }
                // guardo los cambios
                $empresaPropietario->save();
            }
        }

        $respuesta_ajax = array(
            "ok" => "true"
        );

        return $this->renderText(json_encode($respuesta_ajax));
    }

    //*** CHOFER ***//

    protected function agregarChofer($ids, $idEmpresa, $idUsuario) {
        if ($ids) {
            foreach ($ids as $idChofer) {
                $empresaChofer = ChoferEmpresaPeer::getByChoferEmpresa($idEmpresa, $idChofer);
                // si no existe en la BD lo creo
                if ($empresaChofer == null) {
                    $empresaChofer = new ChoferEmpresa();
                    $empresaChofer->setidChofer($idChofer);
                    $empresaChofer->setIdempresa($idEmpresa);

                    $empresaChofer->setUsuario($idUsuario);
                    $empresaChofer->setFechaalta(new DateTime());
                    $empresaChofer->setHabilitado(true);
                } else {
                    // si ya existe lo paso a habilitado
                    $empresaChofer->setHabilitado(true);
                    $empresaChofer->setFechabaja(null);
                }
                // guardo los cambios
                $empresaChofer->save();
            }
        }

        $respuesta_ajax = array(
            "ok" => "true"
        );

        return $this->renderText(json_encode($respuesta_ajax));
    }

    protected function deshabilitarChofer($idEmpresa, $idChofer) {
        // obtengo el objeto ChoferEmpresa
        $choferEmpresa = ChoferEmpresaPeer::getByChoferEmpresa($idEmpresa, $idChofer);

        $choferEmpresa->setHabilitado(false);
        $choferEmpresa->setfechaBaja(new DateTime());
        $choferEmpresa->save();

        $this->redirect('empresa/show?id=' . $idEmpresa);
    }

    //*** MOVIL ***//

    protected function agregarMovil($ids, $idEmpresa, $idUsuario) {
        if ($ids) {
            foreach ($ids as $idMovil) {
                $empresaMovil = MovilEmpresaPeer::getByMovilEmpresa($idEmpresa, $idMovil);
                // si no existe en la BD lo creo
                if ($empresaMovil == null) {
                    $empresaMovil = new MovilEmpresa();
                    $empresaMovil->setidMovil($idMovil);
                    $empresaMovil->setIdempresa($idEmpresa);

                    $empresaMovil->setUsuario($idUsuario);
                    $empresaMovil->setFechaalta(new DateTime());
                    $empresaMovil->setHabilitado(true);
                } else {
                    // si ya existe lo paso a habilitado
                    $empresaMovil->setHabilitado(true);
                    $empresaMovil->setFechabaja(null);
                }
                // guardo los cambios
                $empresaMovil->save();
            }
        }

        $respuesta_ajax = array(
            "ok" => "true"
        );

        return $this->renderText(json_encode($respuesta_ajax));
    }

    protected function deshabilitarMovil($idEmpresa, $idMovil) {

        try {
            // obtengo el objeto MovilEmpresa
            $movilEmpresa = MovilEmpresaPeer::getByMovilEmpresa($idEmpresa, $idMovil);

            $movilEmpresa->setHabilitado(false);
            $movilEmpresa->setfechaBaja(new DateTime());
            $movilEmpresa->save();

            $this->getUser()->setFlash("msgMovil", "Se quito el móvil exitosamente.");
        } catch (Exception $exc) {
            $this->getUser()->setFlash("errorMovil", "Se segeneró un error al procesar su solicitud, intentelo nuevamente");
        }
        $this->redirect('empresa/show?id=' . $idEmpresa);
    }

    public function executeImprimirEmpresasPDF() {
        $titulo = 'Listado de Empresas';
        $subject = 'Listado completo de empresas';
        $fileName = 'ListadoEmpresas.pdf';

        // ---------------------------------------------------------

        $idUsuario = $this->getUser()->getAttribute("id");
        $empresas = EmpresaPeer::getByUsuario($idUsuario);

        $html = '<h1>' . $titulo . '</h1>';
        $html .= '<table border="0"><thead><tr>';
        $html .= '<th><b>' . EtiquetasFrontEnd::$NOMBRE . '</b></th>';
        $html .= '<th><b>' . EtiquetasFrontEnd::$RAZON_SOCIAL . '</b></th>';
        $html .= '<th><b>' . EtiquetasFrontEnd::$CANTIDAD_PROPIETARIOS . '</b></th>';
        $html .= '<th><b>' . EtiquetasFrontEnd::$CANTIDAD_CHOFERES . '</b></th>';
        $html .= '<th><b>' . EtiquetasFrontEnd::$CANTIDAD_MOVILES . '</b></th>';
        $html .= '</tr></thead><tbody>';

        foreach ($empresas as $empresa) {
            $html .= '<tr>';
            $html .= '<td>' . $empresa->getNombre() . '</td>';
            $html .= '<td>' . $empresa->getRazonSocial() . '</td>';
            $html .= '<td>' . count($empresa->getPropietarios()) . '</td>';
            $html .= '<td>' . count($empresa->getChoferes()) . '</td>';
            $html .= '<td>' . count($empresa->getMoviles()) . '</td>';
            $html .= '</tr>';
        }
        $html .= '</tbody></table>';

        // ---------------------------------------------------------

        UtilFrontEnd::imprimirPDF($titulo, $subject, $fileName, $html);
    }

    private function getCSRFToken() {
        // Token CSRF
        $baseForm = new BaseForm();
        return $baseForm->getCSRFToken();
    }

}
