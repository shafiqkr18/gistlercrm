// JavaScript Document
// JavaScript Document
var screenname = 'leads';
var property_requirements_popup_id = 0;
var listing_popup_id = 0;
/* Check for value change in form */
var formDataChange = false;
$(document.body).on('change', "#myForm", function(event) {
	formDataChange = true;
}
);
window.onbeforeunload = function() {
	if (formDataChange) {
		return 'Data not saved!';
	}
}

$(document).ready(function() {
	$('#shared').click(function() {
		if(this.checked == true) {
			$('#shared').val(1);
		} else {
			$('#shared').val(0);
			$("#shared_hidden").val('no');
		}
	});
	$('#lead_by_agent').click(function() {
		if(this.checked == true) {
			$('#lead_by_agent').val(1);
		} else {
			$('#lead_by_agent').val(0);
			$("#lead_by_agent_hidden").val('no');
		}
	});
	$(document.body).on('click', "#remove_leads_reminder_one", function() {
		if($("#leads_reminder_one").attr("disabled")!="disabled") {
			$("#leads_reminder_one").val('');
			return false;
		}
	});
	$(document.body).on('click', "#remove_leads_reminder_two", function() {
		if($("#leads_reminder_two").attr("disabled")!="disabled") {
			$("#leads_reminder_two").val('');
			return false;
		}
	});
	$("#notes").keypress(function(evt) {
		var keycode = evt.charCode || evt.keyCode;
		//alert(keycode);
		if (keycode == 34 || keycode == 39 || keycode == 47 || keycode == 92 || keycode == 13) {
			//Enter key's keycode
			return false;
		}
	});
	jQuery('#region_id').change(function() {
		var value = jQuery(this).val();
		var snum_dropdown = '';
		snum_dropdown += '<option value="0" selected="selected">Select</option>';
                if(location_json_array[value] !== undefined){
                    	$.each(location_json_array[value], function(key, val) {
			snum_dropdown += '<option value="' + key * 1 + '" >' + val + '</option>';
                        }
                        );
                        }
	
		jQuery('#area_location_id').html(snum_dropdown);
		jQuery('#sub_area_location_id').val('');
		jQuery('#area_location_id').attr('disabled', false);
	});
	jQuery('#area_location_id').change(function() {
		var value = jQuery(this).val();
		var snum_dropdown = '';
		snum_dropdown += '<option value="0" selected="selected">Select</option>';
		if (sub_location_json_array[value] !== undefined) {
			$.each(sub_location_json_array[value], function(key, val) {
				snum_dropdown += '<option value="' + key * 1 + '" >' + val + '</option>';
			}
			);
		}
		jQuery('#sub_area_location_id').html(snum_dropdown);
		jQuery('#sub_area_location_id').attr('disabled', false);
	});
});

$(document.body).on("click", '#listings_row tbody tr', function() {
	if (formDataChange == true) {
		var result = confirm("You have not saved the data, all changes will be lost!");
	}
	if (result == true || formDataChange == false) {
		var id = $(this).attr('id');
                if(id != undefined){
                    getSingleRow(id);
                    if ($('#' + id).hasClass("listing_rows_email")) {
                            $('#autoImport').css('background-color', '#EFFFEA');
                            $('#automsg').css('display', '');
                    } else if ($('#' + id).hasClass("listing_rows")) {
                            $('#autoImport').css('background-color', '');
                            $('#automsg').css('display', 'none');
                    }
                }
		
	}
}
);

function rfsh() {
	var oTable2 = $('#listings_row_landlord').dataTable();
	oTable2.fnDraw();
	var landlord_id = $('#landlord_id').val();
	$('#' + landlord_id).css('background-color', '#FDF7CC');
	setTimeout(function() {
		$('#' + landlord_id).css('background-color', '#E7E9FE');
	}, 5000);
}

function uncheckRadio() {
	$('#listings_row_landlord input').each(function() {
		$(this).attr('checked', false);
		//alert('ss');
	}
	);
}
function fnClickAddRow() {
	$('#listings_row').dataTable().fnAddData([
	            '',
	            '',
	            '',
	            '',
	            '',
	            '',
	            '',
	            '',
	            '',
	            '',
	            '',
	            '',
	            '',
	            '',
	            '',
	            '',
	            '',
	            '',
	            '',
	            '',
	            '',
	            '',
	            '',
	            '',
	            '',
	            '',
	            '',
	            '',
	            '',
	            '',
	            '',
	            '',
	            '',
	            '',
	            '',
	            '',
                '',
                ''
	        ]);
}

