 <script>

//datatable initilization
$(document).ready(function() {
	var oTable = $('#view_event_popup_datatable').dataTable( {
		"bProcessing": true,
					"bServerSide": true,
					"sDom": 'R<>rt<ilp><"clear">',
					"bRegex": true,
					"sAjaxSource": config.siteUrl+"common/datatable_listings_events",
					"aoColumnDefs": [ 
						{ "bVisible" : false, "aTargets": [ 0 ] }
					],
					"aaSorting" : [[ 1, 'desc' ]],
					"iDisplayStart": 0,
					"sPaginationType": "full_numbers",
					"oLanguage": {
					"sSearch": "Search all columns:"
					},
					
					 'fnServerData': function (url, data, callback){ 
								/* Add some extra data to the sender */
								if(screenname=='listings'){
									//aoData.push( { "name": "listings_id", "value": $('#id').val() }, { "name": "dueactivities", "value": '' } );
									data.listings_id = $('#id').val();
									data.dueactivities = '';
								}
								if(screenname=='leads'){
									aoData.push( { "name": "leads_id", "value": $('#id').val() }, 	 { "name": "dueactivities", "value": '' } );
								}
									 $.ajax
									  ({
												   "dataType": 'json', 
												   "type": "POST", 
												   "url": url, 
												   "data": data, 
												   "success": function(json) {
													   callback(json);
													 
						
											   }
											   });
				}
				
				} );
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

	
	
} );
	


$('#popup_record_reference_VE').text($('#ref').val());
</script>
 <!-- View Event Modal -->
        <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Events(<span id='popup_record_reference_VE'></span>)</h4>
                  </div>
                  
                  <div class="modal-body">
                  <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="view_event_popup_datatable">
                            <thead>
                                <tr>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Event Name</th>
                                    <th>Location</th>
                                    <th>Description</th>
                                    <th>Assigned To</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                     </div>
                    </div>