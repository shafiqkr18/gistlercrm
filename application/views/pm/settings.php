<!-- <script src="<?php echo site_url();?>js_module/PM/pm_common.js"></script> -->
<script src="<?php echo site_url();?>js_module/PM/pm_settings.js"></script>
<script src="<?php echo site_url();?>js_module/PM/pm_managedUnits.js"></script>


<body class="pmsettings">

	<div id="wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-10">
					<div class="page_head_area">
						<h1><i class="fa fa fa-gear"></i> Settings	</h1>
						<h5>Setup and configure the information that you need for Property Management</h5>
					</div>
				</div>                    
			</div>

			<div class="tab-content tab-white" style="padding-left:20px">
				<div id="rServiceProviders" class="row">
					<h3 class="">  Service Providers</h3> <!-- <i class="fa fa-chevron-down"></i> -->
					<div class="col-md-3 panel-heading panel-gistab tab-nopadding">
					    <ul class="nav nav-tabs nav-stacked" role="tablist">
					      <li id="liTypes" role="presentation"><a data-toggle="tab" role="tab" aria-controls="configureTypes" href="#configureTypes" aria-expanded="true">Configure Types &amp; Subtypes</a></li>
					      <li id="liManageSps" class="active" role="presentation"><a data-toggle="tab" role="tab" aria-controls="selectSP" href="#selectSP" aria-expanded="false">Manage my Service Providers</a></li>
					    </ul>
					</div>                        
					<div class="panel-body tab-nopadding " style="height: 500px;width: 100%; padding-left: 280px">
						<div class="tab-content tab-nopadding">
						  <div id="configureTypes" class="tab-pane " role="tabpanel">
						  	<div class="row">
						  		<div class="col-md-4">
						  			<div class="row">
						  				<div class="col-sm-3">
						  					<h3>Types</h3> 
						  				</div>
						  				<div  style="display:none" class="col-sm-4">
											<button class="btn btn-sm btn-info"><i class="fa fa-plus-circle"></i> Add Type</button>
						  				</div>
					  				</div>
						  			<div class="row">
										<div id="lgTypes" class="list-group">
										</div>					  			
									</div>
						  		</div>
						  		<div class="col-md-6">
					  				<div class="row">
							  			<div class="col-sm-5 col-md-offset-1">
							  				<h3>Sub Types</h3> 
							  			</div>
						  				<div id="divHiddenSubtypeButton" style="display:none" class="col-sm-5">
											<button id="btnAddSubType" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> Add Sub-Type</button>
						  				</div>	
					  				</div>
					  				<div class="row">
					  					<div id="divSubTypes" class="col-md-7 col-sm-offset-1">
					  						<span style="display:none" >There is no subtypes assigned for this type.</span>
											<div style="display:none" class="row list-group">
													
											</div>
					  					</div>
					  				</div>
							  			
						  		</div>
					  		
						  	</div>
						  </div> 
						  <div id="selectSP" class="tab-pane active" role="tabpanel">
						    <div role="tabpanel" class="tab-pane active" id="selectSP">
				              	<button class="btn btn-info" data-target="#serviceproviderform" data-toggle="modal" id="btnAddSP" type="button"><i class="fa fa-plus-circle"></i> Add New</button>
				              	<!-- <button class="btn btn-warning" data-target="#serviceproviderform" data-toggle="modal" id="btnEditSP" type="button" style="display:none"><i class="fa fa-plus-circle"></i> Edit</button> -->

								<hr/>									

				                <table class="table table-striped table-hover datatables datatable-setbotclass dataTable no-footer" aria-describedby="dataTables-current-listing_info" id="tblServiceProviders">
				                  <thead class="listing_headings">
				                    <tr>
				                      <th/>
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
				                    </tr>
				                  </thead>
				                  <tbody>
				                    <tr>
				                      <td colspan="6" class="dataTables_empty">Loading data from server</td>
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
	</div>