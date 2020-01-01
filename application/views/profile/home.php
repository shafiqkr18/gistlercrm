<script src="<?php echo base_url();?>js/bootstrap-colorpicker.js"></script>
<link href="<?php echo base_url();?>css/bootstrap-colorpicker.css" rel="stylesheet">
<link href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet">
<script>
    //for now keep last_id=0
    var last_id = 0;
    var screenname = "profile";
    $(function() {
        $('.color-pick').colorpicker({
            customClass: 'colorpicker-2x',
            sliders: {
                saturation: {
                    maxLeft: 200,
                    maxTop: 200
                },
                hue: {
                    maxTop: 200
                },
                alpha: {
                    maxTop: 200
                }
            }
        });
    });
</script>
<div id="wrapper">
    <div class="container">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <div class="page_head_area">
                    <h1><a href="javascript:autofill()" id="autoFillForm"><i class="fa fa-gears"></i></a> Profile</h1></div>
            </div>
        </div>
        <!-- Error Message Alert -->
        <div role="alert" class="alert alert-danger alert-dismissible fade in" id="errorMsg" style="display:none;">
            <button aria-label="Close" data-dismiss="alert" class="close" type="button">
              <span aria-hidden="true">×</span></button>
            <strong>Error!</strong> <span id="errortxt">here is error text</span>
        </div>
        <!-- Success Message Alert -->
        <div role="alert" class="alert alert-success alert-dismissible fade in" id="successMsg" style="display:none;">
            <button aria-label="Close" data-dismiss="alert" class="close" type="button">
              <span aria-hidden="true">×</span></button>
            <strong>Success!</strong> <span id="successtxt">here is success text</span>
        </div>
        <!-- Info Message Alert -->
        <div role="alert" class="alert alert-info alert-dismissible fade in" id="infoMsg" style="display:none;">
            <button aria-label="Close" data-dismiss="alert" class="close" type="button">
              <span aria-hidden="true">×</span></button>
            <strong>Info!</strong> <span id="infotxt">here is error text</span>
        </div>
        <!-- Profile Form Start -->
        <?php
     $attributes = array('data-toggle' => 'validator', 'id' => 'myForm', 'role' => 'form');
      echo form_open_multipart('profile/submit', $attributes);
        ?>
            <!-- Profile Form Start -->
            <!--hidden fields-->
            <input name="id" class="form-control" id="id" type="hidden" value="0" hidden>
            <input name="rand_key" type="text" style="display:none;" id="rand_key" readonly value="">
            <div class="listing_form_cont rental_form profile_cont">
                <div class="row">
                    <div class="col-lg-12">
                        <!--buttons starts-->
                        <button type="button" id="new" class="btn btn-lg btn-primary"><i class="fa fa-plus-circle"></i>New Profile</button>
                        <button style="display:none;" type="submit" id="update" class="btn btn-lg btn-success" name="Update" value="Update Profile">
            <i class="fa fa-plus-circle"></i> Save Profile</button>
                        <button style="display:none;" type="submit" id="Save" class="btn btn-lg btn-success" name="Save" value="Save Profile">
            <i class="fa fa-plus-circle"></i> Save Profile</button>
                        <button style="display:none;" type="button" id="edit" class="btn btn-lg btn-warning"><i class="fa fa-plus-circle"></i>Edit Profile</button>
                        <a href="javascript:void(0)" id="cancel" class="btn btn-lg btn-default" style="display:none;"><i class="fa fa-times"></i> Cancel</a>
                        <!--buttons ends-->
                    </div>
                </div>
                <h4 class="add_new_rental">Profile</h4>
                <div class="row fadeInUp">
                    <div class="col-md-4">
                        <h5 class="text-primary">Company details</h5>
                        <div class="form-group">
                            <label>Company name</label>
                            <input name="name" type="text" class="form-control input-sm" id="name" value="">
                        </div>
                        <div class="form-group">
                            <label>RERA ORN</label>
                            <input name="trade_id" type="text" class="form-control input-sm" id="trade_id" value="">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input name="address" type="text" class="form-control input-sm" id="address" value="">
                        </div>
                        <div class="form-group">
                            <label>Office Tel</label>
                            <input name="phone_no" id="phone_no" type="text" class="form-control input-sm" value="">
                        </div>
                        <div class="form-group">
                            <label>Office Fax</label>
                            <input name="fax_no" type="text" class="form-control input-sm" id="fax_no" value="">
                        </div>
                        <div class="form-group">
                            <label>Primary Email</label>
                            <input name="email" type="text" class="form-control input-sm" id="email" value="">
                        </div>
                        <div class="form-group">
                            <label>Website</label>
                            <input name="web" type="text" class="form-control input-sm" id="web" value="">
                        </div>
                        <div class="form-group">
                            <label>Company Profile</label>
                            <textarea name="description" class="form-control" cols="20" rows="6" id="description">     </textarea>
                        </div>
                        <div class="form-group">
                            <label>Target</label>
                            <input name="monthlyTarget" class="form-control" id="monthlyTarget">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5 class="text-primary">Settings</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <label>XML Name <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 
                   data-placement="right" data-content="
                  Select whether the listings in the XML feeds should contain the agents' names or only the company name. This would apply to all XML feeds.">
                   <i class="fa fa-info-circle"></i>
                   </a></label>
                            </div>
                            <div class="col-md-4">
                                <label>
                     <input name="showAgentName" class="" type="radio"  value="0">
                    <span class="lbl padding">Company</span>
                </label>
                            </div>
                            <div class="col-md-4">
                                <label>
                    <input name="showAgentName" class="" type="radio" checked='checked' value="1">
                    <span class="lbl padding">Agent</span>
                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>XML Number <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 
                   data-placement="right" data-content="
                  Select whether the listings in the XML feeds should contain the agents' mobile numbers or the company's office telephone number.This would apply to all XML feeds.">
                   <i class="fa fa-info-circle"></i>
                   </a>
                 </label>
                            </div>
                            <div class="col-md-4">
                                <label>
                    <input name="showAgentNum" class="" type="radio"  value="0">
                    <span class="lbl padding">Company</span>
                </label>
                            </div>
                            <div class="col-md-4">
                                <label>
                    <input name="showAgentNum" class="" type="radio" checked='checked' value="1">
                    <span class="lbl padding">Agent</span>
                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>XML Email <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 
                   data-placement="right" data-content="
                 Select whether the listings in the XML feeds should contain the agents' email addresses or the company's primary email address. This would apply to all XML feeds.">
                   <i class="fa fa-info-circle"></i>
                   </a>
                 </label>
                            </div>
                            <div class="col-md-4">
                                <label>
                    <input name="xml_custom_email" class="xml_email_fields" type="radio"  value="1">
                    <span class="lbl padding">Company</span>
                </label>
                            </div>
                            <div class="col-md-4">
                                <label>
                   <input name="xml_custom_email" class="xml_email_fields" type="radio" checked='checked' value="0">
                    <span class="lbl padding">Agent</span>
                </label>
                            </div>
                            <div class="col-md-4" style="display:none;">
                                <div class="row  col-md-12 col-xs-12">
                                    <div class="col-md-3 col-xs-12 form-label">
                                        Company XML Email
                                    </div>
                                    <div class="col-md-8">
                                        <input name="xml_email" type="text" class="form-control" id="xml_email" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Watermark </label>
                            <select name="watermark" class="form-control input-sm " id="watermark">
                                          <option value="0" >Disabled</option>
                                          <option value="1" selected>Enabled</option>
                                                </select>
                        </div>
                        <div class="form-group">
                            <label>Measuring Unit</label>
                            <input name="measuring_unit" type="text" class="form-control input-sm" id="measuring_unit" value="">
                        </div>
                        <div class="form-group">
                            <label>Listing Sharing</label>
                            <select name="sharing" class="form-control input-sm" id="sharing">
                                        <option value="0" selected>Disabled</option>
                                        <option value="1" >Enabled</option>
                                </select>
                        </div>
                        <div class="form-group">
                            <label>Leads Sharing  <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 
                   data-placement="right" data-content="
                  1.<b> No Leads sharing</b>: Leads not shared between agents.<br /><br />                                      
                  2.<b> Leads sharing with contact details </b>: Agents can see each other leads with contact details for each one .<br /><br />                                                        
                  3.<b> Leads sharing without contact details </b>: Agents can see each other leads without contact details .<br /><br />                                                         
                  <b>Note</b>:This will only affect agents and admins in groups .">
                   <i class="fa fa-info-circle"></i>
                   </a></label>
                            <select name="leads_sharing" class="form-control input-sm" id="leads_sharing">
                                        <option value="0" selected>No Leads sharing</option>
                                        <option value="2" >Leads sharing with contact details</option>
                                        <option value="1" >Leads sharing without contact details</option>
                                    </select>
                        </div>
                        <div class="form-group">
                            <label>Auto Leads <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 
                   data-placement="right" data-original-title="Auto Leads" data-content="
                  1. <b>Assigned to agent</b>: Auto imported lead will be assigned to agent who has the listings.<br><br>                                                         
                  2. <b>Unassigned</b>: Auto imported lead will not be assigned to any agent , so only managers and admins can see that lead .">
                   <i class="fa fa-info-circle"></i>
                   </a></label>
                            <select name="auto_lead_option" class="form-control input-sm" id="auto_lead_option">
                                          <option value="0" selected>Assigned to agent</option>
                                          <option value="1" >Unassigned</option>
                                  </select>
                        </div>
                        <div class="form-group">
                            <label>Lead SMS to Agents <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 
                   data-placement="right" data-original-title="SMS Agents" data-content="
                   1. <b>Enabled</b>: When Enabled, system will send an auto SMS to agents when a lead gets assigned to them.<br><br>                                                        
                   2. <b>Disabled</b>: When Disabled, no SMS will be sent to agents when a lead gets assigned to them.">
                   <i class="fa fa-info-circle"></i>
                   </a></label>
                            <select name="sms_agents" class="form-control input-sm" id="sms_agents">
                                            <option value="0" selected>Disabled</option>
                                            <option value="1" >Enabled</option>
                                        </select>
                        </div>
                        <div class="form-group">
                            <label>Lead Escalation Settings <a class="popup_a access_popup" rel="popup_lead_escalation_settings"  id="popup-lead-escalation-settings" href="#" data-container="body" data-trigger="hover" data-toggle="popover" 
                   data-placement="right"  data-content="
                  Set the number of days since a lead has been updated, after which a notification email will be sent to the managers">
                   <i class="fa fa-info-circle"></i>
                   </a></label>
                            <div class="input-group">
                                <span class="input-group-addon"><a href="" data-toggle="modal" data-target="#leads_escalation_setting"><i class="fa fa-plus-circle"></i></a></span>
                                <select name="lead_escalation" class="form-control input-sm" id="lead_escalation">
                                                <option value="0" selected>Disabled</option>
                                                <option value="1" >Enabled</option>
                                            </select>
                            </div>
                        </div>
                        <h5 class="text-primary">Import Leads <a href="#" data-trigger="hover" data-toggle="popover" data-placement="right" data-original-title="Import Email Leads" data-content="
                  This feature allows you to import all leads that are sent as email inquiries from JustRentals, JustProperty, Dubizzle and Propertyfinder.                                  The leads will automatically appear in the leads screen and have an auto-imported imported icon next to it. All you need to do is to specify the imap server, email address and password.                                 The leads will be assigned to the same user against whom the listing is assigned to.">
                   <i class="fa fa-info-circle"></i>
             </a></h5>
                        <div class="form-group">
                            <label>Imap <a href="#" data-trigger="hover" data-toggle="popover" data-placement="right" data-content="
                  TIf you are unaware of the Imap server you can get this from your email provider (for example, the gmail imap server is: imap.gmail.com). At times, you may need to first enable the imap feature in the email server's account settings.">
                   <i class="fa fa-info-circle"></i>
             </a></label>
                            <input id="imap" name="imap" type="text" class="form-control input-sm" value="" placeholder="imap.example.com" />
                        </div>
                        <div class="form-group">
                            <label>Email  <a href="#" data-trigger="hover" data-toggle="popover" data-placement="right" data-content="
                 Add the email details here if you receive all web portal inquiries in a centralized company address. If you do not use a centralized company address for the inquiries, it is recommended that you add imap details for each individual user in the users screen.">
                   <i class="fa fa-info-circle"></i>
             </a></label>
                            <input id="emailsLeads" name="emailsLeads" type="text" class="form-control input-sm" value="" placeholder="Your email" />
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input id="passwordemail" name="passwordemail" type="password" class="form-control input-sm" value="" placeholder="Your password" />
                        </div>
                        <div class="form-group">
                            <label>Port <a href="#" data-trigger="hover" data-toggle="popover" data-placement="right" data-original-title="Import Leads" data-content="
               Imap port , IMAP usually works on port 993 , but for some services it runs on different port , using this option you can change the port.">
               <i class="fa fa-info-circle"></i>
               </a></label>
                            <select id="port" name="port" class="form-control input-sm">
                                            <option value="993"   selected="selected"  >993</option>
                                            <option value="143"     >143</option>
                                            <option value="other" >Other</option>
                                        </select>
                        </div>
                        <div class="form-group">
                            <label class="">
                      <!-- Kevin: Changed from Active to is_active -->
                      <input name="is_active" type="checkbox" class="form_fields" id="is_active"  value="1"  >
                        <span class="lbl padding">Active </span>
                    </label>
                        </div>
                        <div class="form-group">
                            <div>
                                <img style="display:none;" id="download_animation_2" src="<?php echo base_url();?>mydata/images/ajax-loader.gif" width="25" height="25" />
                                <span id="resultTest1" style="display:none;font-size: 12px;font-family: verdana; color:green;text-align: right;margin-right: 2px;">Connection successful</span>
                                <span id="resultTest2" style="display:none; font-size: 12px;font-family: verdana;color:red;text-align: right;margin-right: 2px;">Connection failed</span>
                                <span id="resultTest3" style="display:none; text-align:right;font-size: 12px;font-family: verdana;color:red;margin-right: 2px;">Email already used by another user</span>
                            </div>
                            <span id="msg" style="display:none;">Connection failed</span>
                        </div>
                        <input id="profile_connect_status" name="profile_connect_status" type="hidden" class="required" style="display:none" value="0">
                        <input id="email_client_id" name="email_client_id" type="hidden" style="display:none" class="required" value="1743">
                        <button type="button" id="TestConnection" class="btn btn-primary" name="Test">Test Connection</button>
                    </div>
                    <div class="col-md-4">
                        <h5 class="text-primary">Marketing</h5>
                        <div class="form-group">
                            <label>Choose PDF Template </label>
                            <select name="brochure_type" class="form-control input-sm" id="brochure_type" tabindex="6">
                                            <option value="0" selected>Select Template</option>
                                            <option value="1" >Agent Details</option><option value="3" >Basic</option>
                                            <option value="2" selected>Original</option>   </select>
                        </div>
                        <div class="form-group">
                            <label>Choose PDF Colour</label>
                            <div class="color-pick">
                                <span class="input-group-addon"><i></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Choose Preview Colour </label>
                            <div class="color-pick">
                                <span class="input-group-addon"><i></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Choose Email HTML Colour </label>
                            <div class="color-pick">
                                <span class="input-group-addon"><i></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Choose Email HTML Template </label>
                            <select name="email_temp_id" class="form-control input-sm" id="email_temp_id">
                 <option value="1" selected>Basic</option>
                     <option value="2" >Advanced (with Floor Plans)</option>  
                      </select>
                        </div>
                        <div class="form-group">
                            <label>Choose A3 Poster Template </label>
                            <select name="poster_id" class="form-control input-sm" id="poster_id">
                                                <option value="0" selected>Select Template</option>
                                                <option value="2" selected>Agent Details</option></select>
                        </div>
                        <div class="form-group">
                            <label>Choose A3 Poster Colour</label>
                            <div class="color-pick">
                                <span class="input-group-addon"><i></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Mandrill API KEY <a href="#" data-trigger="hover" data-toggle="popover" data-placement="right" data-content="
               Mandrill API Key is required to link your Mandrill account with PropSpace to enable sending Newsletters.<br> Please ensure that you copy the API Key correctly from Mandrill and paste it here to complete the setup.">
               <i class="fa fa-info-circle"></i>
               </a></label>
                            <input id="poster_color" name="poster_color" class="form-control input-sm" visible="collapse" type="hidden" value="">
                        </div>
                        <div class="form-group text-success" style="display:none;"><i class="fa fa-check-circle"> Validated</i></div>
                        <div class="form-group">
                            <div class="col-md-6 col-xs-12">
                                <input name="apiKey-hid" type="hidden" id="apiKey-hid" value="">
                                <input name="apiKey" type="text" class="form-control input-sm" id="apiKey" value="">
                                <div id="wrong" class="margin-top-10 validated red" style="color:red;display:none"> Wrong API Key</div>
                                <div class="margin-top-10" id="loading" style="display:none"><img style="" src="<?php echo base_url();?>mydata/images/ajax-loader.gif" width="14" height="14" /></div>
                                <div class="form-group text-success" style="display:none"><i class="fa fa-check-circle"> Validated</i></div><br />
                                <div class="margin-top-10">
                                    <button type="button" id="validate" class="btn green" name="validate" value="validate">Validate</button>
                                    <button type="button" id="changeKey" class="btn btn-primary" name="changekey" value="changekey" style="display:none">Change Key</button>
                                    <span id="cancel-key" style="padding-left: 10px;color:#70AEDD;display: none;cursor: pointer;">Cancel</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Profile Form End -->
            <script type="text/javascript">
                $(document).ready(function() {
                    $("#loading,#validate,#cancel-key,#wrong").css('display', 'none');
                    $("#validated,#changeKey").css('display', '');
                    $('input#apiKey').attr('readonly', true);
                });
            </script>
            <!-- Select Logos Area -->
            <div class="logo_upload_area profile_cont">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="text-primary">Logo</h5>
                        <p>Images for the logo should be in PNG file format only. The recommended logo width should be less than 700 px.</p>
                        <img src="images/page-logo.png" alt="" id="p_logo" width="141" height="60">
                        <input type="file" id="profile_logo1" name="profile_logo">
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-primary">Watermark</h5>
                        <p>Images for the watermark should be in PNG file format only, as it supports transparency. The recommended logo transparency should be between 10% and 50%, and the width less than 700 px.</p>
                        <img src="images/page-logo.png" alt="" id="p_watermark" width="141" height="60">
                        <input type="file" id="profile_watermark1" name="profile_watermark">
                    </div>
                </div>
            </div>
            <?php echo  form_close();?>
            <div class="row gist-contactbw fadeInUp">
                <div class="col-lg-12 gist-contactbw2">
                    <div class="tab-content datatable-Scrolltab">
                        <div class="tab-pane fade in active" id="current_listing">
                            <div class="listing_nav">
                                <div class="row">
                                    <div class="col-md-8">
                                        <ul class="list-inline listing_action_nav">
                                            <li class="dropdown">
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- i am select something -->
                                    <div class="gist-selmsg collapse" id="openSelsome">
                                        <a data-toggle="collapse" href="#openSelsome" aria-expanded="false" aria-controls="openSelsome" role="button" class="close-selsomething"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                                        <img src="<?php echo base_url();?>images/select.png">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <table class="table table-striped table-hover datatables" id="listings_row">
                                    <thead>
                                        <tr>
                                            <th>
                                                <!--  <label class="">
                        <input type="checkbox"/>
                        <span class="lbl"></span>
                    </label>-->
                                            </th>
                                            <th>Name</th>
                                            <th>Trad Id</th>
                                            <th>Phone</th>
                                            <th>Fax</th>
                                            <th>Email</th>
                                            <th>Website</th>
                                            <th>Added Date</th>
                                            <th>Updated Date</th>
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
    <!-- container end -->
</div>
<div class="modal fade" id="leads_escalation_setting" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title">Leads Escalation Setting</h5>
                <div class="popup_description">Set the number of days since a lead has been updated, after which a notification email will be sent to the managers. This will help you make sure that all your leads are responded to in a timely manner. </div>
            </div>
            <div class="modal-body">
                <!--   <form class="form-horizontal">-->
                <div class="form-group">
                </div>
                <div class="form-group">
                    <div class="row  col-md-12 col-xs-12">
                        <div class="col-md-3 form-label">
                            Tenant Leads
                        </div>
                        <div class="col-md-9">
                            <select name="tenant" class="form-control" id="tenant" selected>
                                            <option value="0" >None</option><option value="86400" >1 Day</option><option value="172800" >2 Days</option><option value="259200" >3 Days</option><option value="345600" >4 Days</option><option value="432000" >5 Days</option><option value="518400" >6 Days</option><option value="604800" selected>1 Week</option><option value="1209600" >2 Weeks</option><option value="1814400" >3 Weeks</option><option value="2419200" >4 Weeks</option><option value="2592000" >1 Month</option>                                        </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row  col-md-12 col-xs-12">
                        <div class="col-md-3 form-label">
                            Buyer Leads
                        </div>
                        <div class="col-md-9">
                            <select name="buyer" class="form-control" id="buyer">
                                            <option value="0" >None</option><option value="86400" >1 Day</option><option value="172800" >2 Days</option><option value="259200" >3 Days</option><option value="345600" >4 Days</option><option value="432000" >5 Days</option><option value="518400" >6 Days</option><option value="604800" selected>1 Week</option><option value="1209600" >2 Weeks</option><option value="1814400" >3 Weeks</option><option value="2419200" >4 Weeks</option><option value="2592000" >1 Month</option>                                        </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row  col-md-12 col-xs-12">
                        <div class="col-md-3 form-label">
                            Landlord Leads
                        </div>
                        <div class="col-md-9">
                            <select name="landlord" class="form-control" id="landlord">
                                            <option value="0" >None</option><option value="86400" >1 Day</option><option value="172800" >2 Days</option><option value="259200" >3 Days</option><option value="345600" >4 Days</option><option value="432000" >5 Days</option><option value="518400" >6 Days</option><option value="604800" selected>1 Week</option><option value="1209600" >2 Weeks</option><option value="1814400" >3 Weeks</option><option value="2419200" >4 Weeks</option><option value="2592000" >1 Month</option>                                        </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row  col-md-12 col-xs-12">
                        <div class="col-md-3 form-label">
                            Seller Leads
                        </div>
                        <div class="col-md-9">
                            <select name="seller" class="form-control" id="seller">
                                            <option value="0" >None</option><option value="86400" >1 Day</option><option value="172800" >2 Days</option><option value="259200" >3 Days</option><option value="345600" >4 Days</option><option value="432000" >5 Days</option><option value="518400" >6 Days</option><option value="604800" selected>1 Week</option><option value="1209600" >2 Weeks</option><option value="1814400" >3 Weeks</option><option value="2419200" >4 Weeks</option><option value="2592000" >1 Month</option>                                        </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row  col-md-12 col-xs-12">
                        <div class="col-md-3 form-label">
                            Landlord+Seller Leads
                        </div>
                        <div class="col-md-9">
                            <select name="landlord_seller" class="form-control" id="landlord_seller">
                                            <option value="0" >None</option><option value="86400" >1 Day</option><option value="172800" >2 Days</option><option value="259200" >3 Days</option><option value="345600" >4 Days</option><option value="432000" >5 Days</option><option value="518400" >6 Days</option><option value="604800" selected>1 Week</option><option value="1209600" >2 Weeks</option><option value="1814400" >3 Weeks</option><option value="2419200" >4 Weeks</option><option value="2592000" >1 Month</option>                                        </select>
                        </div>
                    </div>
                </div>
                <!--   </form>-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Save and Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo site_url();?>js_module/common.js?ts=11234"></script>
<script src="<?php echo base_url();?>js_module/profile.js"></script>
<script>
    /* functions for buttons */
    $(document).ready(function() {
        /* single row select */
        //, type, callback
        function getSingleRow(id) {
          // alert("here");

            var ts = Math.round((new Date()).getTime() / 1000);
            // if (type == undefined) {
                type = 'profile';
            // }
            $('#Save, #cancel, #update').css('display', 'none');
            $('#new').css('display', 'inline');
            $('#myForm input, #myForm select, #myForm textarea').attr('disabled', 'disabled');
            $("#shownotes, #showDocuments").html('');
            $("#showimages").html('Loading...');
            $("#photos").val(0);
            $("#myForm")[0].reset();
            var randkey = '';
            var trade = '';
            $.getJSON(mainurl + "profile/getSingleRow/" + id + "/" + type + "/?ts=" + ts, function(json) {
                // if (callback) {
                //     callback(json);
                // }
                $.each(json, function(key, val) {
                    $("#" + key).val(val);

                    if(key == 'is_active'){
                      $("#is_active").prop("checked", (val == 1)?true:false);
                    }

                    if (key == 'rand_key') {
                        randkey = val;
                    }
                    if (key == 'trade_id') {
                        trade = val;
                    }
                    //set  logo
                    if (key == 'profile_logo') {
                        $("#p_logo").attr("src", '<?php echo base_url();?>/uploads/profile/logo/' + trade + '/' + randkey + '/' + val);
                    }
                    if (key == 'profile_watermark') {
                        $("#p_watermark").attr("src", '<?php echo base_url();?>/uploads/profile/watermark/' + trade + '/' + randkey + '/' + val);
                    }
                });
                //please check if user can access edit etc buttons
                if (1 <= 2 && true) {
                    $('#edit, #new, #add_options_div, #view_options_div, #copy_listing_span').css('display', '');
                }
                last_id = 0;
            });
        }

        $("body").on("click", '#listings_row tbody tr', function() {
            if ($(this).attr('id') != '') {
                if (formDataChange == true) {
                    var result = confirm("You have not saved the data, all changes will be lost!")
                }
                if (result == true || formDataChange == false) {
                    var id = $(this).attr('id');
                    getSingleRow(id, 'profile');
                }
            }
        });

        /* Notification IDs */
        var notification_id = '';
        notification_id = '';
        migrated = '';
        var oTable;
        oTable = $('#listings_row').dataTable({
            "bProcessing": true,
            "sDom": 'R<>rt<ilp><"clear">',
            "aoColumnDefs": [{
                    'render': function(data, type, full, meta) {
                        //check the main check box
                        $('#check_all_checkboxes').attr('checked', false);
                        return '<div style="text-align:center;"><input style="align:center;" type="checkbox" value="' + data + '">  <span class="lbl"></span></div>';
                    },
                    "aTargets": [0]
                },
                //{ "bVisible": false, "aTargets": [ 44 ] },
                {
                    "bSortable": false,
                    "aTargets": [0]
                }
                //  { "bVisible" : false, "aTargets": [ <?php //echo $mystr;?> ] },
            ],
            "rowCallback": function(row, data) {
                $(row).attr("id", data.id);
                return row;
            },
            "columns": [{
                "data": "id"
            }, {
                "data": "name"
            }, {
                "data": "trade_id"
            }, {
                "data": "phone_no"
            }, {
                "data": "fax_no"
            }, {
                "data": "email"
            }, {
                "data": "web"
            }, {
                "data": "dateadded"
            }, {
                "data": "dateupdated"
            }],
            //  "aaSorting" : [[ 42, 'desc' ]],
            "iDisplayLength": 25,
            "bServerSide": true,
            "sAjaxSource": config.siteUrl + "profile/datatable?type=rentals&ts=" + Math.round((new Date()).getTime() / 100),
            "iDisplayStart": 0,
            "sPaginationType": "full_numbers",
            'fnServerData': function(url, data, callback) {
                /* Add some extra data to the sender */
                $.ajax({
                    "dataType": 'json',
                    "type": "POST",
                    "url": url,
                    "data": data,
                    "success": function(json) {
                        callback(json);
                    }
                });
            }
        });
        
        $('.datatable-setbotclass').next().addClass('fixedpagination-bottom');
        //initCheckbox();
        
        $("#new").click(function() {
            // enable save button
            //  $('#save').prop('disabled', false); 
            $("#myForm")[0].reset();
            arr_images.length = 0; //reset the array for images
            if (screenname == 'profile') {
                $('#rand_key').val(genRandKey());
                var value = '';
                var portalValue = [];
                var count = 0;
                // generate key
            }
            $("#title").text('Add New record');
            $('#update, #edit, #new, #placeholder').css('display', 'none'); /* This shows the update button when a filed is selected */
            $('#Save, #cancel').css('display', 'inline'); /* This shows the update button when a filed is selected */
            $('#myForm input, #myForm select, #myForm textarea').prop('disabled', false);;
            //check boxes   
            $("#showAgentNum").prop("checked", true);
            $("#xml_custom_email").prop("checked", true);
            $("#showAgentName").prop("checked", true);
        });
        
        $("#cancel").click(function() {
            // $("#myForm")[ 0 ].reset();
            $("#title").text('Add New record');
            $('#update, #Save, #edit, #cancel').css('display', 'none'); /* This shows the update button when a filed is selected */
            $('#new').css('display', 'inline');
            $('#myForm input, #myForm select, #myForm textarea').prop('disabled', true);
            $('#id').val(0);
            if (screenname == "profile") {
                if (last_id == '' || active_tab == 'tab2') {
                    $("#myForm")[0].reset();
                }
            }
            if (last_id > 0) {
                getSingleRow(last_id);
            }
            arr_images.length = 0; //reset the array of images
            formEnabled = false;
            formDataChange = false;
            disable_popup();
        });
        
        $("#edit").click(function() {
            $('#edit').css('display', 'none'); /* This shows the update button when a filed is selected */
            $('#update').css('display', 'inline'); /* This shows the update button when a filed is selected */
            $('#Save').css('display', 'none'); /* This shows the update button when a filed is selected */
            $('#new').css('display', 'none');
            $('#cancel').css('display', 'inline');
            $('#myForm input, #myForm select, #myForm textarea').prop('disabled', false);
            formEnabled = true;
            enable_popup();
            $('#table_1').animate({
                borderTopColor: '#B9D40F',
                borderRightColor: '#B9D40F',
                borderLeftColor: '#B9D40F',
                borderBottomColor: '#B9D40F'
            }, 500);
        });
    });
    // wait for the DOM to be loaded 
    $(document).ready(function() {
        var lookup = '';
        var validate = '';
        // bind 'myForm' and provide a simple callback function 
        $('#myForm').ajaxForm({
            beforeSubmit: function() {
                //check for look up either this is already exist or not
                lookup = true;
                validate = $("#myForm").validate({
                    rules: {
                        price: {
                            number: true
                        },
                        size: {
                            number: true
                        },
                        web: {
                            required: true
                        },
                        region_id: {
                            required: true
                        },
                        name: {
                            required: true
                        },
                        trade_id: {
                            required: true
                        },
                        email: {
                            email: true
                        }
                    },
                    errorClass: 'form_fields_error',
                    errorPlacement: function(error, element) {
                        console.log(element.attr('id'));
                        if (element.attr('id') == "category_id") {
                            // error.insertAfter(element);
                        }
                        $('#errortxt').text('Please complete all required fields');
                        $('#errorMsg').animate({
                            'color': 'red'
                        }, "slow");
                        $('#errorMsg').fadeIn("slow");
                        setTimeout(function() {
                            $('#errorMsg').fadeOut("slow");
                            $('#errorMsg').animate({
                                'color': 'red'
                            }, "slow");
                        }, 5000);
                        //alert('Please fill the required fields')
                    }
                }).form();
                if (lookup && validate) {
                    return true;
                } else {
                    return false;
                }
            },
            data: {
                images_ids: window.arr_images
            },
            target: '#successtxt',
            async: false,
            success: function(data) {
                if (data == 'e01') {
                    var unset_fields = '';
                    var comma = '';
                    if ($('#region_id').val() == '') {
                        unset_fields = comma + "Emirate";
                        comma = ', '
                    }
                    if ($('#area_location_id').val() == '') {
                        unset_fields = comma + "Location";
                        comma = ', '
                    }
                    if ($('#price').val() == '') {
                        unset_fields = comma + "Price";
                        comma = ', '
                    }
                    if ($('#unit').val() == '') {
                        unset_fields = comma + "Unit";
                        comma = ', '
                    }
                    if ($('#agent_id').val() == '') {
                        unset_fields = comma + "Agent";
                        comma = ', '
                    }
                    alert('The listing could not be saved, Please ensure all required values are set (' + unset_fields + '). If this is incorrect, email at support@gistler.com');
                } else {
                    if (screenname == 'quality_score') {
                        fnRefreshDatatabe('listings_quality_table');
                    } else {
                        fnRefreshDatatabe('listings_row');
                    }
                    formDataChange = false,
                        descFlag = false;
                    if ($('#ref').val() == '') {}
                    $("#cancel").click(),
                        $('#successtxt').text('To edit or add new record please click on the edit or new button'),
                        $('#successMsg').animate({
                            'color': '#49AC44'
                        }, "slow"),
                        $('#successMsg').fadeIn("slow"),
                        setTimeout(function() {
                            $('#successMsg').fadeOut("slow")
                        }, 5000);
                }
            }
        });
    });
    $(document).ready(function() {
        var this_screen_listing_id = '';
        if (this_screen_listing_id) {
            getSingleRow(this_screen_listing_id, 'listings');
            $('#edit').css('display', 'inline');
        }
    });
</script>