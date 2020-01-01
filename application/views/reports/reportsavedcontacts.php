<script src="<?php echo site_url();?>js_module/Reports/savedreports.js"></script>




<body class="reports">

  <div id="wrapper">

    <div class="container">
      <!-- Page Heading -->
      <div class="row">
        <div class="col-md-10">
          <div class="page_head_area">
            <h1><i class="fa fa-pie-chart"></i> Reports </h1>
            <!-- <h3 class="gist-secondhead">Dashboard</h3>                 -->
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="col-md-12">
                <h3 class="gist-reportinghead">My Saved Reports - Contacts</h3>
                <div class="clear"></div>
                <span class="">View List of reports created by you and those being shared with you by other user in country</span>

              </div>

              <hr class="row">
              <div class="panel-body panel-fluidbody">

                <div class="col-md-12">
                  <h4 class="add_new_rental">Reports Created by Me</h4>
                </div>
                <div class="col-md-12">
                  <table class="table table-striped table-hover datatables" id="tblSavedReports">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Action</th>
                        <th>Report Name</th>
                        <th>Created Date</th>
                        <th>Created Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td colspan="4">You have no saved report</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
                  <a href="<?php echo site_url('Reports/reportbuilder')?>"><i class="fa fa-plus"></i> Create Custom Report</a>
                </div>


              </div>

            </div>
          </div>


        </div>

      </div>
      <!-- container end -->
      <input type='hidden' id='hViewName' value="<?php echo $viewName;?>">
              <input type='hidden' id='hUserId' value="<?php echo $userid;?>">
        <input type='hidden' id='hCustomReportName' value="">      
      <input type='hidden' id='reportType' value="1">

    </div>
  </div>
