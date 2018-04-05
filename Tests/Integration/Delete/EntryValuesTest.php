<?php


namespace calderawp\CalderaFormsQuery\Tests\Integration\Delete;


use calderawp\CalderaFormsQuery\Delete\EntryValues;
use calderawp\CalderaFormsQuery\Tests\Integration\IntegrationTestCase;
use calderawp\CalderaFormsQuery\Tests\Traits\CanCreateEntryWithEmailField;

class EntryValuesTest extends IntegrationTestCase
{

	use CanCreateEntryWithEmailField;
	/**
	 * Test deleting by entry ID
	 *
	 * @covers EntryValues::deleteByEntryId()
	 */
	public function testDeleteByEntryId()
	{
		//Save an entry
		$entry = $this->createEntryWithMockForm();
		$entryId = $entry['id'];

		//SQL to count entries
		$entryValuesQueryGenerator = $this->entryValuesGeneratorFactory();
		$entryValuesQueryGenerator->queryByEntryId($entryId);
		$sql = $entryValuesQueryGenerator->getPreparedSql();

		//We have four values -- four fields saved.
		$results =  $this->queryWithWPDB($sql);
		$this->assertTrue( ! empty( $results ));
		$this->assertSame( 4, count( $results ) );

		//Delete entry
		$this->queryWithWPDB(
			$this
				->entryValuesDeleteGeneratorFactory()
				->deleteByEntryId($entryId)
				->getPreparedSql()
		);

		//We have no values -- all fields saved.

		$results =  $this->queryWithWPDB($sql);
		$this->assertSame( 0, count( $results ) );
	}

	/**
	 * Test deleting when field value equals something
	 *
	 * @covers EntryValues::deleteByFieldValue()
	 */
	public function testDeleteByFieldValueEquals()
	{
		$entryId = $this->createEntryWithEmail( 'roy@roysivan.com' );
		//Delete entry
		$this->queryWithWPDB(
			$this
				->entryValuesDeleteGeneratorFactory()
				->deleteByFieldValue(
					$this->getEmailFieldSlug(),
					'roy@roysivan.com'
				)
				->getPreparedSql()
		);

		//We have no values for this field -- all fields saved.
		$entryValuesQueryGenerator = $this->entryValuesGeneratorFactory();
		$entryValuesQueryGenerator->queryByFieldValue(
			$this->getEmailFieldSlug(),
			'roy@roysivan.com'
		);
		$sql = $entryValuesQueryGenerator->getPreparedSql();
		$results =  $this->queryWithWPDB($sql);
		$this->assertSame( 0, count( $results ) );


	}

}