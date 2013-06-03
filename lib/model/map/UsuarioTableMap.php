<?php


/**
 * This class defines the structure of the 'usuario' table.
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
class UsuarioTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.UsuarioTableMap';

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
		$this->setName('usuario');
		$this->setPhpName('Usuario');
		$this->setClassname('Usuario');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('TIPO', 'Tipo', 'VARCHAR', true, 20, null);
		$this->addColumn('NOMBRE', 'Nombre', 'VARCHAR', true, 20, null);
		$this->addColumn('APELLIDOS', 'Apellidos', 'VARCHAR', true, 30, null);
		$this->addColumn('CELULAR', 'Celular', 'VARCHAR', false, 15, null);
		$this->addColumn('TELEFONO', 'Telefono', 'VARCHAR', false, 15, null);
		$this->addColumn('DIRECCION', 'Direccion', 'VARCHAR', true, 100, null);
		$this->addColumn('EMAIL', 'Email', 'VARCHAR', true, 100, null);
		$this->addColumn('CLAVE', 'Clave', 'VARCHAR', true, 32, null);
		$this->addColumn('FECHAALTA', 'Fechaalta', 'TIMESTAMP', true, null, null);
		$this->addColumn('FECHABAJA', 'Fechabaja', 'TIMESTAMP', false, null, null);
		$this->addColumn('HABILITADO', 'Habilitado', 'BOOLEAN', true, null, true);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Propietario', 'Propietario', RelationMap::ONE_TO_MANY, array('id' => 'usuario', ), 'CASCADE', null);
    $this->addRelation('Banco', 'Banco', RelationMap::ONE_TO_MANY, array('id' => 'usuario', ), 'CASCADE', null);
    $this->addRelation('Empresa', 'Empresa', RelationMap::ONE_TO_MANY, array('id' => 'usuario', ), 'CASCADE', null);
    $this->addRelation('Taller', 'Taller', RelationMap::ONE_TO_MANY, array('id' => 'usuario', ), 'CASCADE', null);
    $this->addRelation('Aseguradora', 'Aseguradora', RelationMap::ONE_TO_MANY, array('id' => 'usuario', ), 'CASCADE', null);
    $this->addRelation('Despacho', 'Despacho', RelationMap::ONE_TO_MANY, array('id' => 'usuario', ), 'CASCADE', null);
    $this->addRelation('Chofer', 'Chofer', RelationMap::ONE_TO_MANY, array('id' => 'usuario', ), 'CASCADE', null);
    $this->addRelation('Movil', 'Movil', RelationMap::ONE_TO_MANY, array('id' => 'usuario', ), 'CASCADE', null);
    $this->addRelation('Multa', 'Multa', RelationMap::ONE_TO_MANY, array('id' => 'usuario', ), 'CASCADE', null);
    $this->addRelation('Accidente', 'Accidente', RelationMap::ONE_TO_MANY, array('id' => 'usuario', ), 'CASCADE', null);
    $this->addRelation('Recaudacion', 'Recaudacion', RelationMap::ONE_TO_MANY, array('id' => 'usuario', ), 'CASCADE', null);
    $this->addRelation('Gastorecaudacion', 'Gastorecaudacion', RelationMap::ONE_TO_MANY, array('id' => 'usuario', ), 'CASCADE', null);
    $this->addRelation('Gastomovil', 'Gastomovil', RelationMap::ONE_TO_MANY, array('id' => 'usuario', ), 'CASCADE', null);
    $this->addRelation('Gastoempresa', 'Gastoempresa', RelationMap::ONE_TO_MANY, array('id' => 'usuario', ), 'CASCADE', null);
    $this->addRelation('Configuracion', 'Configuracion', RelationMap::ONE_TO_MANY, array('id' => 'idUsuario', ), 'CASCADE', null);
    $this->addRelation('Pagoaseguradora', 'Pagoaseguradora', RelationMap::ONE_TO_MANY, array('id' => 'usuario', ), 'CASCADE', null);
    $this->addRelation('Trabajotaller', 'Trabajotaller', RelationMap::ONE_TO_MANY, array('id' => 'usuario', ), 'CASCADE', null);
    $this->addRelation('Adelanto', 'Adelanto', RelationMap::ONE_TO_MANY, array('id' => 'usuario', ), 'CASCADE', null);
    $this->addRelation('Pagoadelanto', 'Pagoadelanto', RelationMap::ONE_TO_MANY, array('id' => 'usuario', ), 'CASCADE', null);
    $this->addRelation('EmpresaPropietario', 'EmpresaPropietario', RelationMap::ONE_TO_MANY, array('id' => 'usuario', ), 'CASCADE', null);
    $this->addRelation('MovilAseguradora', 'MovilAseguradora', RelationMap::ONE_TO_MANY, array('id' => 'usuario', ), 'CASCADE', null);
    $this->addRelation('MovilEmpresa', 'MovilEmpresa', RelationMap::ONE_TO_MANY, array('id' => 'usuario', ), 'CASCADE', null);
    $this->addRelation('ChoferEmpresa', 'ChoferEmpresa', RelationMap::ONE_TO_MANY, array('id' => 'usuario', ), 'CASCADE', null);
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

} // UsuarioTableMap