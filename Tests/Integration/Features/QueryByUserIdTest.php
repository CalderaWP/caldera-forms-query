<?php
namespace calderawp\CalderaFormsQuery\Tests\Integration\Features;


use calderawp\CalderaFormsQuery\CreatesSelectQueries;
use calderawp\CalderaFormsQuery\Tests\Integration\IntegrationTestCase;
use calderawp\CalderaFormsQuery\Tests\Traits\CanCreateEntryWithEmailField;

class QueryByUserIdTest extends IntegrationTestCase
{

	use CanCreateEntryWithEmailField;

	/**
	 * Test selecting by entry ID
	 *
	 * @covers CreatesSelectQueries::selectByUserId()
	 */
	public function testByUserId()
	{
		$email = 'nom@noms.noms';
		//Create an entry for a known user.
		$userId = $this->factory()->user->create(
			[ 'user_email' => $email ]
		);
		wp_set_current_user( $userId );
		$entryId = $this->createEntryWithEmail( $email );
		$queries = $this->selectQueriesFactory();

		$results = $queries->selectByUserId( $userId );
		$this->assertEquals( $entryId, $results[0]['entry']->id);
		$this->assertEquals( $entryId, $results[0]['entry']->id);

		$found = false;
		foreach ( $results[0]['values'] as $entryValue )
		{
			if( $entryValue->slug === $this->getEmailFieldSlug() ){
				$this->assertSame( $email, $entryValue->value );
				$found = true;
			}
		}

		$this->assertTrue( $found );

	}
}