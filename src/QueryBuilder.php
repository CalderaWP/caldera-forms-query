<?php


namespace calderawp\CalderaFormsQuery;


use calderawp\CalderaFormsQuery\Select\DoesSelectQuery;
use NilPortugues\Sql\QueryBuilder\Manipulation\AbstractBaseQuery;

abstract class QueryBuilder implements DoesQueries
{
	const ASC = 'ASC';
	const DESC = 'DESC';

	/**
	 * @var MySqlBuilder
	 */
	private $builder;

	/**
	 * @var bool
	 */
	protected $isLike = false;

	/**
	 * @var string
	 */
	private $tableName;


	/**
	 * SelectQueryBuilder constructor.
	 * @param MySqlBuilder $builder Query builder
	 * @param string $tableName Name of table
	 */
	public function __construct(MySqlBuilder $builder, $tableName)
	{
		$this->builder = $builder;
		$this->tableName = $tableName;
	}

	/**
	 * @return AbstractBaseQuery
	 */
	abstract protected function getCurrentQuery();

	/** @inheritdoc */
	public function getTableName()
	{
		return $this->tableName;
	}

	/** @inheritdoc */
	public function getBuilder()
	{
		return $this->builder;
	}

	/**
	 * Add a where $column equals $value clause to query
	 *
	 * @param AbstractBaseQuery $queryBuilder
	 * @param string $column
	 * @param string $value
	 * @return $this
	 */
	protected function addWhereEquals( AbstractBaseQuery $queryBuilder, $column, $value )
	{
		$queryBuilder
			->where()
			->equals($column, $value);
		return $this;
	}


	/**
	 * Replace all substitutions with actual values
	 *
	 * @param string $sql SQL query with substitutions
	 * @return string
	 */
	protected function substituteValues($sql)
	{
		$values = $this->getBuilder()->getValues();
		foreach ($values as $identifier => $value) {
			$values[$identifier] = $this->surroundValue($value);
		}
		return str_replace(array_keys($values), array_values($values), $sql);
	}

	/**
	 * @return string
	 */
	protected function getFirstDeliminator()
	{
		return $this->isLike ? "'%" : "'";
	}

	/**
	 * @return string
	 */
	protected function getSecondDeliminator()
	{
		return $this->isLike ? "%'" : "'";	}

	/**
	 * Surround one value with quotes or %
	 *
	 * @param string $value Value to surround
	 * @return string
	 */
	protected function surroundValue($value)
	{
		$value = "{$this->getFirstDeliminator()}$value{$this->getSecondDeliminator()}";
		if( ! $this->isLike){
			return $value;
		}
		return Escape::like( $value );
	}


	/**
	 * Generate query for where column is value
	 *
	 * @param string $column
	 * @param string $value
	 * @return $this
	 */
	protected function is($column, $value)
	{
		return $this->addWhereEquals($this->getCurrentQuery(),$column, $value);
	}

	/** @inheritdoc */
	public function getPreparedSql()
	{
		return $this->substituteValues($this->getBuilder()->write($this->getCurrentQuery()));
	}
}