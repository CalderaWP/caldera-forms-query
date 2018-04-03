<?php


namespace calderawp\CalderaFormsQuery\Select;

/**
 * Class Entry
 * @package calderawp\CalderaFormsQuery\Select

`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`form_id` varchar(18) NOT NULL DEFAULT '',
`user_id` int(11) NOT NULL,
`datestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`status` varchar(20) NOT NULL DEFAULT 'active',
 */
class Entry extends SelectQueryBuilder
{


	/**
	 *
	 *
	 * @param $formId
	 * @return $this
	 */
	public function queryByFormsId($formId)
	{
		return $this->is( 'form_id', $formId );
	}

	public function queryByEntryId($entryId)
	{
		return $this->is( 'id', $entryId );
	}

	public function queryByUserId($userId)
	{
		return $this->is( 'user_id', $userId );
	}

}