<?php


/**
 * This class defines the structure of the 'banco' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Sun May 26 12:23:22 2013
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class BancoTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.BancoTableMap';

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
		$this->setName('banco');
		$this->setPhpName('Banco');
		$this->setClassname('Banco');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('NOMBRE', 'Nombre', 'VARCHAR', false, 100, null);
		$this->addColumn('SUCURSAL', 'Sucursal', 'VARCHAR', false, 100, null);
		$this->addColumn('DIRECCION', 'Direccion', 'VARCHAR', false, 100, null);
		$this->addColumn('WEB', 'Web', 'VARCHAR', false, 100, null);
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
    $this->addRelation('UsuarioRelatedByUsuario', 'Usuario', RelationMap::MANY_TO_ONE, array('usuario' => 'id', ), 'CASCADE', null);
    $this->addRelation('Empresa', 'Empresa', RelationMap::ONE_TO_MANY, array('id' => 'idBanco', ), null, null);
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

} // BancoTableMap