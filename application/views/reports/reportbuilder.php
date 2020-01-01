<link href="<?php echo site_url();?>css/step_wizard.css" rel="stylesheet" type="text/css">

<script src="<?php echo site_url();?>js_module/Reports/sol.js"></script>

<script src="<?php echo site_url();?>js_module/Reports/reports_common.js"></script>
<script src="<?php echo site_url();?>js_module/Reports/reportbuilder.js"></script>

<script type="text/javascript" src="<?php echo site_url();?>js/jquery.setpwizard.min.js"></script>
  <script type="text/javascript">
      $(document).ready(function(){
        // Smart Wizard   

        $('#wizard').smartWizard({
            onLeaveStep:leaveAStepCallback,
            onFinish:onFinishCallback
        });
        
        function onFinishCallback(){
          // $('#wizard').smartWizard('showMessage','Finish Clicked');
          // console.log("here!");
          bootbox.alert("Wizard finished.")
        }    

        function leaveAStepCallback(obj){
          var fromStep = $(obj[0]).attr("rel") -1;
          var nextStep = $(obj[0]).attr("rel");

          if(nextStep == 3){
            //TODO: generate report based on parameters
            populateTable_ClickEvent("reportbuilder");
          }

          // console.log("fromStep--> " + fromStep + " nextStep--> " + nextStep);
          return validateSteps(fromStep); // return false to stay on step and true to continue navigation 
        }         

        function validateSteps(stepnumber){
            var isStepValid = true;
            var $hdnInputs = $("#formHiddenInputs");

            if(stepnumber == 0){
              if(! $hdnInputs.find("#spModule").val() > 0){
                // bootbox.alert("stepnumber++-->" + stepnumber + 1);
                setError("Error!", "Please fillout the dropdowns completely.");
                isStepValid = false;
              }
              else $("#divAlert").hide();
            }

            return isStepValid;  
        }    
      });
</script>

    

<body class="dashboard">


  <div id="wrapper">
    <div class="container">


      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">
          <div class="page_head_area">
            <h1><i class="fa fa-pie-chart"></i> Report</h1></div>
        </div>
      </div>


      <!-- Smart Wizard -->

      <form id="formHiddenInputs">
        <input type="hidden" name="module" id="spModule" val="">
        <input type="hidden" name="group" id="spGroup" val="">
        <input type="hidden" name="subgroup" id="spSubGroup" val="">
        <input type="hidden" name="filters" id="hdnFilter" val="">
        <input type="hidden" name="userId" id="hdnUserId" val="">
      </form>
      <div id="divAlert" style="display:none" class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <span id="alertMessage"><strong>Error!</strong> Please fillout the dropdowns completely.</span>
      </div>
      <div class="report_builder">
        <h3 class="text-success">Create Custom Report</h3>
        <div id="wizard" class="swMain">
          <ul>
            <li>
              <a href="#step-1">
                <span class="large">Step 1</span>
                <span class="small">Select Module</span>
              </a>
            </li>
            <li>
              <a href="#step-2">
                <span class="large">Step 2</span>
                <span class="small">Assign Groupings</span>
              </a>
            </li>
            <li>
              <a href="#step-3">
                <span class="large">Step 3</span>
                <span class="small">Select Filters</span>
              </a>
            </li>
            <li>
              <a href="#step-4">
                <span class="large">Step 4</span>
                <span class="small">Generate Report</span>
              </a>
            </li>

          </ul>
          <div id="step-1">
            <div class="row">
              <div class="col-md-12">
                <div class="text-center">
                  <h4 class="text-primary">Step 1: Select Module</h4>
                  <p>Select a module or group of your choice</p>
                </div>

                <div class="form-group col-md-4 col-md-offset-4">

                  <div class="input-group">
                    <div class="input-group-btn">
                      <button type="button" class="btn btn-sm btn-block btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <span class="selectedoption" id="selectedModule">Select</span> <span class="caret"></span></button>
                      <ul class="dropdown-menu" id="spModule">
                        <li><a value="0" href="#">Select</a></li>
                        <li><a value="1" href="#">Contacts</a></li> 
                        <li><a value="2" href="#">Deals</a></li>
                        <li><a value="3" href="#">Leads</a></li>
                        <li><a value="4" href="#">Listings</a></li>
                        <li><a value="5" href="#">Agent Leaderboard</a></li>
                      </ul>
                    </div>
                    <!-- /btn-group -->
                  </div>
                  <!-- /input-group -->
                </div>
              </div>
            </div>
          </div>

          <div id="step-2">

            <div class="row">
              <div class="col-md-12">
                <div class="text-center">
                  <h4 class="text-primary">Step 2: Assign Grouping</h4>
                  <p>Declare group of your choice</p>
                </div>

                <div class="row">
                  <br/>
                  <div class="col-md-4 col-md-offset-4">
                    <h5>Grouped By</h5>
                    <div class="input-group">
                      <div class="input-group-btn">
                        <button type="button" class="btn btn-sm btn-block btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                          <span class="selectedoption" id="selectedGroup">Select</span> <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" id="spGroup">
                          <li><a value="0" href="#">Select</a></li>
                          <li><a value="1" href="#">Listing Type</a></li> 
                          <li><a value="2" href="#">Category</a></li> 
                          <li><a value="3" href="#">Location</a></li>
                          <li><a value="4" href="#">Agent</a></li>
                        </ul>
                      </div>
                      <!-- /btn-group -->
                    </div>
                    <!-- /input-group -->
                    <br/>
                    <div class="row">
                      <div class="col-md-6">
                        <button type="button" class="btn btn-primary btn-sm" id="aSubGroup"><i class="fa fa-plus"></i> Add Sub Group</button>
                      </div>
                      <div id="divSubGroup" style="display:none" class="col-md-6">
                        <div class="input-group">
                          <div class="input-group-btn">
                            <button type="button" class="btn btn-sm btn-block btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                              <span class="selectedoption" id="selectedSubGroup">Select</span> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" id="spSubGroup">
                              <li><a value="0" href="#">Select</a></li>
                              <li><a value="1" href="#">Listing Type</a></li> 
                              <li><a value="2" href="#">Category</a></li> 
                              <li><a value="3" href="#">Location</a></li>
                              <li><a value="4" href="#">Agent</a></li>
                            </ul>
                          </div>
                          <!-- /btn-group -->
                        </div>                      
                      </div>
                    </div>
                  </div>
                </div>         

              </div>
            </div>
          </div>

          <div id="step-3">
            <div class="row">
              <div class="col-md-12">
                <div class="text-center">
                  <h4 class="text-primary">Step 3: Select Filter</h4>
                  <p>Add filter of your choice</p>
                </div>

                <div class="row">
                  <div class="col-md-11 col-md-offset-1">

                    <form id="formFilters">
                      <div class="row">
                        <div class="col-sm-3">
                          <label><strong>Parameter</strong></label>
                          <select name="category" id="filter_parameter" class="form-control" >
                            <option value="0">Select</option>
                            <option value="type">Type</option> 
                            <option value="beds">No. of Beds</option> 
                            <option value="location">Location</option>
                            <option value="agent">Agent</option>    
                          </select>
  
                        </div>
                        <div class="col-sm-3">
                          <label><strong>Condition</strong></label>
                          <select name="category" id="filter_condition" class="form-control" >
                          </select>
                        </div>
                        <div class="col-sm-3">
                          <label><strong>Value</strong></label>
                            <div id="divParameterValue" class="form-group">
                              <select name="category" id="filter_value" class="form-control" style="width: 300px"></select>
                              <div id="divSliderSection" style="display: none; width: 400px;" class="form-group">
                                <span>Range:&nbsp;</span><label for="amount" id='amount'></label>
                                <div id="divSlider"></div>
                              </div>
                            </div>
                        </div>
                        <div class="col-sm-1">
                          <label>&nbsp;</label>
                          <button type="button" class="btn btn-sm btn-primary" id="btnAddFilter">
                            <span aria-hidden="false" class="glyphicon glyphicon-plus"></span> Add filter
                          </button> 
                        </div>
                      </div>
                    </form>
                    <hr/>
                    <div id="divFilters" class="row">
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
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>

          <div id="step-4">
            <div class="row">
              <div class="col-md-6 col-md-offset-3">

                <div class="row" id="divresults">
                  <div  class="row">
                    <div class="col-md-10 col-md-offset-1 ">
                      <div class="table-responsive report-builder-table-color">

                        <table class="table table-striped datatables table-bordered table-hover" id="tblReport">
                          <thead></thead>
                          <tbody></tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row text-center">
                    <div class="col-md-6 col-md-offset-3">
                      <h4>Distributions of Leads</h4>

                      <div id="piechartview" class="tab-pane active" role="tabpanel">
                        <div id="piechart1" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
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

      <!-- End SmartWizard Content -->

      
    <!-- container end -->
  </div>
  <!-- wrapper end -->

                <!-- Success Message Alert -->
                <div style="display:none"role="alert" class="alert alert-success alert-dismissible fade in">
                  <button aria-label="Close" data-dismiss="alert" class="close" type="button">
                    <span aria-hidden="true">×</span></button>
                  <strong>Well done!</strong> You successfully created the report.
                </div>