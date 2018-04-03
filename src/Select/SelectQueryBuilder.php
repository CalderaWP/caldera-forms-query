<?php


namespace calderawp\CalderaFormsQuery\Select;
use calderawp\CalderaFormsQuery\DoesQueries;
use calderawp\CalderaFormsQuery\MySqlBuilder;
use NilPortugues\Sql\QueryBuilder\Manipulation\Select;

abstract class SelectQueryBuilder implements DoesQueries, DoesSelectQuery
{
	const ASC = 'ASC';
	const DESC = 'DESC';

	/**
	 * @var MySqlBuilder
	 */
	private $builder;

	/**
	 * @var Select
	 */
	private $query;

	/**
	 * @var bool
	 */
	protected $isLike = false;

	/**
	 * @var string
	 */
	private  $tableName;


	/**
	 * SelectQueryBuilder constructor.
	 * @param MySqlBuilder $builder Query builder
	 * @param string $tableName Name of table
	 */
	public function __construct( MySqlBuilder $builder, $tableName )
	{
		$this->builder = $builder;
		$this->tableName = $tableName;
	}

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


	/** @inheritdoc */
	public function getSelectQuery(){

		if (empty($this->query)) {
			$this->query = new \NilPortugues\Sql\QueryBuilder\Manipulation\Select($this->getTableName());

		}
		return $this->query;
	}

	/** @inheritdoc */
	public function getPreparedSql(){
		return $this->substituteValues( $this->getBuilder()->write( $this->getSelectQuery() ));
	}

	/**
	 * @param string $column Column to orderby.
	 * @param bool $ascending Optional. To use ascending order? If false, descending is used. True is the default.
	 * @return $this
	 */
	public function addOrderBy( $column, $ascending = true ){
		$order = $ascending ? self::ASC : self::DESC;
		$this->getSelectQuery()->orderBy( $column, $order );
		return $this;
	}

	/**
	 * Generate query for where column is value
	 *
	 * @param string $column
	 * @param string $value
	 * @return $this
	 */
	protected function is($column, $value )
	{
		$this->getSelectQuery()
			->where()
			->equals( $column, $value );
		return $this;
	}


	/**
	 * Replace all substitutions with actual values
	 *
	 * @param string $sql SQL query with substitutions
	 * @return string
	 */
	protected function substituteValues( $sql )
	{
		$values = $this->builder->getValues();
		foreach ( $values as $identifier => $value ) {
			$values[ $identifier ] = $this->surroundValue( $value );
		}
		return str_replace( array_keys( $values ), array_values( $values ), $sql ) ;
	}

	/**
	 * @return string
	 */
	protected function getDeliminator()
	{
		return $this->isLike ? '%' : "'";
	}

	/**
	 * Surround one value with quotes or %
	 *
	 * @param string $value Value to surround
	 * @return string
	 */
	protected function surroundValue( $value ){
		return "{$this->getDeliminator()}$value{$this->getDeliminator()}";
	}




}