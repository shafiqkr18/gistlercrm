$(document).ready(function() {
	/* Start Date search */
	getTotalBalance();
	get_deals_html();
    $("input").tooltip();
    $('#myForm input, #myForm select, #myForm textarea').attr('disabled', 'disabled');
    formDataChange=false;
    $("#amount").numeric();
    
    $("#new").click(function() {
            $("#myForm")[ 0 ].reset();
            $('#type').val("");
            $('#sub_type').val("");
            $("#created_by_name").val(username);
            $("#bank_id").val(selectedBankId);
    });
    
    $("#edit").click(function() {
            $("#amount").attr('disabled', 'disabled');
            $("#transaction").attr('disabled', 'disabled');
    });
    
    $('body').on("click", ".modal-link-leads3" , function() {
        $('#listings_viewing_html').html('');
        return false;
    });
    
    $('span.modal-close').click(function() {
        $(this).parents('div.modal-box').fadeOut('fast');
    });
    $('span.dismiss').click(function() {
        $(this).parents('div.modal-box').fadeOut('fast');
    });
    $('span.save').click(function() {
        // **** If you need to save or submit information - add your appropriate ajax code here
        $(this).parents('div.modal-box').fadeOut('fast');
    });
    

    
    $("#transaction").change(function(e){
        $('#type').html('');
        $("<option value=''>Select Category</option>").appendTo($('#type'));
        if(typesData[$(this).val()] != null){
            $.each(typesData[$(this).val()], function(k, v){
                $('<option></option>').val(k).text(v).appendTo($('#type'));
            });
       }
       sortDropDownListByText('type');
        
    });
    $("#type").change(function(e){
        $('#sub_type').html('');
        $("<option value=''>Select Sub Category</option>").appendTo($('#sub_type'));
        if(subTypesData[$(this).val()] != null){
            $.each(subTypesData[$(this).val()], function(k, v){
                $('<option></option>').val(k).text(v).appendTo($('#sub_type'));
            });
            sortDropDownListByText('sub_type');
        }
    });
    
    $("#bankName").change(function(e){
           if($("select[name='bankName'] option:selected").index() > 0 ){
               if(formDataChange==true){
                    var result = confirm("You have not saved the data, all changes will be lost!");
               }
               if(result==true || formDataChange==false){
                    selectedBankId = $("select[name='bankName'] option:selected").val();
                    last_id = 0;
                    $('#ExportToCSVALL').html('<div style="display:none;" id="downloadCSV_animation"><img src="<?= base_url() ?>application/views/images/ajax-loader.gif" width="48" height="48" /><br>Download CSV in progress. Please wait.</div><a id="downloadCSV_div" class="popup_a" href="<?= base_url() ?>accounts/exportCSV?exportCSV=accounts&bankId='+ selectedBankId +'"><img src="<?= base_url() ?>application/views/images/excel_big.png?ts=10" width="32" height="32"><br>Download Excel</a>'); // update download button link
                    oTable.fnDraw(false);
                    oTable.fnFilterClear(true);
                    getTotalBalance();
                    $("#myForm")[ 0 ].reset(),
                    $('#type').val(""),
                    $('#sub_type').val(""),
                    $("#bank_id").val(selectedBankId),
                    $('#update, #Save, #cancel,#edit').css('display', 'none');
                    $('#myForm input, #myForm select, #myForm textarea').removeClass('form_fields_error');
                    $('#myForm input, #myForm select, #myForm textarea').attr('disabled', 'disabled');
                    formDataChange = false;
                    $('#new').css('display', 'inline');
                }
                
                if(result == false){
                    $('[name=bankName]').val( selectedBankId );
                }
           }
    });
     // Override default agent field with multiple data sources
    $('#auto_name_field').autocomplete({
     	minLength:2,
        source: mainurl+"accounts/auto_names/",
        select: function (event, ui) {
		$('#agent_id').val(ui.item.id);
        }
    });
    
					
	
	/* End Date search */
	
			
	$("thead input").keyup( function () {
            /* Filter on the column (the index) of this element */
            oTable.fnFilter( this.value, $(this).attr('id') );
            $('#reset_filter').css('display', '');	
	});
	
	$("thead select").change( function () {
            /* Filter on the column (the index) of this element */
            oTable.fnFilter( this.value, $(this).attr('id') );
            $('#reset_filter').css('display', '');
	});
	
	//reset filter and drawtable
	$("#reset_filter").click(function () {
			$("#myForm2")[ 0 ].reset();
			oTable.fnDraw(false);
            oTable.fnFilterClear(true);
			
			$('#reset_filter').css('display', 'none');
			
	});


//change css of selected row	
	$("body").on("click","#listings_row tbody tr" , function(event){
	if(formDataChange==false){
	  $("td.yellowCSS", oTable.fnGetNodes()).removeClass('yellowCSS');
	  $(event.target).parent().find("td").addClass('yellowCSS');
	}
	});
			
	
// check box delete

	$('body').on("click", ".dbstatus", function() {   
		
	if($('#listings_row input').is(':checked')){
		
		if(confirm("Are you sure you want to "+$(this).attr('id')+"?")){
			 var allVals = [];
			 type = $(this).attr('id');
			 $('input[type="checkbox"]:checked').each(function() {
			   allVals.push($(this).val());
			   name=$(this).attr('id');
			 });
			 
			 
                        $.post( mainurl+'accounts/status/', { ids: allVals, type:$(this).attr('id') },
                          function( data ) {

                                 $("#myForm")[ 0 ].reset();
                                 $('#edit').css('display', 'none'); /* This shows the update button when a filed is selected */ 
                                 $('#new').css('display', 'inline'); /* This shows the update button when a filed is selected */ 
                                  oTable.fnDeleteRow( 47 );

                                  $('#showdata').html(data);
                                  $('#showdata').animate({ 'color': 'red'}, "slow");
                          }
                        );
		}
	 }
	 else {
	 	$('#checkbox_error').show(400);
		//alert('Please check atleast one entry!');
	 }
     });
	 
	disable_popup();
	
	$('#myForm').ajaxForm({
		  beforeSubmit : function() { 
		  return $("#myForm").validate({rules: { amount: { number: true }} , errorClass: 'form_fields_error',  errorPlacement: function(error, element) {
						$('#showdata').animate({ 'color': 'red'}, "slow");
						$('#showdata').fadeIn("slow");
						$('#showdata').html('Please complete all required fields');
						setTimeout(function() {  
							$('#showdata').fadeOut("slow");
							$('#showdata').animate({ 'color': 'red'}, "slow");
					    }, 5000);
						
					//alert('Please fill the required fields')
				}}).form() ;
		  },
		  target: '#showdata',
		  success: function(message) {
                              if(message === "Saved Successfully" || message === "Updated Successfully"){
                                  fnClickAddRow(),
                                  getTotalBalance(),
                                  formDataChange=false;
                                    // if($("#id").val()==0){ 
                                            // $.ajax({
                                                    // async: false,
                                                    // url: mainurl+'accounts/getlastid/',
                                                    // success: function(data) {
                                                          // last_id=data;
                                                    // }
                                                  // })
                                    // }
                                    $("#cancel").click(),
                                    $("#myForm")[ 0 ].reset(),
                                    $('#showdata').html(message),
                                    $('#showdata').animate({ 'color': '#49AC44'}, "slow"),
                                    $('#showdata').fadeIn("slow"),
                                    setTimeout(function() {  
                                          $('#showdata').fadeOut("slow")
                                    }, 2000);
                              }else{
                                  $('#showdata').animate({ 'color': '#de5244'}, "slow");
                                  $('#showdata').fadeIn("slow");
                                  $('#showdata').html('Please add initial balance transaction for this account');
                                  setTimeout(function() {  
                                        $('#showdata').fadeOut("slow");
                                        $('#showdata').animate({ 'color': 'red'}, "slow");
                                   }, 2000);
                              }
			  
		  }
	});
    $('#downloadVerificationForm').ajaxForm({
		  beforeSubmit : function() { 
		  return $("#downloadVerificationForm").validate({errorClass: 'form_fields_error',  errorPlacement: function(error, element) {
						$('#showPasswordError').animate({ 'color': '#de5244'}, "slow");
						$('#showPasswordError').fadeIn("slow");
						$('#showPasswordError').html('Please enter password.');
						setTimeout(function() {  
							$('#showPasswordError').fadeOut("slow");
							$('#showPasswordError').animate({ 'color': '#de5244'}, "slow");
					    }, 2000);
						
					//alert('Please fill the required fields')
				}}).form() ;
		  },
		  target: '#showPasswordError',
		  success: function(data) {
                              if( data == 'valid'){
                              	console.log('Came Here');
                                    $('#downloadAllCSVVerification').fadeOut("slow");
                                    $('#ExportToCSVALL').fadeIn("slow");
                               }else{
                                   $('#showPasswordError').animate({ 'color': '#de5244'}, "slow");
						$('#showPasswordError').fadeIn("slow");
						$('#showPasswordError').html('Verification Failed');
						setTimeout(function() {  
							$('#showPasswordError').fadeOut("slow");
							$('#showPasswordError').animate({ 'color': '#de5244'}, "slow");
					    }, 2000);
                               }
		  }
	});
			
    $('#downloadSelectedCSVVerificationForm').ajaxForm({
		  beforeSubmit : function() { 
		  return $("#downloadSelectedCSVVerificationForm").validate({errorClass: 'form_fields_error',  errorPlacement: function(error, element) {
						$('#showPasswordError2').animate({ 'color': '#de5244'}, "slow");
						$('#showPasswordError2').fadeIn("slow");
						$('#showPasswordError2').html('Please enter password.');
						setTimeout(function() {  
							$('#showPasswordError2').fadeOut("slow");
							$('#showPasswordError2').animate({ 'color': '#de5244'}, "slow");
					    }, 2000);
						
					//alert('Please fill the required fields')
				}}).form() ;
		  },
		  target: '#showPasswordError2',
		  success: function(data) {
                              if( data == 'valid'){
                                    $('#downloadSelectedCSVVerification').fadeOut("slow");
                                    $('#ExportToCSVSelected').fadeIn("slow");
                               }else{
                                   $('#showPasswordError2').animate({ 'color': '#de5244'}, "slow");
						$('#showPasswordError2').fadeIn("slow");
						$('#showPasswordError2').html('Verification Failed');
						setTimeout(function() {  
							$('#showPasswordError2').fadeOut("slow");
							$('#showPasswordError2').animate({ 'color': '#de5244'}, "slow");
					    }, 2000);
                               }
		  }
	});
});

$('body').on("click", "#listings_row tbody tr" , function() {
    if(formDataChange==true){
            var result=confirm("You have not saved the data, all changes will be lost!")
    }

    if(result==true || formDataChange==false){
             var id=$(this).attr('id');
             getSingleRow(id);
    }
}); //End click
$("body").on("change","#columns_list input",function(event){
	console.log('caled');
    fnShowHide( $(this).attr('col') );
    $('#total_active_columns').html($('#columns_list input:checked').length);
});
	
$("body").on("click","#save_columns_settings",function(event){
		var disabled_columns_array = [];
		$('#columns_list input[type="checkbox"]:unchecked').each(function() {
		    disabled_columns_array.push($(this).attr('col'));
	    });
	 
        $.post(mainurl+"accounts/save_disabled_columns/", { 
		    columns: disabled_columns_array 
			}, function(info) {
		    $('a.close').click();
	    });
});
	
$("body").on("click","#reset_columns_settings" ,function(event){
    $('#columns_list input[type="checkbox"]').each(function() {
        if($(this).attr('checked')=='checked' && $(this).attr('default')=='not_default'){
            fnShowHide( $(this).attr('col') );
            $(this).attr('checked', false);
        }else if($(this).attr('checked')==false && $(this).attr('default')!='not_default'){
            fnShowHide( $(this).attr('col') );
            $(this).attr('checked','checked');
        }
        $('#total_active_columns').html($('#columns_list input:checked').length);
    });
    setDatatableWidth();
});


function getSingleRow(id){	
        $('#update, #Save, #cancel').css('display', 'none');
        $('#edit, #new').css('display', 'inline');
        $('#myForm input, #myForm select, #myForm textarea').attr('disabled', 'disabled');
        animate_the_form_table_on_click();
        $.getJSON(mainurl+"accounts/single/"+id, function(json){ 
                $.each(json, function(key, val) {
                        $("#"+key).val(val);
                });
                
                if(json.agent_id == 0){
                    $("#auto_name_field").val(json.name);
                    previousAgentId = 0;
                    previousAgentName = json.name;
                }else{
                    $("#auto_name_field").val(json.agent_name);
                    previousAgentId = json.agent_id;
                    previousAgentName = json.agent_name;
                }
                
                $('#type').html('');
                $("<option value=''>Select Category</option>").appendTo($('#type'));
                if(typesData[$('#transaction').val()] != null){
                $.each(typesData[$('#transaction').val()], function(k, v){
                        if(k == json.type){
                           $('<option selected=\'selected\'></option>').val(k).text(v).appendTo($('#type'));
                        }else{
                           $('<option></option>').val(k).text(v).appendTo($('#type'));
                        }
                    });
                }
                sortDropDownListByText('type');

                $('#sub_type').html('');
                $("<option value=''>Select Sub Category</option>").appendTo($('#sub_type'));
                if(subTypesData[$('#type').val()] != null){
                        $.each(subTypesData[$('#type').val()], function(k, v){
                        if(k == json.sub_type){
                           $('<option selected=\'selected\'></option>').val(k).text(v).appendTo($('#sub_type'));
                        }else{
                           $('<option></option>').val(k).text(v).appendTo($('#sub_type'));
                        }
                    });
                }
                sortDropDownListByText('sub_type');

                
                /* get notes */	
                plot_notes('accounts', '[' + json.notes + ']');
                //get_notes('accounts',json.id);
                last_id = json.id;
                $('#showdata').css('color','#49AC44');
                $('#showdata').html('Record selected')
                $('#showdata').fadeIn("slow");
                   setTimeout(function() {  
                           $('#showdata').fadeOut("slow");
                   }, 5000);
                $('#transaction').attr('disabled', true);
                formDataChange = false;

        }); //End json 
}

function getTotalBalance(){
    $.getJSON(mainurl+"accounts/getTotalBalance/"+selectedBankId, function(data){ 
        if(data.total !== null){
            $("#account_current_balance").html(data.currencyCode + ' ' + data.total);
            if(parseInt(data.total) > 0){
                $("#account_current_balance").removeClass("debit").addClass("credit");
            }else{
                $("#account_current_balance").removeClass("credit").addClass("debit");
            }
        }
    });
}
    
function accounts_checkboxes(value){
    $('#ExportToCSVSelected').html('<a class="popup_a" href='+mainurl+'accounts/exportCSV?bankId='+ selectedBankId +'&exportCSV='+value+'><img src='+mainurl+'application/views/images/excel_big.png?ts=10" width="32" height="32"><br>Download Excel</a>'); 	
}

function get_deals_html(id) {
    // $.post(mainurl+'popup/link_deal_popup_new/', {id: id},
    // function(data) {
       // $('#leads_viewing_html').html(data);
    // });
    $.post(mainurl+"common/view_deal_popup", { 
						id:  id
						},
						function(data) {
						$("#view_deal_window").html(data);
					});
}

function fnClickAddRow() {
	$('#listings_row').dataTable().fnAddData( [
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

function setDatatableWidth(){
	var TotalColumnsUnchecked = $('#columns_list input:checked').length;
	
	if(TotalColumnsUnchecked<18){
	    $('#listings_row').css('width', '100%');
    }
	if(TotalColumnsUnchecked>17){
	    $('#listings_row').css('min-width', TotalColumnsUnchecked*80+'px'); 
	}else{
	    $('#listings_row').css('min-width', '1250px');
    }
}

function fnShowHide( iCol ){
    var oTable = $('#listings_row').dataTable();
    var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;

    if(bVis==true){
        $('#searchbox tr').find("td:nth-child("+((iCol*1)+2)+")").css('display', 'none');
    } else if(bVis==false){
        $('#searchbox tr').find("td:nth-child("+((iCol*1)+2)+")").css('display', '');
    }
    oTable.fnSetColumnVis( iCol, bVis ? false : true );
    setDatatableWidth();
}
	

function sortDropDownListByText(selectId) {
    var foption = $('#'+ selectId + ' option:first');
    var soptions = $('#'+ selectId + ' option:not(:first)').sort(function(a, b) {
       return a.text == b.text ? 0 : a.text < b.text ? -1 : 1
    });
    $('#' + selectId).html(soptions).prepend(foption);              
};