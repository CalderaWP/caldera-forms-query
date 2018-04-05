<?php


namespace calderawp\CalderaFormsQuery\Features;


use calderawp\CalderaContainers\Container;
use calderawp\CalderaContainers\Interfaces\ServiceContainer;

use calderawp\CalderaFormsQuery\DeleteQueries;
use calderawp\CalderaFormsQuery\MySqlBuilder;
use calderawp\CalderaFormsQuery\Delete\Entry as EntryDelete;
use \calderawp\CalderaFormsQuery\Delete\EntryValues as EntryValuesDelete;
use \calderawp\CalderaFormsQuery\Select\Entry as EntrySelect;
use \calderawp\CalderaFormsQuery\Select\EntryValues as EntryValueSelect;
use calderawp\CalderaFormsQuery\SelectQueries;

class FeatureContainer extends Container
{
	/**
	 * @var ServiceContainer
	 */
	protected $serviceContainer;
	/**
	 * @var \wpdb
	 */
	protected $wpdb;

	/**
	 * FeatureContainer constructor.
	 * @param ServiceContainer $serviceContainer
	 * @param \wpdb $wpdb
	 */
	public function __construct(ServiceContainer $serviceContainer, \wpdb $wpdb )
	{

		$this->serviceContainer = $serviceContainer;
		$this->wpdb = $wpdb;
		$this->bindServices();
	}

	/**
	 * Bind services to service container
	 */
	protected function bindServices()
	{
		$this->serviceContainer->singleton( MySqlBuilder::class, function(){
			return new MySqlBuilder();
		});

		$this->serviceContainer->bind( SelectQueries::class, function (){
			return new SelectQueries(
				new EntrySelect(
					$this->getBuilder(),
					$this->entryTableName()
				),
				new EntryValueSelect(
					$this->getBuilder(),
					$this->entryTableName()
				),
				$this->wpdb
			);
		});

		$this->serviceContainer->bind( DeleteQueries::class, function (){
			return new DeleteQueries(
				new EntryDelete(
					$this->getBuilder(),
					$this->entryTableName()
				),
				new EntryValuesDelete(
					$this->getBuilder(),
					$this->entryTableName()
				),
				$this->wpdb
			);
		});

		$this->serviceContainer->singleton( Queries::class, function(){
			return new Queries(
				$this
					->serviceContainer
					->make( SelectQueries::class ),
				$this
					->serviceContainer
					->make(DeleteQueries::class )
			);
		});
	}

	/**
	 * Get MySQL builder
	 *
	 * @return MySqlBuilder
	 */
	public function getBuilder()
	{
		return $this
			->serviceContainer
			->make( MySqlBuilder::class );
	}

	/**
	 * Get query runner
	 *
	 * @return Queries
	 */
	public function getQueries()
	{
		return $this
			->serviceContainer
			->make( Queries::class );
	}



	/**
	 * @return string
	 */
	protected function entryValueTableName(): string
	{
		return "{$this->wpdb->prefix}cf_form_entry_values";
	}

	/**
	 * @return string
	 */
	protected function entryTableName(): string
	{
		return "{$this->wpdb->prefix}cf_form_entries";
	}

}