<?php

/**
 * movil actions.
 *
 * @package    taxi
 * @subpackage movil
 * @author     Brus
 */
class movilActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $idUsuario = $this->getUser()->getAttribute('id');

        $this->pager = new sfPropelPager('Movil', ConstantesFrontEnd::$CANTIDAD_MOVILES_PAGINADO);
        $this->pager->setCriteria(MovilPeer::getMovilesParaUsuarioCriteria($idUsuario));
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }

    public function executeShow(sfWebRequest $request) {
        $idUsuario = $this->getUser()->getAttribute('id');
        $idMovil = $request->getParameter('id');

        //traigo solo el móvil del usuario logueado
        $this->movil = MovilPeer::getMovilByPK($idMovil, $idUsuario);
        $this->csrfToken = $this->getCSRFToken();

        $this->forward404Unless($this->movil);
    }

    public function executeNew(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $this->form = new MovilForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->form = new MovilForm();
        return $this->altaMovil($request, $this->form);
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute('id');
        $idMovil = $request->getParameter('id');
        $this->forward404Unless($movil = MovilPeer::getMovilByPK($idMovil, $idUsuario), sprintf('Object movil does not exist (%s).', $idMovil));
        $this->form = new MovilForm($movil);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute("id");
        $idMovil = $request->getParameter('id');
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($movil = MovilPeer::getMovilByPK($idMovil, $idUsuario), sprintf('Object movil does not exist (%s).', $idMovil));
        $this->form = new MovilForm($movil);
        return $this->modificarMovil($request, $this->form);
    }

    public function executeErase(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute("id");
        $idMovil = $request->getParameter('id');
        $this->movil = MovilPeer::getMovilByPK($idMovil, $idUsuario);
    }

    public function executeDelete(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $request->checkCSRFProtection();

        $idUsuario = $this->getUser()->getAttribute("id");
        $idMovil = $request->getParameter('id');

        $this->forward404Unless($movil = MovilPeer::getMovilByPK($idMovil, $idUsuario), sprintf('Object móvil does not exist (%s).', $idMovil));
        //$movil->delete();
        $movil->setFechabaja(new DateTime());
        $movil->setHabilitado(FALSE);
        $movil->save();

        $respuesta_ajax = array(
            "ok" => "true",
            "url" => $this->getController()->genUrl('movil/index', TRUE)
        );

        return $this->renderText(json_encode($respuesta_ajax));
    }

    public function executeDetalleMovil(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute("id");
        $idMovil = $request->getParameter('id');
        $this->movil = MovilPeer::getMovilByPK($idMovil, $idUsuario);
        return $this->renderPartial('detalleMovil', array('movil' => $this->movil));
    }

    public function executeListaMoviles(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $this->moviles = MovilPeer::getMovilesParaUsuario($this->getUser()->getAttribute('id'));

        if (!$this->moviles) {
            return $this->renderText('No hay móviles creados.');
        }

        return $this->renderPartial('listaMoviles', array('moviles' => $this->moviles));
    }

    public function executeListaGastos(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute('id');
        $idMovil = $request->getParameter('id');

        $this->movil = MovilPeer::getMovilByPK($idMovil, $idUsuario);
        $this->csrfToken = $this->getCSRFToken();

        return $this->renderPartial('listaGastos', array('movil' => $this->movil, 'csrfToken' => $this->csrfToken));
    }

    public function executeListaMultas(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute('id');
        $idMovil = $request->getParameter('id');

        $this->movil = MovilPeer::getMovilByPK($idMovil, $idUsuario);
        $this->csrfToken = $this->getCSRFToken();

        return $this->renderPartial('listaMultas', array('movil' => $this->movil, 'csrfToken' => $this->csrfToken));
    }

    public function executeListaAccidentes(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute('id');
        $idMovil = $request->getParameter('id');

        $this->movil = MovilPeer::getMovilByPK($idMovil, $idUsuario);
        $this->csrfToken = $this->getCSRFToken();

        return $this->renderPartial('listaAccidentes', array('movil' => $this->movil, 'csrfToken' => $this->csrfToken));
    }

    public function executeListaTrabajosTaller(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute('id');
        $idMovil = $request->getParameter('id');

        $this->movil = MovilPeer::getMovilByPK($idMovil, $idUsuario);
        $this->csrfToken = $this->getCSRFToken();

        return $this->renderPartial('listaTrabajosTaller', array('movil' => $this->movil, 'csrfToken' => $this->csrfToken));
    }

    public function executeListaUltimasRecaudaciones(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute('id');
        $idMovil = $request->getParameter('id');
        $this->movil = MovilPeer::getMovilByPK($idMovil, $idUsuario);
        return $this->renderPartial('listaUltimasRecaudaciones', array('movil' => $this->movil));
    }

    //***************************  LOGICA  ****************************//

    protected function altaMovil(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        // si el formulario es válido, sigo con el alta
        if ($form->isValid()) {
            $movil = $this->form->getValues();

            // paso la matricula toda a mayuscula las letras
            $matriculaM = strtoupper($movil['matricula']);

            // verifico que no exista para ese usuario otro movil con la misma matricula
            if (MovilPeer::getMovilByMatricula($matriculaM, $this->getUser()->getAttribute('id')) == null) {
                $Movil = new Movil();
                $Movil->setAnio($movil['anio']);
                $Movil->setCombustible($movil['combustible']);
                $Movil->setIddespacho($movil['idDespacho']);
                $Movil->setKminiciales($movil['kmIniciales']);
                $Movil->setMarca($movil['marca']);
                $Movil->setMatricula($matriculaM);
                $Movil->setModelo($movil['modelo']);
                $Movil->setNumerochasis($movil['numeroChasis']);
                $Movil->setNumeromovil($movil['numeroMovil']);
                $Movil->setIdaseguradora($movil['idAseguradora']);
                $Movil->setFechaalta(new DateTime());
                $Movil->setHabilitado(TRUE);
                $Movil->setUsuario($this->getUser()->getAttribute('id'));
                $Movil->save();

                // si lo puedo guardar sin problemas ahora creo el evento para registrar el alta
                Evento::crearEvento($Movil->getUsuario(), "Se creo un nuevo movil id " . $Movil->getId());

                $respuesta_ajax = array(
                    "ok" => "true",
                    "url" => $this->getController()->genUrl('movil/index', TRUE)
                );
            } else {
                // si ya existe la matrícula, también lo envio a la página de alta con un mensaje de error
                $respuesta_ajax = array(
                    "ok" => "false",
                    "tip" => "La matrícula ya existe en el sistema."
                );
            }
        } else {
            // sino es válido, envío al usuario nuevamente a la página de alta con un mensaje de error
            $respuesta_ajax = array(
                "ok" => "false",
                "tip" => "Error al guardar los datos, por favor verifíquelos y vuelva a intentar."
            );
        }

        return $this->renderText(json_encode($respuesta_ajax));
    }

    protected function modificarMovil(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        if ($form->isValid()) {
            $Movil = $form->save();

            // si lo puedo guardar sin problemas ahora creo el evento para registrar el alta
            Evento::crearEvento($Movil->getUsuario(), "Se modificó el móvil id " . $Movil->getId());

            $respuesta_ajax = array(
                "ok" => "true",
                "message" => "Móvil modificado OK."
            );
        } else {
            $respuesta_ajax = array(
                "ok" => "false",
                "tip" => "Error al procesar los datos, verifique e intente nuevamente."
            );
        }

        return $this->renderText(json_encode($respuesta_ajax));
    }

    private function getCSRFToken() {
        // Token CSRF
        $baseForm = new BaseForm();
        return $baseForm->getCSRFToken();
    }

    public function executeImprimirMovilesPDF() {
        $titulo = 'Listado de Móviles';
        $subject = 'Listado completo de móviles';
        $fileName = 'ListadoMoviles.pdf';

        // ---------------------------------------------------------

        $idUsuario = $this->getUser()->getAttribute("id");
        $moviles = MovilPeer::getMovilesParaUsuario($idUsuario);

        $html = '<h1>' . $titulo . '</h1>';
        $html .= '<table border="0"><thead><tr>';
        $html .= '<th><b>' . EtiquetasFrontEnd::$MATRICULA . '</b></th>';
        $html .= '<th><b>' . EtiquetasFrontEnd::$MARCA . '</b></th>';
        $html .= '<th><b>' . EtiquetasFrontEnd::$MODELO . '</b></th>';
        $html .= '<th><b>' . EtiquetasFrontEnd::$ANIO . '</b></th>';
        $html .= '<th><b>' . EtiquetasFrontEnd::$COMBUSTIBLE . '</b></th>';
        $html .= '</tr></thead><tbody>';

        foreach ($moviles as $movil) {
            $html .= '<tr>';
            $html .= '<td>' . $movil->getMatricula() . '</td>';
            $html .= '<td>' . $movil->getMarca() . '</td>';
            $html .= '<td>' . $movil->getModelo() . '</td>';
            $html .= '<td>' . $movil->getAnio() . '</td>';
            $html .= '<td>' . $movil->getCombustible() . '</td>';
            $html .= '</tr>';
        }
        $html .= '</tbody></table>';

        // ---------------------------------------------------------

        UtilFrontEnd::imprimirPDF($titulo, $subject, $fileName, $html);
    }

    public function executeImprimirMovilPDF(sfWebRequest $request) {
        $this->getContext()->getConfiguration()->loadHelpers('Partial');
        
        $titulo = 'Información del Móvil';
        $subject = 'Detalle completo del móvil';
        $fileName = 'InformacionMovil.pdf';

        // ---------------------------------------------------------

        $idUsuario = $this->getUser()->getAttribute("id");
        $idMovil = $request->getParameter('id');

        $movil = MovilPeer::getMovilByPK($idMovil, $idUsuario);
        $this->forward404Unless($movil);

        $html = '<h1>' . $titulo . '</h1>';
        $html .= get_partial('imprimirMovilPDF', array('movil' => $movil));

        // ---------------------------------------------------------

        UtilFrontEnd::imprimirPDF($titulo, $subject, $fileName, $html);
    }

}