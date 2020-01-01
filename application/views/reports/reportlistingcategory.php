    <script src="<?php echo site_url();?>js_module/Reports/sol.js"></script>
    <script src="<?php echo site_url();?>js_module/Reports/reports.js"></script>
    <script src="<?php echo site_url();?>js_module/Reports/reports_common.js"></script>

<body class="reports">


  <div id="wrapper">

    <div class="container">
     <!-- Page Heading -->
     <div class="row">
      <div class="col-md-10">
        <div class="page_head_area">
         <h1><i class="fa fa-pie-chart"></i> Reports  </h1>
         <!-- <h3 class="gist-secondhead">Dashboard</h3>                 -->
       </div>
     </div>                    
   </div>
   <div class="row">
     <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="col-md-12">
            <h3 class="gist-reportinghead">Listings By Listing Type & Category</h3>
            <div class="row">
              <div class="col-xs-1">
                <div class="form-group">
                  <select class=" form-control">
                    <option data-content="<img src='<?php echo site_url()?>images/uae.png'>">Dubai</option>
                    <option data-content="<img src='<?php echo site_url()?>images/usa.png'>">International</option>
                  </select>
                </div>
              </div>
            </div>
            <span class="gist-repsectext">Currently Viewing Company Wide Listings in total as of today</span>
          </div>

          <!-- buttons for action  -->
          <div class="col-md-6">
            <ul class="list-inline">
              <li class=""> 
                <a id="aSendByEmail" href="" data-target="#modEmail" data-toggle="modal" class="btn btn-default"><i class="fa fa-envelope"></i> Email </a></li>
                <li class=""> 
                  <a href="" class="btn btn-default"><i class="fa fa-share-square-o"></i> Export </a></li>
                  <li> <a href="" class="btn btn-default"><i class="fa fa-print"></i> Print </a></li>
                  <li> <a href="" id="aAddtoDashboard" class="btn btn-link">Add to Dashboard </a></li>
                </ul>
              </div>
              <div class="col-md-6">
                <form class="form-inline pull-right">
                  <div class="form-group">
                    <input type="text" disabled="disabled" class="form-control" id="exampleInputName2" placeholder="In total">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail2"> Date Range</label>
                    <input type="text" class="form-control" id="datepcikrange" name="datepcikrange" placeholder="Real Time">
                  </div>

                </form>
              </div>
            </div>  

            <div class="panel-body panel-graybody">
              <div class="col-md-10">
                <a class="" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="true" aria-controls="collapseExample" id="showCustomreport"><p>Customize Your Report</p></a>
              </div>
              <div class="col-md-2">
                <a role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" id="showCustomreport"><i class="fa fa-chevron-up pull-right"></i></a>
              </div>
              <div class="clear"></div>
              <div class="collapse" id="collapseExample">

                <div class="repviewfilter-sep"> 
                  <div class="customize-title col-xs-12 col-md-1">Grouping:</div>
                  <div class="customize-right colx-xs-12 col-md-11">
                    <div class="ember-view groups-listing">    
                      <div class="filter-group-main">
                        <div class="filter-title">Grouped by:<span> Type </span></div>
                      </div>
                      <div class="filter-group-main filter-sep">
                        <div class="filter-title">Sub-grouped by: <span>Category</span>
                          <i class="fa fa-trash"></i></div>
                        </div>
                        <div class="filter-group-main">
                          <select id="selSubGroup" class="form-control input-sm ">
                            <option value='0'>Add Sub-group</option>
                            <option value='1'>Agent</option>
                            <option value='2'>Location</option>
                          </select>
                        </div>
                        <div class="filter-group-main">
                          <button class="btn btn-success btnPopulateTable" id="ListingCategory"> <span aria-hidden="true" class="glyphicon glyphicon-ok"></span> Apply </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="repviewfilter-sep"> 
                    <div class="customize-title col-xs-12 col-md-1">Filters:</div>
                    <div class="customize-right colx-xs-12 col-md-11">
                      <div class="filter-group-main">
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#addmorefilter" aria-expanded="false" aria-controls="addmorefilter"> <span aria-hidden="true" class="glyphicon glyphicon-plus-sign"></span> Add Filters </button>
                      </div>
                      <div class="collapse" id="addmorefilter">
                        <div class="tab-content">
                          <form class="form-inline">
                            <div class="form-group">
                              <label for="filter_parameter">Filter </label>
                              <select name="category" id="filter_parameter" class=" form-control">
                                <option value="0">Please select</option>
                                <option value="type">Type</option>
                                <option value="beds">No. of Beds</option>
                                <option value="location">Location</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail2"></label>
                              <select name="category" id="filter_condition" class="form-control" >
                              </select>
                            </div>
                            <div id="divParameterValue" class="form-group">
                              <select name="category" id="filter_value" class="form-control" style="width: 300px"></select>
                              <div id="divSliderSection" style="display: none; width: 400px;" class="form-group">
                                <span>Range:&nbsp;</span><label for="amount" id='amount'></label>
                                <div id="divSlider"></div>
                              </div>
                            </div>
                            <button type="button" class="btn btn-link" id="btnAddFilter">
                              <span aria-hidden="false" class="glyphicon glyphicon-plus"></span> Add filter</button>
                            </form>
                            <hr>
                            <form>
                              <div id="filters">
                                <table class="table table-striped table-hover datatables" style="display:none" id="tblFilters">
                                  <thead>
                                    <tr>
                                      <th></th>
                                      <th>Parameter</th>
                                      <th>Condition</th>
                                      <th>Value</th>
                                      <th>Operator</th>
                                    </tr>
                                  </thead>
                                  <tbody></tbody>
                                </table>  
                              </div>
                            </form> 
                            <button type="button" class="btn btn-success" id="btnSaveFilters">
                              <span aria-hidden="true" class="glyphicon glyphicon-ok"></span> 
                              Apply
                            </button>
                            <button type="button" class="btn btn-danger">
                              <span aria-hidden="true" class="glyphicon glyphicon-remove"></span>
                              Cancel
                            </button>
                            <hr>
                          </form>


                          </div>
                        </div>
                      </div>
                    </div>
                    <div id="divSaveReport">
                      
                      <!-- <div> -->
                        <!-- <input type='text' placeholder='(Optional) Assign a name for this report'/><button>Save</button> -->
                      <!-- </div> -->
                    </div>                    
                  </div>

                </div>    
                <div class="col-md-10">
	                <a id="aSaveReport" href="#"> <i class="fa fa-floppy-o"></i> Save Report</a>
                </div>
                <div class="panel-body panel-fluidbody">

                  <div class="col-md-12"><h4 class="add_new_rental">Summary</h4></div>

                  <div class="col-md-1"></div>
                  <div class="col-md-10">
                    <table class="table table-striped table-hover datatables" id="tblReport">
                      <thead></thead>
                      <tbody></tbody>
                    </table>
                  </div>
                  <div class="col-md-1"></div>

                </div> 
                <div class="panel-body panel-fluidbody">
                  <ul role="tablist" class="nav nav-tabs">
                    <li class="active" role="presentation"><a data-toggle="tab" role="tab" aria-controls="piechartview" href="#piechartview">
                      <i class="fa fa-pie-chart"></i>
                    </a></li><li role="presentation"><a data-toggle="tab" role="tab" aria-controls="barchartview" href="#barchartview">
                    <i class="fa fa-bar-chart"></i></a></li>
                  </ul>
                  <div class="tab-content tab-nopadding">
                    <div id="piechartview" class="tab-pane active" role="tabpanel">
                      <div id="piechart1" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
                    </div>
                    <div id="barchartview" class="tab-pane" role="tabpanel">

                      <div id="barchart1" style="min-width: 75%; height: 400px; margin: 0 auto"></div>

                    </div>
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
      </div>

      <!-- wrapper end -->
      <div class="modal fade" id="modEmail" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title">Send by Email</h4>
            </div>

            <div class="modal-body">
              <div class="form-group">
                <label for="txtEmail" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="txtEmail" placeholder="Email">
                </div>
              </div>
              <div class="form-group">
                <label for="txtAreaEmail" class="col-sm-2 control-label">Message body</label>
                <div class="col-sm-10">
                  <textarea class="form-control" id="txtAreaEmail" placeholder="Type your short message here."></textarea>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button id="btnSendReport" class="btn btn-success" data-dismiss="modal" type="button">
                <i class="fa fa-check"></i> Send Report
              </button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>  

