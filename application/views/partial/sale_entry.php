<div class="tab-content">
           
            <?php
		 $attributes = array('data-toggle' => 'validator', 'id' => 'myForm', 'role' => 'form');
	    echo form_open_multipart('listings/save', $attributes);
        ?>
            <div class="row">
            <div class="col-lg-12">
          
              <button type="button" id="new" class="btn btn-lg btn-primary"><i class="fa fa-plus-circle"></i>New Listing</button>

            <button  style="display:none;" type="submit" id="update"  class="btn btn-lg btn-success" name="Update" value="Update Listing">
            <i class="fa fa-plus-circle"></i> Save Listing</button>
             <button  style="display:none;" type="submit" id="Save"  class="btn btn-lg btn-success" name="Save" value="Save Listing">
            <i class="fa fa-plus-circle"></i> Save Listing</button>
       
                <button  style="display:none;" type="button" id="edit" class="btn btn-lg btn-warning"><i class="fa fa-plus-circle"></i>Edit Listing</button>
            <a href="javascript:void(0)" id="cancel" class="btn btn-lg btn-default"  style="display:none;"><i class="fa fa-times"></i> Cancel</a>
            <a href="javascript:void(0)" class="btn btn-lg btn-success pull-right"><i class="fa fa-eye"></i> Preview Listing</a>
            
          
	                  
	                   
	                  
            
            </div>
            </div>
            
            
            <div class="row"><h4 class="add_new_rental"><div id="title">Add New Rentals</div></h4></div>
            
            <!------------------hidden fields-->
                                <input name="id" class="form-control" id="id" style="display:none;" value="0" readonly>
                                <input name="client_id" class="form-control" style="display:none;" id="client_id"  value="<?php echo  $this->session->userdata('client_id');?>" readonly>
                                <input type="text" style="display:none;" name="property_category" id="property_category">
                                <input name="rand_key" type="text" style="display:none;" id="rand_key" readonly value="" >
                                <input name="readonly" type="text" style="display:none;" id="readonly" readonly value="" >
            
            
            
            <div class="row fadeInUp">
            <div class="col-md-3">
              <div class="form-group">
                <label>Ref</label>
                <input type="text" class="form-control input-sm" id="ref" name="ref" disabled="disabled" readonly="readonly" >
              </div>
              
              <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                    <label>Unit No.</label>
                    <input type="text" class="form-control input-sm required" id="unit" name="unit">
                  </div>
              </div>
              
              <div class="col-md-6">
                  <div class="form-group">
                    <label>Type</label>
                    <input type="text" class="form-control input-sm" id="unit_type" name="unit_type">
                     <input name="type_dummy" type="hidden" class="form-control" id="type_dummy" value="2">
                  </div>
              </div>
              </div>
              
              <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                    <label>Street No.</label>
                    <input type="text" class="form-control input-sm" id="street_no" name="street_no">
                  </div>
              </div>
              
              <div class="col-md-6">
                  <div class="form-group">
                    <label>Floor</label>
                    <input type="text" class="form-control input-sm" id="floor_no" name="floor_no" >
                  </div>
              </div>
              </div>
              
              <div class="form-group">
                    <label>Category</label>
                    <select name="category_id" id="category_id" class=" form-control required input-sm">
                   
                                    <option selected="" value="">Select</option>
                                     <?php foreach ($getCat as $listing):?>
                                     <option value="<?php echo $listing['id'];?>"><?php echo $listing['category'];?></option>
                                     <?php endforeach;?>
                                                                           
                                                                    </select>
              </div>
              
              <div class="form-group">
                    <label class="dropdown">Emirate                    
                    <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-search"></i></a>
                    	<ul class="dropdown-menu emirate_search">
                        <h5 class="text-primary">Search Location</h5>
						<input type="text" class="form-control input-sm" id="auto_location_field" name="auto_location_field">
              			</ul>
                    </label>
                    
                    
                    
                    <select id="region_id" name="region_id" class="form-control required input-sm">
                  
                                    <option selected="" value="">Select</option>
											<option value="2">Abu Dhabi</option>
                                        	  <option value="4">Ajman</option>
                                        	  <option value="8">Al Ain</option>
                                        	   <option value="1">Dubai</option>
                                        	    <option value="7">Fujairah </option>
                                        	     <option value="6"> Ras Al Khaimah	 </option>
                                        	      <option value="3">Sharjah	 </option>
                                        	         <option value="5"> Umm Al Quwain </option>
                                                                        </select>
              </div>
              
              
              <div class="form-group">
                    <label>Location <a href=""  data-toggle="modal" data-target="#location"><i class="fa fa-map-marker"></i></a></label>
                    <select class="form-control input-sm " id="area_location_id" name="area_location_id">
                    <option value="" selected="selected">Select</option>
                   
                    </select>
              </div>
              <div class="form-group">
                    <label>Sub-Location</label>
                    <select class="form-control input-sm " id="sub_area_location_id" name="sub_area_location_id">
                    <option value="" selected="selected">Select</option>
                  
                    </select>
              </div>
            </div>
            
            
            <div class="col-md-3">
            
            <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                    <label>Beds</label>
                    <select class="form-control input-sm " id="beds" name="beds">
                
                                    <option selected="selected" value="">Select</option>
                                    <option value="0.5">Studio</option>
                                    <option value="1">1 bed</option>
                                    <option value="2">2 beds</option>
                                    <option value="3">3 beds</option>
                                    <option value="4">4 beds</option>
                                    <option value="5">5 beds</option>
                                    <option value="6">6 beds</option>
                                    <option value="7">7 beds</option>
                                    <option value="8">8 beds</option>
                                    <option value="9">9 beds</option>
                                    <option value="10">10 beds</option>
                                    <option value="11">11 beds</option>
                                    <option value="12">12 beds</option>
                                    <option value="13">13 beds</option>
                                    <option value="14">14 beds</option>
                                    <option value="15">15 beds</option>
                                    <option value="16">16 beds</option>
                                </select>
                                <select tabindex="9" style="display:none;" id="fitted" class="form-control input-sm " type="text" name="fitted">
                                    <option selected="selected" value="">Select</option>
                                    <option value="1">Semi-Fitted</option>
                                    <option value="2">Fitted Space</option>
                                    <option value="3">Shell and core</option>
                                </select>
              </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                    <label>Baths</label>
                    <select class="form-control input-sm" id="baths" name="baths">
                  
                                    <option selected="selected" value="">Select</option>
                                    <option value="1">1 bath</option>
                                    <option value="2">2 baths</option>
                                    <option value="3">3 baths</option>
                                    <option value="4">4 baths</option>
                                    <option value="5">5 baths</option>
                                    <option value="6">6 baths</option>
                                    <option value="7">7 baths</option>
                                    <option value="8">8 baths</option>
                                    <option value="9">9 baths</option>
                                    <option value="10">10 baths</option>
                                    <option value="11">11 baths</option>
                                    <option value="12">12 baths</option>
                                </select>
              </div>
            </div>
            </div>
            
            <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                    <label>BUA</label>
                   <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 
                   data-placement="bottom" data-content="Enter the built-up area of the listing here in Sq Ft. To change the default measuring unit across all listings, request your manager to do so in the Admin > Profile page.">
                   <i class="fa fa-info-circle"></i>
                   </a>
                    <input type="text" class="form-control required input-sm" id="size" name="size">
                  </div>
              </div>
              
              <div class="col-md-6">
                  <div class="form-group">
                    <label>Plot</label>
                    <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 
                   data-placement="bottom" data-content="Enter the plot size of the listing here in Sq Ft, if applicable. To change the default measuring unit across all listings, request your manager to do so in the Admin > Profile page.">
                   <i class="fa fa-info-circle"></i>
                   </a>
                    <input type="text" class="form-control input-sm" id="plot_size" name="plot_size">
                  </div>
            </div>
            </div>
            
            <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                    <label>Price(AED)</label>
                    <input type="text" class="form-control required input-sm" id="price" name="price">
                    <input type="hidden" id="listings_price_id" name="listings_price_id" value="">
                  </div>
              </div>
              
              <div class="col-md-6">
                        <div class="form-group">
                     
                            <label class="">
                               <input type="checkbox" style="margin-right: 2px;" value="0" id="price_of_application" name="price_of_application">
                                <span class="lbl padding">POA</span>
                            </label>                            
                           <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 
                           data-placement="bottom" data-content="Tick this box if you would like the price for the property to be hidden. If ticked, Price on application will display on the PDF brochures and the HTML preview for this property and a zero value will be sent in the XML  feeds to the portals. Note: This will cause most portals to reject the listing as price is normally a mandatory field for most portals.">
                           <i class="fa fa-info-circle"></i>
                           </a>
                        </div>
                   
                </div>
            </div>
            
            <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                    <label>Price / sq ft <!--<a href="" data-toggle="modal" data-target="#cheques_pop"><i class="fa fa-plus-circle"></i></a>--></label>
                    <select class="form-control input-sm " id="cheques" name="cheques" style=" display:none;">
                   
                                    <option selected="" value="">Select</option>
                                    <option value="1">1 cheque</option>
                                    <option value="2">2 cheques</option>
                                    <option value="3">3 cheques</option>
                                    <option value="4">4 cheques</option>
                                    <option value="5">5 cheques</option>
                                    <option value="6">6 cheques</option>
                                    <option value="7">7 cheques</option>
                                    <option value="8">8 cheques</option>
                                    <option value="9">9 cheques</option>
                                    <option value="10">10 cheques</option>
                                    <option value="11">11 cheques</option>
                                    <option value="12">12 cheques</option>
                                </select>
                                <input type="text" tabindex="16" value="" id="unit_size_price" class="form-control" name="unit_size_price" title="This is an auto-calculated field. Ensure the price and built up area fields are populated for this field to show the price per sq ft." readonly="">
                  </div>
            </div>
            <div class="col-md-6">
                  <div class="form-group">
                    <label>Parking</label>
                    <input type="text" class="form-control input-sm" id="parking" name="parking">
                  </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6">
                    <div class="form-group">
					<label>Commission</label>
                    <div class="input-group">
                      <input type="text" class="form-control input-sm" id="commission_percentage" name="commission_percentage">
                      <span class="input-group-addon">%</span>
                    </div>
                    </div>
              </div>
               <div class="col-md-6">
                    <div class="form-group">
                    <label>&nbsp;</label>
                    <div class="input-group">
                      <input type="text" class="form-control input-sm" id="commission" name="commission">
                      <span class="input-group-addon">AED</span>
                    </div>
                    </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6">
                    <div class="form-group">
					<label>Deposit</label>
                    <div class="input-group">
                      <input type="text" class="form-control input-sm" id="deposit_percentage" name="deposit_percentage">
                      <span class="input-group-addon">%</span>
                    </div>
                    </div>
              </div>
               <div class="col-md-6">
                    <div class="form-group">
                   <label>&nbsp;</label>
                    <div class="input-group">
                      <input type="text" class="form-control input-sm" id="deposit" name="deposit">
                      <span class="input-group-addon">AED</span>
                    </div>
                    </div>
              </div>
            </div>
            
            <div class="form-group">
                <label>Owner  <a href="" data-toggle="modal" data-target="#owner_info"><i class="fa fa-user"></i></a></label>
                <div class="input-group">
                  <span class="input-group-addon"><a href="#" data-toggle="modal" data-target="#owner" rel='add_landlord_popup' class="popup_a"><i class="fa fa-plus-circle"></i></a></span>
                  <input type="text" class="form-control required input-sm" id="landlord_name" name="landlord_name" readonly="readonly">
                  <input value="" id="landlord_id" class="form-control ll_id_selector" style="display:none;" name="landlord_id">
                  <input value="" id="landlord_id_list" class="form-control ll_id_list_selector" style="display:none;" name="landlord_id_list">
                </div>
            </div>
            </div>
            
            <div class="col-md-3">
               <div class="form-group">
                    <label>Listing Title</label>
                    <div class="input-group">
                      <input id="name" type="text" class="form-control required input-sm"  name="name">
                      <span id="title_char_count" class="input-group-addon">0</span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Description </label>
                    <a href="#" class="text-primary" data-toggle="modal" data-target="#other_languages">Other Languages</a>
                    <textarea class="form-control" data-toggle="modal" data-target="#description_main" id="description_demo" name="description_demo"></textarea>
                    <input type="text" hidden="" style="display:none;" id="description_count" name="description_count">
                </div>
                
               
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                        <label>Furnished</label>
                        <select class="form-control input-sm " id="prop_furnish" name="prop_furnish">
                      
                                        <option selected="" value="">Select</option>
                                        <option value="1">Furnished</option>
                                        <option value="2">Unfurnished</option>
                                        <option value="3">Partly Furnished</option>
                                </select>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                        <label>View</label>
                        <input type="text" class="form-control input-sm" id="view_id" name="view_id">
                      </div>
                  </div>
              </div>
              
              <div class="row">
                  <div class="col-md-6">
                        <div class="form-group">
                        <label>Photos</label>
                        <div class="input-group">
                          <span class="input-group-addon">
                   <a class="popup_a" href="#" link="view_photo_box_link" id="view_photo_box" rel="view_photo_box" data-toggle="modal" data-target="#photos_pop" title="Add Images">
                          <!--<a href="" data-toggle="modal" data-target="#photos_pop">--><i class="fa fa-plus-circle"></i></a></span>
                          <input type="text" class="form-control input-sm" id="photos" name="photos" readonly="readonly">
                          <input type="hidden" name="floor_plans" id="floor_plans" value="0">
                    </div>
                    </div>
               </div>
               <div class="col-md-6">
                    <div class="form-group">
                        <label>Portals</label>
                        <div class="input-group">
                          <span class="input-group-addon"><a href="" data-toggle="modal" data-target="#portals"><i class="fa fa-plus-circle"></i></a></span>
                          <input type="text" class="form-control input-sm" id="portals_count" name="portals_count" readonly="readonly">
                          <input type="text" style="display:none;" value="" readonly="" name="portals_name" id="portals_name">
                          <input type="text" style="display:none;" value="" readonly="" name="portals_name_arr" id="portals_name_arr">
                    </div>
                    </div>
               </div>
               </div>
               
               <div class="row">
                  <div class="col-md-6">
                        <div class="form-group">
                        <label>Other Media</label>
                        <div class="input-group">
                          <span class="input-group-addon"><a href="" data-toggle="modal" data-target="#other_media"><i class="fa fa-plus-circle"></i></a></span>
                          <input type="text" class="form-control input-sm" id="othermedia_count" name="othermedia_count">
                    </div>
                    </div>
               </div>
               <div class="col-md-6">
                    <div class="form-group">
                        <label>Features</label>
                        <div class="input-group">
                          <span class="input-group-addon"><a href="" data-toggle="modal" data-target="#features"><i class="fa fa-plus-circle"></i></a></span>
                          <input type="hidden" class="form-control input-sm" id="features_id" name="features_id">
                          <input type="text" class="form-control input-sm" id="features_count" name="features_count" >
                          <input type="text" style="display:none;" value="" readonly="" name="area_iformation_data" id="area_iformation_data">
                    </div>
                    </div>
               </div>
               </div>
                
            </div>
            
            
            <div class="col-md-3">
                <div class="form-group">
                    <label>Date Listed</label>
                    <input type="text" class="form-control input-sm" id="dateadded" name="dateadded" readonly="readonly">
                </div>
                <div class="form-group">
                    <label>Last Updated</label>
                    <input type="text" class="form-control input-sm" id="dateupdated" name="dateupdated" readonly="readonly">
                </div>
                
                  <div class="row">
                  <div class="col-md-6">
                        <div class="form-group">
                        <label>Viewings</label>
                        <div class="input-group">
                          <span class="input-group-addon"><a class="popup_a" href="#" link="view_terminal_popup_link" id="popup-viewings" rel="view_terminal_popup" data-toggle="modal" data-target="#viewing_detail" title="Add viewings"><i class="fa fa-plus-circle"></i></a></span>
                          <input type="text" class="form-control input-sm" id="viewings_count" name="viewings_count" readonly="readonly" value="">
                        </div>
                        </div>
                  </div>
                   <div class="col-md-6">
                        <div class="form-group">
                        <label>Leads</label>
                        <div class="input-group">
                          <span class="input-group-addon">
                          <a title="View Leads" id='view_lead_popup_link' href="#" rel='view_lead_popup' data-toggle="modal" data-target="#leads_pop" class="popup_a">
                          
                          
                          <i class="fa fa-plus-circle"></i></a></span>
                          <input type="text" class="form-control input-sm" id="leads" name="leads" readonly="readonly" value="">
                        </div>
                        </div>
                  </div>
                  </div>
                  
                <div class="form-group">
                    <label>Additional Info</label>
                    <div class="input-group">
                      <span class="input-group-addon"><a href="#" id="popup-additional-info" class="popup_a" data-toggle="modal" data-target="#additional_info" title="Add more information">
                      <i class="fa fa-plus-circle"></i></a></span>
                      <input type="text" class="form-control input-sm" id="add_info" name="add_info" readonly="readonly">
                    </div>
                </div>
                
                
                <div class="form-group">
                    <label>Agent</label>
                    <select class="form-control required input-sm" id="agent_id" name="agent_id">
                  
                  
                                    
                                    
                                                                             
                                </select>
                  </div>
                  
                 <div class="form-group">
                    <label>Status</label>
                    <select class="form-control input-sm " id="status" name="status">
                  
                                    <option value="1">Unpublished</option>
                                    <option selected="selected" value="2">Published</option>
                                </select>
                 </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="">
                                <input type="checkbox" tabindex="33" value="1" id="managed" name="managed">
                                <span class="lbl padding">Mangaed </span>
                            </label>
                            <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 
                           data-placement="bottom" data-content="Select this option if you have the owner / landlord has signed up for Property Management on this listing with your company.">
                           <i class="fa fa-info-circle"></i>
                           </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="">
                               <input type="checkbox" tabindex="34" value="1" id="exclusive" name="exclusive">
                                <span class="lbl padding">Exclusive </span>
                            </label>
                           <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 
                           data-placement="bottom" data-content="Select this option if the owner / landlord has signed an exclusive agreement on this listing with your company.">
                           <i class="fa fa-info-circle"></i>
                           </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="">
                                <input type="checkbox" tabindex="35" value="1" id="shared" name="shared">
                                <span class="lbl padding">Invite</span>
                            </label>                            
                           <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 
                           data-placement="bottom" data-content="Select this option if you would like to share this listing with other companies (accepted invitations only) using Royal Home">
                           <i class="fa fa-info-circle"></i>
                           </a>
                        </div>
                   
                </div>
                <!--<div class="col-md-6">
                        <div class="form-group">
                            <label class="">
                               <input type="checkbox" style="margin-right: 2px;" value="0" id="price_of_application" name="price_of_application">
                                <span class="lbl padding">POA</span>
                            </label>                            
                           <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 
                           data-placement="bottom" data-content="Tick this box if you would like the price for the property to be hidden. If ticked, Price on application will display on the PDF brochures and the HTML preview for this property and a zero value will be sent in the XML  feeds to the portals. Note: This will cause most portals to reject the listing as price is normally a mandatory field for most portals.">
                           <i class="fa fa-info-circle"></i>
                           </a>
                        </div>
                   
                </div>-->
            </div>
            
            
            
            
            </div>
            </div>
             <!-- Additional Info Modal -->
            <div class="modal fade" id="additional_info" tabindex="-1">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Additioanl Information</h4>
                    <p>Complete additional information about property here:</p>
                  </div>
                  
                  <div class="modal-body">
                  
                    <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Property Status</label>
                        <select class="selectpicker  show-tick form-control input-sm " id="prop_status" name="prop_status">
                      <option value="" selected="selected">Select</option>
                                                                            <option value="3">Rented</option>
                                                                        <option value="1">Available</option>
                                    <option value="7">Blocked</option>
                                    <option value="5">Reserved</option>
                                                                            <option value="6">Renewed</option>
                                                                        <option value="2">Pending</option>
                                    <option value="4">Upcoming</option>
                        </select>
                      </div>
                      <!--<div class="form-group">
                                <select name='agent_rent_sold' id='agent_rent_sold' class="form-control" style="display:none;"  >
                                    <option value="0" selected="selected">Select</option>
                                                                            <option value="1448837">
                                            Kevin  Espaldon                                         </option>
                                                                            <option value="1448804">
                                            Mahmoud Khalil                                        </option>
                                                                            <option value="1448817">
                                            Mia Feliciano                                        </option>
                                                                            <option value="1449025">
                                            Royal Home  Rent Team                                         </option>
                                                                            <option value="1449026">
                                            Royal Home  Sales Team                                         </option>
                                                                            <option value="1449028">
                                            Royal Home  Property Management                                        </option>
                                                                            <option value="1448836">
                                            Royal Home  Property                                        </option>
                                                                    </select>
                            </div>-->
                      <div class="row">
                          <div class="col-md-6">
                          <div class="form-group">
                            <label>Source of listing</label>
                            <select class="selectpicker  show-tick form-control input-sm " id="source_of_listing" name="source_of_listing">
                            
                                    <option value="" selected="selected">Select</option>
                                                                            <option value=" Not Specified" > Not Specified</option>
                                                                            <option value="7 days" >7 days</option>
                                                                            <option value="Abu Dhabi week" >Abu Dhabi week</option>
                                                                            <option value="Agent" >Agent</option>
                                                                            <option value="Agent External" >Agent External</option>
                                                                            <option value="Agent Internal" >Agent Internal</option>
                                                                            <option value="Al Ayam" >Al Ayam</option>
                                                                            <option value="Al Bayan" >Al Bayan</option>
                                                                            <option value="Al Futtaim" >Al Futtaim</option>
                                                                            <option value="Al Ittihad News paper" >Al Ittihad News paper</option>
                                                                            <option value="Al Khaleej" >Al Khaleej</option>
                                                                            <option value="Al Rai" >Al Rai</option>
                                                                            <option value="AL Watan" >AL Watan</option>
                                                                            <option value="Arab Times" >Arab Times</option>
                                                                            <option value="Asharq Al Awsat" >Asharq Al Awsat</option>
                                                                            <option value="Bank Referral" >Bank Referral</option>
                                                                            <option value="Bayut.com" >Bayut.com</option>
                                                                            <option value="Blackberry SMS" >Blackberry SMS</option>
                                                                            <option value="Business card" >Business card</option>
                                                                            <option value="Client Referral" >Client Referral</option>
                                                                            <option value="Cold call" >Cold call</option>
                                                                            <option value="Colours TV" >Colours TV</option>
                                                                            <option value="Database" >Database</option>
                                                                            <option value="Developer" >Developer</option>
                                                                            <option value="Direct call" >Direct call</option>
                                                                            <option value="Direct Client" >Direct Client</option>
                                                                            <option value="Drive around" >Drive around</option>
                                                                            <option value="Dubizzle Feature" >Dubizzle Feature</option>
                                                                            <option value="Dubizzle.com" >Dubizzle.com</option>
                                                                            <option value="Dzooom.com" >Dzooom.com</option>
                                                                            <option value="Email campaign" >Email campaign</option>
                                                                            <option value="Ertebat" >Ertebat</option>
                                                                            <option value="Exhibition Stand" >Exhibition Stand</option>
                                                                            <option value="Existing client" >Existing client</option>
                                                                            <option value="EzEstate" >EzEstate</option>
                                                                            <option value="EzHeights.com" >EzHeights.com</option>
                                                                            <option value="Facebook" >Facebook</option>
                                                                            <option value="Flyers" >Flyers</option>
                                                                            <option value="Forbes Mailer" >Forbes Mailer</option>
                                                                            <option value="Friend or Relative" >Friend or Relative</option>
                                                                            <option value="Google " >Google </option>
                                                                            <option value="Gulf Daily News" >Gulf Daily News</option>
                                                                            <option value="Gulf News" >Gulf News</option>
                                                                            <option value="Gulf News Mailer" >Gulf News Mailer</option>
                                                                            <option value="Gulf Newspaper Freehold" >Gulf Newspaper Freehold</option>
                                                                            <option value="Gulf Newspaper Residential" >Gulf Newspaper Residential</option>
                                                                            <option value="Gulf Times" >Gulf Times</option>
                                                                            <option value="Gulfnews Freehold" >Gulfnews Freehold</option>
                                                                            <option value="Gulfpropertyportal.com" >Gulfpropertyportal.com</option>
                                                                            <option value="Instagram" >Instagram</option>
                                                                            <option value="JustProperty.com" >JustProperty.com</option>
                                                                            <option value="JustRentals.com" >JustRentals.com</option>
                                                                            <option value="JUWAI" >JUWAI</option>
                                                                            <option value="Khaleej Times" >Khaleej Times</option>
                                                                            <option value="LinkedIn" >LinkedIn</option>
                                                                            <option value="Listanza" >Listanza</option>
                                                                            <option value="Luxury Estate.com" >Luxury Estate.com</option>
                                                                            <option value="Luxury Square Foot" >Luxury Square Foot</option>
                                                                            <option value="Magazine" >Magazine</option>
                                                                            <option value="Memaar TV" >Memaar TV</option>
                                                                            <option value="MoneyCamel.com" >MoneyCamel.com</option>
                                                                            <option value="National News paper" >National News paper</option>
                                                                            <option value="Newsletter" >Newsletter</option>
                                                                            <option value="Newspaper advert" >Newspaper advert</option>
                                                                            <option value="Old Landlord" >Old Landlord</option>
                                                                            <option value="Online Banners" >Online Banners</option>
                                                                            <option value="Open House" >Open House</option>
                                                                            <option value="Other" >Other</option>
                                                                            <option value="Other portal" >Other portal</option>
                                                                            <option value="Outdoor Media" >Outdoor Media</option>
                                                                            <option value="Personal Referral" >Personal Referral</option>
                                                                            <option value="Property Acquisition Department" >Property Acquisition Department</option>
                                                                            <option value="Property Finder Premium" >Property Finder Premium</option>
                                                                            <option value="Property Inc." >Property Inc.</option>
                                                                            <option value="Property Management" >Property Management</option>
                                                                            <option value="Property Trader" >Property Trader</option>
                                                                            <option value="Property Weekly" >Property Weekly</option>
                                                                            <option value="Propertyfinder.ae" >Propertyfinder.ae</option>
                                                                            <option value="Propertyonline" >Propertyonline</option>
                                                                            <option value="Propertywifi.com" >Propertywifi.com</option>
                                                                            <option value="PropSpace MLS" >PropSpace MLS</option>
                                                                            <option value="Radio" >Radio</option>
                                                                            <option value="Radio Advert" >Radio Advert</option>
                                                                            <option value="Referral within company" >Referral within company</option>
                                                                            <option value="Relocation" >Relocation</option>
                                                                            <option value="Rightmove.co.uk" >Rightmove.co.uk</option>
                                                                            <option value="Roadshow" >Roadshow</option>
                                                                            <option value="Sandcastles.ae" >Sandcastles.ae</option>
                                                                            <option value="School Communicator" >School Communicator</option>
                                                                            <option value="School Communicator" >School Communicator</option>
                                                                            <option value="Search Engine" >Search Engine</option>
                                                                            <option value="Signboard" >Signboard</option>
                                                                            <option value="SMS campaign" >SMS campaign</option>
                                                                            <option value="Social media Campaign" >Social media Campaign</option>
                                                                            <option value="Souq.com" >Souq.com</option>
                                                                            <option value="Staff Mailer" >Staff Mailer</option>
                                                                            <option value="Twitter " >Twitter </option>
                                                                            <option value="Walk-in" >Walk-in</option>
                                                                            <option value="Website" >Website</option>
                                                                            <option value="Whatpricemyhome" >Whatpricemyhome</option>
                                                                            <option value="Whatsapp" >Whatsapp</option>
                                                                            <option value="Word of Mouth" >Word of Mouth</option>
                                                                            <option value="www.propertyportal.ae" >www.propertyportal.ae</option>
                                                                            <option value="Youtube" >Youtube</option>
                                                                            <option value="Zawya Mailer" >Zawya Mailer</option>
                                                                            <option value="Zoopla" >Zoopla</option>
                                                                    </select>
                          </div>
                          </div>
                          <div class="col-md-6">
                          <div class="form-group">
                            <label>Featured</label>
                            <select class="selectpicker  show-tick form-control input-sm " id="flcheck" name="flcheck">
                              <option value="0" selected="selected">Select</option>
                                    <option value="1">Yes</option>
                                    </select>
                          </div>
                          </div>
                          <!--<select name='reffered_by_agent' id='reffered_by_agent' class="form-control" style="display:none;"  >
                                    <option value="0" selected="selected">Select</option>
                                                                            <option value="1448837">
                                            Kevin  Espaldon                                         </option>
                                                                            <option value="1448804">
                                            Mahmoud Khalil                                        </option>
                                                                            <option value="1448817">
                                            Mia Feliciano                                        </option>
                                                                            <option value="1449025">
                                            Royal Home  Rent Team                                         </option>
                                                                            <option value="1449026">
                                            Royal Home  Sales Team                                         </option>
                                                                            <option value="1449028">
                                            Royal Home  Property Management                                        </option>
                                                                            <option value="1448836">
                                            Royal Home  Property                                        </option>
                                                                    </select>-->
                      </div>
                      
                      <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                                <label>DEWA Number</label>
                                <input type="text" class="form-control input-sm" id="dewa_no" name="dewa_no">
                                
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                                <label>STR #</label>
                                <input type="text" class="form-control input-sm" id="strno" name="strno">
                            </div>
                          </div>
                      </div>
                      
                      <div class="row">
                          <div class="col-md-6">                          
                          <div class="form-group">
                            <label>Next available</label>
                            <div class="input-group input-daterange" id="datepicker">
                              <input type="text" class="form-control input-sm" id="available_date" name="available_date">
                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                          </div>
          
                         </div>
                          
                          <div class="col-md-6">
                          <div class="form-group">
                            <label>Remind</label>
                            <select class="selectpicker  show-tick form-control" id="remind_me" name="remind_me">
                            <option value="" selected>Never</option>
                                    <option value="1">1 day</option>
                                    <option value="7">1 week</option>
                                    <option value="14">2 weeks</option>
                                    <option value="30">1 month</option>
                                    <option value="60">2 months</option>
                                    <option value="90">3 months</option>
                                    <option value="120">4 months</option>
                                    <option value="180">6 months</option>
                            </select>
                          </div>
                          </div>
                      </div>
                      <h5 class="text-primary">Notes</h5>
                      <div class="form-group">
                            <label>New Notes</label>
                            <textarea class="form-control" id="notes" name="notes"></textarea>
                            <input name="leads_notes"  style="display:none;" class="form-control" id="leads_notes" value="">
                            <div class="document_area" id="shownotes">No note found for this listing</div>
                      </div>
                      
                     </div>
                     
                     <div class="col-md-6">
                        <div class="form-group">
                            <label>Key Loaction</label>
                            <input type="text" class="form-control input-sm" id="key_location" name="key_location">
                        </div>
                        <div class="form-group">
                        <label class="">
                            <input type="checkbox" name="tenanted" id="tenanted"/>
                             <textarea name="documents" style="display:none; width:300px; height:100px;"  class="form-control" id="documents"></textarea>
                            <span class="lbl padding">Property Tenated?</span>
                        </label>
                        </div>
                        <div class="form-group">
                            <label>Rented at</label>
                            <input type="text" class="form-control input-sm" id="amount" name="amount">
                        </div>
                        
                        <div class="form-group">
                            <label>Rental until</label>
                            <div class="input-group input-daterange" id="datepicker">
                              <input type="text" class="form-control input-sm" id="amount_date" name="amount_date">
                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Maintenance Fee</label>
                            <input type="text" class="form-control input-sm" id="maintenance" name="maintenance">
                        </div>
                        <div class="form-group">
                            <label>Price sq/ft</label>
                           
                            <input readonly title="This is an auto-calculated field. Ensure the price and built up area fields are populated for this field to show the price per sq ft." 
                                               type="text" class="form-control input-sm" name="unit_size_price_2"  id="unit_size_price_2" value="">
                        </div>
                        <h5 class="text-primary">Document</h5>
                        <div class="form-group">
                            <label>Document Name</label>
                            <input type="text" class="form-control input-sm" id="document_name" name="document_name">
                              <div style="display:none;" id="download_animation">
                                    <img src="https://crm.propspace.com/application/views/images/ajax-loader.gif" width="24" height="24" />
                                </div>
                        </div>
                        <div class="form-group">
                              <input type="file" class="pull-left" id="listings_documents" name="listings_documents">
                             
                              <button class="btn btn-primary" id="buttonUpload"  onClick="return ajaxFileUpload();"><i class="fa fa-upload"></i>Upload</button>
                        </div>
                     <!--   <div class="document_area"></div>-->
                         <div class="document_area" style="border: 1px solid #D3D3D3; height: 100px; overflow-y: scroll;" id="showDocuments">
                                    No documents found for this listing</div>
                     </div>
                     
                    </div>
                      
                    
                  </div>
                  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Save &amp; Close</button>
                  </div>
                </div>
              </div>
            </div>
            
               <!-- Add Other Media Modal -->
            <div class="modal fade" id="other_media" tabindex="-1">
              <div class="modal-dialog" id="other_media_div">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Other Media</h4>
                    <p>Paste the links to your other media here. Remember to include the full URL starting with http://</p>
                  </div>
                  
                  <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-md-3 control-label">YouTube Video Link</label>
                            <div class="col-md-9">
                              <input type="text" class="form-control" name="video_embed_code" id="video_embed_code">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">360 virtual tour link</label>
                            <div class="col-md-9">
                              <input type="text" class="form-control" name="360_embed_code" id="360_embed_code">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Audio tour link</label>
                            <div class="col-md-9">
                              <input type="text" class="form-control" name="audio_embed_code" id="audio_embed_code">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Video tour link</label>
                            <div class="col-md-9">
                              <input type="text" class="form-control" name="virtual_tour_embed_code" id="virtual_tour_embed_code">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">QR code link</label>
                            <div class="col-md-9">
                              <input type="text" class="form-control" name="qr_code_link" id="qr_code_link">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">PDF broucher</label>
                            <input style="display:none;" type="text" name="pdf_brochure" id="pdf_brochure">
                            <div class="col-md-6">
                             <input id="pdf_brochure_upload"  type="file" size="10" name="pdf_brochure_upload">
                            </div>
                            <div class="col-md-3">
                           
                            <button  class="btn btn-primary" id="buttonUpload" onClick="return ajaxFileUpload_pdf();">Upload</button>
                        	<span class="margin-left-10" id='pdf_download'></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Upload Video  <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 
                           data-placement="bottom" data-content="Upload video for your property it should be in mp4 format and less then 10MB.">
                           <i class="fa fa-info-circle"></i>
                           </a></label>
                           <input style="display:none;" type="text" name="video_path" id="video_path">
                            <div class="col-md-6">
                             <input id="video_path_upload"  type="file" size="10" name="video_path_upload">
                            </div>
                            <div class="col-md-3">
                          
                           <button  class="btn btn-primary" id="buttonUpload"   onClick="return ajaxFileUpload_video();">Upload</button>
                            </div>
                        </div>
                    </form>
                    
                  </div>
                  <div class="modal-footer">
                  <div style="display:none;" class="pull-left" id="download_animation_media">
                    		<img src="<?php echo base_url();?>/images/ajax-loader.gif" width="26" height="26" />
                    </div>
                    <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Save &amp; Close</button>
                  </div>
                </div>
              </div>
            </div>
            
            
            <!-- Cheques Modal -->
            <div class="modal fade" id="cheques_pop" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Price options based on No. of Cheques</h4>
                    <p>All these price options along with the no. of cheques will be displayed on the property details page on Gistler.com. All other portals will continue to display your 1st (Default) choice.</p>
                  </div>
                  
                  <div class="modal-body">
                  <form>
                  <div class="row" id="cheque_option_1">
                  <div class="col-md-4"><h5><strong>Option 1</strong> <span class="text-success">Default</span></h5></div>
                  <div class="col-md-4">
                      <div class="form-group">
                        <input type="text" class="form-control input-sm"  name="price_1" id="price_1" placeholder="Price (AED)">
                        
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                        <select class="selectpicker  show-tick form-control input-sm cheques_option" id="cheques_1" name="cheques_1">
                         <option value="" selected>Select</option>
                                            <option value="1">1 cheque</option>
                                            <option value="2">2 cheques</option>
                                            <option value="3">3 cheques</option>
                                            <option value="4">4 cheques</option>
                                            <option value="5">5 cheques</option>
                                            <option value="6">6 cheques</option>
                                            <option value="7">7 cheques</option>
                                            <option value="8">8 cheques</option>
                                            <option value="9">9 cheques</option>
                                            <option value="10">10 cheques</option>
                                            <option value="11">11 cheques</option>
                                            <option value="12">12 cheques</option>
                        </select>
                      </div>
                  </div>
                  </div>
                  <div class="row">
                  <div class="col-md-4"><h5><strong>Option 2</strong></h5></div>
                  <div class="col-md-4">
                      <div class="form-group">
                        <input type="text" class="form-control input-sm" id="price_2" name="price_2" placeholder="Price (AED)">
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                        <select class="selectpicker  show-tick form-control input-sm cheques_option" id="cheques_2" name="cheques_2">
                        <option value="" selected>Select</option>
                                            <option value="1">1 cheque</option>
                                            <option value="2">2 cheques</option>
                                            <option value="3">3 cheques</option>
                                            <option value="4">4 cheques</option>
                                            <option value="5">5 cheques</option>
                                            <option value="6">6 cheques</option>
                                            <option value="7">7 cheques</option>
                                            <option value="8">8 cheques</option>
                                            <option value="9">9 cheques</option>
                                            <option value="10">10 cheques</option>
                                            <option value="11">11 cheques</option>
                                            <option value="12">12 cheques</option>
                        </select>
                      </div>
                  </div>
                  </div>
                  <div class="row">
                  <div class="col-md-4"><h5><strong>Option 3</strong></h5></div>
                  <div class="col-md-4">
                      <div class="form-group">
                        <input type="text" class="form-control input-sm" id="price_3" name="price_3" placeholder="Price (AED)">
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                        <select class="selectpicker  show-tick form-control input-sm cheques_option" id="cheques_3" name="cheques_3">
                        <option value="" selected>Select</option>
                                            <option value="1">1 cheque</option>
                                            <option value="2">2 cheques</option>
                                            <option value="3">3 cheques</option>
                                            <option value="4">4 cheques</option>
                                            <option value="5">5 cheques</option>
                                            <option value="6">6 cheques</option>
                                            <option value="7">7 cheques</option>
                                            <option value="8">8 cheques</option>
                                            <option value="9">9 cheques</option>
                                            <option value="10">10 cheques</option>
                                            <option value="11">11 cheques</option>
                                            <option value="12">12 cheques</option>
                        </select>
                      </div>
                  </div>
                  </div>
                  <div class="row">
                  <div class="col-md-4"><h5><strong>Option 4</strong></h5></div>
                  <div class="col-md-4">
                      <div class="form-group">
                        <input type="text" class="form-control input-sm" id="price_4" name="price_4" placeholder="Price (AED)">
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                        
                        <select class="selectpicker  show-tick form-control input-sm " id="cheques_4" name="cheques_4">
                        <option value="" selected>Select</option>
                                            <option value="1">1 cheque</option>
                                            <option value="2">2 cheques</option>
                                            <option value="3">3 cheques</option>
                                            <option value="4">4 cheques</option>
                                            <option value="5">5 cheques</option>
                                            <option value="6">6 cheques</option>
                                            <option value="7">7 cheques</option>
                                            <option value="8">8 cheques</option>
                                            <option value="9">9 cheques</option>
                                            <option value="10">10 cheques</option>
                                            <option value="11">11 cheques</option>
                                            <option value="12">12 cheques</option>
                        </select>
                      </div>
                  </div>
                  </div> 
                  </form>
                  
                  </div>
                  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success"><i class="fa fa-check"></i> Done</button>
                  </div>
                </div>
              </div>
            </div>
            
         <?php echo  form_close();?>
            <!-- Rental Form End -->
            </div>