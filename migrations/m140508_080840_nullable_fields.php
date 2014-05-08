<?php

class m140508_080840_nullable_fields extends CDbMigration
{
	public function up()
	{
		$this->alterColumn('et_ophcipatientdischarge_dischargeprep','change_noted','int(10) unsigned null');
	}

	public function down()
	{
		$this->alterColumn('et_ophcipatientdischarge_dischargeprep','change_noted','int(10) unsigned not null');
	}
}
