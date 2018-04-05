<?php


namespace calderawp\CalderaFormsQuery;

use calderawp\CalderaFormsQuery\Select\Entry;
use calderawp\CalderaFormsQuery\Select\EntryValues;

/**
 * Interface QueriesEntries
 *
 * Interface that all classes that query for entries MUST impliment
 */
interface CreatesSelectQueries extends GetsResults
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
}
