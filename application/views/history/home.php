  <script>
  	$(document).ready(function(){
  		
  		//datatable initilization
$(document).ready(function() {
	
		 var oTable = $('#listings_row').dataTable( {
		 	   "bProcessing": true,
            "bServerSide": true,
            "sDom": 'R<>rt<ilp><"clear">',
			"columnDefs": [ {
		    "targets": 4,//index of column starting from 0
		    "data": "action_values", //this name should exist in your JSON response
		    "render": function ( data, type, full, meta ) {
		    	var d =  data.split(' to ');
		      return '<span class="label label-danger"><del>'+d[0]+'</del></span> '+d[1];
		    }
		  } ],
			 "aoColumns": [
			
			{ "mDataProp": "screen" },{ "mDataProp": "ref" },{ "mDataProp": "user" },{ "mDataProp": "action_field" },{ "mDataProp": "action_values" },
			{ "mDataProp": "dt_datetime" },{ "mDataProp": "action" }
			
			],
            "aaSorting" : [[ 0, 'desc' ]],
            "bRegex": true,
            "sAjaxSource": "<?php echo base_url();?>index.php/history/history_datatable",
            "iDisplayStart": 0,
            "sPaginationType": "full_numbers",
            "oLanguage": {
                "sSearch": "Search all columns:"
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
                             

                       }
                       });
					},
					"rowCallback": function( row, data ) {
						 $(row).attr("id",data.id);
						 return row;
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
			oTable.fnDraw(false);
    		oTable.fnFilterClear(true);
			$('#reset_filter').css('display', 'none');
			
	});
				
	//change css of selected row	
	$("#listings_row tbody tr").live("click", function(event){
	  $("td.yellowCSS", oTable.fnGetNodes()).removeClass('yellowCSS');
	  $(event.target).parent().find("td").addClass('yellowCSS');
	});
	
} );
  		
  	})
  	
  </script>
  <div id="wrapper">
            <div class="container">
            
            
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                	<div class="page_head_area"><h1><i class="fa fa-file-text-o"></i> General History</h1></div>
                </div>
            </div>
                        
            
            <div id="inner_tab">
            
            <div class="row fadeInUp">
            <div class="col-lg-12">
            <!-- Nav tabs -->
            <div class="inner_tab_nav">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="<?php echo site_url('history');?>">General History</a></li>
                    <li><a href="<?php echo site_url('history/login-history');?>">Login History</a></li>
                </ul>
            </div>
            
            
            <!-- Tab content -->
            <div class="tab-content datatable-Scrolltab">
            	
            	 <table class="table table-striped table-hover datatables" id="listings_row">
                  <thead>
                  		
                  <tr>
                   <th>Screen</th>
                  	<th>Ref</th>
                    <th>User</th>
            		<th>Field</th>
			         <th>Old/New Values</th>
                    <th>Datetime</th>
           			 <th>Action</th>
                    </tr>
                  </thead>
                  <thead id="searchbox" class="search_box">
                    <tr class="highlighted">
                    	<form id="myForm2">
                    <td>
                   <select id='0' class="form-control input-sm  search_init">
                    <option value="">Select</option>
                    <option value='contacts'>Contacts</option>
                    <option value='deals'>Deals</option>
                    <option value='Listings'>Listings</option>
					<option value='leads' >Leads</option>
                    <option value='users'>Users</option>
                    </select> 
                  
                    </td>
                    <td>
                       <input id='1' type="text" class="form-control input-sm search_init" />
                    </td>
                    <td><input type="text" class="form-control input-sm search_init" id="2"></td>
                    <td>
                       <input id='3' type="text" class="form-control input-sm search_init" />
                    </td>
                    <td>
                       <input id='4' type="text" class="form-control input-sm search_init" />
                    </td>
                    <td><input id='5' type="text" class="form-control input-sm search_init" /></td>
                    
                    <td><select id='6' class="search_init form-control input-sm">
                    	<option selected value="">Select</option>
                    	<option value='insert'>Inserted</option>
                    	<option value='update'>Updated</option>
                    	<option value='delete'>Deleted</option></select>
                    	</td>
                    
                    </form>
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
            <!-- container end -->            
            </div>
			<!-- wrapper end -->
            