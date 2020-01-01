<script src="<?php echo site_url();?>js_module/PM/pm_leases.js"></script>
<script src="<?php echo site_url();?>js_module/PM/pm_common.js"></script>
<script src="<?php echo site_url();?>js_module/common.js"></script>

<body class="pmleases">

  <div id="wrapper">

    <div class="container">
     <!-- Page Heading -->
     <div class="row">
      <div class="col-md-10">
        <div class="page_head_area">
         <h1><i class="fa fa fa-home"></i> Property Management - Leases	</h1>

       </div>
     </div>                    
   </div>
   <div class="row">
    <!-- Tab content -->
    <div class="tab-content tab-white">
      <form  method="post" data-toggle="validator"  role="form" id="uaelisting-form">
        <div class="row">
          <div class="col-lg-12">
            <button type="button" id="newLease" data-toggle="modal" data-target="#leaseform" class="btn btn-lg btn-primary"><i class="fa fa-plus-circle"></i> Add Lease</button>
            <button  style="display:none;" type="submit" id="Save" class="btn btn-lg btn-success" name="Save" value="Save Listing">
              <i class="fa fa-plus-circle"></i> Save Lease</button>
              <button  style="display:none;" type="button" id="editLease" class="btn btn-lg btn-warning" data-toggle="modal" data-target="#leaseform"><i class="fa fa-plus-circle"></i> Edit Lease</button>
              <button  style="display:none;" type="button" id="cancellease" class="btn btn-lg btn-default"><i class="fa fa-plus-circle"></i> Cancel</button>

            </div>
          </div>            

          <div class="row">
            <h4 class="add_new_rental">Property Management - Lease</h4></div>

            <div id="frm" class="row"> <!-- i removed this class name: fadeInUp -->

              <div class="col-md-6">
                <div class="panel panel-default">
                  <div class="panel-heading"><i class="fa fa-home"></i> Lease Details
                    <div class="panel-option">
                      <span class="pull-right clickable">
                        <i class="glyphicon glyphicon-chevron-up"></i>
                      </span>                          
                    </div>
                  </div>

                  <div id="divLeaseDetails" class="panel-body pmp-samehieght">

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Ref</label>
                        <div>
                          <!-- <span class="input-group-addon"><a data-target="#owner" data-toggle="modal" href=""><i class="fa fa-plus-circle"></i></a></span> -->
                          <input type="text" readonly="" class="form-control required input-sm" id="ref">                 
                        </div>
                      </div>                      
                      <div class="form-group">
                        <label>Unit</label>
                        <div>
                          <!-- <span class="input-group-addon"><a data-target="#owner" data-toggle="modal" href=""><i class="fa fa-plus-circle"></i></a></span> -->
                          <input type="text" readonly="" class="form-control required input-sm" id="unitTitle">                 
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Tenant</label>
                        <div>
                          <!-- <span class="input-group-addon"><a data-target="#owner" data-toggle="modal" href=""><i class="fa fa-plus-circle"></i></a></span> -->
                          <input type="text" readonly="" class="form-control required input-sm" id="tenantName">
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Tenant Details</label>
                        <!-- <textarea class="form-control" data-toggle="modal" data-target="#description" disabled=""></textarea> -->
                        <div id="divTenantDetails" class="well">
                          <strong>Name:</strong><h4><label id="tName">--</label></h4>
                          <div class="row">
                            <div class="col-md-12">
                              <strong>Contact Details: </strong><br>
                              <i class="fa fa-phone"></i> <label id="tMobile">--</label><br>
                              <i class="fa fa-envelope"></i> <label id="tEmail">--</label><br>
                            </div>
                          </div>
                        </div>                       
                      </div>
                      <div class="form-group">
                        <label>Start Date</label>
                        <div class="input-group">
                          <input type="text" class="form-control input-sm datepicker" id="startdate">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>End Date</label>
                        <div class="input-group">
                          <input type="text" class="form-control input-sm datepicker" id="enddate">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Lease Amount</label>
                        <div class="input-group">
                          <input type="text" class="form-control input-sm" id="leaseamount">
                          <span class="input-group-addon">AED</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Commission</label>
                        <input type="text" class="form-control input-sm" disabled="disabled" id="commission">
                      </div>
                    </div>
                    <div class="col-md-6">

                      <div class="form-group">
                        <label>Payment Mode</label>
                        <select class="form-control required input-sm" required="paymentmode" id="paymentmode" name="paymentmode">
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Payment Term</label>
                        <select class="form-control required input-sm" required="" id="paymentterm" name="paymentterm">
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Cheques</label>
                        <input type="number" required="" class="form-control required input-sm" max="12" min="1" id="cheques" name="cheques">
                      </div>
                      <div class="form-group">
                        <label>Source of Tenancy</label>
                        <select class="form-control required input-sm" required="" id="sourceoftenancy" name="sourceoftenancy">
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Deposit Held by</label>
                        <select class="form-control required input-sm" required="" id="depositheldby" name="depositheldby">
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Ejari status</label>
                        <select required="" class="form-control required input-sm" id="ejaristatus" name="ejaristatus">
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Ejari no.</label>
                        <input type="text" disabled="disabled" class="form-control input-sm" id="ejarinumber">
                      </div>
                      <div class="form-group">
                        <label>Reminder</label>
                        <select class="form-control required input-sm" id="reminder" name="reminder">
                        </select>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Deposit</label>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" id="deposit_percentage">
                              <span class="input-group-addon">%</span>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>&nbsp;</label>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" id="deposit_amount">
                              <span class="input-group-addon">AED</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Fee</label>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" id="fees_percentage">
                              <span class="input-group-addon">%</span>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>&nbsp;</label>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" id="fees_amount">
                              <span class="input-group-addon">AED</span>
                            </div>
                          </div>
                        </div>
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
                      <li role="presentation" class="active"><a href="#tabNotes" aria-controls="tabNotes" role="tab" data-toggle="tab">Notes</a></li>
                      <li role="presentation"><a href="#tabDocuments" aria-controls="tabDocuments" role="tab" data-toggle="tab">Documents</a></li>
                    </ul>
                  </div>                        
                  <div class="panel-body tab-nopadding pmp-samehieght">
                    <div class="tab-content tab-nopadding">
                      <div role="tabpanel" class="tab-pane active" id="tabNotes" style="height: 300px">
                            <div class="input-group">
                              <input type="text" placeholder="Enter Notes" id="txtNote" class="form-control input-sm">
                              <div class="input-group-addon" style="background-color: cornflowerblue;">
                                <button id="btnSaveNote" style="background-color: cornflowerblue;color: white"><i class="fa fa-save"></i></button>
                              </div>
                            </div>
                        <div id="notes" style="overflow: auto; overflow-x: hidden;padding-left: 10px;padding-top: 10px">
                        </div>
                      </div> 
                      <div role="tabpanel" class="tab-pane" id="tabDocuments">
                        <div id="tabDocuments" class="tab-pane active" role="tabpanel">
                          <input type="text" placeholder="Type filename" id="docName" class="form-control input-sm">
                          
                          <div class="input-group">
                            <input type="file" style="width:190px;height: 30px" class="pull-left">
                            <button type="button" style="width:70px; height:30px" class="btn btn-primary" id="btnSaveNote">
                              Upload
                            </button>
                          </div>

                          <div id="documents" style="padding-left: 10px;padding-top: 10px">
                            <br/>

                           
                          </div>

                        </div>
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
      <div class="row">
        <div class="inner_tab_nav">
          <ul id="ulLeases" class="nav nav-tabs">
          <li value="0" class="active"><a href="#" value="0">All Leases <span id="cntAll" class="text-info">(<?php echo $all;?>)</span></a></li>
          <li value="1"><a href="#" value="1">Expiring Soon <span id="cntExpiring" class="text-info">(<?php echo $expiring;?>)</span></a></li>
          </ul>
        </div>
        <div class="tab-content tab-white">
          <div style="">
            <input style="width:300px" class="form-control input-sm search_init" type='text' id='txtSmartSearch_leases' placeholder="Search here" />
          </div>
          <table id="tblLeases" aria-describedby="dataTables-current-listing_info" class="table table-striped table-hover datatables datatable-setbotclass dataTable no-footer">
            <thead class="listing_headings">
              <tr>
                <th>
                </th>
                <th>
                  <div style="cursor:pointer;min-width:50px;" title="Click here to sort">
                    Status
                  </div>
                </th>
                <th>
                  <div style="cursor:pointer;min-width:50px;" title="Click here to sort">
                    Ref
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
                    Beds
                  </div>
                </th>
                <th>
                  <div style="cursor:pointer;" title="Click here to sort">
                    Owner
                  </div>
                </th>
                <th>
                  <div style="cursor:pointer; min-width:40px;" title="Click here to sort">
                    Next Available
                  </div>
                </th>
                <th>
                  <div style="cursor:pointer; min-width:40px;" title="Click here to sort">
                    Property Mgr
                  </div>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="dataTables_empty" colspan="6">Loading data from server
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
