<?php 
class m140424_121422_event_type_OphCiPatientdischarge extends CDbMigration
{
	public function up()
	{
		if (!$this->dbConnection->createCommand()->select('id')->from('event_type')->where('class_name=:class_name', array(':class_name'=>'OphCiPatientdischarge'))->queryRow()) {
			$group = $this->dbConnection->createCommand()->select('id')->from('event_group')->where('name=:name',array(':name'=>'Clinical events'))->queryRow();
			$this->insert('event_type', array('class_name' => 'OphCiPatientdischarge', 'name' => 'Patient discharge','event_group_id' => $group['id']));
		}

		$event_type = $this->dbConnection->createCommand()->select('id')->from('event_type')->where('class_name=:class_name', array(':class_name'=>'OphCiPatientdischarge'))->queryRow();

		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Discharge prep',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Discharge prep','class_name' => 'Element_OphCiPatientdischarge_DischargePrep', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Discharge prep'))->queryRow();
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Discharge',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Discharge','class_name' => 'Element_OphCiPatientdischarge_Discharge', 'event_type_id' => $event_type['id'], 'display_order' => 2));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Discharge'))->queryRow();



		$this->createTable('et_ophcipatientdischarge_dischargeprep', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'eye_dressing_in_place' => 'tinyint(1) unsigned NOT NULL',

				'iv_removed' => 'tinyint(1) unsigned NOT NULL',

				'ecg_dots_removed' => 'tinyint(1) unsigned NOT NULL',

				'change_noted' => 'tinyint(1) unsigned NOT NULL',

				'comments' => 'text COLLATE utf8_bin DEFAULT \'\'',

				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophcipatientdischarge_dischargeprep_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophcipatientdischarge_dischargeprep_cui_fk` (`created_user_id`)',
				'KEY `et_ophcipatientdischarge_dischargeprep_ev_fk` (`event_id`)',
				'CONSTRAINT `et_ophcipatientdischarge_dischargeprep_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcipatientdischarge_dischargeprep_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcipatientdischarge_dischargeprep_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->createTable('ophcipatientdischarge_discharge_translator_present', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcipatientdischarge_discharge_translator_present_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcipatientdischarge_discharge_translator_present_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophcipatientdischarge_discharge_translator_present_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcipatientdischarge_discharge_translator_present_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophcipatientdischarge_discharge_translator_present',array('name'=>'Yes','display_order'=>1));
		$this->insert('ophcipatientdischarge_discharge_translator_present',array('name'=>'No','display_order'=>2));
		$this->insert('ophcipatientdischarge_discharge_translator_present',array('name'=>'N/A','display_order'=>3));



		$this->createTable('et_ophcipatientdischarge_discharge', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'translator_present_id' => 'int(10) unsigned NOT NULL',

				'name_of_translator' => 'varchar(255) COLLATE utf8_bin DEFAULT \'\'',

				'take_home_medications' => 'tinyint(1) unsigned NOT NULL',

				'postop_education' => 'tinyint(1) unsigned NOT NULL',

				'additional_patient_instructions' => 'text COLLATE utf8_bin DEFAULT \'\'',

				'patient_handoff_to_id' => 'int(10) unsigned NOT NULL',

				'patient_emergency_contact_id' => 'int(10) unsigned NOT NULL',

				'patient_followup_contact_id' => 'int(10) unsigned NOT NULL',

				'patient_followup_datetime' => 'datetime DEFAULT NULL',

				'surgical_case_review_contact_id' => 'int(10) unsigned NOT NULL',

				'surgical_case_review_datetime' => 'datetime DEFAULT NULL',

				'nurse_ophthalmologist_id' => 'int(10) unsigned NOT NULL',

				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophcipatientdischarge_discharge_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophcipatientdischarge_discharge_cui_fk` (`created_user_id`)',
				'KEY `et_ophcipatientdischarge_discharge_ev_fk` (`event_id`)',
				'KEY `ophcipatientdischarge_discharge_translator_present_fk` (`translator_present_id`)',
				'KEY `et_ophcipatientdischarge_discharge_patient_handoff_to_id_fk` (`patient_handoff_to_id`)',
				'KEY `et_ophcipatientdischarge_p_patient_emergency_contact_id_fk` (`patient_emergency_contact_id`)',
				'KEY `et_ophcipatientdischarge_p_patient_followup_contact_id_fk` (`patient_followup_contact_id`)',
				'KEY `et_ophcipatientdischarge_s_surgical_case_review_contact_id_fk` (`surgical_case_review_contact_id`)',
				'KEY `et_ophcipatientdischarge_discharge_nurse_ophthalmologist_id_fk` (`nurse_ophthalmologist_id`)',
				'CONSTRAINT `et_ophcipatientdischarge_discharge_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcipatientdischarge_discharge_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcipatientdischarge_discharge_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
				'CONSTRAINT `ophcipatientdischarge_discharge_translator_present_fk` FOREIGN KEY (`translator_present_id`) REFERENCES `ophcipatientdischarge_discharge_translator_present` (`id`)',
				'CONSTRAINT `et_ophcipatientdischarge_discharge_patient_handoff_to_id_fk` FOREIGN KEY (`patient_handoff_to_id`) REFERENCES `site` (`id`)',
				'CONSTRAINT `et_ophcipatientdischarge_p_patient_emergency_contact_id_fk` FOREIGN KEY (`patient_emergency_contact_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcipatientdischarge_p_patient_followup_contact_id_fk` FOREIGN KEY (`patient_followup_contact_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcipatientdischarge_s_surgical_case_review_contact_id_fk` FOREIGN KEY (`surgical_case_review_contact_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcipatientdischarge_discharge_nurse_ophthalmologist_id_fk` FOREIGN KEY (`nurse_ophthalmologist_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

	}

	public function down()
	{
		$this->dropTable('et_ophcipatientdischarge_dischargeprep');



		$this->dropTable('et_ophcipatientdischarge_discharge');


		$this->dropTable('ophcipatientdischarge_discharge_translator_present');


		$event_type = $this->dbConnection->createCommand()->select('id')->from('event_type')->where('class_name=:class_name', array(':class_name'=>'OphCiPatientdischarge'))->queryRow();

		foreach ($this->dbConnection->createCommand()->select('id')->from('event')->where('event_type_id=:event_type_id', array(':event_type_id'=>$event_type['id']))->queryAll() as $row) {
			$this->delete('audit', 'event_id='.$row['id']);
			$this->delete('event', 'id='.$row['id']);
		}

		$this->delete('element_type', 'event_type_id='.$event_type['id']);
		$this->delete('event_type', 'id='.$event_type['id']);
	}
}

