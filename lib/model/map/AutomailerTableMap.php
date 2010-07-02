<?php


/**
 * This class defines the structure of the 'automailer' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    plugins.afAutomailerPlugin.lib.model.map
 */
class AutomailerTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'plugins.afAutomailerPlugin.lib.model.map.AutomailerTableMap';

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
		$this->setName('automailer');
		$this->setPhpName('Automailer');
		$this->setClassname('Automailer');
		$this->setPackage('plugins.afAutomailerPlugin.lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('FROM_EMAIL', 'FromEmail', 'VARCHAR', true, 255, null);
		$this->addColumn('FROM_NAME', 'FromName', 'VARCHAR', false, 255, null);
		$this->addColumn('TO_EMAIL', 'ToEmail', 'VARCHAR', true, 255, null);
		$this->addColumn('SUBJECT', 'Subject', 'LONGVARCHAR', true, null, null);
		$this->addColumn('BODY', 'Body', 'LONGVARCHAR', true, null, null);
		$this->addColumn('ALT_BODY', 'AltBody', 'LONGVARCHAR', false, null, null);
		$this->addColumn('SENT_DATE', 'SentDate', 'TIMESTAMP', false, null, null);
		$this->addColumn('IS_SENT', 'IsSent', 'TINYINT', true, null, 0);
		$this->addColumn('IS_HTML', 'IsHtml', 'TINYINT', true, null, 0);
		$this->addColumn('IS_FAILED', 'IsFailed', 'TINYINT', true, null, 0);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
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

} // AutomailerTableMap
