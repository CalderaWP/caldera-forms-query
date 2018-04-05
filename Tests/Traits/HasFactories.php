<?php


namespace calderawp\CalderaFormsQuery\Tests\Traits;

use calderawp\CalderaFormsQuery\EntryQueries;

trait HasFactories
{

	/**
	 * @return \calderawp\CalderaFormsQuery\Select\Entry
	 */
	protected function entryGeneratorFactory()
	{
		return new \calderawp\CalderaFormsQuery\Select\Entry(
			$this->mySqlBuilderFactory(),
			$this->entryTableName()
		);
	}

	/**
	 * @return \calderawp\CalderaFormsQuery\Delete\Entry
	 */
	protected function entryDeleteGeneratorFactory()
	{
		return new \calderawp\CalderaFormsQuery\Delete\Entry(
			$this->mySqlBuilderFactory(),
			$this->entryTableName()
		);
	}


	/**
	 * @return \calderawp\CalderaFormsQuery\Select\EntryValues
	 */
	protected function entryValuesGeneratorFactory()
	{
		return new \calderawp\CalderaFormsQuery\Select\EntryValues(
			$this->mySqlBuilderFactory(),
			$this->entryValueTableName()
		);
	}
	/**
	 * @return \calderawp\CalderaFormsQuery\Delete\EntryValues
	 */
	protected function entryValuesDeleteGeneratorFactory()
	{
		return new \calderawp\CalderaFormsQuery\Delete\EntryValues(
			$this->mySqlBuilderFactory(),
			$this->entryValueTableName()
		);
	}



	/**
	 * @return \calderawp\CalderaFormsQuery\MySqlBuilder
	 */
	protected function mySqlBuilderFactory()
	{
		return new \calderawp\CalderaFormsQuery\MySqlBuilder();
	}


	/**
	 * @return EntryQueries
	 */
	protected function entryQueriesFactory()
	{

		return new EntryQueries(
			$this->entryGeneratorFactory(),
			$this->entryValuesGeneratorFactory(),
			$this->getWPDB()
		);
	}

	/**
	 * Gets a WPDB instance
	 *
	 * @return \wpdb
	 */
	protected function getWPDB()
	{
		global $wpdb;
		if (! class_exists('\WP_User')) {
			include_once dirname(dirname(__FILE__)) . '/Mock/wpdb.php';
		}

		if (! $wpdb) {
			$wpdb = new \wpdb('', '', '', '');
		}
		return $wpdb;
	}

	/**
	 * @return string
	 */
	protected function entryValueTableName(): string
	{
		return "{$this->getWPDB()->prefix}cf_form_entry_values";
	}

	/**
	 * @return string
	 */
	protected function entryTableName(): string
	{
		return "{$this->getWPDB()->prefix}cf_form_entries";
	}
}
