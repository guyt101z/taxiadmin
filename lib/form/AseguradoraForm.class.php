<?php

/**
 * Aseguradora form.
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
class AseguradoraForm extends BaseAseguradoraForm {

    public function configure() {
        //retiro los atributos que no quiero que esten en el formulario
        unset($this['fechaAlta']);
        unset($this['fechaBaja']);
        unset($this['habilitado']);
        unset($this['usuario']);
        unset($this['pagoaseguradora_list']);
    }

}
