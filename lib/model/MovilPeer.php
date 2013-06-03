<?php

/**
 * Skeleton subclass for performing query and update operations on the 'movil' table.
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
class MovilPeer extends BaseMovilPeer {

    // retorno todos los moviles para el id de usuario pasado
    public static function getMovilesParaUsuario($idUsuario) {
        $criteria = new Criteria();
        $criteria->add(MovilPeer::USUARIO, $idUsuario);
        $criteria->add(MovilPeer::HABILITADO, TRUE);
        $moviles = MovilPeer::doSelect($criteria);
        return $moviles;
    }

    public static function getMovilesParaUsuarioCriteria($idUsuario) {
        $criteria = new Criteria();
        $criteria->add(MovilPeer::USUARIO, $idUsuario);
        $criteria->add(MovilPeer::HABILITADO, TRUE);
        return $criteria;
    }

    public static function getMovilesSinRelacionConEmpresa($idEmpresa, $idUsuario) {
        $criteria = new Criteria();
        $criteria->add(MovilPeer::HABILITADO, TRUE);
        $criteria->add(MovilPeer::USUARIO, $idUsuario);
        $subSelect = "ID NOT IN (SELECT idMovil FROM movil_empresa WHERE habilitado = 1 AND idEmpresa = " . $idEmpresa . " AND usuario = " . $idUsuario . ")";
        $criteria->add(MovilPeer::ID, $subSelect, Criteria::CUSTOM);
        $moviles = MovilPeer::doSelect($criteria);
        return $moviles;
    }

    //retorna el movil si existe la matricual en la BD
    public static function getMovilByMatricula($matricula, $idUsuario) {
        $criteria = new Criteria();
        $criteria->setLimit(1);
        $criteria->add(MovilPeer::MATRICULA, $matricula);
        $criteria->add(MovilPeer::USUARIO, $idUsuario);

        $moviles = UsuarioPeer::doSelect($criteria);
        if (count($moviles) > 0) {
            return $moviles[0];
        } else {
            return null;
        }
    }

    public static function getMovilByPK($pk, $idUsuario) {
        $criteria = new Criteria();
        $criteria->add(MovilPeer::ID, $pk);
        $criteria->add(MovilPeer::USUARIO, $idUsuario);
        $movil = MovilPeer::doSelectOne($criteria);
        return $movil;
    }

}

// MovilPeer