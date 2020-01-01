<link href="<?php echo base_url();?>css/bootstrap-switch.min.css" rel="stylesheet">
<script src="<?php echo base_url();?>js/bootstrap-switch.min.js"></script>
<script>
$(document).ready(function() {
$('.BSswitch').bootstrapSwitch('state', true);
});
</script>
<div id="wrapper" class="leads">
    <div class="container">
              
      <!-- Page Heading -->
      <div class="row">
          <div class="col-lg-12">
          	<div class="page_head_area"><h1><i class="fa fa-rss"></i> Portals</h1></div>
          </div>
      </div>

      <div id="inner_tab">
        <p>Please find the links to your XML feeds for the different property portals below. Please email the corresponding link to the appropriate contact person at each portal. Please note some of the portals below require a contract to be signed between your company and the portal for you to be able to start listing with that portal.</p>
        <strong>Any other portal you find on the web</strong>
        <p>
          Simply email the 'Generic' feed from the list below to the portal. If they require any changes that we were unaware of, please email: marketing@royalhome.ae and we will create a specific feed for that portal.
        </p>
        <strong>Your own website</strong>
        <p>
          As above, use the 'Generic' feed it is the most comprehensive feed and includes all the information you need to update your own website with all your data from Our CRM.
        </p>
        <div role="alert" class="alert alert-danger" style="padding:8px;padding-left: 6px;width:34%">'Switch' below to enable or disable the XML Feed. Once disabled, the portal will not be able to read the feed.</div>
        
        <div class="row">
          <div class="col-lg-12">
            <!-- Tab content -->
            <div class="tab-content tabcontent-nopadding">
              
                <table class="table datatables table-striped">
                  <thead>
                    <tr>
                      <th>Switch</th>
                      <th>Portal</th>
                      <th>Discription</th>
                      <th>Xml link</th>
                      <th>Paid/Free</th>
                      <th>Setting</th>
                      <th>Email</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <input id="TheCheckBox2" name="GroupedSwitches" class="BSswitch" type="checkbox" data-size="small" data-on-color="success" data-off-text="disable" data-on-text="enable" checked="false">
                      </td>
                      <td>Dubizzle</td>
                      <td>
                        <p>Update feed for Dubizzle, shows listings modified in last 24 hours that are assigned to Dubizzle.</p>
                      </td>
                      <td>
                        <textarea onclick="this.focus();this.select()" class="xml-txtarea xmlselectme">http://www.mallscombined.com/newcrm/portals/generic.php</textarea>
                      </td>
                      <td>Free</td>
                      <td class="emailUser"> <a data-toggle="modal" data-target="#portal_setting"  rel="popup24" class="btn btn-success popup_a" title="&&Generic&&http://www.gistler.com/feed/xml.php?cl=1743&pid=8245&acc=8807"><i class="fa fa-plus-circle"></i> &nbsp;Setting</a></td>
                      <td class="emailUser"> <a data-toggle="modal" data-target="#sendportal_email"  rel="popup24" class="btn btn-success popup_a" title="&&Generic&&http://www.gistler.com/feed/xml.php?cl=1743&pid=8245&acc=8807"><i class="fa fa-envelope-o"></i> &nbsp;Email</a></td>
                    </tr>

                    <tr>
                      <td><input id="TheCheckBox1" name="TheCheckBox1" class="BSswitch" type="checkbox" data-size="small" data-on-color="success" data-off-text="disable" data-on-text="enable" checked="disable"></td>
                      <td>Dubizzle</td>
                      <td>
                        <p>Update feed for Dubizzle, shows listings modified in last 24 hours that are assigned to Dubizzle.</p>
                      </td>
                      <td>
                        <textarea onclick="this.focus();this.select()" class="xml-txtarea xmlselectme">http://www.mallscombined.com/newcrm/portals/generic.php</textarea>
                      </td>
                      <td>Free</td>
                       <td class="emailUser"> <a data-toggle="modal" data-target="#portal_setting"  rel="popup24" class="btn btn-success popup_a" title="&&Generic&&http://www.gistler.com/feed/xml.php?cl=1743&pid=8245&acc=8807"><i class="fa fa-plus-circle"></i> &nbsp;Setting</a></td>
                      <td class="emailUser"><a data-toggle="modal" data-target="#sendportal_email"  rel="popup24" class="btn btn-success popup_a" title="&&Dubizzle&&http://www.gistler.com/feed/xml.php?cl=1743&pid=2298&acc=6285"><i class="fa fa-envelope-o"></i> &nbsp;Email</a></td>
                    </tr>

                    <tr>
                      <td>
                      <input id="TheCheckBox3" name="TheCheckBox3" class="BSswitch" type="checkbox" data-size="small" data-on-color="success" data-off-text="False" data-on-text="enable" checked="disable">
                      </td>
                      <td>Dubizzle</td>
                      <td>
                        <p>Update feed for Dubizzle, shows listings modified in last 24 hours that are assigned to Dubizzle.</p>
                      </td>
                      <td>
                        <textarea onclick="this.focus();this.select()" class="xml-txtarea xmlselectme">http://www.mallscombined.com/newcrm/portals/generic.php</textarea>
                      </td>
                      <td>Free</td>
                      <td class="emailUser"> <a data-toggle="modal" data-target="#portal_setting"  rel="popup24" class="btn btn-success popup_a" title="&&Generic&&http://www.gistler.com/feed/xml.php?cl=1743&pid=8245&acc=8807"><i class="fa fa-plus-circle"></i> &nbsp;Setting</a></td>
                      <td><button  type="button" class="btn btn-success"><i class="fa fa-envelope-o"></i> &nbsp;Email</button></td>
                    </tr>

                    <tr>
                      <td>
                      <input id="TheCheckBox3" name="TheCheckBox3" class="BSswitch" type="checkbox" data-size="small" data-on-color="success" data-off-text="False" data-on-text="enable" checked="disable">
                      </td>
                      <td>Dubizzle</td>
                      <td>
                        <p>Update feed for Dubizzle, shows listings modified in last 24 hours that are assigned to Dubizzle.</p>
                      </td>
                      <td>
                        <textarea onclick="this.focus();this.select()" class="xml-txtarea xmlselectme">http://www.mallscombined.com/newcrm/portals/generic.php</textarea>
                      </td>
                      <td>Free</td>
                      <td class="emailUser"> <a data-toggle="modal" data-target="#portal_setting"  rel="popup24" class="btn btn-success popup_a" title="&&Generic&&http://www.gistler.com/feed/xml.php?cl=1743&pid=8245&acc=8807"><i class="fa fa-plus-circle"></i> &nbsp;Setting</a></td>
                      <td><button  type="button" class="btn btn-success"><i class="fa fa-envelope-o"></i> &nbsp;Email</button></td>
                    </tr>

                  </tbody>
                </table>
               
            </div>
              <!-- uae tab content end -->    
          </div>
        </div>
   		</div>
    </div>
  <!-- container end -->          
  </div>
  <script type="text/javascript">
//send email

		 $(document).ready(function() {
			$('#emailPortalForm').ajaxForm({
			   beforeSubmit: function() {
				 var sending = $("#emailPortalForm").validate(
					{ 
						rules: {
							sendto: {email:true},
							subject:{required:true}
						},
						messages: {
							sendto:"Enter a valid Email",
							subject:"Please enter a subject"
						}
						}).form() ;
						
					if(sending==true){
						$('#progressPDF_div').css('display','inline');
						$('#sendPDF_div').hide(1000);
						$('#emailsentForm').css('display','none');
					}
					
					return sending;
				
			  },
			  success: function() {
						$('#progressPDF_div').css('display','none');
						$('#sendPDF_div').show(1000);
						$('#emailsentForm').css('display','inline');
			  }
			});
		  });
		  
//end send email    
</script>
  
  <!-- Send Email Modal -->
          <div class="modal fade" id="sendportal_email" tabindex="-1" >
              <div class="modal-dialog">
              <form id="emailPortalForm" name="emailPortalForm" method="post" action="<?php echo base_url();?>generate/emailPortal">
                <div class="modal-content ">
                
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Email</h4>
                  </div>
                  
                  <div class="modal-body">
                    <div class="container">
                      <div class="row">
                        <div class="col-md-4">
                      
                        <div class="form-group">
                        <label>Email to</label>
                        <input type="text" class="form-control input-sm" name="sendto" id="sendto" required="required" >
                      </div>
                      <div class="form-group">
                        <label>CC</label>
                        <input type="text" class="form-control input-sm" name="ccto" id="ccto" >
                      </div>
                      <div class="form-group">
                        <label>Email From</label>
                        <input type="text" class="form-control input-sm"name="sentfrom" id="sentfrom" value="property@royalhome.ae" readonly="readonly" >
                      </div>
                      <div class="form-group">
                        <label>Subject</label>
                        <input type="text" class="form-control input-sm" name="subject" id="subject" value="XML feed link for our Listings" required="required" >
                      </div>
                      <div class="form-group">
                        
                        <label class="">
                          <input type="checkbox" name="show_signature" id="show_signature">
                          <span class="lbl padding">Show Signature </span>
                        </label>
                      </div>
                      <div class="form-group">
                        <label>Message</label>
                        <textarea class="form-control" name="message" id="message"></textarea>
                      </div>
                     
                    </div>
                      </div>
                    </div>
                     <div id="emailsentForm" style="color:green; display:none;">Email sent Successfully</div>
                    <div id='progressPDF_div' style='display:none; text-align:center; width:100%;'>
	<div><img src="<?php echo base_url();?>mydata/images/ajax-loader.gif" width="48" height="48" /></div>
	<div>Sending email, please do not close the window.</div>
</div>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-success"><i class="fa fa-envelope-o"></i> &nbsp;Send Email</button>
                  </div>
                   
                  </div>
                  </form>
                </div>
                
                </div>
                <script type="text/javascript">
	$(document).ready(function () {
    $('.emailUser a').click(function () {
		
        var email_name_link = $(this).attr('title');
		
        email_name_link     = email_name_link.split("&&");
        email               = email_name_link[0];
        name                = email_name_link[1];
        link                = email_name_link[2];

        if (email == "Nil") {
            email = '';
        }

        $('#sendto').attr('value', email);

        if (name == "Generic") {
            name = ' ';
        }

        messages = 'Dear ' + name + ' team \n\ We are currently using Gistler CRM Software , and would like to provide you with our XML feed link for our listings. Please use the following link to add/update our XML feeds: ' + link + '\n\
                Thanks and best regards ';

        document.emailPortalForm.message.value = messages;
    });

    $('#myForm').ajaxForm({
        success: function () {
            email_name_link = '';
        }
    });
});
</script>

      <!------------setting popup--->
      <div class="modal fade" id="portal_setting" tabindex="-1" >
              <div class="modal-dialog">
              <form id="emailPortalForm" name="emailPortalForm" method="post" action="<?php echo base_url();?>portals/save_settings">
                <div class="modal-content ">
                
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Settings For Portal</h4>
                  </div>
                  
                  <div class="modal-body">
                    <div class="container">
                      <div class="row">
                        <div class="col-md-4">
                      
                        <div class="form-group">
                        <label>Min Images for Listing</label>
                        <input type="text" class="form-control input-sm" name="no_images" id="no_images" required="required" >
                      </div>
                      <div class="form-group">
                        <label>Title Characters</label>
                        <input type="text" class="form-control input-sm" name="no_title" id="no_title" >
                      </div>
                      <div class="form-group">
                        <label>Description Length</label>
                        <input type="text" class="form-control input-sm" name="no_description" id="no_description" value=""  >
                      </div>
                      <div class="form-group">
                        <label>Sales Properties</label>
                        <input type="text" class="form-control input-sm" name="no_sales" id="no_sales" value=""  >
                      </div>
                      
                      <div class="form-group">
                        <label>Rent Properties</label>
                        <input type="text" class="form-control input-sm" name="no_rentals" id="no_rentals" value=""  >
                      </div>
                     
                    </div>
                      </div>
                    </div>
                     <div id="emailsentForm" style="color:green; display:none;">Saved Successfully</div>
                    <div id='progressPDF_div' style='display:none; text-align:center; width:100%;'>
	<div><img src="<?php echo base_url();?>mydata/images/ajax-loader.gif" width="48" height="48" /></div>
	<div>Saving data, please do not close the window.</div>
</div>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-success"><i class="fa fa-envelope-o"></i> &nbsp;Save </button>
                  </div>
                   
                  </div>
                  </form>
                </div>
                
                </div>