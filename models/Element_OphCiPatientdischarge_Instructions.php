<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */

class Element_OphCiPatientdischarge_Instructions  extends  BaseEventTypeElement
{
	public $auto_update_relations = true;

	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'et_ophcipatientdischarge_instructions';
	}

	public function rules()
	{
		return array(
			array('patient_instructions, instructions_given_to_id, wear_shield_until, activities, eyecare', 'safe'),
		);
	}

	public function relations()
	{
		return array(
			'element_type' => array(self::HAS_ONE, 'ElementType', 'id','on' => "element_type.class_name='".get_class($this)."'"),
			'eventType' => array(self::BELONGS_TO, 'EventType', 'event_type_id'),
			'event' => array(self::BELONGS_TO, 'Event', 'event_id'),
			'user' => array(self::BELONGS_TO, 'User', 'created_user_id'),
			'usermodified' => array(self::BELONGS_TO, 'User', 'last_modified_user_id'),
			'instructions_given_to' => array(self::BELONGS_TO, 'OphCiPatientdischarge_Instructions_GivenTo', 'instructions_given_to_id'),
			'activities_assignment' => array(self::HAS_MANY, 'OphCiPatientdischarge_Instructions_Activity_Assignment', 'element_id'),
			'activities' => array(self::HAS_MANY, 'OphCiPatientdischarge_Instructions_Activity', 'activity_id', 'through' => 'activities_assignment'),
			'eyecare_assignment' => array(self::HAS_MANY, 'OphCiPatientdischarge_Instructions_Eyecare_Assignment', 'element_id'),
			'eyecare' => array(self::HAS_MANY, 'OphCiPatientdischarge_Instructions_Eyecare', 'eyecare_id', 'through' => 'eyecare_assignment'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'activities' => 'Activity',
			'eyecare' => 'Eye care',
			'patient_instructions' => 'Additional patient instructions',
			'instructions_given_to_id' => 'Post-operative education and instructions given to',
			'wear_shield_until' => 'Wear shield until',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		return new CActiveDataProvider(get_class($this), array(
			'criteria' => $criteria,
		));
	}
}
?>
