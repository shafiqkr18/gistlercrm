 <script>
//datatable initilization
$(document).ready(function() {
	 var oTable = $('#dataTables-rent-leads').dataTable({
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
			 return '<div style="text-align:center;"><input style="align:center;" type="checkbox" value="' + data + '">  <span class="lbl"></span></div>';
         }
      }],

			
		"columns": [
			{ "data": "id" },
			{ "data": "ref" },{ "data": "status" },
			{ "data": "landlord_name"},{ "data": "last_name" },{ "data": "city" },{ "data": "landlord_mobile" },{ "data": "date_of_enquiry" },{ "data": "source_of_lead" },
			{ "data": "agent_id" }
			],
		"bServerSide": true,
		 "sAjaxSource": config.siteUrl+"common/datatable_lead_popup",
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
	
	$("thead input").keyup( function () {
		/* Filter on the column (the index) of this element */
		oTable.fnFilter( this.value, $(this).attr('id') );
		$('#reset_filter').css('display', '');
		
	} );
	
	$("thead select").change( function () {
		/* Filter on the column (the index) of this element */
		oTable.fnFilter( this.value, $(this).attr('id') );
		$('#reset_filter').css('display', '');
		
	} );
	
	//reset filter and drawtable
	$("#reset_filter").click(function () {
			$("#myForm2")[ 0 ].reset();
			$('#dueactivitiesbuttonvalue').val('false');
			oTable.fnDraw(false);
    		oTable.fnFilterClear(true);
			
			$('#reset_filter').css('display', 'none');
			
	});
});
</script>
   <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-rent-leads">
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