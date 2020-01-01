 <script>

//datatable initilization
$(document).ready(function() {
var oTable = $('#view_deal_popup_datatable').dataTable({
				"bProcessing": true,
				"sDom": '<>rt<ilp><"clear">',
				"aoColumnDefs": [ 
						{
							 'render': function (data, type, full, meta){
                        //check the main check box
                        $('#check_all_checkboxes').attr('checked', false);
                        return '<div style="text-align:center;"><input style="align:center;" type="checkbox" value="' + data + '">  <span class="lbl"></span></div>';
                    },
							"aTargets": [ 0 ]
						},
					
					],
				"aaSorting" : [[ 0, 'desc' ]],
				"bServerSide": true,
				"bRegex": true,
				"sAjaxSource": config.siteUrl+"common/datatable_listings_deals",
				"iDisplayStart": 0,
				"sPaginationType": "full_numbers",
		
				"oLanguage": {
					"sSearch": "Search all columns:"
				},
				//id,ref,listings_ref,type,tenant_buyer_name,landlord_seller_name,price,cheques,deposit,commission,agent_1_id,deal_date
				"aoColumns": [
					{ "mDataProp": "id" },
		            { "mDataProp": "ref" },
					{ "mDataProp": "listings_ref" },
					{"mDataProp":"type"},
					{ "mDataProp": "tenant_buyer_name" },
					{ "mDataProp": "landlord_seller_name" },
					{ "mDataProp": "price" },
					{ "mDataProp": "cheques" },
					{"mDataProp":"deposit"},
					{ "mDataProp": "commission" },
					{ "mDataProp": "agent_1_id" },
					{ "mDataProp": "deal_date" },
					],
				"rowCallback": function( row, data ) {
					 $(row).attr("id",data.id);
				  	return row;
				 	},
				 'fnServerData': function (url, data, callback){ 
								/* Add some extra data to the sender */
								if(screenname=='listings'){
									//aoData.push( { "name": "listings_id", "value": $('#id').val() }, { "name": "dueactivities", "value": '' } );
									data.listings_id = $('#id').val();
									data.dueactivities = '';
								}
								if(screenname=='contacts'){
									//aoData.push( { "name": "landlord_id", "value": $('#id').val() } );
									
									data.landlord_id = $('#id').val();
								}
								if(screenname=='leads'){
									aoData.push( { "name": "leads_id",    "value": $('#id').val() } );
								}
								if(screenname=='contracts'){
									aoData.push( { "name": "deal_id",     "value": $('#deal_id').val() } );
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

	 $("body").on("click", "#view_deal_popup_datatable tbody tr", function(event){ 
   
        				var id=$(this).attr('id');
        				
						if(screenname == "accounts")
						{
							var d_ref = $(this).closest('tr').find('td:eq(1)').text();
							$("#deal_id").val(id);
							$("#deal_ref").val(d_ref);
							
						}
       
			});

	
	
} );
$('#popup_record_reference_VD').text($('#ref').val());

if(screenname=='contacts'){
	$('#popup_record_reference_VD').text($('#name').val()+' '+$('#last_name').val());
}
if(screenname == 'accounts')
{
	$('#popup_record_reference_VD').text(' ALL');
}
</script>
 <!-- View Deals Modal -->
         <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Deals (<span id='popup_record_reference_VD'></span>)</h4>
                  </div>
                  
                  <div class="modal-body">
                  <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="view_deal_popup_datatable">
                            <thead>
                                <tr>
                                	
                                	 <th></th>
                                    <th>Reference</th>
            <th>Listings Ref</th>
            <th>Type</th>
            <th>Tenant/Buyer</th>
            <th>Landlord</th>
            <th>Price</th>
            <th>Cheques</th>
            <th>Deposit</th>
            <th>Commission</th>
            <th>Agent</th>
            <th>Deal Date</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                     </div>
                    </div>