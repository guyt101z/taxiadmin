<?php

/**
 * Skeleton subclass for representing a row from the 'gastoEmpresa' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Mon Jul 23 21:41:50 2012
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class Gastoempresa extends BaseGastoempresa {

    /**
     * Initializes internal state of Gastoempresa object.
     * @see        parent::__construct()
     */
    public function __construct() {
        // Make sure that parent constructor is always invoked, since that
        // is where any default values for this object are set.
        parent::__construct();
    }

    public function getFecha($format = 'Y-m-d') {
        // cambio el format por el que utilizamos en la aplicacion
        $format = ConstantesFrontEnd::$FORMAT_DATE;
        return parent::getFecha($format);
    }

}

// Gastoempresa
