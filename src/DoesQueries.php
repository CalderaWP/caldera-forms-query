<?php


namespace calderawp\CalderaFormsQuery;

interface DoesQueries
{

	/**
	 * Get name of table being queried
	 *
	 * @return string
	 */
	public function getTableName();

	/**
	 * Get usable SQL statement from query builder
	 *
	 * @return string
	 */
	public function getPreparedSql();

	/**
	 * Get query builder instance
	 *
	 * @return MySqlBuilder
	 */
	public function getBuilder();
}
