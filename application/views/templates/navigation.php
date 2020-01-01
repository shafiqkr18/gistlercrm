<nav class="menu push-menu-left myrentalmenu_crm">
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingOne">
        <h4 class="panel-title">
          <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
           <i class="fa fa-home"></i> <span>Main Menu</span>
         </a>
       </h4>
      </div>
      <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
        <div class="panel-body">
          <div id='cssmenu'>
            <ul>
              <li class="active">
				<a href='<?php echo site_url('dashboard');?>'> <i class="fa fa-home fa-fw"></i> <span>Dashboard</span></a></li>

            <li class="sidebar_dropdown"><a href='#'> <i class="fa fa-list fa-fw"></i> <span>Listing</span></a>

                <ul style="display:none;">
                  <li class=""><a href='<?php echo site_url('listings/rentals');?>'><span>Rentals</span></a></li>
                  <li class=""><a href='<?php echo site_url('listings/sales');?>'><span>Sales</span></a></li>
                </ul>
              </li>

            <li class="sidebar_dropdown "><a href='#'> <i class="fa fa-suitcase fa-fw"></i> <span>Prospects</span></a>

                <ul style="display:none;">
                  <li class=""><a href='<?php echo site_url('contacts');?>'><span>Contacts</span></a></li>
                  <li class=""><a href='<?php echo site_url('leads');?>'><span>Leads</span></a></li>
                </ul>
              </li>

            <li class="sidebar_dropdown "><a href='#'> <i class="fa fa-cogs fa-fw"></i> <span>Work</span></a>

                <ul style="display:none;">
                  <li class=""><a href='<?php echo site_url('deals');?>'><span>Deals</span></a></li>
                  <li class=""><a href='<?php echo site_url('calendar');?>'><span>Calendar</span></a></li>
                </ul>
              </li>

            <li class="sidebar_dropdown "><a href='#'> <i class="fa fa-sitemap fa-fw"></i> <span>Marketing</span></a>

                <ul style="display:none;">
                  <li class=""><a href='<?php echo site_url('newsletters');?>'><span>Newsletters</span></a></li>
                  <!--<li class=""><a href='<?php echo site_url('cma');?>'><span>CMA</span></a></li>-->
                  <li class=""><a href='<?php echo site_url('sms');?>'><span>SMS</span></a></li>
                </ul>
              </li>

            <li class="sidebar_dropdown "><a href='#'> <i class="fa fa-lock fa-fw"></i> <span>Administration</span></a>

                <ul style="display:none;">
                  <li class=""><a href='<?php echo site_url('portals');?>'><span>Portals</span></a></li>
                  <li class=""><a href='<?php echo site_url('users');?>'><span>Users</span></a></li>
                  <li class=""><a href='<?php echo site_url('profile');?>'><span>Profile</span></a></li>

                <li class=""><a href='<?php echo site_url('accounts');?>'><span>Finance</span></a></li>

                </ul>
              </li>

            <li class="sidebar_dropdown "><a href='#'> <i class="fa fa-bar-chart-o fa-fw"></i> <span>Analytics</span></a>

                <ul style="display:none;">
                  <li class=""><a href='<?php echo site_url('history');?>'><span>History</span></a></li>
                </ul>
              </li>

            <li class="sidebar_dropdown "> <a href='#'> <i class="fa fa-cloud fa-fw"></i> <span>Company</span></a>

                <ul style="display:none;">
                  <li class=""><a href='<?php echo site_url('noticeboard');?>'><span>Noticeboard</span></a></li>

                </ul>
              </li>

            <li class="sidebar_dropdown "> <a href='#'> <i class="fa fa-plus fa-fw"></i> <span>More</span></a>
                <ul style="display:none;">

                <li class=""><a href='<?php echo site_url('commingsoon');?>'><span>Forms</span></a></li>
                <li class=""><a href='<?php echo site_url('commingsoon');?>'><span>Mortgages</span></a></li>
                <li class=""><a href='<?php echo site_url('commingsoon');?>'><span>Home Services</span></a></li>
                <li class=""><a href='<?php echo site_url('commingsoon');?>'><span>Advice</span></a></li>

                <li class=""><a href='<?php echo site_url('commingsoon');?>'><span>FAQ</span></a></li>

                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="panel panel-default bluesection">
      <div class="panel-heading" role="tab" id="headingTwo">
        <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseTwo">
          <i class="fa fa fa-home"></i> <span>PM Menu</span>
        </a>
      </h4>
      </div>
      <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
        <div class="panel-body">
          <div id='cssmenu'>
            <ul>
              <li class="active">
                <a href='<?php echo site_url('PM');?>'> <i class="fa fa-bar-chart fa-fw"></i> <span>Dashboard</span></a>
              </li>
              <li class="sidebar_simple">
                <a href='<?php echo site_url('PM/units');?>'> <i class="fa fa-home fa-fw"></i> <span>Managed Units</span></a>
              </li>
              <li class="sidebar_simple ">
                <a href='<?php echo site_url('PM/settings');?>'> <i class="fa fa-cog fa-fw"></i> <span> Settings</span></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="panel panel-default ">
      <div class="panel-heading" role="tab" id="headingTwo">
        <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          <i class="fa fa-dashboard"></i> <span>Campaign Mgt</span>
        </a>
      </h4>
      </div>
      <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
        <div class="panel-body">
          <div id='cssmenu'>
            <ul>
              <li class="active">
                <a href='#'> <i class="fa fa-bar-chart fa-fw"></i> <span>Dashboard</span></a>
              </li>
              <li class="sidebar_simple">
                <a href='<?php echo site_url('cm/campaigns');?>'> <i class="fa fa-key fa-fw"></i> <span>My Keywords</span></a>
              </li>
              <li class="sidebar_simple">
                <a href='<?php echo site_url('cm/campaigns');?>'> <i class="fa fa-home fa-fw"></i> <span>Billing</span></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="panel panel-default orangesection">
      <div class="panel-heading" role="tab" id="headingTwo">
        <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          <i class="fa fa-file-text"></i> <span>Reporting Menu</span>
        </a>
      </h4>
      </div>
      <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
        <div class="panel-body">
          <div id='cssmenu'>
            <ul>

            <li class="active"><a href='<?php echo site_url('reports');?>'> <i class="fa fa-bar-chart fa-fw"></i> <span>Dashboard</span></a></li>

            <li class="sidebar_dropdown"><a href='#'> <i class="fa fa-home fa-fw"></i> <span>Listings Reports</span></a>

                <ul style="display:none;">
                  <li class=""><a href='<?php echo site_url('reports/reportlistingcategory');?>  '><span>By Listing Type & Category</span></a></li>
                  <li class=""><a href='<?php echo site_url('reports/reportlistinglocation');?>  '><span>By Listing Type & Location</span></a></li>
                  <li class=""><a href='<?php echo site_url('reports/reportlistingstatus');?>  '><span>By Status</span></a></li>
                  <li class=""><a href='<?php echo site_url('reports/reportviewlisting');?>  '><span>Listing Viewings Report</span></a></li>
                  <li class=""><a href='<?php echo site_url('reports/reportsavedlisting');?>  '><span>My Saved Reports</span></a></li>
                </ul>
              </li>

            <li class="sidebar_dropdown "><a href='#'> <i class="fa fa-crosshairs fa-fw"></i> <span>Leads Reports</span></a>

                <ul style="display:none;">
                  <li class=""><a href='<?php echo site_url('reports/reportviewleads');?>'><span>Lead Viewings Report</span></a></li>
                  <li class=""><a href='<?php echo site_url('reports/reportleadtype');?>'><span>By Lead Type</span></a></li>
                  <li class=""><a href='<?php echo site_url('reports/reportleadhot');?>'><span>Hot Leads</span></a></li>
                  <li class=""><a href='<?php echo site_url('reports/reportleadsource');?>'><span>By Source</span></a></li>
                  <li class=""><a href='<?php echo site_url('reports/reportleadpipeline');?>'><span>Opportunity Pipeline</span></a></li>
                  <li class=""><a href='<?php echo site_url('reports/reportleadstuck');?>'><span>Stuck Opportunities</span></a></li>
                  <li class=""><a href='<?php echo site_url('reports/reportsavedleads');?>'><span>My Saved Reports</span></a></li>
                </ul>
              </li>
              <li class="sidebar_dropdown ">
                <a href='#'> <i class="fa fa-file-text fa-fw"></i> <span>Deals Reports</span></a>
                <ul style="display:none;">
                  <li class=""><a href='<?php echo site_url('reports/reportdealsstatus');?>'><span>By Deal Type & Status</span></a></li>
                  <li class=""><a href='<?php echo site_url('reports/reportdealssuccess');?>'><span>Successful Deals</span></a></li>
                  <li class=""><a href='<?php echo site_url('reports/reportsaveddeals');?>'><span>My Saved Reports</span></a></li>
                </ul>
              </li>
              <li class="sidebar_dropdown ">
                <a href='#'> <i class="fa fa-group fa-fw"></i> <span>Contacts Reports</span></a>
                <ul style="display:none;">
                  <li class=""><a href='<?php echo site_url('reports/reportsavedcontacts');?>'><span>My Saved Reports</span></a></li>
                </ul>
              </li>
              <li class="sidebar_dropdown ">
                <a href='#'> <i class="fa fa-calendar-check-o fa-fw"></i> <span>To-Do Tasks Reports</span></a>
                <ul style="display:none;">
                  <li class=""><a href='<?php echo site_url('reports/');?>'><span>To-Do Tasks</span></a></li>
                  <li class=""><a href='<?php echo site_url('reports/');?>'><span>My Saved Reports</span></a></li>
                </ul>
              </li>
              <li class="sidebar_dropdown "><a href='<?php echo site_url('reports/reportagentleaderboard');?>'><i class="fa fa-calendar-check-o fa-fw"></i> <span>Agent Leaderboard</span></a>

              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

 



</div>



</nav>