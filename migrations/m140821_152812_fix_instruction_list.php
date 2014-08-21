<?php

class m140821_152812_fix_instruction_list extends OEMigration
{
	public function up()
	{
		$this->alterColumn('ophcipatientdischarge_instructions_eyecare','name','varchar(255) not null');
		$this->alterColumn('ophcipatientdischarge_instructions_eyecare_version','name','varchar(255) not null');

		$this->update('ophcipatientdischarge_instructions_eyecare',array('name'=>'Wash your hands before and after touching your eye and instilling medications'),"name = 'Wash your hands before and after touching your eye and instillin'");
		$this->update('ophcipatientdischarge_instructions_eyecare',array('name'=>'Take care not to contaminate the medicine dropper or tip by touching it to your eye'),"name = 'Take care not to contaminate the medicine dropper or tip by touc'");
	}

	public function down()
	{
		$this->alterColumn('ophcipatientdischarge_instructions_eyecare','name','varchar(64) not null');
		$this->alterColumn('ophcipatientdischarge_instructions_eyecare_version','name','varchar(64) not null');
	}
}
