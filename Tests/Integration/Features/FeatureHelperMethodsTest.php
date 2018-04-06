<?php
namespace calderawp\CalderaFormsQuery\Tests\Integration\Features;


use calderawp\CalderaFormsQuery\CreatesSelectQueries;
use calderawp\CalderaFormsQuery\Features\FeatureContainer;
use calderawp\CalderaFormsQuery\Tests\Integration\IntegrationTestCase;
use calderawp\CalderaFormsQuery\Tests\Traits\CanCreateEntryWithEmailField;

class FeatureHelperMethodsTest extends IntegrationTestCase
{

	use CanCreateEntryWithEmailField;

	/**
	 *
	 * @covers FeatureContainer::selectByUserId()
	 * @covers FeatureContainer::collectResults()
	 * @covers FeatureContainer::collectEntryValues()
	 * @covers FeatureContainer::select()
	 */
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

	/**
	 * Test selecting by a field value such as an email
	 *
	 * @covers FeatureContainer::selectByFieldValue()
	 * @covers FeatureContainer::select()
	 */
	public function testByFieldValue()
	{
		$container = $this->containerFactory();
		//Create one entry for unknown user
		$this->createEntryWithEmail( rand(). 'email.com' );

		//Create two entries for a known user.
		$email = 'nom@noms.noms';
		$userId = $this->factory()->user->create(
			[ 'user_email' => $email ]
		);
		wp_set_current_user( $userId );
		$this->createEntryWithEmail( $email );
		$this->createEntryWithEmail( $email );

		$results = $container->selectByFieldValue(
			$this->getEmailFieldSlug(),
			$email
		);
		$this->assertSame(2, count($results));
		$this->assertSame( $email,$results[0]['values'][1]->value );
		$this->assertSame( $email,$results[1]['values'][1]->value );

	}

	/**
	 *
	 * @covers FeatureContainer::deleteByEntryIds()
	 * @covers FeatureContainer::delete()
	 */
	public function testDeleteByIds()
	{
		$container = $this->containerFactory();

		//Create three entries
		$entryIdOne = $this->createEntryWithMockFormAndGetEntryId();
		$entryIdTwo = $this->createEntryWithMockFormAndGetEntryId();
		$entryIdThree = $this->createEntryWithMockFormAndGetEntryId();
		//Delete entry one and three
		$container
			->deleteByEntryIds([$entryIdOne,$entryIdThree]);

		//No Entry results for entry One
		$entryQueryGenerator = $this->entryGeneratorFactory();
		$entryQueryGenerator->queryByEntryId($entryIdOne);
		$sql = $entryQueryGenerator->getPreparedSql();
		$results =  $this->queryWithWPDB($sql);
		$this->assertSame( 0, count( $results ) );

		//No Entry Value results for entry One
		$entryValuesQueryGenerator = $this->entryValuesGeneratorFactory();
		$entryValuesQueryGenerator->queryByEntryId($entryIdOne);
		$sql = $entryValuesQueryGenerator->getPreparedSql();
		$results =  $this->queryWithWPDB($sql);
		$this->assertSame( 0, count( $results ) );

		//Results for entry Two
		$entryValuesQueryGenerator = $this->entryValuesGeneratorFactory();
		$entryValuesQueryGenerator->queryByEntryId($entryIdTwo);
		$sql = $entryValuesQueryGenerator->getPreparedSql();
		$results =  $this->queryWithWPDB($sql);
		$this->assertTrue( 0 < count( $results ) );

	}
}