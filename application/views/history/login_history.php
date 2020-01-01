   <script>

   var screenname = 'history';

  	$(document).ready(function(){

  		

  		//datatable initilization

$(document).ready(function() {

		 var oTable = $('#listings_row').dataTable( {

		    "bProcessing": true,

            "bServerSide": true,

            "sDom": 'R<>rt<ilp><"clear">',

			"order": [[ 2, "desc" ]],

			 "aoColumns": [

			

			{ "mDataProp": "user_id" },{ "mDataProp": "status" },{ "mDataProp": "activitytime" }

			

			],

			 "columns": [

			{ "data": "user_id" },

            { "data": "status" },

			{ "data": "activitytime" },

			],

            "aaSorting" : [[ 2, 'desc' ]],

            "bRegex": true,

            "sAjaxSource": "<?php echo base_url();?>index.php/history/loginhistory_datatable",

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

						  if ( data.status == 0 )

						      {

							  $('td:eq(1)', row).html( 'Login' );

							  }else{

							  	$('td:eq(1)', row).html( 'Logout' );

							  }

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

  <script type="text/javascript" src="<?php echo site_url();?>js_module/common.js"></script> 

  <div id="wrapper">

            <div class="container">

            

            

            <!-- Page Heading -->

            <div class="row">

                <div class="col-lg-12">

                	<div class="page_head_area"><h1><i class="fa fa-file-text-o"></i> Login History</h1></div>

                </div>

            </div>

                        

            

            <div id="inner_tab">

            

            <div class="row fadeInUp">

            <div class="col-lg-12">

            <!-- Nav tabs -->

            <div class="inner_tab_nav">

                <ul class="nav nav-tabs">

                    <li ><a href="<?php echo site_url('history');?>">General History</a></li>

                    <li class="active"><a href="<?php echo site_url('history/login-history');?>">Login History</a></li>

                </ul>

            </div>

            

            

            <!-- Tab content -->

            <div class="tab-content datatable-Scrolltab">

            	

             <table class="table table-striped table-hover datatables" id="listings_row">

                  <thead>

                  <tr>

                    <td>User</td>

            		 <td >Action</td>

           			 <td >Date</td>

                    </tr>

                  </thead>

                  <thead id="searchbox" class="search_box">

                    <tr class="highlighted">

                    	<form id="myForm2">

                    <td>

                    <select id='0' class="form-control input-sm  search_init">

                    

                    </select> 

                   

                    </td>

                    

                    <td>

                    	 <select id='1' class="form-control input-sm  search_init">

                   		 <option value="">Select Action</option>

                   		 <option value="0">Login</option>

                   		 <option value="1">Logout</option>

                        </select> 

                    	

                    </td>

                 	<td></td>

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

            

            