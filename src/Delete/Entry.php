<?php


namespace calderawp\CalderaFormsQuery\Delete;


class Entry extends DeleteQueryBuilder
{

	/**
	 * Delete all entries with a specific form ID
	 *
	 * @param string $formId Form ID to delete entries of
	 * @return $this
	 */
	public function deleteByFormId($formId)
	{
		return $this->is('form_id', $formId);
	}

	/**
	 * Delete a specific entry by user ID
	 *
	 * @param $entryId
	 * @return $this
	 */
	public function deleteByEntryId($entryId)
	{
		return $this->is('id', $entryId);
	}

	/**
	 * Delete entries belonging to a specific user ID
	 *
	 * @param $userId
	 * @return $this
	 */
	public function deleteByUserId($userId)
	{
		return $this->is('user_id', $userId);
	}
}