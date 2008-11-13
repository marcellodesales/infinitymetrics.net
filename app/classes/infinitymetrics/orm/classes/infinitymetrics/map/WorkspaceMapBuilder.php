<?php


/**
 * This class adds structure of 'workspace' table to 'infinitymetricsm201' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    infinitymetrics.map
 */
class WorkspaceMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'infinitymetrics.map.WorkspaceMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(WorkspacePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(WorkspacePeer::TABLE_NAME);
		$tMap->setPhpName('Workspace');
		$tMap->setClassname('Workspace');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('WORKSPACE_ID', 'WorkspaceId', 'SMALLINT', true, null);

		$tMap->addColumn('STATE', 'State', 'CHAR', true, null);

		$tMap->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'user', 'USER_ID', true, null);

		$tMap->addColumn('TITLE', 'Title', 'VARCHAR', true, 64);

		$tMap->addColumn('DESCRIPTION', 'Description', 'VARCHAR', false, 255);

	} // doBuild()

} // WorkspaceMapBuilder
