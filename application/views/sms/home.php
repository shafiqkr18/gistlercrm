<script>
var screenname = "sms";
formEnabled = true;
function toggleChecked_contact(status) {
	
				$("#listings_row_contact input[type=checkbox]").each( function() {
				$(this).attr("checked",status);
	});
	}
$(document).ready(function(){

	 $('#listings_row').change(function(){
				var value = [];
				var cell = [];
				var count = 0;
				$('#listings_row input:checked').each(function() {
					value = $(this).val();
					
					var c_local = $(this).closest("td").next().next().next().next().next().next().html();
					
					if(c_local !=null)
					{
					cell +='+971'+c_local +',';
					
					}
					
				});
				cell = cell.substring(0, cell.length - 1);
                $('#mob_number').val(cell);

});
 $('#listings_row_contact').change(function(){
				var value = [];
				var cell = [];
				var count = 0;
				$('#listings_row_contact input:checked').each(function() {
					value = $(this).val();
					var c_local = $(this).closest("td").next().next().next().next().next().next().html();
					if(c_local !=null)
					{
					cell +='+971'+c_local +',';
					
					}
					
				});
				cell = cell.substring(0, cell.length - 1);
                $('#mob_number').val(cell);

});
});
$(document).ready(function(){
	var oTable = $('#listings_row_contact').dataTable({
		
		
		 	   "bProcessing": true,
            "bServerSide": true,
            "sDom": 'R<>rt<ilp><"clear">',
			
            "aoColumnDefs": [ 
                {
                  'render': function (data, type, full, meta){
          			 $('#check_all_checkboxes').attr('checked', false);
                        return '<div style="text-align:center;"><input style="align:center;" type="checkbox" value="' + data + '">  <span class="lbl"></span></div>';
                 },
			   "aTargets": [ 0 ]
                },
                { "bSortable": false, "aTargets": [ 0 ] }
             
            ],
			 "aoColumns": [
			
			{ "mDataProp": "id" },{ "mDataProp": "name" },{ "mDataProp": "last_name" },{ "mDataProp": "nationality" },
			{ "mDataProp": "phone" },{ "mDataProp": "mobile_no_new_ccode" },{ "mDataProp": "mobile_no_new" },{ "mDataProp": "email" }
			
			],
            "aaSorting" : [[ 0, 'desc' ]],
            "bRegex": true,
            "sAjaxSource": "<?php echo base_url();?>index.php/sms/contacts_datatable",
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
		
		 });//end datatable
				 $("#listings_row_contact thead input").keyup( function () {

		/* Filter on the column (the index) of this element */

		oTable.fnFilter( this.value, $(this).attr('id') );

		$('#reset_filter').css('display', '');

		

	} );

	



	

	$("#listings_row_contact thead select").change( function () {

		/* Filter on the column (the index) of this element */

		oTable.fnFilter( this.value, $(this).attr('id') );

		$('#reset_filter').css('display', '');

		

	} );


});
	/* Insert / Update function */

		 $(document).ready(function() {
		 var oTable = $('#listings_row').dataTable( {
		 	   "bProcessing": true,
            "bServerSide": true,
            "sDom": 'R<>rt<ilp><"clear">',
			
            "aoColumnDefs": [ 
                {
                  'render': function (data, type, full, meta){
          			 $('#check_all_checkboxes').attr('checked', false);
                        return '<div style="text-align:center;"><input style="align:center;" type="checkbox" value="' + data + '">  <span class="lbl"></span></div>';
                 },
			   "aTargets": [ 0 ]
                },
                { "bSortable": false, "aTargets": [ 0 ] }
             
            ],
			 "aoColumns": [
			
			{ "mDataProp": "id" },{ "mDataProp": "first_name" },{ "mDataProp": "last_name" },{ "mDataProp": "job_title" },
			{ "mDataProp": "office_no" },{ "mDataProp": "mobile_no_new_ccode" },{ "mDataProp": "mobile_no_new" },{ "mDataProp": "email" }
			
			],
            "aaSorting" : [[ 0, 'desc' ]],
            "bRegex": true,
            "sAjaxSource": "<?php echo base_url();?>index.php/sms/agents_datatable",
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
		 $("input[name$='lst']").click(function() {
        var test = $(this).val();

        $("div.desc").hide();
        $("#lst" + test).show();
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

			oTable.fnDraw(false);

    		oTable.fnFilterClear(true);

			$('#reset_filter').css('display', 'none');

			

	});
		$('#myForm input, #myForm select, #myForm textarea').prop('disabled', false);
		$("#myForm").removeAttr("disabled");
		 $("#myForm")[ 0 ].reset();
		  $('#update').click(function(){
		  
		  var mob_number = $('#mob_number').val();
			var description = $('#description').val();
			if(mob_number =='')
			{
			alert('Enter cell number');
			return false;
			}
		  $.post("common/send_sms", { mob_number:mob_number,description:description  }, function(data) {
			
			  $('#showdata').html(data);
				   formDataChange=false;
				   $('#showdata').fadeIn("slow");
				   $('.infobox').animate({ 'background-color': '#48AA43'}, "slow");
				   setTimeout(function() {  
					   $('#showdata').fadeOut("slow");
					   $('.infobox').animate({ 'background-color': '#E5E5E5'}, "slow");
				   }, 5000);
			    $('#mob_number').val('');
			 $('#description').val('');
			});
		  });
		  
		   $('#showdata').fadeIn("slow");
				   $('.infobox').animate({ 'background-color': '#48AA43'}, "slow");
				   setTimeout(function() {  
					   $('#showdata').fadeOut("slow");
					   $('.infobox').animate({ 'background-color': '#E5E5E5'}, "slow");
				   }, 5000);
			$('#myForm').ajaxForm({
			  beforeSubmit : function() { 
			  return $("#myForm").validate({ errorClass: 'form_fields_error',  errorPlacement: function(error, element) {
						$(element).attr({"title": error.text()});
						
					}}).form() ;
			  },
			  target: '#showdata',
			  success: function(data) {
			  $('#showdata').html(data);
				   formDataChange=false;
				   $('#showdata').fadeIn("slow");
				   $('.infobox').animate({ 'background-color': '#48AA43'}, "slow");
				   setTimeout(function() {  
					   $('#showdata').fadeOut("slow");
					   $('.infobox').animate({ 'background-color': '#E5E5E5'}, "slow");
				   }, 5000);
			  }
			});
			
	})
	
</script>

<div id="wrapper" class="leads">
            <div class="container">
            
            
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                	<div class="page_head_area"><h1><i class="fa fa-mobile"></i> SMS</h1></div>
                </div>
            </div>
            
            
            <div id="inner_tab">
            
            
            <div class="row">
            <div class="col-lg-12">
                    <form action="#" method="post"  id="myForm">
            <!-- Tab content -->
            <div class="tab-content">
              <button type="button" id="update" name="Update" class="btn btn-lg btn-success">
              <i class="fa fa-mobile"></i> Send SMS</button>
          		<div class="showdata" id="showdata"></div>
            	
            
              <div class="row"><h4 class="add_new_rental"></h4></div>
              
              
              <div class="row fadeInUp">

  	            <div class="col-md-4">
                    <div class="form-group">
    	                <label>Mobile no.</label>
    	                <input type="text" class="form-control input-sm" id="mob_number" name="mob_number">
    	                <font color="#C0C0C0">Ex:+971552493494</font>
    	              </div>
                    <div class="form-group">
                      <label>Message</label>
                      <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                    <div class="row" id="myRadioGroup">
                      <div class="col-md-4">
                        <label>Select from list </label>
                      </div>
                      <div class="col-md-4"> 
                        <label>
                          <input type="radio" name="lst" checked="checked" value="1"/>
                          <span class="lbl padding">Agents</span>
                        </label>
                      </div>
                      <div class="col-md-4">
                        <label>
                          <input type="radio" name="lst" value="2"/>
                          <span class="lbl padding">Landlords</span>
                        </label>
                      </div>
                    </div>

    	          </div>
  	           
              </div>

            <!-- </div> -->
          
            <!-- Rental Form End -->
            </div>
            <!-- uae tab content end -->    
            </div>
              </form>
            </div>
            
            
            
            <div class="row fadeInUp">
            <div class="col-lg-12">
            
            <div class="tab-content datatable-Scrolltab">
            <div  class="tab-pane fade in active" id="current_listing">
            <div class="listing_nav">
            <div class="row">
            
            
            <!-- i am select something -->
            <div class="gist-selmsg collapse" id="checkbox_error">
	  			<a data-toggle="collapse" href="#openSelsome" aria-expanded="false" aria-controls="openSelsome" role="button" class="close-selsomething"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
	    		<img src="<?php echo base_url(); ?>images/select.png">
			</div>
            </div>
            </div>
           <div id="lst1" class="desc">
            <div class="row">

                <table class="table table-striped table-hover datatables" id="listings_row">
                  <thead>
                  <tr>
                    <th>
                    <label class="">
                        <input type="checkbox"/>
                        <span class="lbl"></span>
                    </label>
                    </th>
                     <th>First Name</th>
			          <th>Last Name</th>
			          <th>Job Title</th>
			          <th>Office No</th>
					  <th>Country Dialing Code</th>
			          <th>Mobile No</th>
			          <th>Email</th>
                    </tr>
					</thead>
					 <thead id="searchbox" class="search_box">
                    <tr class="highlighted">
                    	<form id="myForm2">
                    <td><a style="display:none;" id="reset_filter" href="# Reset"><img src="<?php echo base_url();?>mydata/images/swap.png" title="Reset filter"></a></td>
                      <td><input id='1' type="text" class="search_init" /></td>
                <td><input id='2' type="text" class="search_init" /></td>
                <td><input id='3' type="text" class="search_init" /></td>
                <td><input id='4' type="text" class="search_init" /></td>
                <td><input id='5' type="text" class="search_init" /></td>
                <td><input id='6' type="text" class="search_init" /></td>
                <td><input id='7' type="text" class="search_init" /></td>
				
				</form>
                    </tr>
                    </thead>
                    
                    
                    
                    <tbody>
                    
                    </tbody>
                </table>
              </div>
           </div>
           <div id="lst2" class="desc" style="display: none;">
                       <div class="row">
				  <table class="table table-striped table-hover datatables" id="listings_row_contact">
                  <thead>
                  <tr>
                    <th>
                    <label class="">
                        <input type="checkbox"/>
                        <span class="lbl"></span>
                    </label>
                    </th>
                     <th>First Name</th>
			          <th>Last Name</th>
			          <th>Nationality</th>
			          <th>Office No</th>
					  <th>Country Dialing Code</th>
			          <th>Mobile No</th>
			          <th>Email</th>
                    </tr>
					</thead>
					 <thead id="searchbox" class="search_box">
                    <tr class="highlighted">
                    	<form id="myForm2">
                    <td><a style="display:none;" id="reset_filter" href="# Reset"><img src="<?php echo base_url();?>mydata/images/swap.png" title="Reset filter"></a></td>
                      <td><input id='1' type="text" class="search_init" /></td>
                <td><input id='2' type="text" class="search_init" /></td>
                <td><input id='3' type="text" class="search_init" /></td>
                <td><input id='4' type="text" class="search_init" /></td>
                <td><input id='5' type="text" class="search_init" /></td>
                <td><input id='6' type="text" class="search_init" /></td>
                <td><input id='7' type="text" class="search_init" /></td>
				
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
            </div>
            
                    
            
            

 			</div>
            </div>
            <!-- container end -->
            
            
            </div>