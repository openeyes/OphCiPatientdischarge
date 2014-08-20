<?php

class m140820_065055_discharge_event_changes extends OEMigration
{
	public function up()
	{
		$et = $this->dbConnection->createCommand()->select("*")->from("event_type")->where("class_name = :cn",array(":cn" => "OphCiPatientdischarge"))->queryRow();

		$this->insert('element_type',array(
			'event_type_id' => $et['id'],
			'name' => 'Discharge type',
			'class_name' => 'Element_OphCiPatientdischarge_Type',
			'display_order' => 10,
			'default' => 1,
			'required' => 1,
			'active' => 1,
		));

		$this->createTable('ophcipatientdischarge_type', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(64) not null',
				'display_order' => 'tinyint(1) unsigned not null',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcipatientdischarge_type_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcipatientdischarge_type_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophcipatientdischarge_type_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcipatientdischarge_type_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->versionExistingTable('ophcipatientdischarge_type');

		$this->createTable('et_ophcipatientdischarge_type', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'type_id' => 'int(10) unsigned not null',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophcipatientdischarge_type_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophcipatientdischarge_type_cui_fk` (`created_user_id`)',
				'KEY `et_ophcipatientdischarge_type_ev_fk` (`event_id`)',
				'KEY `et_ophcipatientdischarge_type_ty_fk` (`type_id`)',
				'CONSTRAINT `et_ophcipatientdischarge_type_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcipatientdischarge_type_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcipatientdischarge_type_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
				'CONSTRAINT `et_ophcipatientdischarge_type_ty_fk` FOREIGN KEY (`type_id`) REFERENCES `ophcipatientdischarge_type` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->versionExistingTable('et_ophcipatientdischarge_type');

		$this->dropColumn('et_ophcipatientdischarge_dischargeprep','eye_dressing_in_place');
		$this->dropColumn('et_ophcipatientdischarge_dischargeprep','iv_removed');
		$this->dropColumn('et_ophcipatientdischarge_dischargeprep','ecg_dots_removed');

		$this->dropColumn('et_ophcipatientdischarge_dischargeprep_version','eye_dressing_in_place');
		$this->dropColumn('et_ophcipatientdischarge_dischargeprep_version','iv_removed');
		$this->dropColumn('et_ophcipatientdischarge_dischargeprep_version','ecg_dots_removed');

		$this->addColumn('et_ophcipatientdischarge_dischargeprep','handoff_to','varchar(2048) not null');
		$this->addColumn('et_ophcipatientdischarge_dischargeprep_version','handoff_to','varchar(2048) not null');

		$this->update('element_type',array('display_order' => 20),"class_name = 'Element_OphCiPatientdischarge_DischargePrep'");

		$this->insert('element_type',array(
			'event_type_id' => $et['id'],
			'name' => 'Translator and caregiver details',
			'class_name' => 'Element_OphCiPatientdischarge_Translator',
			'display_order' => 30,
			'default' => 1,
			'required' => 1,
			'active' => 1,
		));

		$this->createTable('ophcipatientdischarge_translator_present', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(64) not null',
				'display_order' => 'tinyint(1) unsigned not null',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcipatientdischarge_translator_present_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcipatientdischarge_translator_present_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophcipatientdischarge_translator_present_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcipatientdischarge_translator_present_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->versionExistingTable('ophcipatientdischarge_translator_present');

		$this->createTable('ophcipatientdischarge_caregiver_present', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(64) not null',
				'display_order' => 'tinyint(1) unsigned not null',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcipatientdischarge_caregiver_present_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcipatientdischarge_caregiver_present_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophcipatientdischarge_caregiver_present_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcipatientdischarge_caregiver_present_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->versionExistingTable('ophcipatientdischarge_caregiver_present');

		$this->createTable('ophcipatientdischarge_caregiver_relationship', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(64) not null',
				'display_order' => 'tinyint(1) unsigned not null',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcipatientdischarge_caregiver_relationship_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcipatientdischarge_caregiver_relationship_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophcipatientdischarge_caregiver_relationship_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcipatientdischarge_caregiver_relationship_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->versionExistingTable('ophcipatientdischarge_caregiver_relationship');

		$this->createTable('et_ophcipatientdischarge_translator', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'translator_present_id' => 'int(10) unsigned null',
				'translator_name' => 'varchar(1024) not null',
				'caregiver_present_id' => 'int(10) unsigned null',
				'caregiver_name' => 'varchar(1024) not null',
				'caregiver_relationship_id' => 'int(10) unsigned null',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophcipatientdischarge_translator_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophcipatientdischarge_translator_cui_fk` (`created_user_id`)',
				'KEY `et_ophcipatientdischarge_translator_ev_fk` (`event_id`)',
				'KEY `et_ophcipatientdischarge_translator_tp_fk` (`translator_present_id`)',
				'KEY `et_ophcipatientdischarge_translator_cp_fk` (`caregiver_present_id`)',
				'KEY `et_ophcipatientdischarge_translator_cr_fk` (`caregiver_relationship_id`)',
				'CONSTRAINT `et_ophcipatientdischarge_translator_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcipatientdischarge_translator_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcipatientdischarge_translator_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
				'CONSTRAINT `et_ophcipatientdischarge_translator_tp_fk` FOREIGN KEY (`translator_present_id`) REFERENCES `ophcipatientdischarge_translator_present` (`id`)',
				'CONSTRAINT `et_ophcipatientdischarge_translator_cp_fk` FOREIGN KEY (`caregiver_present_id`) REFERENCES `ophcipatientdischarge_caregiver_present` (`id`)',
				'CONSTRAINT `et_ophcipatientdischarge_translator_cr_fk` FOREIGN KEY (`caregiver_relationship_id`) REFERENCES `ophcipatientdischarge_caregiver_relationship` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->versionExistingTable('et_ophcipatientdischarge_translator');

		$this->delete('element_type',"class_name = 'Element_OphCiPatientdischarge_Discharge'");

		$this->dropTable('et_ophcipatientdischarge_discharge_version');
		$this->dropTable('et_ophcipatientdischarge_discharge');

		$this->dropTable('ophcipatientdischarge_discharge_translator_present_version');
		$this->dropTable('ophcipatientdischarge_discharge_translator_present');

		$this->insert('element_type',array(
			'name' => 'Patient instructions',
			'class_name' => 'Element_OphCiPatientdischarge_Instructions',
			'display_order' => 40,
			'event_type_id' => $et['id'],
			'required' => 1,
			'active' => 1,
			'default' => 1,
		));

		$this->createTable('ophcipatientdischarge_instructions_activity', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(64) not null',
				'display_order' => 'tinyint(1) unsigned not null',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcipatientdischarge_instructions_activity_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcipatientdischarge_instructions_activity_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophcipatientdischarge_instructions_activity_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcipatientdischarge_instructions_activity_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->versionExistingTable('ophcipatientdischarge_instructions_activity');

		$this->createTable('ophcipatientdischarge_instructions_eyecare', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(64) not null',
				'display_order' => 'tinyint(1) unsigned not null',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcipatientdischarge_instructions_eyecare_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcipatientdischarge_instructions_eyecare_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophcipatientdischarge_instructions_eyecare_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcipatientdischarge_instructions_eyecare_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->versionExistingTable('ophcipatientdischarge_instructions_eyecare');

		$this->createTable('ophcipatientdischarge_instructions_givento', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(64) not null',
				'display_order' => 'tinyint(1) unsigned not null',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcipatientdischarge_instructions_givento_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcipatientdischarge_instructions_givento_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophcipatientdischarge_instructions_givento_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcipatientdischarge_instructions_givento_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->versionExistingTable('ophcipatientdischarge_instructions_givento');

		$this->createTable('et_ophcipatientdischarge_instructions', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'patient_instructions' => 'text not null',
				'instructions_given_to_id' => 'int(10) unsigned null',
				'wear_shield_until' => 'varchar(1024) not null',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophcipatientdischarge_instructions_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophcipatientdischarge_instructions_cui_fk` (`created_user_id`)',
				'KEY `et_ophcipatientdischarge_instructions_ev_fk` (`event_id`)',
				'KEY `et_ophcipatientdischarge_instructions_igt_fk` (`instructions_given_to_id`)',
				'CONSTRAINT `et_ophcipatientdischarge_instructions_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcipatientdischarge_instructions_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcipatientdischarge_instructions_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
				'CONSTRAINT `et_ophcipatientdischarge_instructions_igt_fk` FOREIGN KEY (`instructions_given_to_id`) REFERENCES `ophcipatientdischarge_instructions_givento` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->versionExistingTable('et_ophcipatientdischarge_instructions');

		$this->createTable('ophcipatientdischarge_instructions_activity_asgn', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'element_id' => 'int(10) unsigned not null',
				'activity_id' => 'int(10) unsigned not null',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcipatientdischarge_instructions_activity_asgn_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcipatientdischarge_instructions_activity_asgn_cui_fk` (`created_user_id`)',
				'KEY `ophcipatientdischarge_instructions_activity_asgn_ele_fk` (`element_id`)',
				'KEY `ophcipatientdischarge_instructions_activity_asgn_act_fk` (`activity_id`)',
				'CONSTRAINT `ophcipatientdischarge_instructions_activity_asgn_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcipatientdischarge_instructions_activity_asgn_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcipatientdischarge_instructions_activity_asgn_ele_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophcipatientdischarge_instructions` (`id`)',
				'CONSTRAINT `ophcipatientdischarge_instructions_activity_asgn_act_fk` FOREIGN KEY (`activity_id`) REFERENCES `ophcipatientdischarge_instructions_activity` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->versionExistingTable('ophcipatientdischarge_instructions_activity_asgn');

		$this->createTable('ophcipatientdischarge_instructions_eyecare_asgn', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'element_id' => 'int(10) unsigned not null',
				'eyecare_id' => 'int(10) unsigned not null',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcipatientdischarge_instructions_eyecare_asgn_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcipatientdischarge_instructions_eyecare_asgn_cui_fk` (`created_user_id`)',
				'KEY `ophcipatientdischarge_instructions_eyecare_asgn_ele_fk` (`element_id`)',
				'KEY `ophcipatientdischarge_instructions_eyecare_asgn_act_fk` (`eyecare_id`)',
				'CONSTRAINT `ophcipatientdischarge_instructions_eyecare_asgn_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcipatientdischarge_instructions_eyecare_asgn_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcipatientdischarge_instructions_eyecare_asgn_ele_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophcipatientdischarge_instructions` (`id`)',
				'CONSTRAINT `ophcipatientdischarge_instructions_eyecare_asgn_act_fk` FOREIGN KEY (`eyecare_id`) REFERENCES `ophcipatientdischarge_instructions_eyecare` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->versionExistingTable('ophcipatientdischarge_instructions_eyecare_asgn');

		$this->insert('element_type',array(
			'name' => 'Emergency contact information',
			'class_name' => 'Element_OphCiPatientdischarge_Emergency',
			'display_order' => 60,
			'event_type_id' => $et['id'],
			'active' => 1,
			'required' => 1,
			'default' => 1,
		));

		$this->createTable('et_ophcipatientdischarge_emergency', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'contact_name' => 'varchar(1024) not null',
				'contact_phone' => 'varchar(1024) not null',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophcipatientdischarge_emergency_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophcipatientdischarge_emergency_cui_fk` (`created_user_id`)',
				'CONSTRAINT `et_ophcipatientdischarge_emergency_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcipatientdischarge_emergency_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->versionExistingTable('et_ophcipatientdischarge_emergency');

		$this->insert('element_type',array(
			'name' => 'Follow-up appointment(s)',
			'class_name' => 'Element_OphCiPatientdischarge_Followup',
			'event_type_id' => $et['id'],
			'display_order' => 70,
			'active' => 1,
			'required' => 1,
			'default' => 1,
		));

		$this->createTable('et_ophcipatientdischarge_followup', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophcipatientdischarge_followup_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophcipatientdischarge_followup_cui_fk` (`created_user_id`)',
				'CONSTRAINT `et_ophcipatientdischarge_followup_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcipatientdischarge_followup_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->versionExistingTable('et_ophcipatientdischarge_followup');

		$this->createTable('ophcipatientdischarge_followup_type', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(64) not null',
				'display_order' => 'tinyint(1) unsigned not null',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcipatientdischarge_followup_type_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcipatientdischarge_followup_type_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophcipatientdischarge_followup_type_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcipatientdischarge_followup_type_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->versionExistingTable('ophcipatientdischarge_followup_type');

		$this->createTable('ophcipatientdischarge_followup_item', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'element_id' => 'int(10) unsigned not null',
				'timestamp' => 'datetime not null',
				'type_id' => 'int(10) unsigned not null',
				'person' => 'varchar(1024) not null',
				'location' => 'varchar(1024) not null',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcipatientdischarge_followup_item_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcipatientdischarge_followup_item_cui_fk` (`created_user_id`)',
				'KEY `ophcipatientdischarge_followup_item_ele_fk` (`element_id`)',
				'KEY `ophcipatientdischarge_followup_item_typ_fk` (`type_id`)',
				'CONSTRAINT `ophcipatientdischarge_followup_item_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcipatientdischarge_followup_item_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcipatientdischarge_followup_item_ele_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophcipatientdischarge_followup` (`id`)',
				'CONSTRAINT `ophcipatientdischarge_followup_item_typ_fk` FOREIGN KEY (`type_id`) REFERENCES `ophcipatientdischarge_followup_type` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->versionExistingTable('ophcipatientdischarge_followup_item');

		$this->initialiseData(dirname(__FILE__));
	}

	public function down()
	{
		$this->dropTable('ophcipatientdischarge_followup_item_version');
		$this->dropTable('ophcipatientdischarge_followup_item');

		$this->dropTable('ophcipatientdischarge_followup_type_version');
		$this->dropTable('ophcipatientdischarge_followup_type');

		$this->dropTable('et_ophcipatientdischarge_followup_version');
		$this->dropTable('et_ophcipatientdischarge_followup');

		$this->delete('element_type',"class_name = 'Element_OphCiPatientdischarge_Followup'");

		$this->dropTable('et_ophcipatientdischarge_emergency_version');
		$this->dropTable('et_ophcipatientdischarge_emergency');

		$this->delete('element_type',"class_name = 'Element_OphCiPatientdischarge_Emergency'");

		$this->dropTable('ophcipatientdischarge_instructions_eyecare_asgn_version');
		$this->dropTable('ophcipatientdischarge_instructions_eyecare_asgn');

		$this->dropTable('ophcipatientdischarge_instructions_activity_asgn_version');
		$this->dropTable('ophcipatientdischarge_instructions_activity_asgn');

		$this->dropTable('et_ophcipatientdischarge_instructions_version');
		$this->dropTable('et_ophcipatientdischarge_instructions');

		$this->dropTable('ophcipatientdischarge_instructions_givento_version');
		$this->dropTable('ophcipatientdischarge_instructions_givento');

		$this->dropTable('ophcipatientdischarge_instructions_eyecare_version');
		$this->dropTable('ophcipatientdischarge_instructions_eyecare');

		$this->dropTable('ophcipatientdischarge_instructions_activity_version');
		$this->dropTable('ophcipatientdischarge_instructions_activity');

		$this->delete('element_type',"class_name = 'Element_OphCiPatientdischarge_Instructions'");

		$this->execute("CREATE TABLE `ophcipatientdischarge_discharge_translator_present` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(128) COLLATE utf8_bin NOT NULL,
	`display_order` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `ophcipatientdischarge_discharge_translator_present_lmui_fk` (`last_modified_user_id`),
	KEY `ophcipatientdischarge_discharge_translator_present_cui_fk` (`created_user_id`),
	CONSTRAINT `ophcipatientdischarge_discharge_translator_present_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `ophcipatientdischarge_discharge_translator_present_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin");

		$this->versionExistingTable('ophcipatientdischarge_discharge_translator_present');

		$this->execute("CREATE TABLE `et_ophcipatientdischarge_discharge` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`event_id` int(10) unsigned NOT NULL,
	`translator_present_id` int(10) unsigned DEFAULT NULL,
	`name_of_translator` varchar(255) COLLATE utf8_bin DEFAULT '',
	`take_home_medications` tinyint(1) unsigned NOT NULL,
	`postop_education` tinyint(1) unsigned NOT NULL,
	`additional_patient_instructions` text COLLATE utf8_bin,
	`patient_handoff_to_id` int(10) unsigned DEFAULT NULL,
	`patient_emergency_contact_id` int(10) unsigned DEFAULT NULL,
	`patient_followup_contact_id` int(10) unsigned DEFAULT NULL,
	`patient_followup_datetime` datetime DEFAULT NULL,
	`surgical_case_review_contact_id` int(10) unsigned DEFAULT NULL,
	`surgical_case_review_datetime` datetime DEFAULT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `et_ophcipatientdischarge_discharge_lmui_fk` (`last_modified_user_id`),
	KEY `et_ophcipatientdischarge_discharge_cui_fk` (`created_user_id`),
	KEY `et_ophcipatientdischarge_discharge_ev_fk` (`event_id`),
	KEY `ophcipatientdischarge_discharge_translator_present_fk` (`translator_present_id`),
	KEY `et_ophcipatientdischarge_discharge_patient_handoff_to_id_fk` (`patient_handoff_to_id`),
	KEY `et_ophcipatientdischarge_p_patient_emergency_contact_id_fk` (`patient_emergency_contact_id`),
	KEY `et_ophcipatientdischarge_p_patient_followup_contact_id_fk` (`patient_followup_contact_id`),
	KEY `et_ophcipatientdischarge_s_surgical_case_review_contact_id_fk` (`surgical_case_review_contact_id`),
	CONSTRAINT `et_ophcipatientdischarge_discharge_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `et_ophcipatientdischarge_discharge_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
	CONSTRAINT `et_ophcipatientdischarge_discharge_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `et_ophcipatientdischarge_discharge_patient_handoff_to_id_fk` FOREIGN KEY (`patient_handoff_to_id`) REFERENCES `site` (`id`),
	CONSTRAINT `et_ophcipatientdischarge_p_patient_emergency_contact_id_fk` FOREIGN KEY (`patient_emergency_contact_id`) REFERENCES `user` (`id`),
	CONSTRAINT `et_ophcipatientdischarge_p_patient_followup_contact_id_fk` FOREIGN KEY (`patient_followup_contact_id`) REFERENCES `user` (`id`),
	CONSTRAINT `et_ophcipatientdischarge_s_surgical_case_review_contact_id_fk` FOREIGN KEY (`surgical_case_review_contact_id`) REFERENCES `user` (`id`),
	CONSTRAINT `ophcipatientdischarge_discharge_translator_present_fk` FOREIGN KEY (`translator_present_id`) REFERENCES `ophcipatientdischarge_discharge_translator_present` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

		$this->versionExistingTable('et_ophcipatientdischarge_discharge');

		$et = $this->dbConnection->createCommand()->select("*")->from("event_type")->where("class_name = :cn",array(":cn" => "OphCiPatientdischarge"))->queryRow();

		$this->insert('element_type',array(
			'name' => 'Discharge',
			'class_name' => 'Element_OphCiPatientdischarge_Discharge',
			'event_type_id' => $et['id'],
			'display_order' => 2,
			'default' => 1,
			'required' => 1,
			'active' => 1,
		));

		$this->dropTable('et_ophcipatientdischarge_translator_version');
		$this->dropTable('et_ophcipatientdischarge_translator');

		$this->dropTable('ophcipatientdischarge_caregiver_relationship_version');
		$this->dropTable('ophcipatientdischarge_caregiver_relationship');

		$this->dropTable('ophcipatientdischarge_caregiver_present_version');
		$this->dropTable('ophcipatientdischarge_caregiver_present');

		$this->dropTable('ophcipatientdischarge_translator_present_version');
		$this->dropTable('ophcipatientdischarge_translator_present');

		$this->delete('element_type',"class_name = 'Element_OphCiPatientdischarge_Translator'");

		$this->update('element_type',array('display_order' => 1),"class_name = 'Element_OphCiPatientdischarge_DischargePrep'");

		$this->dropColumn('et_ophcipatientdischarge_dischargeprep','handoff_to');
		$this->dropColumn('et_ophcipatientdischarge_dischargeprep_version','handoff_to');

		$this->addColumn('et_ophcipatientdischarge_dischargeprep','eye_dressing_in_place','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcipatientdischarge_dischargeprep','iv_removed','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcipatientdischarge_dischargeprep','ecg_dots_removed','tinyint(1) unsigned not null');

		$this->addColumn('et_ophcipatientdischarge_dischargeprep_version','eye_dressing_in_place','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcipatientdischarge_dischargeprep_version','iv_removed','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcipatientdischarge_dischargeprep_version','ecg_dots_removed','tinyint(1) unsigned not null');

		$this->dropTable('et_ophcipatientdischarge_type_version');
		$this->dropTable('et_ophcipatientdischarge_type');

		$this->dropTable('ophcipatientdischarge_type_version');
		$this->dropTable('ophcipatientdischarge_type');

		$this->delete('element_type',"class_name = 'Element_OphCiPatientdischarge_Type'");
	}
}
