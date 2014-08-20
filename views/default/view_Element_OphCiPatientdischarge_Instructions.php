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
<div class="element-data">
	<div class="row data-row">
		<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('activities'))?>:</div></div>
		<div class="large-9 column end">
			<div class="data-value">
				<?php if (empty($element->activities)) {?>
					None
				<?php }else{
					foreach ($element->activities as $activity) {?>
						<?php echo $activity->name?><br/>
					<?php }?>
				<?php }?>
			</div>
		</div>
	</div>
	<div class="row data-row">
		<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('eyecare'))?>:</div></div>
		<div class="large-9 column end">
			<div class="data-value">
				<?php if (empty($element->eyecare)) {?>
					None
				<?php }else{
					foreach ($element->eyecare as $eyecare) {
						if ($eyecare->name == 'Wear eye shield until...') {
							$text = 'Wear shield';
						}else{
							$text = $eyecare->name?>
						<?php }?>
						<?php echo $text?><br/>
					<?php }
				}?>
			</div>
		</div>
	</div>
	<?php if ($element->hasMultiSelectValue('eyecare','Wear eye shield until...')) {?>
		<div class="row data-row">
			<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('wear_shield_until'))?>:</div></div>
			<div class="large-9 column end">
				<div class="data-value">
					<?php echo CHtml::encode($element->wear_shield_until)?>
				</div>
			</div>
		</div>
	<?php }?>
	<div class="row data-row">
		<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('patient_instructions'))?>:</div></div>
		<div class="large-9 column end">
			<div class="data-value">
				<?php echo $element->textWithLineBreaks('patient_instructions')?>
			</div>
		</div>
	</div>
	<div class="row data-row">
		<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('instructions_given_to_id'))?>:</div></div>
		<div class="large-9 column end">
			<div class="data-value">
				<?php echo $element->instructions_given_to ? $element->instructions_given_to->name : 'Not recorded'?>
			</div>
		</div>
	</div>
</div>
