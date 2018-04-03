<?php


namespace calderawp\CalderaFormsQuery\Tests\Unit;

//Import PHP unit test case.
//Must be aliased to avoid having two classes of same name in scope.
use calderawp\CalderaFormsQuery\EntryQueries;
use PHPUnit\Framework\TestCase as FrameworkTestCase;

/**
 * Class TestCase
 *
 * Default test case for all unit tests
 * @package CalderaLearn\RestSearch\Tests\Unit
 */
abstract class TestCase extends FrameworkTestCase
{
	/**
	 * @return \calderawp\CalderaFormsQuery\Select\EntryValues
	 */
	protected function entryValuesGeneratorFactory()
	{
		return new \calderawp\CalderaFormsQuery\Select\EntryValues(
			$this->MySqlBuilderFactory(),
			'cf_form_entry_values'
		);
	}

	/**
	 * @return \calderawp\CalderaFormsQuery\Select\Entry
	 */
	protected function entryGeneratorFactory()
	{
		return new \calderawp\CalderaFormsQuery\Select\Entry(
			$this->MySqlBuilderFactory(),
			'wp_cf_form_entries'
		);
	}

	/**
	 * @return \calderawp\CalderaFormsQuery\MySqlBuilder
	 */
	protected function MySqlBuilderFactory(): \calderawp\CalderaFormsQuery\MySqlBuilder
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
			new \wpdb()
		);
	}
}
