<?php

/**
 * paginaInicial actions.
 *
 * @package    taxi
 * @subpackage paginaInicial
 * @author     Brus
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class paginaInicialActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $idUsuario = $this->getUser()->getAttribute("id");

        // Multas
        $this->multas = MultaPeer::getMultasVencimiento($idUsuario);

        // Libreta de Conducir
        $this->choferesLibretaConducir = ChoferPeer::getLibretasConducirVencimiento($idUsuario);

        // Carne de Salud
        $this->choferesCarneSalud = ChoferPeer::getCarneSaludVencimiento($idUsuario);
    }

    public function executeCalendario(sfWebRequest $request) {
        $idUsuario = $this->getUser()->getAttribute("id");

        // Multas
        $this->multas = MultaPeer::getMultasVencimiento($idUsuario);

        // Libreta de Conducir
        $this->choferesLibretaConducir = ChoferPeer::getLibretasConducirVencimiento($idUsuario);

        // Carne de Salud
        $this->choferesCarneSalud = ChoferPeer::getCarneSaludVencimiento($idUsuario);

        $this->vencimientos = "var vencimientos = [ ";

        foreach ($this->multas as $multa) {
            $date = DateTime::createFromFormat('d/m/Y', $multa->getFechaVencimiento());
            $anio = $date->format('Y');
            $mes = $date->format('m') - 1;
            $dia = $date->format('d');

            $this->vencimientos .= "{";
            $this->vencimientos .= "title: 'Vence Multa $" . $multa->getCosto() . "', ";
            $this->vencimientos .= "start: new Date(" . $anio . ", " . $mes . ", " . $dia . "), ";
            $this->vencimientos .= "allDay: false, ";
            $this->vencimientos .= "url: '" . $this->getController()->genUrl('multa/show?id=' . $multa->getId(), TRUE) . "'";
            $this->vencimientos .= "}, ";
        }
        foreach ($this->choferesLibretaConducir as $chofer) {
            $date = DateTime::createFromFormat('d/m/Y', $chofer->getVencimientoLibretaConducir());
            $anio = $date->format('Y');
            $mes = $date->format('m') - 1;
            $dia = $date->format('d');

            $this->vencimientos .= "{";
            $this->vencimientos .= "title: 'Vence Libreta de Conducir $" . ConstantesFrontEnd::$VALOR_LIBRETA_DE_CONDUCIR . "', ";
            $this->vencimientos .= "start: new Date(" . $anio . ", " . $mes . ", " . $dia . "), ";
            $this->vencimientos .= "allDay: false, ";
            $this->vencimientos .= "url: '" . $this->getController()->genUrl('chofer/show?id=' . $chofer->getId(), TRUE) . "'";
            $this->vencimientos .= "}, ";
        }
        foreach ($this->choferesCarneSalud as $chofer) {
            $date = DateTime::createFromFormat('d/m/Y', $chofer->getVencimientocarnesalud());
            $anio = $date->format('Y');
            $mes = $date->format('m') - 1;
            $dia = $date->format('d');

            $this->vencimientos .= "{";
            $this->vencimientos .= "title: 'Vence Carné de Salud $" . ConstantesFrontEnd::$VALOR_CARNE_DE_SALUD . "', ";
            $this->vencimientos .= "start: new Date(" . $anio . ", " . $mes . ", " . $dia . "), ";
            $this->vencimientos .= "allDay: false, ";
            $this->vencimientos .= "url: '" . $this->getController()->genUrl('chofer/show?id=' . $chofer->getId(), TRUE) . "'";
            $this->vencimientos .= "}, ";
        }

        $this->vencimientos .= " ]";
    }

    public function executeListaVencimientos(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute('id');

        // Multas
        $this->multas = MultaPeer::getMultasVencimiento($idUsuario);

        // Libreta de Conducir
        $this->choferesLibretaConducir = ChoferPeer::getLibretasConducirVencimiento($idUsuario);

        // Libreta de Conducir
        $this->choferesCarneSalud = ChoferPeer::getCarneSaludVencimiento($idUsuario);

        return $this->renderPartial('listaVencimientos', array('multas' => $this->multas, 'choferesLibretaConducir' => $this->choferesLibretaConducir, 'choferesCarneSalud' => $this->choferesCarneSalud));
    }

    //***************************  LOGICA  ****************************//

    public function executeImprimirVencimientosPDF() {
        $titulo = 'Listado de Vencimientos - ' . date(ConstantesFrontEnd::$FORMAT_DATE);
        $subject = 'Listado completo de vencimientos';
        $fileName = 'ListadoVencimientos.pdf';

        // ---------------------------------------------------------

        $idUsuario = $this->getUser()->getAttribute("id");
        $multas = MultaPeer::getMultasVencimiento($idUsuario);
        $choferesLibretaConducir = ChoferPeer::getLibretasConducirVencimiento($idUsuario);
        $choferesCarneSalud = ChoferPeer::getCarneSaludVencimiento($idUsuario);

        $html = '<h1>' . $titulo . '</h1>';
        $html .= '<table><thead><tr>';
        $html .= '<th><b>' . EtiquetasFrontEnd::$DOCUMENTO . '</b></th>';
        $html .= '<th><b>' . EtiquetasFrontEnd::$FECHA_DE_VENCIMIENTO . '</b></th>';
        $html .= '<th><b>' . EtiquetasFrontEnd::$PERTENECE_A . '</b></th>';
        $html .= '<th><b>' . EtiquetasFrontEnd::$IMPORTE . '</b></th>';
        $html .= '</tr></thead><tbody>';

        foreach ($multas as $multa) {
            $html .= '<tr>';
            $html .= '<td>Multa</td>';
            $html .= '<td>' . $multa->getFechaVencimiento() . '</td>';
            $html .= '<td>' . $multa->getMovil()->getMatricula() . '</td>';
            $html .= '<td>' . $multa->getCosto() . '</td>';
            $html .= '</tr>';
        }
        foreach ($choferesLibretaConducir as $chofer) {
            $html .= '<tr>';
            $html .= '<td>Libreta de Conducir</td>';
            $html .= '<td>' . $chofer->getVencimientoLibretaConducir() . '</td>';
            $html .= '<td>' . $chofer->getNombreCompleto() . '</td>';
            $html .= '<td>' . ConstantesFrontEnd::$VALOR_LIBRETA_DE_CONDUCIR . '</td>';
            $html .= '</tr>';
        }
        foreach ($choferesCarneSalud as $chofer) {
            $html .= '<tr>';
            $html .= '<td>Carné de Salud</td>';
            $html .= '<td>' . $chofer->getVencimientocarnesalud() . '</td>';
            $html .= '<td>' . $chofer->getNombreCompleto() . '</td>';
            $html .= '<td>' . ConstantesFrontEnd::$VALOR_CARNE_DE_SALUD . '</td>';
            $html .= '</tr>';
        }

        $html .= '</tbody></table>';

        // ---------------------------------------------------------

        UtilFrontEnd::imprimirPDF($titulo, $subject, $fileName, $html);
    }

}
