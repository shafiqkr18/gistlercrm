 <script>
//datatable initilization
$(document).ready(function() {
	 var oTable = $('#dataTables-rent-leads_viewings').dataTable({
		 "bProcessing": true,
            "bServerSide": true,
            "sDom": 'R<>rt<ilp><"clear">',
			"pageLength": 5,
                  'columnDefs': [{
         'targets': 0,
         'searchable':false,
         'orderable':false,
        // 'className': 'dt-body-center',
         'render': function (data, type, full, meta){
			
             $('#check_all_checkboxes_owner').attr('checked', false);
			// return '<div style="text-align:center;"><input style="align:center;" type="checkbox" value="' + data + '">  <span class="lbl"></span></div>';
		
			return '<div style="text-align:center; width:22px;" id="item_action"><input type="radio" name="select_landlord" style="opacity:1;" id="checkbox_'+ data +'" value="'+ data +'"></div>';
         }
      }],

			
		"columns": [
			{ "data": "id" },
			{ "data": "ref" },{ "data": "status" },
			{ "data": "landlord_name"},{ "data": "last_name" },{ "data": "ref" },{ "data": "landlord_mobile" },{ "data": "date_of_enquiry" },{ "data": "source_of_lead" },
			{ "data": "agent_id" }
			],
		"bServerSide": true,
		 "sAjaxSource": config.siteUrl+"terminals/datatable_lead_popup/?id="+<?php echo $viewing_popid;?>,
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
	
	  $('#dataTables-rent-leads_viewings').change(function(){

           // if($('#landlord_id').val()!=''){
//                //var confirm_change = confirm('Are you sure you want to change the contact detail?');
//                var confirm_change = true;
//            }
//            else{
//                confirm_change     = true;
//            }

           // if(confirm_change){

                var value;
				 var viewing_lead_ref;
				
                $('#dataTables-rent-leads_viewings input:checked').each(function() {
                    value = $(this).val();
					viewing_lead_ref = $(this).closest("tr").find("td:eq(1)").text();
					
               
                    /*if($(this).val()!='checkbox_'+value){

                     $('#listings_row_landlord inbox').attr('checked', '');
                     }*/
                });


             
				$('#viewing_lead_id').val(value);

              

           // }
			$('#viewing_lead_ref').val(viewing_lead_ref);
			

            //$("td.yellowCSS", oTable2.fnGetNodes()).removeClass("yellowCSS");
            $('#dataTables-rent-leads_viewings tbody #'+value).find("td").addClass("yellowCSS");


        });
});
</script>
   <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-rent-leads_viewings">
                            <thead>
                                <tr>
                                <th></th>
                                    <th>Ref</th>
                                    <th>Status </th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Emirates</th>
                                    <th>Mobile</th>
                                    <th>Date</th>
                                    <th>Source</th>
                                    <th>Agent</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                
                                
                            </tbody>
                        </table>
                     </div>