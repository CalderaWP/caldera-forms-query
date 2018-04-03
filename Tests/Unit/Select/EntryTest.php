<?php


namespace  calderawp\CalderaFormsQuery\Tests\Unit\Select;


use calderawp\CalderaFormsQuery\Select\Entry;
use calderawp\CalderaFormsQuery\Tests\Unit\TestCase;

class EntryTest extends TestCase
{

	/**
	 * Test query by form ID
	 *
	 * @covers Entry::queryByFormsId()
	 */
	public function testQueryByFormsId()
	{
		$expectedSql = "SELECT `wp_cf_form_entries`.* FROM `wp_cf_form_entries` WHERE (`wp_cf_form_entries`.`form_id` = 'cf12345')";
		$entryGenerator = $this->entryGeneratorFactory();
		$generator = $entryGenerator->queryByFormsId( 'cf12345');
		$this->assertTrue( $this->isAEntry($generator) );

		$actualSql = $entryGenerator->getPreparedSql();
		$this->assertEquals( $expectedSql, $actualSql );

	}

	/**
	 * Test query by entry ID
	 *
	 * @covers Entry::queryByEntryId()
	 */
	public function testQueryByEntryId()
	{
		$expectedSql = "SELECT `wp_cf_form_entries`.* FROM `wp_cf_form_entries` WHERE (`wp_cf_form_entries`.`id` = '42')";
		$entryGenerator = $this->entryGeneratorFactory();
		$generator = $entryGenerator->queryByEntryId( 42);
		$this->assertTrue( $this->isAEntry($generator) );

		$actualSql = $entryGenerator->getPreparedSql();
		$this->assertEquals( $expectedSql, $actualSql );
	}

	/**
	 * Test query by user ID
	 *
	 * @covers Entry::queryByUserId()
	 */
	public function testQueryByUserId()
	{
		$expectedSql = "SELECT `wp_cf_form_entries`.* FROM `wp_cf_form_entries` WHERE (`wp_cf_form_entries`.`user_id` = '42')";
		$entryGenerator = $this->entryGeneratorFactory();
		$generator = $entryGenerator->queryByUserId( 42);
		$this->assertTrue( $this->isAEntry($generator) );

		$actualSql = $entryGenerator->getPreparedSql();
		$this->assertEquals( $expectedSql, $actualSql );
	}

	/**
	 * @param $generator
	 * @return bool
	 */
	protected function isAEntry($generator)
	{
		return is_a($generator, '\calderawp\CalderaFormsQuery\Select\Entry');
	}
}