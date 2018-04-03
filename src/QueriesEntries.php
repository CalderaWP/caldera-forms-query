<?php


namespace calderawp\CalderaFormsQuery;


use calderawp\CalderaFormsQuery\Select\Entry;
use calderawp\CalderaFormsQuery\Select\EntryValues;

interface QueriesEntries
{
	/**
	 * Get generator for entry values SQL
	 *
	 * @return EntryValues
	 */
	public function getEntryValueGenerator();
	/**
	 * Get generator for entry table SQL
	 *
	 * @return Entry
	 */
	public function getEntryGenerator();

	/**
	 * @param $sql
	 * @return \stdClass[]
	 */
	public function getResults( $sql );

}