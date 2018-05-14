<?php


namespace calderawp\CalderaFormsQuery\Select;

class EntryValues extends SelectQueryBuilder implements DoesSelectQueryByValue, DoesSelectQueryByEntryId
{


	/** @inheritdoc */
	public function queryByEntryId($entryId)
	{
		 $this
			->getSelectQuery()
			->where()
			->equals($this->getEntryIdColumn(), $entryId)
			;
		 return $this;
	}

	/** @inheritdoc */
	public function queryByFieldValue($fieldSlug, $fieldValue, $type = 'equals', $whereOperator = 'AND', $columns = [])
	{
		if (! empty($columns)) {
			$this
				->getSelectQuery()
				->setColumns($columns);
		}
		switch ($type) {
			case 'equals':
				$this
					->getSelectQuery()
					->where($whereOperator)
					->equals($this->getValueColumn(), $fieldValue)
				;
				break;
			case 'notEquals':
				$this->
				getSelectQuery()
					->where($whereOperator)
					->notEquals($this->getValueColumn(), $fieldValue);
				break;
			case 'like':
				$this->
				getSelectQuery()
					->where($whereOperator)
					->like($this->getValueColumn(), $fieldValue);
				break;
		}

		$this->isLike = 'like' === $type ? true : false;

		if (!$this->isLike) {
			$this->getSelectQuery()->where('AND')->equals('slug', $fieldSlug);
		}

		return $this;
	}

	/** @inheritdoc */
	public function getValueColumn()
	{
		return 'value';
	}

	/** @inheritdoc */
	public function getEntryIdColumn()
	{
		return 'entry_id';
	}
}
