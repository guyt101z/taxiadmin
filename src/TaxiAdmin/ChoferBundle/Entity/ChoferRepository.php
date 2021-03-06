<?php

namespace TaxiAdmin\ChoferBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ChoferRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ChoferRepository extends EntityRepository {

    /**
     * obtengo todas los choferes para paginado
     */
    public function getIndexDQL($idUsuario){
        $sql = 'SELECT c
        FROM TaxiAdminChoferBundle:Chofer c
        WHERE c.idUsuario = :idUsuario'; 

        $params = array(
            'idUsuario' => $idUsuario,
            );

        $query = $this->getEntityManager()->createQuery($sql);
        $query->setParameters($params);

        return $query;
    }

    /**
     * obtengo todos los choferes que aún no estan asignados a esa empresa
     */
    public function getChoferesSinEmpresa($idUsuario, $razonSocial){
        $sql = 'SELECT c.id, c.nombre, c.apellido 
        FROM Chofer c
        WHERE c.idUsuario = :idUsuario AND c.id  NOT IN 
        ( SELECT ce.chofer_id FROM Empresa e, empresa_chofer ce WHERE e.razonSocial = :razonSocial AND ce.empresa_id = e.id )
        ORDER BY c.nombre ASC'; 
        $params = array(
            'idUsuario' => $idUsuario,
            'razonSocial' => $razonSocial,
            );

        return $this->getEntityManager()->getConnection()->executeQuery($sql, $params)->fetchAll();
    }
}
