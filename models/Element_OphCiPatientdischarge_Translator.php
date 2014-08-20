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

class Element_OphCiPatientdischarge_Translator	extends  BaseEventTypeElement
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'et_ophcipatientdischarge_translator';
	}

	public function rules()
	{
		return array(
			array('translator_present_id,translator_name,caregiver_present_id,caregiver_name,caregiver_relationship_id', 'safe'),
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
			'translator_present' => array(self::BELONGS_TO, 'OphCiPatientdischarge_Translator_Present', 'translator_present_id'),
			'caregiver_present' => array(self::BELONGS_TO, 'OphCiPatientdischarge_Caregiver_Present', 'caregiver_present_id'),
			'caregiver_relationship' => array(self::BELONGS_TO, 'OphCiPatientdischarge_Caregiver_Relationship', 'caregiver_relationship_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'translator_present_id' => 'Translator present?',
			'translator_name' => 'Translator name',
			'caregiver_present_id' => 'Caregiver present?',
			'caregiver_name' => 'Caregiver name',
			'caregiver_relationship_id' => 'Caregiver relationship',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		return new CActiveDataProvider(get_class($this), array(
			'criteria' => $criteria,
		));
	}

	public function afterValidate()
	{
		if ($this->translator_present && $this->translator_present->name == 'Yes') {
			if (!$this->translator_name) {
				$this->addError('translator_name',$this->getAttributeLabel('translator_name').' is required');
			}
		}

		if ($this->caregiver_present && $this->caregiver_present->name == 'Yes') {
			if (!$this->caregiver_name) {
				$this->addError('caregiver_name',$this->getAttributeLabel('caregiver_name').' is required');
			}
			if (!$this->caregiver_relationship) {
				$this->addError('caregiver_relationship_id',$this->getAttributeLabel('caregiver_relationship_id').' is required');
			}
		} 

		return parent::afterValidate();
	}
}
?>
