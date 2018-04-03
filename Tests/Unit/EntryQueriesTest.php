<?php


namespace calderawp\CalderaFormsQuery\Tests\Unit;

use calderawp\CalderaFormsQuery\EntryQueries;
use calderawp\CalderaFormsQuery\Select\Entry;
use calderawp\CalderaFormsQuery\Select\EntryValues;
use calderawp\CalderaFormsQuery\Select\SelectQueryBuilder;

class EntryQueriesTest extends TestCase
{

	/**
	 * Test getting entry SQL generator
	 *
	 * @covers EntryQueries::getEntryGenerator()
	 * @covers EntryQueries::$entryGenerator
	 */
	public function testGetEntryGenerator()
	{
		$queries = $this->entryQueriesFactory();
		$this->assertTrue(is_a($queries->getEntryGenerator(), Entry::class));
	}

	/**
	 * Test getting entry values SQL generator
	 *
	 * @covers EntryQueries::getEntryValueGenerator()
	 * @covers EntryQueries::$entryValueGenerator
	 */public function testGetEntryValueGenerator()
	{
		$queries = $this->entryQueriesFactory();
		$this->assertTrue(is_a($queries->getEntryValueGenerator(), EntryValues::class));
}

	/**
	 * Test that getResults method returns an array
	 *
	 * @covers EntryQueries::getResults()
	 */
public function testGetResults()
{
	$queries = $this->entryQueriesFactory();
	$this->assertTrue(is_array($queries->getResults("SELECT `roy` FROM sivan WHERE mike = 'roy'")));
}
}
