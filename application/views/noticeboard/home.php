 <script type="text/javascript" src="<?php echo site_url();?>js/plugins/tiny_mce/jquery.tinymce.js?ts=10"></script> 
 <script type="text/javascript" src="<?php echo site_url();?>js_module/ajaxfileupload.js?r=2.1.6"></script>
 <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
 <div id="wrapper" class="leads">
            <div class="container">
            
            
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                	<div class="page_head_area"><h1><i class="fa fa-bullhorn"></i> NOTICE BOARD</h1></div>
                </div>
            </div>
            
            
            <div id="inner_tab">
            
            
            <div class="row">
            <div class="col-lg-12">

                <div class="inner_tab_nav">
                  <ul class="nav nav-tabs">
                      <li class="active" ><a href="<?php echo site_url('noticeboard');?>">Noticeboard & Documents</a></li>
                      <li ><a href="<?php echo site_url('noticeboard/target');?>">Target & Commission</a></li>
                  </ul>
                </div>
                    
            <!-- Tab content -->
            <div class="tab-content">
            <a href="#?w=190" rel="popup3" class="popup_a add_button addHEX" style="color:#fff; display:none;" id="trigger_notice_view_popup" width="830">trigger popup</a>
            
              <h4 class="text-success">Company Noticeboard</h4>
              <hr>
              <form id="myForm" action="<?php echo base_url();?>noticeboard/submit_notice" method="post">
                	<a href="#?w=190" rel="popup2" data-toggle="modal" data-target="#popup2" class="popup_a add_button addHEX" style="color:#fff; display:none;" id="trigger_notice_popup" width="830">trigger popup</a>
                    <input name="id" style="display:none;" class="form_fields" id="id" value="0"> 
                	<textarea name="noticex" type="text" class="form_fields required" id="noticex" style="width:640px; height:80px; vertical-align:top; display:none; font-size:12px;" value="" placeholder="Please click New Notice button and type here to add new notice!"></textarea>
                    <button type="button" id="new" class="btn btn-lg btn-success"><i class="fa fa-bullhorn"></i> New Notice</button>
                    <button type="button" id="edit" class="btn btn-lg btn-warning" style="display:none;">i class="fa fa-bullhorn"></i>Edit Notice</button>
              
              <!-- <button type="button" id="new" class="btn btn-lg btn-danger">
              <i class="fa fa-bullhorn"></i> Delete Notice</button> -->
            <!-- <form action="comment.php" method="post" data-toggle="validator"  role="form" id="uaelisting-form"> -->
            	
            	 <!-- View Event Modal -->
            <div class="modal fade" id="popup2" tabindex="-1" >
              <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Notice</h4>
                     <p>Please enter or edit your notice in the following box</p>
                  </div>
                  
                  <div class="modal-body">
                  <div class="table-responsive">
                        <textarea name="notice" cols="200" rows="50" id="notice"></textarea>
                     </div>
                    </div>
                    <div class="modal-footer">
                    	<div class="showdata" id="showdata" style="padding-top:10px; margin-top:10px;" ></div>
                    	<button type="submit" class="btn btn-success"  id="update" name="Update"><i class="fa fa-check"></i> Save &amp; Close</button>
                    	<button type="submit" class="btn btn-success"  name="Save" id="Save"><i class="fa fa-check"></i> Save &amp; Close</button>
                    	<button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                  </div>
                     
                  </div>
                </div>
              </div>
              
              </form>
            	
            
              <div class="row"><h4 class="add_new_rental"></h4></div>
              
              
              <div class="row fadeInUp">

  	           	<table class="table table-striped" id="listings_row_notices">
  	           		<thead>
  	           			<tr>
  	           				<th></th>
  	           				<th>
  	           					Notice
  	           				</th>
  	           				<th>User</th>
  	           				<th>Added</th>
  	           			</tr>
  	           		</thead>
  	           		<tbody>
  	           		</tbody>
  	           	</table>
  	           
              </div>

            <!-- </div> -->
           
            <!-- Rental Form End -->
            </div>
            <!-- uae tab content end -->    
            </div>
            </div>
            
            
            
            <div class="row fadeInUp">
            <div class="col-lg-12">

              <div class="tab-content">

                <h4 class="text-success">Company Document</h4>
                <hr>
              
                <a href="#?w=190" rel="popup1" data-toggle="modal" data-target="#popup1" class="popup_a btn btn-lg btn-success"><i class="fa fa-bullhorn"></i> New Document</a>
                <!-- <button type="button" id="new" class="btn btn-lg btn-danger">
                <i class="fa fa-bullhorn"></i> Delete Document</button> -->

                <form role="form" id="uaelisting-form">
            
                  <div class="row"><h4 class="add_new_rental"></h4></div>
              
              
                  <div class="row fadeInUp">
                    <table class="table table-striped" id="listings_row_documents">
                      <thead>
                        <tr>
                          <th></th>
                          <th>Name</th>
                          <th>Date Added</th>
                          <th>File Size</th>
                          <th>Added By</th>
                          <th>File Type</th>
                          <th>Download</th>
                        </tr>
                      </thead>
                      <tbody>
                    
                        
                      </tbody>
                    </table>                   
                  </div>
                </form> <!-- Form End Here -->

              </div>

          </div>
      </div>
                    
            
            

 			</div>
            </div>
            <!-- container end -->
            
            
            </div>
			<!-- wrapper end -->
			  <div class="modal fade" id="popup1" tabindex="-1" >
              <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">File</h4>
                    
                  </div>
                  
                  <div class="modal-body">
                  <div class="row col-md-12">
      
      <br><br>
      <div class="form-group col-md-12">
        <input id="upload_documents"  type="file" size="10" name="upload_documents" style="width:200px;" >
      </div>
    </div>
    <div class="row col-md-12">
      <div class="col-md-12 popup-sub-heading">File Name:</div>
      <div class="form-group col-md-12">
        <input id="upload_document_name"  type="text" size="15" name="upload_document_name" class="form-control">
      </div>
    </div>
                    </div>
                    <div class="modal-footer">
                    	<div class="showdata" id="showdata" style="padding-top:10px; margin-top:10px;" ></div>
                    	<button type="submit" class="btn btn-success"  id="buttonUpload"  onClick="return ajaxFileUpload_document();" ><i class="fa fa-check"></i> Upload</button>
                   
                  </div>
                     
                  </div>
                </div>
              </div>
			<script type="text/javascript" src="<?php echo site_url();?>js_module/noticeboard.js"></script>
			<script type="text/javascript" src="<?php echo site_url();?>js_module/common.js"></script>
			  