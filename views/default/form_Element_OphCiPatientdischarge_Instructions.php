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
?>
<div class="element-fields">
	<?php echo $form->multiSelectList($element, 'activities', 'activities', 'activity_id', CHtml::listData(OphCiPatientdischarge_Instructions_Activity::model()->findAll(array('order' => 'display_order asc')),'id','name'), array(), array('empty' => '- Select -','label' => $element->getAttributeLabel('activities')), false, false, null, false, false, array('label' => 3, 'field' => 4))?>
	<?php echo $form->multiSelectList($element, 'eyecare', 'eyecare', 'eyecare_id', CHtml::listData(OphCiPatientdischarge_Instructions_Eyecare::model()->findAll(array('order' => 'display_order asc')),'id','name'), array(), array('class' => 'linked-fields', 'data-linked-fields' => 'wear_shield_until', 'data-linked-values' => 'Wear eye shield until...', 'empty' => '- Select -','label' => $element->getAttributeLabel('eyecare')), false, false, null, false, false, array('label' => 3, 'field' => 4))?>
	<?php echo $form->textField($element, 'wear_shield_until', array('hide' => !$element->hasMultiSelectValue('eyecare','Wear eye shield until...')), array(), array('label' => 3, 'field' => 4))?>
	<?php echo $form->textArea($element, 'patient_instructions', array(), false, array(), array('label' => 3, 'field' => 4))?>
	<?php echo $form->dropDownList($element, 'instructions_given_to_id', CHtml::listData(OphCiPatientdischarge_Instructions_GivenTo::model()->findAll(array('order'=>'display_order asc')),'id','name'), array('empty' => '- Select -'), false, array('label' => 3, 'field' => 4))?>
</div>
