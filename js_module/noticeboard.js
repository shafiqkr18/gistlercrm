var screenname = 'activities';
var active_tab = 'tab1';

/* Check for value change in form */
var formDataChange = false;

$(document.body).on('change', "#myForm", function(event) {
	formDataChange = true;
});

window.onbeforeunload = function() {
	if (formDataChange) {
		return 'Data not saved!';
	}
}

var sortActivities = false;
//datatable initilization
function refresh_doc_notices() {
	var oTable = $('#listings_row_notices').dataTable();
	oTable.fnDraw();
}

jQuery(document).ready(function() {
	var oTable = $('#listings_row_notices').dataTable({
		"bProcessing": true,
		"bServerSide": true,
		"bScrollInfinite": true,
		"bScrollCollapse": true,
		"sScrollY": "200px",
		"sDom": 'R<>rt<><"clear">',
		"bRegex": true,
		"sAjaxSource": config.baseUrl + "noticeboard/datatable_notices",
		
		  "aoColumnDefs": [ 
                {
                       'render': function (data, type, full, meta){
                        //check the main check box
                        //if (userId == oObj.aData[10] || accessLevel <= 2) {
                        	//alert(config.user.accessLevel);
                        	if (config.user.accessLevel <= 2) {
                        $('#check_all_checkboxes').attr('checked', false);
                        return '<div style="text-align:center;" id="item_action"><input style="align:center;" type="checkbox" value="' + data + '">  <span class="lbl"></span></div>';
                        }else{
                        	return '';
                        }
                    },
                    "aTargets": [ 0 ]
                },
			
               
                { "bSortable": true, "aTargets": [ 0 ] },
              
              ],
		
		"iDisplayStart": 0,
		"sPaginationType": "full_numbers",
		"oLanguage": {
			"sSearch": "Search all columns:"
		},
		"rowCallback": function( row, data ) {
				 $(row).attr("id",data.id);
				  return row;
			},
		 'fnServerData': function (url, data, callback){
			/* Add some extra data to the sender */

			 $.ajax
              ({
                           "dataType": 'json', 
                           "type": "POST", 
                           "url": url, 
                           "data": data, 
                           "success": function(json) {
                               callback(json);
                              // updateUserStatusPanel();;
                               if(last_id > 0){
                                     // $('#listings_row #'+last_id+' td').addClass('yellowCSS');
                                }

                       }
                       });
		}

	});

	/* End Date search */
	$("thead input").keyup(function() {
		/* Filter on the column (the index) of this element */
		oTable.fnFilter(this.value, $(this).attr('id'));
		$('#reset_filter').css('display', '');

	});

	$("thead select").change(function() {
		/* Filter on the column (the index) of this element */
		oTable.fnFilter(this.value, $(this).attr('id'));
		$('#reset_filter').css('display', '');

	});

	//reset filter and drawtable
	$("#reset_filter").click(function() {
		sortActivities = false;
		$("#myForm2")[0].reset();
		oTable.fnDraw(false);
		refresh_doc_notices();

		$('#reset_filter').css('display', 'none');

	});

	//change css of selected row	
	$(document.body).on("click", "#listings_row_notices tbody tr", function(event) {
		if (formDataChange == false) {
			$("td.yellowCSS", oTable.fnGetNodes()).removeClass('yellowCSS');
			$(event.target).parent().find("td").addClass('yellowCSS');
		}
	});

	// check box delete
	$(document.body).on("click", '.dbstatus', function() {
		if ($('#listings_row_notices input').is(':checked')) {
			if (confirm("Are you sure you want to " + $(this).attr('id') + "?")) {
				var allVals = [];
				type = $(this).attr('id');
				$('input[type="checkbox"]:checked').each(function() {
					allVals.push($(this).val());
					name = $(this).attr('id');
				});

				$.post(config.baseUrl + 'cportal/status/', {
						ids: allVals,
						type: $(this).attr('id')
					},
					function(data) {

						$("#myForm")[0].reset();
						$('#edit').css('display', 'none'); /* This shows the update button when a filed is selected */
						$('#new').css('display', 'inline'); /* This shows the update button when a filed is selected */

						if (active_tab == "tab2") {
							refresh_doc_tandc();
						}
						$('#showdata').html(data);
						$('#showdata').animate({
							'color': 'red'
						}, "slow");
						refresh_doc_notices();
					}
				);
			}
		} else {
			alert('Please select at least one notice to delete!');
		}
	});

	//disable_popup();

});

/* Insert / Update function */
jQuery(document).ready(function() {
	$("#update, #Save").click(function() {
		tinyMCE.triggerSave();
		descFlag = true;
	});

	$('#myForm').ajaxForm({
		beforeSubmit: function() {
			return $("#myForm").validate({
				rules: {
					price: {
						number: true,
					},
					size: {
						number: true,
					}
				},
				errorClass: 'form_fields_error',
				errorPlacement: function(error, element) {

				}
			}).form();
		},
		target: '#showdata',
		success: function() {
			//fnClickAddRow(),
			formDataChange = false;
			// if ($("#id").val() == 0) {
				// $.ajax({
					// async: false,
					// url: mainurl + 'cportal/getlastid/',
					// success: function(data) {
						// last_id = data;
					// }
				// })
			// }
			$("#cancel").click(),
			$('#showdata').animate({
				'color': '#49AC44'
			}, "slow"),
			$('#showdata').fadeIn("slow"),
			setTimeout(function() {
				$('#showdata').fadeOut("slow");
			}, 5000);
		}
	});
});

function fnClickAddRow() {
	$('#listings_row_notices').dataTable().fnAddData([
		'',
		'',
		'',
		'',
	]);
}
//end update

/* Fetch single item details */
var last_id = '';

function getSingleRow_notices(id) {
	$('#update, #Save, #cancel').css('display', 'none');
	$('#new').css('display', 'inline');
	$('#myForm input, #myForm select, #myForm textarea').attr('disabled', 'disabled');
	animate_the_form_table_on_click();


	$.getJSON(config.baseUrl + "cportal/single/" + id, function(json) {
		$("#id").val(json.id);
		$("#notice").val(json.notice);
		$("#notice_view").html(json.notice);
		$('#edit').css('display', (accessLevel == 3 && userId != json.user_id ? 'none' : ''));

		last_id = json.id;

		$('#showdata').css('color', '#49AC44');
		$('#showdata').html('Record selected');
		$('#showdata').fadeIn("slow");
		setTimeout(function() {
			$('#showdata').fadeOut("slow");
		}, 5000);
	}); //End json 

	formDataChange = false;

	if (flag != 'readonly') {
		disable_popup();
	} else {
		enable_popup();
	}
}

$(document.body).on("click", '#listings_row_notices tbody tr', function() {
	if (formDataChange == true) {
		var result = confirm("You have not saved the data, all changes will be lost!");
	}

	if (result == true || formDataChange == false) {
		var id = $(this).attr('id');
		getSingleRow_notices(id);
		$("#notice_view").html('loading...');
		//$('#trigger_notice_view_popup').trigger('click')
	}
}); //End click 

$(document.body).on("click", ".overflow", function(event) {
	if (formDataChange == false) {
		$('#trigger_notice_view_popup').trigger('click');
	}
})

//rand actions				
jQuery(document).ready(function() {
	$("input").tooltip();
	$('#myForm input, #myForm select, #myForm textarea').attr('disabled', 'disabled');
	formDataChange = false;
	$("#size").numeric();
	$("#price").numeric();

	$("#price").keyup(function() {
		$('#frequency').attr('required', 'required');
	});


	$("#new, #edit").click(function() {
		$('#new').css('display', 'inline-block');
		$('#trigger_notice_popup').trigger('click');
		
	});


	$(document.body).on('click', "#cancel, #Save, #update", function() {
		//alert('sss');
		$('a.close').trigger('click');
	});


});

function refresh_doc_datatable() {
	var oTable_Doc = $('#listings_row_documents').dataTable();
	oTable_Doc.fnDraw();
}

jQuery(document).ready(function() {
    $("#category_search").on("change", function(e) {
        oTable_Doc.fnDraw();
    });

	var oTable_Doc = $('#listings_row_documents').dataTable({
		"bProcessing": true,
		"bServerSide": true,
		"bScrollInfinite": true,
		"bScrollCollapse": true,
		"sScrollY": "200px",
        "sDom": 'R<>rt<><"clear">',
		"bRegex": true,
		"sAjaxSource": config.baseUrl + "noticeboard/datatable_documents",
		 "aoColumnDefs": [ 
                {
                       'render': function (data, type, full, meta){
                        //check the main check box
                        //if (userId == oObj.aData[10] || accessLevel <= 2) {
                        	//alert(config.user.accessLevel);
                        	if (config.user.accessLevel <= 2) {
                        $('#check_all_checkboxes').attr('checked', false);
                        return '<div style="text-align:center;" id="item_action"><input style="align:center;" type="checkbox" value="' + data + '">  <span class="lbl"></span></div>';
                        }else{
                        	return '';
                        }
                    },
                    "aTargets": [ 0 ]
                },
			
               
                { "bSortable": true, "aTargets": [ 0 ] },
              
              ],
		
		"iDisplayStart": 0,
		"sPaginationType": "full_numbers",
		"oLanguage": {
			"sSearch": "Search all columns:"
		},

		"rowCallback": function( row, data ) {
				 $(row).attr("id",data.id);
				  return row;
			},
		 'fnServerData': function (url, data, callback){
			/* Add some extra data to the sender */

			 $.ajax
              ({
                           "dataType": 'json', 
                           "type": "POST", 
                           "url": url, 
                           "data": data, 
                           "success": function(json) {
                               callback(json);
                              // updateUserStatusPanel();;
                               if(last_id > 0){
                                     // $('#listings_row #'+last_id+' td').addClass('yellowCSS');
                                }

                       }
                       });
		}

	});

	/* End Date search */
	$("thead input").keyup(function() {
		/* Filter on the column (the index) of this element */
		oTable_Doc.fnFilter(this.value, $(this).attr('id'));
		$('#reset_filter').css('display', '');
	});

	$("thead select").change(function() {
		/* Filter on the column (the index) of this element */
		oTable_Doc.fnFilter(this.value, $(this).attr('id'));
		$('#reset_filter').css('display', '');
	});

	//reset filter and drawtable
	$("#reset_filter").click(function() {
		sortActivities = false;
		$("#myForm2")[0].reset();

		oTable_Doc.fnDraw(false);
		oTable_Doc.fnFilterClear(true);

		$('#reset_filter').css('display', 'none');
	});

    $("#new_document").click(function() {
        $("#document_id").val("");
        $("#edit_document").hide();
        $(".file_wrapper").show();
        $("#buttonUpload").show();
        $("#buttonUpdateDoc").hide();
        $("#category_id, #upload_document_name").val("");
    });

    $("#edit_document").click(function() {
        $(".file_wrapper").hide();
        $("#buttonUpload").hide();
        $("#buttonUpdateDoc").show();
    })
	//change css of selected row	
	$(document.body).on("click", "#listings_row tbody tr", function(event) {
		if (formDataChange == false) {
			$("td.yellowCSS", oTable_Doc.fnGetNodes()).removeClass('yellowCSS');
			$(event.target).parent().find("td").addClass('yellowCSS');
		}
	});

	// check box delete
	$(document.body).on("click", '.dbstatus_document', function() {
		if ($('#listings_row_documents input').is(':checked')) {
			if (confirm("Are you sure you want to " + $(this).attr('id') + "?")) {
				var allVals = [];
				type = $(this).attr('id');
				$('input[type="checkbox"]:checked').each(function() {
					allVals.push($(this).val());
					name = $(this).attr('id');
				});

				$.post(config.baseUrl + 'cportal/status_document/', {
						ids: allVals,
						type: $(this).attr('id')
					},
					function(data) {
						refresh_doc_datatable();
						$("#myForm_document")[0].reset();
					}
				);
			}
		} else {
			$('#checkbox_error').show(400);
		}
	});

    $(document.body).on("click", '#listings_row_documents tbody tr', function() {
        if (formDataChange == true) {
            var result = confirm("You have not saved the data, all changes will be lost!")
        }

        if (result == true || formDataChange == false) {
            var id = $(this).attr('id');
            getSingleRow_documents(id);
            $("#notice_view").html('loading...');
        }
    });


    function getSingleRow_documents(id) {
        //$('#new_document, #edit_document').css('display', '');
        animate_the_form_table_on_click();

        $.getJSON(config.baseUrl + "cportal/document_single/" + id, function(json) {
            $("#id").val(json.id);
            $("#upload_document_name").val(json.name);
            $("#category_id").val(json.category_id);
            $("#document_id").val(json.id);
            $('#edit_document').css('display', (accessLevel == 3 && userId != json.user_id ? 'none' : ''));

            $('#showdata').css('color', '#49AC44');
            $('#showdata').html('Record selected')
            $('#showdata').fadeIn("slow");
            setTimeout(function() {
                $('#showdata').fadeOut("slow");
            }, 5000);
        }); //End json

        formDataChange = false;

        if (flag != 'readonly') {
           // disable_popup();
        } else {
          //  enable_popup();
        }
    }

    $("#buttonUpdateDoc").on("click", function() {
        var doc_id = $.trim($("#document_id").val());
        if(!doc_id) {
            $("#popup1 .close").trigger("click");
            alert("Please select a record to edit");
            return false;
        }
        var doc_name = $.trim($("#upload_document_name").val());
        if(!doc_name) {
            alert('Please enter the document name!');
            return false;
        }
        var data = {
            id: doc_id,
            name: doc_name,
            category_id: $("#category_id").val()
        };
        $.ajax({
            url: config.baseUrl + "cportal/updateDocument",
            data: data,
            type: 'post',
            success: function() {
                refresh_doc_datatable()
                $("#popup1 .close").trigger("click");
            },
            error: function() {
                refresh_doc_datatable()
                $("#popup1 .close").trigger("click");
            }
        })
    });

    $("#doc_cancel").on("click", function() {
        $("#category_id, #upload_document_name, #upload_documents").val("");
        $("#popup1 .close").trigger("click");
        $(".edit_document").hide();
    });
	//disable_popup();

});


function ajaxFileUpload_document() {
	if ($('#upload_document_name').val() != '') {

		$("#loading").ajaxStart(function() {
			$(this).show();
		}).ajaxComplete(function() {
			$(this).hide();
		});

		$.ajaxFileUpload({
			url: config.baseUrl + 'noticeboard/uploadDocuments/',
			secureuri: false,
			fileElementId: 'upload_documents',
			dataType: 'text',
			data: {
				name: $('#upload_document_name').val()
            },
			success: function(data) {
				
				// if (typeof(data.error) != 'undefined') {
					// if (data.error != '') {
						// alert(data.error);
					// } else {
						// //alert(data.msg);
						$('#upload_document_name').val('');
                        $("#popup1 .close").trigger("click");
						 refresh_doc_datatable()
					// }
				// }
			},
			error: function(data, status, e) {
				alert(e);
			}
		})
		return false;
	} else {
		alert('Please enter the document name!');
	}
}

function toggleChecked_notices(status) {
	var value = [];
	var count = 0;

	$("#listings_row_notices input").each(function() {
		$(this).attr("checked", status);
		if ($(this).val() != '') {
			value += $(this).attr('value') + ',';
			count++;
		}
	});
}

$(document).ready(function() {
	// $('#tabs li a:not(:first)').addClass('inactive');
	// $('.tabContainer:not(:first)').hide();
	// $('#tabs li a').click(function() {
		// $('#tabs li').removeClass('active');
		// $(this).parent().removeClass('inactive');
		// $(this).parent().addClass('active');
		// var tab = $(this).attr('href');
		// active_tab = $(this).attr('tab');
		// // tabs code edit
		// if ($(this).attr('tab') == 'tab2') {
			// $.post(config.baseUrl + "cportal/targets_and_commission/", {
					// 1: $('#1').val()
				// },
				// function(data) {
					// $('#tab2').html(data);
				// });
		// } else if ($(this).attr('tab') == 'tab1') {}
		// // tab code edit
		// if ($(this).hasClass('inactive')) { //added to not animate when active
			// $('#tabs li a').addClass('inactive');
			// $(this).removeClass('inactive');
			// $('.tabContainer').hide();
			// $(tab).fadeIn('slow');
		// }
		// return false;
	// })
});

$().ready(function() {
	$('#notice').tinymce({
		// Location of TinyMCE script
		script_url: config.baseUrl + 'js/plugins/tiny_mce/tiny_mce.js',
		// General options
		width: "830",
		height: "300",
		theme: "advanced",
		theme_advanced_toolbar_align: "left",
		theme_advanced_statusbar_location: "bottom",
		theme_advanced_toolbar_location: "top",
		theme_advanced_buttons1: "bold,italic,underline,strikethrough,bullist,numlist,",
		theme_advanced_buttons2: "",
		theme_advanced_buttons3: "",
		theme_advanced_buttons4: "",
		plugins: "paste",
		// encoding : "xml",
		// Example content CSS (should be your site CSS)
		content_css: config.baseUrl + "mydata/content.css",
		//
		apply_source_formatting: true,
		// Replace values for the template plugin
		template_replace_values: {
			username: "Some User",
			staffid: "991234"
		}
	});
});