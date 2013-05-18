<?php


/**
 * This class defines the structure of the 'multa' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Sat Oct  6 14:44:38 2012
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class MultaTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.MultaTableMap';

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
		$this->setName('multa');
		$this->setPhpName('Multa');
		$this->setClassname('Multa');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('IDCHOFER', 'Idchofer', 'INTEGER', 'chofer', 'ID', true, null, null);
		$this->addForeignKey('IDMOVIL', 'Idmovil', 'INTEGER', 'movil', 'ID', true, null, null);
		$this->addColumn('FECHA', 'Fecha', 'DATE', false, null, null);
		$this->addColumn('DESCRIPCION', 'Descripcion', 'VARCHAR', false, 200, null);
		$this->addColumn('ESQUINA', 'Esquina', 'VARCHAR', false, 200, null);
		$this->addColumn('RESPONSABLE', 'Responsable', 'VARCHAR', false, 100, null);
		$this->addColumn('COSTO', 'Costo', 'DECIMAL', false, 17, null);
		$this->addColumn('FECHAVENCIMIENTO', 'Fechavencimiento', 'DATE', false, null, null);
		$this->addColumn('PAGO', 'Pago', 'BOOLEAN', true, null, false);
		$this->addColumn('FECHAPAGO', 'Fechapago', 'DATE', false, null, null);
		$this->addColumn('FECHAALTA', 'Fechaalta', 'TIMESTAMP', false, null, null);
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
    $this->addRelation('Chofer', 'Chofer', RelationMap::MANY_TO_ONE, array('idChofer' => 'id', ), 'CASCADE', null);
    $this->addRelation('Movil', 'Movil', RelationMap::MANY_TO_ONE, array('idMovil' => 'id', ), 'CASCADE', null);
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

} // MultaTableMap
