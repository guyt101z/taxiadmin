<?php

/**
 * Taller form.
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
class TallerForm extends BaseTallerForm {

    public function configure() {
        //retiro los atributos que no quiero que esten en el formulario
        unset($this['fechaAlta']);
        unset($this['fechaBaja']);
        unset($this['habilitado']);
        unset($this['usuario']);
        unset($this['trabajo_taller_list']);
    }

}
