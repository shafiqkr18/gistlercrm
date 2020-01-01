<div id="wrapper">
            <div class="container">
            
            
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                	<div class="page_head_area"><h1><i class="fa fa-file-text-o"></i> Accounts</h1></div>
                </div>
            </div>
                        
            
            <div id="inner_tab">
            
            <div class="row fadeInUp">
            <div class="col-lg-12">
            <!-- Nav tabs -->
            <div class="inner_tab_nav">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="<?php echo site_url('accounts');?>">Dashboard</a></li>
                    <li><a href="<?php echo site_url('accounts/balance_sheet');?>">Balance Sheet</a></li>
                    <li><a href="<?php echo site_url('accounts/bank_accounts');?>">Bank Accounts</a></li>
                    <li><a href="<?php echo site_url('accounts/transaction_categories');?>">Transaction Categories</a></li>
                    <li><a href="<?php echo site_url('accounts/payment_modes');?>">Payment Modes</a></li>
                    <li><a href="<?php echo site_url('accounts/history');?>">History</a></li>
                </ul>
            </div>
            
            
            <!-- Tab content -->
            <div class="tab-content">

            <div class="row">
            
            <div class="col-md-6">
             <div class="form-group">
                    <label>Select Bank Account</label>
                    <select class="form-control input-sm" id="bankNames">
                    <option value="">Select Bank</option>
		              <option value="248"  selected = "selected" >NBD - #0123456</option>
		             </select>
                    </select>
              </div>
            </div>
            <div class="col-md-6">
             <div class="form-group">
                    <label>Select Date Range</label>
                    <div class="input-group">
                            <input type="text" class="form-control input-sm" id="datepcikrange" name="datepcikrange" placeholder="Real Time">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
              </div>
            </div>
            
            </div>

            </div>

            

            
                
                <div class="col-md-12 gist-whitebg">
                    <div class="row">
                        <table class="table table-striped table-hover datatables" id="dataTables-current-listing">
                            <thead>
                                <tr>
                                    <th class="col-md-9">NBD</th>
                                    <th class="col-md-3">Curent blance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <p><span>Income</span> AED 0.00</p>
                                        <p><span>Expenditure</span> AED 0.00</p>
                                    </td>
                                    <td>
                                        <p><span class="text-primary">Account:</span> NBD</p>
                                        <p><span class="text-primary">Account #</span> 0123456</p>
                                        <p><span class="text-primary">Branch:</span> Marina</p>
                                        <p><span class="text-primary">Currency:</span> AED</p>
                                        <p><span class="text-primary">IBAN:</span> </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <h4 class="text-center ">No Data Availble </h4>
                    </div>

                </div>
            
            

            

            </div>
            </div>
            
            
            
            
            
            </div>
             
            </div>
            <!-- container end -->            
            </div>
			<!-- wrapper end -->