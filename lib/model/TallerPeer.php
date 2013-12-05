<?php

/**
 * Skeleton subclass for performing query and update operations on the 'taller' table.
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
class TallerPeer extends BaseTallerPeer {

    public static function getHabilitados() {
        $criteria = new Criteria();
        $criteria->add(TallerPeer::HABILITADO, true);
        $talleres = TallerPeer::doSelect($criteria);
        return $talleres;
    }

    public static function getTallerByPK($pk, $idUsuario) {
        $criteria = new Criteria();
        $criteria->add(TallerPeer::ID, $pk);
        $criteria->add(TallerPeer::USUARIO, $idUsuario);
        $taller = TallerPeer::doSelectOne($criteria);
        return $taller;
    }

}

// TallerPeer