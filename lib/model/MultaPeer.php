<?php

/**
 * Skeleton subclass for performing query and update operations on the 'multa' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Sat Mar 17 11:18:29 2012
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class MultaPeer extends BaseMultaPeer {

    public static function getMultaByPK($pk, $idUsuario) {
        $criteria = new Criteria();
        $criteria->add(MultaPeer::ID, $pk);
        $criteria->add(MultaPeer::USUARIO, $idUsuario);
        $multa = MultaPeer::doSelectOne($criteria);
        return $multa;
    }

    public static function getMultasVencimiento($idUsuario) {
        $criteria = new Criteria();
        $criteria->add(MultaPeer::USUARIO, $idUsuario);
        $criteria->add(MultaPeer::HABILITADO, TRUE);
        $criteria->add(MultaPeer::PAGO, FALSE);
        $criteria->add(MultaPeer::FECHAVENCIMIENTO, time() + 86400 * ConstantesFrontEnd::$CANTIDAD_DIAS_VENCIMIENTOS, Criteria::LESS_THAN);
        $multas = MultaPeer::doSelect($criteria);
        return $multas;
    }

}

// MultaPeer