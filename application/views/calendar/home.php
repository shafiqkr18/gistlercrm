<script src="<?php echo base_url();?>dhtmlx/codebase/dhtmlxscheduler.js" type="text/javascript" charset="utf-8"></script>

	<link rel="stylesheet" href="<?php echo base_url();?>dhtmlx/codebase/dhtmlxscheduler.css" type="text/css" media="screen" title="no title" charset="utf-8">
	
	  <!-- dhtmlx scheduler start -->
<script src="<?php echo base_url();?>dhtmlx/codebase/dhtmlxscheduler.js" type="text/javascript" charset="utf-8"></script>
<script src='<?php echo base_url();?>dhtmlx/calendar_scripts.js' type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url();?>dhtmlx/codebase/ext/dhtmlxscheduler_minical.js" type="text/javascript" charset="utf-8"></script>
<script src='<?php echo base_url();?>dhtmlx/codebase/ext/dhtmlxscheduler_grid_view.js' type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url();?>dhtmlx/codebase/ext/dhtmlxscheduler_year_view.js" type="text/javascript" charset="utf-8"></script>
<script src='<?php echo base_url();?>dhtmlx/codebase/ext/dhtmlxscheduler_tooltip.js' type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url();?>dhtmlx/codebase/ext/dhtmlxscheduler_dhx_terrace.js"></script>
<script src="<?php echo base_url();?>dhtmlx/codebase/ext/dhtmlxscheduler_recurring.js"></script>
<script src="<?php echo base_url();?>dhtmlx/codebase/dhtmlxcalendar.js"></script>
<script src="<?php echo base_url();?>dhtmlx/codebase/dhtmlxscheduler_serialize.js"></script> 

<!-- dhtmlx scheduler end -->

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>dhtmlx/codebase/dhtmlxcalendar.css"></link>
<link charset="utf-8" title="no title" media="screen" type="text/css" href="<?php echo base_url();?>dhtmlx/codebase/dhtmlxscheduler_dhx_terrace.css" rel="stylesheet">
<link charset="utf-8" title="no title" media="screen" type="text/css" href="<?php echo base_url();?>dhtmlx/style.css"  rel="stylesheet"> 


  <script type="text/javascript" src="<?php echo base_url();?>js_module/colorpicker.js"></script>

<div id="wrapper">
    <div class="container"> 
    
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
        <div class="page_head_area">
            <h1><i class="fa fa-calendar"></i> My Calendar</h1>
          </div>
      </div>
      </div>
    <div id="inner_tab">
        <div class="row">
        <div class="col-lg-12"> 
            <!-- Nav tabs -->
            <div class="inner_tab_nav">
            <ul class="nav nav-tabs">
                 <li  class="active"><a href="<?php echo base_url();?>calendar">My Calendar</a></li>
                    <li><a href="<?php echo base_url();?>todo">To-Do List</a></li>
              </ul>
          </div>
            
            <!-- Tab content -->
            <div class="tab-content">

              <div class="col-md-2 row" >
                	<div class="cal_here" id="app-left">
                		<div id="cal_here"></div>
		                <div  id="calendar" >
						    <div style="display: inline-block;">
						        <div class="calendar_title"> My Calendars
						            <span id="staff-mode-show-users-calendars" class="ui-icon-transferthick-e-w off" style="float: right;cursor: pointer;margin: 1px 5px;" title="Show User Calendars"></span>
						            <span  class="calendar_description">Please click  <span class="ui-icon-transferthick-e-w"></span> 
						                icon to toggle between your calendar and your team's calendars</span>
						        </div>
						        
						       
						        
						        
						        <div class="calendar_user">
						            <table  class="user_table" >
						                <tbody>
						                	<?php
						                	foreach($cal_users as $listing){?>
						                     <tr class='calend<?php echo $listing['id'];?>'><td id='<?php echo $listing['id'];?>' class='calendar-<?php echo $listing['id'];?>' >
						                            <div class='userdesign  ABCD123 on ' >
						                            <a href='#' class='cal_usr'><?php echo $listing['name'];?></a>
						                            </div></td>
						                            <td style='width: 5px;'>
						                            <span id='<?php echo $listing['id'];?>' access='403e2d8231130c5612884c513130f67d' class='show-cal-subscribe-url'></span></td>
						                            <td style='width: 5px;'>
						                            <span id='<?php echo $listing['id'];?>' name='ABCD123'  class='change_user_color'></span>
						                                </td></tr> 
						                                <?php
											}?>
						                                
						                                
						                                <!-- <tr class='calend1449025' ><td id='1449025' class='calendar-1449025' >
						                            <div class='userdesign  ABCD789 on ' >
						                            <a href='#' class='cal_usr'>Royal Home  Rent Team </a>
						                            </div></td>
						                            <td style='width: 5px;'>
						                            <span id='1449025' access='0d673b962282db1c54b76583f98f3473' class='show-cal-subscribe-url'></span></td>
						                            <td style='width: 5px;'>
						                            <span id='1449025' name='ABCD789'  class='change_user_color'></span>
						                                </td></tr> 
						                                
						                                
						                                <tr class='calend1449026' ><td id='1449026' class='calendar-1449026' >
						                            <div class='userdesign  ABCD789 off ' >
						                            <a href='#' class='cal_usr'>Royal Home  Sales Team </a>
						                            </div></td>
						                            <td style='width: 5px;'>
						                            <span id='1449026' access='ccc399ed9d8a6bcbf07461e7ce691a73' class='show-cal-subscribe-url'></span></td>
						                            <td style='width: 5px;'>
						                            <span id='1449026' name='ABCD789'  class='change_user_color'></span>
						                                </td></tr> 
						                                
						                                
						                                <tr class='calend1449028' ><td id='1449028' class='calendar-1449028' >
						                            <div style='color:ABCD123; border: 1px solid ABCD123; background-color: ABCD123' class='userdesign off ' >
						                            <a href='#' class='cal_usr'>Royal Home  Property Management</a>
						                            </div></td>
						                            <td style='width: 5px;'>
						                            <span id='1449028' access='e8153320e8fd4fc453a67f60459b226d' class='show-cal-subscribe-url'></span></td>
						                            <td style='width: 5px;'>
						                            <span id='1449028' name='ABCD123' class='change_user_color'></span></td></tr>    -->     
						                            
						                            
						                            
						                            
						                                            </tbody>
						            </table>
						            <form action="<?php echo base_url();?>index.php/profile/submit" method="post" enctype="multipart/form-data" id="myForm">
						            </form>
						        </div>
						    </div>
		        		</div>
		        	</div>
              </div>
              <div class="col-md-10 pull-right row">

                <div style="width: 100%; min-height: 600px;" class="dhx_cal_container dhx_scheduler_week" id="scheduler_here">
              
					<div class="dhx_cal_navline">
			            <div class="dhx_cal_prev_button">&nbsp;</div>
			            <div class="dhx_cal_next_button">&nbsp;</div>
			            <div class="dhx_cal_today_button"></div>
			            <div class="dhx_cal_date"></div>

			            <div class="dhx_cal_tab" name="day_tab" style="right:204px;"></div>
			            <div class="dhx_cal_tab" name="week_tab" style="right:140px;"></div>
			            <div class="dhx_cal_tab" name="month_tab" style="right:76px;"></div>
			            <div class="dhx_cal_tab" name="year_tab" style="right: auto;left: 197px !important;"></div>
			            <div class="dhx_cal_tab" name="grid_tab" style="right:360px;"></div>
			        </div>
			        <div class="dhx_cal_header">
			        </div>
			        <div class="dhx_cal_data" style="font-size:12px;">
			        </div>
        
		
		
		
                </div>
              </div>
              <div class="clearfix"></div>

            </div>
            <!-- uae tab content end --> 
          </div>
      </div>
      </div>
  </div>
    <!-- container end --> 
    
  </div>
<!-- wrapper end -->
 <div id="icalpopup" name="mohcine">
        <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix" style="padding:5px;">
            <span class="ui-dialog-title" id="ui-dialog-title-add-event-dialog">Calendar</span><a href="#" id="icalpopupBoxClose" class="ui-dialog-titlebar-close ui-corner-all" role="button">
                <span class="ui-icon ui-icon-closethick">close</span></a>
        </div>
        <br/>
        <p style="font-weight:bold">Calendar Subscription URL:</p>
        <span ></span>
        <textarea style="width: 98%;
                  height: 60px;
                  font-weight: bold;
                  padding: 8px 3px;" id="export_code"></textarea>

        <table width="100%">
            <tbody><tr>
                    <td valign="right" width="10%">
                   
                        <input type="button" id="select_event" class="button_repeat" value="Select" style="width:111px !important; float:right;">
                    </td>
                </tr>
            </tbody></table>
    </div>
    <!--popup for editing event-->
    <div id="edit_event_popup" name="edit_event_popup" class="draggable">

        <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix" style="padding:5px;">
            <span class="ui-dialog-title" id="ui-dialog-title-add-event-dialog">Edit event</span><a href="#" id="popupBoxClose" class="ui-dialog-titlebar-close ui-corner-all" role="button">
                <span class="ui-icon ui-icon-closethick">close</span></a>
        </div>
        <form action = "" name = "eventpopup" id = "eventpopup" method = "POST">
            <input type="hidden" id="hdn_event_id" name="hdn_event_id" />
            <input type="hidden" id="hdn_emails" name="hdn_emails" />
            <input type="hidden" id="rec_type" name="rec_type" />
            <input type="hidden" id="userColor" nam="userColor"/>
            <table>
                <tr>
                    <td>Calendar:</td>
                    <td colspan="2">
                        <select name = "users" id = "users" class="form-control input-sm form_select_fields2">
                        	<?php foreach ($cal_users as $listing): ?>
                            <option selected value='<?php echo $listing['id'] ?>'><?php echo $listing['name'] ?></option>
                           <?php endforeach;?> 
                           </select>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        Start:
                    </td>
                    <td  colspan="2">
                    		<div class="input-group">
			<input type="text" class="form-control input-sm datetimepicker" name="start_date" id="start_date">
			<div class="input-group-addon">
			<i class="fa fa-calendar-plus-o"></i>
			</div>
			</div>
                        
                    </td>
                    <td></td>

                </tr>
                <tr>
                    <td>End:</td>
                    <td  colspan="2"> 
                    	<div class="input-group">
						<input type="text" class="form-control input-sm datetimepicker form_fields1" name="end_date" id="end_date">
						<div class="input-group-addon">
						<i class="fa fa-calendar-plus-o"></i>
						</div>
                    	</div>        
                        
                    </td>
                    <td align="left"><input type="button" name="erepeat_event" id="erepeat_event" class="button_repeat" value="Repeat" >   
                    </td>
                </tr>
                <tr>
                    <td>Type:</td>
                    <td  colspan="2">
                        <select name="event_type" id="event_type" class="form-control input-sm form_select_fields2">
                            <option value="">Select</option>
							 <option value = "Viewing">Viewing</option>
							  <option value = "Meeting">Meeting</option>
							  <option value = "Schedule a call">Schedule a call</option>
							  <option value = "Holiday">Holiday</option>
							  <option value = "Public Holiday">Public Holiday</option>
                          </select>

                    </td>      
                    <td></td>
                </tr>
                <tr id="pack_user_edit_tr" class="pack_user_edit_tr">
                    <td>Pack user: </td>
                    <td colspan="2">
                        <select name="pack_agent_id" id="pack_agent_id" class="form-control input-sm form_select_fields2">
                            <?php foreach ($cal_users as $listing): ?>
                            <option selected value='<?php echo $listing['id'] ?>'><?php echo $listing['name'] ?></option>
                           <?php endforeach;?> 
                           </select>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td valign="top" style="padding-top:4px;">Reminder: </td>
                    <td valign="top" style="padding-top:4px;" colspan="2">
                        <ul id="reminder_ul_edit" valign="top">
                        </ul>
                    </td>
                    <td valign="bottom" style="padding-bottom:4px;text-align:left;">
                        <span class="rem_add_edit">
                            <a style="text-decoration:none;font-size: 16px;" href="#">+</a>
                        </span></td>
                </tr>
                <tr>
                    <td>Title:</td>
                    <td  colspan="2"><input type="text" name="event_name"  id="event_name" class="form-control input-sm form_fields1"></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Location:</td>
                    <td  colspan="2"><input type="text" name="location" id="location" class="form-control input-sm form_fields1"></td>
                    <td></td>
                </tr>
                <tr>
                    <td valign="top" style="padding-top:2px;">Description:</td>
                    <td   colspan="2" style="max-height: 200px;max-width: 200px;">
                        <textarea rows="5"  name="description" id="description" class="form-control input-sm form_fields1" style="max-height: 200px;max-width: 200px;"></textarea>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>Invitation:</td>
                    <td  colspan="2">
                        <input type="button" name="eadd_guest" id="eadd_guest" class="button_repeat" value="List of guests">
                    </td>
                    <td></td>
                </tr>
                <tr><td colspan="4" style="padding-bottom: 5px;"></td></tr>
                <tr height="30px">
                    <td colspan="4" style="padding-top: 5px; padding-bottom: 5px; border-bottom: 1px dashed #999999; border-top: 1px dashed #999999;">
                        <form id="myForm_viewings2" action="" name="myForm_viewings2" method="POST">
                            <input type="hidden" id="hdn_leads_id_edit" name="hdn_leads_id_edit" />
                            <input type="hidden" id="hdn_listings_id_edit" name="hdn_listings_id_edit" />
                            <input type="hidden" id="hdn_deals_id_edit" name="hdn_deals_id_edit" />

                            <table width="85%" border="0">
                                <tr style="font-weight:bold; color:#666 !important; font-size:12px; border-color:#fff;"> 
                                    <td style="padding-bottom: 3px; padding-top: 3px;  padding-left: 2px;">Leads ref.</td>
                                    <td></td>
                                    <td style="padding-bottom: 3px; padding-top: 3px;  padding-left: 2px;">Listings ref.</td>
                                    <td></td>
                                    <td style="padding-bottom: 3px; padding-top: 3px;  padding-left: 2px;">Deals ref.</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td style="font-size:12px; color:#000;">
                                        <input type="text"  id="lead_ref_edit" class="form-control input-sm form_fields_readonly_cal" name="lead_ref_edit" style="width:100px; height:18px;" ><br />

                                    </td>
                                    <td style="padding-top: 0px;">
                                        <a rel="#leads_viewings_select_popup" href="# popup" class="modal-link-leads">
                                            <img src="<?php echo base_url();?>mydata/images/plus_e.png">
                                        </a>
                                        <a id="del_lead_edit" href="#">
                                            <img src="<?php echo base_url();?>mydata/images/minus_e.png">
                                        </a>
                                    </td>
                                    <td style="font-size:12px; color:#000; height: 5px">
                                        <input type="text"  id="listing_ref_edit" class="form_fields_readonly_cal" name="listing_ref_edit"
                                               style="width:100px; height:18px;">

                                    </td>
                                    <td> 
                                        <a class="modal-link-leads2" href="# popup" rel="#leads_viewings_select_popup">
                                            <img src="<?php echo base_url();?>mydata/images/plus_e.png" alt="">
                                        </a>
                                        <a href="#" id="del_listing_edit">
                                            <img src="<?php echo base_url();?>mydata/images/minus_e.png">
                                        </a>
                                    </td>
                                    <td style="font-size:12px; color:#000;">
                                        <input type="text"  id="deal_ref_edit" class="form_fields_readonly_cal" name="deal_ref_edit"
                                               style="width:100px; height:18px;">

                                    </td>
                                    <td>
                                        <a class="modal-link-leads3" href="# popup" rel="#leads_viewings_select_popup">
                                            <img src="<?php echo base_url();?>mydata/images/plus_e.png" alt="">
                                        </a>
                                        <a href="#" id="del_deal_edit">
                                            <img src="<?php echo base_url();?>mydata/images/minus_e.png">
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size:11px; padding-top: 5px;">
                                        <a href="#" id="preview_lead">
                                            <img src="<?php echo base_url();?>mydata/images/view.gif" width="12" height="12">&nbsp;Preview lead
                                        </a>
                                    </td>
                                    <td></td>
                                    <td style="font-size:11px; padding-top: 5px;">
                                        <a href="#" id="preview_listing">
                                            <img src="<?php echo base_url();?>mydata/images/view.gif" width="12" height="12">&nbsp;Preview list
                                        </a>
                                    </td>
                                    <td></td>  <td style="font-size:11px; padding-top: 5px;">
                                        <a href="#" id="preview_deal">
                                            <img src="<?php echo base_url();?>mydata/images/view.gif" width="12" height="12">&nbsp;Preview deal
                                        </a>
                                    </td>
                                    <td></td>
                                </tr>
                            </table>
                        </form>
                    </td>

                </tr>
                <tr><td colspan="4" style="padding-top: 5px;"></td></tr>
                <tr><td></td> 
                    <td  colspan="3" valign="right"> <input type="button" id="cancel_edit_event_btn" name="cancel_edit_event_btn" value="Cancel" class="button_cancel">  
                        <input type="button" id="delete_event_btn" value="Delete event" class="button_guest">
                        <input type="button" id="edit_event" class=" button_creat" value="Save event">
                    </td>
                </tr>
            </table>
            <br />
        </form>
        <div id="load_lead_popup" class="draggable">
            <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix" style="padding:5px">
                <span class="ui-dialog-title" id="ui-dialog-title-add-event-dialog">Lead preview</span>
                <a href="#" id = "leadPreviewClose" class="ui-dialog-titlebar-close ui-corner-all" role="button">
                    <span class="ui-icon ui-icon-closethick">close</span></a>
            </div>
            <br />
        </div>
        <div id="load_listing_popup" class="draggable">
            <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix" style="padding:5px">
                <span class="ui-dialog-title" id="ui-dialog-title-add-event-dialog">Listing preview</span>
                <a href="#" id = "listingPreviewClose" class="ui-dialog-titlebar-close ui-corner-all" role="button">
                    <span class="ui-icon ui-icon-closethick">close</span></a>
            </div>
            <br />
        </div>
        <div id="load_deal_popup" class="draggable">
            <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix" style="padding:5px">
                <span class="ui-dialog-title" id="ui-dialog-title-add-event-dialog">Deal preview</span>
                <a href="#" id = "dealPreviewClose" class="ui-dialog-titlebar-close ui-corner-all" role="button">
                    <span class="ui-icon ui-icon-closethick">close</span></a>
            </div>
            <br />
        </div>
        <div id="eadd_guest_popup" name="eadd_guest_popup" class="draggable" >
            <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix" style="padding:5px">
                <span class="ui-dialog-title" id="ui-dialog-title-add-event-dialog">Guests</span><a href="#" id = "epopupGuestBoxClose" class="ui-dialog-titlebar-close ui-corner-all" role="button">
                    <span class="ui-icon ui-icon-closethick">close</span></a>
            </div>
            </br><br/>
            <form action = "" id = "eadd_guest_form" name = "eadd_guest_form" >
                <div id = "einner_invitation" name = "einner_invitation">
                    <div id="eadded_list">
                        <ul id="eemail_list">
                        </ul>
                    </div>
                    <div id = "eemails_list">
                        <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix" style="padding:2px">
                            <span class="ui-dialog-title" id="ui-dialog-title-add-event-dialog">Contacts</span>
                        </div>  
                        <div style='overflow: auto;max-height: 170px !important;'>
                            <ul id="eemail_list_ul">
                            </ul>
                        </div>
                    </div>
                </div>
                <div style="float:right; padding: 20px 5px 10px 10px;">
                    <table   style="text-align:right;" >
                        <tr><td><input type="text" name="eother_email" class="form_fields1" id="eother_email" /> 
                            </td><td><input type="button"  id="eadd_other_email" class="button_repeat" name="eadd_other_email" value="Add new email" /> 
                            </td>
                        </tr>
                        <tr height="30px"><td><span id="email_error_edit" style="float:left; display:none; color: red; padding-left: 3px; font-size: 11px;" >
                                    Please enter valid email address.</span></td><td></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="button" name="eadd_guest_cancel" id="eadd_guest_cancel"  class="button_cancel" value="Cancel" />
                                <input type="button" name="eadd_guest_save" id="eadd_guest_save"  class="button_creat" style="width:80px;" value="Done" />
                            </td>
                        </tr>
                    </table>
                </div> 
            </form>
        </div>
        <div id="erepeat_popup" name="erepeat_popup" class="draggable">
            <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix" style="padding:5px">
                <span class="ui-dialog-title" id="ui-dialog-title-add-event-dialog"> Repeat</span><a href="#" id="erepeatpopupClose" class="ui-dialog-titlebar-close ui-corner-all" role="button">
                    <span class="ui-icon ui-icon-closethick">close</span></a>
            </div></br>
            <form action="" id="erepeat_event_form" name="erepeat_event_form" >
                <table style=" vertical-align: middle;">
                    <tr><td width="120px">
                            Repeats: </td><td>
                            <select id="erepeat_type" name="erepeat_type" class="form-control input-sm form_select_fields1">
                                <option value="">None</option>
                                <option value="day">Daily</option>
                                <option value="week">Weekly</option>
                                <option value="month">Monthly</option>
                                <option value="year">Yearly</option>
                            </select></td>
                    </tr>
                </table>

                <div id="edaily_div" style="display:none;">
                    <table style=" vertical-align: middle;">
                        <tr>
                            <td width="120px">Repeat every:</td>
                            <td >  
                                <select id="erepeatd"   name="erepeatd" class="form-control input-sm form_select_fields1 select_daily" text-align="right" >
                                    <option value="1" selected >1</option>
                                    <option value="2" >2</option>
                                    <option value="3" >3</option>
                                    <option value="4" >4</option>
                                    <option value="5" >5</option>
                                </select>  Day(s)
                            </td>
                        </tr>
                        <tr>
                            <td>Starts on: </td>
                            <td>
                            	
					             <div class="input-group">
								<input type="text" class="form-control input-sm datetimepicker calendarsmalldateinput" name="erepstart_date" id="erepstart_date">
								<div class="input-group-addon">
								<i class="fa fa-calendar-plus-o"></i>
								</div>
								</div>
                            	</td>
                        </tr>
                        <tr>
                            <td valign="top" >Ends: </td>
                            <td> 
                                <table style=" vertical-align: middle;">
                                    <tr><td>  <input type="radio" value="0" id="eends_never_d" name="eends_on" >Never</td><td></td></tr>
                                    <tr><td>   <input type="radio" value="1" id="eends_on_d" name="eends_on" > On</td>
                                        <td> 
							              <div class="input-group">
										<input type="text" class="form-control input-sm datetimepicker calendarsmalldateinput" name="eday_ends_on" id="eday_ends_on">
										<div class="input-group-addon">
										<i class="fa fa-calendar-plus-o"></i>
										</div>
										</div>
                                        	
                                        </td></tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="eweekly_div" style="display:none;">
                    <table style=" vertical-align: middle;">
                        <tr>
                            <td width="120px">Repeat every:</td>
                            <td>  <select id="erepeatw" name="erepeatw" class="form-control input-sm form_select_fields1 select_weekly">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>  Week(s)
                            </td>
                        </tr>
                        <tr>
                            <td>Repeats on:</td>
                            <td> 
                                <input type="checkbox" class="eweekdays" value="0" name="eweek_days[]" />S 
                                <input type="checkbox" class="eweekdays" value="1" name="eweek_days[]" />M 
                                <input type="checkbox" class="eweekdays" value="2" name="eweek_days[]" />T 
                                <input type="checkbox" class="eweekdays" value="3" name="eweek_days[]" />W 
                                <input type="checkbox" class="eweekdays" value="4" name="eweek_days[]" />T 
                                <input type="checkbox" class="eweekdays" value="5" name="eweek_days[]" />F 
                                <input type="checkbox" class="eweekdays" value="6" name="eweek_days[]" />S 


                            </td>
                        </tr>
                        <tr>
                            <td>Starts on: </td>
                            <td>
                            	
                            	 <div class="input-group">
										<input type="text" class="form-control input-sm datetimepicker calendarlargedateinput" name="eweekrepstart_date" id="eweekrepstart_date">
										<div class="input-group-addon">
										<i class="fa fa-calendar-plus-o"></i>
										</div>
										</div>
								
                            	</td>
                        </tr>
                        <tr>
                            <td valign="top">Ends: </td>
                            <td> 
                                <table style=" vertical-align: middle;">
                                    <tr><td>  <input type="radio" value="0" id="eends_never_w" name="eends_on" >Never</td><td></td></tr>
                                    <tr><td>  <input type="radio" value="1" id="eends_on_w" name="eends_on" >On</td>
                                        <td>   
                                        	
                                        	<div class="input-group">
										<input type="text" class="form-control input-sm datetimepicker calendarsmalldateinput" name="eweek_ends_on" id="eweek_ends_on">
										<div class="input-group-addon">
										<i class="fa fa-calendar-plus-o"></i>
										</div>
										</div>
                                        	
                                        	 
                                        </td></tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="emonthly_div" style="display:none;">
                    <table style=" vertical-align: middle;">
                        <tr>
                            <td width="120px">Repeat every:</td>
                            <td>  <select id="erepeatm" name="erepeatm" class="form-control input-sm form_select_fields1 select_monthly">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>  Month(s)
                            </td>
                        </tr>
                        <tr>
                            <td>
                            </td>
                            <td>
                                <input type="radio" id="eday_radio" name="eday_radio" value="1" />
                                <select name="eday_of_week" id="edate_of_week" class="form-control input-sm form_select_fields1" style="width:80px;">
                                    <option value="1">First</option>
                                    <option value="2">Second</option>
                                    <option value="3">Third</option>
                                    <option value="4">Fourth</option>
                                </select>
                                <select name="edays_of_week" id="eday_of_week" class="form-control input-sm form_select_fields1" style="width:80px;">
                                    <option value="7">Sunday</option>
                                    <option value="1">Monday</option>
                                    <option value="2">Tuesday</option>
                                    <option value="3">Wednesday</option>
                                    <option value="4">Thursday</option>
                                    <option value="5">Friday</option>
                                    <option value="6">Saturday</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Starts on: </td>
                            <td>
                            <div class="input-group">
										<input type="text" class="form-control input-sm datetimepicker calendarsmalldateinput" name="emonthrepstart_date" id="emonthrepstart_date">
										<div class="input-group-addon">
										<i class="fa fa-calendar-plus-o"></i>
										</div>
										</div>	
                            	
                            	
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">Ends: </td>
                            <td> 
                                <table style=" vertical-align: middle;">
                                    <tr><td><input type="radio" value="0" id="eends_never_m" name="eends_on" >Never</td><td></td></tr>
                                    <tr><td>  <input type="radio" value="1" id="eends_on_m" name="eends_on" >On</td>
                                        <td>    
                                         <div class="input-group">
										<input type="text" class="form-control input-sm datetimepicker " name="emonth_ends_on" id="emonth_ends_on">
										<div class="input-group-addon">
										<i class="fa fa-calendar-plus-o"></i>
										</div>
										</div>		
                                        	
                                        	
                                        </td></tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="eyearly_div" style="display:none;">
                    <table style=" vertical-align: middle;">
                        <tr>
                            <td width="120px">Repeat every:</td>
                            <td> 
                                <select  id="erepeaty" name="erepeaty" class="form-control input-sm  form_select_fields1 select_yearly">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>  Year(s)
                            </td>
                        </tr>
                        <tr>
                            <td>Starts on: </td>
                            <td>
                            	
                            	<div class="input-group">
			<input type="text" class="form-control input-sm datetimepicker" name="eyearrepstart_date" id="eyearrepstart_date">
			<div class="input-group-addon">
			<i class="fa fa-calendar-plus-o"></i>
			</div>
			</div>
                            	
                            	
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">Ends: </td>
                            <td> 
                                <table style=" vertical-align: middle;">
                                    <tr><td><input type="radio" value="0" id="eends_never_y" name="eends_on" >Never</td><td></td></tr>
                                    <tr>
                                        <td><input type="radio" value="1" id="eends_on_y" name="eends_on" >On</td>
                                        <td>   
                                        	
                                        	<div class="input-group">
			<input type="text" class="form-control input-sm datetimepicker" name="eyear_ends_on" id="eyear_ends_on">
			<div class="input-group-addon">
			<i class="fa fa-calendar-plus-o"></i>
			</div>
			</div>
                                        	
                                        	
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
                <div style="float:right; padding: 50px 10px 10px 10px;">
                    <input type="button" id="erepeat_cancel" name="erepeat_cancel" class="button_cancel" value="Cancel" /> 
                    <input type="button" name="erepeat_save" id="erepeat_save" value="Save" class="button_creat" />
                </div>
            </form>
        </div>
    </div>


    <!--popup for creating new event-->
    <div id="create_event_popup" name="create_event_popup" class="draggable">

        <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix" style="padding:5px" >
            <span class="ui-dialog-title" id="ui-dialog-title-add-event-dialog">Create Event</span><a href="#" id="popupCreateBoxClose" class="ui-dialog-titlebar-close ui-corner-all" role="button">
                <span class="ui-icon ui-icon-closethick">close</span></a>
        </div>
        <form action ="" name="ceventpopup" id="ceventpopup" method = "POST">
            <input type="hidden" id="hdn_emails2" name="hdn_emails2" />
            <input type="hidden" id="hdn_repeat" name="hdn_repeat" />

            <table border="0">
                <tr>
                    <td>Calendar: </td>
                    <td>
                        <select name = "cusers" id = "cusers" class="form-control input-sm form_select_fields2">
                        	  <?php foreach ($cal_users as $listing): ?>
                            <option selected value='<?php echo $listing['id'] ?>'><?php echo $listing['name'] ?></option>
                           <?php endforeach;?> 
                            </select>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        Start:
                    </td>
                    <td>
			<div class="input-group">
			<input type="text" class="form-control input-sm datetimepicker" name="cstart_date" id="cstart_date">
			<div class="input-group-addon">
			<i class="fa fa-calendar-plus-o"></i>
			</div>
			</div>
                   
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        End:
                    </td>
                    <td>
                    	<div class="input-group">
						<input type="text" class="form-control input-sm datetimepicker form_fields1" name="cend_date" id="cend_date">
						<div class="input-group-addon">
						<i class="fa fa-calendar-plus-o"></i>
						</div>
                    	</div>
                      
                    </td>
                    <td align="left" >                
                        <input type="button" name="crepeat_event" id="crepeat_event" class="button_repeat" value="Repeat" >
                    </td>
                </tr>
                <tr>
                    <td>Type:</td>
                    <td>

                        <select name="cevent_type" id="cevent_type" class="form-control input-sm form_select_fields2">
                            <option value="">Select</option>
							 <option value = "Viewing">Viewing</option>
							  <option value = "Meeting">Meeting</option>
							  <option value = "Schedule a call">Schedule a call</option>
							  <option value = "Holiday">Holiday</option>
							  <option value = "Public Holiday">Public Holiday</option>
                          </select>
                    </td> 
                    <td align="left" >                
                        <!--<input type="button" name="cadd_viewing" id="cadd_viewing" class="button_repeat" value="Add     " >-->
                    </td>
                </tr>
                <tr id="pack_user_tr" class="pack_user_tr">
                    <td>Pack user: </td>
                    <td colspan="2">
                        <select name="pack_agent_id" id="pack_agent_id" class="form-control input-sm form_select_fields2">
                        	 <?php foreach ($cal_users as $listing): ?>
                            <option selected value='<?php echo $listing['id'] ?>'><?php echo $listing['name'] ?></option>
                           <?php endforeach;?> 
                          </select>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td valign="top" style="padding-top:4px;">Reminder:</td>
                    <td valign="top" style="padding-top:4px;">
                        <ul id="reminder_ul" valign="top">
                        </ul>

                    </td>
                    <td valign="bottom" style="padding-bottom:4px;text-align:left;"><span class="rem_add"><a style="text-decoration:none;font-size: 16px;" href="#">+</a></span></td>
                </tr>
                <tr>
                    <td>Title:</td>
                    <td ><input type="text" name="cevent_name"  id="cevent_name" class="form-control input-sm form_fields1"></td> <td></td>
                </tr>
                <tr>
                    <td>Location:</td>
                    <td><input type="text" name="clocation" id="clocation" class="form-control input-sm form_fields1"></td> <td></td>
                </tr>
                <tr>
                    <td valign="top" style="padding-top:2px;">Description:</td>
                    <td style="max-height: 200px;max-width: 200px;" ><textarea rows="5" name="cdescription" id="cdescription" class="form-control input-sm form_fields1" style="max-height: 200px;max-width: 200px;"></textarea></td> <td></td>
                </tr>
                <tr>
                    <td>Invitation:</td>
                    <td valign="left"><input type="button" name="cadd_guest"  id="cadd_guest" class="button_repeat" value="Add guests"></td>
                    <td></td>
                </tr>


                <tr><td colspan="4" style="padding-bottom: 5px;"></td></tr>
                <tr height="30px">

                    <td colspan="4" style="padding-top: 5px; padding-bottom: 5px; border-bottom: 1px dashed #999999; border-top: 1px dashed #999999;">
                        <form id="myForm_viewings" action="" name="myForm_viewings" method="POST">
                            <input type="hidden" id="hdn_leads_id" name="hdn_leads_id" />
                            <input type="hidden" id="hdn_listings_id" name="hdn_listings_id" />
                            <input type="hidden" id="hdn_deals_id" name="hdn_deals_id" />

                            <table width="85%" border="0">
                                <tr style="font-weight:bold; color:#666 !important; font-size:12px; border-color:#fff;"> 
                                    <td style="padding-bottom: 3px; padding-top: 3px;  padding-left: 2px;">Leads ref.</td>
                                    <td></td>
                                    <td style="padding-bottom: 3px; padding-top: 3px;  padding-left: 2px;">Listings ref.</td>
                                    <td></td>
                                    <td style="padding-bottom: 3px; padding-top: 3px;  padding-left: 2px;">Deals ref.</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td style="font-size:12px; color:#000;">
                                        <input type="text"  id="lead_ref" class="form-control input-sm form_fields_readonly_cal" name="lead_ref" style="width:100px; height:18px;" >

                                    </td>
                                    <td>
                                        <a rel="#leads_viewings_select_popup" href="# popup" class="modal-link-leads">
                                            <img src="<?php echo base_url();?>mydata/images/plus.png">
                                        </a>
                                        <a id="del_lead" href="#">
                                            <img src="<?php echo base_url();?>mydata/images/minus_e.png">
                                        </a>
                                    </td>
                                    <td style="font-size:12px; color:#000;">
                                        <input type="text"  id="listing_ref" class="form_fields_readonly_cal" name="listing_ref"
                                               style="width:100px; height:18px;">
                                    </td>
                                    <td>
                                        <a class="modal-link-leads2" href="# popup" rel="#leads_viewings_select_popup">
                                            <img src="<?php echo base_url();?>mydata/images/plus.png" alt="">
                                        </a>
                                        <a id="del_listing" href="#">
                                            <img src="<?php echo base_url();?>mydata/images/minus_e.png">
                                        </a>
                                    </td>
                                    <td style="font-size:12px; color:#000;">
                                        <input type="text"  id="deal_ref" class="form_fields_readonly_cal" name="deal_ref"
                                               style="width:100px; height:18px;">
                                    </td>
                                    <td>
                                        <a class="modal-link-leads3" href="# popup" rel="#leads_viewings_select_popup">
                                            <img src="<?php echo base_url();?>mydata/images/plus.png" alt="">
                                        </a>
                                        <a id="del_deal" href="#">
                                            <img src="<?php echo base_url();?>mydata/images/minus_e.png">
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </form>

                    </td>
                </tr>

                <tr><td colspan="4" style="padding-bottom: 5px;"></td></tr>
                <tr><td></td><td align="right" style="text-align:center;">
                        <input type="button" id="cancel_create_event_btn" value="Cancel" class="button_cancel"> 
                        <input type="button" id="create_event" name="create_event" value="Create event" class="button_creat"  align="right" /></td>
                    <td></td></tr>
            </table>
            <br />
        </form>






        <!--add guest popup-->
        <div id="cadd_guest_popup" name="cadd_guest_popup" class="draggable">
            <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix" style="padding:5px;">
                <span class="ui-dialog-title" id="ui-dialog-title-add-event-dialog">Guests</span><a href="#" id = "cpopupGuestBoxClose" class="ui-dialog-titlebar-close ui-corner-all" role="button">
                    <span class="ui-icon ui-icon-closethick">close</span></a>
            </div>      
            <br/><br />
            <form action="" id="add_guest_form" name="add_guest_form">
                <div id="cinner_invitation" name="cinner_invitation">
                    <div id="cadded_list">
                        <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix" style="padding:2px">
                            <span class="ui-dialog-title" id="ui-dialog-title-add-event-dialog">Invited guests</span>
                        </div>
                        <ul id="cemail_list_ul">
                        </ul>
                    </div>
                    <div id="cemails_list">
                        <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix" style="padding:2px">
                            <span class="ui-dialog-title" id="ui-dialog-title-add-event-dialog">Contacts</span>
                        </div>

                        <div style='overflow: auto;max-height: 174px !important;'>
                            <ul id="cemails_ul">
                                                            </ul>
                        </div> </div>
                </div>

                <div style="float:right; padding: 20px 5px 10px 10px;">
                    <table   style="text-align:right;" >
                        <tr><td><input type="text" name="cother_email" class="form_fields1" id="cother_email" /> 
                            </td>
                            <td>
                                <input type="button"  id="cadd_other_email" class="button_repeat" name="cadd_other_email" value="Add new email" /> 
                            </td>
                        </tr>
                        <tr height="30px"><td><span id="email_error" style="float:left; display:none; color: red; padding-left: 3px; font-size: 11px;" >
                                    Please enter valid email address.</span></td><td></td></tr>
                        <tr>
                            <td colspan="2">
                                <input type="button" name="cadd_guest_cancel" id="cadd_guest_cancel"  class="button_cancel" value="Cancel" />
                                <input type="button" name="csend_invite_button" id="csend_invite_button"  class="button_creat" style="width:80px;"  value="Done" />
                            </td>
                        </tr>
                    </table>
                </div> 
            </form>
        </div>
        <!--repeating event popup-->
        <div id="crepeat_popup" name="crepeat_popup" class="draggable">
            <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix" style="padding:5px">
                <span class="ui-dialog-title" id="ui-dialog-title-add-event-dialog"> Repeat</span><a href="#" id="repeatpopupClose" class="ui-dialog-titlebar-close ui-corner-all" role="button">
                    <span class="ui-icon ui-icon-closethick">close</span></a>
            </div></br>
            <form action="" id="crepeat_event_form" name="crepeat_event_form" >
                <table style=" vertical-align: middle;">
                    <tr><td width="120px">
                            Repeats: </td><td>
                            <select id="repeat_type" name="repeat_type" class="form-control input-sm form_select_fields1">
                                <option value="">None</option>
                                <option value="day">Daily</option>
                                <option value="week">Weekly</option>
                                <option value="month">Monthly</option>
                                <option value="year">Yearly</option>
                            </select></td>
                    </tr>
                </table>

                <div id="daily_div" style="display:none;">
                    <table style=" vertical-align: middle;">
                        <tr>
                            <td width="120px">Repeat every:</td>
                            <td >  
                                <select  name="repeatd" class="form-control input-sm form_select_fields1 select_daily" text-align="right" >
                                    <option value="1" selected >1</option>
                                    <option value="2" >2</option>
                                    <option value="3" >3</option>
                                    <option value="4" >4</option>
                                    <option value="5" >5</option>
                                </select>  Day(s)
                            </td>
                        </tr>
                        <tr>
                            <td>Starts on: </td>
                            <td>
                            	
                            	
                            	<div class="input-group">
			<input type="text" class="form-control input-sm datetimepicker" name="repstart_date" id="repstart_date">
			<div class="input-group-addon">
			<i class="fa fa-calendar-plus-o"></i>
			</div>
			</div>
                           </td>
                        </tr>
                        <tr>
                            <td valign="top" >Ends: </td>
                            <td> 
                                <table style=" vertical-align: middle;">
                                    <tr><td>  <input type="radio" value="0" id="ends_never_d" name="ends_on" >Never</td><td></td></tr>
                                    <tr><td>   <input type="radio" value="1" id="ends_on_d"  name="ends_on" >On</td>
                                        <td> 
                                        	
                                        	<div class="input-group">
			<input type="text" class="form-control input-sm datetimepicker" name="day_ends_on" id="day_ends_on">
			<div class="input-group-addon">
			<i class="fa fa-calendar-plus-o"></i>
			</div>
			</div>
                                        	
                                        	
                                        </td></tr> 
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="weekly_div" style="display:none;">
                    <table style=" vertical-align: middle;">
                        <tr>
                            <td width="120px">Repeat every:</td>
                            <td>  <select name="repeatw" class="form-control input-sm form_select_fields1">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>  Week(s)
                            </td>
                        </tr>
                        <tr>
                            <td>Repeats on:</td>
                            <td> 
                                <input type="checkbox" value="0" name="week_days[]" />S 

                                <input type="checkbox" value="1" name="week_days[]" />M 
                                <input type="checkbox" value="2" name="week_days[]" />T 
                                <input type="checkbox" value="3" name="week_days[]" />W 
                                <input type="checkbox" value="4" name="week_days[]" />T 
                                <input type="checkbox" value="5" name="week_days[]" />F 
                                <input type="checkbox" value="6" name="week_days[]" />S 
                            </td>
                        </tr>
                        <tr>
                            <td>Starts on: </td>
                            <td>
                            	
                            	<div class="input-group">
			<input type="text" class="form-control input-sm datetimepicker" name="repstart_date" id="repstart_date">
			<div class="input-group-addon">
			<i class="fa fa-calendar-plus-o"></i>
			</div>
			</div>
                            	
                            	
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">Ends: </td>
                            <td> 
                                <table style=" vertical-align: middle;">
                                    <tr><td>  <input type="radio" value="0" id="ends_never_w"  name="ends_on" >Never</td><td></td></tr>
                                    <tr><td>  <input type="radio" value="1" id="ends_on_w"  name="ends_on" >On</td>
                                        <td>   
                                        	
                                        	<div class="input-group">
			<input type="text" class="form-control input-sm datetimepicker" name="week_ends_on" id="week_ends_on">
			<div class="input-group-addon">
			<i class="fa fa-calendar-plus-o"></i>
			</div>
			</div>
                                        	
                                        	 
                                        </td></tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="monthly_div" style="display:none;">
                    <table style=" vertical-align: middle;">
                        <tr>
                            <td width="120px">Repeat every:</td>
                            <td>  <select name="repeatm" class="form-control input-sm form_select_fields1">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>  Month(s)
                            </td>
                        </tr>
                        <tr>
                            <td>
                            </td>
                            <td>
                                <input type="checkbox" name="day_radio" value="1" />
                                <select name="day_of_week" class="form-control input-sm form_select_fields1" style="width:87px;">
                                    <option value="1">First</option>
                                    <option value="2">Second</option>
                                    <option value="3">Third</option>
                                    <option value="4">Fourth</option>
                                </select>
                                <select name="days_of_week" class="form-control input-sm form_select_fields1" style="width:87px;float:right;margin-right: 3px;">
                                    <option value="7">Sunday</option>
                                    <option value="1">Monday</option>
                                    <option value="2">Tuesday</option>
                                    <option value="3">Wednesday</option>
                                    <option value="4">Thursday</option>
                                    <option value="5">Friday</option>
                                    <option value="6">Saturday</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Starts on: </td>
                            <td>
                                       
                                       
                                       <div class="input-group">
			<input type="text" class="form-control input-sm datetimepicker" name="repstart_date" id="repstart_date">
			<div class="input-group-addon">
			<i class="fa fa-calendar-plus-o"></i>
			</div>
			</div>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">Ends: </td>
                            <td> 
                                <table style=" vertical-align: middle;">
                                    <tr><td><input type="radio" value="0" id="ends_never_m"  name="ends_on" >Never</td><td></td></tr>
                                    <tr><td>  <input type="radio" value="1" id="ends_on_m"  name="ends_on" >On</td>
                                        <td>   
                                        	
                                        	 <div class="input-group">
			<input type="text" class="form-control input-sm datetimepicker" name="month_ends_on" id="month_ends_on">
			<div class="input-group-addon">
			<i class="fa fa-calendar-plus-o"></i>
			</div>
			</div>
                                        	
                                        	
                                        </td></tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="yearly_div" style="display:none;">
                    <table style=" vertical-align: middle;">
                        <tr>
                            <td width="120px">Repeat every:</td>
                            <td>  <select name="repeaty" class="form-control input-sm form_select_fields1">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>  Year(s)
                            </td>
                        </tr>
                        <tr>
                            <td>Starts on: </td>
                            <td>
                            	
                            	 <div class="input-group">
			<input type="text" class="form-control input-sm datetimepicker" name="repstart_date" id="repstart_date">
			<div class="input-group-addon">
			<i class="fa fa-calendar-plus-o"></i>
			</div>
			</div>
                            	
                            	
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">Ends: </td>
                            <td> 
                                <table style=" vertical-align: middle;">
                                    <tr><td><input type="radio" value="0" id="ends_never_y"  name="ends_on" >Never</td><td></td></tr>
                                    <tr><td>  <input type="radio" value="1" id="ends_on_y"  name="ends_on" >On</td>
                                        <td>    
                                        	
                                        	<div class="input-group">
			<input type="text" class="form-control input-sm datetimepicker" name="year_ends_on" id="year_ends_on">
			<div class="input-group-addon">
			<i class="fa fa-calendar-plus-o"></i>
			</div>
			</div>
                                        	
                                        	
                                        </td></tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
                <div style="float:right; padding: 50px 10px 10px 10px;">
                    <input type="button" id="crepeat_cancel" name="crepeat_cancel" class="button_cancel" value="Cancel" /> 
                    <input type="button" name="crepeat_save" id="crepeat_save" value="Save" class="button_creat" />
                </div>
            </form>
        </div>

    </div>
    <form action="http://gistler.com/gistler/gistlercrm/mydata/ical_download.php" method="post" target="hidden_frame" accept-charset="utf-8" id="hhh">
        <input type="hidden" name="data" value="" id="data">
        <input type="hidden" name="cal_user_id" value="" id="cal_user_id">
    </form>
    <iframe src='about:blank' frameborder="0" style="width:0px; height:0px;" id="hidden_frame" name="hidden_frame"></iframe>

<script type="text/javascript" src="<?php echo site_url();?>js_module/calendar.js"></script> 
<script type="text/javascript" charset="utf-8">

function download(user_id) {
        var form = document.forms['hhh'];
       // form.action = "./data/ical_download.php";
        form.elements.data.value = scheduler.toICal();
        form.elements.cal_user_id.value = user_id;
         $('#export_code').html("http://gistler.com/gistler/gistlercrm/uploads/iCal/"+user_id+".ical");
        form.submit();
    }

        function myOwnDateParser(mydate) {
            str = mydate.toString();
            var newDate = '';
            thedate = str.split(" ");
            theMonth = returnMonth(thedate[1]);
            theDay = thedate[2];
            theYear = thedate[3];
            theTime = thedate[4];
            mynewdate = theYear + "-" + theMonth + "-" + theDay + " " + theTime;
            return mynewdate;
        }
        function returnMonth(index) {
            var months = {'Jan': '01', 'Feb': '02', 'Mar': '03', 'Apr': '04', 'May': '05', 'Jun': '06', 'Jul': '07', 'Aug': '08', 'Sep': '09', 'Oct': '10', 'Nov': '11', 'Dec': '12'};
            return months[index];
        }

        //Agenda view
        scheduler.locale.labels.grid_tab = "Agenda";
        function myOwnDateParseragenda(mydate) {
            str = mydate.toString("dddd MMMM d, yyyy");
            var newDate = '';
            thedate = str.split(" ");
            theDayNumber = thedate[0];
            theMonth = thedate[1];
            theDay = thedate[2];
            theYear = thedate[3];
            mynewdate = theDayNumber + ", " + theMonth + " " + theDay + ", " + theYear;
            return mynewdate;
        }

        function myOwnTimeagenda(mydate) {
            str = mydate.toString("dddd MMMM d, yyyy");
            var newDate = '';
            thedate = str.split(" ");
            thehour = thedate[4];
            mynewdate = thehour;
            return mynewdate;
        }

        scheduler.createGridView({
            name: "grid",
            fields: [{id: "date", label: 'Date', width: '300', sort: 'date', align: 'center', template: function(start, end, ev) {
                        return '<table><tr><td><div class="agendatabdate">' + myOwnDateParseragenda(start) + "</div></td><td><div class='agendatabhour'>" + myOwnTimeagenda(start) + "-" + myOwnTimeagenda(end) + '</div></td></tr></table>';
                    }},
                {id: "text", label: 'Event name', align: 'center', template: function(start, end, ev) {
                        return '<div class="agendaeventname">' + ev.text + "</div>";
                    }},
                {id: "location", label: 'Event Location', align: 'center', template: function(start, end, ev) {
                        return '<div class="agendatabusers">' + ev.location + "</div>";
                    }},
                {id: "username", label: 'Assigned to', align: 'center', template: function(start, end, ev) {
                        return '<div class="agendatabusers">' + ev.first_name + "&nbsp;" + ev.last_name + '</div>'
                    }}
            ]
        });

        //end of Agenda view
        
       
        
        
        //intialize start from here
        scheduler.config.xml_date = "%Y-%m-%d %H:%i";
        scheduler.config.limit_view = false;
        scheduler.config.first_date = 'Sunday';
        scheduler.config.first_hour = 00;
        scheduler.config.last_hour = 24;
        scheduler.config.scroll_hour = 08;
        scheduler.config.multi_day = true;
        scheduler.init('scheduler_here', new Date(), "month");
        scheduler.config.repeat_date = "%m/%d/%Y";
        scheduler.config.start_on_monday = false;
        
       var users = scheduler.load("<?php echo base_url();?>calendar/getAllUsers");
     
      
        scheduler.config.agenda_start = new Date(); //now
        //  var currentDateTime = new Date();
        //        var oneYear = new Date();
        //        oneYear.setYear(oneYear.getFullYear() + 1);
        //        oneYear = myOwnDateParser(oneYear);
        scheduler.config.grid_end = new Date(2016, 0, 1);
        scheduler.config.cascade_event_display = true; // to enable cascade rendering
        scheduler.config.cascade_event_count = 15; // how many levels (maximum) should be used
        scheduler.config.cascade_event_margin = 10; // margin in px between levels
        scheduler.config.drag_resize = true;

        //changing dbl click event to single click
        scheduler.attachEvent("onClick", function(id, e) {
            scheduler._on_dbl_click(e);
            return false;
        });

        dhtmlxEvent(scheduler._els["dhx_cal_data"][0], "click", function(e) {
            if (!scheduler._locate_event(e ? e.target : event.srcElement)) {
                scheduler._on_dbl_click(e);
            }
        });



        scheduler.attachEvent("onClick", function(id) {
//            var evt = scheduler.getEvent(id);
            $('#hdn_leads_id_edit').val('');
            $('#hdn_listings_id_edit').val('');
            $('#hdn_deals_id_edit').val('');
            $("#hdn_emails2").val('');
            $('#edit_event_popup').fadeIn("fast");
            $("#erepeat_popup").css('display', 'none');
            document.erepeat_event_form.reset();
            $("#edaily_div").hide();
            $("#eweekly_div").hide();
            $("#emonthly_div").hide();
            $("#eyearly_div").hide();
            $("body").append('<div class="ui-widget-overlay" style="width: 1906px; height: 1160px; z-index: 1001;"></div>');
            $(document).keydown(function(e) {
                if (e.keyCode === 27) {
                    $('#edit_event_popup').fadeOut("fast");
                    $(".ui-widget-overlay").hide('fast');
                    $('#load_lead_popup').hide('fast');
                    $('#load_listing_popup').hide('fast');
                    $('#load_deal_popup').hide('fast');
                }
            });
            var start = scheduler.getEvent(id).start_date;
            var end = scheduler.getEvent(id).end_date;
            var ev_id = scheduler.getEvent(id).id;
            $("input#hdn_event_id").val(ev_id);
            start = myOwnDateParser(start);
            end = myOwnDateParser(end);
            //Ajax call to retrieve data to populate edit event popup
            $.getJSON("<?php echo base_url();?>calendar/getEventInfo", {event_id: ev_id}, function(json) {
                var timeMainArray = Array();
                var timeUnitMainArray = Array();
                var timeTypesArray = Array();
                var timeEventId = Array();
                timeTypesArray['minute'] = "Minutes";
                timeTypesArray['hour'] = "Hours";
                timeTypesArray['day'] = "Days";
                timeTypesArray['week'] = "Weeks";
                $.each(json, function(key, val) {
                    $("#" + key).val(val);
                    
                    if (key === "time") {
                        var thisTime = val;
                        thisTime = thisTime.split("|");
                        var length = thisTime.length;
                        for (var i = 0; i < length; i++) {
                            if (thisTime[i].length > 0) {
                                timeMainArray.push('<input maxlength="2" type="text" size="12" value="' + thisTime[i] + '" name="ctime_' + i + '" id="ctime_' + i + '" class="form-control input-sm form_fields1" style="width:20px;text-align:right;" />');
                            }
                        }
                    }

                    if (key === "timeunit") {
                        var thisTimeUnit = val;
                        thisTimeUnit = thisTimeUnit.split("|");
                        var length = thisTimeUnit.length;
                        $("#editTimeUnit").html('');
                        for (var j = 0; j < length; j++) {
                            if (thisTimeUnit[j].length > 0) {
                                var selectMenu = '<select class="form-control input-sm form_select_fields1  timer-class" id="ctimeunit_' + j + '" name="ctimeunit_' + j + '">';
                                for (a in timeTypesArray) {
                                    if (thisTimeUnit[j] == a) {
                                        selectMenu += '<option selected value="' + a + '">' + timeTypesArray[a] + '</option>';
                                    } else {
                                        selectMenu += '<option value="' + a + '">' + timeTypesArray[a] + '</option>';
                                    }

                                }
                                selectMenu += '</select>';
                                selectMenu += '&nbsp;&nbsp;<span class="form-control input-sm rem_remove_edit2"><a style="text-decoration:none; font-size:16px;" href="#">-</a></span>';
                                timeUnitMainArray.push(selectMenu);
                            }
                        }
                    }

                    if (key === "event_id") {
                        var rem_event_id = val;
                        var length = rem_event_id.length;
                        for (var i = 0; i < length; i++) {
                            if (rem_event_id[i].length > 0) {
                                timeEventId.push('<p>' + rem_event_id[i] + '</p>');
                            }
                        }
                    }

                    if (key === "pack_agent_id" && val == "") {
                        $('#pack_user_edit_tr').css('display', 'none');
                    }
                    if (key === "pack_agent_id" && val != "") {
                        $('#pack_user_edit_tr').css('display', '');
                    }

                });
                $('#reminder_ul_edit').html('');
                ecurrentId = timeMainArray.length;
                for (var mainloop = 0; mainloop < timeMainArray.length; mainloop++) {
                    var finalElement = "<li id=\"rem_li_" + mainloop + "\" >" + timeMainArray[mainloop] + "&nbsp;&nbsp;" + timeUnitMainArray[mainloop] + '</li>';
                    $('#reminder_ul_edit').append(finalElement);
                }
            });
            $.get("<?php echo base_url();?>calendar/getGuestEmails/" + ev_id, function(data) {
                $("#eadded_list").html(data);
            });
            loadRepeatEvent();
        });

        scheduler.templates.event_text = function(start, end, event) {
                        return event.text + ' (' + event.first_name + ')';
                }

        scheduler.attachEvent("onEventCreated", function(event_id, event_object) {

            var repstart_date = scheduler.getEvent(event_id).start_date;
            repstart_date = myOwnDateParser(repstart_date);
            $("input#repstart_date").val(repstart_date);
            $("#crepeat_popup").fadeOut('fast');
            $("#cusers").val('1448804');
            $("#cevent_type").val('');
            $("#cevent_name").val('');
            $("#clocation").val('');
            $("#cdescription").val('');
            $("#crepeat_popup").css('display', 'none');
            $('#create_event_popup').fadeIn("slow");
            $("#reminder_ul").html('');
            $('#lead_ref').val('');
            $('#listing_ref').val('');
            $('#deal_ref').val('');
            $('#hdn_leads_id').val('');
            $('#hdn_listings_id').val('');
            $('#hdn_deals_id').val('');
            $('#hdn_leads_id_edit').val('');
            $('#hdn_listings_id_edit').val('');
            $('#hdn_deals_id_edit').val('');
            //$('#cadd_viewing').attr('style', 'display:none');

            currentId = 0;
            document.ceventpopup.reset();
            document.crepeat_event_form.reset();
            $("#daily_div").hide();
            $("#weekly_div").hide();
            $("#monthly_div").hide();
            $("#yearly_div").hide();
            $('#cemail_list_ul li').remove();


            scheduler.templates.event_class = function(start, end, event) {

                if (event.access == 1) {
                    if (event.access == 1) {
                        return 'agent_bg_' + event.assigned_to + ' managerColor';
                    } else if (event.access == 2) {
                        return 'agent_bg_' + event.assigned_to + ' adminColor';
                    } else if (event.access == 3) {
                        return 'agent_bg_' + event.assigned_to + ' userColor';
                    }
                    else {
                        return 'agent_bg_' + event.assigned_to;
                    }
                }
                if (event.access == 2) {
                    if (event.access == 1) {
                        return 'agent_bg_' + event.assigned_to + ' managerColor';
                    } else if (event.access == 2) {
                        return 'agent_bg_' + event.assigned_to + ' adminColor';
                    } else if (event.access == 3) {
                        return 'agent_bg_' + event.assigned_to + ' userColor';
                    }
                    else {
                        return 'agent_bg_' + event.assigned_to;
                    }
                }
                if (event.access == 3) {
                    if (event.access == 1) {
                        return 'agent_bg_' + event.assigned_to + ' managerColor';
                    } else if (event.access == 2) {
                        return 'agent_bg_' + event.assigned_to + ' adminColor';
                    } else if (event.access == 3) {
                        return 'agent_bg_' + event.assigned_to + ' userColor';
                    }
                    else {
                        return 'agent_bg_' + event.assigned_to;
                    }
                }
            };


            $("body").append('<div class="ui-widget-overlay" style="width: 1906px; height: 1160px; z-index: 1001;"></div>');
            $(document).keydown(function(e) {
                if (e.keyCode === 27) {

                    $('#listings_popup').attr('style', 'display:none;');
                    if ($('#staff-mode-show-users-calendars').hasClass("on")) {
                        getSingle_calendar_show();
                    } else {
                        loadSchedulerInitLoad();
                        //scheduler.load("<?php echo base_url();?>calendar/initLoad/");
                    }
                    $('#create_event_popup').fadeOut("fast");
                    $(".ui-widget-overlay").hide('fast');
                    $("#leads_viewings_select_popup").hide('fast');
                    $('#cemail_list_ul li').remove();
                }
            });
            var cstart = scheduler.getEvent(event_id).start_date;
            var cend = scheduler.getEvent(event_id).end_date;
            cstart = myOwnDateParser(cstart);
            cend = myOwnDateParser(cend);
            $("input#cstart_date").val(cstart);
            $("input#cend_date").val(cend);
            $("#hdn_emails2").val('');
            $("#hdn_emails").val('');
        }); //end of event create
        //Auto refresh, refreshes every 30 seconds
        var mainInterval = setInterval(function() {
            /* global load */
            if ($("#staff-mode-show-users-calendars").hasClass("on")) {
            	
                scheduler.load("<?php echo base_url();?>calendar/getUserEventById?ids=1448804");
            } else {
                loadSchedulerInitLoad();
                //scheduler.load("<?php echo base_url();?>calendar/initLoad/");

            }             /* end global load */
        }, 30 * 1000);
        var dp = new dataProcessor("<?php echo base_url();?>calendar/data");
        dp.action_param = "dhx_editor_status";
        dp.attachEvent("onAfterUpdate", function(sid, action, tid, response) {
            if (action === "invalid") {
            	alert("mara kho");
                alert(response.getAttribute("details"));
            }
        });
        dp.init(scheduler);
        var calendar = scheduler.renderCalendar({
            container: "cal_here",
            navigation: true,
            handler: function(date) {
                scheduler.setCurrentView(date, scheduler._mode);
            }
        });
        scheduler.linkCalendar(calendar);
        scheduler.setCurrentView(scheduler._date, scheduler._mode);
        $(document.body).on("click", '#staff-mode-show-users-calendars', function(event) {
            if ($("#staff-mode-show-users-calendars").hasClass("off")) {
                $("#staff-mode-show-users-calendars").addClass('on').removeClass('off');
                getSingle_calendar_show();
            } else {
                $("#staff-mode-show-users-calendars").addClass('off').removeClass('on');
                getSingle_calendar_hide();
            }
        });
        $(document.body).on("click", '.show-cal-subscribe-url', function(event) {
            $('#icalpopup').fadeIn("slow");
            $("body").append('<div class="ui-widget-overlay" style="width: 1906px; height: 1160px; z-index: 1001;"></div>');
            var user_id = $(this).attr('id');
            var access_key = $(this).attr('access');
            //var iCal_Path = save_iCalFile(user_id);
            download(user_id);
            //alert(iCal_Path);
            //$('#export_code').html('application/views/smartphpcalendar/export.php?m=calendar&a=exportCalendar&calId=' + user_id + '&access_key=' + access_key);
            //$('#export_code').html('<?php echo base_url();?>application/views/smartphpcalendar/export.php?m=calendar&a=exportCalendar&userID=' + user_id + '&accessKey=' + access_key);
            
            $(document).keydown(function(e) {
                if (e.keyCode === 27) {
                    $('#icalpopup').fadeOut("fast");
                    $(".ui-widget-overlay").hide('fast');
                }
            });
        });
        function settings_calendar(id) {
            user_numbers = '';
            $('#calendar tr td').each(function() {
                var ids = $(this).attr('id');
                if ($(".calendar-" + ids + " div").hasClass("on")) {
                    user_numbers = ids + ',' + user_numbers;
                }
            });
            user_numbers = user_numbers.substring(0, user_numbers.length - 1);
            $.ajax({
                type: 'GET',
                url: "<?php echo base_url();?>calendar/updateUserSettings/?idUser=" + user_numbers,
                success: function(msg) {

                }
            });
        }
        function save_iCalFile(user_id)
        {
            var cal_data = scheduler.toICal();
             $.ajax({
                type: 'GET',
                url: "<?php echo base_url();?>calendar/saveiCal/?idUser=" + user_id+"&iCal="+cal_data,
                success: function(data) {
                 $('#export_code').html("http://gistler.com/gistler/gistlercrm/uploads/iCal/"+user_id+".ical");
                    return data;
                },
                error: function() {
                    alert('Error occured! Try later');
                }
            });
        }
        function getSingleRow_calendar() {
           
            user_numbers = '';
            $('#calendar tr td').each(function() {
                var ids = $(this).attr('id');
                if ($(".calendar-" + ids + " div").hasClass("on")) {
                    user_numbers = ids + ',' + user_numbers;
                }
            });
            user_numbers = user_numbers.substring(0, user_numbers.length - 1);

            //clear the previous calendars
             scheduler.clearAll();

             //now show the selected users calendars
            scheduler.load("<?php echo base_url();?>calendar/getSingleUserById?ids=" + user_numbers);
        }
        function getSingle_calendar_show() {
            user_numbers = '';
            $('#calendar tr td').each(function() {
                var ids = $(this).attr('id');
                
                if (ids == 1448804) {
                    user_numbers = ids;
                } else {
                    $(".calend" + ids).css('display', 'none');
                    if ($(".calendar-" + ids + " div").hasClass("off")) {
                        $(".calendar-" + ids + " div").addClass('offf').removeClass('off');

                    } else {
                        $(".calendar-" + ids + " div").addClass('onn').removeClass('on');
                    }
                }
            });
           
            scheduler.load("<?php echo base_url();?>calendar/getUserEventById?ids=" + user_numbers);
        }
        function getSingle_calendar_hide() {

            user_numbers = '';
            $('#calendar tr td').each(function() {
                var ids = $(this).attr('id');
                $(".calend" + ids).css('display', '');
                if ($(".calendar-" + ids + " div").hasClass("offf")) {
                    $(".calendar-" + ids + " div").addClass('off').removeClass('offf');
                } else {
                    $(".calendar-" + ids + " div").addClass('on').removeClass('onn');
                }
                if ($(".calendar-" + ids + " div").hasClass("on")) {
                    user_numbers = ids + ',' + user_numbers;
                }
            });
            user_numbers = user_numbers.substring(0, user_numbers.length - 1);
            //clear previous calendar
             scheduler.clearAll();

             //now load calendar for the selected users
            scheduler.load("<?php echo base_url();?>calendar/getSingleUserById?ids=" + user_numbers);
        }
        scheduler.attachEvent("onBeforeDrag", function(event_id, mode, native_event_object) {
            return true;
        });


        scheduler.attachEvent("onEventChanged", function(event_id, ev, event_object) {

            if (scheduler._drag_mode == 'move') {
                //document.body.style.cursor = "not-allowed";
            }

            if (scheduler._drag_mode) { // or you can check even further: scheduler._drag_mode == 'move' || scheduler._drag_mode == 'resize'

                var sdate = scheduler.getEvent(event_id).start_date;
                sdate = myOwnDateParser(sdate);
                $.get("<?php echo base_url();?>calendar/updateByDraggingEvent/" + event_id + "/" + sdate, function(data) {
                    if ($('#staff-mode-show-users-calendars').hasClass("on")) {
                        getSingle_calendar_show();
                    } else {
                        loadSchedulerInitLoad();
                        //scheduler.load("<?php echo base_url();?>calendar/initLoad/");
                    }
                });
            }

        });</script>
       
    <script type="text/javascript">
        $(document).ready(function() {

            // Hide all Modal Boxes
            $('div.modal-box').hide();
            // Display appropriate box on click - adjust this as required for your website

            $('.modal-link-leads').unbind("click");
            $(document.body).on("click", '.modal-link-leads', function() {
                $('#leads_viewing_html').html('');
                get_leads_html($(this).attr('id'));
                var modalBox = $(this).attr('rel');
                
                $('div' + modalBox).fadeIn('fast');
                return false;
            });
            $(document.body).on("click", '.modal-link-leads2', function() {
                $('#listings_viewing_html').html('');
                get_listings_html($(this).attr('id'));
                var modalBox = $(this).attr('rel');
                $('div' + modalBox).fadeIn('fast');
                return false;
            });
            $(document.body).on("click", '.modal-link-leads3', function() {
                $('#listings_viewing_html').html('');
                get_deals_html($(this).attr('id'));
                var modalBox = $(this).attr('rel');
                $('div' + modalBox).fadeIn('fast');
                return false;
            });
            // Multiple ways to close a Modal Box
            $('span.modal-close').click(function() {
                $(this).parents('div.modal-box').fadeOut('fast');
            });
            $('span.dismiss').click(function() {
                $(this).parents('div.modal-box').fadeOut('fast');
                $("#pane_1, .tabs").css({opacity: 1});
            });
            $('span.save').click(function() {
                // **** If you need to save or submit information - add your appropriate ajax code here
                $(this).parents('div.modal-box').fadeOut('fast');
            });
        });
        function get_leads_html(id) {

            $("#pane_1, .tabs").css({opacity: 0.5});
            $.post('<?php echo base_url();?>popup/link_lead_popup/', {id: id},
            function(data) {
                $('#leads_viewing_html').html(data);
            });
        }
        function get_listings_html(id) {
            $("#pane_1, .tabs").css({opacity: 0.5});
            $.post('<?php echo base_url();?>listings/linktolistings_viewings/', {id: id},
            function(data) {
                $('#leads_viewing_html').html(data);
            });
        }
        function get_deals_html(id) {
            $("#pane_1, .tabs").css({opacity: 0.5});
            $.post('<?php echo base_url();?>popup/link_deal_popup/', {id: id},
            function(data) {
                $('#leads_viewing_html').html(data);
            });
        }
        function loadSchedulerInitLoad() {
        	 //show reminder
  //       var from = new Date();
  //       var to = scheduler.date.add(from, 15, "minute");
		// var evs = scheduler.getEvents(from, to);
		// if (evs.length > 0) {
		//    // dhtmlx.message("You have "+evs.length+" upcoming events!");
		//     //message-related initialization
		// 	dhtmlx.alert({
		// 	    text: "You have "+evs.length+" upcoming events!",
		// 	    callback: function() {dhtmlx.alert("You have "+evs.length+" upcoming events!");}
		// 	});
			
		// }
		// end show reminder
            var qString = '';
            scheduler.load("<?php echo base_url();?>calendar/initLoad/");

        }
    </script>
