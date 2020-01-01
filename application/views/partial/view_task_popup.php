 <script>

//datatable initilization
$(document).ready(function() {
	var oTable = $('#view_task_popup_datatable').dataTable( {
		"bProcessing": true,
					"bServerSide": true,
					"sDom": 'R<>rt<ilp><"clear">',
					"bRegex": true,
					"sAjaxSource": config.siteUrl+"common/datatable_listings_todo",
					 "columns": [
						//{ "data": "id" },
						{ "data": "ref" },
						{ "data": "title" },
						{ "data": "status" },
						{ "data": "priority" },
						{ "data": "due_date" },
						{ "data": "created_by" },
						{ "data": "assigned_to_id" },
						{ "data": "notes" }
						],
			
					//"aoColumnDefs": [ 
//						{
//							"fnRender": function ( oObj ) {
//								return '<form id="popup_form1" action="todo" method="POST">'
//								+'<input type="hidden" name="'+screenname+'_id" value="'+$('#id').val()+'"><input type="hidden" name="id" value="'+ oObj.aData[ 0 ] +'"><div class="popup_a" >'
//								+'<a href="#" class="prevHEX" onclick="document.forms[\'popup_form'+ oObj.aData[ 0 ] + '\'].submit();">View</a></form></div>';
//							},
//							"aTargets": [ 9 ],
//						},
//						{ "bVisible" : false, "aTargets": [ 0 ] },
//						{ "bVisible" : false, "aTargets": [ 8 ] }
//					],
					"aaSorting" : [[ 4, 'desc' ]],
					"iDisplayStart": 0,
                                        'iDisplayLength': 5,
                                        "bLengthChange": false,
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

$('#popup_record_reference_VT').text($('#ref').val());
</script>
   <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">To-Do (<span id='popup_record_reference_VT'></span>)</h4>
                  </div>
                  
                  <div class="modal-body">
                 
                  <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="view_task_popup_datatable">
                            <thead>
                                <tr>
                                     
	            <th style="width:60px;">Reference</th>
	            <th style="width:500px;">Title</th>
	            <th style="width:100px;">Status</th>
	            <th style="width:50px;">Priority</th>
	            <th style="width:140px;">Due Date</th>
	            <!-- <th style="width:50px;">Reminder</th> -->
	            <th style="width:100px;">Created By</th>
	            <th style="width:100px;">Assigned To</th>
	            <th style="width:40px;">Notes</th>
	            
                                </tr>
                            </thead>
                            <tbody>
	                <tr>
	                    <td colspan="6" class="dataTables_empty">Loading data from server</td>
                        </tr>
	            </tbody>
                        </table>
                     </div>
                    </div>