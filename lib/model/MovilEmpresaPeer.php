<?php

/**
 * Skeleton subclass for performing query and update operations on the 'movil_empresa' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Sat Mar 17 11:18:31 2012
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class MovilEmpresaPeer extends BaseMovilEmpresaPeer {

    /**
     * Retorna para una empresa y un estado de habilitado todos los moviles que esta tiene
     * @param int $idEmpresa identificador de la empresa
     * @param int $habilitados estado de la relación y está activa o no
     * @return MovilEmpresa[]
     */
    public static function getByEmpresa($idEmpresa, $habilitado) {
        $criteria = new Criteria();
        $criteria->add(MovilEmpresaPeer::IDEMPRESA, $idEmpresa);
        $criteria->add(MovilEmpresaPeer::HABILITADO, $habilitado);
        $listaMovilEmpresa = MovilEmpresaPeer::doSelect($criteria);
        return $listaMovilEmpresa;
    }

    /**
     * Para una empresa y movil retorna el objeto que representa esa relación
     * @param int $idEmpresa identificador empresa
     * @param int $idMovil identificador movil
     * @return MovilEmpresa en caso de no existir la relacion se retorna null
     */
    public static function getByMovilEmpresa($idEmpresa, $idMovil) {
        $criteria = new Criteria();
        $criteria->add(MovilEmpresaPeer::IDEMPRESA, $idEmpresa);
        $criteria->add(MovilEmpresaPeer::IDMOVIL, $idMovil);
        $empresaMovil = MovilEmpresaPeer::doSelectOne($criteria);
        return $empresaMovil;
    }

}

// MovilEmpresaPeer