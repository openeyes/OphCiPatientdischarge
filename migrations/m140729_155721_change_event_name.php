<?php

class m140729_155721_change_event_name extends OEMigration
{
	public function up()
	{
		$this->update('event_type',
			array('name' => 'Patient Discharge Instructions' ) ,
			"class_name = 'OphCiPatientdischarge'"
		);
	}

	public function down()
	{
		$this->update('event_type',
			array('name' => 'Patient discharge' ) ,
			"class_name = 'OphCiPatientdischarge'"
		);
	}
}
