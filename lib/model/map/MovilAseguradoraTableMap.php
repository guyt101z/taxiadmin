<?php


/**
 * This class defines the structure of the 'movil_aseguradora' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Mon Jun 10 22:16:06 2013
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class MovilAseguradoraTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.MovilAseguradoraTableMap';

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
		$this->setName('movil_aseguradora');
		$this->setPhpName('MovilAseguradora');
		$this->setClassname('MovilAseguradora');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('IDMOVIL', 'Idmovil', 'INTEGER' , 'movil', 'ID', true, null, null);
		$this->addForeignKey('IDASEGURADORA', 'Idaseguradora', 'INTEGER', 'aseguradora', 'ID', true, null, null);
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
    $this->addRelation('Movil', 'Movil', RelationMap::MANY_TO_ONE, array('idMovil' => 'id', ), 'CASCADE', null);
    $this->addRelation('Aseguradora', 'Aseguradora', RelationMap::MANY_TO_ONE, array('idAseguradora' => 'id', ), 'CASCADE', null);
    $this->addRelation('UsuarioRelatedByUsuario', 'Usuario', RelationMap::MANY_TO_ONE, array('usuario' => 'id', ), 'CASCADE', null);
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

} // MovilAseguradoraTableMap
