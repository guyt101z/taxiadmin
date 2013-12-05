<?php


/**
 * This class defines the structure of the 'pagoAdelanto' table.
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
class PagoadelantoTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.PagoadelantoTableMap';

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
		$this->setName('pagoAdelanto');
		$this->setPhpName('Pagoadelanto');
		$this->setClassname('Pagoadelanto');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('IDADELANTO', 'Idadelanto', 'INTEGER', 'adelanto', 'ID', true, null, null);
		$this->addColumn('FECHA', 'Fecha', 'DATE', true, null, null);
		$this->addColumn('MONTO', 'Monto', 'DECIMAL', true, 17, null);
		$this->addColumn('DETALLE', 'Detalle', 'VARCHAR', false, 150, null);
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
    $this->addRelation('Adelanto', 'Adelanto', RelationMap::MANY_TO_ONE, array('idAdelanto' => 'id', ), 'CASCADE', null);
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

} // PagoadelantoTableMap