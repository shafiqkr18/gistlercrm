<script src="<?php echo site_url();?>js_module/Reports/agentleaderboard.js"></script>

<body class="reports">

  <div id="wrapper"> 

    <div class="container">
      <!-- Page Heading -->
      <div class="row">
        <div class="col-md-10">
          <div class="page_head_area">
            <h1><i class="fa fa-pie-chart"></i> Reports </h1>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="col-md-12">
                <h3 class="gist-reportinghead">Agent Leaderboard</h3>
                <div class="row">
                  <div class="col-xs-1">
                    <div class="form-group">
                      <select class="selectpicker form-control">
                        <option data-content="<img src='<?php echo site_url();?>images/uae.png'>">Dubai</option>
                        <option data-content="<img src='<?php echo site_url();?>images/usa.png'>">International</option>
                      </select>
                    </div>
                  </div>
                </div>
                <span class="gist-repsectext">Currently Viewing Company Wide Leadboard of agents as of today</span>
              </div>

              <div>
                <input type="hidden" value=0 id="selectedType">
                <input type="hidden" value=0 id="selectedAgent">
                <input type="hidden" value=0 id="selectedDate">
              </div>

              <!-- buttons for action  -->
              <div class="col-md-6">
                <ul class="list-inline">
                  <li class="">
                    <a href="" class="btn btn-default"><i class="fa fa-envelope"></i> Email </a></li>
                  <li class="">
                    <a href="" class="btn btn-default"><i class="fa fa-share-square-o"></i> Export </a></li>
                  <li> <a href="" class="btn btn-default"><i class="fa fa-print"></i> Print </a></li>
                  <li>
                    <a href="" class="btn btn-link"></a>
                  </li>
                </ul>
              </div>
              <div class="col-md-6">

              </div>
            </div>
            <!-- Graphs -->
            <hr/>
            <div class="panel-body">
              
              <div class="col-md-6 col-md-offset-4">
                <h3 id="reportTitle">Company Performance Charts</h3>  

                <div class="col-md-10">
                  <p></p>
                </div>
              </div>


              <div>
                <div class="col-md-2">
                <a id="showCustomreport" aria-controls="collapseExample1" aria-expanded="true" href="#collapseExample1" data-toggle="collapse" role="button" class=""><i class="fa fa-chevron-up pull-right"></i></a>
                </div>
              </div>
              <div class="clear"></div>

              <div class="collapse in" id="collapseExample1">
                <div id="" class="row">
                  <div class="col-md-1">
                    Agent:
                  </div>
                  <div class="col-md-3">
                    <div class="ember-view groups-listing">
                      <div class="filter-group-main">
                        <select id="selAgents" class="refreshData form-control input-sm "> <!-- selectpicker   -->
                          <option value=0 >Company</option>
                        </select>
                      </div>
                    </div>                   
                  </div>
                  <div class="col-md-1">
                    Type:
                  </div>
                  <div class="col-md-3">
                    <div class="ember-view groups-listing">
                      <div class="filter-group-main">
                        <select id="" class="refreshData selType form-control input-sm "> <!-- selectpicker   -->
                          <option value=0 >Sales & Rentals Combined</option>
                          <option value=2 >Sales</option>
                          <option value=1 >Rentals</option>
                        </select>
                      </div>
                    </div>                   
                  </div> 
                  <div class="col-md-1">
                    Date:
                  </div>    
                  <div class="col-md-3">
                    <div class="ember-view groups-listing">
                      <div class="filter-group-main">
                        <select id="" class="refreshData selDate form-control input-sm "> <!-- selectpicker   -->
                          <option value=0 >All Time</option>
                          <option value="pastSevenDays" >Past Seven Days</option>
                          <option value="pastThirtyDays" >Past Thirty Days</option>
                          <option value="pastThreeMonths" >Past Three Months</option>
                          <option value="pastYear" >Year to Date</option>
                        </select>
                      </div>
                    </div>                   
                  </div>           
                </div>      

                <!-- bargraphs here -->
                <div class="repviewfilter-sep">
                </div>

                <div class="col-md-7">
                  <div id="barchart2" style="min-width: 75%; height: 400px; margin: 0 auto"></div>
                </div>

                <div class="col-md-5">
                  <div id="barchart3" style="min-width: 75%; height: 400px; margin: 0 auto"></div>
                </div>                
              </div>
            </div> 

            <hr/>
            <div class="panel-body">

              <div class="col-md-6 col-md-offset-4">
                <h3>Agents Performace Charts</h3>  

                <div class="col-md-10">
                  <p></p>
                </div>
              </div>
              <div class="col-md-2">
                <a role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" id="showCustomreport"><i class="fa fa-chevron-up pull-right"></i></a>
              </div>
              <div class="clear"></div>
           

              <div class="collapse in" id="collapseExample">
                <div class="row">
                  <div class="col-md-2">
                    Listing Type:
                  </div>
                  <div class="col-md-4">
                    
                    <div class="ember-view groups-listing">
                      <div class="filter-group-main">
                        <select id="" class="refreshData selType form-control input-sm "> <!-- selectpicker   -->
                          <option value=0 >Sales & Rentals Combined</option>
                          <option value=2 >Sales</option>
                          <option value=1 >Rentals</option>
                        </select>
                      </div>
                    </div>                   
                  </div>
                  <div class="col-md-2">
                    Date:
                  </div>
                  <div class="col-md-4">
                    <div class="ember-view groups-listing">
                      <div class="filter-group-main">
                        <select id="" class="refreshData selDate form-control input-sm "> <!-- selectpicker   -->
                          <option value=0 >All Time</option>
                          <option value="pastSevenDays" >Past Seven Days</option>
                          <option value="pastThirtyDays" >Past Thirty Days</option>
                          <option value="pastThreeMonths" >Past Three Months</option>
                          <option value="pastYear" >Year to Date</option>
                        </select>
                      </div>
                    </div>                    
                  </div>
                </div>                            
             
              

                <div class="repviewfilter-sep">


                </div>

                <div class="col-md-12">
                  <div id="barchart1" style="min-width: 75%; height: 400px; margin: 0 auto"></div>
                </div>
              </div>
            </div>

            <hr/>
            <div class="panel-body panel-fluidbody row">
              <table class="table table-striped table-hover datatables " id="tblAgentLeaderboard">
                <thead>
                  <tr>
                    <th>Rank</th>
                    <th>Agent</th>
                    <th>Listings</th>
                    <th>Viewings</th>
                    <th>Leads</th>
                    <th>Deals</th>
                    <th>Successful Deals</th>
                    <th>Lead Conversion</th>
                    <th>Company Conversion</th>
                    <th>Agents Conversion</th>
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
</body>
