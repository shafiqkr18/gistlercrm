<style type="text/css">
#tblPayments th {
  text-align: center;
  background-color: #1ccacc;
  color: white;
}

#tblPayments td.payment {
  text-align: right;
  cursor: pointer;
}

#tblPayments td.payment.s2 {
  border-right: 1px solid; 
  border-color: darkturquoise;
}

input.tdEditor {
  text-align: right;
  height: 25px;
  width: 60px;
  display: inline;
  padding: 0px;
  padding-right: 5px;
}

i {
  cursor: pointer;
}

#tblPayments > thead > tr > th,
#tblPayments > tbody > tr > th,
#tblPayments > tfoot > tr > th,
#tblPayments > thead > tr > td,
#tblPayments > tbody > tr > td,
#tblPayments > tfoot > tr > td {
  padding: 8px;
  line-height: 1.42857143;
  vertical-align: top;
  border-top: 0px;
  padding-left: 25px;
}

.table-wrapper { 
  overflow-x:scroll;
  overflow-y:visible;
  width:730px;
  margin-left: 120px;
}
#tblPayments td, th {
  padding: 5px 20px;
  width: 100px;
}
#tblPayments tr {
  height: 50px;
}

#tblPayments th:first-child, #tblPayments td:first-child {
  position: fixed; left: 10px; width: 127px;
}

.payee{
  padding-left: 20px position: fixed; left: 10px; width: 127px; height: 50px
}

#loading-indicator {
  position: absolute;
  left: 50%;
  top: 50%;
  width: 64px;
  height: 64px;
  margin-left: -32px;
  margin-top: -32px;
  border: 0;
}

.celldanger{
  color:red;
}

.cellwarning{
  color:goldenrod;
}

#footer {
  position: fixed;
  bottom: 1px;
  height: 30px;
  width: 100%;
  background-color: #ebebeb;
}

/*for file uploaders*/
.btn-file {
  position: relative;
  overflow: hidden;
}
.btn-file input[type=file] {
  position: absolute;
  top: 0;
  right: 0;
  min-width: 100%;
  min-height: 100%;
  font-size: 100px;
  text-align: right;
  filter: alpha(opacity=0);
  opacity: 0;
  background: red;
  cursor: inherit;
  display: block;
}
.file-input-label {
  padding: 0px 10px;
  display: table-cell;
  vertical-align: middle;
  border: 1px solid #ddd;
  border-radius: 4px;
}
input[readonly] {
  background-color: white !important;
  cursor: text !important;
}
</style>

<!-- Modal for Add/Edit Units -->
<div class="modal fade" id="unitform" tabindex="-1">
  <div class="modal-dialog modal-lg" style="width:90%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;
          </span></button>
          <h4 class="modal-title">Add Unit</h4>
        </div>

        <div class="modal-body">

          <div id="nav" class="inner_tab_nav">
            <ul class="nav nav-tabs">
              <li role="presentation" class="active">
                <a href="#addnewunit" id="tabnew" aria-controls="addnewunit" role="tab" data-toggle="tab">Add New Unit</a></li>
                <li role="presentation">
                  <a href="#impfrmlist" id="tabimport" aria-controls="impfrmlist" role="tab" data-toggle="tab">Import from existing listing</a></li>
                </ul>
              </div>
              <div class="tab-content tab-nopadding">
                <div role="tabpanel" class="tab-pane active" id="addnewunit">
                  <form id="frm_unit" method="post">
                    <input type="hidden" id="id" name="id" value="0" />
                    <input type="hidden" id="rand_key" name="rand_key" value="" />
                    <input type="hidden" id="ref" name="ref" value="" />
                    <input type="hidden" id="dateadded" name="dateadded" value="" />
                    <input type="hidden" id="created_by" name="created_by" value="" />
                    <hr>
                    <div class="col-md-4">

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Unit No.</label>
                            <input type="text" required="" class="form-control required input-sm" name="unit" id="unit">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Type</label>
                            <!-- <input type="text"class="form-control input-sm" name="type" id="type"> -->
                            <select class="form-control input-sm" name="type" id="type">
                              <option value="1">Rent</option>
                              <option value="2">Sale</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Street No.</label>
                            <input type="text" required="" class="form-control required input-sm" name="street_no" id="street_no">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Floor</label>
                            <input type="text" class="form-control input-sm" name="floor_no" id="floor_no">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <label>Property Status</label>
                          <select id="prop_status" class="form-control input-sm" name="prop_status">
                            <option selected="selected" value="">Select</option>
                            <option value="1">Available</option>
                            <option value="2">Pending</option>
                            <option value="3">Rented</option>
                            <option value="4">Upcoming</option>
                            <option value="5">Reserved</option>
                            <option value="6">Renewed</option>
                            <option value="7">Blocked</option>
                          </select>
                        </div>
                        <div class="col-md-6">
                          <label>Category</label>
                          <select required="" class="form-control required input-sm" name="category_id" id="category_id">
                            <option value="">Please select</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">

                      </div>
                      <div class="form-group">
                        <label>Emirate</label>
                        <select required="" class="form-control required input-sm" name="region_id" id="region_id">
                          <option selected="" value="">Select</option>
                          <option value="2">Abu Dhabi</option>
                          <option value="4">Ajman</option>
                          <option value="8">Al Ain</option>
                          <option value="1">Dubai</option>
                          <option value="7">Fujairah </option>
                          <option value="6"> Ras Al Khaimah </option>
                          <option value="3">Sharjah </option>
                          <option value="5"> Umm Al Quwain </option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Location</label>
                        <select required="" class="form-control required input-sm" name="area_location_id" id="area_location_id">
                          <option value="">Please select</option>

                        </select>
                      </div>
                      <div class="form-group">
                        <label>Sub Location</label>
                        <select required="" class="form-control required input-sm" name="sub_area_location_id" id="sub_area_location_id">
                          <option value="">Please select</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Beds</label>
                            <select class="form-control input-sm " name="beds" id="beds">
                              <option value="">Please select</option>
                              <option value="0">Studio</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                              <option value="6">6</option>
                              <option value="7">7</option>
                              <option value="8">8</option>
                              <option value="9">9</option>
                              <option value="10">10</option>
                              <option value="11">11</option>
                              <option value="12">12</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Baths</label>
                            <select class="form-control input-sm" name="baths" id="baths">
                              <option value="">Please select</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                              <option value="6">6</option>
                              <option value="7">7</option>
                              <option value="8">8</option>
                              <option value="9">9</option>
                              <option value="10">10</option>
                              <option value="11">11</option>
                              <option value="12">12</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>BUA</label>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" name="size" id="size">
                              <span class="input-group-addon">sq.ft</span>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Plot</label>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" name="plot_size" id="plot_size">
                              <span class="input-group-addon">sq.ft</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Guide Price</label>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" name="guide_price" id="guide_price">
                              <span class="input-group-addon">AED</span>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Fee</label>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" name="fee" id="fee">
                              <span class="input-group-addon">%</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Furnished</label>
                            <select class="form-control input-sm " name="prop_furnish" id="prop_furnish">
                              <option value="">Please select</option>
                              <option value="1">Unfurnished</option>
                              <option value="2">Semi Furnished</option>
                              <option value="3">Fully Furnished</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>View</label>
                            <input type="text" class="form-control input-sm" name="view_id" id="view_id">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Landlord</label>
                        <div class="input-group">
                        </a>
                        <span class="input-group-addon"><a id="aLandlord" data-target="#landlordSelector" data-toggle="modal" href="#"><i class="fa fa-plus-circle"></i></a></span>
                        <input type="hidden" name="landlordId" id="landlordId">
                        <input type="text" class="form-control input-sm" id="landlordname">
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Property Mgr.</label>
                      <select required="" class="form-control required input-sm" name="agent_id" id="agent_id">
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">

                    <div class="form-group">
                      <label>Unit Title</label>
                      <input type="text" class="form-control input-sm" name="name" id="name">
                    </div>
                    <div class="form-group">
                      <label>Description</label>
                      <textarea class="form-control" name="description_demo" id="description_demo"></textarea>
                    </div>

                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-9">
                          <label>Photos</label>
                        </div>
                        <div class="form-group">
                          <div style="display:none;" id="download_animation">
                            <img src="<?php echo base_url();?>mydata/images/ajax-loader.gif" width="24" height="24" />
                          </div>
                        </div>
                        <div style="display:float; padding-top:15px;padding-left: 20px">
                          <div class="form-group">
                            <input type="file" class="pull-left" id="listings_documents" name="listings_documents">

                            <button class="btn btn-primary" id="buttonUpload" onClick="return ajaxFileUpload();"><i class="fa fa-upload"></i>Upload</button>
                          </div>
                        </div>
                      </div>

                      <div class="document_area" style="border: 1px solid #D3D3D3; height: 50px; overflow-y: scroll;" id="showDocuments">
                      </div>
                      <!-- <textarea class="form-control" name="portals_count" id="portals_count"></textarea> -->
                    </div>
                  </div>

                  <div class="clear"></div>
                  <!-- to fix overflow issue -->
                </form>
              </div>

              <div role="tabpanel" class="tab-pane" id="impfrmlist">
                <hr>

                <div class="row">

                    <table aria-describedby="dataTables-current-listing_info" class="table table-striped table-hover datatables datatable-setbotclass dataTable no-footer" id="listings_row">
                      <thead class="listing_headings">
                        <tr>
                          <th>
                      <!-- <label class=""><input id='CheckAllListings' class='CheckAll' onclick="toggleChecked()" type="checkbox" value=''>
                      <span class="lbl"></span></label> -->
                    </th>
                    <!--         <th><div style="cursor:pointer;min-width: 8px;" title="Click here to sort"></div></th>
                                    <th><div style="cursor:pointer; display:none;" title="Click here to sort">Status</div></th>
                                    <th><div style="cursor:pointer; display:none;" title="Click here to sort">Managed</div><span>M</span></th>
                                    <th><div style="cursor:pointer; display:none;" title="Click here to sort">Exclusive</div><span>E</span></th>
                                    <th><div style="cursor:pointer; display:none;" title="Click here to sort">Shared</div><span>S</span></th> -->
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
                    <!-- <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Type</div></th>
                                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Baths</div></th>
                                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Street</div></th>
                                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Floor</div></th>
                                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">DEWA</div></th>
                                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Photos</div></th>
                                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Cheques</div></th>
                                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Fitted</div></th>
                                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Property Status</div></th>
                                    <th type="not_default" style="min-width:90px !important;"><div style="cursor:pointer;" title="Click here to sort">Listing Source</div></th>
                                    <th type="not_default" style="min-width:90px !important;"><div style="cursor:pointer;" title="Click here to sort">Date Available</div></th>
                                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Remind</div></th>
                                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Furnished</div></th>
                                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Featured</div></th>
                                    <th type="not_default" style="min-width:100px !important;"><div style="cursor:pointer;" title="Click here to sort">Maintanance Fee</div></th>
                                    <th type="not_default" style="min-width:70px !important;"><div style="cursor:pointer;" title="Click here to sort">STR</div></th>
                                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Amount</div></th>
                                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Tenanted</div></th>
                                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Plot Size</div></th>
                                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Name</div></th>
                                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">View</div></th>
                                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Commission</div></th>
                                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Deposit</div></th>
                                    <th type="not_default"><div style="cursor:pointer; width:50px;" title="Click here to sort">Price / sq ft</div></th> -->
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
                                    <!-- <th><div style="cursor:pointer; min-width:60px !important;" title="Click here to sort">Developer Unit</div></th> -->
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

                      <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="btnSave" data-dismiss="modal"><i class="fa fa-check"></i> Save and Close</button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Modal for Add/Edit Leases -->
                <div class="modal fade" id="leaseform" tabindex="-1">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                          <label id="modaltitle">
                            <h4 class="modal-title">Add Lease</h4>
                          </label>
                        </div>
                        <div class="modal-body">
                          <form id="frm_lease" method="post">
                            <input type="hidden" id="id" name="id" value="0" />
                            <input type="hidden" id="rand_key" name="rand_key" value="" />
                            <input type="hidden" id="ref" name="ref" value="" />
                            <input type="hidden" id="dateadded" name="dateadded" value="" />
                            <input type="hidden" id="created_by" name="created_by" value="" />
                            <div id="divTenantInfo" class="well">
                              <h4>Tenant Information</h4>
                              <strong>Name:</strong>
                              <h4><label id="tName"></label></h4>
                              <div class="row">
                                <div class="col-md-4">
                                  <strong>Contact Details: </strong>
                                  <br>
                                  <i class="fa fa-phone"></i>
                                  <label id="tMobile"></label>
                                  <br>
                                  <i class="fa fa-envelope"></i>
                                  <label id="tEmail"></label>
                                  <br>
                                </div>
                                <div class="col-md-4">
                                  <strong>Other Details: </strong>
                                  <br> Nationality:
                                  <label id="tNationality"></label>
                                  <br> DOB:
                                  <label id="tDOB"></label>
                                  <br>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label>Unit</label>
                                <div>
                                  <!-- class="input-group" -->
                                  <!-- <span class="input-group-addon"><a id="aUnits" class="selectorlinks" data-target="#unitSelector" data-toggle="modal" href="#"><i class="fa fa-plus-circle"></i></a></span> -->
                                  <input type="hidden" id="unitId" name="unitId">
                                  <input type="hidden" id="unitRefNo">
                                  <input type="text" required="" readonly="" class="form-control required input-sm" id="unitTitle">
                                </div>
                              </div>
                              <div class="form-group">
                                <label>Tenant</label>
                                <div class="input-group">
                                  <span class="input-group-addon"><a data-target="#tenantform" data-toggle="modal" href=""><i class="fa fa-plus-circle"></i></a></span>
                                  <input type="hidden" id="tenantId" name="tenantId">
                                  <input type="text" required="" readonly="" class="form-control required input-sm" id="tenantName">
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Start Date</label>
                                    <div class="input-group">
                                      <input type="text" class="form-control input-sm datepicker" id="startdate" name="startdate">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar-plus-o"></i>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>End Date</label>
                                    <div class="input-group">
                                      <input type="text" class="form-control input-sm datepicker" id="enddate" name="enddate">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-5">
                                  <div class="form-group">
                                    <label>Deposit</label>
                                    <div class="input-group">
                                      <input type="text" class="form-control input-sm" id="deposit_percentage" name="deposit_percentage">
                                      <span class="input-group-addon">%</span>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-7">
                                  <div class="form-group">
                                    <label>&nbsp;</label>
                                    <div class="input-group">
                                      <input type="text" class="form-control input-sm" id="deposit_amount" name="deposit_amount">
                                      <span class="input-group-addon">AED</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label>Cheques</label>
                                <input type="number" required="" class="form-control required input-sm" max="12" min="1" id="cheques" name="cheques">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label>Lease Amount</label>
                                <div class="input-group">
                                  <input type="text" class="form-control input-sm" id="leaseamount" name="leaseamount">
                                  <span class="input-group-addon">AED</span>
                                </div>
                              </div>
                              <div class="form-group">
                                <label>Payment Mode</label>
                                <select class="form-control required input-sm" required="paymentmode" id="paymentmode" name="paymentmode">
                                  <option value="1">Cash</option>
                                  <option value="2">Bank Transfer</option>
                                  <option value="3">Cheque</option>
                                  <option value="4">Others</option>                                  
                                </select>
                              </div>
                              <div class="form-group">
                                <label>Deposit Held by</label>
                                <select class="form-control required input-sm" required="" id="depositheldby" name="depositheldby">
                                  <option value="1">Landlord</option>
                                  <option value="2">Property Management</option>                                
                                </select>
                              </div>
                              <div class="form-group">
                                <label>Ejari number</label>
                                <input type="text" class="form-control input-sm" id="ejarinumber" name="ejarinumber">
                              </div>
                              <div class="form-group">
                                <label>Ejari status</label>
                                <select required="" class="form-control required input-sm" id="ejaristatus" name="ejaristatus">
                                  <option value="1">Active</option>
                                  <option value="2">Inactive</option>                                  
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="row">
                                <div class="col-md-5">
                                  <div class="form-group">
                                    <label>Fee</label>
                                    <div class="input-group">
                                      <input type="text" class="form-control input-sm" id="fees_percentage" name="fees_percentage">
                                      <span class="input-group-addon">%</span>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-7">
                                  <div class="form-group">
                                    <label>&nbsp;</label>
                                    <div class="input-group">
                                      <input type="text" class="form-control input-sm" id="fees_amount" name="fees_amount">
                                      <span class="input-group-addon">AED</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label>Payment Term</label>
                                <select class="form-control required input-sm" required="" id="paymentterm" name="paymentterm">
                                  <option value="1">Semi-Annually</option>  
                                  <option value="2">Annually</option>                                  
                                </select>
                              </div>
                              <div class="form-group">
                                <label>Source of Tenancy</label>
                                <select class="form-control required input-sm" required="" id="sourceoftenancy" name="sourceoftenancy">
                                  <option value="1">Landlord</option>
                                  <option value="2">Tenant</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <label>Commission</label>
                                <input type="text" class="form-control input-sm" id="commission" name="commission">
                              </div>
                              <div class="form-group">
                                <label>Reminder</label>
                                <select class="form-control required input-sm" id="reminder" name="reminder">
                                  <option value="1">Same Day</option>
                                  <option value="2">Day Before</option>
                                  <option value="3">Three Days</option>
                                  <option value="4">One Week</option>
                                  <option value="5">Fifteen Days</option>
                                  <option value="6">One Month</option>
                                  <option value="7">Two Month</option>
                                  <option value="8">Three Month</option>                                  
                                </select>
                              </div>
                            </div>
                            <div class="clear"></div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-success" id="btnSaveLease" data-dismiss="modal"><i class="fa fa-check"></i> Save and Close</button>
                        </div>
                      </div>
                    </div>
                  </div>


                  <!-- Modal for Add/Edit Tenant -->
                  <div class="modal fade" id="tenantform" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <h4 class="modal-title">Select Tenant</h4>
                        </div>

                        <div class="modal-body">
                          <div id="nav" class="inner_tab_nav">
                            <ul class="nav nav-tabs">
                              <li role="presentation" class="active">
                                <a href="#addtenant" id="tabnew" aria-controls="addtenant" role="tab" data-toggle="tab">Add New Tenant</a></li>
                                <li role="presentation">
                                  <a href="#selecttenant" id="tabimport" aria-controls="selecttenant" role="tab" data-toggle="tab">Select from existing tenants</a></li>
                                </ul>
                              </div>
                              <hr/>
                              <div class="tab-content tab-nopadding">
                                <div role="tabpanel" class="tab-pane active" id="addtenant">
                                  <form id="frm_tenant">
                                    <input type="hidden" id="id" name="id" value="0" />
                                    <input type="hidden" id="ref" name="ref" value="" />
                                    <input type="hidden" id="dateadded" name="dateadded" value="" />
                                    <input type="hidden" id="created_by" name="created_by" value="" />
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Ref</label>
                                          <input type="text" class="form-control input-sm" readonly="" id="ref" name="ref">
                                        </div>
                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label>Salutation</label>
                                              <select class="form-control required input-sm" id="salutation" name="salutation">
                                                <option value="">Select</option>
                                                <option value="1">Mr.</option>
                                                <option value="2">Ms.</option>
                                                <option value="3">Mrs.</option>
                                              </select>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label>Title</label>
                                              <select class="form-control required input-sm" id="title" name="title">
                                                <option value="">Select</option>
                                                <option value="1">Sheikh</option>
                                                <option value="2">Engr.</option>
                                                <option value="3">Dr.</option>
                                              </select>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <label>First Name</label>
                                          <input type="text" class="form-control input-sm" id="firstname" name="firstname">
                                        </div>
                                        <div class="form-group">
                                          <label>Last Name</label>
                                          <input type="text" class="form-control input-sm" id="lastname" name="lastname">
                                        </div>
                                        <div class="form-group">
                                          <label>Nationality</label>
                                          <select required="" class="form-control required input-sm" id="nationality" name="nationality">
                                            <option value="">Please select</option>
                                            <option value="" selected="selected">Select Nationality</option>
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Albania">Albania</option>
                                            <option value="Algeria">Algeria</option>
                                            <option value="American Samoa">American Samoa</option>
                                            <option value="Andorra">Andorra</option>
                                            <option value="Angola">Angola</option>
                                            <option value="Anguilla">Anguilla</option>
                                            <option value="Antarctica">Antarctica</option>
                                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                            <option value="Argentina">Argentina</option>
                                            <option value="Armenia">Armenia</option>
                                            <option value="Aruba">Aruba</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Austria">Austria</option>
                                            <option value="Azerbaijan">Azerbaijan</option>
                                            <option value="Bahamas">Bahamas</option>
                                            <option value="Bahrain">Bahrain</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Barbados">Barbados</option>
                                            <option value="Belarus">Belarus</option>
                                            <option value="Belgium">Belgium</option>
                                            <option value="Belize">Belize</option>
                                            <option value="Benin">Benin</option>
                                            <option value="Bermuda">Bermuda</option>
                                            <option value="Bhutan">Bhutan</option>
                                            <option value="Bolivia">Bolivia</option>
                                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                            <option value="Botswana">Botswana</option>
                                            <option value="Bouvet Island">Bouvet Island</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                            <option value="Brunei Darussalam">Brunei Darussalam</option>
                                            <option value="Bulgaria">Bulgaria</option>
                                            <option value="Burkina Faso">Burkina Faso</option>
                                            <option value="Burundi">Burundi</option>
                                            <option value="Cambodia">Cambodia</option>
                                            <option value="Cameroon">Cameroon</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Cape Verde">Cape Verde</option>
                                            <option value="Cayman Islands">Cayman Islands</option>
                                            <option value="Central African Republic">Central African Republic</option>
                                            <option value="Chad">Chad</option>
                                            <option value="Chile">Chile</option>
                                            <option value="China">China</option>
                                            <option value="Christmas Island">Christmas Island</option>
                                            <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                            <option value="Colombia">Colombia</option>
                                            <option value="Comoros">Comoros</option>
                                            <option value="Congo">Congo</option>
                                            <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                            <option value="Cook Islands">Cook Islands</option>
                                            <option value="Costa Rica">Costa Rica</option>
                                            <option value="Cote D'ivoire">Cote D'ivoire</option>
                                            <option value="Croatia">Croatia</option>
                                            <option value="Cuba">Cuba</option>
                                            <option value="Cyprus">Cyprus</option>
                                            <option value="Czech Republic">Czech Republic</option>
                                            <option value="Denmark">Denmark</option>
                                            <option value="Djibouti">Djibouti</option>
                                            <option value="Dominica">Dominica</option>
                                            <option value="Dominican Republic">Dominican Republic</option>
                                            <option value="Ecuador">Ecuador</option>
                                            <option value="Egypt">Egypt</option>
                                            <option value="El Salvador">El Salvador</option>
                                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                                            <option value="Eritrea">Eritrea</option>
                                            <option value="Estonia">Estonia</option>
                                            <option value="Ethiopia">Ethiopia</option>
                                            <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                            <option value="Faroe Islands">Faroe Islands</option>
                                            <option value="Fiji">Fiji</option>
                                            <option value="Finland">Finland</option>
                                            <option value="France">France</option>
                                            <option value="French Guiana">French Guiana</option>
                                            <option value="French Polynesia">French Polynesia</option>
                                            <option value="French Southern Territories">French Southern Territories</option>
                                            <option value="Gabon">Gabon</option>
                                            <option value="Gambia">Gambia</option>
                                            <option value="Georgia">Georgia</option>
                                            <option value="Germany">Germany</option>
                                            <option value="Ghana">Ghana</option>
                                            <option value="Gibraltar">Gibraltar</option>
                                            <option value="Greece">Greece</option>
                                            <option value="Greenland">Greenland</option>
                                            <option value="Grenada">Grenada</option>
                                            <option value="Guadeloupe">Guadeloupe</option>
                                            <option value="Guam">Guam</option>
                                            <option value="Guatemala">Guatemala</option>
                                            <option value="Guinea">Guinea</option>
                                            <option value="Guinea-bissau">Guinea-bissau</option>
                                            <option value="Guyana">Guyana</option>
                                            <option value="Haiti">Haiti</option>
                                            <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                            <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                            <option value="Honduras">Honduras</option>
                                            <option value="Hong Kong">Hong Kong</option>
                                            <option value="Hungary">Hungary</option>
                                            <option value="Iceland">Iceland</option>
                                            <option value="India">India</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                            <option value="Iraq">Iraq</option>
                                            <option value="Ireland">Ireland</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Jamaica">Jamaica</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Jordan">Jordan</option>
                                            <option value="Kazakhstan">Kazakhstan</option>
                                            <option value="Kenya">Kenya</option>
                                            <option value="Kiribati">Kiribati</option>
                                            <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                            <option value="Korea, Republic of">Korea, Republic of</option>
                                            <option value="Kuwait">Kuwait</option>
                                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                                            <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                            <option value="Latvia">Latvia</option>
                                            <option value="Lebanon">Lebanon</option>
                                            <option value="Lesotho">Lesotho</option>
                                            <option value="Liberia">Liberia</option>
                                            <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                            <option value="Liechtenstein">Liechtenstein</option>
                                            <option value="Lithuania">Lithuania</option>
                                            <option value="Luxembourg">Luxembourg</option>
                                            <option value="Macao">Macao</option>
                                            <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                            <option value="Madagascar">Madagascar</option>
                                            <option value="Malawi">Malawi</option>
                                            <option value="Malaysia">Malaysia</option>
                                            <option value="Maldives">Maldives</option>
                                            <option value="Mali">Mali</option>
                                            <option value="Malta">Malta</option>
                                            <option value="Marshall Islands">Marshall Islands</option>
                                            <option value="Martinique">Martinique</option>
                                            <option value="Mauritania">Mauritania</option>
                                            <option value="Mauritius">Mauritius</option>
                                            <option value="Mayotte">Mayotte</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                            <option value="Moldova, Republic of">Moldova, Republic of</option>
                                            <option value="Monaco">Monaco</option>
                                            <option value="Mongolia">Mongolia</option>
                                            <option value="Montserrat">Montserrat</option>
                                            <option value="Morocco">Morocco</option>
                                            <option value="Mozambique">Mozambique</option>
                                            <option value="Myanmar">Myanmar</option>
                                            <option value="Namibia">Namibia</option>
                                            <option value="Nauru">Nauru</option>
                                            <option value="Nepal">Nepal</option>
                                            <option value="Netherlands">Netherlands</option>
                                            <option value="Netherlands Antilles">Netherlands Antilles</option>
                                            <option value="New Caledonia">New Caledonia</option>
                                            <option value="New Zealand">New Zealand</option>
                                            <option value="Nicaragua">Nicaragua</option>
                                            <option value="Niger">Niger</option>
                                            <option value="Nigeria">Nigeria</option>
                                            <option value="Niue">Niue</option>
                                            <option value="Norfolk Island">Norfolk Island</option>
                                            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                            <option value="Norway">Norway</option>
                                            <option value="Oman">Oman</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="Palau">Palau</option>
                                            <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                            <option value="Panama">Panama</option>
                                            <option value="Papua New Guinea">Papua New Guinea</option>
                                            <option value="Paraguay">Paraguay</option>
                                            <option value="Peru">Peru</option>
                                            <option value="Philippines">Philippines</option>
                                            <option value="Pitcairn">Pitcairn</option>
                                            <option value="Poland">Poland</option>
                                            <option value="Portugal">Portugal</option>
                                            <option value="Puerto Rico">Puerto Rico</option>
                                            <option value="Qatar">Qatar</option>
                                            <option value="Reunion">Reunion</option>
                                            <option value="Romania">Romania</option>
                                            <option value="Russian Federation">Russian Federation</option>
                                            <option value="Rwanda">Rwanda</option>
                                            <option value="Saint Helena">Saint Helena</option>
                                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                            <option value="Saint Lucia">Saint Lucia</option>
                                            <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                            <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                            <option value="Samoa">Samoa</option>
                                            <option value="San Marino">San Marino</option>
                                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                            <option value="Senegal">Senegal</option>
                                            <option value="Serbia and Montenegro">Serbia and Montenegro</option>
                                            <option value="Seychelles">Seychelles</option>
                                            <option value="Sierra Leone">Sierra Leone</option>
                                            <option value="Singapore">Singapore</option>
                                            <option value="Slovakia">Slovakia</option>
                                            <option value="Slovenia">Slovenia</option>
                                            <option value="Solomon Islands">Solomon Islands</option>
                                            <option value="Somalia">Somalia</option>
                                            <option value="South Africa">South Africa</option>
                                            <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                            <option value="Spain">Spain</option>
                                            <option value="Sri Lanka">Sri Lanka</option>
                                            <option value="Sudan">Sudan</option>
                                            <option value="Suriname">Suriname</option>
                                            <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                            <option value="Swaziland">Swaziland</option>
                                            <option value="Sweden">Sweden</option>
                                            <option value="Switzerland">Switzerland</option>
                                            <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                            <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                            <option value="Tajikistan">Tajikistan</option>
                                            <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="Timor-leste">Timor-leste</option>
                                            <option value="Togo">Togo</option>
                                            <option value="Tokelau">Tokelau</option>
                                            <option value="Tonga">Tonga</option>
                                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                            <option value="Tunisia">Tunisia</option>
                                            <option value="Turkey">Turkey</option>
                                            <option value="Turkmenistan">Turkmenistan</option>
                                            <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                            <option value="Tuvalu">Tuvalu</option>
                                            <option value="Uganda">Uganda</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="United Arab Emirates">United Arab Emirates</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="United States">United States</option>
                                            <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                            <option value="Uruguay">Uruguay</option>
                                            <option value="Uzbekistan">Uzbekistan</option>
                                            <option value="Vanuatu">Vanuatu</option>
                                            <option value="Venezuela">Venezuela</option>
                                            <option value="Viet Nam">Viet Nam</option>
                                            <option value="Virgin Islands, British">Virgin Islands, British</option>
                                            <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                            <option value="Wallis and Futuna">Wallis and Futuna</option>
                                            <option value="Western Sahara">Western Sahara</option>
                                            <option value="Yemen">Yemen</option>
                                            <option value="Zambia">Zambia</option>
                                            <option value="Zimbabwe">Zimbabwe</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>DOB</label>
                                          <div class="input-group">
                                            <input type="text" class="form-control input-sm datepicker" id="dob" name="dob">
                                            <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <div class="row">
                                            <div class="col-md-6">
                                              <label>Mobile Number (Primary)</label>
                                            </div>
                                          </div>
                                          <div class="row">
                                            <div class="col-md-3">
                                              <select class="form-control required input-sm" id="countrycode1" name="countrycode1">
                                                <option>Select</option>
                                                <option value="1">USA (+1)</option>
                                                <option value="213">Algeria (+213)</option>
                                                <option value="376">Andorra (+376)</option>
                                                <option value="244">Angola (+244)</option>
                                                <option value="1264">Anguilla (+1264)</option>
                                                <option value="1268">Antigua &amp; Barbuda (+1268)</option>
                                                <option value="599">Antilles (Dutch) (+599)</option>
                                                <option value="54">Argentina (+54)</option>
                                                <option value="374">Armenia (+374)</option>
                                                <option value="297">Aruba (+297)</option>
                                                <option value="247">Ascension Island (+247)</option>
                                                <option value="61">Australia (+61)</option>
                                                <option value="43">Austria (+43)</option>
                                                <option value="994">Azerbaijan (+994)</option>
                                                <option value="1242">Bahamas (+1242)</option>
                                                <option value="973">Bahrain (+973)</option>
                                                <option value="880">Bangladesh (+880)</option>
                                                <option value="1246">Barbados (+1246)</option>
                                                <option value="375">Belarus (+375)</option>
                                                <option value="32">Belgium (+32)</option>
                                                <option value="501">Belize (+501)</option>
                                                <option value="229">Benin (+229)</option>
                                                <option value="1441">Bermuda (+1441)</option>
                                                <option value="975">Bhutan (+975)</option>
                                                <option value="591">Bolivia (+591)</option>
                                                <option value="387">Bosnia Herzegovina (+387)</option>
                                                <option value="267">Botswana (+267)</option>
                                                <option value="55">Brazil (+55)</option>
                                                <option value="673">Brunei (+673)</option>
                                                <option value="359">Bulgaria (+359)</option>
                                                <option value="226">Burkina Faso (+226)</option>
                                                <option value="257">Burundi (+257)</option>
                                                <option value="855">Cambodia (+855)</option>
                                                <option value="237">Cameroon (+237)</option>
                                                <option value="1">Canada (+1)</option>
                                                <option value="238">Cape Verde Islands (+238)</option>
                                                <option value="1345">Cayman Islands (+1345)</option>
                                                <option value="236">Central African Republic (+236)</option>
                                                <option value="56">Chile (+56)</option>
                                                <option value="86">China (+86)</option>
                                                <option value="57">Colombia (+57)</option>
                                                <option value="269">Comoros (+269)</option>
                                                <option value="242">Congo (+242)</option>
                                                <option value="682">Cook Islands (+682)</option>
                                                <option value="506">Costa Rica (+506)</option>
                                                <option value="385">Croatia (+385)</option>
                                                <option value="53">Cuba (+53)</option>
                                                <option value="90392">Cyprus North (+90392)</option>
                                                <option value="357">Cyprus South (+357)</option>
                                                <option value="42">Czech Republic (+42)</option>
                                                <option value="45">Denmark (+45)</option>
                                                <option value="2463">Diego Garcia (+2463)</option>
                                                <option value="253">Djibouti (+253)</option>
                                                <option value="1809">Dominica (+1809)</option>
                                                <option value="1809">Dominican Republic (+1809)</option>
                                                <option value="593">Ecuador (+593)</option>
                                                <option value="20">Egypt (+20)</option>
                                                <option value="353">Eire (+353)</option>
                                                <option value="503">El Salvador (+503)</option>
                                                <option value="240">Equatorial Guinea (+240)</option>
                                                <option value="291">Eritrea (+291)</option>
                                                <option value="372">Estonia (+372)</option>
                                                <option value="251">Ethiopia (+251)</option>
                                                <option value="500">Falkland Islands (+500)</option>
                                                <option value="298">Faroe Islands (+298)</option>
                                                <option value="679">Fiji (+679)</option>
                                                <option value="358">Finland (+358)</option>
                                                <option value="33">France (+33)</option>
                                                <option value="594">French Guiana (+594)</option>
                                                <option value="689">French Polynesia (+689)</option>
                                                <option value="241">Gabon (+241)</option>
                                                <option value="220">Gambia (+220)</option>
                                                <option value="7880">Georgia (+7880)</option>
                                                <option value="49">Germany (+49)</option>
                                                <option value="233">Ghana (+233)</option>
                                                <option value="350">Gibraltar (+350)</option>
                                                <option value="30">Greece (+30)</option>
                                                <option value="299">Greenland (+299)</option>
                                                <option value="1473">Grenada (+1473)</option>
                                                <option value="590">Guadeloupe (+590)</option>
                                                <option value="671">Guam (+671)</option>
                                                <option value="502">Guatemala (+502)</option>
                                                <option value="224">Guinea (+224)</option>
                                                <option value="245">Guinea - Bissau (+245)</option>
                                                <option value="592">Guyana (+592)</option>
                                                <option value="509">Haiti (+509)</option>
                                                <option value="504">Honduras (+504)</option>
                                                <option value="852">Hong Kong (+852)</option>
                                                <option value="36">Hungary (+36)</option>
                                                <option value="354">Iceland (+354)</option>
                                                <option value="91">India (+91)</option>
                                                <option value="62">Indonesia (+62)</option>
                                                <option value="98">Iran (+98)</option>
                                                <option value="964">Iraq (+964)</option>
                                                <option value="972">Israel (+972)</option>
                                                <option value="39">Italy (+39)</option>
                                                <option value="225">Ivory Coast (+225)</option>
                                                <option value="1876">Jamaica (+1876)</option>
                                                <option value="81">Japan (+81)</option>
                                                <option value="962">Jordan (+962)</option>
                                                <option value="7">Kazakhstan (+7)</option>
                                                <option value="254">Kenya (+254)</option>
                                                <option value="686">Kiribati (+686)</option>
                                                <option value="850">Korea North (+850)</option>
                                                <option value="82">Korea South (+82)</option>
                                                <option value="965">Kuwait (+965)</option>
                                                <option value="996">Kyrgyzstan (+996)</option>
                                                <option value="856">Laos (+856)</option>
                                                <option value="371">Latvia (+371)</option>
                                                <option value="961">Lebanon (+961)</option>
                                                <option value="266">Lesotho (+266)</option>
                                                <option value="231">Liberia (+231)</option>
                                                <option value="218">Libya (+218)</option>
                                                <option value="417">Liechtenstein (+417)</option>
                                                <option value="370">Lithuania (+370)</option>
                                                <option value="352">Luxembourg (+352)</option>
                                                <option value="853">Macao (+853)</option>
                                                <option value="389">Macedonia (+389)</option>
                                                <option value="261">Madagascar (+261)</option>
                                                <option value="265">Malawi (+265)</option>
                                                <option value="60">Malaysia (+60)</option>
                                                <option value="960">Maldives (+960)</option>
                                                <option value="223">Mali (+223)</option>
                                                <option value="356">Malta (+356)</option>
                                                <option value="692">Marshall Islands (+692)</option>
                                                <option value="596">Martinique (+596)</option>
                                                <option value="222">Mauritania (+222)</option>
                                                <option value="269">Mayotte (+269)</option>
                                                <option value="52">Mexico (+52)</option>
                                                <option value="691">Micronesia (+691)</option>
                                                <option value="373">Moldova (+373)</option>
                                                <option value="377">Monaco (+377)</option>
                                                <option value="976">Mongolia (+976)</option>
                                                <option value="1664">Montserrat (+1664)</option>
                                                <option value="212">Morocco (+212)</option>
                                                <option value="258">Mozambique (+258)</option>
                                                <option value="95">Myanmar (+95)</option>
                                                <option value="264">Namibia (+264)</option>
                                                <option value="674">Nauru (+674)</option>
                                                <option value="977">Nepal (+977)</option>
                                                <option value="31">Netherlands (+31)</option>
                                                <option value="687">New Caledonia (+687)</option>
                                                <option value="64">New Zealand (+64)</option>
                                                <option value="505">Nicaragua (+505)</option>
                                                <option value="227">Niger (+227)</option>
                                                <option value="234">Nigeria (+234)</option>
                                                <option value="683">Niue (+683)</option>
                                                <option value="672">Norfolk Islands (+672)</option>
                                                <option value="670">Northern Marianas (+670)</option>
                                                <option value="47">Norway (+47)</option>
                                                <option value="968">Oman (+968)</option>
                                                <option value="92">Pakistan (+92)</option>
                                                <option value="680">Palau (+680)</option>
                                                <option value="507">Panama (+507)</option>
                                                <option value="675">Papua New Guinea (+675)</option>
                                                <option value="595">Paraguay (+595)</option>
                                                <option value="51">Peru (+51)</option>
                                                <option value="63">Philippines (+63)</option>
                                                <option value="48">Poland (+48)</option>
                                                <option value="351">Portugal (+351)</option>
                                                <option value="1787">Puerto Rico (+1787)</option>
                                                <option value="974">Qatar (+974)</option>
                                                <option value="262">Reunion (+262)</option>
                                                <option value="40">Romania (+40)</option>
                                                <option value="7">Russia (+7)</option>
                                                <option value="250">Rwanda (+250)</option>
                                                <option value="378">San Marino (+378)</option>
                                                <option value="239">Sao Tome &amp; Principe (+239)</option>
                                                <option value="966">Saudi Arabia (+966)</option>
                                                <option value="221">Senegal (+221)</option>
                                                <option value="381">Serbia (+381)</option>
                                                <option value="248">Seychelles (+248)</option>
                                                <option value="232">Sierra Leone (+232)</option>
                                                <option value="65">Singapore (+65)</option>
                                                <option value="421">Slovak Republic (+421)</option>
                                                <option value="386">Slovenia (+386)</option>
                                                <option value="677">Solomon Islands (+677)</option>
                                                <option value="252">Somalia (+252)</option>
                                                <option value="27">South Africa (+27)</option>
                                                <option value="34">Spain (+34)</option>
                                                <option value="94">Sri Lanka (+94)</option>
                                                <option value="290">St. Helena (+290)</option>
                                                <option value="1869">St. Kitts (+1869)</option>
                                                <option value="1758">St. Lucia (+1758)</option>
                                                <option value="249">Sudan (+249)</option>
                                                <option value="597">Suriname (+597)</option>
                                                <option value="268">Swaziland (+268)</option>
                                                <option value="46">Sweden (+46)</option>
                                                <option value="41">Switzerland (+41)</option>
                                                <option value="963">Syria (+963)</option>
                                                <option value="886">Taiwan (+886)</option>
                                                <option value="7">Tajikstan (+7)</option>
                                                <option value="66">Thailand (+66)</option>
                                                <option value="228">Togo (+228)</option>
                                                <option value="676">Tonga (+676)</option>
                                                <option value="1868">Trinidad &amp; Tobago (+1868)</option>
                                                <option value="216">Tunisia (+216)</option>
                                                <option value="90">Turkey (+90)</option>
                                                <option value="7">Turkmenistan (+7)</option>
                                                <option value="993">Turkmenistan (+993)</option>
                                                <option value="1649">Turks &amp; Caicos Islands (+1649)</option>
                                                <option value="688">Tuvalu (+688)</option>
                                                <option value="256">Uganda (+256)</option>
                                                <option value="44">UK (+44)</option>
                                                <option value="380">Ukraine (+380)</option>
                                                <option value="971" selected="selected">United Arab Emirates (+971)</option>
                                                <option value="598">Uruguay (+598)</option>
                                                <option value="1">USA (+1)</option>
                                                <option value="7">Uzbekistan (+7)</option>
                                                <option value="678">Vanuatu (+678)</option>
                                                <option value="379">Vatican City (+379)</option>
                                                <option value="58">Venezuela (+58)</option>
                                                <option value="84">Vietnam (+84)</option>
                                                <option value="84">Virgin Islands - British (+1284)</option>
                                                <option value="84">Virgin Islands - US (+1340)</option>
                                                <option value="681">Wallis &amp; Futuna (+681)</option>
                                                <option value="969">Yemen (North)(+969)</option>
                                                <option value="967">Yemen (South)(+967)</option>
                                                <option value="381">Yugoslavia (+381)</option>
                                                <option value="243">Zaire (+243)</option>
                                                <option value="260">Zambia (+260)</option>
                                                <option value="263">Zimbabwe (+263)</option>                              
                                              </select>
                                            </div>  
                                            <div class="col-md-9">
                                              <input type="text" class="form-control input-sm" placeholder="mobile number" id="mobilenumber1" name="mobilenumber1">
                                            </div>
                                          </div> 
                                        </div>
                                        <div class="form-group">
                                          <div class="row">
                                            <div class="col-md-6">
                                              <label>Mobile Number (Secondary)</label>
                                            </div>
                                          </div>
                                          <div class="row">
                                            <div class="col-md-3">
                                              <select class="form-control required input-sm" id="countrycode2" name="countrycode2">
                                                <option>Select</option>
                                                <option value="1">USA (+1)</option>
                                                <option value="213">Algeria (+213)</option>
                                                <option value="376">Andorra (+376)</option>
                                                <option value="244">Angola (+244)</option>
                                                <option value="1264">Anguilla (+1264)</option>
                                                <option value="1268">Antigua &amp; Barbuda (+1268)</option>
                                                <option value="599">Antilles (Dutch) (+599)</option>
                                                <option value="54">Argentina (+54)</option>
                                                <option value="374">Armenia (+374)</option>
                                                <option value="297">Aruba (+297)</option>
                                                <option value="247">Ascension Island (+247)</option>
                                                <option value="61">Australia (+61)</option>
                                                <option value="43">Austria (+43)</option>
                                                <option value="994">Azerbaijan (+994)</option>
                                                <option value="1242">Bahamas (+1242)</option>
                                                <option value="973">Bahrain (+973)</option>
                                                <option value="880">Bangladesh (+880)</option>
                                                <option value="1246">Barbados (+1246)</option>
                                                <option value="375">Belarus (+375)</option>
                                                <option value="32">Belgium (+32)</option>
                                                <option value="501">Belize (+501)</option>
                                                <option value="229">Benin (+229)</option>
                                                <option value="1441">Bermuda (+1441)</option>
                                                <option value="975">Bhutan (+975)</option>
                                                <option value="591">Bolivia (+591)</option>
                                                <option value="387">Bosnia Herzegovina (+387)</option>
                                                <option value="267">Botswana (+267)</option>
                                                <option value="55">Brazil (+55)</option>
                                                <option value="673">Brunei (+673)</option>
                                                <option value="359">Bulgaria (+359)</option>
                                                <option value="226">Burkina Faso (+226)</option>
                                                <option value="257">Burundi (+257)</option>
                                                <option value="855">Cambodia (+855)</option>
                                                <option value="237">Cameroon (+237)</option>
                                                <option value="1">Canada (+1)</option>
                                                <option value="238">Cape Verde Islands (+238)</option>
                                                <option value="1345">Cayman Islands (+1345)</option>
                                                <option value="236">Central African Republic (+236)</option>
                                                <option value="56">Chile (+56)</option>
                                                <option value="86">China (+86)</option>
                                                <option value="57">Colombia (+57)</option>
                                                <option value="269">Comoros (+269)</option>
                                                <option value="242">Congo (+242)</option>
                                                <option value="682">Cook Islands (+682)</option>
                                                <option value="506">Costa Rica (+506)</option>
                                                <option value="385">Croatia (+385)</option>
                                                <option value="53">Cuba (+53)</option>
                                                <option value="90392">Cyprus North (+90392)</option>
                                                <option value="357">Cyprus South (+357)</option>
                                                <option value="42">Czech Republic (+42)</option>
                                                <option value="45">Denmark (+45)</option>
                                                <option value="2463">Diego Garcia (+2463)</option>
                                                <option value="253">Djibouti (+253)</option>
                                                <option value="1809">Dominica (+1809)</option>
                                                <option value="1809">Dominican Republic (+1809)</option>
                                                <option value="593">Ecuador (+593)</option>
                                                <option value="20">Egypt (+20)</option>
                                                <option value="353">Eire (+353)</option>
                                                <option value="503">El Salvador (+503)</option>
                                                <option value="240">Equatorial Guinea (+240)</option>
                                                <option value="291">Eritrea (+291)</option>
                                                <option value="372">Estonia (+372)</option>
                                                <option value="251">Ethiopia (+251)</option>
                                                <option value="500">Falkland Islands (+500)</option>
                                                <option value="298">Faroe Islands (+298)</option>
                                                <option value="679">Fiji (+679)</option>
                                                <option value="358">Finland (+358)</option>
                                                <option value="33">France (+33)</option>
                                                <option value="594">French Guiana (+594)</option>
                                                <option value="689">French Polynesia (+689)</option>
                                                <option value="241">Gabon (+241)</option>
                                                <option value="220">Gambia (+220)</option>
                                                <option value="7880">Georgia (+7880)</option>
                                                <option value="49">Germany (+49)</option>
                                                <option value="233">Ghana (+233)</option>
                                                <option value="350">Gibraltar (+350)</option>
                                                <option value="30">Greece (+30)</option>
                                                <option value="299">Greenland (+299)</option>
                                                <option value="1473">Grenada (+1473)</option>
                                                <option value="590">Guadeloupe (+590)</option>
                                                <option value="671">Guam (+671)</option>
                                                <option value="502">Guatemala (+502)</option>
                                                <option value="224">Guinea (+224)</option>
                                                <option value="245">Guinea - Bissau (+245)</option>
                                                <option value="592">Guyana (+592)</option>
                                                <option value="509">Haiti (+509)</option>
                                                <option value="504">Honduras (+504)</option>
                                                <option value="852">Hong Kong (+852)</option>
                                                <option value="36">Hungary (+36)</option>
                                                <option value="354">Iceland (+354)</option>
                                                <option value="91">India (+91)</option>
                                                <option value="62">Indonesia (+62)</option>
                                                <option value="98">Iran (+98)</option>
                                                <option value="964">Iraq (+964)</option>
                                                <option value="972">Israel (+972)</option>
                                                <option value="39">Italy (+39)</option>
                                                <option value="225">Ivory Coast (+225)</option>
                                                <option value="1876">Jamaica (+1876)</option>
                                                <option value="81">Japan (+81)</option>
                                                <option value="962">Jordan (+962)</option>
                                                <option value="7">Kazakhstan (+7)</option>
                                                <option value="254">Kenya (+254)</option>
                                                <option value="686">Kiribati (+686)</option>
                                                <option value="850">Korea North (+850)</option>
                                                <option value="82">Korea South (+82)</option>
                                                <option value="965">Kuwait (+965)</option>
                                                <option value="996">Kyrgyzstan (+996)</option>
                                                <option value="856">Laos (+856)</option>
                                                <option value="371">Latvia (+371)</option>
                                                <option value="961">Lebanon (+961)</option>
                                                <option value="266">Lesotho (+266)</option>
                                                <option value="231">Liberia (+231)</option>
                                                <option value="218">Libya (+218)</option>
                                                <option value="417">Liechtenstein (+417)</option>
                                                <option value="370">Lithuania (+370)</option>
                                                <option value="352">Luxembourg (+352)</option>
                                                <option value="853">Macao (+853)</option>
                                                <option value="389">Macedonia (+389)</option>
                                                <option value="261">Madagascar (+261)</option>
                                                <option value="265">Malawi (+265)</option>
                                                <option value="60">Malaysia (+60)</option>
                                                <option value="960">Maldives (+960)</option>
                                                <option value="223">Mali (+223)</option>
                                                <option value="356">Malta (+356)</option>
                                                <option value="692">Marshall Islands (+692)</option>
                                                <option value="596">Martinique (+596)</option>
                                                <option value="222">Mauritania (+222)</option>
                                                <option value="269">Mayotte (+269)</option>
                                                <option value="52">Mexico (+52)</option>
                                                <option value="691">Micronesia (+691)</option>
                                                <option value="373">Moldova (+373)</option>
                                                <option value="377">Monaco (+377)</option>
                                                <option value="976">Mongolia (+976)</option>
                                                <option value="1664">Montserrat (+1664)</option>
                                                <option value="212">Morocco (+212)</option>
                                                <option value="258">Mozambique (+258)</option>
                                                <option value="95">Myanmar (+95)</option>
                                                <option value="264">Namibia (+264)</option>
                                                <option value="674">Nauru (+674)</option>
                                                <option value="977">Nepal (+977)</option>
                                                <option value="31">Netherlands (+31)</option>
                                                <option value="687">New Caledonia (+687)</option>
                                                <option value="64">New Zealand (+64)</option>
                                                <option value="505">Nicaragua (+505)</option>
                                                <option value="227">Niger (+227)</option>
                                                <option value="234">Nigeria (+234)</option>
                                                <option value="683">Niue (+683)</option>
                                                <option value="672">Norfolk Islands (+672)</option>
                                                <option value="670">Northern Marianas (+670)</option>
                                                <option value="47">Norway (+47)</option>
                                                <option value="968">Oman (+968)</option>
                                                <option value="92">Pakistan (+92)</option>
                                                <option value="680">Palau (+680)</option>
                                                <option value="507">Panama (+507)</option>
                                                <option value="675">Papua New Guinea (+675)</option>
                                                <option value="595">Paraguay (+595)</option>
                                                <option value="51">Peru (+51)</option>
                                                <option value="63">Philippines (+63)</option>
                                                <option value="48">Poland (+48)</option>
                                                <option value="351">Portugal (+351)</option>
                                                <option value="1787">Puerto Rico (+1787)</option>
                                                <option value="974">Qatar (+974)</option>
                                                <option value="262">Reunion (+262)</option>
                                                <option value="40">Romania (+40)</option>
                                                <option value="7">Russia (+7)</option>
                                                <option value="250">Rwanda (+250)</option>
                                                <option value="378">San Marino (+378)</option>
                                                <option value="239">Sao Tome &amp; Principe (+239)</option>
                                                <option value="966">Saudi Arabia (+966)</option>
                                                <option value="221">Senegal (+221)</option>
                                                <option value="381">Serbia (+381)</option>
                                                <option value="248">Seychelles (+248)</option>
                                                <option value="232">Sierra Leone (+232)</option>
                                                <option value="65">Singapore (+65)</option>
                                                <option value="421">Slovak Republic (+421)</option>
                                                <option value="386">Slovenia (+386)</option>
                                                <option value="677">Solomon Islands (+677)</option>
                                                <option value="252">Somalia (+252)</option>
                                                <option value="27">South Africa (+27)</option>
                                                <option value="34">Spain (+34)</option>
                                                <option value="94">Sri Lanka (+94)</option>
                                                <option value="290">St. Helena (+290)</option>
                                                <option value="1869">St. Kitts (+1869)</option>
                                                <option value="1758">St. Lucia (+1758)</option>
                                                <option value="249">Sudan (+249)</option>
                                                <option value="597">Suriname (+597)</option>
                                                <option value="268">Swaziland (+268)</option>
                                                <option value="46">Sweden (+46)</option>
                                                <option value="41">Switzerland (+41)</option>
                                                <option value="963">Syria (+963)</option>
                                                <option value="886">Taiwan (+886)</option>
                                                <option value="7">Tajikstan (+7)</option>
                                                <option value="66">Thailand (+66)</option>
                                                <option value="228">Togo (+228)</option>
                                                <option value="676">Tonga (+676)</option>
                                                <option value="1868">Trinidad &amp; Tobago (+1868)</option>
                                                <option value="216">Tunisia (+216)</option>
                                                <option value="90">Turkey (+90)</option>
                                                <option value="7">Turkmenistan (+7)</option>
                                                <option value="993">Turkmenistan (+993)</option>
                                                <option value="1649">Turks &amp; Caicos Islands (+1649)</option>
                                                <option value="688">Tuvalu (+688)</option>
                                                <option value="256">Uganda (+256)</option>
                                                <option value="44">UK (+44)</option>
                                                <option value="380">Ukraine (+380)</option>
                                                <option value="971" selected="selected">United Arab Emirates (+971)</option>
                                                <option value="598">Uruguay (+598)</option>
                                                <option value="1">USA (+1)</option>
                                                <option value="7">Uzbekistan (+7)</option>
                                                <option value="678">Vanuatu (+678)</option>
                                                <option value="379">Vatican City (+379)</option>
                                                <option value="58">Venezuela (+58)</option>
                                                <option value="84">Vietnam (+84)</option>
                                                <option value="84">Virgin Islands - British (+1284)</option>
                                                <option value="84">Virgin Islands - US (+1340)</option>
                                                <option value="681">Wallis &amp; Futuna (+681)</option>
                                                <option value="969">Yemen (North)(+969)</option>
                                                <option value="967">Yemen (South)(+967)</option>
                                                <option value="381">Yugoslavia (+381)</option>
                                                <option value="243">Zaire (+243)</option>
                                                <option value="260">Zambia (+260)</option>
                                                <option value="263">Zimbabwe (+263)</option>                            
                                              </select>
                                            </div>  
                                            <div class="col-md-9">
                                              <input type="text" class="form-control input-sm" placeholder="mobile number" id="mobilenumber2" name="mobilenumber2">
                                            </div>
                                          </div> 
                                        </div>                
                                        <div class="form-group">
                                          <div class="row">
                                            <div class="col-md-4">
                                              <label>Home Number</label>
                                            </div>
                                          </div>
                                          <div class="row">
                                            <div class="col-md-3">
                                              <select class="form-control required input-sm" id="countrycode3" name="countrycode3">
                                                <option>Select</option>
                                                <option value="1">USA (+1)</option>
                                                <option value="213">Algeria (+213)</option>
                                                <option value="376">Andorra (+376)</option>
                                                <option value="244">Angola (+244)</option>
                                                <option value="1264">Anguilla (+1264)</option>
                                                <option value="1268">Antigua &amp; Barbuda (+1268)</option>
                                                <option value="599">Antilles (Dutch) (+599)</option>
                                                <option value="54">Argentina (+54)</option>
                                                <option value="374">Armenia (+374)</option>
                                                <option value="297">Aruba (+297)</option>
                                                <option value="247">Ascension Island (+247)</option>
                                                <option value="61">Australia (+61)</option>
                                                <option value="43">Austria (+43)</option>
                                                <option value="994">Azerbaijan (+994)</option>
                                                <option value="1242">Bahamas (+1242)</option>
                                                <option value="973">Bahrain (+973)</option>
                                                <option value="880">Bangladesh (+880)</option>
                                                <option value="1246">Barbados (+1246)</option>
                                                <option value="375">Belarus (+375)</option>
                                                <option value="32">Belgium (+32)</option>
                                                <option value="501">Belize (+501)</option>
                                                <option value="229">Benin (+229)</option>
                                                <option value="1441">Bermuda (+1441)</option>
                                                <option value="975">Bhutan (+975)</option>
                                                <option value="591">Bolivia (+591)</option>
                                                <option value="387">Bosnia Herzegovina (+387)</option>
                                                <option value="267">Botswana (+267)</option>
                                                <option value="55">Brazil (+55)</option>
                                                <option value="673">Brunei (+673)</option>
                                                <option value="359">Bulgaria (+359)</option>
                                                <option value="226">Burkina Faso (+226)</option>
                                                <option value="257">Burundi (+257)</option>
                                                <option value="855">Cambodia (+855)</option>
                                                <option value="237">Cameroon (+237)</option>
                                                <option value="1">Canada (+1)</option>
                                                <option value="238">Cape Verde Islands (+238)</option>
                                                <option value="1345">Cayman Islands (+1345)</option>
                                                <option value="236">Central African Republic (+236)</option>
                                                <option value="56">Chile (+56)</option>
                                                <option value="86">China (+86)</option>
                                                <option value="57">Colombia (+57)</option>
                                                <option value="269">Comoros (+269)</option>
                                                <option value="242">Congo (+242)</option>
                                                <option value="682">Cook Islands (+682)</option>
                                                <option value="506">Costa Rica (+506)</option>
                                                <option value="385">Croatia (+385)</option>
                                                <option value="53">Cuba (+53)</option>
                                                <option value="90392">Cyprus North (+90392)</option>
                                                <option value="357">Cyprus South (+357)</option>
                                                <option value="42">Czech Republic (+42)</option>
                                                <option value="45">Denmark (+45)</option>
                                                <option value="2463">Diego Garcia (+2463)</option>
                                                <option value="253">Djibouti (+253)</option>
                                                <option value="1809">Dominica (+1809)</option>
                                                <option value="1809">Dominican Republic (+1809)</option>
                                                <option value="593">Ecuador (+593)</option>
                                                <option value="20">Egypt (+20)</option>
                                                <option value="353">Eire (+353)</option>
                                                <option value="503">El Salvador (+503)</option>
                                                <option value="240">Equatorial Guinea (+240)</option>
                                                <option value="291">Eritrea (+291)</option>
                                                <option value="372">Estonia (+372)</option>
                                                <option value="251">Ethiopia (+251)</option>
                                                <option value="500">Falkland Islands (+500)</option>
                                                <option value="298">Faroe Islands (+298)</option>
                                                <option value="679">Fiji (+679)</option>
                                                <option value="358">Finland (+358)</option>
                                                <option value="33">France (+33)</option>
                                                <option value="594">French Guiana (+594)</option>
                                                <option value="689">French Polynesia (+689)</option>
                                                <option value="241">Gabon (+241)</option>
                                                <option value="220">Gambia (+220)</option>
                                                <option value="7880">Georgia (+7880)</option>
                                                <option value="49">Germany (+49)</option>
                                                <option value="233">Ghana (+233)</option>
                                                <option value="350">Gibraltar (+350)</option>
                                                <option value="30">Greece (+30)</option>
                                                <option value="299">Greenland (+299)</option>
                                                <option value="1473">Grenada (+1473)</option>
                                                <option value="590">Guadeloupe (+590)</option>
                                                <option value="671">Guam (+671)</option>
                                                <option value="502">Guatemala (+502)</option>
                                                <option value="224">Guinea (+224)</option>
                                                <option value="245">Guinea - Bissau (+245)</option>
                                                <option value="592">Guyana (+592)</option>
                                                <option value="509">Haiti (+509)</option>
                                                <option value="504">Honduras (+504)</option>
                                                <option value="852">Hong Kong (+852)</option>
                                                <option value="36">Hungary (+36)</option>
                                                <option value="354">Iceland (+354)</option>
                                                <option value="91">India (+91)</option>
                                                <option value="62">Indonesia (+62)</option>
                                                <option value="98">Iran (+98)</option>
                                                <option value="964">Iraq (+964)</option>
                                                <option value="972">Israel (+972)</option>
                                                <option value="39">Italy (+39)</option>
                                                <option value="225">Ivory Coast (+225)</option>
                                                <option value="1876">Jamaica (+1876)</option>
                                                <option value="81">Japan (+81)</option>
                                                <option value="962">Jordan (+962)</option>
                                                <option value="7">Kazakhstan (+7)</option>
                                                <option value="254">Kenya (+254)</option>
                                                <option value="686">Kiribati (+686)</option>
                                                <option value="850">Korea North (+850)</option>
                                                <option value="82">Korea South (+82)</option>
                                                <option value="965">Kuwait (+965)</option>
                                                <option value="996">Kyrgyzstan (+996)</option>
                                                <option value="856">Laos (+856)</option>
                                                <option value="371">Latvia (+371)</option>
                                                <option value="961">Lebanon (+961)</option>
                                                <option value="266">Lesotho (+266)</option>
                                                <option value="231">Liberia (+231)</option>
                                                <option value="218">Libya (+218)</option>
                                                <option value="417">Liechtenstein (+417)</option>
                                                <option value="370">Lithuania (+370)</option>
                                                <option value="352">Luxembourg (+352)</option>
                                                <option value="853">Macao (+853)</option>
                                                <option value="389">Macedonia (+389)</option>
                                                <option value="261">Madagascar (+261)</option>
                                                <option value="265">Malawi (+265)</option>
                                                <option value="60">Malaysia (+60)</option>
                                                <option value="960">Maldives (+960)</option>
                                                <option value="223">Mali (+223)</option>
                                                <option value="356">Malta (+356)</option>
                                                <option value="692">Marshall Islands (+692)</option>
                                                <option value="596">Martinique (+596)</option>
                                                <option value="222">Mauritania (+222)</option>
                                                <option value="269">Mayotte (+269)</option>
                                                <option value="52">Mexico (+52)</option>
                                                <option value="691">Micronesia (+691)</option>
                                                <option value="373">Moldova (+373)</option>
                                                <option value="377">Monaco (+377)</option>
                                                <option value="976">Mongolia (+976)</option>
                                                <option value="1664">Montserrat (+1664)</option>
                                                <option value="212">Morocco (+212)</option>
                                                <option value="258">Mozambique (+258)</option>
                                                <option value="95">Myanmar (+95)</option>
                                                <option value="264">Namibia (+264)</option>
                                                <option value="674">Nauru (+674)</option>
                                                <option value="977">Nepal (+977)</option>
                                                <option value="31">Netherlands (+31)</option>
                                                <option value="687">New Caledonia (+687)</option>
                                                <option value="64">New Zealand (+64)</option>
                                                <option value="505">Nicaragua (+505)</option>
                                                <option value="227">Niger (+227)</option>
                                                <option value="234">Nigeria (+234)</option>
                                                <option value="683">Niue (+683)</option>
                                                <option value="672">Norfolk Islands (+672)</option>
                                                <option value="670">Northern Marianas (+670)</option>
                                                <option value="47">Norway (+47)</option>
                                                <option value="968">Oman (+968)</option>
                                                <option value="92">Pakistan (+92)</option>
                                                <option value="680">Palau (+680)</option>
                                                <option value="507">Panama (+507)</option>
                                                <option value="675">Papua New Guinea (+675)</option>
                                                <option value="595">Paraguay (+595)</option>
                                                <option value="51">Peru (+51)</option>
                                                <option value="63">Philippines (+63)</option>
                                                <option value="48">Poland (+48)</option>
                                                <option value="351">Portugal (+351)</option>
                                                <option value="1787">Puerto Rico (+1787)</option>
                                                <option value="974">Qatar (+974)</option>
                                                <option value="262">Reunion (+262)</option>
                                                <option value="40">Romania (+40)</option>
                                                <option value="7">Russia (+7)</option>
                                                <option value="250">Rwanda (+250)</option>
                                                <option value="378">San Marino (+378)</option>
                                                <option value="239">Sao Tome &amp; Principe (+239)</option>
                                                <option value="966">Saudi Arabia (+966)</option>
                                                <option value="221">Senegal (+221)</option>
                                                <option value="381">Serbia (+381)</option>
                                                <option value="248">Seychelles (+248)</option>
                                                <option value="232">Sierra Leone (+232)</option>
                                                <option value="65">Singapore (+65)</option>
                                                <option value="421">Slovak Republic (+421)</option>
                                                <option value="386">Slovenia (+386)</option>
                                                <option value="677">Solomon Islands (+677)</option>
                                                <option value="252">Somalia (+252)</option>
                                                <option value="27">South Africa (+27)</option>
                                                <option value="34">Spain (+34)</option>
                                                <option value="94">Sri Lanka (+94)</option>
                                                <option value="290">St. Helena (+290)</option>
                                                <option value="1869">St. Kitts (+1869)</option>
                                                <option value="1758">St. Lucia (+1758)</option>
                                                <option value="249">Sudan (+249)</option>
                                                <option value="597">Suriname (+597)</option>
                                                <option value="268">Swaziland (+268)</option>
                                                <option value="46">Sweden (+46)</option>
                                                <option value="41">Switzerland (+41)</option>
                                                <option value="963">Syria (+963)</option>
                                                <option value="886">Taiwan (+886)</option>
                                                <option value="7">Tajikstan (+7)</option>
                                                <option value="66">Thailand (+66)</option>
                                                <option value="228">Togo (+228)</option>
                                                <option value="676">Tonga (+676)</option>
                                                <option value="1868">Trinidad &amp; Tobago (+1868)</option>
                                                <option value="216">Tunisia (+216)</option>
                                                <option value="90">Turkey (+90)</option>
                                                <option value="7">Turkmenistan (+7)</option>
                                                <option value="993">Turkmenistan (+993)</option>
                                                <option value="1649">Turks &amp; Caicos Islands (+1649)</option>
                                                <option value="688">Tuvalu (+688)</option>
                                                <option value="256">Uganda (+256)</option>
                                                <option value="44">UK (+44)</option>
                                                <option value="380">Ukraine (+380)</option>
                                                <option value="971" selected="selected">United Arab Emirates (+971)</option>
                                                <option value="598">Uruguay (+598)</option>
                                                <option value="1">USA (+1)</option>
                                                <option value="7">Uzbekistan (+7)</option>
                                                <option value="678">Vanuatu (+678)</option>
                                                <option value="379">Vatican City (+379)</option>
                                                <option value="58">Venezuela (+58)</option>
                                                <option value="84">Vietnam (+84)</option>
                                                <option value="84">Virgin Islands - British (+1284)</option>
                                                <option value="84">Virgin Islands - US (+1340)</option>
                                                <option value="681">Wallis &amp; Futuna (+681)</option>
                                                <option value="969">Yemen (North)(+969)</option>
                                                <option value="967">Yemen (South)(+967)</option>
                                                <option value="381">Yugoslavia (+381)</option>
                                                <option value="243">Zaire (+243)</option>
                                                <option value="260">Zambia (+260)</option>
                                                <option value="263">Zimbabwe (+263)</option>                              
                                              </select>
                                            </div>  
                                            <div class="col-md-9">
                                              <input type="text" class="form-control input-sm" placeholder="home number" id="mobilenumber3" name="mobilenumber3">
                                            </div>
                                          </div> 
                                        </div>
                                        <div class="form-group">
                                          <label>Email</label>
                                          <input type="text" class="form-control input-sm" id="email" name="email">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="clear"></div>
                                    <!-- to fix overflow issue -->
                                  </form>            
                                </div>
                                <div role="tabpanel" class="tab-pane" id="selecttenant">
                                  <div>
                                    <!-- <input style="width:226px" class="form-control input-sm search_init" type='text' id='txtSmartSearch_Tenants' placeholder="Search here" /> -->
                                  </div>
                                  <table id="tblTenants" aria-describedby="dataTables-current-listing_info" class="table table-striped table-hover datatables datatable-setbotclass dataTable no-footer">
                                    <thead class="listing_headings">
                                      <tr>
                                        <th>
                    <!-- <label class=""><input id='CheckAllListings' class='CheckAll' onclick="toggleChecked()" type="checkbox" value=''>
                    <span class="lbl"></span></label> -->
                  </th>
                  <th>
                    <div style="cursor:pointer;min-width:50px;" title="Click here to sort">
                      Ref
                    </div>
                  </th>
                  <th>
                    <div style="cursor:pointer;" title="Click here to sort">
                      First Name
                    </div>
                  </th>
                  <th>
                    <div style="cursor:pointer;" title="Click here to sort">
                      Last Name
                    </div>
                  </th>
                  <th>
                    <div style="cursor:pointer;" title="Click here to sort">
                      Mobile Number
                    </div>
                  </th>
                  <th>
                    <div style="cursor:pointer;" title="Click here to sort">
                      DOB
                    </div>
                  </th>
                  <th>
                    <div style="cursor:pointer;" title="Click here to sort">
                      Email
                    </div>
                  </th>
                  <th>
                    <div style="cursor:pointer; white-space:nowrap;" title="Click here to sort">
                      Nationality
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

      <div class="modal-footer">
        <button id="btnSelectTenant" class="btn btn-success" data-dismiss="modal" type="button">
          <i class="fa fa-check"></i> Save and Select
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Modal for Add/Edit Work Orders -->
<div class="modal fade" id="workorderform" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <label id="modaltitle">
          <h4 class="modal-title">New Work Order</h4>
        </label>
      </div>
      <div class="modal-body">
        <div class="tab-content tab-nopadding">
          <div role="tabpanel" class="tab-pane active" id="addnewunit">
            <form id="frm_workorders">
              <input type="hidden" id="id" name="id" value="0" />
              <input type="hidden" id="rand_key" name="rand_key" value="" />
              <input type="hidden" id="ref" name="ref" value="" />
              <input type="hidden" id="dateadded" name="dateadded" value="" />
              <input type="hidden" id="created_by" name="created_by" value="" />
              <div class="col-md-6">
                <div class="form-group">
                  <label>Unit</label>
                  <div>
                    <!-- class="input-group" -->
                    <!-- <span class="input-group-addon"><a id="aUnits" class="selectorlinks" data-target="#unitSelector" data-toggle="modal" href="#"><i class="fa fa-plus-circle"></i></a></span> -->
                    <input type="hidden" id="unitId" name="unitId">
                    <input type="hidden" id="unitRefNo">
                    <input type="text" required="" readonly="" class="form-control required input-sm" id="unitTitle">
                  </div>
                </div>
                <div class="form-group">
                  <label>Service Provider</label>
                  <div class="input-group">
                    <span class="input-group-addon"><a data-target="#serviceproviderform" data-parent="workorders" data-toggle="modal" href=""><i class="fa fa-plus-circle"></i></a></span>
                    <input type="hidden" id="serviceProviderId" name="serviceProviderId">
                    <input type="hidden" id="serviceProviderRefNo">
                    <input type="text" required="" readonly="" class="form-control required input-sm" id="serviceprovider">
                  </div>
                </div>
                <div class="form-group">
                  <label>Provider Details</label>
                  <div class="well" style="height:205px;padding: 0px">
                    <table class="table table-striped">
                      <tbody>
                        <tr>
                          <td>Type</td>
                          <td>
                            <label id="uType"></label>
                          </td>
                        </tr>
                        <tr>
                          <td>Sub-Types</td>
                          <td>
                            <label id="uSubTypes"></label>
                          </td>
                        </tr>
                        <tr>
                          <td>Contact Person</td>
                          <td>
                            <label id="uContact"></label>
                          </td>
                        </tr>
                        <tr>
                          <td>Mobile no</td>
                          <td>
                            <label id="uMobile"></label>
                          </td>
                        </tr>
                        <tr>
                          <td>Email</td>
                          <td>
                            <label id="uEmail"></label>
                          </td>
                        </tr>
                      </tbody>
                    </table>

                  </div>
                </div>
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" id="description" name="description"></textarea>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Type</label>
                  <select required="" class="form-control required input-sm" id="type" name="type">
                    <option value="">Please select</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Sub Type</label>
                  <select required="" class="form-control required input-sm" id="subtype" name="subtype">
                    <option value="">Select Type first</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Assigned To</label>
                  <select required="" class="form-control required input-sm" id="assignedto" name="assignedto">
                    <option value="">Please select</option>
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
                      <div class="input-group">
                        <input type="text" class="form-control input-sm datepicker" id="startdate" name="startdate">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>End Date</label>
                      <div class="input-group">
                        <input type="text" class="form-control input-sm datepicker" id="enddate" name="enddate">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Cost</label>
                  <div class="input-group">
                    <input type="text" class="form-control input-sm" id="cost" name="cost">
                    <span class="input-group-addon">AED</span>
                  </div>
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

              <div class="clear"></div>
              <!-- to fix overflow issue -->
            </form>
          </div>

        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal" id="btnSaveWorkOrder"><i class="fa fa-check"></i> Save and Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal for Add/Edit Accounts -->
<div class="modal fade" id="accountform" data-backdrop="static" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <label id="modaltitle">
          <h4 class="modal-title">Manage Transactions</h4>
        </label>
      </div>
      <div class="modal-body">
        <div class="tab-content tab-nopadding">
          <input type="hidden" id="id" name="id"><!-- headerId -->
          <input type="hidden" id="ref" name="ref"><!-- header reference -->
          <form id="paymentControls" class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Payee</label>
                <input type="hidden" name="hdnPayeeId" id="hdnPayeeId">
                <div class="input-group">
                  <div class="input-group-btn">
                    <button id="selPayee" aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" class="btn btn-sm btn-block btn-default dropdown-toggle" type="button">
                      <span id="selectedPayee">Select</span> <span class="caret"></span></button>
                      <ul id="spDropdown" class="dropdown-menu">
                        <li class="divider" role="separator"></li>
                        <li><a value="new" href="#">Create New...</a></li>
                      </ul>
                    </div><!-- /btn-group -->
                  </div><!-- /input-group -->               
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Amount</label>
                  <div class="input-group">
                    <span class="input-group-addon">AED</span>
                    <input type="text" class="form-control input-sm" placeholder="0.00" id="cost" name="cost">
                  </div>
                </div>
              </div>
              <div class="col-md-1">
                <div class="form-group">
                  <label>Day</label>
                <!-- <input type="hidden" id="mon
                th" name="month" value="0"> -->
                <input type="text" id="day" name="day" class="form-control required input-sm numOnly">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Month</label>
                <select id="selMonth" name="month" class="form-control required input-sm">
                  <option value="0">Select</option>
                  <option value="1">January</option>
                  <option value="2">February</option>
                  <option value="3">March</option>
                  <option value="4">April</option>
                  <option value="5">May</option>
                  <option value="6">June</option>
                  <option value="7">July</option>
                  <option value="8">August</option>
                  <option value="9">September</option>
                  <option value="10">October</option>
                  <option value="11">November</option>
                  <option value="12">December</option>
                </select>  
              </div>            
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Year</label>
                <select id="selYear" name="year" class="form-control required input-sm">
                  <option value="0">Select</option>
                  <option selected="" value="2016">2016</option>
                  <option value="2017">2017</option>
                  <option value="2018">2018</option>
                  <option value="2019">2019</option>
                  <option value="2020">2020</option>
                </select>  
              </div>            
            </div>
            <div class="col-md-2">
              <label>&nbsp;</label>
              <div class="form-group">
                <button id="btnAddPayment" class="btn btn-block btn-success btn-sm" type="button"><i class="fa fa-save"></i> Save</button>
              </div>
            </div>
          </form>
        </div>

        <hr>

        <br/>
        <br/>
        <div class="table-wrapper">
          <table id="tblPayments" class="data table-striped">
            <thead class="header">
              <tr>
                <th style="text-align: center; vertical-align: middle; height: 100px; padding-top: 30px" rowspan=2>Payee</th>
                <th class="month"colspan="2" month="1" id="m1">January</th>
                <th class="month"colspan="2" month="2" id="m2">February</th>
                <th class="month"colspan="2" month="3" id="m3">March</th>
                <th class="month"colspan="2" month="4" id="m4">April</th>
                <th class="month"colspan="2" month="5" id="m5">May</th>
                <th class="month"colspan="2" month="6" id="m6">June</th>
                <th class="month"colspan="2" month="7" id="m7">July</th>
                <th class="month"colspan="2" month="8" id="m8">August</th>
                <th class="month"colspan="2" month="9" id="m9">September</th>
                <th class="month"colspan="2" month="10" id="10">October</th>
                <th class="month"colspan="2" month="11" id="m11">November</th>
                <th class="month"colspan="2" month="12" id="m12">December</th>
              </tr>
              <tr>
                <th />
                <th>Paid</th>
                <th>Due</th>
                <th>Paid</th>
                <th>Due</th>
                <th>Paid</th>
                <th>Due</th>
                <th>Paid</th>
                <th>Due</th>
                <th>Paid</th>
                <th>Due</th>
                <th>Paid</th>
                <th>Due</th>
                <th>Paid</th>
                <th>Due</th>
                <th>Paid</th>
                <th>Due</th>
                <th>Paid</th>
                <th>Due</th>
                <th>Paid</th>
                <th>Due</th>
                <th>Paid</th>
                <th>Due</th>
                <th>Paid</th>
                <th>Due</th>
              </tr>              
            </thead>
            <tbody class="results">

            </tbody>
          </table>
        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal" id="btnSavePayments"><i class="fa fa-check"></i> Save and Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal for Add/Edit Service Providers -->
<div class="modal fade" id="serviceproviderform" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Add New Service Provider</h4>
        </div>

        <div class="modal-body">
          <div id="nav" class="inner_tab_nav">
            <ul class="nav nav-tabs">
              <li role="presentation" class="active">
                <a href="#addSP" id="tabnew" aria-controls="addSP" role="tab" data-toggle="tab">Add New Service Provider</a></li>
                <li role="presentation">
                  <a href="#selectSP" id="tabimport" aria-controls="selectSP" role="tab" data-toggle="tab">Select from existing Service Providers</a></li>
                </ul>
              </div>
              <hr/>
              <div class="tab-content tab-nopadding">
                <div role="tabpanel" class="tab-pane active" id="addSP">

                  <input type="hidden" id="headerId" value="" />
                  <input type="hidden" id="payeeId" value="" />

                  <form id="frm_serviceprovider">
                    <input type="hidden" id="id" name="id" value="0" />
                    <input type="hidden" id="ref" name="ref" value="" />
                    <input type="hidden" id="dateadded" name="dateadded" value="" />
                    <input type="hidden" id="created_by" name="created_by" value="" />
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-4">
                            <label>Ref</label>
                            <input type="text" class="form-control input-sm" id="ref" name="ref" disabled="disabled">
                          </div>
                          <div class="col-md-8">
                            <label>Account number</label>
                            <input type="text" class="form-control input-sm" id="accountnumber" name="accountnumber">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Name of Service Provider</label>
                        <input type="text" class="form-control input-sm" id="serviceprovidername" name="serviceprovidername">
                      </div>
                      <div class="form-group">
                        <label>Type</label>
                        <select class="form-control required input-sm" id="type" name="type">
                          <option value="">Please select</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Sub-Types</label>
                        <select class="form-control required input-sm" id="subtype" name="subtypes">
                          <option value="">Select Type</option>
                        </select>
                      </div>

                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control input-sm" id="address" name="address">
                      </div>
                      <div class="form-group">
                        <label>Contact Person</label>
                        <div class="row">
                          <div class="col-md-6">
                            <input type="text" class="form-control input-sm" id="firstname" name="firstname" placeholder="First Name">
                          </div>
                          <div class="col-md-6">
                            <input type="text" class="form-control input-sm" id="lastname" name="lastname" placeholder="Last Name">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <label>Mobile Number (Primary)</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                            <select class="form-control required input-sm" id="countrycode1" name="countrycode1">
                              <option>Select</option>
                              <option value="1">USA (+1)</option>
                              <option value="213">Algeria (+213)</option>
                              <option value="376">Andorra (+376)</option>
                              <option value="244">Angola (+244)</option>
                              <option value="1264">Anguilla (+1264)</option>
                              <option value="1268">Antigua &amp; Barbuda (+1268)</option>
                              <option value="599">Antilles (Dutch) (+599)</option>
                              <option value="54">Argentina (+54)</option>
                              <option value="374">Armenia (+374)</option>
                              <option value="297">Aruba (+297)</option>
                              <option value="247">Ascension Island (+247)</option>
                              <option value="61">Australia (+61)</option>
                              <option value="43">Austria (+43)</option>
                              <option value="994">Azerbaijan (+994)</option>
                              <option value="1242">Bahamas (+1242)</option>
                              <option value="973">Bahrain (+973)</option>
                              <option value="880">Bangladesh (+880)</option>
                              <option value="1246">Barbados (+1246)</option>
                              <option value="375">Belarus (+375)</option>
                              <option value="32">Belgium (+32)</option>
                              <option value="501">Belize (+501)</option>
                              <option value="229">Benin (+229)</option>
                              <option value="1441">Bermuda (+1441)</option>
                              <option value="975">Bhutan (+975)</option>
                              <option value="591">Bolivia (+591)</option>
                              <option value="387">Bosnia Herzegovina (+387)</option>
                              <option value="267">Botswana (+267)</option>
                              <option value="55">Brazil (+55)</option>
                              <option value="673">Brunei (+673)</option>
                              <option value="359">Bulgaria (+359)</option>
                              <option value="226">Burkina Faso (+226)</option>
                              <option value="257">Burundi (+257)</option>
                              <option value="855">Cambodia (+855)</option>
                              <option value="237">Cameroon (+237)</option>
                              <option value="1">Canada (+1)</option>
                              <option value="238">Cape Verde Islands (+238)</option>
                              <option value="1345">Cayman Islands (+1345)</option>
                              <option value="236">Central African Republic (+236)</option>
                              <option value="56">Chile (+56)</option>
                              <option value="86">China (+86)</option>
                              <option value="57">Colombia (+57)</option>
                              <option value="269">Comoros (+269)</option>
                              <option value="242">Congo (+242)</option>
                              <option value="682">Cook Islands (+682)</option>
                              <option value="506">Costa Rica (+506)</option>
                              <option value="385">Croatia (+385)</option>
                              <option value="53">Cuba (+53)</option>
                              <option value="90392">Cyprus North (+90392)</option>
                              <option value="357">Cyprus South (+357)</option>
                              <option value="42">Czech Republic (+42)</option>
                              <option value="45">Denmark (+45)</option>
                              <option value="2463">Diego Garcia (+2463)</option>
                              <option value="253">Djibouti (+253)</option>
                              <option value="1809">Dominica (+1809)</option>
                              <option value="1809">Dominican Republic (+1809)</option>
                              <option value="593">Ecuador (+593)</option>
                              <option value="20">Egypt (+20)</option>
                              <option value="353">Eire (+353)</option>
                              <option value="503">El Salvador (+503)</option>
                              <option value="240">Equatorial Guinea (+240)</option>
                              <option value="291">Eritrea (+291)</option>
                              <option value="372">Estonia (+372)</option>
                              <option value="251">Ethiopia (+251)</option>
                              <option value="500">Falkland Islands (+500)</option>
                              <option value="298">Faroe Islands (+298)</option>
                              <option value="679">Fiji (+679)</option>
                              <option value="358">Finland (+358)</option>
                              <option value="33">France (+33)</option>
                              <option value="594">French Guiana (+594)</option>
                              <option value="689">French Polynesia (+689)</option>
                              <option value="241">Gabon (+241)</option>
                              <option value="220">Gambia (+220)</option>
                              <option value="7880">Georgia (+7880)</option>
                              <option value="49">Germany (+49)</option>
                              <option value="233">Ghana (+233)</option>
                              <option value="350">Gibraltar (+350)</option>
                              <option value="30">Greece (+30)</option>
                              <option value="299">Greenland (+299)</option>
                              <option value="1473">Grenada (+1473)</option>
                              <option value="590">Guadeloupe (+590)</option>
                              <option value="671">Guam (+671)</option>
                              <option value="502">Guatemala (+502)</option>
                              <option value="224">Guinea (+224)</option>
                              <option value="245">Guinea - Bissau (+245)</option>
                              <option value="592">Guyana (+592)</option>
                              <option value="509">Haiti (+509)</option>
                              <option value="504">Honduras (+504)</option>
                              <option value="852">Hong Kong (+852)</option>
                              <option value="36">Hungary (+36)</option>
                              <option value="354">Iceland (+354)</option>
                              <option value="91">India (+91)</option>
                              <option value="62">Indonesia (+62)</option>
                              <option value="98">Iran (+98)</option>
                              <option value="964">Iraq (+964)</option>
                              <option value="972">Israel (+972)</option>
                              <option value="39">Italy (+39)</option>
                              <option value="225">Ivory Coast (+225)</option>
                              <option value="1876">Jamaica (+1876)</option>
                              <option value="81">Japan (+81)</option>
                              <option value="962">Jordan (+962)</option>
                              <option value="7">Kazakhstan (+7)</option>
                              <option value="254">Kenya (+254)</option>
                              <option value="686">Kiribati (+686)</option>
                              <option value="850">Korea North (+850)</option>
                              <option value="82">Korea South (+82)</option>
                              <option value="965">Kuwait (+965)</option>
                              <option value="996">Kyrgyzstan (+996)</option>
                              <option value="856">Laos (+856)</option>
                              <option value="371">Latvia (+371)</option>
                              <option value="961">Lebanon (+961)</option>
                              <option value="266">Lesotho (+266)</option>
                              <option value="231">Liberia (+231)</option>
                              <option value="218">Libya (+218)</option>
                              <option value="417">Liechtenstein (+417)</option>
                              <option value="370">Lithuania (+370)</option>
                              <option value="352">Luxembourg (+352)</option>
                              <option value="853">Macao (+853)</option>
                              <option value="389">Macedonia (+389)</option>
                              <option value="261">Madagascar (+261)</option>
                              <option value="265">Malawi (+265)</option>
                              <option value="60">Malaysia (+60)</option>
                              <option value="960">Maldives (+960)</option>
                              <option value="223">Mali (+223)</option>
                              <option value="356">Malta (+356)</option>
                              <option value="692">Marshall Islands (+692)</option>
                              <option value="596">Martinique (+596)</option>
                              <option value="222">Mauritania (+222)</option>
                              <option value="269">Mayotte (+269)</option>
                              <option value="52">Mexico (+52)</option>
                              <option value="691">Micronesia (+691)</option>
                              <option value="373">Moldova (+373)</option>
                              <option value="377">Monaco (+377)</option>
                              <option value="976">Mongolia (+976)</option>
                              <option value="1664">Montserrat (+1664)</option>
                              <option value="212">Morocco (+212)</option>
                              <option value="258">Mozambique (+258)</option>
                              <option value="95">Myanmar (+95)</option>
                              <option value="264">Namibia (+264)</option>
                              <option value="674">Nauru (+674)</option>
                              <option value="977">Nepal (+977)</option>
                              <option value="31">Netherlands (+31)</option>
                              <option value="687">New Caledonia (+687)</option>
                              <option value="64">New Zealand (+64)</option>
                              <option value="505">Nicaragua (+505)</option>
                              <option value="227">Niger (+227)</option>
                              <option value="234">Nigeria (+234)</option>
                              <option value="683">Niue (+683)</option>
                              <option value="672">Norfolk Islands (+672)</option>
                              <option value="670">Northern Marianas (+670)</option>
                              <option value="47">Norway (+47)</option>
                              <option value="968">Oman (+968)</option>
                              <option value="92">Pakistan (+92)</option>
                              <option value="680">Palau (+680)</option>
                              <option value="507">Panama (+507)</option>
                              <option value="675">Papua New Guinea (+675)</option>
                              <option value="595">Paraguay (+595)</option>
                              <option value="51">Peru (+51)</option>
                              <option value="63">Philippines (+63)</option>
                              <option value="48">Poland (+48)</option>
                              <option value="351">Portugal (+351)</option>
                              <option value="1787">Puerto Rico (+1787)</option>
                              <option value="974">Qatar (+974)</option>
                              <option value="262">Reunion (+262)</option>
                              <option value="40">Romania (+40)</option>
                              <option value="7">Russia (+7)</option>
                              <option value="250">Rwanda (+250)</option>
                              <option value="378">San Marino (+378)</option>
                              <option value="239">Sao Tome &amp; Principe (+239)</option>
                              <option value="966">Saudi Arabia (+966)</option>
                              <option value="221">Senegal (+221)</option>
                              <option value="381">Serbia (+381)</option>
                              <option value="248">Seychelles (+248)</option>
                              <option value="232">Sierra Leone (+232)</option>
                              <option value="65">Singapore (+65)</option>
                              <option value="421">Slovak Republic (+421)</option>
                              <option value="386">Slovenia (+386)</option>
                              <option value="677">Solomon Islands (+677)</option>
                              <option value="252">Somalia (+252)</option>
                              <option value="27">South Africa (+27)</option>
                              <option value="34">Spain (+34)</option>
                              <option value="94">Sri Lanka (+94)</option>
                              <option value="290">St. Helena (+290)</option>
                              <option value="1869">St. Kitts (+1869)</option>
                              <option value="1758">St. Lucia (+1758)</option>
                              <option value="249">Sudan (+249)</option>
                              <option value="597">Suriname (+597)</option>
                              <option value="268">Swaziland (+268)</option>
                              <option value="46">Sweden (+46)</option>
                              <option value="41">Switzerland (+41)</option>
                              <option value="963">Syria (+963)</option>
                              <option value="886">Taiwan (+886)</option>
                              <option value="7">Tajikstan (+7)</option>
                              <option value="66">Thailand (+66)</option>
                              <option value="228">Togo (+228)</option>
                              <option value="676">Tonga (+676)</option>
                              <option value="1868">Trinidad &amp; Tobago (+1868)</option>
                              <option value="216">Tunisia (+216)</option>
                              <option value="90">Turkey (+90)</option>
                              <option value="7">Turkmenistan (+7)</option>
                              <option value="993">Turkmenistan (+993)</option>
                              <option value="1649">Turks &amp; Caicos Islands (+1649)</option>
                              <option value="688">Tuvalu (+688)</option>
                              <option value="256">Uganda (+256)</option>
                              <option value="44">UK (+44)</option>
                              <option value="380">Ukraine (+380)</option>
                              <option value="971" selected="selected">United Arab Emirates (+971)</option>
                              <option value="598">Uruguay (+598)</option>
                              <option value="1">USA (+1)</option>
                              <option value="7">Uzbekistan (+7)</option>
                              <option value="678">Vanuatu (+678)</option>
                              <option value="379">Vatican City (+379)</option>
                              <option value="58">Venezuela (+58)</option>
                              <option value="84">Vietnam (+84)</option>
                              <option value="84">Virgin Islands - British (+1284)</option>
                              <option value="84">Virgin Islands - US (+1340)</option>
                              <option value="681">Wallis &amp; Futuna (+681)</option>
                              <option value="969">Yemen (North)(+969)</option>
                              <option value="967">Yemen (South)(+967)</option>
                              <option value="381">Yugoslavia (+381)</option>
                              <option value="243">Zaire (+243)</option>
                              <option value="260">Zambia (+260)</option>
                              <option value="263">Zimbabwe (+263)</option>
                            </select>
                          </div>
                          <div class="col-md-9">
                            <input type="text" class="form-control input-sm" placeholder="mobile number" id="mobilenumber1" name="mobilenumber1">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control input-sm" id="email" name="email">
                      </div>
                    </div>
                  </form>
                  <div class="clear"></div>
                  <!-- to fix overflow issue -->
                </div>
                <div role="tabpanel" class="tab-pane" id="selectSP">
                  <div>
                    <!-- <input style="width:226px" class="form-control input-sm search_init" type='text' id='txtSmartSearch_Tenants' placeholder="Search here" /> -->
                  </div>
                  <table id="tblServiceProviders" aria-describedby="dataTables-current-listing_info" class="table table-striped table-hover datatables datatable-setbotclass dataTable no-footer">
                    <thead class="listing_headings">
                      <tr>
                        <th>
                    <!-- <label class=""><input id='CheckAllListings' class='CheckAll' onclick="toggleChecked()" type="checkbox" value=''>
                    <span class="lbl"></span></label> -->
                  </th>
                  <th>
                    <div style="cursor:pointer;min-width:50px;" title="Click here to sort">
                      Ref
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
                      Address
                    </div>
                  </th>
                  <th>
                    <div style="cursor:pointer;" title="Click here to sort">
                      Contact Name
                    </div>
                  </th>
                  <th>
                    <div style="cursor:pointer; white-space:nowrap;" title="Click here to sort">
                      Mobile Number
                    </div>
                  </th>
                  <th>
                    <div style="cursor:pointer; white-space:nowrap;" title="Click here to sort">
                      Email
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

      <div class="modal-footer">
        <button type="button" id="btnSelectServiceProvider" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Save</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal for selecting Units -->
<div class="modal fade" id="unitSelector" tabindex="-1">
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
          <div>
            <input style="width:225px" class="form-control input-sm search_init" type='text' id='txtSmartSearch_units' placeholder="Search here" />
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
          <i class="fa fa-check"></i> Select this unit
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Modal for selecting Landlords -->
<div class="modal fade" id="landlordSelector" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content ">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Landlords</h4>

      </div>

      <div class="modal-body">
        <div id="nav" class="inner_tab_nav">
          <ul class="nav nav-tabs">
            <li role="presentation" class="active">
              <a href="#addLandlord" id="tabnew" aria-controls="addLandlord" role="tab" data-toggle="tab">Add new Landlord</a></li>
            <li role="presentation">
              <a href="#selectLandlord" id="tabimport" aria-controls="selectLandlord" role="tab" data-toggle="tab">Select from existing Landlords</a></li>
          </ul>
        </div>
        <hr/>
        <div class="tab-content tab-white">
          <div role="tabpanel" class="tab-pane active" id="addLandlord">
            <form id="frm_landlord">
              <input type="hidden" id="id" name="id" value="0" />
              <input type="hidden" id="rand_key" name="rand_key" value="" />
              <input type="hidden" id="ref" name="ref" value="" />
              <input type="hidden" id="dateadded" name="dateadded" value="" />
              <input type="hidden" id="created_by" name="created_by" value="" />
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Ref</label>
                    <input type="text" class="form-control input-sm" readonly="" id="ref" name="ref">
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Salutation</label>
                        <select class="form-control required input-sm" id="salutation" name="salutation">
                          <option value="">Select</option>
                          <option value="1">Mr.</option>
                          <option value="2">Ms.</option>
                          <option value="3">Mrs.</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Title</label>
                        <select class="form-control required input-sm" id="title" name="title">
                          <option value="">Select</option>
                          <option value="1">Sheikh</option>
                          <option value="2">Engr.</option>
                          <option value="3">Dr.</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>First Name</label>
                    <input type="text" class="form-control input-sm" id="firstname" name="firstname">
                  </div>
                  <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" class="form-control input-sm" id="lastname" name="lastname">
                  </div>
                  <div class="form-group">
                    <label>Nationality</label>
                    <select required="" class="form-control required input-sm" id="nationality" name="nationality">
                      <option value="">Please select</option>
                      <option value="" selected="selected">Select Nationality</option>
                      <option value="Afghanistan">Afghanistan</option>
                      <option value="Albania">Albania</option>
                      <option value="Algeria">Algeria</option>
                      <option value="American Samoa">American Samoa</option>
                      <option value="Andorra">Andorra</option>
                      <option value="Angola">Angola</option>
                      <option value="Anguilla">Anguilla</option>
                      <option value="Antarctica">Antarctica</option>
                      <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                      <option value="Argentina">Argentina</option>
                      <option value="Armenia">Armenia</option>
                      <option value="Aruba">Aruba</option>
                      <option value="Australia">Australia</option>
                      <option value="Austria">Austria</option>
                      <option value="Azerbaijan">Azerbaijan</option>
                      <option value="Bahamas">Bahamas</option>
                      <option value="Bahrain">Bahrain</option>
                      <option value="Bangladesh">Bangladesh</option>
                      <option value="Barbados">Barbados</option>
                      <option value="Belarus">Belarus</option>
                      <option value="Belgium">Belgium</option>
                      <option value="Belize">Belize</option>
                      <option value="Benin">Benin</option>
                      <option value="Bermuda">Bermuda</option>
                      <option value="Bhutan">Bhutan</option>
                      <option value="Bolivia">Bolivia</option>
                      <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                      <option value="Botswana">Botswana</option>
                      <option value="Bouvet Island">Bouvet Island</option>
                      <option value="Brazil">Brazil</option>
                      <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                      <option value="Brunei Darussalam">Brunei Darussalam</option>
                      <option value="Bulgaria">Bulgaria</option>
                      <option value="Burkina Faso">Burkina Faso</option>
                      <option value="Burundi">Burundi</option>
                      <option value="Cambodia">Cambodia</option>
                      <option value="Cameroon">Cameroon</option>
                      <option value="Canada">Canada</option>
                      <option value="Cape Verde">Cape Verde</option>
                      <option value="Cayman Islands">Cayman Islands</option>
                      <option value="Central African Republic">Central African Republic</option>
                      <option value="Chad">Chad</option>
                      <option value="Chile">Chile</option>
                      <option value="China">China</option>
                      <option value="Christmas Island">Christmas Island</option>
                      <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                      <option value="Colombia">Colombia</option>
                      <option value="Comoros">Comoros</option>
                      <option value="Congo">Congo</option>
                      <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                      <option value="Cook Islands">Cook Islands</option>
                      <option value="Costa Rica">Costa Rica</option>
                      <option value="Cote D'ivoire">Cote D'ivoire</option>
                      <option value="Croatia">Croatia</option>
                      <option value="Cuba">Cuba</option>
                      <option value="Cyprus">Cyprus</option>
                      <option value="Czech Republic">Czech Republic</option>
                      <option value="Denmark">Denmark</option>
                      <option value="Djibouti">Djibouti</option>
                      <option value="Dominica">Dominica</option>
                      <option value="Dominican Republic">Dominican Republic</option>
                      <option value="Ecuador">Ecuador</option>
                      <option value="Egypt">Egypt</option>
                      <option value="El Salvador">El Salvador</option>
                      <option value="Equatorial Guinea">Equatorial Guinea</option>
                      <option value="Eritrea">Eritrea</option>
                      <option value="Estonia">Estonia</option>
                      <option value="Ethiopia">Ethiopia</option>
                      <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                      <option value="Faroe Islands">Faroe Islands</option>
                      <option value="Fiji">Fiji</option>
                      <option value="Finland">Finland</option>
                      <option value="France">France</option>
                      <option value="French Guiana">French Guiana</option>
                      <option value="French Polynesia">French Polynesia</option>
                      <option value="French Southern Territories">French Southern Territories</option>
                      <option value="Gabon">Gabon</option>
                      <option value="Gambia">Gambia</option>
                      <option value="Georgia">Georgia</option>
                      <option value="Germany">Germany</option>
                      <option value="Ghana">Ghana</option>
                      <option value="Gibraltar">Gibraltar</option>
                      <option value="Greece">Greece</option>
                      <option value="Greenland">Greenland</option>
                      <option value="Grenada">Grenada</option>
                      <option value="Guadeloupe">Guadeloupe</option>
                      <option value="Guam">Guam</option>
                      <option value="Guatemala">Guatemala</option>
                      <option value="Guinea">Guinea</option>
                      <option value="Guinea-bissau">Guinea-bissau</option>
                      <option value="Guyana">Guyana</option>
                      <option value="Haiti">Haiti</option>
                      <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                      <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                      <option value="Honduras">Honduras</option>
                      <option value="Hong Kong">Hong Kong</option>
                      <option value="Hungary">Hungary</option>
                      <option value="Iceland">Iceland</option>
                      <option value="India">India</option>
                      <option value="Indonesia">Indonesia</option>
                      <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                      <option value="Iraq">Iraq</option>
                      <option value="Ireland">Ireland</option>
                      <option value="Israel">Israel</option>
                      <option value="Italy">Italy</option>
                      <option value="Jamaica">Jamaica</option>
                      <option value="Japan">Japan</option>
                      <option value="Jordan">Jordan</option>
                      <option value="Kazakhstan">Kazakhstan</option>
                      <option value="Kenya">Kenya</option>
                      <option value="Kiribati">Kiribati</option>
                      <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                      <option value="Korea, Republic of">Korea, Republic of</option>
                      <option value="Kuwait">Kuwait</option>
                      <option value="Kyrgyzstan">Kyrgyzstan</option>
                      <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                      <option value="Latvia">Latvia</option>
                      <option value="Lebanon">Lebanon</option>
                      <option value="Lesotho">Lesotho</option>
                      <option value="Liberia">Liberia</option>
                      <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                      <option value="Liechtenstein">Liechtenstein</option>
                      <option value="Lithuania">Lithuania</option>
                      <option value="Luxembourg">Luxembourg</option>
                      <option value="Macao">Macao</option>
                      <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                      <option value="Madagascar">Madagascar</option>
                      <option value="Malawi">Malawi</option>
                      <option value="Malaysia">Malaysia</option>
                      <option value="Maldives">Maldives</option>
                      <option value="Mali">Mali</option>
                      <option value="Malta">Malta</option>
                      <option value="Marshall Islands">Marshall Islands</option>
                      <option value="Martinique">Martinique</option>
                      <option value="Mauritania">Mauritania</option>
                      <option value="Mauritius">Mauritius</option>
                      <option value="Mayotte">Mayotte</option>
                      <option value="Mexico">Mexico</option>
                      <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                      <option value="Moldova, Republic of">Moldova, Republic of</option>
                      <option value="Monaco">Monaco</option>
                      <option value="Mongolia">Mongolia</option>
                      <option value="Montserrat">Montserrat</option>
                      <option value="Morocco">Morocco</option>
                      <option value="Mozambique">Mozambique</option>
                      <option value="Myanmar">Myanmar</option>
                      <option value="Namibia">Namibia</option>
                      <option value="Nauru">Nauru</option>
                      <option value="Nepal">Nepal</option>
                      <option value="Netherlands">Netherlands</option>
                      <option value="Netherlands Antilles">Netherlands Antilles</option>
                      <option value="New Caledonia">New Caledonia</option>
                      <option value="New Zealand">New Zealand</option>
                      <option value="Nicaragua">Nicaragua</option>
                      <option value="Niger">Niger</option>
                      <option value="Nigeria">Nigeria</option>
                      <option value="Niue">Niue</option>
                      <option value="Norfolk Island">Norfolk Island</option>
                      <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                      <option value="Norway">Norway</option>
                      <option value="Oman">Oman</option>
                      <option value="Pakistan">Pakistan</option>
                      <option value="Palau">Palau</option>
                      <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                      <option value="Panama">Panama</option>
                      <option value="Papua New Guinea">Papua New Guinea</option>
                      <option value="Paraguay">Paraguay</option>
                      <option value="Peru">Peru</option>
                      <option value="Philippines">Philippines</option>
                      <option value="Pitcairn">Pitcairn</option>
                      <option value="Poland">Poland</option>
                      <option value="Portugal">Portugal</option>
                      <option value="Puerto Rico">Puerto Rico</option>
                      <option value="Qatar">Qatar</option>
                      <option value="Reunion">Reunion</option>
                      <option value="Romania">Romania</option>
                      <option value="Russian Federation">Russian Federation</option>
                      <option value="Rwanda">Rwanda</option>
                      <option value="Saint Helena">Saint Helena</option>
                      <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                      <option value="Saint Lucia">Saint Lucia</option>
                      <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                      <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                      <option value="Samoa">Samoa</option>
                      <option value="San Marino">San Marino</option>
                      <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                      <option value="Saudi Arabia">Saudi Arabia</option>
                      <option value="Senegal">Senegal</option>
                      <option value="Serbia and Montenegro">Serbia and Montenegro</option>
                      <option value="Seychelles">Seychelles</option>
                      <option value="Sierra Leone">Sierra Leone</option>
                      <option value="Singapore">Singapore</option>
                      <option value="Slovakia">Slovakia</option>
                      <option value="Slovenia">Slovenia</option>
                      <option value="Solomon Islands">Solomon Islands</option>
                      <option value="Somalia">Somalia</option>
                      <option value="South Africa">South Africa</option>
                      <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                      <option value="Spain">Spain</option>
                      <option value="Sri Lanka">Sri Lanka</option>
                      <option value="Sudan">Sudan</option>
                      <option value="Suriname">Suriname</option>
                      <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                      <option value="Swaziland">Swaziland</option>
                      <option value="Sweden">Sweden</option>
                      <option value="Switzerland">Switzerland</option>
                      <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                      <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                      <option value="Tajikistan">Tajikistan</option>
                      <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                      <option value="Thailand">Thailand</option>
                      <option value="Timor-leste">Timor-leste</option>
                      <option value="Togo">Togo</option>
                      <option value="Tokelau">Tokelau</option>
                      <option value="Tonga">Tonga</option>
                      <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                      <option value="Tunisia">Tunisia</option>
                      <option value="Turkey">Turkey</option>
                      <option value="Turkmenistan">Turkmenistan</option>
                      <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                      <option value="Tuvalu">Tuvalu</option>
                      <option value="Uganda">Uganda</option>
                      <option value="Ukraine">Ukraine</option>
                      <option value="United Arab Emirates">United Arab Emirates</option>
                      <option value="United Kingdom">United Kingdom</option>
                      <option value="United States">United States</option>
                      <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                      <option value="Uruguay">Uruguay</option>
                      <option value="Uzbekistan">Uzbekistan</option>
                      <option value="Vanuatu">Vanuatu</option>
                      <option value="Venezuela">Venezuela</option>
                      <option value="Viet Nam">Viet Nam</option>
                      <option value="Virgin Islands, British">Virgin Islands, British</option>
                      <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                      <option value="Wallis and Futuna">Wallis and Futuna</option>
                      <option value="Western Sahara">Western Sahara</option>
                      <option value="Yemen">Yemen</option>
                      <option value="Zambia">Zambia</option>
                      <option value="Zimbabwe">Zimbabwe</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>DOB</label>
                    <div class="input-group">
                      <input type="text" class="form-control input-sm datepicker" id="dob" name="dob">
                      <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                        <label>Mobile Number (Primary)</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <select class="form-control required input-sm" id="countrycode1" name="countrycode1">
                          <option>Select</option>
                          <option value="1">USA (+1)</option>
                          <option value="213">Algeria (+213)</option>
                          <option value="376">Andorra (+376)</option>
                          <option value="244">Angola (+244)</option>
                          <option value="1264">Anguilla (+1264)</option>
                          <option value="1268">Antigua &amp; Barbuda (+1268)</option>
                          <option value="599">Antilles (Dutch) (+599)</option>
                          <option value="54">Argentina (+54)</option>
                          <option value="374">Armenia (+374)</option>
                          <option value="297">Aruba (+297)</option>
                          <option value="247">Ascension Island (+247)</option>
                          <option value="61">Australia (+61)</option>
                          <option value="43">Austria (+43)</option>
                          <option value="994">Azerbaijan (+994)</option>
                          <option value="1242">Bahamas (+1242)</option>
                          <option value="973">Bahrain (+973)</option>
                          <option value="880">Bangladesh (+880)</option>
                          <option value="1246">Barbados (+1246)</option>
                          <option value="375">Belarus (+375)</option>
                          <option value="32">Belgium (+32)</option>
                          <option value="501">Belize (+501)</option>
                          <option value="229">Benin (+229)</option>
                          <option value="1441">Bermuda (+1441)</option>
                          <option value="975">Bhutan (+975)</option>
                          <option value="591">Bolivia (+591)</option>
                          <option value="387">Bosnia Herzegovina (+387)</option>
                          <option value="267">Botswana (+267)</option>
                          <option value="55">Brazil (+55)</option>
                          <option value="673">Brunei (+673)</option>
                          <option value="359">Bulgaria (+359)</option>
                          <option value="226">Burkina Faso (+226)</option>
                          <option value="257">Burundi (+257)</option>
                          <option value="855">Cambodia (+855)</option>
                          <option value="237">Cameroon (+237)</option>
                          <option value="1">Canada (+1)</option>
                          <option value="238">Cape Verde Islands (+238)</option>
                          <option value="1345">Cayman Islands (+1345)</option>
                          <option value="236">Central African Republic (+236)</option>
                          <option value="56">Chile (+56)</option>
                          <option value="86">China (+86)</option>
                          <option value="57">Colombia (+57)</option>
                          <option value="269">Comoros (+269)</option>
                          <option value="242">Congo (+242)</option>
                          <option value="682">Cook Islands (+682)</option>
                          <option value="506">Costa Rica (+506)</option>
                          <option value="385">Croatia (+385)</option>
                          <option value="53">Cuba (+53)</option>
                          <option value="90392">Cyprus North (+90392)</option>
                          <option value="357">Cyprus South (+357)</option>
                          <option value="42">Czech Republic (+42)</option>
                          <option value="45">Denmark (+45)</option>
                          <option value="2463">Diego Garcia (+2463)</option>
                          <option value="253">Djibouti (+253)</option>
                          <option value="1809">Dominica (+1809)</option>
                          <option value="1809">Dominican Republic (+1809)</option>
                          <option value="593">Ecuador (+593)</option>
                          <option value="20">Egypt (+20)</option>
                          <option value="353">Eire (+353)</option>
                          <option value="503">El Salvador (+503)</option>
                          <option value="240">Equatorial Guinea (+240)</option>
                          <option value="291">Eritrea (+291)</option>
                          <option value="372">Estonia (+372)</option>
                          <option value="251">Ethiopia (+251)</option>
                          <option value="500">Falkland Islands (+500)</option>
                          <option value="298">Faroe Islands (+298)</option>
                          <option value="679">Fiji (+679)</option>
                          <option value="358">Finland (+358)</option>
                          <option value="33">France (+33)</option>
                          <option value="594">French Guiana (+594)</option>
                          <option value="689">French Polynesia (+689)</option>
                          <option value="241">Gabon (+241)</option>
                          <option value="220">Gambia (+220)</option>
                          <option value="7880">Georgia (+7880)</option>
                          <option value="49">Germany (+49)</option>
                          <option value="233">Ghana (+233)</option>
                          <option value="350">Gibraltar (+350)</option>
                          <option value="30">Greece (+30)</option>
                          <option value="299">Greenland (+299)</option>
                          <option value="1473">Grenada (+1473)</option>
                          <option value="590">Guadeloupe (+590)</option>
                          <option value="671">Guam (+671)</option>
                          <option value="502">Guatemala (+502)</option>
                          <option value="224">Guinea (+224)</option>
                          <option value="245">Guinea - Bissau (+245)</option>
                          <option value="592">Guyana (+592)</option>
                          <option value="509">Haiti (+509)</option>
                          <option value="504">Honduras (+504)</option>
                          <option value="852">Hong Kong (+852)</option>
                          <option value="36">Hungary (+36)</option>
                          <option value="354">Iceland (+354)</option>
                          <option value="91">India (+91)</option>
                          <option value="62">Indonesia (+62)</option>
                          <option value="98">Iran (+98)</option>
                          <option value="964">Iraq (+964)</option>
                          <option value="972">Israel (+972)</option>
                          <option value="39">Italy (+39)</option>
                          <option value="225">Ivory Coast (+225)</option>
                          <option value="1876">Jamaica (+1876)</option>
                          <option value="81">Japan (+81)</option>
                          <option value="962">Jordan (+962)</option>
                          <option value="7">Kazakhstan (+7)</option>
                          <option value="254">Kenya (+254)</option>
                          <option value="686">Kiribati (+686)</option>
                          <option value="850">Korea North (+850)</option>
                          <option value="82">Korea South (+82)</option>
                          <option value="965">Kuwait (+965)</option>
                          <option value="996">Kyrgyzstan (+996)</option>
                          <option value="856">Laos (+856)</option>
                          <option value="371">Latvia (+371)</option>
                          <option value="961">Lebanon (+961)</option>
                          <option value="266">Lesotho (+266)</option>
                          <option value="231">Liberia (+231)</option>
                          <option value="218">Libya (+218)</option>
                          <option value="417">Liechtenstein (+417)</option>
                          <option value="370">Lithuania (+370)</option>
                          <option value="352">Luxembourg (+352)</option>
                          <option value="853">Macao (+853)</option>
                          <option value="389">Macedonia (+389)</option>
                          <option value="261">Madagascar (+261)</option>
                          <option value="265">Malawi (+265)</option>
                          <option value="60">Malaysia (+60)</option>
                          <option value="960">Maldives (+960)</option>
                          <option value="223">Mali (+223)</option>
                          <option value="356">Malta (+356)</option>
                          <option value="692">Marshall Islands (+692)</option>
                          <option value="596">Martinique (+596)</option>
                          <option value="222">Mauritania (+222)</option>
                          <option value="269">Mayotte (+269)</option>
                          <option value="52">Mexico (+52)</option>
                          <option value="691">Micronesia (+691)</option>
                          <option value="373">Moldova (+373)</option>
                          <option value="377">Monaco (+377)</option>
                          <option value="976">Mongolia (+976)</option>
                          <option value="1664">Montserrat (+1664)</option>
                          <option value="212">Morocco (+212)</option>
                          <option value="258">Mozambique (+258)</option>
                          <option value="95">Myanmar (+95)</option>
                          <option value="264">Namibia (+264)</option>
                          <option value="674">Nauru (+674)</option>
                          <option value="977">Nepal (+977)</option>
                          <option value="31">Netherlands (+31)</option>
                          <option value="687">New Caledonia (+687)</option>
                          <option value="64">New Zealand (+64)</option>
                          <option value="505">Nicaragua (+505)</option>
                          <option value="227">Niger (+227)</option>
                          <option value="234">Nigeria (+234)</option>
                          <option value="683">Niue (+683)</option>
                          <option value="672">Norfolk Islands (+672)</option>
                          <option value="670">Northern Marianas (+670)</option>
                          <option value="47">Norway (+47)</option>
                          <option value="968">Oman (+968)</option>
                          <option value="92">Pakistan (+92)</option>
                          <option value="680">Palau (+680)</option>
                          <option value="507">Panama (+507)</option>
                          <option value="675">Papua New Guinea (+675)</option>
                          <option value="595">Paraguay (+595)</option>
                          <option value="51">Peru (+51)</option>
                          <option value="63">Philippines (+63)</option>
                          <option value="48">Poland (+48)</option>
                          <option value="351">Portugal (+351)</option>
                          <option value="1787">Puerto Rico (+1787)</option>
                          <option value="974">Qatar (+974)</option>
                          <option value="262">Reunion (+262)</option>
                          <option value="40">Romania (+40)</option>
                          <option value="7">Russia (+7)</option>
                          <option value="250">Rwanda (+250)</option>
                          <option value="378">San Marino (+378)</option>
                          <option value="239">Sao Tome &amp; Principe (+239)</option>
                          <option value="966">Saudi Arabia (+966)</option>
                          <option value="221">Senegal (+221)</option>
                          <option value="381">Serbia (+381)</option>
                          <option value="248">Seychelles (+248)</option>
                          <option value="232">Sierra Leone (+232)</option>
                          <option value="65">Singapore (+65)</option>
                          <option value="421">Slovak Republic (+421)</option>
                          <option value="386">Slovenia (+386)</option>
                          <option value="677">Solomon Islands (+677)</option>
                          <option value="252">Somalia (+252)</option>
                          <option value="27">South Africa (+27)</option>
                          <option value="34">Spain (+34)</option>
                          <option value="94">Sri Lanka (+94)</option>
                          <option value="290">St. Helena (+290)</option>
                          <option value="1869">St. Kitts (+1869)</option>
                          <option value="1758">St. Lucia (+1758)</option>
                          <option value="249">Sudan (+249)</option>
                          <option value="597">Suriname (+597)</option>
                          <option value="268">Swaziland (+268)</option>
                          <option value="46">Sweden (+46)</option>
                          <option value="41">Switzerland (+41)</option>
                          <option value="963">Syria (+963)</option>
                          <option value="886">Taiwan (+886)</option>
                          <option value="7">Tajikstan (+7)</option>
                          <option value="66">Thailand (+66)</option>
                          <option value="228">Togo (+228)</option>
                          <option value="676">Tonga (+676)</option>
                          <option value="1868">Trinidad &amp; Tobago (+1868)</option>
                          <option value="216">Tunisia (+216)</option>
                          <option value="90">Turkey (+90)</option>
                          <option value="7">Turkmenistan (+7)</option>
                          <option value="993">Turkmenistan (+993)</option>
                          <option value="1649">Turks &amp; Caicos Islands (+1649)</option>
                          <option value="688">Tuvalu (+688)</option>
                          <option value="256">Uganda (+256)</option>
                          <option value="44">UK (+44)</option>
                          <option value="380">Ukraine (+380)</option>
                          <option value="971" selected="selected">United Arab Emirates (+971)</option>
                          <option value="598">Uruguay (+598)</option>
                          <option value="1">USA (+1)</option>
                          <option value="7">Uzbekistan (+7)</option>
                          <option value="678">Vanuatu (+678)</option>
                          <option value="379">Vatican City (+379)</option>
                          <option value="58">Venezuela (+58)</option>
                          <option value="84">Vietnam (+84)</option>
                          <option value="84">Virgin Islands - British (+1284)</option>
                          <option value="84">Virgin Islands - US (+1340)</option>
                          <option value="681">Wallis &amp; Futuna (+681)</option>
                          <option value="969">Yemen (North)(+969)</option>
                          <option value="967">Yemen (South)(+967)</option>
                          <option value="381">Yugoslavia (+381)</option>
                          <option value="243">Zaire (+243)</option>
                          <option value="260">Zambia (+260)</option>
                          <option value="263">Zimbabwe (+263)</option>
                        </select>
                      </div>
                      <div class="col-md-9">
                        <input type="text" class="form-control input-sm" placeholder="mobile number" id="mobilenumber1" name="mobilenumber1">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                        <label>Mobile Number (Secondary)</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <select class="form-control required input-sm" id="countrycode2" name="countrycode2">
                          <option>Select</option>
                          <option value="1">USA (+1)</option>
                          <option value="213">Algeria (+213)</option>
                          <option value="376">Andorra (+376)</option>
                          <option value="244">Angola (+244)</option>
                          <option value="1264">Anguilla (+1264)</option>
                          <option value="1268">Antigua &amp; Barbuda (+1268)</option>
                          <option value="599">Antilles (Dutch) (+599)</option>
                          <option value="54">Argentina (+54)</option>
                          <option value="374">Armenia (+374)</option>
                          <option value="297">Aruba (+297)</option>
                          <option value="247">Ascension Island (+247)</option>
                          <option value="61">Australia (+61)</option>
                          <option value="43">Austria (+43)</option>
                          <option value="994">Azerbaijan (+994)</option>
                          <option value="1242">Bahamas (+1242)</option>
                          <option value="973">Bahrain (+973)</option>
                          <option value="880">Bangladesh (+880)</option>
                          <option value="1246">Barbados (+1246)</option>
                          <option value="375">Belarus (+375)</option>
                          <option value="32">Belgium (+32)</option>
                          <option value="501">Belize (+501)</option>
                          <option value="229">Benin (+229)</option>
                          <option value="1441">Bermuda (+1441)</option>
                          <option value="975">Bhutan (+975)</option>
                          <option value="591">Bolivia (+591)</option>
                          <option value="387">Bosnia Herzegovina (+387)</option>
                          <option value="267">Botswana (+267)</option>
                          <option value="55">Brazil (+55)</option>
                          <option value="673">Brunei (+673)</option>
                          <option value="359">Bulgaria (+359)</option>
                          <option value="226">Burkina Faso (+226)</option>
                          <option value="257">Burundi (+257)</option>
                          <option value="855">Cambodia (+855)</option>
                          <option value="237">Cameroon (+237)</option>
                          <option value="1">Canada (+1)</option>
                          <option value="238">Cape Verde Islands (+238)</option>
                          <option value="1345">Cayman Islands (+1345)</option>
                          <option value="236">Central African Republic (+236)</option>
                          <option value="56">Chile (+56)</option>
                          <option value="86">China (+86)</option>
                          <option value="57">Colombia (+57)</option>
                          <option value="269">Comoros (+269)</option>
                          <option value="242">Congo (+242)</option>
                          <option value="682">Cook Islands (+682)</option>
                          <option value="506">Costa Rica (+506)</option>
                          <option value="385">Croatia (+385)</option>
                          <option value="53">Cuba (+53)</option>
                          <option value="90392">Cyprus North (+90392)</option>
                          <option value="357">Cyprus South (+357)</option>
                          <option value="42">Czech Republic (+42)</option>
                          <option value="45">Denmark (+45)</option>
                          <option value="2463">Diego Garcia (+2463)</option>
                          <option value="253">Djibouti (+253)</option>
                          <option value="1809">Dominica (+1809)</option>
                          <option value="1809">Dominican Republic (+1809)</option>
                          <option value="593">Ecuador (+593)</option>
                          <option value="20">Egypt (+20)</option>
                          <option value="353">Eire (+353)</option>
                          <option value="503">El Salvador (+503)</option>
                          <option value="240">Equatorial Guinea (+240)</option>
                          <option value="291">Eritrea (+291)</option>
                          <option value="372">Estonia (+372)</option>
                          <option value="251">Ethiopia (+251)</option>
                          <option value="500">Falkland Islands (+500)</option>
                          <option value="298">Faroe Islands (+298)</option>
                          <option value="679">Fiji (+679)</option>
                          <option value="358">Finland (+358)</option>
                          <option value="33">France (+33)</option>
                          <option value="594">French Guiana (+594)</option>
                          <option value="689">French Polynesia (+689)</option>
                          <option value="241">Gabon (+241)</option>
                          <option value="220">Gambia (+220)</option>
                          <option value="7880">Georgia (+7880)</option>
                          <option value="49">Germany (+49)</option>
                          <option value="233">Ghana (+233)</option>
                          <option value="350">Gibraltar (+350)</option>
                          <option value="30">Greece (+30)</option>
                          <option value="299">Greenland (+299)</option>
                          <option value="1473">Grenada (+1473)</option>
                          <option value="590">Guadeloupe (+590)</option>
                          <option value="671">Guam (+671)</option>
                          <option value="502">Guatemala (+502)</option>
                          <option value="224">Guinea (+224)</option>
                          <option value="245">Guinea - Bissau (+245)</option>
                          <option value="592">Guyana (+592)</option>
                          <option value="509">Haiti (+509)</option>
                          <option value="504">Honduras (+504)</option>
                          <option value="852">Hong Kong (+852)</option>
                          <option value="36">Hungary (+36)</option>
                          <option value="354">Iceland (+354)</option>
                          <option value="91">India (+91)</option>
                          <option value="62">Indonesia (+62)</option>
                          <option value="98">Iran (+98)</option>
                          <option value="964">Iraq (+964)</option>
                          <option value="972">Israel (+972)</option>
                          <option value="39">Italy (+39)</option>
                          <option value="225">Ivory Coast (+225)</option>
                          <option value="1876">Jamaica (+1876)</option>
                          <option value="81">Japan (+81)</option>
                          <option value="962">Jordan (+962)</option>
                          <option value="7">Kazakhstan (+7)</option>
                          <option value="254">Kenya (+254)</option>
                          <option value="686">Kiribati (+686)</option>
                          <option value="850">Korea North (+850)</option>
                          <option value="82">Korea South (+82)</option>
                          <option value="965">Kuwait (+965)</option>
                          <option value="996">Kyrgyzstan (+996)</option>
                          <option value="856">Laos (+856)</option>
                          <option value="371">Latvia (+371)</option>
                          <option value="961">Lebanon (+961)</option>
                          <option value="266">Lesotho (+266)</option>
                          <option value="231">Liberia (+231)</option>
                          <option value="218">Libya (+218)</option>
                          <option value="417">Liechtenstein (+417)</option>
                          <option value="370">Lithuania (+370)</option>
                          <option value="352">Luxembourg (+352)</option>
                          <option value="853">Macao (+853)</option>
                          <option value="389">Macedonia (+389)</option>
                          <option value="261">Madagascar (+261)</option>
                          <option value="265">Malawi (+265)</option>
                          <option value="60">Malaysia (+60)</option>
                          <option value="960">Maldives (+960)</option>
                          <option value="223">Mali (+223)</option>
                          <option value="356">Malta (+356)</option>
                          <option value="692">Marshall Islands (+692)</option>
                          <option value="596">Martinique (+596)</option>
                          <option value="222">Mauritania (+222)</option>
                          <option value="269">Mayotte (+269)</option>
                          <option value="52">Mexico (+52)</option>
                          <option value="691">Micronesia (+691)</option>
                          <option value="373">Moldova (+373)</option>
                          <option value="377">Monaco (+377)</option>
                          <option value="976">Mongolia (+976)</option>
                          <option value="1664">Montserrat (+1664)</option>
                          <option value="212">Morocco (+212)</option>
                          <option value="258">Mozambique (+258)</option>
                          <option value="95">Myanmar (+95)</option>
                          <option value="264">Namibia (+264)</option>
                          <option value="674">Nauru (+674)</option>
                          <option value="977">Nepal (+977)</option>
                          <option value="31">Netherlands (+31)</option>
                          <option value="687">New Caledonia (+687)</option>
                          <option value="64">New Zealand (+64)</option>
                          <option value="505">Nicaragua (+505)</option>
                          <option value="227">Niger (+227)</option>
                          <option value="234">Nigeria (+234)</option>
                          <option value="683">Niue (+683)</option>
                          <option value="672">Norfolk Islands (+672)</option>
                          <option value="670">Northern Marianas (+670)</option>
                          <option value="47">Norway (+47)</option>
                          <option value="968">Oman (+968)</option>
                          <option value="92">Pakistan (+92)</option>
                          <option value="680">Palau (+680)</option>
                          <option value="507">Panama (+507)</option>
                          <option value="675">Papua New Guinea (+675)</option>
                          <option value="595">Paraguay (+595)</option>
                          <option value="51">Peru (+51)</option>
                          <option value="63">Philippines (+63)</option>
                          <option value="48">Poland (+48)</option>
                          <option value="351">Portugal (+351)</option>
                          <option value="1787">Puerto Rico (+1787)</option>
                          <option value="974">Qatar (+974)</option>
                          <option value="262">Reunion (+262)</option>
                          <option value="40">Romania (+40)</option>
                          <option value="7">Russia (+7)</option>
                          <option value="250">Rwanda (+250)</option>
                          <option value="378">San Marino (+378)</option>
                          <option value="239">Sao Tome &amp; Principe (+239)</option>
                          <option value="966">Saudi Arabia (+966)</option>
                          <option value="221">Senegal (+221)</option>
                          <option value="381">Serbia (+381)</option>
                          <option value="248">Seychelles (+248)</option>
                          <option value="232">Sierra Leone (+232)</option>
                          <option value="65">Singapore (+65)</option>
                          <option value="421">Slovak Republic (+421)</option>
                          <option value="386">Slovenia (+386)</option>
                          <option value="677">Solomon Islands (+677)</option>
                          <option value="252">Somalia (+252)</option>
                          <option value="27">South Africa (+27)</option>
                          <option value="34">Spain (+34)</option>
                          <option value="94">Sri Lanka (+94)</option>
                          <option value="290">St. Helena (+290)</option>
                          <option value="1869">St. Kitts (+1869)</option>
                          <option value="1758">St. Lucia (+1758)</option>
                          <option value="249">Sudan (+249)</option>
                          <option value="597">Suriname (+597)</option>
                          <option value="268">Swaziland (+268)</option>
                          <option value="46">Sweden (+46)</option>
                          <option value="41">Switzerland (+41)</option>
                          <option value="963">Syria (+963)</option>
                          <option value="886">Taiwan (+886)</option>
                          <option value="7">Tajikstan (+7)</option>
                          <option value="66">Thailand (+66)</option>
                          <option value="228">Togo (+228)</option>
                          <option value="676">Tonga (+676)</option>
                          <option value="1868">Trinidad &amp; Tobago (+1868)</option>
                          <option value="216">Tunisia (+216)</option>
                          <option value="90">Turkey (+90)</option>
                          <option value="7">Turkmenistan (+7)</option>
                          <option value="993">Turkmenistan (+993)</option>
                          <option value="1649">Turks &amp; Caicos Islands (+1649)</option>
                          <option value="688">Tuvalu (+688)</option>
                          <option value="256">Uganda (+256)</option>
                          <option value="44">UK (+44)</option>
                          <option value="380">Ukraine (+380)</option>
                          <option value="971" selected="selected">United Arab Emirates (+971)</option>
                          <option value="598">Uruguay (+598)</option>
                          <option value="1">USA (+1)</option>
                          <option value="7">Uzbekistan (+7)</option>
                          <option value="678">Vanuatu (+678)</option>
                          <option value="379">Vatican City (+379)</option>
                          <option value="58">Venezuela (+58)</option>
                          <option value="84">Vietnam (+84)</option>
                          <option value="84">Virgin Islands - British (+1284)</option>
                          <option value="84">Virgin Islands - US (+1340)</option>
                          <option value="681">Wallis &amp; Futuna (+681)</option>
                          <option value="969">Yemen (North)(+969)</option>
                          <option value="967">Yemen (South)(+967)</option>
                          <option value="381">Yugoslavia (+381)</option>
                          <option value="243">Zaire (+243)</option>
                          <option value="260">Zambia (+260)</option>
                          <option value="263">Zimbabwe (+263)</option>
                        </select>
                      </div>
                      <div class="col-md-9">
                        <input type="text" class="form-control input-sm" placeholder="mobile number" id="mobilenumber2" name="mobilenumber2">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-4">
                        <label>Home Number</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <select class="form-control required input-sm" id="countrycode3" name="countrycode3">
                          <option>Select</option>
                          <option value="1">USA (+1)</option>
                          <option value="213">Algeria (+213)</option>
                          <option value="376">Andorra (+376)</option>
                          <option value="244">Angola (+244)</option>
                          <option value="1264">Anguilla (+1264)</option>
                          <option value="1268">Antigua &amp; Barbuda (+1268)</option>
                          <option value="599">Antilles (Dutch) (+599)</option>
                          <option value="54">Argentina (+54)</option>
                          <option value="374">Armenia (+374)</option>
                          <option value="297">Aruba (+297)</option>
                          <option value="247">Ascension Island (+247)</option>
                          <option value="61">Australia (+61)</option>
                          <option value="43">Austria (+43)</option>
                          <option value="994">Azerbaijan (+994)</option>
                          <option value="1242">Bahamas (+1242)</option>
                          <option value="973">Bahrain (+973)</option>
                          <option value="880">Bangladesh (+880)</option>
                          <option value="1246">Barbados (+1246)</option>
                          <option value="375">Belarus (+375)</option>
                          <option value="32">Belgium (+32)</option>
                          <option value="501">Belize (+501)</option>
                          <option value="229">Benin (+229)</option>
                          <option value="1441">Bermuda (+1441)</option>
                          <option value="975">Bhutan (+975)</option>
                          <option value="591">Bolivia (+591)</option>
                          <option value="387">Bosnia Herzegovina (+387)</option>
                          <option value="267">Botswana (+267)</option>
                          <option value="55">Brazil (+55)</option>
                          <option value="673">Brunei (+673)</option>
                          <option value="359">Bulgaria (+359)</option>
                          <option value="226">Burkina Faso (+226)</option>
                          <option value="257">Burundi (+257)</option>
                          <option value="855">Cambodia (+855)</option>
                          <option value="237">Cameroon (+237)</option>
                          <option value="1">Canada (+1)</option>
                          <option value="238">Cape Verde Islands (+238)</option>
                          <option value="1345">Cayman Islands (+1345)</option>
                          <option value="236">Central African Republic (+236)</option>
                          <option value="56">Chile (+56)</option>
                          <option value="86">China (+86)</option>
                          <option value="57">Colombia (+57)</option>
                          <option value="269">Comoros (+269)</option>
                          <option value="242">Congo (+242)</option>
                          <option value="682">Cook Islands (+682)</option>
                          <option value="506">Costa Rica (+506)</option>
                          <option value="385">Croatia (+385)</option>
                          <option value="53">Cuba (+53)</option>
                          <option value="90392">Cyprus North (+90392)</option>
                          <option value="357">Cyprus South (+357)</option>
                          <option value="42">Czech Republic (+42)</option>
                          <option value="45">Denmark (+45)</option>
                          <option value="2463">Diego Garcia (+2463)</option>
                          <option value="253">Djibouti (+253)</option>
                          <option value="1809">Dominica (+1809)</option>
                          <option value="1809">Dominican Republic (+1809)</option>
                          <option value="593">Ecuador (+593)</option>
                          <option value="20">Egypt (+20)</option>
                          <option value="353">Eire (+353)</option>
                          <option value="503">El Salvador (+503)</option>
                          <option value="240">Equatorial Guinea (+240)</option>
                          <option value="291">Eritrea (+291)</option>
                          <option value="372">Estonia (+372)</option>
                          <option value="251">Ethiopia (+251)</option>
                          <option value="500">Falkland Islands (+500)</option>
                          <option value="298">Faroe Islands (+298)</option>
                          <option value="679">Fiji (+679)</option>
                          <option value="358">Finland (+358)</option>
                          <option value="33">France (+33)</option>
                          <option value="594">French Guiana (+594)</option>
                          <option value="689">French Polynesia (+689)</option>
                          <option value="241">Gabon (+241)</option>
                          <option value="220">Gambia (+220)</option>
                          <option value="7880">Georgia (+7880)</option>
                          <option value="49">Germany (+49)</option>
                          <option value="233">Ghana (+233)</option>
                          <option value="350">Gibraltar (+350)</option>
                          <option value="30">Greece (+30)</option>
                          <option value="299">Greenland (+299)</option>
                          <option value="1473">Grenada (+1473)</option>
                          <option value="590">Guadeloupe (+590)</option>
                          <option value="671">Guam (+671)</option>
                          <option value="502">Guatemala (+502)</option>
                          <option value="224">Guinea (+224)</option>
                          <option value="245">Guinea - Bissau (+245)</option>
                          <option value="592">Guyana (+592)</option>
                          <option value="509">Haiti (+509)</option>
                          <option value="504">Honduras (+504)</option>
                          <option value="852">Hong Kong (+852)</option>
                          <option value="36">Hungary (+36)</option>
                          <option value="354">Iceland (+354)</option>
                          <option value="91">India (+91)</option>
                          <option value="62">Indonesia (+62)</option>
                          <option value="98">Iran (+98)</option>
                          <option value="964">Iraq (+964)</option>
                          <option value="972">Israel (+972)</option>
                          <option value="39">Italy (+39)</option>
                          <option value="225">Ivory Coast (+225)</option>
                          <option value="1876">Jamaica (+1876)</option>
                          <option value="81">Japan (+81)</option>
                          <option value="962">Jordan (+962)</option>
                          <option value="7">Kazakhstan (+7)</option>
                          <option value="254">Kenya (+254)</option>
                          <option value="686">Kiribati (+686)</option>
                          <option value="850">Korea North (+850)</option>
                          <option value="82">Korea South (+82)</option>
                          <option value="965">Kuwait (+965)</option>
                          <option value="996">Kyrgyzstan (+996)</option>
                          <option value="856">Laos (+856)</option>
                          <option value="371">Latvia (+371)</option>
                          <option value="961">Lebanon (+961)</option>
                          <option value="266">Lesotho (+266)</option>
                          <option value="231">Liberia (+231)</option>
                          <option value="218">Libya (+218)</option>
                          <option value="417">Liechtenstein (+417)</option>
                          <option value="370">Lithuania (+370)</option>
                          <option value="352">Luxembourg (+352)</option>
                          <option value="853">Macao (+853)</option>
                          <option value="389">Macedonia (+389)</option>
                          <option value="261">Madagascar (+261)</option>
                          <option value="265">Malawi (+265)</option>
                          <option value="60">Malaysia (+60)</option>
                          <option value="960">Maldives (+960)</option>
                          <option value="223">Mali (+223)</option>
                          <option value="356">Malta (+356)</option>
                          <option value="692">Marshall Islands (+692)</option>
                          <option value="596">Martinique (+596)</option>
                          <option value="222">Mauritania (+222)</option>
                          <option value="269">Mayotte (+269)</option>
                          <option value="52">Mexico (+52)</option>
                          <option value="691">Micronesia (+691)</option>
                          <option value="373">Moldova (+373)</option>
                          <option value="377">Monaco (+377)</option>
                          <option value="976">Mongolia (+976)</option>
                          <option value="1664">Montserrat (+1664)</option>
                          <option value="212">Morocco (+212)</option>
                          <option value="258">Mozambique (+258)</option>
                          <option value="95">Myanmar (+95)</option>
                          <option value="264">Namibia (+264)</option>
                          <option value="674">Nauru (+674)</option>
                          <option value="977">Nepal (+977)</option>
                          <option value="31">Netherlands (+31)</option>
                          <option value="687">New Caledonia (+687)</option>
                          <option value="64">New Zealand (+64)</option>
                          <option value="505">Nicaragua (+505)</option>
                          <option value="227">Niger (+227)</option>
                          <option value="234">Nigeria (+234)</option>
                          <option value="683">Niue (+683)</option>
                          <option value="672">Norfolk Islands (+672)</option>
                          <option value="670">Northern Marianas (+670)</option>
                          <option value="47">Norway (+47)</option>
                          <option value="968">Oman (+968)</option>
                          <option value="92">Pakistan (+92)</option>
                          <option value="680">Palau (+680)</option>
                          <option value="507">Panama (+507)</option>
                          <option value="675">Papua New Guinea (+675)</option>
                          <option value="595">Paraguay (+595)</option>
                          <option value="51">Peru (+51)</option>
                          <option value="63">Philippines (+63)</option>
                          <option value="48">Poland (+48)</option>
                          <option value="351">Portugal (+351)</option>
                          <option value="1787">Puerto Rico (+1787)</option>
                          <option value="974">Qatar (+974)</option>
                          <option value="262">Reunion (+262)</option>
                          <option value="40">Romania (+40)</option>
                          <option value="7">Russia (+7)</option>
                          <option value="250">Rwanda (+250)</option>
                          <option value="378">San Marino (+378)</option>
                          <option value="239">Sao Tome &amp; Principe (+239)</option>
                          <option value="966">Saudi Arabia (+966)</option>
                          <option value="221">Senegal (+221)</option>
                          <option value="381">Serbia (+381)</option>
                          <option value="248">Seychelles (+248)</option>
                          <option value="232">Sierra Leone (+232)</option>
                          <option value="65">Singapore (+65)</option>
                          <option value="421">Slovak Republic (+421)</option>
                          <option value="386">Slovenia (+386)</option>
                          <option value="677">Solomon Islands (+677)</option>
                          <option value="252">Somalia (+252)</option>
                          <option value="27">South Africa (+27)</option>
                          <option value="34">Spain (+34)</option>
                          <option value="94">Sri Lanka (+94)</option>
                          <option value="290">St. Helena (+290)</option>
                          <option value="1869">St. Kitts (+1869)</option>
                          <option value="1758">St. Lucia (+1758)</option>
                          <option value="249">Sudan (+249)</option>
                          <option value="597">Suriname (+597)</option>
                          <option value="268">Swaziland (+268)</option>
                          <option value="46">Sweden (+46)</option>
                          <option value="41">Switzerland (+41)</option>
                          <option value="963">Syria (+963)</option>
                          <option value="886">Taiwan (+886)</option>
                          <option value="7">Tajikstan (+7)</option>
                          <option value="66">Thailand (+66)</option>
                          <option value="228">Togo (+228)</option>
                          <option value="676">Tonga (+676)</option>
                          <option value="1868">Trinidad &amp; Tobago (+1868)</option>
                          <option value="216">Tunisia (+216)</option>
                          <option value="90">Turkey (+90)</option>
                          <option value="7">Turkmenistan (+7)</option>
                          <option value="993">Turkmenistan (+993)</option>
                          <option value="1649">Turks &amp; Caicos Islands (+1649)</option>
                          <option value="688">Tuvalu (+688)</option>
                          <option value="256">Uganda (+256)</option>
                          <option value="44">UK (+44)</option>
                          <option value="380">Ukraine (+380)</option>
                          <option value="971" selected="selected">United Arab Emirates (+971)</option>
                          <option value="598">Uruguay (+598)</option>
                          <option value="1">USA (+1)</option>
                          <option value="7">Uzbekistan (+7)</option>
                          <option value="678">Vanuatu (+678)</option>
                          <option value="379">Vatican City (+379)</option>
                          <option value="58">Venezuela (+58)</option>
                          <option value="84">Vietnam (+84)</option>
                          <option value="84">Virgin Islands - British (+1284)</option>
                          <option value="84">Virgin Islands - US (+1340)</option>
                          <option value="681">Wallis &amp; Futuna (+681)</option>
                          <option value="969">Yemen (North)(+969)</option>
                          <option value="967">Yemen (South)(+967)</option>
                          <option value="381">Yugoslavia (+381)</option>
                          <option value="243">Zaire (+243)</option>
                          <option value="260">Zambia (+260)</option>
                          <option value="263">Zimbabwe (+263)</option>
                        </select>
                      </div>
                      <div class="col-md-9">
                        <input type="text" class="form-control input-sm" placeholder="home number" id="mobilenumber3" name="mobilenumber3">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control input-sm" id="email" name="email">
                  </div>
                  <div class="clear">
                  </div>
                </div>
              </div>
              <!-- row -->

              <!-- to fix overflow issue -->
            </form>
          </div>

          <div role="tabpanel" class="tab-pane" id="selectLandlord">
            <table id="tblLandlords" aria-describedby="dataTables-current-listing_info" class="table table-striped table-hover datatables datatable-setbotclass dataTable no-footer">
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
                      First Name
                    </div>
                  </th>
                  <th>
                    <div style="cursor:pointer;" title="Click here to sort">
                      Last Name
                    </div>
                  </th>
                  <th>
                    <div style="cursor:pointer;" title="Click here to sort">
                      Mobile Number
                    </div>
                  </th>
                  <th>
                    <div style="cursor:pointer;" title="Click here to sort">
                      DOB
                    </div>
                  </th>
                  <th>
                    <div style="cursor:pointer;" title="Click here to sort">
                      Email
                    </div>
                  </th>
                  <th>
                    <div style="cursor:pointer; white-space:nowrap;" title="Click here to sort">
                      Nationality
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

      <div class="modal-footer">
        <button type="button" id="btnSelectLandlord" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Save &amp; Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal for selecting Services Provider -->
<div class="modal fade" id="serviceproviderSelector" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Select Service Provider</h4>
      </div>

      <div class="modal-body">

        <div class="tab-content tab-white">
          <div>
            <!-- <input style="width:226px" class="form-control input-sm search_init" type='text' id='txtSmartSearch_Tenants' placeholder="Search here" /> -->
          </div>
          <table id="tblServiceProviders" aria-describedby="dataTables-current-listing_info" class="table table-striped table-hover datatables datatable-setbotclass dataTable no-footer">
            <thead class="listing_headings">
              <tr>
                <th>
                  <!-- <label class=""><input id='CheckAllListings' class='CheckAll' onclick="toggleChecked()" type="checkbox" value=''>
                  <span class="lbl"></span></label> -->
                </th>
                <th>
                  <div style="cursor:pointer;min-width:50px;" title="Click here to sort">
                    Ref
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
                    Address
                  </div>
                </th>
                <th>
                  <div style="cursor:pointer;" title="Click here to sort">
                    Contact Name
                  </div>
                </th>
                <th>
                  <div style="cursor:pointer; white-space:nowrap;" title="Click here to sort">
                    Mobile Number
                  </div>
                </th>
                <th>
                  <div style="cursor:pointer; white-space:nowrap;" title="Click here to sort">
                    Email
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

      <div class="modal-footer">
        <button id="btnSelectServiceProvider" class="btn btn-success" data-dismiss="modal" type="button">
          <i class="fa fa-check"></i> Select this unit
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Modal for viewing all leases -->
<div class="modal fade" id="leases" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">All Leases</h4>
      </div>
      <div class="modal-body">
        <div class="tab-content tab-white datatable-Scrolltab">
          <div style="">
            <!-- <input style="width:300px" class="form-control input-sm search_init" type='text' id='txtSmartSearch_leases' placeholder="Search here" /> -->
          </div>
          <table id="tblLeases" aria-describedby="dataTables-current-listing_info" class="table table-striped table-hover datatables datatable-setbotclass dataTable no-footer">
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
                  <div style="cursor:pointer;min-width:50px;" title="Click here to sort">
                    Tenant
                  </div>
                </th>
                <th>
                  <div style="cursor:pointer;" title="Click here to sort">
                    Tenant Email
                  </div>
                </th>
                <th>
                  <div style="cursor:pointer;" title="Click here to sort">
                    Landlord
                  </div>
                </th>
                <th>
                  <div style="cursor:pointer;" title="Click here to sort">
                    Next Available
                  </div>
                </th>
                <th>
                  <div style="cursor:pointer; white-space:nowrap;" title="Click here to sort">
                    Property Manager
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
</div>

<!-- Modal for viewing all leases -->
<div class="modal fade" id="workorders" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">All Work Orders</h4>
      </div>
      <div class="modal-body">
        <div class="tab-content tab-white">
          <div style="Save Report">
            <!-- <input style="width:300px" class="form-control input-sm search_init" type='text' id='txtSmartSearch_workorders' placeholder="Search here" /> -->
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
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
 
<div class="modal fade" id="unitNotes" tabindex="-1">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
        <form method="post" action="" id="upload_file" enctype="multipart/form-data">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <label id="modaltitle">
            <h4 class="modal-title">Attachments<br/><small>Enter a note or upload a document</small></h4>
          </label>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <h4>Notes</h4>
              <div>
                <textarea id="taNotes" name="note" class="form-control"></textarea> 
              </div>  
            </div>
            <div class="col-md-6">
              <h4>Documents</h4>
              <input type="text" class="form-control" id="txtDocumentTitle" name="title" placeholder="Enter document name (optional)">
              <br/>
              
              <div class="input-group">
                <span class="input-group-btn">
                  <label class="btn btn-primary btn-file" for="multiple_input_group">
                    <div class="input required">
                      <input id="multiple_input_group" type="file" name="attachment" multiple>
                    </div> Browse
                  </label>
                </span>
                <span class="file-input-label"></span>
              </div>
              
            </div>
          </div>        
        </div>
        <div class="modal-footer">
          <input data-dismiss="modal" type="submit" id="btnSaveAttachments" class="btn btn-info" onClick="return ajaxFileUpload() " value="Save &amp; Close"/><!-- <i class="fa fa-check"></i> </input> -->
        </div>
      </form>
    </div>
  </div>
</div>

<!-- 
          <button data-dismiss="modal" type="button" id="btnSaveAttachments" class="btn btn-info"><i class="fa fa-check"></i> Save &amp; Close</button>

<div class="form-group">
  Additional Information
  
  <div class="row">
<div class="col-sm-12">
      <button class="btn btn-primary btn-block"><i class="fa fa-eye"></i> View attachments</button>
    </div>
  
  </div>
</div> -->

<!--                   <div class="col-md-10" id='rgroup_listingtype'>
                    <div class="row">
                      <div class="col-md-2">
                        <label>
                          <h5 class="text-primary">Listing Type</h5> </label>
                        </div>
                        <div class="col-md-2">
                          <label>
                            <input type="radio" name="listtype" value='0' class="ListingType" checked>
                            <span class="lbl padding">Both</span>
                          </label>
                        </div>
                        <div class="col-md-2">
                          <label>
                            <input type="radio" name="listtype" value='1' class="ListingType">
                            <span class="lbl padding">Rentals</span>
                          </label>
                        </div>
                        <div class="col-md-2">
                          <label>
                            <input type="radio" name="listtype" value='2' class="ListingType">
                            <span class="lbl padding">Sales</span>
                          </label>
                        </div>
                      </div>
                    </div> -->

                  <!-- Modal for Add/Edit Landlord  -->
                    <!-- 
                  <div class="modal fade" id="landlordModal" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <label id="modaltitle">
                            <h4 class="modal-title">Add Landlord Information</h4>
                          </label>
                        </div>
                        <div class="modal-body">
                          <div class="tab-content tab-nopadding">
                            <div role="tabpanel" class="tab-pane active" id="addnewunit">
                              <form id="frm_landlord">
                                <input type="hidden" id="id" name="id" value="0" />
                                <input type="hidden" id="rand_key" name="rand_key" value="" />
                                <input type="hidden" id="ref" name="ref" value="" />
                                <input type="hidden" id="dateadded" name="dateadded" value="" />
                                <input type="hidden" id="created_by" name="created_by" value="" />
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label>Ref</label>
                                      <input type="text" class="form-control input-sm" readonly="" id="ref" name="ref">
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Salutation</label>
                                          <select class="form-control required input-sm" id="salutation" name="salutation">
                                            <option value="">Select</option>
                                            <option value="1">Mr.</option>
                                            <option value="2">Ms.</option>
                                            <option value="3">Mrs.</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Title</label>
                                          <select class="form-control required input-sm" id="title" name="title">
                                            <option value="">Select</option>
                                            <option value="1">Sheikh</option>
                                            <option value="2">Engr.</option>
                                            <option value="3">Dr.</option>
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label>First Name</label>
                                      <input type="text" class="form-control input-sm" id="firstname" name="firstname">
                                    </div>
                                    <div class="form-group">
                                      <label>Last Name</label>
                                      <input type="text" class="form-control input-sm" id="lastname" name="lastname">
                                    </div>
                                    <div class="form-group">
                                      <label>Nationality</label>
                                      <select required="" class="form-control required input-sm" id="nationality" name="nationality">
                                        <option value="">Please select</option>
                                        <option value="" selected="selected">Select Nationality</option>
                                        <option value="Afghanistan">Afghanistan</option>
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                        <option value="American Samoa">American Samoa</option>
                                        <option value="Andorra">Andorra</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Anguilla">Anguilla</option>
                                        <option value="Antarctica">Antarctica</option>
                                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Armenia">Armenia</option>
                                        <option value="Aruba">Aruba</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Austria">Austria</option>
                                        <option value="Azerbaijan">Azerbaijan</option>
                                        <option value="Bahamas">Bahamas</option>
                                        <option value="Bahrain">Bahrain</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Barbados">Barbados</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Belgium">Belgium</option>
                                        <option value="Belize">Belize</option>
                                        <option value="Benin">Benin</option>
                                        <option value="Bermuda">Bermuda</option>
                                        <option value="Bhutan">Bhutan</option>
                                        <option value="Bolivia">Bolivia</option>
                                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                        <option value="Botswana">Botswana</option>
                                        <option value="Bouvet Island">Bouvet Island</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                                        <option value="Bulgaria">Bulgaria</option>
                                        <option value="Burkina Faso">Burkina Faso</option>
                                        <option value="Burundi">Burundi</option>
                                        <option value="Cambodia">Cambodia</option>
                                        <option value="Cameroon">Cameroon</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Cape Verde">Cape Verde</option>
                                        <option value="Cayman Islands">Cayman Islands</option>
                                        <option value="Central African Republic">Central African Republic</option>
                                        <option value="Chad">Chad</option>
                                        <option value="Chile">Chile</option>
                                        <option value="China">China</option>
                                        <option value="Christmas Island">Christmas Island</option>
                                        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                        <option value="Colombia">Colombia</option>
                                        <option value="Comoros">Comoros</option>
                                        <option value="Congo">Congo</option>
                                        <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                        <option value="Cook Islands">Cook Islands</option>
                                        <option value="Costa Rica">Costa Rica</option>
                                        <option value="Cote D'ivoire">Cote D'ivoire</option>
                                        <option value="Croatia">Croatia</option>
                                        <option value="Cuba">Cuba</option>
                                        <option value="Cyprus">Cyprus</option>
                                        <option value="Czech Republic">Czech Republic</option>
                                        <option value="Denmark">Denmark</option>
                                        <option value="Djibouti">Djibouti</option>
                                        <option value="Dominica">Dominica</option>
                                        <option value="Dominican Republic">Dominican Republic</option>
                                        <option value="Ecuador">Ecuador</option>
                                        <option value="Egypt">Egypt</option>
                                        <option value="El Salvador">El Salvador</option>
                                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                                        <option value="Eritrea">Eritrea</option>
                                        <option value="Estonia">Estonia</option>
                                        <option value="Ethiopia">Ethiopia</option>
                                        <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                        <option value="Faroe Islands">Faroe Islands</option>
                                        <option value="Fiji">Fiji</option>
                                        <option value="Finland">Finland</option>
                                        <option value="France">France</option>
                                        <option value="French Guiana">French Guiana</option>
                                        <option value="French Polynesia">French Polynesia</option>
                                        <option value="French Southern Territories">French Southern Territories</option>
                                        <option value="Gabon">Gabon</option>
                                        <option value="Gambia">Gambia</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Germany">Germany</option>
                                        <option value="Ghana">Ghana</option>
                                        <option value="Gibraltar">Gibraltar</option>
                                        <option value="Greece">Greece</option>
                                        <option value="Greenland">Greenland</option>
                                        <option value="Grenada">Grenada</option>
                                        <option value="Guadeloupe">Guadeloupe</option>
                                        <option value="Guam">Guam</option>
                                        <option value="Guatemala">Guatemala</option>
                                        <option value="Guinea">Guinea</option>
                                        <option value="Guinea-bissau">Guinea-bissau</option>
                                        <option value="Guyana">Guyana</option>
                                        <option value="Haiti">Haiti</option>
                                        <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                        <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                        <option value="Honduras">Honduras</option>
                                        <option value="Hong Kong">Hong Kong</option>
                                        <option value="Hungary">Hungary</option>
                                        <option value="Iceland">Iceland</option>
                                        <option value="India">India</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                        <option value="Iraq">Iraq</option>
                                        <option value="Ireland">Ireland</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Jamaica">Jamaica</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Jordan">Jordan</option>
                                        <option value="Kazakhstan">Kazakhstan</option>
                                        <option value="Kenya">Kenya</option>
                                        <option value="Kiribati">Kiribati</option>
                                        <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                        <option value="Korea, Republic of">Korea, Republic of</option>
                                        <option value="Kuwait">Kuwait</option>
                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                        <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                        <option value="Latvia">Latvia</option>
                                        <option value="Lebanon">Lebanon</option>
                                        <option value="Lesotho">Lesotho</option>
                                        <option value="Liberia">Liberia</option>
                                        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                        <option value="Liechtenstein">Liechtenstein</option>
                                        <option value="Lithuania">Lithuania</option>
                                        <option value="Luxembourg">Luxembourg</option>
                                        <option value="Macao">Macao</option>
                                        <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                        <option value="Madagascar">Madagascar</option>
                                        <option value="Malawi">Malawi</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="Maldives">Maldives</option>
                                        <option value="Mali">Mali</option>
                                        <option value="Malta">Malta</option>
                                        <option value="Marshall Islands">Marshall Islands</option>
                                        <option value="Martinique">Martinique</option>
                                        <option value="Mauritania">Mauritania</option>
                                        <option value="Mauritius">Mauritius</option>
                                        <option value="Mayotte">Mayotte</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                        <option value="Moldova, Republic of">Moldova, Republic of</option>
                                        <option value="Monaco">Monaco</option>
                                        <option value="Mongolia">Mongolia</option>
                                        <option value="Montserrat">Montserrat</option>
                                        <option value="Morocco">Morocco</option>
                                        <option value="Mozambique">Mozambique</option>
                                        <option value="Myanmar">Myanmar</option>
                                        <option value="Namibia">Namibia</option>
                                        <option value="Nauru">Nauru</option>
                                        <option value="Nepal">Nepal</option>
                                        <option value="Netherlands">Netherlands</option>
                                        <option value="Netherlands Antilles">Netherlands Antilles</option>
                                        <option value="New Caledonia">New Caledonia</option>
                                        <option value="New Zealand">New Zealand</option>
                                        <option value="Nicaragua">Nicaragua</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Nigeria">Nigeria</option>
                                        <option value="Niue">Niue</option>
                                        <option value="Norfolk Island">Norfolk Island</option>
                                        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                        <option value="Norway">Norway</option>
                                        <option value="Oman">Oman</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="Palau">Palau</option>
                                        <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                        <option value="Panama">Panama</option>
                                        <option value="Papua New Guinea">Papua New Guinea</option>
                                        <option value="Paraguay">Paraguay</option>
                                        <option value="Peru">Peru</option>
                                        <option value="Philippines">Philippines</option>
                                        <option value="Pitcairn">Pitcairn</option>
                                        <option value="Poland">Poland</option>
                                        <option value="Portugal">Portugal</option>
                                        <option value="Puerto Rico">Puerto Rico</option>
                                        <option value="Qatar">Qatar</option>
                                        <option value="Reunion">Reunion</option>
                                        <option value="Romania">Romania</option>
                                        <option value="Russian Federation">Russian Federation</option>
                                        <option value="Rwanda">Rwanda</option>
                                        <option value="Saint Helena">Saint Helena</option>
                                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                        <option value="Saint Lucia">Saint Lucia</option>
                                        <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                        <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                        <option value="Samoa">Samoa</option>
                                        <option value="San Marino">San Marino</option>
                                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                        <option value="Senegal">Senegal</option>
                                        <option value="Serbia and Montenegro">Serbia and Montenegro</option>
                                        <option value="Seychelles">Seychelles</option>
                                        <option value="Sierra Leone">Sierra Leone</option>
                                        <option value="Singapore">Singapore</option>
                                        <option value="Slovakia">Slovakia</option>
                                        <option value="Slovenia">Slovenia</option>
                                        <option value="Solomon Islands">Solomon Islands</option>
                                        <option value="Somalia">Somalia</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                        <option value="Spain">Spain</option>
                                        <option value="Sri Lanka">Sri Lanka</option>
                                        <option value="Sudan">Sudan</option>
                                        <option value="Suriname">Suriname</option>
                                        <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                        <option value="Swaziland">Swaziland</option>
                                        <option value="Sweden">Sweden</option>
                                        <option value="Switzerland">Switzerland</option>
                                        <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                        <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                        <option value="Tajikistan">Tajikistan</option>
                                        <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Timor-leste">Timor-leste</option>
                                        <option value="Togo">Togo</option>
                                        <option value="Tokelau">Tokelau</option>
                                        <option value="Tonga">Tonga</option>
                                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                        <option value="Tunisia">Tunisia</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Turkmenistan">Turkmenistan</option>
                                        <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                        <option value="Tuvalu">Tuvalu</option>
                                        <option value="Uganda">Uganda</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="United States">United States</option>
                                        <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                        <option value="Uruguay">Uruguay</option>
                                        <option value="Uzbekistan">Uzbekistan</option>
                                        <option value="Vanuatu">Vanuatu</option>
                                        <option value="Venezuela">Venezuela</option>
                                        <option value="Viet Nam">Viet Nam</option>
                                        <option value="Virgin Islands, British">Virgin Islands, British</option>
                                        <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                        <option value="Wallis and Futuna">Wallis and Futuna</option>
                                        <option value="Western Sahara">Western Sahara</option>
                                        <option value="Yemen">Yemen</option>
                                        <option value="Zambia">Zambia</option>
                                        <option value="Zimbabwe">Zimbabwe</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label>DOB</label>
                                      <div class="input-group">
                                        <input type="text" class="form-control input-sm datepicker" id="dob" name="dob">
                                        <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <div class="row">
                                        <div class="col-md-6">
                                          <label>Mobile Number (Primary)</label>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-3">
                                          <select class="form-control required input-sm" id="countrycode1" name="countrycode1">
                                            <option>Select</option>
                                            <option value="1">USA (+1)</option>
                                            <option value="213">Algeria (+213)</option>
                                            <option value="376">Andorra (+376)</option>
                                            <option value="244">Angola (+244)</option>
                                            <option value="1264">Anguilla (+1264)</option>
                                            <option value="1268">Antigua &amp; Barbuda (+1268)</option>
                                            <option value="599">Antilles (Dutch) (+599)</option>
                                            <option value="54">Argentina (+54)</option>
                                            <option value="374">Armenia (+374)</option>
                                            <option value="297">Aruba (+297)</option>
                                            <option value="247">Ascension Island (+247)</option>
                                            <option value="61">Australia (+61)</option>
                                            <option value="43">Austria (+43)</option>
                                            <option value="994">Azerbaijan (+994)</option>
                                            <option value="1242">Bahamas (+1242)</option>
                                            <option value="973">Bahrain (+973)</option>
                                            <option value="880">Bangladesh (+880)</option>
                                            <option value="1246">Barbados (+1246)</option>
                                            <option value="375">Belarus (+375)</option>
                                            <option value="32">Belgium (+32)</option>
                                            <option value="501">Belize (+501)</option>
                                            <option value="229">Benin (+229)</option>
                                            <option value="1441">Bermuda (+1441)</option>
                                            <option value="975">Bhutan (+975)</option>
                                            <option value="591">Bolivia (+591)</option>
                                            <option value="387">Bosnia Herzegovina (+387)</option>
                                            <option value="267">Botswana (+267)</option>
                                            <option value="55">Brazil (+55)</option>
                                            <option value="673">Brunei (+673)</option>
                                            <option value="359">Bulgaria (+359)</option>
                                            <option value="226">Burkina Faso (+226)</option>
                                            <option value="257">Burundi (+257)</option>
                                            <option value="855">Cambodia (+855)</option>
                                            <option value="237">Cameroon (+237)</option>
                                            <option value="1">Canada (+1)</option>
                                            <option value="238">Cape Verde Islands (+238)</option>
                                            <option value="1345">Cayman Islands (+1345)</option>
                                            <option value="236">Central African Republic (+236)</option>
                                            <option value="56">Chile (+56)</option>
                                            <option value="86">China (+86)</option>
                                            <option value="57">Colombia (+57)</option>
                                            <option value="269">Comoros (+269)</option>
                                            <option value="242">Congo (+242)</option>
                                            <option value="682">Cook Islands (+682)</option>
                                            <option value="506">Costa Rica (+506)</option>
                                            <option value="385">Croatia (+385)</option>
                                            <option value="53">Cuba (+53)</option>
                                            <option value="90392">Cyprus North (+90392)</option>
                                            <option value="357">Cyprus South (+357)</option>
                                            <option value="42">Czech Republic (+42)</option>
                                            <option value="45">Denmark (+45)</option>
                                            <option value="2463">Diego Garcia (+2463)</option>
                                            <option value="253">Djibouti (+253)</option>
                                            <option value="1809">Dominica (+1809)</option>
                                            <option value="1809">Dominican Republic (+1809)</option>
                                            <option value="593">Ecuador (+593)</option>
                                            <option value="20">Egypt (+20)</option>
                                            <option value="353">Eire (+353)</option>
                                            <option value="503">El Salvador (+503)</option>
                                            <option value="240">Equatorial Guinea (+240)</option>
                                            <option value="291">Eritrea (+291)</option>
                                            <option value="372">Estonia (+372)</option>
                                            <option value="251">Ethiopia (+251)</option>
                                            <option value="500">Falkland Islands (+500)</option>
                                            <option value="298">Faroe Islands (+298)</option>
                                            <option value="679">Fiji (+679)</option>
                                            <option value="358">Finland (+358)</option>
                                            <option value="33">France (+33)</option>
                                            <option value="594">French Guiana (+594)</option>
                                            <option value="689">French Polynesia (+689)</option>
                                            <option value="241">Gabon (+241)</option>
                                            <option value="220">Gambia (+220)</option>
                                            <option value="7880">Georgia (+7880)</option>
                                            <option value="49">Germany (+49)</option>
                                            <option value="233">Ghana (+233)</option>
                                            <option value="350">Gibraltar (+350)</option>
                                            <option value="30">Greece (+30)</option>
                                            <option value="299">Greenland (+299)</option>
                                            <option value="1473">Grenada (+1473)</option>
                                            <option value="590">Guadeloupe (+590)</option>
                                            <option value="671">Guam (+671)</option>
                                            <option value="502">Guatemala (+502)</option>
                                            <option value="224">Guinea (+224)</option>
                                            <option value="245">Guinea - Bissau (+245)</option>
                                            <option value="592">Guyana (+592)</option>
                                            <option value="509">Haiti (+509)</option>
                                            <option value="504">Honduras (+504)</option>
                                            <option value="852">Hong Kong (+852)</option>
                                            <option value="36">Hungary (+36)</option>
                                            <option value="354">Iceland (+354)</option>
                                            <option value="91">India (+91)</option>
                                            <option value="62">Indonesia (+62)</option>
                                            <option value="98">Iran (+98)</option>
                                            <option value="964">Iraq (+964)</option>
                                            <option value="972">Israel (+972)</option>
                                            <option value="39">Italy (+39)</option>
                                            <option value="225">Ivory Coast (+225)</option>
                                            <option value="1876">Jamaica (+1876)</option>
                                            <option value="81">Japan (+81)</option>
                                            <option value="962">Jordan (+962)</option>
                                            <option value="7">Kazakhstan (+7)</option>
                                            <option value="254">Kenya (+254)</option>
                                            <option value="686">Kiribati (+686)</option>
                                            <option value="850">Korea North (+850)</option>
                                            <option value="82">Korea South (+82)</option>
                                            <option value="965">Kuwait (+965)</option>
                                            <option value="996">Kyrgyzstan (+996)</option>
                                            <option value="856">Laos (+856)</option>
                                            <option value="371">Latvia (+371)</option>
                                            <option value="961">Lebanon (+961)</option>
                                            <option value="266">Lesotho (+266)</option>
                                            <option value="231">Liberia (+231)</option>
                                            <option value="218">Libya (+218)</option>
                                            <option value="417">Liechtenstein (+417)</option>
                                            <option value="370">Lithuania (+370)</option>
                                            <option value="352">Luxembourg (+352)</option>
                                            <option value="853">Macao (+853)</option>
                                            <option value="389">Macedonia (+389)</option>
                                            <option value="261">Madagascar (+261)</option>
                                            <option value="265">Malawi (+265)</option>
                                            <option value="60">Malaysia (+60)</option>
                                            <option value="960">Maldives (+960)</option>
                                            <option value="223">Mali (+223)</option>
                                            <option value="356">Malta (+356)</option>
                                            <option value="692">Marshall Islands (+692)</option>
                                            <option value="596">Martinique (+596)</option>
                                            <option value="222">Mauritania (+222)</option>
                                            <option value="269">Mayotte (+269)</option>
                                            <option value="52">Mexico (+52)</option>
                                            <option value="691">Micronesia (+691)</option>
                                            <option value="373">Moldova (+373)</option>
                                            <option value="377">Monaco (+377)</option>
                                            <option value="976">Mongolia (+976)</option>
                                            <option value="1664">Montserrat (+1664)</option>
                                            <option value="212">Morocco (+212)</option>
                                            <option value="258">Mozambique (+258)</option>
                                            <option value="95">Myanmar (+95)</option>
                                            <option value="264">Namibia (+264)</option>
                                            <option value="674">Nauru (+674)</option>
                                            <option value="977">Nepal (+977)</option>
                                            <option value="31">Netherlands (+31)</option>
                                            <option value="687">New Caledonia (+687)</option>
                                            <option value="64">New Zealand (+64)</option>
                                            <option value="505">Nicaragua (+505)</option>
                                            <option value="227">Niger (+227)</option>
                                            <option value="234">Nigeria (+234)</option>
                                            <option value="683">Niue (+683)</option>
                                            <option value="672">Norfolk Islands (+672)</option>
                                            <option value="670">Northern Marianas (+670)</option>
                                            <option value="47">Norway (+47)</option>
                                            <option value="968">Oman (+968)</option>
                                            <option value="92">Pakistan (+92)</option>
                                            <option value="680">Palau (+680)</option>
                                            <option value="507">Panama (+507)</option>
                                            <option value="675">Papua New Guinea (+675)</option>
                                            <option value="595">Paraguay (+595)</option>
                                            <option value="51">Peru (+51)</option>
                                            <option value="63">Philippines (+63)</option>
                                            <option value="48">Poland (+48)</option>
                                            <option value="351">Portugal (+351)</option>
                                            <option value="1787">Puerto Rico (+1787)</option>
                                            <option value="974">Qatar (+974)</option>
                                            <option value="262">Reunion (+262)</option>
                                            <option value="40">Romania (+40)</option>
                                            <option value="7">Russia (+7)</option>
                                            <option value="250">Rwanda (+250)</option>
                                            <option value="378">San Marino (+378)</option>
                                            <option value="239">Sao Tome &amp; Principe (+239)</option>
                                            <option value="966">Saudi Arabia (+966)</option>
                                            <option value="221">Senegal (+221)</option>
                                            <option value="381">Serbia (+381)</option>
                                            <option value="248">Seychelles (+248)</option>
                                            <option value="232">Sierra Leone (+232)</option>
                                            <option value="65">Singapore (+65)</option>
                                            <option value="421">Slovak Republic (+421)</option>
                                            <option value="386">Slovenia (+386)</option>
                                            <option value="677">Solomon Islands (+677)</option>
                                            <option value="252">Somalia (+252)</option>
                                            <option value="27">South Africa (+27)</option>
                                            <option value="34">Spain (+34)</option>
                                            <option value="94">Sri Lanka (+94)</option>
                                            <option value="290">St. Helena (+290)</option>
                                            <option value="1869">St. Kitts (+1869)</option>
                                            <option value="1758">St. Lucia (+1758)</option>
                                            <option value="249">Sudan (+249)</option>
                                            <option value="597">Suriname (+597)</option>
                                            <option value="268">Swaziland (+268)</option>
                                            <option value="46">Sweden (+46)</option>
                                            <option value="41">Switzerland (+41)</option>
                                            <option value="963">Syria (+963)</option>
                                            <option value="886">Taiwan (+886)</option>
                                            <option value="7">Tajikstan (+7)</option>
                                            <option value="66">Thailand (+66)</option>
                                            <option value="228">Togo (+228)</option>
                                            <option value="676">Tonga (+676)</option>
                                            <option value="1868">Trinidad &amp; Tobago (+1868)</option>
                                            <option value="216">Tunisia (+216)</option>
                                            <option value="90">Turkey (+90)</option>
                                            <option value="7">Turkmenistan (+7)</option>
                                            <option value="993">Turkmenistan (+993)</option>
                                            <option value="1649">Turks &amp; Caicos Islands (+1649)</option>
                                            <option value="688">Tuvalu (+688)</option>
                                            <option value="256">Uganda (+256)</option>
                                            <option value="44">UK (+44)</option>
                                            <option value="380">Ukraine (+380)</option>
                                            <option value="971" selected="selected">United Arab Emirates (+971)</option>
                                            <option value="598">Uruguay (+598)</option>
                                            <option value="1">USA (+1)</option>
                                            <option value="7">Uzbekistan (+7)</option>
                                            <option value="678">Vanuatu (+678)</option>
                                            <option value="379">Vatican City (+379)</option>
                                            <option value="58">Venezuela (+58)</option>
                                            <option value="84">Vietnam (+84)</option>
                                            <option value="84">Virgin Islands - British (+1284)</option>
                                            <option value="84">Virgin Islands - US (+1340)</option>
                                            <option value="681">Wallis &amp; Futuna (+681)</option>
                                            <option value="969">Yemen (North)(+969)</option>
                                            <option value="967">Yemen (South)(+967)</option>
                                            <option value="381">Yugoslavia (+381)</option>
                                            <option value="243">Zaire (+243)</option>
                                            <option value="260">Zambia (+260)</option>
                                            <option value="263">Zimbabwe (+263)</option>
                                          </select>
                                        </div>
                                        <div class="col-md-9">
                                          <input type="text" class="form-control input-sm" placeholder="mobile number" id="mobilenumber1" name="mobilenumber1">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <div class="row">
                                        <div class="col-md-6">
                                          <label>Mobile Number (Secondary)</label>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-3">
                                          <select class="form-control required input-sm" id="countrycode2" name="countrycode2">
                                            <option>Select</option>
                                            <option value="1">USA (+1)</option>
                                            <option value="213">Algeria (+213)</option>
                                            <option value="376">Andorra (+376)</option>
                                            <option value="244">Angola (+244)</option>
                                            <option value="1264">Anguilla (+1264)</option>
                                            <option value="1268">Antigua &amp; Barbuda (+1268)</option>
                                            <option value="599">Antilles (Dutch) (+599)</option>
                                            <option value="54">Argentina (+54)</option>
                                            <option value="374">Armenia (+374)</option>
                                            <option value="297">Aruba (+297)</option>
                                            <option value="247">Ascension Island (+247)</option>
                                            <option value="61">Australia (+61)</option>
                                            <option value="43">Austria (+43)</option>
                                            <option value="994">Azerbaijan (+994)</option>
                                            <option value="1242">Bahamas (+1242)</option>
                                            <option value="973">Bahrain (+973)</option>
                                            <option value="880">Bangladesh (+880)</option>
                                            <option value="1246">Barbados (+1246)</option>
                                            <option value="375">Belarus (+375)</option>
                                            <option value="32">Belgium (+32)</option>
                                            <option value="501">Belize (+501)</option>
                                            <option value="229">Benin (+229)</option>
                                            <option value="1441">Bermuda (+1441)</option>
                                            <option value="975">Bhutan (+975)</option>
                                            <option value="591">Bolivia (+591)</option>
                                            <option value="387">Bosnia Herzegovina (+387)</option>
                                            <option value="267">Botswana (+267)</option>
                                            <option value="55">Brazil (+55)</option>
                                            <option value="673">Brunei (+673)</option>
                                            <option value="359">Bulgaria (+359)</option>
                                            <option value="226">Burkina Faso (+226)</option>
                                            <option value="257">Burundi (+257)</option>
                                            <option value="855">Cambodia (+855)</option>
                                            <option value="237">Cameroon (+237)</option>
                                            <option value="1">Canada (+1)</option>
                                            <option value="238">Cape Verde Islands (+238)</option>
                                            <option value="1345">Cayman Islands (+1345)</option>
                                            <option value="236">Central African Republic (+236)</option>
                                            <option value="56">Chile (+56)</option>
                                            <option value="86">China (+86)</option>
                                            <option value="57">Colombia (+57)</option>
                                            <option value="269">Comoros (+269)</option>
                                            <option value="242">Congo (+242)</option>
                                            <option value="682">Cook Islands (+682)</option>
                                            <option value="506">Costa Rica (+506)</option>
                                            <option value="385">Croatia (+385)</option>
                                            <option value="53">Cuba (+53)</option>
                                            <option value="90392">Cyprus North (+90392)</option>
                                            <option value="357">Cyprus South (+357)</option>
                                            <option value="42">Czech Republic (+42)</option>
                                            <option value="45">Denmark (+45)</option>
                                            <option value="2463">Diego Garcia (+2463)</option>
                                            <option value="253">Djibouti (+253)</option>
                                            <option value="1809">Dominica (+1809)</option>
                                            <option value="1809">Dominican Republic (+1809)</option>
                                            <option value="593">Ecuador (+593)</option>
                                            <option value="20">Egypt (+20)</option>
                                            <option value="353">Eire (+353)</option>
                                            <option value="503">El Salvador (+503)</option>
                                            <option value="240">Equatorial Guinea (+240)</option>
                                            <option value="291">Eritrea (+291)</option>
                                            <option value="372">Estonia (+372)</option>
                                            <option value="251">Ethiopia (+251)</option>
                                            <option value="500">Falkland Islands (+500)</option>
                                            <option value="298">Faroe Islands (+298)</option>
                                            <option value="679">Fiji (+679)</option>
                                            <option value="358">Finland (+358)</option>
                                            <option value="33">France (+33)</option>
                                            <option value="594">French Guiana (+594)</option>
                                            <option value="689">French Polynesia (+689)</option>
                                            <option value="241">Gabon (+241)</option>
                                            <option value="220">Gambia (+220)</option>
                                            <option value="7880">Georgia (+7880)</option>
                                            <option value="49">Germany (+49)</option>
                                            <option value="233">Ghana (+233)</option>
                                            <option value="350">Gibraltar (+350)</option>
                                            <option value="30">Greece (+30)</option>
                                            <option value="299">Greenland (+299)</option>
                                            <option value="1473">Grenada (+1473)</option>
                                            <option value="590">Guadeloupe (+590)</option>
                                            <option value="671">Guam (+671)</option>
                                            <option value="502">Guatemala (+502)</option>
                                            <option value="224">Guinea (+224)</option>
                                            <option value="245">Guinea - Bissau (+245)</option>
                                            <option value="592">Guyana (+592)</option>
                                            <option value="509">Haiti (+509)</option>
                                            <option value="504">Honduras (+504)</option>
                                            <option value="852">Hong Kong (+852)</option>
                                            <option value="36">Hungary (+36)</option>
                                            <option value="354">Iceland (+354)</option>
                                            <option value="91">India (+91)</option>
                                            <option value="62">Indonesia (+62)</option>
                                            <option value="98">Iran (+98)</option>
                                            <option value="964">Iraq (+964)</option>
                                            <option value="972">Israel (+972)</option>
                                            <option value="39">Italy (+39)</option>
                                            <option value="225">Ivory Coast (+225)</option>
                                            <option value="1876">Jamaica (+1876)</option>
                                            <option value="81">Japan (+81)</option>
                                            <option value="962">Jordan (+962)</option>
                                            <option value="7">Kazakhstan (+7)</option>
                                            <option value="254">Kenya (+254)</option>
                                            <option value="686">Kiribati (+686)</option>
                                            <option value="850">Korea North (+850)</option>
                                            <option value="82">Korea South (+82)</option>
                                            <option value="965">Kuwait (+965)</option>
                                            <option value="996">Kyrgyzstan (+996)</option>
                                            <option value="856">Laos (+856)</option>
                                            <option value="371">Latvia (+371)</option>
                                            <option value="961">Lebanon (+961)</option>
                                            <option value="266">Lesotho (+266)</option>
                                            <option value="231">Liberia (+231)</option>
                                            <option value="218">Libya (+218)</option>
                                            <option value="417">Liechtenstein (+417)</option>
                                            <option value="370">Lithuania (+370)</option>
                                            <option value="352">Luxembourg (+352)</option>
                                            <option value="853">Macao (+853)</option>
                                            <option value="389">Macedonia (+389)</option>
                                            <option value="261">Madagascar (+261)</option>
                                            <option value="265">Malawi (+265)</option>
                                            <option value="60">Malaysia (+60)</option>
                                            <option value="960">Maldives (+960)</option>
                                            <option value="223">Mali (+223)</option>
                                            <option value="356">Malta (+356)</option>
                                            <option value="692">Marshall Islands (+692)</option>
                                            <option value="596">Martinique (+596)</option>
                                            <option value="222">Mauritania (+222)</option>
                                            <option value="269">Mayotte (+269)</option>
                                            <option value="52">Mexico (+52)</option>
                                            <option value="691">Micronesia (+691)</option>
                                            <option value="373">Moldova (+373)</option>
                                            <option value="377">Monaco (+377)</option>
                                            <option value="976">Mongolia (+976)</option>
                                            <option value="1664">Montserrat (+1664)</option>
                                            <option value="212">Morocco (+212)</option>
                                            <option value="258">Mozambique (+258)</option>
                                            <option value="95">Myanmar (+95)</option>
                                            <option value="264">Namibia (+264)</option>
                                            <option value="674">Nauru (+674)</option>
                                            <option value="977">Nepal (+977)</option>
                                            <option value="31">Netherlands (+31)</option>
                                            <option value="687">New Caledonia (+687)</option>
                                            <option value="64">New Zealand (+64)</option>
                                            <option value="505">Nicaragua (+505)</option>
                                            <option value="227">Niger (+227)</option>
                                            <option value="234">Nigeria (+234)</option>
                                            <option value="683">Niue (+683)</option>
                                            <option value="672">Norfolk Islands (+672)</option>
                                            <option value="670">Northern Marianas (+670)</option>
                                            <option value="47">Norway (+47)</option>
                                            <option value="968">Oman (+968)</option>
                                            <option value="92">Pakistan (+92)</option>
                                            <option value="680">Palau (+680)</option>
                                            <option value="507">Panama (+507)</option>
                                            <option value="675">Papua New Guinea (+675)</option>
                                            <option value="595">Paraguay (+595)</option>
                                            <option value="51">Peru (+51)</option>
                                            <option value="63">Philippines (+63)</option>
                                            <option value="48">Poland (+48)</option>
                                            <option value="351">Portugal (+351)</option>
                                            <option value="1787">Puerto Rico (+1787)</option>
                                            <option value="974">Qatar (+974)</option>
                                            <option value="262">Reunion (+262)</option>
                                            <option value="40">Romania (+40)</option>
                                            <option value="7">Russia (+7)</option>
                                            <option value="250">Rwanda (+250)</option>
                                            <option value="378">San Marino (+378)</option>
                                            <option value="239">Sao Tome &amp; Principe (+239)</option>
                                            <option value="966">Saudi Arabia (+966)</option>
                                            <option value="221">Senegal (+221)</option>
                                            <option value="381">Serbia (+381)</option>
                                            <option value="248">Seychelles (+248)</option>
                                            <option value="232">Sierra Leone (+232)</option>
                                            <option value="65">Singapore (+65)</option>
                                            <option value="421">Slovak Republic (+421)</option>
                                            <option value="386">Slovenia (+386)</option>
                                            <option value="677">Solomon Islands (+677)</option>
                                            <option value="252">Somalia (+252)</option>
                                            <option value="27">South Africa (+27)</option>
                                            <option value="34">Spain (+34)</option>
                                            <option value="94">Sri Lanka (+94)</option>
                                            <option value="290">St. Helena (+290)</option>
                                            <option value="1869">St. Kitts (+1869)</option>
                                            <option value="1758">St. Lucia (+1758)</option>
                                            <option value="249">Sudan (+249)</option>
                                            <option value="597">Suriname (+597)</option>
                                            <option value="268">Swaziland (+268)</option>
                                            <option value="46">Sweden (+46)</option>
                                            <option value="41">Switzerland (+41)</option>
                                            <option value="963">Syria (+963)</option>
                                            <option value="886">Taiwan (+886)</option>
                                            <option value="7">Tajikstan (+7)</option>
                                            <option value="66">Thailand (+66)</option>
                                            <option value="228">Togo (+228)</option>
                                            <option value="676">Tonga (+676)</option>
                                            <option value="1868">Trinidad &amp; Tobago (+1868)</option>
                                            <option value="216">Tunisia (+216)</option>
                                            <option value="90">Turkey (+90)</option>
                                            <option value="7">Turkmenistan (+7)</option>
                                            <option value="993">Turkmenistan (+993)</option>
                                            <option value="1649">Turks &amp; Caicos Islands (+1649)</option>
                                            <option value="688">Tuvalu (+688)</option>
                                            <option value="256">Uganda (+256)</option>
                                            <option value="44">UK (+44)</option>
                                            <option value="380">Ukraine (+380)</option>
                                            <option value="971" selected="selected">United Arab Emirates (+971)</option>
                                            <option value="598">Uruguay (+598)</option>
                                            <option value="1">USA (+1)</option>
                                            <option value="7">Uzbekistan (+7)</option>
                                            <option value="678">Vanuatu (+678)</option>
                                            <option value="379">Vatican City (+379)</option>
                                            <option value="58">Venezuela (+58)</option>
                                            <option value="84">Vietnam (+84)</option>
                                            <option value="84">Virgin Islands - British (+1284)</option>
                                            <option value="84">Virgin Islands - US (+1340)</option>
                                            <option value="681">Wallis &amp; Futuna (+681)</option>
                                            <option value="969">Yemen (North)(+969)</option>
                                            <option value="967">Yemen (South)(+967)</option>
                                            <option value="381">Yugoslavia (+381)</option>
                                            <option value="243">Zaire (+243)</option>
                                            <option value="260">Zambia (+260)</option>
                                            <option value="263">Zimbabwe (+263)</option>
                                          </select>
                                        </div>
                                        <div class="col-md-9">
                                          <input type="text" class="form-control input-sm" placeholder="mobile number" id="mobilenumber2" name="mobilenumber2">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <div class="row">
                                        <div class="col-md-4">
                                          <label>Home Number</label>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-3">
                                          <select class="form-control required input-sm" id="countrycode3" name="countrycode3">
                                            <option>Select</option>
                                            <option value="1">USA (+1)</option>
                                            <option value="213">Algeria (+213)</option>
                                            <option value="376">Andorra (+376)</option>
                                            <option value="244">Angola (+244)</option>
                                            <option value="1264">Anguilla (+1264)</option>
                                            <option value="1268">Antigua &amp; Barbuda (+1268)</option>
                                            <option value="599">Antilles (Dutch) (+599)</option>
                                            <option value="54">Argentina (+54)</option>
                                            <option value="374">Armenia (+374)</option>
                                            <option value="297">Aruba (+297)</option>
                                            <option value="247">Ascension Island (+247)</option>
                                            <option value="61">Australia (+61)</option>
                                            <option value="43">Austria (+43)</option>
                                            <option value="994">Azerbaijan (+994)</option>
                                            <option value="1242">Bahamas (+1242)</option>
                                            <option value="973">Bahrain (+973)</option>
                                            <option value="880">Bangladesh (+880)</option>
                                            <option value="1246">Barbados (+1246)</option>
                                            <option value="375">Belarus (+375)</option>
                                            <option value="32">Belgium (+32)</option>
                                            <option value="501">Belize (+501)</option>
                                            <option value="229">Benin (+229)</option>
                                            <option value="1441">Bermuda (+1441)</option>
                                            <option value="975">Bhutan (+975)</option>
                                            <option value="591">Bolivia (+591)</option>
                                            <option value="387">Bosnia Herzegovina (+387)</option>
                                            <option value="267">Botswana (+267)</option>
                                            <option value="55">Brazil (+55)</option>
                                            <option value="673">Brunei (+673)</option>
                                            <option value="359">Bulgaria (+359)</option>
                                            <option value="226">Burkina Faso (+226)</option>
                                            <option value="257">Burundi (+257)</option>
                                            <option value="855">Cambodia (+855)</option>
                                            <option value="237">Cameroon (+237)</option>
                                            <option value="1">Canada (+1)</option>
                                            <option value="238">Cape Verde Islands (+238)</option>
                                            <option value="1345">Cayman Islands (+1345)</option>
                                            <option value="236">Central African Republic (+236)</option>
                                            <option value="56">Chile (+56)</option>
                                            <option value="86">China (+86)</option>
                                            <option value="57">Colombia (+57)</option>
                                            <option value="269">Comoros (+269)</option>
                                            <option value="242">Congo (+242)</option>
                                            <option value="682">Cook Islands (+682)</option>
                                            <option value="506">Costa Rica (+506)</option>
                                            <option value="385">Croatia (+385)</option>
                                            <option value="53">Cuba (+53)</option>
                                            <option value="90392">Cyprus North (+90392)</option>
                                            <option value="357">Cyprus South (+357)</option>
                                            <option value="42">Czech Republic (+42)</option>
                                            <option value="45">Denmark (+45)</option>
                                            <option value="2463">Diego Garcia (+2463)</option>
                                            <option value="253">Djibouti (+253)</option>
                                            <option value="1809">Dominica (+1809)</option>
                                            <option value="1809">Dominican Republic (+1809)</option>
                                            <option value="593">Ecuador (+593)</option>
                                            <option value="20">Egypt (+20)</option>
                                            <option value="353">Eire (+353)</option>
                                            <option value="503">El Salvador (+503)</option>
                                            <option value="240">Equatorial Guinea (+240)</option>
                                            <option value="291">Eritrea (+291)</option>
                                            <option value="372">Estonia (+372)</option>
                                            <option value="251">Ethiopia (+251)</option>
                                            <option value="500">Falkland Islands (+500)</option>
                                            <option value="298">Faroe Islands (+298)</option>
                                            <option value="679">Fiji (+679)</option>
                                            <option value="358">Finland (+358)</option>
                                            <option value="33">France (+33)</option>
                                            <option value="594">French Guiana (+594)</option>
                                            <option value="689">French Polynesia (+689)</option>
                                            <option value="241">Gabon (+241)</option>
                                            <option value="220">Gambia (+220)</option>
                                            <option value="7880">Georgia (+7880)</option>
                                            <option value="49">Germany (+49)</option>
                                            <option value="233">Ghana (+233)</option>
                                            <option value="350">Gibraltar (+350)</option>
                                            <option value="30">Greece (+30)</option>
                                            <option value="299">Greenland (+299)</option>
                                            <option value="1473">Grenada (+1473)</option>
                                            <option value="590">Guadeloupe (+590)</option>
                                            <option value="671">Guam (+671)</option>
                                            <option value="502">Guatemala (+502)</option>
                                            <option value="224">Guinea (+224)</option>
                                            <option value="245">Guinea - Bissau (+245)</option>
                                            <option value="592">Guyana (+592)</option>
                                            <option value="509">Haiti (+509)</option>
                                            <option value="504">Honduras (+504)</option>
                                            <option value="852">Hong Kong (+852)</option>
                                            <option value="36">Hungary (+36)</option>
                                            <option value="354">Iceland (+354)</option>
                                            <option value="91">India (+91)</option>
                                            <option value="62">Indonesia (+62)</option>
                                            <option value="98">Iran (+98)</option>
                                            <option value="964">Iraq (+964)</option>
                                            <option value="972">Israel (+972)</option>
                                            <option value="39">Italy (+39)</option>
                                            <option value="225">Ivory Coast (+225)</option>
                                            <option value="1876">Jamaica (+1876)</option>
                                            <option value="81">Japan (+81)</option>
                                            <option value="962">Jordan (+962)</option>
                                            <option value="7">Kazakhstan (+7)</option>
                                            <option value="254">Kenya (+254)</option>
                                            <option value="686">Kiribati (+686)</option>
                                            <option value="850">Korea North (+850)</option>
                                            <option value="82">Korea South (+82)</option>
                                            <option value="965">Kuwait (+965)</option>
                                            <option value="996">Kyrgyzstan (+996)</option>
                                            <option value="856">Laos (+856)</option>
                                            <option value="371">Latvia (+371)</option>
                                            <option value="961">Lebanon (+961)</option>
                                            <option value="266">Lesotho (+266)</option>
                                            <option value="231">Liberia (+231)</option>
                                            <option value="218">Libya (+218)</option>
                                            <option value="417">Liechtenstein (+417)</option>
                                            <option value="370">Lithuania (+370)</option>
                                            <option value="352">Luxembourg (+352)</option>
                                            <option value="853">Macao (+853)</option>
                                            <option value="389">Macedonia (+389)</option>
                                            <option value="261">Madagascar (+261)</option>
                                            <option value="265">Malawi (+265)</option>
                                            <option value="60">Malaysia (+60)</option>
                                            <option value="960">Maldives (+960)</option>
                                            <option value="223">Mali (+223)</option>
                                            <option value="356">Malta (+356)</option>
                                            <option value="692">Marshall Islands (+692)</option>
                                            <option value="596">Martinique (+596)</option>
                                            <option value="222">Mauritania (+222)</option>
                                            <option value="269">Mayotte (+269)</option>
                                            <option value="52">Mexico (+52)</option>
                                            <option value="691">Micronesia (+691)</option>
                                            <option value="373">Moldova (+373)</option>
                                            <option value="377">Monaco (+377)</option>
                                            <option value="976">Mongolia (+976)</option>
                                            <option value="1664">Montserrat (+1664)</option>
                                            <option value="212">Morocco (+212)</option>
                                            <option value="258">Mozambique (+258)</option>
                                            <option value="95">Myanmar (+95)</option>
                                            <option value="264">Namibia (+264)</option>
                                            <option value="674">Nauru (+674)</option>
                                            <option value="977">Nepal (+977)</option>
                                            <option value="31">Netherlands (+31)</option>
                                            <option value="687">New Caledonia (+687)</option>
                                            <option value="64">New Zealand (+64)</option>
                                            <option value="505">Nicaragua (+505)</option>
                                            <option value="227">Niger (+227)</option>
                                            <option value="234">Nigeria (+234)</option>
                                            <option value="683">Niue (+683)</option>
                                            <option value="672">Norfolk Islands (+672)</option>
                                            <option value="670">Northern Marianas (+670)</option>
                                            <option value="47">Norway (+47)</option>
                                            <option value="968">Oman (+968)</option>
                                            <option value="92">Pakistan (+92)</option>
                                            <option value="680">Palau (+680)</option>
                                            <option value="507">Panama (+507)</option>
                                            <option value="675">Papua New Guinea (+675)</option>
                                            <option value="595">Paraguay (+595)</option>
                                            <option value="51">Peru (+51)</option>
                                            <option value="63">Philippines (+63)</option>
                                            <option value="48">Poland (+48)</option>
                                            <option value="351">Portugal (+351)</option>
                                            <option value="1787">Puerto Rico (+1787)</option>
                                            <option value="974">Qatar (+974)</option>
                                            <option value="262">Reunion (+262)</option>
                                            <option value="40">Romania (+40)</option>
                                            <option value="7">Russia (+7)</option>
                                            <option value="250">Rwanda (+250)</option>
                                            <option value="378">San Marino (+378)</option>
                                            <option value="239">Sao Tome &amp; Principe (+239)</option>
                                            <option value="966">Saudi Arabia (+966)</option>
                                            <option value="221">Senegal (+221)</option>
                                            <option value="381">Serbia (+381)</option>
                                            <option value="248">Seychelles (+248)</option>
                                            <option value="232">Sierra Leone (+232)</option>
                                            <option value="65">Singapore (+65)</option>
                                            <option value="421">Slovak Republic (+421)</option>
                                            <option value="386">Slovenia (+386)</option>
                                            <option value="677">Solomon Islands (+677)</option>
                                            <option value="252">Somalia (+252)</option>
                                            <option value="27">South Africa (+27)</option>
                                            <option value="34">Spain (+34)</option>
                                            <option value="94">Sri Lanka (+94)</option>
                                            <option value="290">St. Helena (+290)</option>
                                            <option value="1869">St. Kitts (+1869)</option>
                                            <option value="1758">St. Lucia (+1758)</option>
                                            <option value="249">Sudan (+249)</option>
                                            <option value="597">Suriname (+597)</option>
                                            <option value="268">Swaziland (+268)</option>
                                            <option value="46">Sweden (+46)</option>
                                            <option value="41">Switzerland (+41)</option>
                                            <option value="963">Syria (+963)</option>
                                            <option value="886">Taiwan (+886)</option>
                                            <option value="7">Tajikstan (+7)</option>
                                            <option value="66">Thailand (+66)</option>
                                            <option value="228">Togo (+228)</option>
                                            <option value="676">Tonga (+676)</option>
                                            <option value="1868">Trinidad &amp; Tobago (+1868)</option>
                                            <option value="216">Tunisia (+216)</option>
                                            <option value="90">Turkey (+90)</option>
                                            <option value="7">Turkmenistan (+7)</option>
                                            <option value="993">Turkmenistan (+993)</option>
                                            <option value="1649">Turks &amp; Caicos Islands (+1649)</option>
                                            <option value="688">Tuvalu (+688)</option>
                                            <option value="256">Uganda (+256)</option>
                                            <option value="44">UK (+44)</option>
                                            <option value="380">Ukraine (+380)</option>
                                            <option value="971" selected="selected">United Arab Emirates (+971)</option>
                                            <option value="598">Uruguay (+598)</option>
                                            <option value="1">USA (+1)</option>
                                            <option value="7">Uzbekistan (+7)</option>
                                            <option value="678">Vanuatu (+678)</option>
                                            <option value="379">Vatican City (+379)</option>
                                            <option value="58">Venezuela (+58)</option>
                                            <option value="84">Vietnam (+84)</option>
                                            <option value="84">Virgin Islands - British (+1284)</option>
                                            <option value="84">Virgin Islands - US (+1340)</option>
                                            <option value="681">Wallis &amp; Futuna (+681)</option>
                                            <option value="969">Yemen (North)(+969)</option>
                                            <option value="967">Yemen (South)(+967)</option>
                                            <option value="381">Yugoslavia (+381)</option>
                                            <option value="243">Zaire (+243)</option>
                                            <option value="260">Zambia (+260)</option>
                                            <option value="263">Zimbabwe (+263)</option>
                                          </select>
                                        </div>
                                        <div class="col-md-9">
                                          <input type="text" class="form-control input-sm" placeholder="home number" id="mobilenumber3" name="mobilenumber3">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label>Email</label>
                                      <input type="text" class="form-control input-sm" id="email" name="email">
                                    </div>
                                  </div>
                                </div>
                                <div class="clear"></div>
                                
                              </form>
                            </div>

                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-success" data-dismiss="modal" id="btnSaveLandlord"><i class="fa fa-check"></i> Save and Close</button>
                        </div>
                      </div>
                    </div>
                  </div> --><!-- to fix overflow issue -->