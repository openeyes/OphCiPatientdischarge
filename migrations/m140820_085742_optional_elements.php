<?php

class m140820_085742_optional_elements extends CDbMigration
{
	public function up()
	{
		$this->update('element_type',array('required'=>0),"class_name in ('Element_OphCiPatientdischarge_Instructions','Element_OphCiPatientdischarge_DischargePrep')");
	}

	public function down()
	{
		$this->update('element_type',array('required'=>1),"class_name in ('Element_OphCiPatientdischarge_Instructions','Element_OphCiPatientdischarge_DischargePrep')");
	}
}
