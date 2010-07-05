<?php


/**
 * This class adds structure of 'af_automailer' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    plugins.afAutomailerPlugin.lib.model.map
 */
class AutomailerMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'plugins.afAutomailerPlugin.lib.model.map.AutomailerMapBuilder';

	/**
	 * The database map.
	 */
	private $dbMap;

	/**
	 * Tells us if this DatabaseMapBuilder is built so that we
	 * don't have to re-build it every time.
	 *
	 * @return     boolean true if this DatabaseMapBuilder is built, false otherwise.
	 */
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	/**
	 * Gets the databasemap this map builder built.
	 *
	 * @return     the databasemap
	 */
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	/**
	 * The doBuild() method builds the DatabaseMap
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap(AutomailerPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(AutomailerPeer::TABLE_NAME);
		$tMap->setPhpName('Automailer');
		$tMap->setClassname('Automailer');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('FROM_EMAIL', 'FromEmail', 'VARCHAR', true, 255);

		$tMap->addColumn('FROM_NAME', 'FromName', 'VARCHAR', false, 255);

		$tMap->addColumn('TO_EMAIL', 'ToEmail', 'VARCHAR', true, 255);

		$tMap->addColumn('SUBJECT', 'Subject', 'LONGVARCHAR', true, null);

		$tMap->addColumn('BODY', 'Body', 'LONGVARCHAR', true, null);

		$tMap->addColumn('ALT_BODY', 'AltBody', 'LONGVARCHAR', false, null);

		$tMap->addColumn('SENT_DATE', 'SentDate', 'TIMESTAMP', false, null);

		$tMap->addColumn('IS_SENT', 'IsSent', 'TINYINT', true, null);

		$tMap->addColumn('IS_HTML', 'IsHtml', 'TINYINT', true, null);

		$tMap->addColumn('IS_FAILED', 'IsFailed', 'TINYINT', true, null);

	} // doBuild()

} // AutomailerMapBuilder
