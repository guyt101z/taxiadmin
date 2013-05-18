<?php

class UtilFrontEnd {

    public static function formatoCedula($cedula) {

        $millon = substr($cedula, 0, 1);
        $mil = substr($cedula, 1, 3);
        $centena = substr($cedula, 4, 3);
        $verificador = substr($cedula, -1);

        return $millon . '.' . $mil . '.' . $centena . '-' . $verificador;
    }

    public static function formatoCelular($celular) {
        // ejemplo el siguiente numero de telefono 099652354
        $operadora = substr($celular, 0, 3);
        $miles = substr($celular, 3, 3);
        $centena = substr($celular, 6, 3);

        return $operadora . ' ' . $miles . ' ' . $centena; // 099 652 354
    }

    public static function formatoTelefono($telefono) {
        // ejemplo el siguiente numero de telefono 46228374
        $departamento = substr($telefono, 0, 1);
        $tres = substr($telefono, 1, 3);
        $dos = substr($telefono, 4, 2);
        $uno = substr($telefono, 6, 2);

        return $departamento . ' ' . $tres . ' ' . $dos . ' ' . $uno; // 4 622 83 74
    }

    public static function imprimirPDF($titulo, $subject, $fileName, $html) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        // pdf object
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor(PDF_AUTHOR);
        $pdf->SetTitle($titulo);
        $pdf->SetSubject($subject);
        $pdf->SetKeywords('Listado, PDF');

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO);

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        //set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        //set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        //set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // ---------------------------------------------------------
        // set default font subsetting mode
        $pdf->setFontSubsetting(TRUE);

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 10, '', TRUE);

        // Add a page
        $pdf->AddPage();

        // ---------------------------------------------------------
        // output some HTML code
        $pdf->writeHTML($html, TRUE, 0);

        // ---------------------------------------------------------
        // Close and output PDF document
        $pdf->Output($fileName, 'I');

        // Stop symfony process
        throw new sfStopException();
    }

}
