<?php

class m140815_145946_rename_event extends CDbMigration
{
	public function up()
	{
		$this->update('event_type',array('name' => 'Patient discharge instructions'),"class_name = 'OphCiPatientdischarge'");
	}

	public function down()
	{
		$this->update('event_type',array('name' => 'Patient Discharge Instructions'),"class_name = 'OphCiPatientdischarge'");
	}
}
