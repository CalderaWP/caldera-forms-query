<?php


namespace calderawp\CalderaFormsQuery;

use calderawp\CalderaFormsQuery\Select\Entry;
use calderawp\CalderaFormsQuery\Select\EntryValues;

/**
 * Class EntryQueries
 *
 * Used to query entry data, using SQL created by genrators
 */
class SelectsCreatesSelect implements CreatesSelectQueries
{
	/**
	 * SQL generator for entry table
	 *
	 * @var Entry
	 */
	protected $entryGenerator;

	/**
	 * SQL generator for entry values table
	 *
	 * @var EntryValues
	 */
	protected $entryValueGenerator;


	/**
	 * @var \wpdb
	 */
	protected $wpdb;

	public function __construct(Entry $entryGenerator, EntryValues $entryValueGenerator, \wpdb $wpdb)
	{
		$this->entryGenerator = $entryGenerator;
		$this->entryValueGenerator = $entryValueGenerator;
		$this->wpdb = $wpdb;
	}

	/** @inheritdoc */
	public function getResults($sql)
	{
		$results = $this->wpdb->get_results($sql);
		if (empty($results)) {
			return [];
		}
		return $results;
	}

	/** @inheritdoc */
	public function getEntryValueGenerator()
	{
		return $this->entryValueGenerator;
	}

	/** @inheritdoc */
	public function getEntryGenerator()
	{
		return $this->entryGenerator;
	}


	/**
	 * Get all data for a user by Id
	 *
	 * @param $userId
	 * @return array
	 */
	public function selectByUserId($userId)
	{
		$this->resetEntryGenerator();

		$this
			->getEntryGenerator()
			->queryByUserId($userId);

		$entries = $this->getResults($this->getEntryGenerator()->getPreparedSql());

		return $this->collectResults($entries);


	}

	/**
	 * Reset entry generator
	 */
	private function resetEntryGenerator()
	{
		$this->entryGenerator->resetQuery();
	}

	/**
	 * Reset entry value generator
	 */
	private function resetEntryValueGenerator()
	{
		$this->entryValueGenerator->resetQuery();
	}

	/**
	 * Collect results using  Caldera_Forms_Entry_Entry and Caldera_Forms_Entry_Field to represent values
	 *
	 * @param \stdClass[] $entriesValues
	 * @return array
	 */
	private function collectResults($entriesValues)
	{
		$results = [];
		foreach ($entriesValues as $entry) {
			$this->resetEntryValueGenerator();
			$entry = new \Caldera_Forms_Entry_Entry($entry);
			$this
				->getEntryValueGenerator()
				->queryByEntryId($entry->id);
			$entriesValues =$this->getResults(
				$this->getEntryValueGenerator()
				->getPreparedSql()
			);

			$entryValuesPrepared = $this->collectEntryValues($entriesValues);
			$results[] = [
				'entry' => $entry,
				'values' => $entryValuesPrepared
			];

		}
		return $results;
	}

	/**
	 * Collect entry values as Caldera_Forms_Entry_Field objects
	 *
	 * @param \stdClass[] $entriesValues
	 * @return array
	 */
	private function collectEntryValues($entriesValues): array
	{
		$entryValuesPrepared = [];
		if (!empty($entriesValues)) {
			foreach ($entriesValues as $entryValue) {
				$entryValuesPrepared[] = new \Caldera_Forms_Entry_Field($entryValue);
			}
		}
		return $entryValuesPrepared;
	}
}
