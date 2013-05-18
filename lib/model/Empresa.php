<?php

/**
 * Skeleton subclass for representing a row from the 'empresa' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Sat Mar 17 11:18:28 2012
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class Empresa extends BaseEmpresa {

    /**
     * Initializes internal state of Empresa object.
     * @see        parent::__construct()
     */
    public function __construct() {
        // Make sure that parent constructor is always invoked, since that
        // is where any default values for this object are set.
        parent::__construct();
    }

    public function __toString() {
        return $this->getNombre();
    }

    public function getPropietarios() {
        $propietarios = array();

        $listaEmpresaPropietario = EmpresaPropietarioPeer::getByEmpresa($this->getId(), TRUE);
        foreach ($listaEmpresaPropietario as $empresaPropietario) {
            array_push($propietarios, $empresaPropietario->getPropietario());
        }

        return $propietarios;
    }

    public function getPropietariosSinRelacion($idUsuario) {
        return PropietarioPeer::getPropietariosSinRelacionConEmpresa($this->getId(), $idUsuario);
    }

    public function getMoviles() {
        $moviles = array();

        $listaMovilEmpresa = MovilEmpresaPeer::getByEmpresa($this->getId(), TRUE);
        foreach ($listaMovilEmpresa as $movilEmpresa) {
            array_push($moviles, $movilEmpresa->getMovil());
        }

        return $moviles;
    }

    public function getMovilesSinRelacion($idUsuario) {
        return MovilPeer::getMovilesSinRelacionConEmpresa($this->getId(), $idUsuario);
    }

    public function getChoferes() {
        $choferes = array();

        $listaChoferEmpresa = ChoferEmpresaPeer::getByEmpresa($this->getId(), TRUE);
        foreach ($listaChoferEmpresa as $choferEmpresa) {
            array_push($choferes, $choferEmpresa->getChofer());
        }

        return $choferes;
    }

    public function getChoferesSinRelacion($idUsuario) {
        return ChoferPeer::getChoferesSinRelacionConEmpresa($this->getId(), $idUsuario);
    }

    public function getGastos($criteria = null, PropelPDO $con = null) {
        if (!$criteria) {
            $criteria = new Criteria();
            $criteria->add(GastoempresaPeer::HABILITADO, TRUE);
        }

        return parent::getGastoempresas($criteria);
    }

}

// Empresa
