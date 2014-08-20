<?php

class DefaultController extends BaseEventTypeController
{
	static protected $action_types = array(
		'validateFollowupItem' => self::ACTION_TYPE_FORM,
	);

	public function actionView($id)
	{
		if ($this->checkPrintAccess()) {
			$this->event_actions[] = EventAction::button('Print', 'print-event', array(
				'display_order' => 2
			), array(
				'id' => 'et_print',
				'class'=>'button small'
			));
		}

		parent::actionView($id);
	}

	protected function setElementDefaultOptions_Element_OphCiPatientdischarge_Discharge($element, $action)
	{
		if ($action == 'create') {

			if ($event = Event::model()->find(array(
					'condition' => 'event_type_id = :event_type_id',
					'params' => array(
						':event_type_id' => $this->event_type->id,
					),
					'order' => 't.created_date desc'
				))) {
				if ($discharge = Element_OphCiPatientdischarge_Discharge::model()->find('event_id=?',array($event->id))) {
					foreach (array('patient_followup_contact_id','patient_followup_datetime','patient_followup_datetime_time','surgical_case_review_contact_id','surgical_case_review_datetime','surgical_case_review_datetime_time') as $field) {
						$element->$field = $discharge->$field;
					}
				}
			}
		}
	}

	public function actionValidateFollowupItem()
	{
		if (!@$_POST['Element_OphCiPatientdischarge_Followup_items_editItem'] || !($item = OphCiPatientdischarge_Followup_Item::model()->findByPk($_POST['Element_OphCiPatientdischarge_Followup_items_editItem_id']))) {
			$item = new OphCiPatientdischarge_Followup_Item;
		}

		$item->attributes = $_POST;

		$item->validate();

		$errors = array();

		foreach ($item->errors as $field => $error) {
			$errors[$field] = $error[0];
		}

		if (empty($errors)) {
			$item->timestamp = date('Y-m-d').' '.$item->time.':00';
			$errors['row'] = $this->renderPartial('_followup_row',array('item' => $item, 'i' => $_POST['i'], 'edit' => true),true);
		}

		echo json_encode($errors);
	}

	public function setComplexAttributes_Element_OphCiPatientdischarge_Followup($element, $data, $index)
	{
		$items = array();

		if (!empty($data['OphCiPatientdischarge_Followup_Item']['id'])) {
			foreach ($data['OphCiPatientdischarge_Followup_Item']['id'] as $i => $id) {
				if (!$id || !($item = OphCiPatientdischarge_Followup_Item::model()->findByPk($id))) {
					$item = new OphCiPatientdischarge_Followup_Item;
				}

				$item->type_id = $data['OphCiPatientdischarge_Followup_Item']['type_id'][$i];
				$item->location = $data['OphCiPatientdischarge_Followup_Item']['location'][$i];
				$item->person = $data['OphCiPatientdischarge_Followup_Item']['person'][$i];
				$item->timestamp = $data['OphCiPatientdischarge_Followup_Item']['timestamp'][$i];
				$item->time = date('H:i',strtotime($item->timestamp));

				$items[] = $item;
			}
		}

		$element->items = $items;
	}

	public function saveComplexAttributes_Element_OphCiPatientdischarge_Followup($element, $data, $index)
	{
		$ids = array();

		foreach ($element->items as $item) {
			$item->element_id = $element->id;

			if (!$item->save()) {
				throw new Exception("Unable to save follow up item: ".print_r($item->errors,true));
			}

			$ids[] = $item->id;
		}

		$criteria = new CDbCriteria;
		$criteria->addCondition('element_id = :ei');
		$criteria->params[':ei'] = $element->id;

		if (!empty($ids)) {
			$criteria->addNotInCondition('id',$ids);
		}

		OphCiPatientdischarge_Followup_Item::model()->deleteAll($criteria);
	}
}
