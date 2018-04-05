<?php


namespace calderawp\CalderaFormsQuery\Delete;


use calderawp\CalderaFormsQuery\QueryBuilder;
use NilPortugues\Sql\QueryBuilder\Manipulation\Delete;

abstract class DeleteQueryBuilder extends QueryBuilder implements DoesDeleteQuery
{

	/**
	 * @var Delete
	 */
	protected $deleteQuery;

	/**
	 * @return Delete
	 */
	public function getDeleteQuery()
	{
		if( ! $this->deleteQuery ){
			$this->deleteQuery = new Delete($this->getTableName());
		}

		return $this->deleteQuery;
	}

	/**
	 * @return Delete
	 */
	public function getCurrentQuery()
	{
		return $this->getDeleteQuery();
	}
}