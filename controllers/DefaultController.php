<?php

class DefaultController extends BaseEventTypeController
{
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
}
