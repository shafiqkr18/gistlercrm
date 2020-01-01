<script src="<?php echo site_url();?>js_module/PM/pm_accounts.js"></script>
<script src="<?php echo site_url();?>js_module/PM/pm_common.js"></script>
<script src="<?php echo site_url();?>js_module/common.js"></script>

<body class="pmaccounts">

  <div id="wrapper">

    <div class="container">
      <!-- Page Heading -->
      <div class="row">
        <div class="col-md-10">
          <div class="page_head_area">
            <h1><i class="fa fa fa-home"></i> Property Management - Accounts  </h1>

          </div>
        </div>                    
      </div>
      <div class="row">
        <!-- Tab content -->
        <div class="tab-content tab-white">
          <form action="comment.php" method="post" data-toggle="validator"  role="form" id="uaelisting-form">
            <div class="row">
              <div class="col-lg-12">
                <button type="button" id="newTransaction" data-toggle="modal" data-target="#addTransaction" class="btn btn-lg btn-primary"><i class="fa fa-plus-circle"></i> Add Transaction</button>
                <button  style="display:none;" type="button" id="editTransaction" data-toggle="modal" data-target="#addTransaction"  class="btn btn-lg btn-warning"><i class="fa fa-plus-circle"></i>Edit Transaction</button>
                <button  style="display:none;" type="button" id="cancelTransaction" class="btn btn-lg btn-default"><i class="fa fa-plus-circle"></i> Cancel</button>

              </div>
            </div>


            <div class="row"><h4 class="add_new_rental">Transaction Details</h4></div>


            <div class="row fadeInUp">

              <div class="col-md-6">
                <div class="panel panel-default">
                  <div class="panel-heading"><i class="fa fa-dollar"></i> Transaction Details
                  </div>

                  <div id="divTransactionDetails" class="panel-body pmp-samehieght">

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Ref</label>
                        <input type="text" class="form-control input-sm" readonly="" id="ref" name="ref">
                      </div>
                      <div class="form-group">
                        <label>Transaction</label>
                        <input type="hidden"  id="transactiontype" name="transactiontype"/>                
                        <div id="divTransactionType"class="btn-group">
                          <button id="btnPIn" class="btn btn-info" value="1" style="height: 30px; width:  110px" type="button">Payment In</button>
                          <button id="btnPOut" class="btn btn-danger" value="2" style="height: 30px; width:  110px" type="button">Payment Out</button>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Unit</label>
                        <input type="hidden" id="unitId" name="unitId">
                        <input type="hidden" id="unitRefNo">
                        <input type="text" required="" readonly="" class="form-control required input-sm" id="unitTitle">
                        
                      </div>
                      <div class="form-group">
                        <label>Landlord</label>
                        <input type="text" class="form-control input-sm" disabled="disabled" id="landlord" name="landlord">
                      </div>

                      <div class="form-group">
                        <label>Lease Ref</label>
                        <input type="hidden" id="leaseId" value="0">
                        <input type="text" class="form-control required input-sm" id="leaseTitle">
                      </div>

                      <div class="form-group">
                        <label>Amount</label>
                        <div class="input-group">
                          <input type="text" class="form-control input-sm" id="amount" name="amount">
                          <span class="input-group-addon">AED</span>
                        </div>
                      </div>                     
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Payment type</label>
                        <select required="" class="form-control required input-sm"  id="type" name="type">
                          <option value="">Please select</option>
                          <option value="1">Unit</option>
                          <option value="2">Lease</option>
                          <option value="3">Work Order</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Payment sub-type</label>
                        <select required="" class="form-control required input-sm"  id="subtype" name="subtype">
                          <option value="">Please select</option>
                          <option value="1">Option 1</option>
                          <option value="2">Option 2</option>
                          <option value="3">Option 3</option>
                          <option value="4">Option 4</option>
                          <option value="5">Option 5</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Payment from</label>
                        <select required="" class="form-control required input-sm"  id="from" name="from">
                          <option value="">Please select</option>
                          <option value="1">Property Management Company</option>
                          <option value="2">Landlord</option>
                          <option value="3">Tenant</option>
                          <option value="4">Service Provider</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Payment to</label>
                        <select required="" class="form-control required input-sm"  id="to" name="to">
                          <option value="">Please select</option>
                          <option value="1">Property Management Company</option>
                          <option value="2">Landlord</option>
                          <option value="3">Tenant</option>
                          <option value="4">Service Provider</option>
                        </select>
                      </div>  
                      <div class="form-group">
                        <label>Payment Mode</label>
                        <select required="" class="form-control required input-sm"  id="mode" name="mode">
                          <option value="">Please select</option>
                          <option value="1">Cheque</option>
                          <option value="2">Cash</option>
                          <option value="3">Bank Transfer</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Status</label>
                        <select required="" class="form-control required input-sm"  id="status" name="status">
                          <option value="">Please select</option>
                          <option value="1">Not Paid</option>
                          <option value="2">Paid By Cash</option>
                          <option value="3">Paid By Cheque</option>
                          <option value="4">Partly Paid</option>
                        </select>
                      </div>                                           
                    </div>
                  </div>

                </div>
              </div>

              <div class="col-md-3">
                <div class="panel panel-default">
                  <div class="panel-heading panel-gistab tab-nopadding">
                    <ul class="nav nav-tabs" role="tablist">
                      <li role="presentation" class="active"><a href="#tableasedetails" aria-controls="tableasedetails" role="tab" data-toggle="tab">Lease Details</a></li><li role="presentation"><a href="#tabunitdetails" aria-controls="tabunitdetails" role="tab" data-toggle="tab">Unit Details</a></li>
                    </ul>
                  </div>                    
                  <div class="panel-body tab-nopadding pmp-samehieght">
                    <div class="tab-content tab-nopadding">
                      <div role="tabpanel" class="tab-pane active" id="tableasedetails">

                        <div id="divLeaseHeader" class="tab-nopadding">
                          <span class="text-warning">No Lease</span>
                          <div id="divLeaseDetails" style="display:none">
                            <table class="table table-striped">
                              <tbody>
                                <tr>
                                  <td><strong>Name: </strong></td>
                                  <td><label id="uName"></label></td>
                                </tr>
                                <tr>
                                  <td><strong>Nationality: </strong></td>
                                  <td><label id="uNationality"></label></td>
                                </tr>
                                <tr>
                                  <td><strong>Start Date: </strong></td>
                                  <td><label id="uStartDate"></label></td>
                                </tr>
                                <tr>
                                  <td><strong>End Date: </strong></td>
                                  <td><label id="uEndDate"></label></td>
                                </tr>
                                <tr>
                                  <td><strong>Lease Amount: </strong></td>
                                  <td><label id="uLeaseAmount"></label></td>
                                </tr>
                                <tr>
                                  <td><strong>Fee %: </strong></td>
                                  <td><label id="uFeePercentage"></label></td>
                                </tr>
                                <tr>
                                  <td><strong>Fee Amount: </strong></td>
                                  <td><label id="uFeeAmount"></label></td>
                                </tr>
                                <tr>
                                  <td><strong>Payment Mode: </strong></td>
                                  <td><label id="uPaymentMode"></label></td>
                                </tr>
                                <tr>
                                  <td><strong>Payment Terms: </strong></td>
                                  <td><label id="uPaymentTerms"></label></td>
                                </tr>
                                <tr>
                                  <td><strong>Ejari Status: </strong></td>
                                  <td><label id="uStatus"></label></td>
                                </tr>                                                                                                                                   
                              </tbody>
                            </table>
                          </div>                        
                        </div>

                      </div>
                      <div role="tabpanel" class="tab-pane" id="tabunitdetails">
                        <div id="divUnitHeader" class="tab-nopadding">
                          <span class="text-warning">No Unit</span>
                          <div id="divUnitDetails" style="display:none">
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
                  </div>
                </div>
              </div>

              <div class="col-md-3">
                <div class="panel panel-default ">
                  <div class="panel-heading panel-gistab tab-nopadding">
                    <ul class="nav nav-tabs" role="tablist">
                      <li role="presentation" class="active"><a href="#tabNotes" aria-controls="tabNotes" role="tab" data-toggle="tab">Notes</a></li><li role="presentation"><a href="#tabDocuments" aria-controls="tabDocuments" role="tab" data-toggle="tab">Documents</a></li>
                    </ul>
                  </div>                        
                  <div class="panel-body tab-nopadding pmp-samehieght">
                    <div class="tab-content tab-nopadding">
                      <div role="tabpanel" class="tab-pane active" id="tabNotes">
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
          <ul id="ulAccounts" class="nav nav-tabs">
            <li value="0" class="active"><a href="#" value="0">All Accounts <span id="cntAll" class="text-info">(<?php echo $all;?>)</span></a></li>
            <li value="1"><a href="#" value="1">Payment In <span id="cntIn" class="text-info">(<?php echo $paymentin;?>)</span></a></li>
            <li value="2"><a href="#" value="2">Payment Out <span id="cntOut" class="text-info">(<?php echo $paymentout;?>)</span></a></li>
          </ul>
        </div>
        <div class="tab-content tab-white">
          <div style="Save Report"> <input style="width:300px" 
            class="form-control input-sm search_init" type='text' id='txtSmartSearch_Accounts' 
            placeholder="Search here"/> 
          </div>            
          <table id="tblTransactions" aria-describedby="dataTables-current-listing_info" class="table table-striped table-hover datatables datatable-setbotclass dataTable no-footer">
            <thead class="listing_headings">
              <tr>
                  <th><!-- <label class=""><input id='CheckAllListings' class='CheckAll' onclick="toggleChecked()" type="checkbox" value=''>
                    <span class="lbl"></span></label> -->
                  </th>
                  <th>
                    <div style="cursor:pointer;min-width:50px;" title="Click here to sort">
                      Tr. Ref
                    </div>
                  </th> 
                  <th>
                    <div style="cursor:pointer;" title="Click here to sort">
                      Transaction Type
                    </div>
                  </th>
                  <th>
                    <div style="cursor:pointer;" title="Click here to sort">
                      Payment Type
                    </div>
                  </th>                                                                               
                  <th>
                    <div style="cursor:pointer;" title="Click here to sort">
                      Payment Sub-Type
                    </div>
                  </th>
                  <th>
                    <div style="cursor:pointer;" title="Click here to sort">
                      Payment From
                    </div>
                  </th>
                  <th>
                    <div style="cursor:pointer;" title="Click here to sort">
                      Payment To
                    </div>
                  </th>
                  <th>
                    <div style="cursor:pointer; white-space:nowrap;" title="Click here to sort">
                      Payment Mode
                    </div>
                  </th>
                  <th>
                    <div style="cursor:pointer; white-space:nowrap;" title="Click here to sort">
                      Amount
                    </div>
                  </th>
                  <th>
                    <div style="cursor:pointer;" title="Click here to sort">
                      Unit Ref
                    </div>
                  </th>
                  <th>
                    <div style="cursor:pointer;" title="Click here to sort">
                      Created By
                    </div>
                  </th>
                  <th>
                    <div style="cursor:pointer;" title="Click here to sort">
                      Date Added
                    </div>
                  </th>
                  <th>
                    <div style="cursor:pointer;" title="Click here to sort">
                      Date Updated
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


<!-- Ad Workorder Modal -->
<div class="modal fade" id="addTransaction" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <label id="modaltitle">
          <h4 class="modal-title">Add Transaction Information</h4>
        </label>
      </div>
      <div class="modal-body">
        <div class="tab-content tab-nopadding">
          <div role="tabpanel" class="tab-pane active" id="addnewunit">
            <form id="frm_accounts">
              <input type="hidden" id="id" name="id" value="0" />
              <input type="hidden" id="rand_key" name="rand_key" value="" />
              <input type="hidden" id="ref" name="ref" value="" />
              <input type="hidden" id="dateadded" name="dateadded" value="" />
              <input type="hidden" id="created_by" name="created_by" value="" />

              <div class="col-md-4">
                <div class="form-group">
                  <label>Ref</label>
                  <input type="text" class="form-control input-sm" readonly="" id="ref" name="ref">
                </div>
                <div class="form-group">
                  <label>Transaction</label>
                  <input type="hidden" id="transactiontype" name="transactiontype" />
                  <div id="divTransactionType" class="btn-group">
                    <button id="btnPIn" class="btn btn-info" value="1" style="height: 30px; width: 130px" type="button">Payment In</button>
                    <button id="btnPOut" class="btn btn-danger" value="2" style="height: 30px; width: 130px" type="button">Payment Out</button>
                  </div>
                </div>
                <div class="form-group">
                  <label>Unit</label>
                  <div class="input-group">
                    <span class="input-group-addon">
                      <a data-target="#unitModal" data-toggle="modal" href="">
                        <i class="fa fa-plus-circle"></i>
                      </a>
                    </span>
                    <input type="hidden" id="unitId" name="unitId">
                    <input type="hidden" id="unitRefNo">
                    <input type="text" required="" readonly="" class="form-control required input-sm" id="unitTitle">
                  </div>
                </div>
                <div class="form-group">
                  <label>Landlord</label>
                  <input type="text" class="form-control input-sm" disabled="disabled" id="landlord" name="landlord">
                </div>
                <div class="form-group">
                  <label>Payment type</label>
                  <select required="" class="form-control required input-sm" id="type" name="type">
                    <option value="">Please select</option>
                    <option value="1">Unit</option>
                    <option value="2">Lease</option>
                    <option value="3">Work Order</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Payment sub-type</label>
                  <select required="" class="form-control required input-sm" id="subtype" name="subtype">
                    <option value="">Please select</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                    <option value="4">Option 4</option>
                    <option value="5">Option 5</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Lease</label>
                  <div class="input-group">
                    <span class="input-group-addon"><a data-target="#owner" data-toggle="modal" href=""><i class="fa fa-plus-circle"></i></a></span>
                    <input type="hidden" id="leaseId" name="leaseId" value="0">
                    <input type="text" required="" class="form-control required input-sm" id="leaseTitle">
                  </div>
                </div>
                <div class="form-group">
                  <label>Payment from</label>
                  <select required="" class="form-control required input-sm" id="from" name="from">
                    <option value="">Please select</option>
                    <option value="1">Property Management Company</option>
                    <option value="2">Landlord</option>
                    <option value="3">Tenant</option>
                    <option value="4">Service Provider</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Payment to</label>
                  <select required="" class="form-control required input-sm" id="to" name="to">
                    <option value="">Please select</option>
                    <option value="1">Property Management Company</option>
                    <option value="2">Landlord</option>
                    <option value="3">Tenant</option>
                    <option value="4">Service Provider</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Amount</label>
                  <div class="input-group">
                    <input type="text" class="form-control input-sm" id="amount" name="amount">
                    <span class="input-group-addon">AED</span>
                  </div>
                </div>
                <div class="form-group">
                  <label>Payment Mode</label>
                  <select required="" class="form-control required input-sm" id="mode" name="mode">
                    <option value="">Please select</option>
                    <option value="1">Cheque</option>
                    <option value="2">Cash</option>
                    <option value="3">Bank Transfer</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Status</label>
                  <select required="" class="form-control required input-sm" id="status" name="status">
                    <option value="">Please select</option>
                    <option value="1">Not Paid</option>
                    <option value="2">Paid By Cash</option>
                    <option value="3">Paid By Cheque</option>
                    <option value="4">Partly Paid</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Created by</label>
                  <input type="text" class="form-control input-sm" disabled="disabled" id="createdby" name="createdby">
                </div>
                <div class="form-group">
                  <label>Date Added</label>
                  <div class="input-group">
                    <input type="text" class="form-control input-sm datepicker" id="dateadded" name="dateadded">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Date Updated</label>
                  <div class="input-group">
                    <input type="text" class="form-control input-sm datepicker" id="dateupdated" name="dateupdated">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Memo</label>
                  <input type="text" class="form-control input-sm" id="memo" name="memo">
                </div>
              </div>

              <div class="clear"></div>
              <!-- to fix overflow issue -->
            </form>
          </div>

        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal" id="btnSaveTransaction"><i class="fa fa-check"></i> Save and Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="unitModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Add Unit</h4>
      </div>  

      <div class="modal-body">
        <div id="nav" class="inner_tab_nav">
          <ul class="nav nav-tabs">
            <li role="presentation" class="active">
              <a href="#impfrmlist" id="tabimport" aria-controls="impfrmlist" role="tab" data-toggle="tab">Select a unit</a>
            </li>
          </ul>
        </div>

        <div class="tab-content tab-white">
          <div style="Save Report"> 
            <input style="width:225px" class="form-control input-sm search_init" type='text' id='txtSmartSearch_units' placeholder="Search here"/> 
          </div>
          <table id="tblUnits" aria-describedby="dataTables-current-listing_info" class="table table-striped table-hover datatables datatable-setbotclass dataTable no-footer">
            <thead class="listing_headings">
              <tr>
                <th>
                </th>
                <th>
                  <div style="cursor:pointer;min-width:50px;" title="Click here to sort">
                    Type
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
                    BUA
                  </div>
                </th>
                <th>
                  <div style="cursor:pointer;" title="Click here to sort">
                    Price
                  </div>
                </th>
                <th>
                  <div style="cursor:pointer;" title="Click here to sort">
                    Agent
                  </div>
                </th>
                <th>
                  <div style="cursor:pointer;" title="Click here to sort">
                    Owner
                  </div>
                </th>
                <th>
                  <div style="cursor:pointer; min-width:40px;" title="Click here to sort">
                    Listed
                  </div>
                </th>
                <th>
                  <div style="cursor:pointer; min-width:40px;" title="Click here to sort">
                    Updated
                  </div>
                </th>
                <th>
                  <div style="cursor:pointer; min-width:55px !important;" title="Click here to sort">
                    Created By
                  </div>
                </th>
                <th>
                  <div style="cursor:pointer; min-width:60px !important;" title="Click here to sort">
                    Key Location
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
      <div class="modal-footer">
        <button id="btnSelectUnit" class="btn btn-success" data-dismiss="modal" type="button">
          <i class="fa fa-check"></i>
          Select this unit
        </button>
      </div>
    </div>
  </div>                  
</div>