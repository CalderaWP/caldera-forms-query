<?php


namespace calderawp\CalderaFormsQuery\Select;

class EntryValues extends SelectQueryBuilder
{


	/**
	 * Create query by entry ID
	 *
	 * @param $entryId
	 * @return $this
	 */
	public function queryByEntryId($entryId)
	{
		 $this
			->getSelectQuery()
			->where()
			->equals('entry_id', $entryId)
			;
		 return $this;
	}

	/**
	 * Create query for entry values with a field whose value equals, doesn't equal or is like (SQL LIKE) a value
	 *
	 * @param string $fieldSlug Field slug
	 * @param string $fieldValue Field value
	 * @param string $type Optional. Type of comparison. Values: equals|notEquals|like Default: 'equals'
	 * @param string $whereOperator Optional. Type of where. Default is 'AND'. Any valid WHERE operator is accepted
	 * @param array $columns Optional. Array of columns to select. Leave empty to select *
	 * @return $this
	 */
	public function queryByFieldValue($fieldSlug, $fieldValue, $type = 'equals', $whereOperator = 'AND', $columns = [])
	{
		if( ! empty( $columns ) ){
			$this
				->getSelectQuery()
				->setColumns( $columns );
		}
		switch ($type) {
			case 'equals':
				$this
					->getSelectQuery()
					->where($whereOperator)
					->equals('value', $fieldValue)
				;
				break;
			case 'notEquals':
				$this->
				getSelectQuery()
					->where($whereOperator)
					->notEquals('value', $fieldValue);
				break;
			case 'like':
				$this->
				getSelectQuery()
					->where($whereOperator)
					->like('value', $fieldValue);
				break;
		}

		$this->isLike = 'like' === $type ? true : false;

		if (!$this->isLike) {
			$this->getSelectQuery()->where('AND')->equals('slug', $fieldSlug);
		}

		return $this;
	}
}
