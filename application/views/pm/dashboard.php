<script src="<?php echo site_url();?>js_module/PM/pm_dashboard.js"></script>
<script src="<?php echo site_url();?>js_module/PM/pm_managedUnits.js"></script>

<div id="wrapper">

  <div class="container">
    <!-- Page Heading -->
    <div class="row">
      <div class="col-md-6">
        <div class="page_head_area">
          <h1><i class="fa fa fa-home"></i> Property Management </h1>
          <h3 class="gist-secondhead">Dashboard</h3>
        </div>

      </div>
      <div class="col-md-6">
        <!-- Nav tabs -->
        <div class="main_tab_nav">
          <ul class="nav nav-tabs pull-right">
            <li class="active"><a href="#home" data-toggle="tab"><i class="fa fa-lg fa-ellipsis-v"></i></a></li>
            <li><a href="#mymap_area" data-toggle="tab"><i class="fa fa-lg fa-pie-chart"></i></a></li>
          </ul>
        </div>

      </div>
    </div>
    <!-- page body -->
    <div class="row tab-content">
      <div class="tab-pane fade in active" id="pmhome">
        <div id="top_info_boxes">
          <div class="col-md-3 col-sm-6">
            <h2 class="green_heading">Units Overview</h2>
            <div class="panel panel-green">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-md-4 col-sm-4">
                    <i class="fa fa-home fa-5x"></i>
                  </div>
                  <div class="col-md-8 col-sm-8">
                    <div class="huge clearfix">
                      <p class="num_txt" id="tot_live_listing1">0</p>
                      <span class="r_txt"><a href="<?php echo base_url();?>listings/rentals/published/" title="0" id="tot_live_listing1_r" target="_blank">R</a></span>
                      <!-- <span class="s_txt"><a href="<?php echo base_url();?>listings/sales/published/" title="0" id="tot_live_listing1_s" target="_blank">S</a></span> -->
                    </div>
                    <span class="live_txt">Managed Units</span>
                  </div>
                </div>
              </div>
              <a href="javascript:void(0)" id="crm-expandlisting" class="plus_icon plus_icon_green"><i class="fa fa-plus"></i></a>
            </div>
          </div>

          <div class="col-md-3 col-sm-6">
            <h2 class="red_heading"> Payments Overview</h2>
            <div class="panel panel-red">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-md-4 col-sm-4">
                    <i class="fa fa-check fa-5x"></i>
                  </div>
                  <div class="col-md-8 col-sm-8">
                    <div class="huge clearfix">
                      <p class="num_txt" id="tot_live_leads1" title="0">0</p>

                      <span class="r_txt"><a href="<?php echo base_url();?>leads/index/rentals/" title="0" id="tot_live_leads1_r" target="_blank">R</a></span>
                      <span class="s_txt"><a href="<?php echo base_url();?>leads/index/sales/" title="0" id="tot_live_leads1_s" target="_blank">S</a></span>
                    </div>
                    <span class="live_txt">Live Leads</span>
                  </div>
                </div>
              </div>
              <a href="javascript:void(0)" id="crm-expandleads" class="plus_icon plus_icon_red"><i class="fa fa-plus"></i></a>
            </div>
          </div>

          <div class="col-md-3 col-sm-6">
            <h2 class="yellow_heading"> Workorders Overview</h2>
            <div class="panel panel-yellow">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-md-4 col-sm-4">
                    <i class="fa fa-star-o fa-5x"></i>
                  </div>
                  <div class="col-md-8 col-sm-8">
                    <div class="huge clearfix">
                      <p class="num_txt" id="tot_live_deals1">0</p>

                      <span class="r_txt"><a href="<?php echo base_url();?>deals/index/rentals/" title="0" id="tot_live_deals1_r" target="_blank">R</a></span>
                      <span class="s_txt"><a href="<?php echo base_url();?>deals/index/sales/" title="0" id="tot_live_deals1_s" target="_blank">S</a></span>

                    </div>
                    <span class="live_txt">Live Deals</span>
                  </div>
                </div>
              </div>
              <a href="javascript:void(0)" id="crm-expanddeals" class="plus_icon plus_icon_yellow"><i class="fa fa-plus"></i></a>
            </div>
          </div>

          <div class="col-md-3 col-sm-6">
            <h2 class="primary_heading"> Leases Overview</h2>
            <div class="panel panel-primary">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-md-4 col-sm-4">
                    <i class="fa fa-star-o fa-5x"></i>
                  </div>
                  <div class="col-md-8 col-sm-8">
                    <div class="huge clearfix">
                      <p class="num_txt" id="tot_live_deals1">0</p>

                      <span class="r_txt"><a href="<?php echo base_url();?>deals/index/rentals/" title="0" id="tot_live_deals1_r" target="_blank">R</a></span>
                      <span class="s_txt"><a href="<?php echo base_url();?>deals/index/sales/" title="0" id="tot_live_deals1_s" target="_blank">S</a></span>

                    </div>
                    <span class="live_txt">Live Deals</span>
                  </div>
                </div>
              </div>
              <a href="javascript:void(0)" id="crm-expanddeals" class="plus_icon plus_icon_blue"><i class="fa fa-plus"></i></a>
            </div>
          </div>
        </div>

        <div class="open_boxes_cont">
          <!-- detailed boxes here -->
        </div>

        <div class="row fadeInUp">

          <div id="sortable" class="ui-sortable ui-droppable">

            <div class="col-md-6 ">
              <div class="panel panel-default">
                <div class="panel-heading">
                  Recently Viewed Units
                  <div class="panel-option">
                      <span class="pull-right arrow">
                          <i class="glyphicon glyphicon-remove" aria-hidden="true"></i>
                        </span>
                      <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                      <span class="pull-right arrow">
                          <i  class="glyphicon moveme  glyphicon-move" aria-hidden="true"></i>
                        </span>
                    </div>
                </div>

                <div class="panel-body">
                  <div class="scrollbar-inner comp_user_overview">
                    <div class="panel panel-default">
                      <!-- table here -->
                      <div class="jumbotron">
                        <h3>This section is coming soon. :)</h3>
                        <!-- <p><i class="fa fa-exclamation-triangle fa-3x"></i></p> -->
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-md-6 ">
              <div class="panel panel-default">
                <div class="panel-heading">
                  Expiring Leases
                  <div class="panel-option">
                      <span class="pull-right arrow">
                          <i class="glyphicon glyphicon-remove" aria-hidden="true"></i>
                        </span>
                      <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                      <span class="pull-right arrow">
                          <i  class="glyphicon moveme  glyphicon-move" aria-hidden="true"></i>
                        </span>
                    </div>
                </div>

                <div class="panel-body">
                  <div class="scrollbar-inner comp_user_overview">
                    <div class="panel panel-default">
                      <!-- table here -->
                      <table id="tblExpiringLeases" class="table table-striped table-hover datatables">
                        <thead>
                          <tr>
                            <th>View</th>
                            <th>Unit</th>
                            <th>Landlord</th>
                            <th>Tenant</th>
                            <th>Expiring On</th>
                          </tr>
                        </thead>
                        <tbody>
                          <!-- <tr>No data available</tr> -->
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-md-6 ">
              <div class="panel panel-default">
                <div class="panel-heading">
                  Due Work Orders
                  <div class="panel-option">
                      <span class="pull-right arrow">
                          <i class="glyphicon glyphicon-remove" aria-hidden="true"></i>
                        </span>
                      <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                      <span class="pull-right arrow">
                          <i  class="glyphicon moveme  glyphicon-move" aria-hidden="true"></i>
                        </span>
                    </div>
                </div>

                <div class="panel-body">
                  <div class="scrollbar-inner comp_user_overview">
                    <div class="panel panel-default">
                      <!-- table here -->
                      <table id="tblDueWorkOrders" class="table table-striped table-hover datatables">
                        <thead>
                          <tr>
                            <th>View</th>
                            <th>Priority</th>
                            <th>Unit</th>
                            <th>Work</th>
                            <th>Service Provider</th>
                            <th>Expiring On</th>
                            <th>Days Remaining</th>
                          </tr>
                        </thead>
                        <tbody>
                          <!-- <tr>No data available</tr> -->
                        </tbody>
                      </table>                      
                    </div>
                  </div>
                </div>

              </div>
            </div> 

            <div class="col-md-6 ">
              <div class="panel panel-default">
                <div class="panel-heading">
                  Work Orders in Progress
                  <div class="panel-option">
                      <span class="pull-right arrow">
                          <i class="glyphicon glyphicon-remove" aria-hidden="true"></i>
                        </span>
                      <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                      <span class="pull-right arrow">
                          <i  class="glyphicon moveme  glyphicon-move" aria-hidden="true"></i>
                        </span>
                    </div>
                </div>

                <div class="panel-body">
                  <div class="scrollbar-inner comp_user_overview">
                    <div class="panel panel-default">
                      <!-- table here -->
                      <table id="tblInProgressWorkOrders" class="table table-striped table-hover datatables">
                        <thead>
                          <tr>
                            <th>View</th>
                            <th>Priority</th>
                            <th>Unit</th>
                            <th>Work</th>
                            <th>Service Provider</th>
                            <th>Expiring On</th>
                            <th>Days Remaining</th>
                          </tr>
                        </thead>
                        <tbody>
                          <!-- <tr>No data available</tr> -->
                        </tbody>
                      </table>                      </div>
                  </div>
                </div>

              </div>
            </div>            

            <!-- portals listing -->
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">Company Calendar
                  <div class="panel-option">
                    <span class="pull-right arrow">
                      <i class="glyphicon glyphicon-remove" aria-hidden="true"></i>
                      </span>
                    <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                    <span class="pull-right arrow">
                      <i  class="glyphicon moveme glyphicon-move" aria-hidden="true"></i>
                      </span>
                  </div>
                </div>
                <div class="panel-body">
                  <div id='calendar'>
                    <div class="jumbotron">
                      <h3>This section is coming soon. :)</h3>
                      <!-- <p><i class="fa fa-exclamation-triangle fa-3x"></i></p> -->
                    </div>
                  </div>
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
<!-- wrapper end -->

<!-- <?php if($user_type == 3) echo "My"; else echo "Company";?>
<?php if($user_type == 3) echo "My"; else echo "Company";?>
<?php if($user_type == 3) echo "My"; else echo "Company";?> -->