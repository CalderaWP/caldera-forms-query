<?php


namespace calderawp\CalderaFormsQuery\Tests\Unit;

use calderawp\CalderaFormsQuery\SelectsCreatesSelect;
use calderawp\CalderaFormsQuery\Select\Entry;
use calderawp\CalderaFormsQuery\Select\EntryValues;
use calderawp\CalderaFormsQuery\Select\SelectQueryBuilder;

class EntryQueriesTest extends TestCase
{

	/**
	 * Test getting entry SQL generator
	 *
	 * @covers SelectsCreatesSelect::getEntryGenerator()
	 * @covers SelectsCreatesSelect::$entryGenerator
	 */
	public function testGetEntryGenerator()
	{
		$queries = $this->entryQueriesFactory();
		$this->assertTrue(is_a($queries->getEntryGenerator(), Entry::class));
	}

	/**
	 * Test getting entry values SQL generator
	 *
	 * @covers SelectsCreatesSelect::getEntryValueGenerator()
	 * @covers SelectsCreatesSelect::$entryValueGenerator
	 */
	public function testGetEntryValueGenerator()
	{
		$queries = $this->entryQueriesFactory();
		$this->assertTrue(is_a($queries->getEntryValueGenerator(), EntryValues::class));
	}

	/**
	 * Test that getResults method returns an array
	 *
	 * @covers SelectsCreatesSelect::getResults()
	 */
	public function testGetResults()
	{
		$queries = $this->entryQueriesFactory();
		$this->assertTrue(is_array($queries->getResults("SELECT `roy` FROM sivan WHERE mike = 'roy'")));
	}

}
