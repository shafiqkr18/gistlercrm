<script src="<?php echo site_url();?>js_module/common.js"></script>
<script src="<?php echo site_url();?>js_module/PM/pm_managedUnits.js"></script>

<script type="text/javascript" src="<?php echo site_url();?>js_module/ajaxfileupload.js?r=45435346"></script>

<body class="pmunits">


  <div id="wrapper">
    <div class="container">
     <!-- Page Heading -->
     <div class="row">
      <div class="col-md-10">
        <div class="page_head_area">
         <h1><i class="fa fa fa-home"></i> Managed Units	</h1>

       </div>
     </div>                    
   </div>
   <div class="row">
    <!-- Tab content -->
    <div class="tab-content tab-white">
      <form action="comment.php" method="post" data-toggle="validator" role="form" id="uaelisting-form">
        <div class="row">
          <div class="btn-toolbar col-md-11" role="toolbar">

            <div class="btn-group">
              <button class="btn btn-primary" data-target="#unitform" data-toggle="modal" id="newUnit" type="button"><i class="fa fa-plus-circle"></i> Add Unit</button>
              <button class="btn btn-primary hiddenbuttons" data-target="#unitform" data-toggle="modal" id="newUnit" type="button"><i class="fa fa-pencil"></i> Edit Unit</button>
            </div>            

            <div class="btn-group hiddenbuttons">
              <button type="button" data-target="#leaseform" data-toggle="modal" class="btn btn-info"><i class="fa fa-plus-square"></i> Add Lease</button>
              <button aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" class="btn btn-info dropdown-toggle " type="button">
                <i class="fa fa-chevron-down"></i>
              </button>
              <ul class="dropdown-menu">
                <li>
                  <a href="#" class="dropdown-item" data-target="#leases" data-toggle="modal" ><i class="fa fa-history"></i> View All Leases</a>
                </li>
              </ul>
            </div> 

            <div class="btn-group hiddenbuttons">
              <button type="button" data-target="#workorderform" data-toggle="modal" class="btn btn-warning"><i class="fa fa-gears"></i> Add Work Order</button>
              <button aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" class="btn btn-warning dropdown-toggle " type="button">
                <i class="fa fa-chevron-down"></i>
              </button>
              <ul class="dropdown-menu">
                <li>
                  <a href="#" class="dropdown-item" data-target="#workorders" data-toggle="modal" ><i class="fa fa-history"></i> View All Work Orders</a>
                </li>
              </ul>
            </div>      

            <div class="btn-group hiddenbuttons">
              <button class="btn btn-success" data-target="#accountform" data-toggle="modal" id="managetransactions" type="button" style=""><i class="fa fa-table"></i> Manage Payments</button>
            </div> 

            &nbsp;
            <i class="fa fa-spin fa-cog fa-2x" id="loading" style="display:none"></i>              
          </div>

          <div class="btn-toolbar col-md-1">
            <div class="btn-group hiddenbuttons">
              <button class="btn btn-default" id="cancelUnit" type="button"><i class="fa fa-close"></i> Cancel</button>
            </div>
          </div>

        </div>
        <div class="row"><h4 class="add_new_rental"><i class="fa fa-chevron-down"></i>  Property Management - Unit</h4></div>

        <div id="frm" class="row"> <!-- i removed this class name: fadeInUp -->

          <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-heading"><i class="fa fa-home"></i> Unit Details
                <div class="panel-option">
                  <span class="pull-right clickable">
                    <i class="glyphicon glyphicon-chevron-up"></i>
                  </span>                          
                </div>
              </div>

              <div id="divUnitDetails" class="panel-body pmp-samehieght">
                <div class="col-md-6">

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
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Landlord</label>
                    <div ><!-- class="input-group" -->
                      </a>
                      <!-- <span class="input-group-addon"><a id="aLandlord" data-target="#landlordSelector" data-toggle="modal" href=""><i class="fa fa-plus-circle"></i></a></span> -->
                      <input type="hidden" name="landlordId" id="landlordId">
                      <input type="text" class="form-control input-sm" id="landlordname">
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Unit Title</label>
                    <input type="text" class="form-control input-sm" name="name" id="name">
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description_demo" id="description_demo"></textarea>
                  </div>

                  <div class="form-group">
                    <label>Property Mgr.</label>
                    <select required="" class="form-control required input-sm" name="agent_id" id="agent_id">
                    </select>
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
                </div>
              </div>

            </div>
          </div>

          <div class="col-md-3">
            <div class="panel panel-default">
              <div class="panel-heading"><i class="fa fa-group"></i> Leases
                <div class="panel-option">
                  <span class="pull-right clickable">
                    <i class="glyphicon glyphicon-chevron-up"></i>
                  </span>                          
                </div>
              </div>

              <div id="divLeases" class="panel-body tab-nopadding pmp-samehieght">

                <div class="panel panel-default gist-formsmartpanel gist-leasetabs">
                  <div class="panel-heading panel-gistab gist-contab">
                    <ul class="nav nav-tabs" role="tablist">
                      <li role="presentation" class="active"><a href="#tabpersonal" aria-controls="tabpersonal" role="tab" data-toggle="tab">Current</a></li>
                      <li role="presentation"><a href="#tabwork" aria-controls="tabwork" role="tab" data-toggle="tab">Previous</a></li>
                      <li role="presentation"><a href="#tabother" aria-controls="tabother" role="tab" data-toggle="tab">Future</a></li>
                    </ul>
                  </div>                        
                  <div class="panel-body">
                    <div class="tab-content">
                      <div role="tabpanel" class="tab-pane active" id="tabpersonal">
                        <div class="gist-showmeonclick personalcontent">
                          <div id="divCurrentLeasesHeader" class="tab-nopadding">
                            <span class="text-warning">No Leases</span>
                            <div id="divCurrentLeasesDetails" style="display:none" >
                              <table class="table table-striped">
                                <tbody>               
                                  <tr><td>Ref</td><td><label id="uRef"></label></td> </tr>
                                  <tr><td>Tenant </td><td><label id="uTenant"></label></td></tr>
                                  <tr><td>Lease Amount </td><td><label id="uLeaseAmount"></label></td></tr>
                                  <tr><td>Commission </td><td><label id="uCommission"></label></td></tr>
                                  <tr><td>Ending on </td><td><label id="uEndDate"></label></td></tr>                                    
                                  <tr><td>View </td><td id="tdView">
                                    <a href='#' rel='' class='popup_a openLeaseForm' data-toggle='modal' data-target='#leaseform'><i class='fa fa-eye'></i></a>
                                  </td></tr>
                                </tbody>
                              </table>
                            </div>                        
                          </div>
                        </div>
                      </div>
                      <div role="tabpanel" class="tab-pane" id="tabwork">

                        <div class="gist-showmeonclick workcontent">
                          <div class="gist-showmeonclick personalcontent">
                            <div id="divPreviousLeasesHeader" class="tab-nopadding">
                              <span class="text-warning">No Leases</span>
                              <div id="divPreviousLeasesDetails" style="display:none" class="pmp-samehieght">
                                <table class="table table-striped">
                                  <tbody>               
                                    <tr><td>Ref</td><td><label id="uRef"></label></td> </tr>
                                    <tr><td>Tenant </td><td><label id="uTenant"></label></td></tr>
                                    <tr><td>Lease Amount </td><td><label id="uLeaseAmount"></label></td></tr>
                                    <tr><td>Commission </td><td><label id="uCommission"></label></td></tr>
                                    <tr><td>Ending on </td><td><label id="uEndDate"></label></td></tr>                                    
                                    <tr><td>View </td><td id="tdView">
                                    <a href='#' rel="" class="popup_a openLeaseForm" data-toggle="modal" data-target="#leaseform"><i class='fa fa-eye'></i></a>
                                    </td></tr>
                                  </tbody>
                                </table>
                              </div>                        
                            </div>
                          </div>
                        </div>

                      </div>
                      <div role="tabpanel" class="tab-pane" id="tabother">
                        <div class="gist-showmeonclick othercontent">
                          <div id="divFutureLeasesHeader" class="tab-nopadding">
                            <span class="text-warning">No Leases</span>
                            <div id="divFutureLeasesDetails" style="display:none" class="pmp-samehieght">
                              <table class="table table-striped">
                                <tbody>               
                                  <tr><td>Ref</td><td><label id="uRef"></label></td> </tr>
                                  <tr><td>Tenant </td><td><label id="uTenant"></label></td></tr>
                                  <tr><td>Lease Amount </td><td><label id="uLeaseAmount"></label></td></tr>
                                  <tr><td>Commission </td><td><label id="uCommission"></label></td></tr>
                                  <tr><td>Ending on </td><td><label id="uEndDate"></label></td></tr>                                    
                                  <tr><td>View </td><td id="tdView">
                                    <a href='#' rel="" class="popup_a openLeaseForm" data-toggle="modal" data-target="#leaseform"><i class='fa fa-eye'></i></a>
                                  </td></tr>
                                </tbody>
                              </table>
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

          <div class="col-md-3">
            <div class="panel panel-default ">
              <div class="panel-heading panel-gistab tab-nopadding">
                <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#recentview" aria-controls="recentview" role="tab" data-toggle="tab">Work Orders</a></li>
                  <li role="presentation"><a href="#tabNotes" aria-controls="tabNotes" role="tab" data-toggle="tab">Notes & Doc</a></li>
                </ul>
              </div>                        
              <div class="panel-body tab-nopadding pmp-samehieght">
                <div class="tab-content tab-nopadding">
                  <div role="tabpanel" class="tab-pane active" id="recentview">

                    <!-- here -->
                    <div class="panel panel-default gist-formsmartpanel gist-leasetabs">
                      <div class="panel-heading panel-gistab gist-contab">
                        <ul class="nav nav-tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#Progress" aria-controls="tabpersonal" role="tab" data-toggle="tab">In Progress</a></li>
                          <li role="presentation"><a href="#Completed" aria-controls="tabwork" role="tab" data-toggle="tab">Completed</a></li>

                        </ul>
                      </div>                        
                      <div class="panel-body">
                        <div class="tab-content">
                          <div role="tabpanel" class="tab-pane active" id="Progress">

                            <div class="gist-showmeonclick personalcontent">
                              <div id="divInProgrressWOHeader" style="width: 100%; height: 270px;  overflow: auto; overflow-x:visible;"><!-- position: relative; bottom: 0; width: 100%;  height: 280px;overflow: auto; overflow-x: hidden; -->
                                <span class="text-warning">No Work Orders Found</span>
                                <div id="divInProgrressWODetail" style="display:none">
                                  <table class="table table-striped">
                                    <thead>
                                      <tr>   
                                        <td>No.</td>
                                        <td>Ref</td>
                                        <td>Work</td>
                                        <td>Cost on</td>        
                                        <td>Provider</td>          
                                        <td>Priority</td>    
                                        <td>End Date</td>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>


                          </div>
                          <div role="tabpanel" class="tab-pane" id="Completed">
                            <div class="gist-showmeonclick workcontent">
                              <div id="divCompletedWOHeader" style="width: 100%; height: 270px;  overflow: auto; overflow-x:visible;"><!-- position: relative; bottom: 0; width: 100%;  height: 280px;overflow: auto; overflow-x: hidden; -->
                                <span class="text-warning">No Work Orders Found</span>
                                <div id="divCompletedWODetail" style="display:none">
                                  <table class="table table-striped">
                                    <thead>
                                      <tr>   
                                        <td>No.</td>
                                        <td>Ref</td>
                                        <td>Work</td>
                                        <td>Cost on</td>        
                                        <td>Provider</td>          
                                        <td>Priority</td>    
                                        <td>End Date</td>
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
                      </div>
                    </div>

                  </div>
                  <div role="tabpanel" class="tab-pane" id="tabNotes">
                    <button class="btn btn-sm btn-primary btn-block" data-target="#unitNotes" data-toggle="modal" id="btnOpenNotesModal" type="button"><i class="fa fa-plus-circle"></i> Add new</button>
                    <div id="divNoteContent" class="form-group" style="overflow: auto; overflow-x: hidden;padding-left: 10px;padding-top: 10px">
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
        <ul id="ulUnits" class="nav nav-tabs">
          <li value="0" class="active"><a href="#" value="0">All Units <span id="cntAll" class="text-info">(<?php echo $all;?>)</span></a></li>
          <li value="1"><a href="#" value="1">Available <span id="cntAvailable" class="text-info">(<?php echo $available;?>)</span></a></li>
          <li value="3"><a href="#" value="3">Rented <span id="ctnRented" class="text-info">(<?php echo $rented;?>)</span></a></li>
        </ul>
      </div>
      <div class="tab-content tab-white datatable-Scrolltab">
        <table id="tblUnits" aria-describedby="dataTables-current-listing_info" class="table table-striped table-hover datatables datatable-setbotclass no-footer">
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

  </div>



</div>
<!-- container end -->            
</div>
<!-- wrapper end -->

<input type="hidden" id="hdnClientId" value="<?php echo $this->session->userdata('client_id');?>">

<!--                     <div class="input-group">
                      <input type="text" placeholder="Enter Notes" id="txtNote" class="form-control input-sm">
                      <div class="input-group-addon" style="background-color: cornflowerblue;">
                        <button id="btnSaveNote" style="background-color: cornflowerblue;color: white"><i class="fa fa-save"></i></button>
                      </div>
                    </div> -->