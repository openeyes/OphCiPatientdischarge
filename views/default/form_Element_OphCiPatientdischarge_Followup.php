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
	<?php $form->widget('application.widgets.Records', array(
		'form' => $form,
		'element' => $element,
		'model' => new OphCiPatientdischarge_Followup_Item,
		'field' => 'items',
		'validate_method' => '/OphCiPatientdischarge/default/validateFollowupItem',
		'row_view' => 'protected/modules/OphCiPatientdischarge/views/default/_followup_row.php',
		'sort_table_after_save' => array(
			'type' => 'date',
			'column' => 0
		),
		'columns' => array(
			array(
				'width' => 9,
				'fields' => array(
					array(
						'field' => 'type_id',
						'type' => 'dropdown',
						'options' => CHtml::listData(OphCiPatientdischarge_Followup_Type::model()->findAll(array('order'=>'display_order asc')),'id','name'),
						'empty' => '- Select -',
						'label_width' => 2,
					),
					array(
						'field' => 'location',
						'type' => 'text',
						'label_width' => 2,
					),
					array(
						'field' => 'person',
						'type' => 'text',
						'label_width' => 2,
					),
				),
			),
		),
		'no_items_text' => 'No followup appointments have been made',
		'add_button_text' => 'Add appointment',
		'use_last_button_text' => false,
		'headings' => array('Date/time','Type','Location','Person'),
	))?>
	<input type="hidden" name="<?php echo CHtml::modelName($element)?>[present]" value="1" />
</div>
