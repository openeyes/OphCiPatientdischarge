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

<section class="element">
	<header class="element-header">
		<h3 class="element-title"><?php echo $element->elementType->name?></h3>
	</header>

	<div class="element-data">
		<div class="row data-row">
			<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('translator_present_id'))?></div></div>
			<div class="large-9 column end"><div class="data-value"><?php echo $element->translator_present ? $element->translator_present->name : 'Not recorded'?></div></div>
		</div>
		<?php if ($element->translator_present && $element->translator_present->name == 'Yes') {?>
			<div class="row data-row">
				<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('name_of_translator'))?></div></div>
				<div class="large-9 column end"><div class="data-value"><?php echo CHtml::encode($element->name_of_translator)?></div></div>
			</div>
		<?php }?>
		<div class="row data-row">
			<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('take_home_medications'))?></div></div>
			<div class="large-9 column end"><div class="data-value"><?php echo $element->take_home_medications ? 'Yes' : 'No'?></div></div>
		</div>
		<div class="row data-row">
			<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('postop_education'))?></div></div>
			<div class="large-9 column end"><div class="data-value"><?php echo $element->postop_education ? 'Yes' : 'No'?></div></div>
		</div>
		<?php if ($element->additional_patient_instructions) {?>
			<div class="row data-row">
				<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('additional_patient_instructions'))?></div></div>
				<div class="large-9 column end"><div class="data-value"><?php echo CHtml::encode($element->additional_patient_instructions)?></div></div>
			</div>
		<?php }?>
		<div class="row data-row">
			<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('patient_handoff_to_id'))?></div></div>
			<div class="large-9 column end"><div class="data-value"><?php echo $element->patient_handoff_to ? $element->patient_handoff_to->name : 'None'?></div></div>
		</div>
		<div class="row data-row">
			<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('patient_emergency_contact_id'))?></div></div>
			<div class="large-9 column end"><div class="data-value"><?php echo $element->patient_emergency_contact ? $element->patient_emergency_contact->fullName : 'None'?></div></div>
		</div>
		<div class="row data-row">
			<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('patient_followup_contact_id'))?></div></div>
			<div class="large-9 column end">
				<div class="data-value">
					with
					<?php echo $element->patient_followup_contact ? $element->patient_followup_contact->fullName : 'None'?>
					on
					<?php echo CHtml::encode($element->NHSDate('patient_followup_datetime'))?>
					at
					<?php echo substr($element->patient_followup_datetime,11,5)?>
				</div>
			</div>
		</div>
		<div class="row data-row">
			<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('surgical_case_review_contact_id'))?></div></div>
			<div class="large-9 column end">
				<div class="data-value">
					with
					<?php echo $element->surgical_case_review_contact ? $element->surgical_case_review_contact->fullName : 'None'?>
					on
					<?php echo CHtml::encode($element->NHSDate('surgical_case_review_datetime'))?>
					at
					<?php echo substr($element->surgical_case_review_datetime,11,5)?>
				</div>
			</div>
		</div>
	</div>
</section>
