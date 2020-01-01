<script>    
var search_done             = false;
    var type                    = '1';
    var title                   = 'Rent';
    var screenname = "price_index";
    </script>
 <div id="wrapper">
            <div class="container">
            
            
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                	<div class="page_head_area"><h1><i class="fa fa-home"></i> Rental Price Index</h1></div>
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
            
            
            
            
            <div id="inner_tab">
            
                        
            <div class="row">
            <div class="col-lg-12">
            
            <!-- Nav tabs -->
            <div class="inner_tab_nav">
                <ul class="nav nav-tabs">
                   <li  ><a href="<?php echo site_url('listings/rentals');?>">United Arab Emirates</a></li>
                 <!--    <li><a href="<?php echo site_url('listings/international-rentals');?>">International</a></li> -->
                    <li><a href="<?php echo site_url('listings/locations-text-rentals');?>">Location Text</a></li>
                    <li class="active"><a href="<?php echo site_url('listings/price-index-rentals');?>">Rental Price Index</a></li>
                </ul>
            </div>
            
                    
            <!-- Tab content -->
            <div class="tab-content">
            <form id="priceIndexForm">
            	<input type="hidden" name="type_price_index" value="" id="type_price_index">
        <div class="form-actions row"></div>
            <div class="row fadeInUp">
            <div class="col-md-4">
            	<div class="form-group">
                  
                      <select name="stid" class="selectpicker show-tick form-control input-sm required" id='stid' >
                                <option value="" selected>Select Emirate</option>
                                                                <option value="2">
                                    Abu Dhabi                                </option>
                                                                <option value="4">
                                    Ajman                                </option>
                                                                <option value="8">
                                    Al Ain                                </option>
                                                                <option value="1">
                                    Dubai                                </option>
                                                                <option value="7">
                                    Fujairah                                </option>
                                                                <option value="6">
                                    Ras Al Khaimah                                </option>
                                                                <option value="3">
                                    Sharjah                                </option>
                                                                <option value="5">
                                    Umm Al Quwain                                </option>
                                                            </select>
                </div>
                <div class="form-group">
                   <select name="locid" class="form-control input-sm required" id='locid'>
                                <option value="" selected>Select Location</option>
                            </select>
                </div>
                <div class="form-group">
                    <select name="snum_id" class="form-control input-sm" id='snum_id'>
                                <option value="" selected>Select Sub-Location</option>
                            </select>
                </div>
            </div> 
            
            <div class="col-md-4">
            	<div class="form-group">
                  <select name="cid" class="form-control input-sm required" id='cid'>
                                <option value="" selected>Select Category</option>
                                                                <option value="1">Apartment</option>
                                                                <option value="2">Villa</option>
                                                            </select>
                </div>
                <div class="form-group">
                     <select name="beds" class="form-control input-sm required" id='beds'>
                                <option value="" selected>Select Bedrooms</option>
                                <option value="0.5">Studio</option>
                                <option value="1">1 bedroom</option>
                                <option value="2">2 bedrooms</option>
                                <option value="3">3 bedrooms</option>
                                <option value="4">4 bedrooms</option>
                                <option value="5">5 bedrooms</option>
                                <option value="6">6 bedrooms</option>
                                <option value="7">7 bedrooms</option>
                                <option value="8">8 bedrooms</option>
                                <option value="9">9 bedrooms</option>
                                <option value="10">10 bedrooms</option>
                                <option value="11">11 bedrooms</option>
                                <option value="12">12 bedrooms</option>
                            </select>
                </div>
                <div class="form-group">
                	  <button class="btn btn-primary" id="get_priceIndex" name="get_priceIndex">
                	<i class="fa fa-bar-chart"></i> Retrieve Price Index </button>
                </div>
            </div>
            <!-- dev work start from here 18-02-2016 -->
            <div class="col-md-4">
                 <div class="form-group  section-two">
                            <p class="msginfo-box">Price Index Information will be displayed here</p>
                        </div>
                
            </div>
            <!-- dev work end from here 18-02-2016 -->           
            
            </div>
            </form>
            </div>
            </div>
            </div>
            
            
            
            
            
            <div class="row fadeInUp">
            <div class="col-lg-12">
            <div class="inner_tab_nav">
                <ul class="nav nav-tabs">
                    <li  class="active"><a href="<?php echo site_url('listings/price-index-rentals');?>">Market Data</a></li>
                    <!-- <li><a href="<?php echo site_url('listings/compare-rentals');?>">Compare Your Listing</a></li> -->
                </ul>
            </div>
            
            <div class="tab-content">
                <div class="row">    
                    <table class="table table-striped table-bordered table-hover datatables" id="listings_row">
                          <thead>
                          <tr>
                            <th>
                            <label class="">
                                <input type="checkbox"/>
                                <span class="lbl"></span>
                            </label>
                            </th>
                            <th>Emirate</th>
                            <th>Location</th>
                            <th>Sub-Location</th>
                            <th>Category</th>
                            <th>Beds</th>
                            <th>Price Index</th>
                            </tr>
                          </thead>
                           <thead id="searchbox">
                           <tr class="highlighted search_box">
                           	<form id="myForm2">
                            <td><a id="reset_filter" style="display:none;" href="# Reset"><img src="<?php echo base_url();?>mydata/images/swap.png?ts=10" title="Reset filter"></a></td>
                            <td>
                            
                           <select name="1" class="search_init form-control input-sm" id='1' style="width:100px;">
                        <option value="" selected>Select</option>
                                                  <option value="2">
                            Abu Dhabi                          </option>
                                                  <option value="4">
                            Ajman                          </option>
                                                  <option value="8">
                            Al Ain                          </option>
                                                  <option value="1">
                            Dubai                          </option>
                                                  <option value="7">
                            Fujairah                          </option>
                                                  <option value="6">
                            Ras Al Khaimah                          </option>
                                                  <option value="3">
                            Sharjah                          </option>
                                                  <option value="5">
                            Umm Al Quwain                          </option>
                                            </select>
                            </td>
                            <td><input type="text" class="form-control input-sm search_init" id="2"></td>
                            <td><input type="text" class="form-control input-sm search_init" id="3"></td>
                            <td>
                       
                            <select id='4' class="search_init form-control input-sm">
                        <option value="" selected>Select</option>
                                                            <option value="1">
                                    Apartment                        </option>
                                                            <option value="2">
                                    Villa                        </option>
                                                </select>
                            </td>
                            <td>
                           
                            <select id="5" class="search_init form-control input-sm" name="beds" type="text">
                        <option value="" selected>Select</option>
                        <option value="0.5">Studio</option>
                        <option value="1">1 bedroom</option>
                        <option value="2">2 bedrooms</option>
                        <option value="3">3 bedrooms</option>
                        <option value="4">4 bedrooms</option>
                        <option value="5">5 bedrooms</option>
                        <option value="6">6 bedrooms</option>
                        <option value="7">7 bedrooms</option>
                        <option value="8">8 bedrooms</option>
                        <option value="9">9 bedrooms</option>
                        <option value="10">10 bedrooms</option>
                        <option value="11">11 bedrooms</option>
                        <option value="12">12 bedrooms</option>
                    </select>
                            </td>
                            <td></td>
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
			<!-- wrapper end -->
			<script src="<?php echo base_url();?>js_module/common.js" type="text/javascript"> </script>
			<script src="<?php echo base_url();?>js_module/price-index.js" type="text/javascript"> </script>