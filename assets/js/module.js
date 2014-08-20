
/* Module-specific javascript can be placed here */

$(document).ready(function() {
			handleButton($('#et_save'),function() {
					});
	
	handleButton($('#et_cancel'),function(e) {
		if (m = window.location.href.match(/\/update\/[0-9]+/)) {
			window.location.href = window.location.href.replace('/update/','/view/');
		} else {
			window.location.href = baseUrl+'/patient/episodes/'+OE_patient_id;
		}
		e.preventDefault();
	});

	handleButton($('#et_deleteevent'));

	handleButton($('#et_canceldelete'));

	handleButton($('#et_print'),function(e) {
		printIFrameUrl(OE_print_url, null);
		enableButtons();
		e.preventDefault();
	});

	$('select.populate_textarea').unbind('change').change(function() {
		if ($(this).val() != '') {
			var cLass = $(this).parent().parent().parent().attr('class').match(/Element.*/);
			var el = $('#'+cLass+'_'+$(this).attr('id'));
			var currentText = el.text();
			var newText = $(this).children('option:selected').text();

			if (currentText.length == 0) {
				el.text(ucfirst(newText));
			} else {
				el.text(currentText+', '+newText);
			}
		}
	});

	$('#Element_OphCiPatientdischarge_Type_type_id').change(function(e) {
		if ($(this).children('option:selected').text().trim() != 'Recovery to ward') {
			$('section.Element_OphCiPatientdischarge_DischargePrep').find('.js-remove-element').click();
		} else {
			$('.optional-elements-list').children('li[data-element-type-class="Element_OphCiPatientdischarge_DischargePrep"]').children('a').click();
		}

		if ($(this).children('option:selected').text().trim() == 'Laser or injection') {
			$('section.Element_OphCiPatientdischarge_Instructions').find('.js-remove-element').click();
		} else {
			$('.optional-elements-list').children('li[data-element-type-class="Element_OphCiPatientdischarge_Instructions"]').children('a').click();
		}
	});
});

function ucfirst(str) { str += ''; var f = str.charAt(0).toUpperCase(); return f + str.substr(1); }

function eDparameterListener(_drawing) {
	if (_drawing.selectedDoodle != null) {
		// handle event
	}
}
