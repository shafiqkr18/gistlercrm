  <?php
  $month = date('m');
  $year = date('Y')
  ?>
  <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script type="text/javascript">
    var getDaysArray = function(year, month) {
  var names = [ 'sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat' ];
  var date = new Date(year, month-1, 1);
  var result = [];
  while (date.getMonth() == month-1) {
   // result.push(date.getDate()+"-"+names[date.getDay()]);
    result.push(date.getDate());
    date.setDate(date.getDate()+1);
  }
  return result;
}
  // HightChart Line
  $(function () {
  	//get agents with selected 
 $.getJSON(config.siteUrl+'common/getAgents', function(data){
	 var agentback = data;
	
  //check for agents
  if(config.user.user_access==3)
  {
     var len = data.length;
    for (var i = 0; i< len; i++) {
	
	   if(admid == data[i].id)
	{
        html = '<option selected="" value="' + data[i].id + '">' + data[i].name + '</option>';
   }else{
        html += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
		}
    }
  }else{
    var html = "<option  value=''>Select</option>";
    var len = data.length;
    for (var i = 0; i< len; i++) {
	html += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
	
    }
}
$('#agent_id').append(html);
})
	$("#target_submit").click(function() {
	
	 var parameters = $("#frm_target").serialize();
var form = $("#frm_target");
    $.post('<?php echo base_url() ?>index.php/noticeboard/set_target', parameters, function(data) {
        if (data.status == true) {
            //show success message
			$('.error', form).remove();
			$("#msg_sucess").show();
            setTimeout(function() { $("#msg_sucess").hide(); }, 5000);
        }else{
			$('.error', form).remove();
            $.each(data.errors, function(key, val) {
                $('[name="'+ key +'"]', form).after(val);
				
            })
        }
    }, "json");
});
	
    
    draw_chart();
});
function draw_chart()
{
	$('#container').highcharts({
        title: {
            text: '',
            x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            categories: [
            <?php
            for($d=1; $d<=31; $d++)
				{
				    $time=mktime(12, 0, 0, $month, $d, $year);          
				    if (date('m', $time)==$month)       
				        echo date('d', $time).",";
				}
            ?>
             ]
        },
        yAxis: {
            title: {
                text: 'Target'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: 'AED'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [
         <?php 
			
			 foreach ($dealsList as $listing): ?>
        {
            name: '<?php echo $listing['agent'];?>',
            data: [
            <?php 
            $lst = $listing['cmn'];
            foreach ($lst as $listingc): 
            
            echo $listingc['commission'].",";
            endforeach;
            ?>
            
            ]
        },
        <?php  endforeach ?>
        ]
    });
}
</script>
 <div id="wrapper" class="leads">
            <div class="container">
           
            
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                	<div class="page_head_area"><h1><i class="fa fa-bullhorn"></i> NOTICE BOARD</h1></div>
                </div>
            </div>
            
            
            <div id="inner_tab">
            
            
            <div class="row">
            <div class="col-lg-12">

                <div class="inner_tab_nav">
                  <ul class="nav nav-tabs">
                    <li ><a href="<?php echo site_url('noticeboard');?>">Noticeboard & Documents</a></li>
                      <li class="active" ><a href="<?php echo site_url('noticeboard/target');?>">Target & Commission</a></li>
                  </ul>
                </div>
                    
            <!-- Tab content -->
            <div class="tab-content">
              <h4 class="text-success">Target & Commission</h4>
              <hr>
               <style>
.error{
	color:red;
}
</style>
<div id="msg_sucess" class="alert alert-success text-center" style="display:none;">Target set successfully!</div>
<div id="msg_error" class="alert alert-danger text-center" style="display:none;">There is error ! Please try again later</div>
               <form id="frm_target" method="post">
              <div class="col-md-2">
                <div class="form-group">
                    <label>Set Monthly Target</label>
                    <input type="text" class="form-control input-sm" id="target" name="target" >
                    
                </div>

              </div>
                <div class="col-md-2">
                  <div class="form-group">
                      <label>Select User</label>
                       <select name="agent_id" id="agent_id" class=" form-control required input-sm" required>
	                    
	                      
	                    </select>
                  </div>
                </div>
                  <div class="col-md-2">
                  <div class="form-group">
                  	<br>
                <button type="button" id="target_submit" class="btn btn-success">
                    <i class="fa fa-pencil-square-o"></i> 
                    Set Target</button>
                </div></div>
                </form>
                
                
              <div class="clear"></div>
              
              
            <form action="#" method="post" data-toggle="validator"  role="form" id="uaelisting-form">
            
              <div class="row"><h4 class="add_new_rental"></h4></div>
              
              
              <div class="row fadeInUp">

  	           	<table class="table table-striped" id="listings_row">
  	           		<thead>
  	           			<tr>
  	           				
  	           				<th></th>
  	           				<th>Ranking</th>
  	           				<th>First Name </th>
  	           				<th>Last Name</th>
  	           				<th>Target</th>
                      <th>Current Month Commission</th>
                      <th>Required to Hit Target</th>
                     <th>Last Month Commission</th>
                      <th>No. of Deals</th>
                      <th>Target %</th>
                     <th>Target Hit</th>
  	           			</tr>
  	           		</thead>
  	           		<tbody>
  	           		
  	           	
  	           		</tbody>
  	           	</table>
  	           
              </div>

            <!-- </div> -->
            </form>
            <!-- Rental Form End -->
            </div>
            <!-- uae tab content end -->    
            </div>
            </div>
            
            
            
      <div class="row fadeInUp">
            <div class="col-lg-12">

              <div class="tab-content">

                <h4 class="text-success">Target Commission Overview</h4>
                <hr>

                <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
            
              </div>

          </div>
      </div>
            
                    
            
            

 			</div>
            </div>
            <!-- container end -->
            
            
            </div>
			<!-- wrapper end -->
<script>
				//datatable initilization
$(document).ready(function() {
	 var oTable = $('#listings_row').dataTable({
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
				return '<div style="text-align:center; width:22px;" id="item_action"><input type="radio" name="select_landlord" style="opacity:1;" id="checkbox_'+ data +'" value="'+ data +'"></div>';
         }
      }],

		"bServerSide": true,
		 "sAjaxSource": config.siteUrl+"noticeboard/datatable_target",
                "bJQueryUI": true,
                "sPaginationType": "full_numbers",
                "iDisplayStart ":0,
         "columns": [
			{ "data": "id" },{ "data": "is_active" },
			{ "data": "first_name" },{ "data": "last_name" },
			{ "data": "target"},{ "data": "current_month" },{ "data": "created_by" },{ "data": "last_month" },{ "data": "cnt_deals" },{ "data": "status" },{ "data": "TargetHit" }],
       
                'fnServerData': function (url, data, callback) 
            {
				
				
              $.ajax
              ({
                'dataType': 'json',
                'type'    : 'POST',
                'url'     : url,
                'data'    : data,
                'success' : callback
				
              });
            }
	});
$('.datatable-setbotclass').next().addClass('fixedpagination-bottom');
	});
</script>