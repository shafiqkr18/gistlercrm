<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
   <!-- Brand and toggle get grouped for better mobile display -->
   <div class="container">
      <div class="navbar-header">
         <a class="logo" href="<?php echo base_url();?>dashboard">Admin</a>
      </div>
      <!-- Top Menu Items -->
      <ul class="nav navbar-right top-nav">
<!--          <li class="dropdown">
            <a href="#" class="dropdown-toggle notification" data-toggle="dropdown">
            <i class="fa fa-lg fa-exchange"></i><span class="badge">2</span><b class="caret"></b>
            </a>
            <ul class="dropdown-menu message-dropdown">
               <li class="message-preview">
                  <a href="#">
                     <div class="media">
                        <div class="media-body">
                           <h5 class="media-heading"><strong>John Smith</strong>
                           </h5>
                           <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                           <p>Lorem ipsum dolor sit amet, consectetur...</p>
                        </div>
                     </div>
                  </a>
               </li>
               <li class="message-preview">
                  <a href="#">
                     <div class="media">
                        <div class="media-body">
                           <h5 class="media-heading"><strong>John Smith</strong>
                           </h5>
                           <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                           <p>Lorem ipsum dolor sit amet, consectetur...</p>
                        </div>
                     </div>
                  </a>
               </li>
               <li class="message-footer">
                  <a href="#">Read All New Messages</a>
               </li>
            </ul>
         </li> -->
         <li class="dropdown">
            <a onclick="toggleFullScreen()" href="javascript:void(0)" class="expand_full"><i class="fa fa-lg fa-expand"></i></a>
         </li>
         <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <?php
               if($this->session->userdata('pic')){
                      #uploads/user/profile/<?php echo $this->session->userdata('client_id')."/". $this->session->userdata('pic');
                  ?>
            <span class="user_img">
            <img src="<?php echo base_url(); ?>images/avatar.jpg" alt=""></span> 
            <?php
               }else{?>
            <span class="user_img"><img src="<?php echo base_url(); ?>images/avatar.jpg" alt=""></span> 
            <?php
               }?>
            <?php echo $this->session->userdata('username');?>
            <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
               <li>
                  <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
               </li>
<!--                <li>
                  <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
               </li> -->
<!--                <li>
                  <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
               </li> -->
               <li class="divider"></li>
               <li>
                  <a href="<?php echo site_url('login/logout'); ?>"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
               </li>
            </ul>
         </li>
      </ul>
      <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
      <ul class="pull-right notification_nav">
         <li>
            <a href="#" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Call for support: +971 000 000">
            <i class="fa fa-2x fa-phone"></i>
            </a>
         </li>
         <!-- <li><a href="#"><i class="fa fa-2x fa-comment"></i></a></li> -->
         <li><a href="#"><i class="fa fa-2x fa-question-circle"></i></a></li>
      </ul>
      <!-- /.navbar-collapse -->
   </div>
</nav>


<script type="text/javascript">

    // Quick fix for User dropdown not showing

    $(".dropdown-toggle").click(function(e){
        e.preventDefault();

        $(this).closest("li.dropdown").toggleClass("open");
    });

    // Help Center modal dialog
    $(".fa-question-circle").click(function(e){
        e.preventDefault();

      bootbox.dialog({
        title: function() {
          return "<h4>Gistler Help Center</h4>\
                    <h5>How may we help you?</h5>";
        },
        message: '<div id="helpCenterDialog">\
                  <form class="row">\
                    <div class="col-md-12">\
                      <div class="form-group">\
                        <label>Name</label>\
                        <input type="text" class="form-control" id="name" name="name" value="" placeholder="Enter your name">\
                      </div>\
                    </div>\
                    <div class="col-md-6">\
                      <div class="form-group">\
                        <label>Email Address</label>\
                        <input type="text" class="form-control" id="email" name="email" value="" placeholder="johndoe@sample.com">\
                      </div>\
                    </div>\
                    <div class="col-md-6">\
                      <div class="form-group">\
                        <label>Mobile Number</label>\
                        <input type="text" class="form-control" id="mobilenumber" name="mobilenumber" value="" placeholder="(Optional)">\
                      </div>\
                    </div>\
                    <div class="col-md-12">\
                      <div class="form-group">\
                        <label>Concern:</label>\
                        <textarea class="form-control" placeholder="Maximum of 120 characters."></textarea>\
                      </div>\
                    </div>\
                  </form>\
                </div>\
                <div class="alert alert-success hidden" role="alert">\
                  <strong>Your concern is noted. </strong> Kindly give us 24 hours to get back with you. This popup will close automatically.\
                </div>',
        buttons: {
          success: {
            label: "Save",
            className: "btn-success",
            callback: function(e) {
                e.preventDefault();
                $(".alert-success").removeClass("hidden");

                setTimeout(function() {
                    bootbox.hideAll();
                }, 2500);
                
                return false;
            }
          }
        }
      });
    });

</script>