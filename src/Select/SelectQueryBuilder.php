<?php


namespace calderawp\CalderaFormsQuery\Select;

use calderawp\CalderaFormsQuery\QueryBuilder;
use NilPortugues\Sql\QueryBuilder\Manipulation\Select;

abstract class SelectQueryBuilder extends QueryBuilder implements DoesSelectQuery, DoesSelectQueryByEntryId
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

	/** @inheritdoc */
	public function queryByEntryId($entryId)
	{
		return $this->is($this->getEntryIdColumn(), $entryId);

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

	/**
	 * @return Select
	 */
	protected function getCurrentQuery()
	{
		return $this->getSelectQuery();
	}


	/** @inheritdoc */
	public function resetQuery()
	{
		$this->setNewQuery();
		return $this;
	}

	/**
	 * Set new query in selectQuery prop
	 */
	private function setNewQuery()
	{
		$this->selectQuery = new \NilPortugues\Sql\QueryBuilder\Manipulation\Select($this->getTableName());
	}
}
