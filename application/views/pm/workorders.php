<script src="<?php echo site_url();?>js_module/PM/pm_workorders.js"></script>
<script src="<?php echo site_url();?>js_module/PM/pm_common.js"></script>
<script src="<?php echo site_url();?>js_module/common.js"></script>

<body class="pmworkorders">

  <div id="wrapper">

    <div class="container">
      <!-- Page Heading -->
      <div class="row">
        <div class="col-md-10">
          <div class="page_head_area">
            <h1><i class="fa fa fa-home"></i> Property Management - Work Orders </h1>

          </div>
        </div>                    
      </div>
      <div class="row">
        <!-- Tab content -->
        <div class="tab-content tab-white">
          <form  method="post" data-toggle="validator"  role="form" id="uaelisting-form">
            <div class="row">
              <div class="col-lg-12">
                <button type="button" id="newWorkOrder" data-toggle="modal" data-target="#workorderform" class="btn btn-lg btn-primary"><i class="fa fa-plus-circle"></i> Add Work Order</button>
                <button  style="display:none;" type="submit" id="saveWorkOrder"  class="btn btn-lg btn-success" name="Save" value="Save Listing">
                  <i class="fa fa-plus-circle"></i> Save Work Order</button>
                  <button  style="display:none;" type="button" id="editWorkOrder" data-toggle="modal" data-target="#workorderform" class="btn btn-lg btn-warning"><i class="fa fa-plus-circle"></i> Edit Work Order</button>
                  <button  style="display:none;" type="button" id="cancelWorkOrder" class="btn btn-lg btn-default"><i class="fa fa-plus-circle"></i> Cancel</button>
                </div>
              </div>            

              <div class="row">
                <h4 class="add_new_rental">Property Management - Work Orders</h4></div>

                <div class="row fadeInUp">

                  <div class="col-md-6">
                    <div class="panel panel-default">
                      <div class="panel-heading"><i class="fa fa-home"></i> Work Order Details
                        <div class="panel-option">
                          <span class="pull-right clickable">
                            <i class="glyphicon glyphicon-chevron-up"></i>
                          </span>                          
                        </div>
                      </div>

                      <div id="divWorkOrderDetails" class="panel-body pmp-samehieght">

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Ref</label>
                            <input type="text" required="" class="form-control required input-sm" id="ref" name="ref">                                  
                          </div>                          
                          <div class="form-group">
                            <label>Unit</label>
                            <div>
                              <!-- <span class="input-group-addon"><a data-target="#owner" data-toggle="modal" href=""><i class="fa fa-plus-circle"></i></a></span> -->
                              <input type="text" readonly="" class="form-control required input-sm" id="unitTitle">                 
                            </div>
                          </div>
                          <div class="form-group">
                            <label>Service Provider</label>
                            <div>
                              <!-- <span class="input-group-addon"><a data-target="#owner" data-toggle="modal" href=""><i class="fa fa-plus-circle"></i></a></span> -->
                              <input type="text" required="" class="form-control required input-sm" id="serviceprovider" name="serviceprovider">
                            </div>
                          </div>
                          <div class="form-group">
                            <label>Provider Details (More Inside)</label>
                            <div>
                              <table class="table">
                                <tbody>
                                  <tr><td>Contact Person</td><td><label id="uContact"></label></td></tr>
                                  <tr><td>Mobile no</td><td><label id="uMobile"></label></td></tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" disabled="" id="description" name="description"></textarea>
                          </div>
                        </div>
                        <div class="col-md-6">

                          <div class="form-group">
                            <label>Type</label>
                            <select required="" class="form-control required input-sm" id="type" name="type">
                              <option value="">Please select</option>
                              <option value="1">Maintenance</option>
                              <option value="2">Pest Control</option>
                              <option value="3">Interior Decoration</option>
                              <option value="4">Landscaping</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Sub Type</label>
                            <select required="" class="form-control required input-sm" id="subtype" name="subtype">
                              <option value="">Please select</option>
                              <option value="1">Option 1</option>
                              <option value="2">Option 2</option>
                              <option value="3">Option 3</option>
                              <option value="4">Option 4</option>
                              <option value="5">Option 5</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Assigned To</label>
                            <select required="" class="form-control required input-sm" id="assignedto" name="assignedto">
                              <option value="">Please select</option>
                              <option value="1">Option 1</option>
                              <option value="2">Option 2</option>
                              <option value="3">Option 3</option>
                              <option value="4">Option 4</option>
                              <option value="5">Option 5</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Status</label>
                            <select required="" class="form-control required input-sm" id="status" name="status">
                              <option value="">Please select</option>
                              <option value="1">Scheduled</option>
                              <option value="2">Not Scheduled</option>
                              <option value="3">In Progress</option>
                              <option value="4">Completed</option>
                            </select>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Start Date</label>
                                <div>
                                  <input type="text" class="form-control input-sm datepicker" id="startdate" name="startdate">
                                </div>
                              </div>    
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>End Date</label>
                                <div>
                                  <input type="text" class="form-control input-sm datepicker" id="enddate" name="enddate">
                                </div>
                              </div>    
                            </div>
                          </div>
                          <div class="form-group">
                            <label>Cost</label>
                            <input type="text" disabled="disabled" id="" class="form-control input-sm" id="cost" name="cost">
                          </div>
                          <div class="form-group">
                            <label>Paid By</label>
                            <select required="" class="form-control required input-sm" id="paidby" name="paidby">
                              <option value="">Please select</option>
                              <option value="1">Landlord</option>
                              <option value="2">Tenant</option>
                              <option value="3">Property Management Company</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Payment Status</label>
                            <select required="" class="form-control required input-sm" id="paymentstatus" name="paymentstatus">
                              <option value="">Please select</option>
                              <option value="1">Not Paid</option>
                              <option value="2">Paid By Cash</option>
                              <option value="3">Paid By Cheque</option>
                              <option value="4">Partly Paid</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Priority</label>
                            <select required="" class="form-control required input-sm" id="priority" name="priority">
                              <option value="">Please Select</option>
                              <option value="1">Low</option>
                              <option value="2">Medium</option>
                              <option value="3">High</option>
                            </select>
                          </div>                          
                        </div>

                      </div>

                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="panel panel-default">
                      <div class="panel-heading"><i class="fa fa-home"></i> Unit Details
                        <div class="panel-option">
                          <span class="pull-right clickable">
                            <i class="glyphicon glyphicon-chevron-up"></i>
                          </span>                          
                        </div>
                      </div>

                      <div id="divUnitHeader" class="panel-body tab-nopadding pmp-samehieght">
                        <span class="text-warning">No Unit</span>
                        <div id="divUnitDetails" style="display:none" class="pmp-samehieght">
                          <table class="table table-striped">
                            <tbody>
                              <tr>
                                <td><strong>Type: </strong></td>
                                <td><label id="uType"></label></td>
                              </tr>
                              <tr>
                                <td><strong>Ref: </strong></td>
                                <td><label id="uRef"></label></td>
                              </tr>
                              <tr>
                                <td><strong>Category: </strong></td>
                                <td><label id="uCategory"></label></td>
                              </tr>
                              <tr>
                                <td><strong>Sub-location: </strong></td>
                                <td><label id="uSubLocation"></label></td>
                              </tr>
                              <tr>
                                <td><strong>Location: </strong></td>
                                <td><label id="uLocation"></label></td>
                              </tr>
                              <tr>
                                <td><strong>Emirate: </strong></td>
                                <td><label id="uRegion"></label></td>
                              </tr>
                              <tr>
                                <td><strong>No. of Beds: </strong></td>
                                <td><label id="uBeds"></label></td>
                              </tr>
                              <tr>
                                <td><strong>Owner: </strong></td>
                                <td><label id="uLandlord"></label></td>
                              </tr>
                              <tr>
                                <td><strong>Agent: </strong></td>
                                <td><label id="uAgent"></label></td>
                              </tr>                                                                                                                                                                                                                  
                            </tbody>
                          </table>
                        </div>                        
                      </div>

                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="panel panel-default ">
                      <div class="panel-heading panel-gistab tab-nopadding">
                        <ul class="nav nav-tabs" role="tablist">
                          <li role="presentation" class="active">
                            <a href="#tabAccounts" aria-controls="tabAccounts" role="tab" data-toggle="tab">Accounts</a>
                          </li>
                          <li role="presentation">
                            <a href="#tabNotes" aria-controls="tabNotes" role="tab" data-toggle="tab">Notes</a>
                          </li>
                          <li role="presentation">
                            <a href="#tabDocuments" aria-controls="tabDocuments" role="tab" data-toggle="tab">Docs</a>
                          </li>                          
                        </ul>
                      </div>                        
                      <div class="panel-body tab-nopadding pmp-samehieght">
                        <div class="tab-content tab-nopadding">
                          <div role="tabpanel" class="tab-pane active" style="position:relative" id="tabAccounts">
                            <div id="divAccountHeader" style="position: relative; bottom: 0; width: 100%;  height: 280px;overflow: auto; overflow-x: hidden;">
                              <span class="text-warning">No Transactions Found</span>
                              <div id="divAccountDetail" style="display:none" class="pmp-samehieght">
                                <table class="table table-striped">
                                  <thead>
                                    <tr>   
                                      <td>Status</td>
                                      <td>Amount</td>
                                      <td>View</td>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                            <div class="well" style="text-align:right; position: absolute; bottom: 1; width: 100%;  height: 70px;">
                              <span style="color:green">Paid: AED<label  style="color:green" id="spPaid">0.00</label></span></br>
                              <span style="color:red">Due: AED<label  style="color:red" id="spDue">0.00</label></span>
                            </div>
                          </div>
                          <div role="tabpanel" class="tab-pane" id="tabNotes">
                            <div class="input-group">
                              <input type="text" placeholder="Enter Notes" id="txtNote" class="form-control input-sm">
                              <div class="input-group-addon" style="background-color: cornflowerblue;">
                                <button id="btnSaveNote" style="background-color: cornflowerblue;color: white"><i class="fa fa-save"></i></button>
                              </div>
                            </div>
                            <div id="divNoteContent" class="form-group" style="overflow: auto; overflow-x: hidden;padding-left: 10px;padding-top: 10px">

                            </div>
                          </div>
                          <div role="tabpanel" class="tab-pane" id="tabDocuments">

                          </div>                         
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </form>
              <!-- Rental Form End -->
            </div>



          </div>
          <div class="row fadeInUp">
            <div class="inner_tab_nav">
              <ul id="ulWorkOrders" class="nav nav-tabs">
                <li value="0" class="active"><a  href="#">All  <span id="cntAll" class="text-info">(<?php echo $all;?>)</span></a></li>
                <li value="1"><a  href="#">In progress <span id="cntInProgress" class="text-info">(<?php echo $inprogress;?>)</span></a></li>
                <li value="2"><a  href="#">Completed <span id="cntCompleted" class="text-info">(<?php echo $completed;?>)</span></a></li>
              </ul>
            </div>
            <div class="tab-content tab-white">
              <div style="Save Report">
                <input style="width:300px" class="form-control input-sm search_init" type='text' id='txtSmartSearch_workorders' placeholder="Search here" />
              </div>
              <table id="tblWorkOrders" aria-describedby="dataTables-current-listing_info" class="table table-striped table-hover datatables datatable-setbotclass dataTable no-footer">
                <thead class="listing_headings">
                  <tr>
                    <th>
                    </th>
                    <th>
                      <div style="cursor:pointer;min-width:50px;" title="Click here to sort">
                        Ref
                      </div>
                    </th>
                    <th>
                      <div style="cursor:pointer;" title="Click here to sort">
                        Status
                      </div>
                    </th>
                    <th>
                      <div style="cursor:pointer;" title="Click here to sort">
                        Priority
                      </div>
                    </th>
                    <th>
                      <div style="cursor:pointer;" title="Click here to sort">
                        Unit
                      </div>
                    </th>
                    <th>
                      <div style="cursor:pointer;" title="Click here to sort">
                        Category
                      </div>
                    </th>
                    <th>
                      <div style="cursor:pointer;" title="Click here to sort">
                        Emirate
                      </div>
                    </th>
                    <th>
                      <div style="cursor:pointer; white-space:nowrap;" title="Click here to sort">
                        Location
                      </div>
                    </th>
                    <th>
                      <div style="cursor:pointer; white-space:nowrap;" title="Click here to sort">
                        Sub-Location
                      </div>
                    </th>
                    <th>
                      <div style="cursor:pointer;" title="Click here to sort">
                        Service Provider
                      </div>
                    </th>
                    <th>
                      <div style="cursor:pointer;" title="Click here to sort">
                        Type
                      </div>
                    </th>
                    <th>
                      <div style="cursor:pointer;" title="Click here to sort">
                        Sub Type
                      </div>
                    </th>
                    <th>
                      <div style="cursor:pointer;" title="Click here to sort">
                        Payment Status
                      </div>
                    </th>
                    <th>
                      <div style="cursor:pointer;" title="Click here to sort">
                        Property Manager
                      </div>
                    </th>
                    <th>
                      <div style="cursor:pointer; min-width:40px;" title="Click here to sort">
                        Current Tenant
                      </div>
                    </th>
                    <th>
                      <div style="cursor:pointer; min-width:40px;" title="Click here to sort">
                        Updated
                      </div>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="dataTables_empty" colspan="6">
                      Loading data from server
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

      </div>

    </div>          
  </div>
  <!-- container end -->


</div>
<!-- wrapper end -->
