<?php


/**
 * This class defines the structure of the 'movil' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Mon Jun 10 22:16:04 2013
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class MovilTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.MovilTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('movil');
		$this->setPhpName('Movil');
		$this->setClassname('Movil');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('MATRICULA', 'Matricula', 'VARCHAR', true, 15, null);
		$this->addColumn('MARCA', 'Marca', 'VARCHAR', true, 20, null);
		$this->addColumn('MODELO', 'Modelo', 'VARCHAR', true, 20, null);
		$this->addColumn('ANIO', 'Anio', 'INTEGER', true, null, null);
		$this->addColumn('NUMEROCHASIS', 'Numerochasis', 'VARCHAR', false, 50, null);
		$this->addColumn('COMBUSTIBLE', 'Combustible', 'VARCHAR', true, 50, null);
		$this->addColumn('NUMEROMOVIL', 'Numeromovil', 'INTEGER', false, null, null);
		$this->addForeignKey('IDDESPACHO', 'Iddespacho', 'INTEGER', 'despacho', 'ID', true, null, null);
		$this->addColumn('KMINICIALES', 'Kminiciales', 'INTEGER', true, null, null);
		$this->addForeignKey('IDASEGURADORA', 'Idaseguradora', 'INTEGER', 'aseguradora', 'ID', false, null, null);
		$this->addColumn('FECHAALTA', 'Fechaalta', 'TIMESTAMP', true, null, null);
		$this->addColumn('FECHABAJA', 'Fechabaja', 'TIMESTAMP', false, null, null);
		$this->addColumn('HABILITADO', 'Habilitado', 'BOOLEAN', false, null, true);
		$this->addForeignKey('USUARIO', 'Usuario', 'INTEGER', 'usuario', 'ID', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Despacho', 'Despacho', RelationMap::MANY_TO_ONE, array('idDespacho' => 'id', ), null, null);
    $this->addRelation('Aseguradora', 'Aseguradora', RelationMap::MANY_TO_ONE, array('idAseguradora' => 'id', ), null, null);
    $this->addRelation('UsuarioRelatedByUsuario', 'Usuario', RelationMap::MANY_TO_ONE, array('usuario' => 'id', ), 'CASCADE', null);
    $this->addRelation('Multa', 'Multa', RelationMap::ONE_TO_MANY, array('id' => 'idMovil', ), 'CASCADE', null);
    $this->addRelation('Accidente', 'Accidente', RelationMap::ONE_TO_MANY, array('id' => 'idMovil', ), 'CASCADE', null);
    $this->addRelation('Recaudacion', 'Recaudacion', RelationMap::ONE_TO_MANY, array('id' => 'idMovil', ), 'CASCADE', null);
    $this->addRelation('Gastomovil', 'Gastomovil', RelationMap::ONE_TO_MANY, array('id' => 'idMovil', ), 'CASCADE', null);
    $this->addRelation('Pagoaseguradora', 'Pagoaseguradora', RelationMap::ONE_TO_MANY, array('id' => 'idMovil', ), 'CASCADE', null);
    $this->addRelation('Trabajotaller', 'Trabajotaller', RelationMap::ONE_TO_MANY, array('id' => 'idMovil', ), 'CASCADE', null);
    $this->addRelation('MovilAseguradora', 'MovilAseguradora', RelationMap::ONE_TO_ONE, array('id' => 'idMovil', ), 'CASCADE', null);
    $this->addRelation('MovilDespacho', 'MovilDespacho', RelationMap::ONE_TO_MANY, array('id' => 'idMovil', ), 'CASCADE', null);
    $this->addRelation('MovilEmpresa', 'MovilEmpresa', RelationMap::ONE_TO_MANY, array('id' => 'idMovil', ), 'CASCADE', null);
	} // buildRelations()

	/**
	 * 
	 * Gets the list of behaviors registered for this table
	 * 
	 * @return array Associative array (name => parameters) of behaviors
	 */
	public function getBehaviors()
	{
		return array(
			'symfony' => array('form' => 'true', 'filter' => 'true', ),
			'symfony_behaviors' => array(),
		);
	} // getBehaviors()

} // MovilTableMap
