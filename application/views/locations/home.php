<script type="text/javascript">
var screenname = 'location-text';  
</script>
<div id="wrapper">
            <div class="container">
            
            
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                	<div class="page_head_area"><h1><i class="fa fa-home"></i> Locations Text</h1></div>
                </div>
            </div>
            

             <!-- Error Message Alert -->
             <div role="alert" class="alert alert-danger alert-dismissible fade in" id="errorMsg" style="display:none;">
              <button aria-label="Close" data-dismiss="alert" class="close" type="button">
              <span aria-hidden="true">×</span></button>
              <strong>Error!</strong> <span id="errortxt">here is error text</span> 
            </div> 
            
            <!-- Success Message Alert -->
             <div role="alert" class="alert alert-success alert-dismissible fade in" id="successMsg" style="display:none;">
              <button aria-label="Close" data-dismiss="alert" class="close" type="button">
              <span aria-hidden="true">×</span></button>
              <strong>Success!</strong> <span id="successtxt">here is success text</span>  
            </div> 
            
            <!-- Info Message Alert -->
             <div role="alert" class="alert alert-info alert-dismissible fade in" id="infoMsg" style="display:none;">
              <button aria-label="Close" data-dismiss="alert" class="close" type="button">
              <span aria-hidden="true">×</span></button>
              <strong>Info!</strong> <span id="infotxt">here is error text</span>  
            </div> 
            
            
            <div id="inner_tab">
            
            
            <div class="row">
            <div class="col-lg-12">
            <!-- Nav tabs -->
            <div class="inner_tab_nav">
                <ul class="nav nav-tabs">
                <?php
				if($listing_type == 1){?>
                  <li><a href="<?php echo site_url('listings/rentals');?>">United Arab Emirates</a></li>
                  
                    <li   class="active"><a href="<?php echo site_url('listings/locations-text-rentals');?>">Location Text</a></li>
                    <li><a href="<?php echo site_url('listings/price-index-rentals');?>">Rental Price Index</a></li>
                    <?php }else{?>
                    
                      <li  ><a href="<?php echo site_url('listings/sales');?>">United Arab Emirates</a></li>
                   
                    <li class="active"><a href="<?php echo site_url('listings/locations-text-sales');?>">Location Text</a></li>
                    <li><a href="<?php echo site_url('listings/price-index-sales');?>">Sales Price Index</a></li>
                    
                    
                    <?php }?>
                </ul>
            </div>
            
                    
            <!-- Tab content -->
            <div class="tab-content">
           <?php
		 $attributes = array('data-toggle' => 'validator', 'id' => 'setting_form', 'role' => 'form','name'=>'setting_form');
	    echo form_open_multipart('common/save', $attributes);
        ?>
            <div class="row">
            <div class="col-lg-12" id="ctrl">
            
            <input type="hidden" id="setting_ids" name="setting_ids" value="" />
    		<input type="hidden" id="hdn_setting_id" name="hdn_setting_id" value="" />
            <input type="hidden" id="listing_type" name="listing_type" value="<?php echo $listing_type;?>" />
    		  <button type="button" id="new_location_description" class="btn btn-lg btn-success"><i class="fa fa-plus-circle"></i>New Location Description</button>
               <button type="button" id="new_sub_location_description" class="btn btn-lg btn-success"><i class="fa fa-plus-circle"></i>New Sub Location Description</button>
                  <button  style="display:none;" type="submit" id="save_new_location"  class="btn btn-lg btn-success" name="save_new_location" value="Save description">
            <i class="fa fa-plus-circle"></i> Save description</button>
               

            <button  style="display:none;" type="submit" id="update_new_location"  class="btn btn-lg btn-success" name="update_new_location" value="Update description">
            <i class="fa fa-plus-circle"></i> Save </button>
          
       
                <button  style="display:none;" type="button" id="edit_setting" class="btn btn-lg btn-warning"><i class="fa fa-plus-circle"></i>Edit</button>
            <a href="javascript:void(0)" id="cancel_setting" class="btn btn-lg btn-default"  style="display:none;"><i class="fa fa-times"></i> Cancel</a>
          
            
            </div>
            </div>
            
            
            <div class="row">
                <h4 class="add_new_rental">Add New Location or Sub-Location Description</h4>
            </div>
            <p>Add generic location and sub-location (building) descriptions here. When adding normal property listing descriptions on the listings screens you can easily import these generic descriptions and append them to the bottom of your listings descriptions to increase the length of your descriptions and help achieved higher rankings on the various portals. Currently only descriptions for UAE locations and sub-locations can be added.</p>
            
            <div class="row fadeInUp">
            <div class="col-md-6">
            	<div class="form-group">
                    <label>Emirate</label>
                   <select id="region_id" name="region_id" class="selectpicker show-tick form-control required input-sm" required>
                  
                                    <option selected="" value="">Select</option>
											<option value="2">Abu Dhabi</option>
                                        	  <option value="4">Ajman</option>
                                        	  <option value="8">Al Ain</option>
                                        	   <option value="1">Dubai</option>
                                        	    <option value="7">Fujairah </option>
                                        	     <option value="6"> Ras Al Khaimah	 </option>
                                        	      <option value="3">Sharjah	 </option>
                                        	         <option value="5"> Umm Al Quwain </option>
                                                                        </select>
                </div>
                 <div class="form-group">
                    <label>Location </label>
                   
                  <select name="area_location_id" class="selectpicker show-tick form-control input-sm required"  id="area_location_id" style="z-index: 10000;">
                                	<option value="0" selected>Select</option>
                            	</select>
                </div>
                <div class="form-group" id="sub_location_tr">
                    <label>Sub-Location </label>
                   
                  <select name="sub_area_location_id" class="selectpicker show-tick form-control input-sm required"  id="sub_area_location_id">
                                	<option value="0" selected>Select</option>
                            	</select>
                </div>
            
            </div>
            <div class="col-md-6">
            	<div class="form-group">
                    <label>Description </label>
                   <textarea id="description" rows="50" cols="200" class='form-control required' name="description"  aria-hidden="true">
                            	</textarea>
                </div>
            </div>
                       
            </div>
            <?php echo  form_close();?>
            <!-- Location Text End -->
            </div>
            </div>
            </div>
            
            
            <div class="row fadeInUp">
            <div class="col-lg-12">
            <div class="tab-content">
              <div class="row">
                <table class="table table-bordered table-striped table-condensed table-hover datatables" id="datatable_rows">
                    <thead>
                      <tr>
                        <th>
                        <label class="">
                               <input  style="width:15px; margin-right:-10px;" onClick="toggleChecked(this.checked)" id='check_all_checkboxes' value='' type="checkbox">
                                <span class="lbl"></span>
                         </label>
                        </th>
                        <th>Emirate</th>
                        <th>Location</th>
                        <th>Sub-Location</th>
                        <th>Description</th>
                        <th>Updated</th>
                      </tr>
                      
                      <tr class="highlighted">
                        <td></td>
                        <td>
                            <select name="1" class="form-control "  id="1" tabindex="6">
	                                <option value="0" selected>Select</option>
	                                	                                    <option value="Abu Dhabi">
	                                        Abu Dhabi	                                    </option>
	                                	                                    <option value="Ajman">
	                                        Ajman	                                    </option>
	                                	                                    <option value="Al Ain">
	                                        Al Ain	                                    </option>
	                                	                                    <option value="Dubai">
	                                        Dubai	                                    </option>
	                                	                                    <option value="Fujairah">
	                                        Fujairah	                                    </option>
	                                	                                    <option value="Ras Al Khaimah">
	                                        Ras Al Khaimah	                                    </option>
	                                	                                    <option value="Sharjah">
	                                        Sharjah	                                    </option>
	                                	                                    <option value="Umm Al Quwain">
	                                        Umm Al Quwain	                                    </option>
	                                	                            </select>
                            </td>
                        <td><input type="text" class="form-control input-sm"></td>
                        <td><input type="text" class="form-control input-sm"></td>
                        <td></td>
                        <td></td>
                      </tr>
                      
                      
                    </thead>
                
                <tbody>
     
        
      </tbody>
                
                </table>
                
                
                
                
                
              </div>
            </div>
            </div>
            </div>
            
            

 			</div>
            </div>
            <!-- container end -->
            
            
            </div>
            <style>
    #sub_location_tr{
        display: none;
    }
    #description_parent{
        display: block !important;

    }
</style>
              <script type="text/javascript" src="<?php echo site_url();?>js/plugins/tiny_mce/jquery.tinymce.js?ts=10"></script> 
              
              <script type="text/javascript">
   function disableEditor() {

            try {
                if ((typeof(tinymce) != undefined) && typeof(tinymce.activeEditor) != undefined) {
                    tinymce.activeEditor.getBody().setAttribute('contenteditable', false);
                } else {
                    setTimeout(function() {
                        disableEditor()
                    }, 1000);
                }
            } catch (e) {
                setTimeout(function() {
                    disableEditor()
                }, 1000);
            }
        }




    $(document).ready(function() {
        var readOnlyFlag = "editable";
		//$("#setting_form :input").not('#ctrl :input').prop("disabled", true);
		addDisabledSelect();
        
        

        function hideAllButtons() {
            $('#edit_setting').remove();
            $('#save_new_location').remove();
            $('#update_new_location').remove();
            $('#cancel_setting').remove();
            $('#new_sub_location_description').remove();
            $('#new_location_description').remove();
            $('#successMsg').remove();
        }
        
        function removeDisabledSelect() {
			
            $('#region_id').removeAttr('disabled');
            $('#area_location_id').removeAttr('disabled');
            $('#sub_area_location_id').removeAttr('disabled');
			$('.selectpicker').selectpicker('refresh');
        }
        function addDisabledSelect() {
            $('#region_id').attr('disabled', 'disabled');
            $('#area_location_id').attr('disabled', 'disabled');
            $('#sub_area_location_id').attr('disabled', 'disabled');
			$('.selectpicker').selectpicker('refresh');
        }

        function validateSelect() {
            if ($('#region_id').val() == 0) {
                alert("Please select emirate.");
                return false;
            }

            if ($('#area_location_id').val() == 0 || $('#area_location_id').val() == '') {
                alert("Please select location.");
                return false;
            }

            if ($('#sub_area_location_id').is(':visible')) {
                if ($('#sub_area_location_id').val() == '' || $('#sub_area_location_id').val() == 0) {
                    alert("Please select sub-location.");
                    return false;
                }
            }

            if ($('#description').val() == '') {
                alert("Enter description");
                return false;
            }
            return true;
        }

        function checkDuplicateSetting(settingType, location_id, sub_location_id) {

            var responseText = "0";
            switch (settingType) {
                case 'location':
                    responseText = $.ajax({
                        url: config.siteUrl+"common/checkLocationInsertSettings/" + location_id,
                        type: 'POST',
                        async: false
                    }).responseText;
                    break;

                case 'sublocation' :
                    responseText = $.ajax({
                        url: config.siteUrl+"common/checkSubLocationInsertSettings/" + sub_location_id,
                        type: 'POST',
                        async: false
                    }).responseText;
                    break;
            }

            return $.parseJSON(responseText);



            /**
             * success: function(response) {
             if (response.id) {
             var area_loc_id = confirm("This location already exists. Do you want to edit it?")
             if (area_loc_id == true) {
             $('#' + response.id).click();
             $('#edit_setting').click();
             removeDisabledSelect();
             } else {
             $('#setting_form')[0].reset();
             addDisabledSelect();
             disableEditor();
             return false;
             }
             }
             }
             
             
             
             
             success: function(response) {
             if (response.id) {
             var area_loc_id = confirm("This sub-location already exists. Do you want to edit it?")
             if (area_loc_id == true) {
             $('#' + response.id).click();
             $('#edit_setting').click();
             removeDisabledSelect();
             
             } else {
             $('#setting_form')[0].reset();
             addDisabledSelect();
             disableEditor();
             return false;
             }
             }
             }
             */

        }


        function displayEditRow(row_id, event, ignoreSingleRow) {

            getSingleRow(row_id, ignoreSingleRow);
            
            if(readOnlyFlag != 'readonly') {
                $('#edit_setting').css('display', 'inline-block');
                $('#save_new_location').css('display', 'none');
                $('#update_new_location').css('display', 'none');
                $('#cancel_setting').css('display', 'none');
                $('#new_sub_location_description').css('display', 'inline-block');
                $('#new_location_description').css('display', 'inline-block');
                $('#successMsg').css('color', '#49AC44');
                $('#successMsg').html('Record selected');
                $('#successMsg').fadeIn("slow");
            } else {
                hideAllButtons();
            }
                setTimeout(function() {
                    $('#successMsg').fadeOut("slow");
                }, 3000);
                var id = $(this).attr('id');
                $('#hdn_setting_id').val(row_id);
                ignoreClickFlag = true;
                showEditButton = true;

                $(oTable.fnSettings().aoData).each(function() {
                    $(this.nTr).removeClass('row_selected');
                });
                if (event) {
                    $(event.target.parentNode).addClass('row_selected');
                }

                removeDisabledSelect();
            

        }

        function displayEditSetting(location_id) {
         

            //$('#' + location_id).click();
            //shafiq commented
           // displayEditRow($('#' + location_id).attr('id'), null, true);
           displayEditRow(location_id, null, true);
            $('#edit_setting').click();
            removeDisabledSelect();

            return true;

        }

     

        function getSingleRow(id, ignoreSelects) {
            $.get(config.siteUrl+"common/single_setting/" + id, function(json) {
				 json = $.parseJSON(json);
                  $.each(json, function(key, val) {
					 $("#" + key).val(val);
                });
                
                
                
                if (json.area_location_id != 0 && json.region_id != '') {
                    if (!ignoreSelects) {
                        $('#region_id').trigger('change');
                        $('#area_location_id').val(json.area_location_id);
                        addDisabledSelect();
                    }
                    //removeDisabledSelect();
                }
                if (json.sub_area_location_id != 0 || json.area_location_id != 0) {
                    if (!ignoreSelects) {
                        $('#area_location_id').trigger('change');
                        $('#sub_area_location_id').val(json.sub_area_location_id);
                        addDisabledSelect();
                    }
                }
                if (window.parseInt(json.sub_area_location_id) !== 0) {
                    $('#sub_location_tr').show();
                } else {
                    $('#sub_location_tr').hide();
                }

            }); //End json 

        }




        ignoreClickFlag = false;
        locationChangeIgnoreFlag = false;
        var lastEditId = false;

        $('#new_location_description').click(function(e) {
			removeDisabledSelect
            showEditButton = false;
            $('#sub_location_tr').hide();
            removeDisabledSelect();
            $('#save_new_location').css('display', 'inline-block');
            $('#cancel_setting').css('display', 'inline-block');
            $('#new_sub_location_description').css('display', 'none');
            $('#new_location_description').css('display', 'none');
            $('#edit_setting').css('display', 'none');
            $('#setting_form')[0].reset();
            tinymce.activeEditor.getBody().setAttribute('contenteditable', true);
        });

        $('#new_sub_location_description').click(function(e) {

            showEditButton = false;
            $('#sub_location_tr').show();
            removeDisabledSelect();
            $('#save_new_location').css('display', 'inline-block');
            $('#cancel_setting').css('display', 'inline-block');
            $('#new_sub_location_description').css('display', 'none');
            $('#new_location_description').css('display', 'none');
            $('#edit_setting').css('display', 'none');
            $('#setting_form')[0].reset();
            tinymce.activeEditor.getBody().setAttribute('contenteditable', true);
        });

        $('#new_sub_location_description').click(function(e) {
            $('#sub_location_tr').show();
        });

        $('.form_fields_table').click(function() {
            ignoreClickFlag = false;
        });

        $('#setting_form').click(function(e) {
            ignoreClickFlag = false;
        });

        $('#area_location_id').change(function() {

            if ($('#sub_area_location_id').is(":visible")) {
                return;
            }

            if ((ignoreClickFlag === false) && (locationChangeIgnoreFlag === false)) {

                var area_location_id = $('#area_location_id').val();
                var duplicateAreaId = checkDuplicateSetting('location', area_location_id, 0);
               
                var t = JSON.parse(duplicateAreaId);
               
                if (duplicateAreaId !== 0) {
                    var area_loc_id = confirm("This location already exists. Do you want to edit it?")
                    if (area_loc_id == true) {
                        //locationChangeIgnoreFlag = true;
                        displayEditSetting(t['id']);
                        ignoreClickFlag = false;

                    } else {
                        $('#setting_form')[0].reset();
                        addDisabledSelect();
                        disableEditor();
                        $('#save_new_location').css('display', 'none');
                        $('#cancel_setting').css('display', 'none');
                        $('#new_sub_location_description').css('display', 'inline-block');
                        $('#new_location_description').css('display', 'inline-block');
                        $('#update_new_location').css('display', 'none');
                        return false;
                    }
                }
            }
        });

        $('#sub_area_location_id').change(function() {

            if ((ignoreClickFlag === false) && (locationChangeIgnoreFlag === false)) {
                var sub_area_location_id = $('#sub_area_location_id').val();

                var duplicateSubAreaId = checkDuplicateSetting('sublocation', 0, sub_area_location_id);

                if (duplicateSubAreaId !== 0) {
                    var area_loc_id = confirm("This location already exists. Do you want to edit it?")
                    if (area_loc_id == true) {
                        //locationChangeIgnoreFlag = true;
                        displayEditSetting(duplicateSubAreaId.id);
                        ignoreClickFlag = false;

                    } else {
                        $('#setting_form')[0].reset();
                        addDisabledSelect();
                        disableEditor();
                        $('#save_new_location').css('display', 'none');
                        $('#cancel_setting').css('display', 'none');
                        $('#new_sub_location_description').css('display', 'inline-block');
                        $('#new_location_description').css('display', 'inline-block');
                        $('#update_new_location').css('display', 'none');
                        return false;
                    }
                }

            }
        });

        $('#setting_form').submit(function(e) {

            if (!validateSelect()) {
                return false;
            }

            e.preventDefault();
            removeDisabledSelect();
            $.ajax({
                url: config.siteUrl+"common/save",
                type: 'POST',
                data: $('#setting_form').serialize(),
			    dataType: "json",
                success: function(data) {
                    $('#save_new_location').css('display', 'none');
                    $('#cancel_setting').css('display', 'none');
                    $('#new_location_description').css('display', 'inline-block');
                    $('#new_sub_location_description').css('display', 'inline-block');
                    //data = $.parseJSON(data);
                    oTable.fnDraw();
                   // oTable.fnFilterClear(true);
                    addDisabledSelect();
                    disableEditor();
				
                    if (data.returnthis) {
					    lastEditId = data.returnthis;
                        displayEditRow(lastEditId);
                    }
                }
            });


        });

        $('#update_new_location').click(function(e) {

            removeDisabledSelect();

            if (!validateSelect()) {
                return false;
            }

            $.ajax({
               // url: "https://crm.propspace.com/listings/update_setting",
			    url: config.siteUrl+"common/save",
                type: 'POST',
                data: $('#setting_form').serialize(),
                success: function() {
                    $('#cancel_setting').css('display', 'none');
                    $('#new_sub_location_description').css('display', 'inline-block');
                    $('#new_location_description').css('display', 'inline-block');
                    $('#edit_setting').css('display', 'inline-block');
                    $('#update_new_location').css('display', 'none');
                    oTable.fnFilterClear(true);
                    addDisabledSelect();
                    disableEditor();

                }
            });
        });
        var showEditButton = false;
        $('#cancel_setting').click(function(e) {
            $('#save_new_location').css('display', 'none');
            $('#cancel_setting').css('display', 'none');
            $('#new_sub_location_description').css('display', 'inline-block');
            $('#new_location_description').css('display', 'inline-block');
            $('#update_new_location').css('display', 'none');
            if (showEditButton == true) {
                $('#edit_setting').css('display', 'inline-block');

            } else {
                $('#edit_setting').css('display', 'none');
                $('#setting_form')[0].reset();
            }
            //$('#' + lastEditId).click();
            addDisabledSelect();
            disableEditor();

        });

        $('#edit_setting').click(function(e) {
            //$('#region_id').attr('disabled', false);
            $('#new_location_description').css('display', 'none');
            $('#new_sub_location_description').css('display', 'none');
            $('#edit_setting').css('display', 'none');
            $('#update_new_location').css('display', 'inline-block');
            $('#cancel_setting').css('display', 'inline-block');
            removeDisabledSelect();
            tinymce.activeEditor.getBody().setAttribute('contenteditable', true);
        });

        $('#delete').click(function(e) {

            if ($('#datatable_rows input').is(':checked')) {
                if (confirm("Are you sure you want to " + $(this).attr('id') + "?")) {
                    var allVals = [];
                    $('#datatable_rows input[type="checkbox"]:checked').each(function() {
                        allVals.push($(this).val());
                    });
                    $.ajax({
                        url: "https://crm.propspace.com/listings/delete_setting/",
                        type: 'POST',
                        data: {ids: allVals},
                        success: function() {
                            oTable.fnFilterClear(true);
                            $('#check_all_checkboxes').removeAttr('checked');
                            $('#setting_form')[0].reset();
                            $('#edit_setting').css('display', 'none');
                        }
                    });
                }
            } else {
                $('#checkbox_error').show(400);
            }


        });


        $(document.body).on("click", "#datatable_rows tbody tr", function(event) {
            displayEditRow($(this).attr('id'), event);
            lastEditId = $(this).attr('id');



        });

        $('#region_id').change(function() {
			
            var value = $(this).val();
            var snum_dropdown = '';
            snum_dropdown += '<option value="" selected="selected">Select</option>';
            $.each(location_json_array[value], function(key, val) {
                snum_dropdown += '<option value="' + key * 1 + '" >' + val + '</option>';
            });
			//alert(snum_dropdown);
            $('#area_location_id').html(snum_dropdown);
			$('#area_location_id').selectpicker('refresh');
            $('#sub_area_location_id').val('');
            $('#area_location_id').attr('disabled', false);

        });

        $('#area_location_id').change(function() {
            var value = $(this).val();
            var snum_dropdown = '';
            snum_dropdown += '<option value="0" selected="selected">Select</option>';
            if (sub_location_json_array[value]) {
                $.each(sub_location_json_array[value], function(key, val) {
                    snum_dropdown += '<option value="' + key * 1 + '" >' + val + '</option>';
                });
            }
            $('#sub_area_location_id').html(snum_dropdown);
			$('#sub_area_location_id').selectpicker('refresh');
			
            $('#sub_area_location_id').attr('disabled', false);
            

        });
       
        /* function to redraw datatable */
        $.fn.dataTableExt.oApi.fnFilterClear = function(oSettings)
        {
            oSettings.oPreviousSearch.sSearch = "";
            if (typeof oSettings.aanFeatures.f != 'undefined')
            {
                var n = oSettings.aanFeatures.f;
                for (var i = 0, iLen = n.length; i < iLen; i++)
                {
                    $('input', n[i]).val('');
                }
            }

            for (var i = 0, iLen = oSettings.aoPreSearchCols.length; i < iLen; i++)
            {
                oSettings.aoPreSearchCols[i].sSearch = "";
            }

            oSettings.oApi._fnReDraw(oSettings);
        }
		$("#datatable_rows").dataTable().fnDestroy();
        var oTable = $('#datatable_rows').dataTable({
		 "bProcessing": true,
            "bServerSide": true,
            "sDom": 'R<>rt<ilp><"clear">',
                  'columnDefs': [{
         'targets': 0,
         'searchable':false,
         'orderable':false,
        // 'className': 'dt-body-center',
         'render': function (data, type, full, meta){
			
            // return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
			 return '<div style="text-align:center;"><input style="align:center;" type="checkbox" value="' + data + '"> </div>';
         }
      }],

			
		"columns": [
{ "data": "id" },
{ "data": "region_id" },{ "data": "area_location_id" },
{ "data": "sub_area_location_id"},{ "data": "description" },{ "data": "dateupdated" }
],
		"bServerSide": true,
		 "sAjaxSource": config.siteUrl+"common/datatable_locations",
                "bJQueryUI": true,
                "sPaginationType": "full_numbers",
                "iDisplayStart ":0,
              
       
                'fnServerData': function(sSource, aoData, fnCallback)
            {
              $.ajax
              ({
                'dataType': 'json',
                'type'    : 'POST',
                'url'     : sSource,
                'data'    : aoData,
                'success' : fnCallback
              });
            }
	});
		
        $("#datatable_rows thead input").keyup(function() {
            /* Filter on the column (the index) of this element */
            oTable.fnFilter(this.value, $(this).attr('id'));
            $('#reset_filter').css('display', '');
        });

        $("#datatable_rows thead select").change(function() {

            /* Filter on the column (the index) of this element */
            oTable.fnFilter(this.value, $(this).attr('id'));
            $('#reset_filter').css('display', '');
        });

        $("#reset_filter").click(function() {
            $("#myForm")[ 0 ].reset();
            var oTable = $('#datatable_rows').dataTable();
            oTable.fnDraw(false);
            oTable.fnFilterClear(true);
            $('#reset_filter').css('display', 'none');
        });

        $("#searchbox input").focusout(function() {
            if ((this.id == 2) && this.value == '' || this.id == 3) {

            }
        });

        $("#searchbox input").focus(function() {
            if (this.id == 2 || this.id == 3) {

            }
        });

        $("#check_all_checkboxes").change(function() {
            var value = [];
            var count = 0;
            var status;
            if (!$(this).attr("checked")) {
                status = false;
            } else {
                status = true;
            }

            $("#datatable_rows tbody input[type=checkbox]").each(function() {
                $(this).attr("checked", status);
                if ($(this).val() != '') {
                    value += $(this).attr('value') + ',';
                    count++;
                }

            });
            if (status) {
                $('#setting_ids').val(value);
            } else {
                $('#setting_ids').val('');
            }

        });

    });

</script>
            <script>
			
			 $(document).ready(function(){
				 
			 $('#description').tinymce({
            // Location of TinyMCE script

            script_url: '<?php echo site_url();?>js/plugins/tiny_mce/tiny_mce.js',
            // General options
            width: "520",
            height: "150",
            theme: "advanced",
            theme_advanced_toolbar_align: "left",
            theme_advanced_statusbar_location: "bottom",
            theme_advanced_toolbar_location: "top",
            theme_advanced_buttons1: "bold,italic,underline,strikethrough,bullist,numlist,spellchecker",
            theme_advanced_buttons2: "",
            theme_advanced_buttons3: "",
            theme_advanced_buttons4: "",
            force_br_newlines: true,
            force_p_newlines: false,
            gecko_spellcheck: true,
            forced_root_block: '', // Needed for 3.x
            plugins: "paste,spellchecker",
            spellchecker_languages: "+English=en,Russian=ru",
            content_css: "https://crm.propspace.com/application/views/tinymce/examples/css/content.css",
            apply_source_formatting: true,
            template_replace_values: {
                username: "Some User",
                staffid: "991234"
            }

        });
		});
        disableEditor();
			</script>
            
            <script type="text/javascript" src="<?php echo site_url();?>js_module/common.js?ts=11234"></script> 