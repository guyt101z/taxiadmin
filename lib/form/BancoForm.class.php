<?php

/**
 * Banco form.
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
class BancoForm extends BaseBancoForm {

    public function configure() {

        //retiro los atributos que no quiero que esten en el formulario
        unset($this['fechaAlta']);
        unset($this['fechaBaja']);
        unset($this['habilitado']);
        unset($this['usuario']);


        //Agrego las etiquetas
        $this->widgetSchema->setLabels(array(
            'nombre' => 'Nombre',
            'sucursal' => 'Sucursal',
            'direccion' => 'Dirección',
            'web' => 'Página Web',
        ));
    }

}
