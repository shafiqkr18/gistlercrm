<div id="wrapper">
   <div class="container">
      <div id="crm_tab">
         <!-- Page Heading -->
         <div class="row">
            <div class="col-md-6">
               <div class="page_head_area">
                  <h1>Dashboard <small>Welcome back, <?php echo $user_fullname;?>,  <i class="fa fa-map-marker"></i> Dubai</small>
                  </h1>
               </div>
            </div>
            <div class="col-md-6">
               <!-- Nav tabs -->
               <div class="main_tab_nav">
                  <ul class="nav nav-tabs pull-right">
                     <li  class="active"><a href="#home"  data-toggle="tab"><i class="fa fa-lg fa-ellipsis-v"></i></a></li>
                     <li><a href="#mymap_area" data-toggle="tab"><i class="fa fa-lg fa-pie-chart"></i></a></li>
                  </ul>
               </div>
            </div>
         </div>
         <!-- /.row -->
         <!-- tab start -->            
         <!-- Tab content -->
         <div class="tab-content">
            <!-- Tab content 1 -->
            <div  class="tab-pane fade in active" id="home">
               <!-- Top four boxes -->                                             
               <div id="top_info_boxes">
                  <div class="row fadeInUp" id="crm-mysamblocks" >
                     <div class="col-md-3 col-sm-6">
                        <h2 class="green_heading"><?php
                           if($this->session->userdata('user_type') != 3) echo "Company";
                           
                           else
                           
                            echo "My";
                           
                           ?> Listing Overview</h2>
                        <div class="panel panel-green">
                           <div class="panel-heading">
                              <div class="row">
                                 <div class="col-md-4 col-sm-4">
                                    <i class="fa fa-list-ul fa-5x"></i>
                                 </div>
                                 <div class="col-md-8 col-sm-8">
                                    <div class="huge clearfix">
                                       <p class="num_txt" id="tot_live_listing1">0</p>
                                       <span class="r_txt"><a href="<?php echo base_url();?>listings/rentals/published/" title="0" id="tot_live_listing1_r" target="_blank">R</a></span>
                                       <span class="s_txt" ><a href="<?php echo base_url();?>listings/sales/published/" title="0" id="tot_live_listing1_s" target="_blank">S</a></span>
                                    </div>
                                    <span class="live_txt">Live Listings</span>
                                 </div>
                              </div>
                           </div>
                           <a href="javascript:void(0)" id="crm-expandlisting" class="plus_icon plus_icon_green"><i class="fa fa-plus"></i></a>                               
                        </div>
                     </div>
                     <div class="col-md-3 col-sm-6">
                        <h2 class="red_heading"><?php if($user_type == 3) echo "My"; else echo "Company";?> Leads Overview</h2>
                        <div class="panel panel-red">
                           <div class="panel-heading">
                              <div class="row">
                                 <div class="col-md-4 col-sm-4">
                                    <i class="fa fa-check fa-5x"></i>
                                 </div>
                                 <div class="col-md-8 col-sm-8">
                                    <div class="huge clearfix">
                                       <p class="num_txt" id="tot_live_leads1" title="0">0</p>
                                       <span class="r_txt"><a href="<?php echo base_url();?>leads/index/rentals/" title="0" id="tot_live_leads1_r" target="_blank">R</a></span>
                                       <span class="s_txt" ><a href="<?php echo base_url();?>leads/index/sales/" title="0" id="tot_live_leads1_s" target="_blank">S</a></span>
                                    </div>
                                    <span class="live_txt">Live Leads</span>
                                 </div>
                              </div>
                           </div>
                           <a href="javascript:void(0)" id="crm-expandleads" class="plus_icon plus_icon_red"><i class="fa fa-plus"></i></a>
                        </div>
                     </div>
                     <div class="col-md-3 col-sm-6">
                        <h2 class="yellow_heading"><?php if($user_type == 3) echo "My"; else echo "Company";?> Deals Overview</h2>
                        <div class="panel panel-yellow">
                           <div class="panel-heading">
                              <div class="row">
                                 <div class="col-md-4 col-sm-4">
                                    <i class="fa fa-star-o fa-5x"></i>
                                 </div>
                                 <div class="col-md-8 col-sm-8">
                                    <div class="huge clearfix">
                                       <p class="num_txt" id="tot_live_deals1">0</p>
                                       <span class="r_txt"><a href="<?php echo base_url();?>deals/index/rentals/" title="0" id="tot_live_deals1_r" target="_blank">R</a></span>
                                       <span class="s_txt" ><a href="<?php echo base_url();?>deals/index/sales/" title="0" id="tot_live_deals1_s" target="_blank">S</a></span>
                                    </div>
                                    <span class="live_txt">Live Deals</span>
                                 </div>
                              </div>
                           </div>
                           <a href="javascript:void(0)" id="crm-expanddeals" class="plus_icon plus_icon_yellow"><i class="fa fa-plus"></i></a>
                        </div>
                     </div>
                     <div class="col-md-3 col-sm-6">
                        <h2 class="primary_heading"><?php
                           if($this->session->userdata('user_type') != 3) echo "Company";
                           
                           else
                           
                            echo "My";
                           
                           ?> Contacts Overview</h2>
                        <div class="panel panel-primary">
                           <div class="panel-heading contact_overview">
                              <?php
                                 $buyer_rpt = 0;$seller_rpt=0;$lndlord_rpt = 0;
                                 
                                 foreach($contacts as $listing){
                                 
                                  if($listing['contact_type'] == 2) $buyer_rpt = $listing['cnt_all'];
                                 
                                  if($listing['contact_type'] == 3) $lndlord_rpt = $listing['cnt_all'];
                                 
                                  if($listing['contact_type'] == 4) $seller_rpt = $listing['cnt_all'];
                                 
                                 }
                                 
                                 ?>
                              <div class="row">
                                 <div class="col-md-4 col-sm-4 text-center no-padding">
                                    <i class="fa fa-user fa-3x"></i>
                                    <span class="r_txt"><a href="<?php echo base_url();?>contacts/index?listing_type=b" target="_blank">Buyer</a></span>
                                    <span class="s_txt"><a href="<?php echo base_url();?>contacts/index?listing_type=b"  target="_blank"><?php echo $buyer_rpt;?></a></span>
                                 </div>
                                 <div class="col-md-4 col-sm-4 text-center no-padding">
                                    <i class="fa fa-user fa-3x "></i>
                                    <span class="r_txt"><a href="<?php echo base_url();?>contacts/index?listing_type=s" target="_blank">Seller</a></span>
                                    <span class="r_txt"><a href="<?php echo base_url();?>contacts/index?listing_type=s" target="_blank"><?php echo $seller_rpt;?></a></span>
                                 </div>
                                 <div class="col-md-4 col-sm-4 text-center no-padding">
                                    <i class="fa fa-user fa-3x "></i>
                                    <span class="r_txt"><a href="<?php echo base_url();?>contacts/index?listing_type=l" target="_blank">Landlord</a></span>
                                    <span class="r_txt"><a href="<?php echo base_url();?>contacts/index?listing_type=l" target="_blank"><?php echo $lndlord_rpt;?></a></span>
                                 </div>
                              </div>
                           </div>
                           <a href="javascript:void(0)" id="crm-expandcontacts" class="plus_icon plus_icon_blue"><i class="fa fa-plus"></i></a>
                        </div>
                     </div>
                  </div>
                  <!-- top four boxes detail start --> 
                  <div class="open_boxes_cont">
                     <!-- open green box start --> 
                     <div class="row" style="display:none;" id="crm-mylisting">
                        <div class="col-md-6">
                           <h2 class="green_heading"><?php if($user_type == 3) echo "My"; else echo "Company";?> Listing Overview</h2>
                           <div class="green crm-absloute">
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="media green_media">
                                       <div class="media-left">
                                          <i class="fa fa-list-ul fa-5x"></i> 
                                       </div>
                                       <div class="media-body">
                                          <div class="huge clearfix">
                                             <p class="num_txt" id="tot_live_listing2">0</p>
                                             <span class="r_txt"><a href="<?php echo base_url();?>listings/rentals/published/" title="0" id="tot_live_listing1_r" target="_blank">R</a></span>
                                             <span class="s_txt" ><a href="<?php echo base_url();?>listings/sales/published/" title="0" id="tot_live_listing1_r" target="_blank">S</a></span>
                                          </div>
                                          <span class="live_txt">Live Listings</span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="media">
                                       <div class="media-body">
                                          <div class="huge clearfix">
                                             <p class="num_txt" id="listing2_tot_pend">0</p>
                                             <span class="r_txt"><a href="<?php echo base_url();?>listings/rentals/pending/" title="0" id="listing2_tot_pend_r" target="_blank">R</a></span>
                                             <span class="s_txt"><a href="<?php echo base_url();?>listings/sales/pending/" title="0" id="listing2_tot_pend_s" target="_blank">S</a></span>
                                          </div>
                                          <span class="live_txt">Pendding Listings</span>
                                       </div>
                                       <div class="media-left">
                                          <i class="fa fa_green_icon fa-clock-o fa-5x"></i> 
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <hr>
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="media">
                                       <div class="media-left">
                                          <i class="fa fa_green_icon fa-calendar-check-o fa-5x"></i> 
                                       </div>
                                       <div class="media-body">
                                          <div class="huge clearfix">
                                             <p class="num_txt" id="listing2_expd">0</p>
                                             <span class="r_txt"><a href="<?php echo base_url();?>listings/rentals/expired/" title="0" id="listing2_expd_r" target="_blank">R</a></span>
                                             <span class="s_txt"><a href="<?php echo base_url();?>listings/sales/expired/" title="0" id="listing2_expd_s" target="_blank">S</a></span>
                                          </div>
                                          <span class="live_txt">Listings Expired in Last 15 – 30 days</span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="media">
                                       <div class="media-body">
                                          <div class="huge clearfix">
                                             <p class="num_txt" id="listing2_tot_img">0</p>
                                             <span class="r_txt"><a href="<?php echo base_url();?>listings/rentals/less_photos/" title="0" id="listing2_tot_img_r" target="_blank">R</a></span>
                                             <span class="s_txt"><a href="<?php echo base_url();?>listings/sales/less_photos/" title="0" id="listing2_tot_img_s" target="_blank">S</a></span>
                                          </div>
                                          <span class="live_txt">Listing With Less Than 10 Photos</span>
                                       </div>
                                       <div class="media-left">
                                          <i class="fa fa_green_icon fa-file-image-o fa-5x"></i> 
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <hr>
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="media">
                                       <div class="media-left">
                                          <i class="fa fa_green_icon fa-calendar-check-o fa-5x"></i> 
                                       </div>
                                       <div class="media-body">
                                          <div class="huge clearfix">
                                             <p class="num_txt" id="listing2_tot_expg">0</p>
                                             <span class="r_txt"><a href="<?php echo base_url();?>listings/rentals/expiring/" title="0" id="listing2_tot_expg_r" target="_blank">R</a></span>
                                             <span class="s_txt"><a href="<?php echo base_url();?>listings/sales/expiring/" title="0" id="listing2_tot_expg_s" target="_blank">S</a></span>
                                          </div>
                                          <span class="live_txt">Listings Expiring in next 15 – 30 days</span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <a href="javascript:void(0)" id="crm-closelisting" class="close_icon close_icon_green crm-closelisting"><i class="fa fa-times"></i></a>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="row">
                              <div class="col-md-4 col-sm-6">
                                 <h2 class="red_heading"><?php if($user_type == 3) echo "My"; else echo "Company";?> Leads Overview</h2>
                                 <div class="panel panel-red">
                                    <div class="panel-heading">
                                       <div class="row">
                                          <div class="col-md-3 col-sm-3">
                                             <i class="fa fa-check fa-3x"></i>
                                          </div>
                                          <div class="col-md-9 col-sm-9">
                                             <div class="huge clearfix">
                                                <p class="num_txt" id="tot_live_leads3">0</p>
                                                <span class="r_txt"><a href="<?php echo base_url();?>leads/index/rentals/" title="0" id="tot_live_leads3_r" target="_blank">R</a></span>
                                                <span class="s_txt" ><a href="<?php echo base_url();?>leads/index/sales/" title="0" id="tot_live_leads3_s" target="_blank">S</a></span>
                                             </div>
                                             <span class="live_txt">Live Leads</span>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4 col-sm-6">
                                 <h2 class="yellow_heading"><?php if($user_type == 3) echo "My"; else echo "Company";?> Deals Overview</h2>
                                 <div class="panel panel-yellow">
                                    <div class="panel-heading">
                                       <div class="row">
                                          <div class="col-md-3 col-sm-3">
                                             <i class="fa fa-star-o fa-3x"></i>
                                          </div>
                                          <div class="col-md-9 col-sm-9">
                                             <div class="huge clearfix">
                                                <p class="num_txt" id="tot_live_deals2">0</p>
                                                <span class="r_txt"><a href="<?php echo base_url();?>deals/index/rentals/" title="0" id="tot_live_deals2_r" target="_blank">R</a></span>
                                                <span class="s_txt" ><a href="<?php echo base_url();?>deals/index/sales/" title="0" id="tot_live_deals2_s" target="_blank">S</a></span>
                                             </div>
                                             <span class="live_txt">Live Deals</span>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4 col-sm-6">
                                 <h2 class="primary_heading"><?php
                                    if($this->session->userdata('user_type') != 3) echo "Company";
                                    
                                    else
                                    
                                     echo "My";
                                    
                                    ?> Contacts Overview</h2>
                                 <div class="panel panel-primary">
                                    <div class="panel-heading contact_overview">
                                       <div class="row">
                                          <div class="col-md-4 col-sm-4 text-center no-padding">
                                             <i class="fa fa-user fa-2x"></i>
                                             <span>Buyer</span>
                                             <span><?php echo $buyer_rpt;?></span>
                                          </div>
                                          <div class="col-md-4 col-sm-4 text-center no-padding">
                                             <i class="fa fa-user fa-2x"></i>
                                             <span>Seller</span>
                                             <span><?php echo $seller_rpt;?></span>
                                          </div>
                                          <div class="col-md-4 col-sm-4 text-center no-padding">
                                             <i class="fa fa-user fa-2x"></i>
                                             <span>Landlord</span>
                                             <span><?php echo $lndlord_rpt;?></span>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- green open box end --> 
                     <!-- open red box start --> 
                     <div class="row" id="crm-myleadsoverview" style="display:none;">
                        <div class="col-md-6">
                           <h2 class="red_heading"><?php if($user_type == 3) echo "My"; else echo "Company";?> Leads Overview</h2>
                           <div class="red crm-absloute">
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="media red_media">
                                       <div class="media-left">
                                          <i class="fa fa-check fa-5x"></i> 
                                       </div>
                                       <div class="media-body">
                                          <div class="huge clearfix">
                                             <p class="num_txt" id="tot_live_leads2" title="0">0</p>
                                             <span class="r_txt"><a href="<?php echo base_url();?>leads/index/successful_rentals/" title="0" id="tot_live_leads2_r" target="_blank">R</a></span>
                                             <span class="s_txt" ><a href="<?php echo base_url();?>leads/index/successful_sales/" title="0" id="tot_live_leads2_s" target="_blank">S</a></span>
                                          </div>
                                          <span class="live_txt">Total Successful Leads</span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="media">
                                       <div class="media-body">
                                          <div class="huge clearfix">
                                             <p class="num_txt" id="tot_live_leads3_24">0</p>
                                             <span class="r_txt"><a href="<?php echo base_url();?>leads/index/day_rentals/" title="0" id="tot_live_leads3_24_r" target="_blank">R</a></span>
                                             <span class="s_txt" ><a href="<?php echo base_url();?>leads/index/day_sales/" title="0" id="tot_live_leads3_24_s" target="_blank">S</a></span>
                                          </div>
                                          <span class="live_txt">Leads received in 24 hours</span>
                                       </div>
                                       <div class="media-left">
                                          <i class="fa fa_red_icon fa-clock-o fa-5x"></i> 
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <hr>
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="media">
                                       <div class="media-left">
                                          <i class="fa fa_red_icon fa-calendar-check-o fa-5x"></i> 
                                       </div>
                                       <div class="media-body">
                                          <div class="huge clearfix">
                                             <p class="num_txt" id="tot_live_leads3_open" title="0">0</p>
                                             <span class="r_txt"><a href="<?php echo base_url();?>leads/index/open_rentals/" title="0" id="tot_live_leads3_open_r" target="_blank">R</a></span>
                                             <span class="s_txt" ><a href="<?php echo base_url();?>leads/index/open_sales/" title="0" id="tot_live_leads3_open_s" target="_blank">S</a></span>
                                          </div>
                                          <span class="live_txt">Open leads</span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="media">
                                       <div class="media-body">
                                          <div class="huge clearfix">
                                             <p class="num_txt" id="tot_live_leads3_week">0</p>
                                             <span class="r_txt"><a href="<?php echo base_url();?>leads/index/sevendays_rentals/" title="0" id="tot_live_leads3_week_r" target="_blank">R</a></span>
                                             <span class="s_txt" ><a href="<?php echo base_url();?>leads/index/sevendays_sales/" title="0" id="tot_live_leads3_week_s" target="_blank">S</a></span>
                                          </div>
                                          <span class="live_txt">Leads received in one week</span>
                                       </div>
                                       <div class="media-left">
                                          <i class="fa fa_red_icon fa-file-image-o fa-5x"></i> 
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <hr>
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="media">
                                       <div class="media-left">
                                          <i class="fa fa_red_icon fa-calendar-check-o fa-5x"></i> 
                                       </div>
                                       <div class="media-body">
                                          <div class="huge clearfix">
                                             <p class="num_txt" id="tot_live_leads3_closed">0</p>
                                             <span class="r_txt"><a href="<?php echo base_url();?>leads/index/closed_rentals/" title="0" id="tot_live_leads3_closed_r" target="_blank">R</a></span>
                                             <span class="s_txt" ><a href="<?php echo base_url();?>leads/index/closed_sales/" title="0" id="tot_live_leads3_closed_s" target="_blank">S</a></span>
                                          </div>
                                          <span class="live_txt">Closed leads</span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <a href="javascript:void(0)" class="close_icon close_icon_red crm-closelisting"><i class="fa fa-times"></i></a>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="row">
                              <div class="col-md-4 col-sm-6">
                                 <h2 class="green_heading"><?php if($user_type == 3) echo "My"; else echo "Company";?> Listing Overview</h2>
                                 <div class="panel panel-green">
                                    <div class="panel-heading">
                                       <div class="row">
                                          <div class="col-md-3 col-sm-3">
                                             <i class="fa fa-check fa-3x"></i>
                                          </div>
                                          <div class="col-md-9 col-sm-9">
                                             <div class="huge clearfix">
                                                <p class="num_txt" id="tot_live_listing3">0</p>
                                                <span class="r_txt"><a href="<?php echo base_url();?>listings/rentals/published/" title="0" id="tot_live_listing3_r" target="_blank">R</a></span>
                                                <span class="s_txt"><a href="<?php echo base_url();?>listings/sales/published/" title="0" id="tot_live_listing3_s" target="_blank">S</a></span>
                                             </div>
                                             <span class="live_txt">Live Listings</span>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4 col-sm-6">
                                 <h2 class="yellow_heading"><?php if($user_type == 3) echo "My"; else echo "Company";?> Deals Overview</h2>
                                 <div class="panel panel-yellow">
                                    <div class="panel-heading">
                                       <div class="row">
                                          <div class="col-md-3 col-sm-3">
                                             <i class="fa fa-star-o fa-3x"></i>
                                          </div>
                                          <div class="col-md-9 col-sm-9">
                                             <div class="huge clearfix">
                                                <p class="num_txt" id="tot_live_deals3">0</p>
                                                <span class="r_txt"><a href="<?php echo base_url();?>deals/index/rentals/" title="0" id="tot_live_deals3_r" target="_blank">R</a></span>
                                                <span class="s_txt" ><a href="<?php echo base_url();?>deals/index/sales/" title="0" id="tot_live_deals3_s" target="_blank">S</a></span>
                                             </div>
                                             <span class="live_txt">Live Deals</span>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4 col-sm-6">
                                 <h2 class="primary_heading"><?php
                                    if($this->session->userdata('user_type') != 3) echo "Company";
                                    
                                    else
                                    
                                     echo "My";
                                    
                                    ?> Contacts Overview</h2>
                                 <div class="panel panel-primary">
                                    <div class="panel-heading contact_overview">
                                       <div class="row">
                                          <div class="col-md-4 col-sm-4 text-center no-padding">
                                             <i class="fa fa-user fa-2x"></i>
                                             <span>Buyer</span>
                                             <span><?php echo $buyer_rpt;?></span>
                                          </div>
                                          <div class="col-md-4 col-sm-4 text-center no-padding">
                                             <i class="fa fa-user fa-2x"></i>
                                             <span>Seller</span>
                                             <span><?php echo $seller_rpt;?></span>
                                          </div>
                                          <div class="col-md-4 col-sm-4 text-center no-padding">
                                             <i class="fa fa-user fa-2x"></i>
                                             <span>Landlord</span>
                                             <span><?php echo $lndlord_rpt;?></span>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- red open box end --> 
                     <!-- open yellow box start --> 
                     <div class="row" id="crm-mydealsoverview" style="display:none;">
                        <div class="col-md-6">
                           <h2 class="green_heading"><?php if($user_type == 3) echo "My"; else echo "Company";?> Deals Overview</h2>
                           <div class="yellow crm-absloute">
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="media yellow_media">
                                       <div class="media-left">
                                          <i class="fa fa-check fa-5x"></i> 
                                       </div>
                                       <div class="media-body">
                                          <div class="huge clearfix">
                                             <p class="num_txt" id="tot_live_deals4">0</p>
                                             <span class="r_txt"><a href="<?php echo base_url();?>deals/index/rentals/" title="0" id="tot_live_deals4_r" target="_blank">R</a></span>
                                             <span class="s_txt" ><a href="<?php echo base_url();?>deals/index/sales/" title="0" id="tot_live_deals4_s" target="_blank">S</a></span>
                                          </div>
                                          <span class="live_txt">Total Company Deals</span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="media">
                                       <div class="media-body">
                                          <div class="huge clearfix">
                                             <p class="num_txt" id="tot_live_deals4_y">0</p>
                                             <span class="r_txt" ><a href="<?php echo base_url();?>deals/index/year_rentals/" title="0" id="tot_live_deals4_yr" target="_blank">R</a></span>
                                             <span class="s_txt"><a href="<?php echo base_url();?>deals/index/year_sales/" title="0" id="tot_live_deals4_ys" target="_blank">S</a></span>
                                          </div>
                                          <span class="live_txt">Year to end deals</span>
                                       </div>
                                       <div class="media-left">
                                          <i class="fa fa_yellow_icon fa-clock-o fa-5x"></i> 
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <hr>
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="media">
                                       <div class="media-left">
                                          <i class="fa fa_yellow_icon fa-calendar-check-o fa-5x"></i> 
                                       </div>
                                       <div class="media-body">
                                          <div class="huge clearfix">
                                             <p class="num_txt" id="tot_live_deals4_p">0</p>
                                             <span class="r_txt"><a href="<?php echo base_url();?>deals/index/progress_rentals/" title="0" id="tot_live_deals4_pr" target="_blank">R</a></span>
                                             <span class="s_txt"><a href="<?php echo base_url();?>deals/index/progress_sales/" title="0" id="tot_live_deals4_ps" target="_blank">S</a></span>
                                          </div>
                                          <span class="live_txt">Deals in progress</span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="media">
                                       <div class="media-body">
                                          <div class="huge clearfix">
                                             <p class="num_txt" idaccesskey="tot_mydeal_lst_month_sh">0</p>
                                             <span class="r_txt"><a href="<?php echo base_url();?>deals/index/month_rentals/" title="0" id="db_lst_dr_f" target="_blank">R</a></span>
                                             <span class="s_txt"><a href="<?php echo base_url();?>deals/index/month_sales/" title="0" id="db_lst_ds_f" target="_blank">S</a></span>
                                          </div>
                                          <span class="live_txt">Total Deals completed in a month</span>
                                       </div>
                                       <div class="media-left">
                                          <i class="fa fa_yellow_icon fa-file-image-o fa-5x"></i> 
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <a class="close_icon crm-closelisting close_icon_yellow" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="row">
                              <div class="col-md-4 col-sm-6">
                                 <h2 class="green_heading"><?php if($user_type == 3) echo "My"; else echo "Company";?> Listing Overview</h2>
                                 <div class="panel panel-green">
                                    <div class="panel-heading">
                                       <div class="row">
                                          <div class="col-md-3 col-sm-3">
                                             <i class="fa fa-check fa-3x"></i>
                                          </div>
                                          <div class="col-md-9 col-sm-9">
                                             <div class="huge clearfix">
                                                <p class="num_txt" id="tot_live_listing5">0</p>
                                                <span class="r_txt"><a href="<?php echo base_url();?>listings/rentals/published/" title="0" id="tot_live_listing5_r" target="_blank">R</a></span>
                                                <span class="s_txt"><a href="<?php echo base_url();?>listings/sales/published/" title="0" id="tot_live_listing5_s" target="_blank">S</a></span>
                                             </div>
                                             <span class="live_txt">Live Listings</span>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4 col-sm-6">
                                 <h2 class="red_heading"><?php if($user_type == 3) echo "My"; else echo "Company";?> Leads Overview</h2>
                                 <div class="panel panel-red">
                                    <div class="panel-heading">
                                       <div class="row">
                                          <div class="col-md-3 col-sm-3">
                                             <i class="fa fa-star-o fa-3x"></i>
                                          </div>
                                          <div class="col-md-9 col-sm-9">
                                             <div class="huge clearfix">
                                                <p class="num_txt" id="tot_live_leads5">0</p>
                                                <span class="r_txt"><a href="<?php echo base_url();?>leads/index/rentals/" title="0" id="tot_live_leads5_r" target="_blank">R</a></span>
                                                <span class="s_txt"><a href="<?php echo base_url();?>leads/index/sales/" title="0" id="tot_live_leads5_s" target="_blank">S</a></span>
                                             </div>
                                             <span class="live_txt">Live Leads</span>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4 col-sm-6">
                                 <h2 class="primary_heading"><?php
                                    if($this->session->userdata('user_type') != 3) echo "Company";
                                    
                                    else
                                    
                                     echo "My";
                                    
                                    ?> Contacts Overview</h2>
                                 <div class="panel panel-primary">
                                    <div class="panel-heading contact_overview">
                                       <div class="row">
                                          <div class="col-md-4 col-sm-4 text-center no-padding">
                                             <i class="fa fa-user fa-2x"></i>
                                             <span>Buyer</span>
                                             <span><?php echo $buyer_rpt;?></span>
                                          </div>
                                          <div class="col-md-4 col-sm-4 text-center no-padding">
                                             <i class="fa fa-user fa-2x"></i>
                                             <span>Seller</span>
                                             <span><?php echo $seller_rpt;?></span>
                                          </div>
                                          <div class="col-md-4 col-sm-4 text-center no-padding">
                                             <i class="fa fa-user fa-2x"></i>
                                             <span>Landlord</span>
                                             <span><?php echo $lndlord_rpt;?></span>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- yellow open box end --> 
                     <!-- open blue box start --> 
                     <div class="row" id="crm-mycontactsoverview" style="display:none;">
                        <div class="col-md-6">
                           <h2 class="primary_heading"><?php
                              if($this->session->userdata('user_type') != 3) echo "Company";
                              
                              else
                              
                               echo "My";
                              
                              ?> Contacts Overview</h2>
                           <div class="blue crm-absloute">
                              <div class="row">
                                 <div class="col-md-2 col-sm-2 text-center">
                                    <i class="fa fa-user fa-5x"></i>
                                    <span>Buyer</span>
                                    <span id="buyer_lst"><?php echo $buyer_rpt;?></span>
                                 </div>
                                 <div class="col-md-2 col-sm-2 text-center">
                                    <i class="fa fa-user fa-5x"></i>
                                    <span>Seller</span>
                                    <span id="seller_lst"><?php echo $seller_rpt;?></span>
                                 </div>
                                 <div class="col-md-2 col-sm-2 text-center">
                                    <i class="fa fa-user fa-5x"></i>
                                    <span>Landlord</span>
                                    <span id="landlord_lst"><?php echo $lndlord_rpt;?></span>
                                 </div>
                              </div>
                              <a href="javascript:void(0)" class="close_icon crm-closelisting close_icon_blue"><i class="fa fa-times"></i></a>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="row">
                              <div class="col-md-4 col-sm-6">
                                 <h2 class="green_heading"><?php if($user_type == 3) echo "My"; else echo "Company";?> Listing Overview</h2>
                                 <div class="panel panel-green">
                                    <div class="panel-heading">
                                       <div class="row">
                                          <div class="col-md-3 col-sm-3">
                                             <i class="fa fa-check fa-3x"></i>
                                          </div>
                                          <div class="col-md-9 col-sm-9">
                                             <div class="huge clearfix">
                                                <p class="num_txt" id="tot_live_listing4">0</p>
                                                <span class="r_txt"><a href="<?php echo base_url();?>listings/rentals/published/" title="0" id="tot_live_listing4_r" target="_blank">R</a></span>
                                                <span class="s_txt"><a href="<?php echo base_url();?>listings/sales/published/" title="0" id="tot_live_listing4_s" target="_blank">S</a></span>
                                             </div>
                                             <span class="live_txt">Live Listings</span>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4 col-sm-6">
                                 <h2 class="red_heading"><?php if($user_type == 3) echo "My"; else echo "Company";?> Leads Overview</h2>
                                 <div class="panel panel-red">
                                    <div class="panel-heading">
                                       <div class="row">
                                          <div class="col-md-3 col-sm-3">
                                             <i class="fa fa-star-o fa-3x"></i>
                                          </div>
                                          <div class="col-md-9 col-sm-9">
                                             <div class="huge clearfix">
                                                <p class="num_txt" id="tot_live_leads4">0</p>
                                                <span class="r_txt"><a href="<?php echo base_url();?>leads/index/rentals/" title="0" id="tot_live_leads4_r" target="_blank">R</a></span>
                                                <span class="s_txt"><a href="<?php echo base_url();?>leads/index/sales/" title="0" id="tot_live_leads4_s" target="_blank">S</a></span>
                                             </div>
                                             <span class="live_txt">Live Leads</span>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4 col-sm-6">
                                 <h2 class="yellow_heading"><?php if($user_type == 3) echo "My"; else echo "Company";?> Deals Overview</h2>
                                 <div class="panel panel-yellow">
                                    <div class="panel-heading">
                                       <div class="row">
                                          <div class="col-md-3 col-sm-3">
                                             <i class="fa fa-star-o fa-3x"></i>
                                          </div>
                                          <div class="col-md-9 col-sm-9">
                                             <div class="huge clearfix">
                                                <p class="num_txt" id="tot_live_deals5">0</p>
                                                <span class="r_txt"><a href="<?php echo base_url();?>deals/index/rentals/" title="0" id="tot_live_deals5_r" target="_blank">R</a></span>
                                                <span class="s_txt" ><a href="<?php echo base_url();?>deals/index/sales/" title="0" id="tot_live_deals5_s" target="_blank">S</a></span>
                                             </div>
                                             <span class="live_txt">Live Deals</span>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- blue open box end --> 
                  </div>
                  <!-- top four boxes detail end -->
               </div>
               <!-- row end --> 
               <div class="row fadeInUp ccolums" id="colums">
                  <div id="sortable" class="dropme ui-sortable ui-droppable">
                     <div class="col-md-6 " id="listItem_1">
                        <div class="panel panel-default">
                           <div class="panel-heading">
                              <?php
                                 if($this->session->userdata('user_type') != 3) echo "Company";
                                 
                                 else
                                 
                                  echo "My";
                                 
                                 ?> Users Overview
                              <!--  <p>Users with most live listings <span class="blue">[total users <?php //echo $totalusers;?>]</span></p>-->
                              <div class="panel-option">
                                 <span class="pull-right arrow">
                                 <a id="listItem_1" class="close_module" href="# Remove Module"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i></a>
                                 </span>
                                 <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                                 <span class="pull-right arrow">
                                 <i  class="glyphicon moveme  glyphicon-move" aria-hidden="true"></i>
                                 </span>
                              </div>
                           </div>
                           <div class="panel-body">
                              <div class="scrollbar-inner comp_user_overview">
                                 <div class="panel panel-default">
                                    <table class="table table-striped">
                                       <thead>
                                          <tr>
                                             <th>User Name</th>
                                             <th>Rentals </th>
                                             <th>Sales </th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php
                                             foreach ($cmp_users as $listing):?>
                                          <tr>
                                             <!-- images/avatar.jpg -->
                                             <td>
                                                <?php 
                                                   if($listing['photo_agent'] == '')
                                                   
                                                   {
                                                   #uploads/user/profile/<?php echo $client_id."/".$listing['photo_agent'];?" alt="<?php echo $listing['first_name'];?
                                                   echo '<img src="images/avatar.jpg" alt="">';
                                                   
                                                   }else{?>
                                                <img src="<?php echo base_url(); ?>uploads/user/profile/<?php echo $listing['client_id'];?>/<?php echo $listing['photo_agent'];?>"> 
                                                <?php }?>
                                                <?php echo $listing['first_name'];?> <?php echo $listing['last_name'];?>
                                             </td>
                                             <td><a href="<?php echo base_url();?>listings/rentals/agent/?agent_id=<?php echo $listing['id'];?>" title="Rentals"  target="_blank"><?php echo $listing['rentcount'];?></a></td>
                                             <td><a href="<?php echo base_url();?>listings/sales/agent/?agent_id=<?php echo $listing['id'];?>" title="Sales"  target="_blank"><?php echo $listing['salecount'];?></a></td>
                                          </tr>
                                          <?php endforeach;?>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6" id="listItem_2">
                        <div class="panel panel-default">
                           <div class="panel-heading">
                              Company Agents Target Overview
                              <div class="panel-option">
                                 <span class="pull-right arrow">
                                 <a id="listItem_2" class="close_module" href="# Remove Module"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i></a>
                                 </span>
                                 <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                                 <span class="pull-right arrow">
                                 <i  class="glyphicon moveme glyphicon-move" aria-hidden="true"></i>
                                 </span>
                              </div>
                           </div>
                           <div class="panel-body">
                              <div id="agentparea" class="profile-area">
                                 <?php 
                                    //print_r($allusers);exit;
                                    
                                    $cnt= 1;
                                    
                                    $allusers_list = $allusers;

                                    //echo var_dump($allusers);
                                    
                                    foreach ($allusers as $listing):
                                    
                                    
                                    
                                    ?>
                                 <div class="profile-page collapse" id="collapseExample<?php echo $cnt;?>">
                                    <div class="well well-sm profile-chucha">
                                       <div class="row">
                                          <div class="col-sm-6 col-md-4">
                                             <?php 
                                                if($listing['photo_agent'] == '')
                                                
                                                {
                                                
                                                echo '<img src="images/user_thumb.jpg" alt="">';
                                                
                                                }else{?>
                                             <img src="<?php echo base_url(); ?>uploads/user/profile/<?php echo $client_id."/".$listing['photo_agent'];?>" alt="" class="img-rounded img-responsive" />
                                             <?php }?>
                                          </div>
                                          <div class="col-sm-6 col-md-8">
                                             <a class="closemeprofile pull-right" role="button" data-toggle="collapse" href="#collapseExample<?php echo $cnt;?>" aria-expanded="false" aria-controls="collapseExample<?php echo $cnt;?>"><i class="fa fa-times"></i></a>
                                             <h4><?php echo $listing['first_name']." ".$listing['last_name'];?></h4>
                                             <!--<small><cite title="San Francisco, USA">Jumerah Dubai, UAE <i class="glyphicon glyphicon-map-marker">
                                                </i></cite></small>-->
                                             <p>
                                                <i class="glyphicon glyphicon-envelope"></i><?php echo $listing['email'];?>
                                                <br />
                                                <i class="glyphicon glyphicon-earphone"></i><?php echo $listing['mobile_no_new_ccode']." ".$listing['mobile_no_new'];?>
                                                <br />
                                                <i class="glyphicon glyphicon-flash"></i>Monthly Progress (<?php echo $listing['commission'];?>)
                                             </p>
                                             <!-- progress bar -->
                                             <?php
                                                //echo $listing['target']."<br>";
                                                
                                                // echo $listing['commission']."<br>";
                                                
                                                ?>
                                             <div class="progress">
                                                <!-- <div class="progress-bar progress-bar-danger" style="width: 10%">
                                                   <span class="sr-only">10% Complete (danger)</span></div>
                                                   
                                                   <div class="progress-bar progress-bar-warning progress-bar-striped" style="width: 20%"><span class="sr-only">20% Complete (warning)</span></div>
                                                   
                                                   <div class="progress-bar progress-bar-success" style="width: 35%"><span class="sr-only">35% Complete (success)</span></div> -->
                                                <?php
                                                   if($listing['commission'] > 0 && $listing['target'] > 0){
                                                     $cm = Gistler_percentage($listing['commission'],$listing['target'],2);

                                                     if($cm < 11){
                                                     
                                                       echo '<div class="progress-bar progress-bar-danger" style="width: '.$cm.'%">
                                                            <span class="sr-only">10% Complete (danger)</span></div>';
                                                     
                                                     }
                                                     elseif($cm<40 && $cm>10){
                                                     
                                                      echo '<div class="progress-bar progress-bar-warning progress-bar-striped" style="width: '.$cm.'%"><span class="sr-only">20% Complete (warning)</span></div>';
                                                     
                                                     }else{
                                                     
                                                      echo '<div class="progress-bar progress-bar-success" style="width: '.$cm.'%"><span class="sr-only">35% Complete (success)</span></div>'; 
                                                     
                                                     }                                                    
                                                   }
                                                   
                                                ?>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <?php 
                                    $cnt=$cnt+1;
                                    
                                    endforeach;?>   
                              </div>
                              <ul class="list-unstyled">
                                 <?php 
                                    $c= 1;
                                    
                                    foreach ($allusers_list as $listing):
                                    
                                    
                                    
                                             ?>
                                 <li class="crm-agent">
                                    <a role="button" data-toggle="collapse" href="#collapseExample<?php echo $c;?>" aria-expanded="false" aria-controls="collapseExample<?php echo $c;?>">
                                    <?php 
                                       if($listing['photo_agent'] == '')
                                       
                                       {
                                       
                                       echo '<img src="images/user_thumb.jpg" class="img-circle">';
                                       
                                       }else{?>
                                    <img class="img-circle" style="max-height: 80px;" src="<?php echo base_url(); ?>uploads/user/profile/<?php echo $client_id."/".$listing['photo_agent'];?>">
                                    <?php }?>
                                    </a>
                                 </li>
                                 <?php 
                                    $c=$c+1;
                                    
                                    endforeach;?> 
                              </ul>
                           </div>
                        </div>
                     </div>
                     <!-- portals listing -->
                     <div class="col-md-6" id="listItem_3">
                        <div class="panel panel-default">
                           <div class="panel-heading">
                              <?php
                                 if($this->session->userdata('user_type') != 3) echo "Company";
                                 
                                 else
                                 
                                  echo "My";
                                 
                                 ?> Portals Overview 
                              <div class="panel-option">
                                 <span class="pull-right arrow">
                                 <a id="listItem_3" class="close_module" href="# Remove Module"> <i class="glyphicon glyphicon-remove" aria-hidden="true"></i></a>
                                 </span>
                                 <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                                 <span class="pull-right arrow">
                                 <i  class="glyphicon moveme glyphicon-move" aria-hidden="true"></i>
                                 </span>
                              </div>
                           </div>
                           <div class="panel-body">
                              <ul class="list-unstyled list-group crm-portallist">
                                 <li class="list-group-item">
                                    <span class="badge" id="justrentals"><?php  echo $portals['JustRentals'];?></span>
                                    <a href="javascript:void(0)" >
                                    Listings assigned to justrentals.com
                                    </a>
                                 </li>
                                 <li class="list-group-item">
                                    <span class="badge" id="justproperty"><?php  echo $portals['JustProperty'];?></span>
                                    <a href="javascript:void(0)" >
                                    Listings assigned to justproperty.com
                                    </a>
                                 </li>
                                 <li class="list-group-item">
                                    <span class="badge" id="dubizzle"><?php  echo $portals['dubizzle'];?></span>
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#portals_popup" title="Listings assigned to dubizzle">
                                    Listings assigned to dubizzle.com
                                    </a>
                                 </li>
                                 <li class="list-group-item">
                                    <span class="badge" id="propertyfinder"><?php  echo $portals['propertyfinder'];?></span>
                                    <a href="javascript:void(0)" >
                                    Listings assigned to propertyfinder.com
                                    </a>
                                 </li>
                                 <li class="list-group-item">
                                    <span class="badge" id="others">0</span>
                                    <a href="javascript:void(0)" >
                                    Others - 
                                    </a>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <!-- calendar listing -->
                     <div class="col-md-6" id="listItem_4">
                        <div class="panel panel-default">
                           <div class="panel-heading">
                              Company Calendar
                              <div class="panel-option">
                                 <span class="pull-right arrow">
                                 <a id="listItem_4" class="close_module" href="# Remove Module"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i></a>
                                 </span>
                                 <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                                 <span class="pull-right arrow">
                                 <i  class="glyphicon moveme glyphicon-move" aria-hidden="true"></i>
                                 </span>
                              </div>
                           </div>
                           <div class="panel-body">
                              <div id='calendar'></div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- <div class="col-md-6">
                     </div> 
                     
                     
                     
                     <div class="comp_user_overview">
                     
                     <div class="col-md-6">
                     
                     
                     
                     
                     
                     
                     
                     
                     
                       
                     
                       </div>  
                     
                       </div>  -->                   
               </div>
               <!-- What was here: Available dashboard modules -->
<!--                <div class="drag_dropable_cont">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="panel panel-default">
                           <div class="panel-heading">
                              <h3>Available Dashboard Modules</h3>
                              Please click any of the available option below then drag and drop it to the 
                              dashboard to display summary of respective screen.
                           </div>
                           <div class="panel-body">
                              <div class="col-md-3">
                                 <div class="panel panel-default">
                                    <div data-item="listItem_1" class="drag_drop_content_green button listItem_1" style="cursor: pointer; cursor: hand;">Company Users Overview</div>
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="panel panel-default">
                                    <div data-item="listItem_2" class="drag_drop_content_red button listItem_2" style="cursor: pointer; cursor: hand;">Company Agents Target Overview </div>
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="panel panel-default">
                                    <div data-item="listItem_3" class="drag_drop_content_yellow button listItem_3" style="cursor: pointer; cursor: hand;">Company Portals Overview</div>
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="panel panel-default">
                                    <div data-item="listItem_4" class="drag_drop_content_blue button listItem_3" style="cursor: pointer; cursor: hand;">Calendar</div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>  -->              
            </div>
            <!-- tab content 1 end -->
            <!-- tab content 2 -->
            <div class="tab-pane fade" id="mymap_area">
               <div id="inner_tab">
                  <!-- Nav tabs -->
                  <div class="inner_tab_nav">
                     <ul class="nav nav-tabs">
                        <li  class="active"><a href="#circle_graph"  data-toggle="tab">Pie Charts <i class="fa fa-pie-chart"></i></a></li>
                        <li><a href="#line_graph" data-toggle="tab">Bar Charts <i class="fa fa-bar-chart"></i></a></li>
                     </ul>
                  </div>
                  <!-- Cricle Graphs Start From Here -->
                  <div class="tab-content">
                     <!--circle graph starts here-->
                     <div class="tab-pane fade in active" id="circle_graph">
                        <div class="col-md-4">
                           <div class="panel panel-default green-bg">
                              <div class="panel-heading">
                                 COMPANY LISTINGS
                                 <div class="panel-option">
                                    <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                                 </div>
                              </div>
                              <div class="panel-body">
                                 <div class="demo-container">
                                    <div id="placeholder" class="demo-placeholder"></div>
                                    <div id="graphLegend"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="panel panel-default red-bg">
                              <div class="panel-heading">
                                 COMPANY LEADS
                                 <div class="panel-option">
                                    <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                                 </div>
                              </div>
                              <div class="panel-body">
                                 <div class="demo-container">
                                    <div id="companyleads" class="demo-placeholder"></div>
                                    <div id="graphLegend_Leads"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="panel panel-default orange-bg">
                              <div class="panel-heading">
                                 COMPANY DEALS
                                 <div class="panel-option">
                                    <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                                 </div>
                              </div>
                              <div class="panel-body">
                                 <div class="demo-container">
                                    <div  id="companydeals" class="demo-placeholder"></div>
                                    <div id="graphLegend_Deals"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="panel panel-default orange-bg">
                              <div class="panel-heading">
                                 MY CONTACTS
                                 <div class="panel-option">
                                    <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                                 </div>
                              </div>
                              <div class="panel-body">
                                 <div class="demo-container">
                                    <div  id="companycontacts" class="demo-placeholder"></div>
                                    <div id="graphLegend_Contacts"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="panel panel-default orange-bg">
                              <div class="panel-heading">
                                 COMPANY AGENTS TARGET OVERVIEW
                                 <div class="panel-option">
                                    <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                                 </div>
                              </div>
                              <div class="panel-body">
                                 <div class="demo-container">
                                    <div  id="listings_by_users" class="demo-placeholder"></div>
                                    <div id="graphLegend_listings_by_users"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="panel panel-default orange-bg">
                              <div class="panel-heading">
                                 PORTALS OVERVIEW
                                 <div class="panel-option">
                                    <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                                 </div>
                              </div>
                              <div class="panel-body">
                                 <div class="demo-container">
                                    <div  id="portalsoverview" class="demo-placeholder"></div>
                                    <div id="graphLegend_Portals"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="clearfix clear"></div>
                     </div>
                     <!--circle graph ends here-->
                     <div class="tab-pane fade" id="line_graph">
                        <div class="col-md-6">
                           <div class="panel panel-default orange-bg">
                              <div class="panel-heading">
                                 COMPANY LISTINGS
                                 <div class="panel-option">
                                    <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                                 </div>
                              </div>
                              <div class="panel-body">
                                 <div class="demo-container">
                                    <div id="listings_bar" class="demo-placeholder"></div>
                                    <!-- <div id="companyleads" class="demo-placeholder"></div>  -->
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="panel panel-default orange-bg">
                              <div class="panel-heading">
                                 COMPANY LEADS
                                 <div class="panel-option">
                                    <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                                 </div>
                              </div>
                              <div class="panel-body">
                                 <div class="demo-container">
                                    <div id="leads_bar" class="demo-placeholder"></div>
                                    <!-- <div id="companyleads" class="demo-placeholder"></div>  -->
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="panel panel-default orange-bg">
                              <div class="panel-heading">
                                 COMPANY DEALS
                                 <div class="panel-option">
                                    <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                                 </div>
                              </div>
                              <div class="panel-body">
                                 <div class="demo-container">
                                    <div id="deals_bar" class="demo-placeholder"></div>
                                    <!-- <div id="companyleads" class="demo-placeholder"></div>  -->
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="panel panel-default orange-bg">
                              <div class="panel-heading">
                                 COMPANY PORTALS
                                 <div class="panel-option">
                                    <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                                 </div>
                              </div>
                              <div class="panel-body">
                                 <div class="demo-container">
                                    <div id="portal_bar" class="demo-placeholder"></div>
                                    <!-- <div id="companyleads" class="demo-placeholder"></div>  -->
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="clear clearfix"></div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- tab content 2 end -->
         </div>
      </div>
   </div>
   <!-- container end -->
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Event Details</h4>
         </div>
         <div class="modal-body">
            <div class="form-horizontal">
               <div id="event-details" class="margin-left-10">
                  <div class="form-group">
                     <div class="col-md-4 col-xs-5 form-label">Event Name :</div>
                     <div class="col-md-8 col-xs-7 form-control-static" id="event-name">
                        Here
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-md-4 col-xs-5 form-label">Start Date &amp; Time</div>
                     <div class="col-md-8 col-xs-7 form-control-static" id="event-startdate">
                        Here
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-md-4 col-xs-5 form-label ">End Date &amp; Time</div>
                     <div class="col-md-8 col-xs-7 form-control-static" id="event-enddate">
                        Here
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-md-4 col-xs-5 form-label">Event Type</div>
                     <div class="col-md-8 col-xs-7 form-control-static" id="event-type">
                        Here
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-md-4 col-xs-5 form-label">Description</div>
                     <div class="col-md-8 col-xs-7 form-control-static" id="event-description">
                        Here
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>