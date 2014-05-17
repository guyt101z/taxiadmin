<?php

namespace TaxiAdmin\EmpresaBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * EmpresaRepository
 *
 */
class EmpresaRepository extends EntityRepository {

    /**
     * obtengo todas las empresas
     */
    public function getIndexDQL($idUsuario){
        $sql = 'SELECT e
        FROM TaxiAdminEmpresaBundle:Empresa e
        WHERE e.idUsuario = :idUsuario'; 

        $params = array(
            'idUsuario' => $idUsuario,
            );

        $query = $this->getEntityManager()->createQuery($sql);
        $query->setParameters($params);

        return $query;
    }

}
