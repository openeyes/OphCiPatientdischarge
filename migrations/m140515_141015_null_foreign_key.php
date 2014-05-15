<?php

class m140515_141015_null_foreign_key extends CDbMigration
{
	public function up()
	{
		$this->alterColumn('et_ophcipatientdischarge_discharge','translator_present_id','int(10) unsigned null');
		$this->alterColumn('et_ophcipatientdischarge_discharge','patient_handoff_to_id','int(10) unsigned null');
		$this->alterColumn('et_ophcipatientdischarge_discharge','patient_emergency_contact_id','int(10) unsigned null');
		$this->alterColumn('et_ophcipatientdischarge_discharge','patient_followup_contact_id','int(10) unsigned null');
		$this->alterColumn('et_ophcipatientdischarge_discharge','surgical_case_review_contact_id','int(10) unsigned null');
	}

	public function down()
	{
		$this->alterColumn('et_ophcipatientdischarge_discharge','translator_present_id','int(10) unsigned not null');
		$this->alterColumn('et_ophcipatientdischarge_discharge','patient_handoff_to_id','int(10) unsigned not null');
		$this->alterColumn('et_ophcipatientdischarge_discharge','patient_emergency_contact_id','int(10) unsigned not null');
		$this->alterColumn('et_ophcipatientdischarge_discharge','patient_followup_contact_id','int(10) unsigned not null');
		$this->alterColumn('et_ophcipatientdischarge_discharge','surgical_case_review_contact_id','int(10) unsigned not null');
	}
}
