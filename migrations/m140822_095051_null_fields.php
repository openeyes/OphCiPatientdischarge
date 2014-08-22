<?php // [ORB-462]

class m140822_095051_null_fields extends CDbMigration
{
	public function up()
	{
		$this->alterColumn('et_ophcipatientdischarge_dischargeprep','handoff_to','varchar(2048) COLLATE utf8_bin NULL');
		$this->alterColumn('et_ophcipatientdischarge_dischargeprep_version','handoff_to','varchar(2048) COLLATE utf8_bin NULL');
		$this->refreshTableSchema('et_ophcipatientdischarge_dischargeprep');
		$this->refreshTableSchema('et_ophcipatientdischarge_dischargeprep_version');
	}

	public function down()
	{
		$this->alterColumn('et_ophcipatientdischarge_dischargeprep','handoff_to','varchar(2048) COLLATE utf8_bin NOT NULL');
		$this->alterColumn('et_ophcipatientdischarge_dischargeprep_version','handoff_to','varchar(2048) COLLATE utf8_bin NOT NULL');
		$this->refreshTableSchema('et_ophcipatientdischarge_dischargeprep');
		$this->refreshTableSchema('et_ophcipatientdischarge_dischargeprep_version');
	}
}