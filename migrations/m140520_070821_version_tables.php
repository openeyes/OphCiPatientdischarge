<?php

class m140520_070821_version_tables extends OEMigration
{
	public $tables = array(
		'et_ophcipatientdischarge_discharge',
		'et_ophcipatientdischarge_dischargeprep',
		'ophcipatientdischarge_discharge_translator_present',
	);

	public function up()
	{
		foreach ($this->tables as $table) {
			$this->versionExistingTable($table);
		}
	}

	public function down()
	{
		foreach ($this->tables as $table) {
			$this->dropTable($table.'_version');
		}
	}
}
