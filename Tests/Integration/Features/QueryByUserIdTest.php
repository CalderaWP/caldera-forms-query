<?php
namespace calderawp\CalderaFormsQuery\Tests\Integration\Features;


use calderawp\CalderaFormsQuery\CreatesSelectQueries;
use calderawp\CalderaFormsQuery\Tests\Integration\IntegrationTestCase;
use calderawp\CalderaFormsQuery\Tests\Traits\CanCreateEntryWithEmailField;

class QueryByUserIdTest extends IntegrationTestCase
{

	use CanCreateEntryWithEmailField;


	public function testByUserId()
	{
		$container = $this->containerFactory();

		//Create an entry for a known user.
		$email = 'nom@noms.noms';
		$userId = $this->factory()->user->create(
			[ 'user_email' => $email ]
		);
		wp_set_current_user( $userId );
		$entryId = $this->createEntryWithEmail( $email );

		$results = $container->selectByUserId( $userId );
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