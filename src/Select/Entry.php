<?php


namespace calderawp\CalderaFormsQuery\Select;

/**
 * Class Entry
 * @package calderawp\CalderaFormsQuery\Select
 */
class Entry extends SelectQueryBuilder
{


	/**
	 * Get all entries for a specific form
	 *
	 * @param string $formId Form Id
	 * @return $this
	 */
	public function queryByFormsId($formId)
	{
		return $this->is('form_id', $formId);
	}

	/**
	 * Get entry by ID
	 *
	 * @param int $entryId Entry ID
	 * @return $this
	 */
	public function queryByEntryId($entryId)
	{
		return $this->is('id', $entryId);
	}

	/**
	 * Query by entry ids
	 *
	 * @param array $entryIds An array of IDs to query by
	 *
	 * @return $this
	 */
	public function queryByEntryIds(array $entryIds)
	{
		$this
			->getSelectQuery()
			->where()
			->in( 'id', $entryIds );
		return $this;
	}

	/**
	 * Get all entries for a specific user
	 *
	 * @param int $userId
	 * @return $this
	 */
	public function queryByUserId($userId)
	{
		return $this->is('user_id', $userId);
	}
}
