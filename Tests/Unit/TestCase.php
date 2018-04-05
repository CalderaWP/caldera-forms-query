<?php


namespace calderawp\CalderaFormsQuery\Tests\Unit;

//Import PHP unit test case.
//Must be aliased to avoid having two classes of same name in scope.
use calderawp\CalderaFormsQuery\SelectsCreatesSelect;
use calderawp\CalderaFormsQuery\Tests\Traits\HasFactories;
use PHPUnit\Framework\TestCase as FrameworkTestCase;

/**
 * Class TestCase
 *
 * Default test case for all unit tests
 * @package CalderaLearn\RestSearch\Tests\Unit
 */
abstract class TestCase extends FrameworkTestCase
{
	use HasFactories;
}
