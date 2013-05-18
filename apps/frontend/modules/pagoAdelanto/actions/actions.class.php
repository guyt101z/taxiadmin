
<?php

/**
 * pagoAdelanto actions.
 *
 * @package    taxi
 * @subpackage pagoAdelanto
 * @author     Brus
 */
class pagoAdelantoActions extends sfActions {

    public function executeNew(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $this->form = new pagoAdelantoForm();

        // obtengo el id del adelanto al cual se le va a cargar el pago
        $idAdelanto = $request->getParameter('idAdelanto');

        // seteo la fecha de hoy y el id del adelanto
        $this->form->setDefault('fecha', date(ConstantesFrontEnd::$FORMAT_DATE));
        $this->form->setDefault('idAdelanto', $idAdelanto);
    }

    public function executeShow(sfWebRequest $request) {

        $idPago = $request->getParameter('idPago');
        $idUsuario = $this->getUser()->getAttribute("id");

        $this->pago = PagoAdelantoPeer::getPagoAdelantoByPK($idPago, $idUsuario);
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new pagoAdelantoForm();
        return $this->altaPagoAdelanto($request, $this->form);
    }

    public function executeErase(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
    }

    public function executeDelete(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $request->checkCSRFProtection();

        $idUsuario = $this->getUser()->getAttribute("id");
        $idpago = $request->getParameter("id");

        $this->forward404Unless($pago = PagoAdelantoPeer::getPagoAdelantoByPK($idpago, $idUsuario), sprintf('Object pago de Adelanto does not exist (%s).', $idpago));

        // deshabilito el pago 
        $pago->setFechabaja(new DateTime());
        $pago->setHabilitado(FALSE);
        $pago->save();

        // ahora al adelanto le reintegro el monto del pago
        $adelanto = $pago->getAdelanto();
        $adelanto->setSaldo($adelanto->getSaldo() + $pago->getMonto());
        $adelanto->save();

        $respuesta_ajax = array(
            "ok" => "true",
        );

        return $this->renderText(json_encode($respuesta_ajax));
    }

    //***************************  LOGICA  ****************************//

    protected function altaPagoAdelanto(sfWebRequest $request, sfForm $form) {

        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        // si el formulario es válido, sigo con el alta
        if ($form->isValid()) {
            $pago = $this->form->getValues();

            $pagoAdelanto = new PagoAdelanto();
            $pagoAdelanto->setIdadelanto($pago['idAdelanto']);
            $pagoAdelanto->setFecha($pago['fecha']);
            $pagoAdelanto->setMonto($pago['monto']);
            $pagoAdelanto->setDetalle($pago['detalle']);

            $pagoAdelanto->setFechaalta(new DateTime());
            $pagoAdelanto->setHabilitado(TRUE);
            $pagoAdelanto->setUsuario($this->getUser()->getAttribute('id'));
            $pagoAdelanto->save();

            $adelanto = $pagoAdelanto->getAdelanto();
            $saldo = $adelanto->getSaldo() - $pagoAdelanto->getMonto();
            $adelanto->setSaldo($saldo);
            $adelanto->save();

            // si lo puedo guardar sin problemas ahora creo el evento para registrar el alta
            Evento::crearEvento($pagoAdelanto->getUsuario(), "Se creo un nuevo pago de adelanto id " . $pagoAdelanto->getId());

            $respuesta_ajax = array(
                "ok" => "true",
            );
        } else {
            // sino es válido, envío al usuario nuevamente a la página de alta con un mensaje de error
            $respuesta_ajax = array(
                "ok" => "false",
                "tip" => "Error al guardar los datos, por favor verifíquelos y vuelva a intentar."
            );
        }

        return $this->renderText(json_encode($respuesta_ajax));
    }

}
