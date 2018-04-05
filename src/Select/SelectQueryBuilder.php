<?php


namespace calderawp\CalderaFormsQuery\Select;

use calderawp\CalderaFormsQuery\CreatesSqlQueries;
use calderawp\CalderaFormsQuery\MySqlBuilder;
use calderawp\CalderaFormsQuery\QueryBuilder;
use NilPortugues\Sql\QueryBuilder\Manipulation\AbstractBaseQuery;
use NilPortugues\Sql\QueryBuilder\Manipulation\Delete;
use NilPortugues\Sql\QueryBuilder\Manipulation\Select;

abstract class SelectQueryBuilder extends QueryBuilder implements DoesSelectQuery
{

	/**
	 * @var Select
	 */
	private $selectQuery;

	/** @inheritdoc */
	public function getSelectQuery()
	{

		if (empty($this->selectQuery)) {
			$this->setNewQuery();
		}
		return $this->selectQuery;
	}

	/**
	 * @return Select
	 */
	protected function getCurrentQuery()
	{
		return $this->getSelectQuery();
	}

	/**
	 * @param string $column Column to orderby.
	 * @param bool $ascending Optional. To use ascending order? If false, descending is used. True is the default.
	 * @return $this
	 */
	public function addOrderBy($column, $ascending = true)
	{
		$order = $ascending ? self::ASC : self::DESC;
		$this->getCurrentQuery()->orderBy($column, $order);
		return $this;
	}


	/** @inheritdoc */
	public function resetQuery()
	{
		$this->setNewQuery();
		return $this;
	}

	private function setNewQuery()
	{
		$this->selectQuery = new \NilPortugues\Sql\QueryBuilder\Manipulation\Select($this->getTableName());
	}
}
