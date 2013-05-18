<?php

/**
 * Despacho form.
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
class DespachoForm extends BaseDespachoForm {

    public function configure() {
        //retiro los atributos que no quiero que esten en el formulario
        unset($this['movil_despacho_list']);
        unset($this['fechaAlta']);
        unset($this['fechaBaja']);
        unset($this['habilitado']);
        unset($this['usuario']);
    }

}
