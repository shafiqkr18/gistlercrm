var last_id = '';
$(document).ready(function() {
	
	var oTable = $('#listings_row').dataTable({
						"bProcessing": true,
						"sDom": 'R<>rt<ilp><"clear">',
						"bServerSide": true,
						"bRegex": true,
						"sAjaxSource": mainurl+"accounts/historyDatatable",
						"aoColumnDefs": [ 
							{
								"fnRender": function ( oObj ) {
									return '';
								},
								"aTargets": [ 0 ]
							},
							{ "bSortable": false, "aTargets": [ 0 ] }
						],
						"aaSorting" : [[ 7, 'desc' ]],
						"iDisplayLength": 25,
						"iDisplayStart": 0,
						"sPaginationType": "full_numbers",
						
						"oLanguage": {
						"sSearch": "Search all columns:"
						},
						"fnServerData": function ( sSource, aoData, fnCallback ) {
							/* Add some extra data to the sender */
							aoData.push({ "name": "dateadded", "value":  $('#dateadded').val() } );
							$.getJSON( sSource, aoData, function (json) { 
								/* Do whatever additional processing you want on the callback, then tell DataTables */
								fnCallback(json);
							});
						}
				});
                                
	$("#searchbox input").focusout(function() {
        if ((this.id==3 || this.id==4 ) && this.value=='' )  {
            this.value=' Min 3 chars';
            $( this ).css( "color", "grey" );
            $( this ).css( "font-family", "arial" );
            $( this ).css( "font-size", "11px" );
        }
     });
                 
	$("#searchbox input").focus(function() {
        if (this.id==3 || this.id==4 ) {
               if (this.value==" Min 3 chars") {
                    $( this ).css( "color", "" );
                    $( this ).css( "font-family", "" );
                    $( this ).css( "font-size", "" );
                	this.value="";
               }
           }
     });
        
        
	$("thead input").keyup( function () {
        if(this.value.length<3 && this.value.length>0 && ( this.id==3 || this.id==4 )){
            return false;
        }
		/* Filter on the column (the index) of this element */
		oTable.fnFilter( this.value, $(this).attr('id') );
		$('#reset_filter').css('display', '');
	});
	
	$("thead select").change( function () {
		/* Filter on the column (the index) of this element */
		oTable.fnFilter( this.value, $(this).attr('id') );
		$('#reset_filter').css('display', '');
	});
	
	
	$('#dateadded').datepicker({
		dateFormat: 'dd-mm-yy',
		onClose: function(dateText, inst) { 
			oTable.fnDraw(false); $('#reset_filter').css('display', '');
		}
	});
	
	
	//reset filter and drawtable
	$("#reset_filter").click(function () {
		$("#myForm2")[ 0 ].reset();
		oTable.fnDraw(false);
		oTable.fnFilterClear(true);
		$('#reset_filter').css('display', 'none');
	});
				
	//change css of selected row	
	$("#listings_row tbody tr").live("click", function(event){
		$("td.yellowCSS", oTable.fnGetNodes()).removeClass('yellowCSS');
		$(event.target).parent().find("td").addClass('yellowCSS');
	});

});
$('body').on("click",".fecth_values", function() {  
	var id=$(this).attr('id');
	getSingleRow(id);
});


function getSingleRow(id){
	 $('#old_value').html('Loading...');
	 $('#new_value').html('Loading...');
     $.getJSON(mainurl+"accounts/singleHistory/"+id, function(json){ 
		 $('#old_value').html(json.oldvalue);
		 $('#new_value').html(json.newvalue);
	 });
}
