<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title;?></title>

  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>

  <!-- Bootstrap Core CSS -->
  <link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Custom CSS -->
  <link href="<?php echo base_url();?>css/main.css" rel="stylesheet">
  
  <!-- Custom UI CSS -->
  <link href="<?php echo base_url();?>css/ui.css" rel="stylesheet">
    
    
  <!-- Custom Fonts -->
  <link href="<?php echo base_url();?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


  <link type="text/css" href="<?php echo base_url();?>css/styles/base.css" rel="stylesheet" />
  <link type="text/css" href="<?php echo base_url();?>css/styles/bottom.css" rel="stylesheet" />
  <!-- dev user1 -->
  <link href="<?php echo base_url();?>css/dev.css" rel="stylesheet" type="text/css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- jQuery -->
     <!-- jQuery -->
    <script src="<?php echo base_url(); ?>js/jquery-1.10.2.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
     <script src="http://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
     <script type="text/javascript" src="<?php echo base_url(); ?>js/moment.min.js"></script> 

    

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>

    <script src="<?php echo base_url(); ?>js/bootstrap-select.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap-datetimepicker.min.js"></script>
  

    <script src="<?php echo base_url();?>js/dev.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/lib/jquery.jcarousel.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/lib/jquery.pikachoose.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/lib/jquery.touchwipe.min.js"></script>
    <script language="javascript">
      $(document).ready(
        function (){
         $("#pikame").PikaChoose({carousel:true});
        });
    </script>
    
    <!-- Page Scrolling Js -->
    <script src="<?php echo base_url();?>js/page-scrolling.js"></script>
    <script type="text/javascript">
    jQuery(document).ready(function() {
    	
        jQuery('.fadeInUp').addClass("hidden").viewportChecker({
            classToAdd: 'visible animated fadeInUp', // Class to add to the elements when they are visible
            offset: 100    
           });   
    });    
    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})     
  
    </script>
    <style type="text/css">
    .pika-stage { height:500px !important; overflow: hidden; }
    #wrapper {
      padding-top: 30px;
    }
    .mobile-social-share {
    background: none repeat scroll 0 0 #fff;
    display: block !important;
    min-height: 50px !important;
    margin: 0px 0;
}



.mobile-social-share h3 {
    color: inherit;
    float: left;
    font-size: 15px;
    line-height: 20px;
    margin: 25px 25px 0 25px;
}

.share-group {
    float: right;
    margin: 8px 0px 0 0;
}

.btn-group {
    display: inline-block;
    font-size: 0;
    position: relative;
    vertical-align: middle;
    white-space: nowrap;
}

.mobile-social-share ul {
    float: right;
    list-style: none outside none;
    margin: 0;
    min-width: 131px;
    padding: 0;
    border-radius: 0;
}

.share {
    min-width: 17px;
}

.mobile-social-share li {
    display: block;
    font-size: 18px;
    list-style: none outside none;
    margin-bottom: 3px;
    margin-left: 4px;
    margin-top: 3px;
}

.btn-share {
    background-color: #BEBEBE;
    border-color: #CCCCCC;
    color: #333333;
}

.btn-twitter {
    background-color: #3399CC !important;
    width: 120px;
    color:#FFFFFF!important;
}

.btn-facebook {
    background-color: #3D5B96 !important;
    width: 120px;
    color:#FFFFFF!important;
}

.btn-facebook {
    background-color: #3D5B96 !important;
    width: 120px;
    color:#FFFFFF!important;
}

.btn-google {
    background-color: #DD3F34 !important;
    width: 120px;
    color:#FFFFFF!important;
}

.btn-linkedin {
    background-color: #1884BB !important;
    width: 120px;
    color:#FFFFFF!important;
}

.btn-pinterest {
    background-color: #CC1E2D !important;
    width: 120px;
    color:#FFFFFF!important;
}

.btn-mail {
    background-color: #FFC90E !important;
    width: 120px;
    color:#FFFFFF!important;
}

.caret {
    border-left: 4px solid rgba(0, 0, 0, 0);
    border-right: 4px solid rgba(0, 0, 0, 0);
    border-top: 4px solid;
    display: inline-block;
    height: 0;
    margin-left: 2px;
    vertical-align: middle;
    width: 0;
}

#socialShare {
    max-width:150px;
    margin-bottom:10px;
}

#socialShare > a{
    padding: 6px 10px 6px 10px;
}

@media (max-width : 320px) {
    #socialHolder{
        padding-left:5px;
        padding-right:5px;
    }
    
    .mobile-social-share h3 {
        margin-left: 0;
        margin-right: 0;
    }
    
    #socialShare{
        margin-left:5px;
        margin-right:5px;
    }
    
    .mobile-social-share h3 {
        font-size: 15px;
    }
}

@media (max-width : 238px) {
    .mobile-social-share h3 {
        font-size: 12px;
    }
}
    </style>
    
    
     <meta property="og:url"                content="http://mallscombined.com/gistlercrm/preview/index/14538733356211019/1743/1/?l_id=6" />
<meta property="og:type"               content="article" />
<meta property="og:title"              content="When Great Minds Don’t Think Alike" />
<meta property="og:description"        content="How much does culture influence creative thinking?" />
<meta property="og:image"              content="http://mallscombined.com/gistlercrmhtml/img/dubai.jpg" />
   </head>

<body>
         <script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
     
            <div id="wrapper" class="leads">
            <div class="container">
            
            
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-9">
                	<div class="page_head_area">
                  <h1 class="gist-previwlist"> <?php echo $getLst->name;?> <span>AED <?php echo number_format($getLst->price,2);?></span></h1>
                  <h5 class="gist-previewloc"><?php echo $getLst->loc_name;?>, <?php echo $getLst->cityname;?></h5>
                  </div>
                </div>
                <div class="col-lg-3">
                  <img src="<?php echo base_url();?>images/page-logo.png" class="pull-right">
                </div>
            </div>
      
            
            <div id="inner_tab">
            
            
            <div class="row">
            <div class="col-lg-12">
                    
            <!-- Tab content -->
            <div class="tab-content">
              <div class="col-md-9">
                <div class="pikachoose">
                  <ul id="pikame" class="jcarousel-skin-pika">

                    <!-- <li><a href=""><img src="http://mallscombined.com/gistlercrmhtml/img/1.jpg"/></a></li>
                    <li><a href=""><img src="http://mallscombined.com/gistlercrmhtml/img/2.jpg"/></a></li>
                    <li><a href=""><img src="http://mallscombined.com/gistlercrmhtml/img/3.jpg"/></a></li>
                   
                    <li><a href=""><img src="http://mallscombined.com/gistlercrmhtml/img/dubai.jpg"/></a></li> -->
                    <?php
                    $rnd = md5($getLst->rand_key);
                    foreach($getImages as $listing)
					{
						
						?>
						  <li><a href="">
						  	<img width="550" height="412" src="<?php echo base_url();?>uploads/listings/<?php echo $getLst->client_id;?>/<?php echo $rnd;?>/<?php echo $listing['watermark_image'];?>"/></a></li> 
					<?php }
                    ?>
                  </ul>
                </div>

              </div>         
              <div class="col-md-3 ">
                <div class="mobile-social-share">
      
                  <div id="socialHolder" class="">
                    <div id="socialShare" class="btn-group share-group">
                      <a data-toggle="dropdown" class="btn btn-info">
                          Share This
                         <i class="fa fa-share-alt fa-inverse"></i>
                      </a>
                      <button href="#" data-toggle="dropdown" class="btn btn-info dropdown-toggle share">
                        <span class="caret"></span>
                      </button>
                  <ul class="dropdown-menu">
                          <li>
                            <a data-placement="left" target="_blank" class="btn btn-twitter" href="http://twitter.com/intent/tweet?status=1-bedroom Apartment for rent+http://mallscombined.com/gistlercrmhtml/listing-preview.html" rel="tooltip" data-original-title="Twitter">
                          <i class="fa fa-twitter"></i>
                            </a>
                          </li>
                          <li>
                            <a target="_blank" data-placement="left" class="btn btn-facebook" href="http://www.facebook.com/share.php?u=http://mallscombined.com/gistlercrm/preview/index/14538733356211019/1743/1/?l_id=6" rel="tooltip" data-original-title="Facebook">
                            <i class="fa fa-facebook"></i>
                          </a>
                          </li>         
                          <li>
                            <a data-placement="left" class="btn btn-google" target="_blank" href="https://plus.google.com/share?url=http://mallscombined.com/gistlercrmhtml/listing-preview.html" rel="tooltip" data-original-title="Google+">
                            <i class="fa fa-google-plus"></i>
                          </a>
                          </li>
                            <li>
                            <a data-placement="left" class="btn btn-linkedin" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=http://mallscombined.com/gistlercrmhtml/listing-preview.html&amp;title=1-bedroom Apartment for rent&amp;source=http://mallscombined.com" rel="tooltip" data-original-title="LinkedIn">
                            <i class="fa fa-linkedin"></i>
                          </a>
                          </li>
                          <li>
                            <a data-placement="left" class="btn btn-pinterest" target="_blank" href="http://pinterest.com/pin/create/bookmarklet/?media=http://mallscombined.com/gistlercrmhtml/img/1.jpg&amp;url=http://mallscombined.com/gistlercrmhtml/listing-preview.html&amp;is_video=false&amp;description=1-bedroom Apartment for rent" rel="tooltip" data-original-title="Pinterest">
                            <i class="fa fa-pinterest"></i>
                          </a>
                          </li>
                          <li>
                          <a data-placement="left" class="btn btn-mail" rel="tooltip" data-original-title="Email">
                          <i class="fa fa-envelope"></i>
                        </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <button type="button" id="button-contact" class="btn btn-lg btn-block btn-primary pull-right">
                <i class="fa fa-user"></i> Contact Details</button>
                <!-- <button type="button" id="new" class="btn btn-lg btn-block btn-success pull-right">
                <i class="fa fa-pencil-square-o"></i> Request to View</button> -->
                <button type="button" id="new" data-target="#request-view" data-toggle="modal" class="btn btn-lg btn-block btn-success pull-right" title="Send a Request to Agent for Viewing">
                	<i class="fa fa-pencil-square-o"></i> Request to View</button>
                <button type="button" id="btnprint" class="btn btn-lg btn-block btn-warning pull-right" title="Print Page" onclick="window.print();">
                <i class="fa fa-print"></i> Print This List</button>

                <h3 class="gist-quicksummry">Quick Summary</h3>
                <ul class="list-unstyled gist-qslist">
                  <li><strong>Category:</strong> <?php echo $getLst->category;?></li>
                  <li><strong>Emirate:</strong> <?php echo $getLst->cityname;?></li>
                  <li><strong>Location:</strong> <?php echo $getLst->loc_name;?></li>
                  <li><strong>Sub-location:</strong> <?php echo $getLst->sub_sub_loc;?></li>
                  <li><strong>No. of Beds:</strong> <?php echo $getLst->beds;?></li>
                  
                  <li><strong>Price:</strong> AED <?php echo number_format($getLst->price,2);?></li>
                  <li><strong>Commission:</strong> AED <?php echo number_format($getLst->commission,2);?></li>
                  <li><strong>Cheques:</strong> <?php echo $getLst->cheques;?></li>
                  <li><strong>Area (sqft):</strong> <?php echo $getLst->size;?></li>
                </ul>

                

              </div>   
              <div class="clearfix"></div>            
            </div>
            <!-- uae tab content end -->    
            </div>
            </div>
            
            
            
            <div class="row fadeInUp">
            <div class="col-lg-12">
            
            <div class="tab-content ">
              <div class="gist-detailblock">
                  <h3 class="gist-quicksummry">Agent Information</h3>
                  <div class="col-md-6">
                    <ul class="list-unstyled gist-qslist">
                      <li>Company Name - <strong><?php echo $getAgent->CMP;?></strong> </li>
                      <li>Agent Name - <strong><?php echo $getAgent->first_name." ".$getAgent->last_name;?></strong> </li>
                      <li>Email Address - <strong><a href=""> <?php echo $getAgent->email;?></a></strong> </li>
                      <li>Phone Number - <strong><?php echo $getAgent->mobile_no_new_ccode;?><?php echo $getAgent->mobile_no_new;?></strong> </li>
                      <li>RERA Number - <strong><?php echo $getAgent->rera;?></strong> </li>
                    </ul>
                  </div>
                  <div class="col-md-2"></div>
                  <div class="col-md-4 pull-right">
                    <img width="200" class="img-responsive img-thumbnail" src="http://mallscombined.com/gistlercrmhtml/images/The-Dubai-Hills.png">
                  </div>

              </div>
              <div class="gist-detailblock">
                  <h3 class="gist-quicksummry">Location</h3>
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3608.8130751998547!2d55.301916114466444!3d25.243220136027688!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f42d79d5a82b1%3A0x8a96283599d42c0e!2sLulu+Supermarket!5e0!3m2!1sen!2s!4v1455145664496" width="100%" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
              </div>
              <div class="gist-detailblock">
                  <h3 class="gist-quicksummry">Description</h3>
                  <p>
                  	<?php echo $getLst->description_demo;?>
                  	
                  </p>
              </div>
              <div class="gist-detailblock">
                  <h3 class="gist-quicksummry">Features</h3>
                  <ul class="list-unstyled gist-qslist">
                  	<?php
                  	foreach($getFeatures as $listing):
						echo "<li class=\"col-md-4\"><strong><i class=\"fa fa-angle-double-right\"></i></strong> ".$listing['title']."</li>";
						endforeach;
                  	?>
                  
                </ul>
              </div>
              <div class="gist-detailblock">
                  <h3 class="gist-quicksummry">Disclaimer</h3>
                  <p>These particulars are intended to give a fair description of the property but their accuracy cannot be guaranteed, and they do not constitute an offer of contract. Intending purchasers must rely on their own inspection of the property. None of the above appliances/services have been tested by ourselves. We recommend purchasers arrange for a qualified person to check all appliances/services before legal commitment.</p>
              </div>
              <div class="gist-detailblock">
                  <h3 class="gist-quicksummry">Contact</h3>
                  <div class="col-md-4">
                    <h4 class="text-primary">Gistler Builder</h4>
                    <address>
                    <p>Royal Home Real Estate, Office 09, Al Fattan Towers, JBR, Dubai </p>
                      <p>Web: <a href="">www.gistler.com</a></p>
                      <p>Email: <a href="">abc@gistler.com</a></p>
                      <p>Phone: <span>+977 555 6666</span></p>
                    </address>

                  </div>
                  
                  <div class="col-md-4">
                    <img width="200"  class="img-responsive img-thumbnail" src="http://mallscombined.com/gistlercrmhtml/images/The-Dubai-Hills.png">
                  </div>
                  <div class="col-md-4 pull-right">
                      
                      <a rel='nofollow' class="" href='http://' border='0' style='cursor:default'>
                      	<!-- <img src='https://chart.googleapis.com/chart?cht=qr&chl=http%3A%2F%2Fmallscombined.com%2Fgistlercrm%2Flistings%2Frentals&chs=180x180&choe=UTF-8&chld=L|2' alt=''> -->
                      	 <img src='http://chart.apis.google.com/chart?chs=267x267&cht=qr&chld=XL|0&chl=http://localhost:8080/gistlercrm/preview/index/14518049792786538/1743/1/?l_id=5' height='150' width='150'>
                      	</a>
                      <br>
                      <a class="" href="#" data-toggle="tooltip" title="" data-original-title="Default tooltip">Whats this?</a>
                      
                  </div>
                  <div class="clear"></div>
              </div>
            </div>
            </div>
            </div>
            
                    
            
            

 			</div>
            </div>
            <!-- container end -->
            
            
            </div>
			<!-- wrapper end -->
               	<style>
.error{
	color:red;
}
</style>
            
            <div class="footer">
            <p class="copyright_txt text-center">© Gistler 2015 www.gistler.com. All rights reserved.</p>
            </div>
            
            <!-- Requet View -->
            <div class="modal fade" id="request-view" tabindex="-1">
              <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Request to View</h4>
                   
                  </div>
                   <form id="frm_general" method="post">
                  <div class="modal-body">
                  
                    <div class="row">

                      <div class="col-md-6">
                        <div class="form-group">
                            <label class="">Your Name</label>   
                            <input type="text" class="form-control" name="txt_name" id="txt_name"></input>                     
                        </div>                        
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                            <label class="">Your Phone No.</label>   
                            <input type="text" class="form-control" name="txt_phone" id="txt_phone"></input>                     
                        </div>                        
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label class="">Your Email</label>   
                            <input type="text" class="form-control" name="txt_email" id="txt_email"></input>   
                            <input type="hidden" name="ag_email" id="ag_email" value="<?php echo $getAgent->email;?>" />                  
                        </div>                        
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label class="">Preffered Date/Time</label>   
                            <input type="text" class="form-control" name="txt_time" id="txt_time"></input>                     
                        </div>                        
                      </div>
                      
                    </div>
                     <div class="row">

                      <div class="col-md-6">
                        <div class="form-group">
                            <label class="">Comments</label>   
                         
                            <textarea id="txt_comment" name="txt_comment" class="form-control"></textarea>                   
                        </div>                        
                      </div>
                      </div>
                    
                  </div>
                  </form>
                  <div class="modal-footer">
               
						<div id="msg_sucess" class="alert alert-success text-center" style="display:none;">Your mail has been sent successfully!</div>
						<div id="msg_error" class="alert alert-danger text-center" style="display:none;">There is error in sending mail! Please try again later</div>
                  	<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-check"></i> Cancel</button>
                    <button type="button" class="btn btn-success" id="general_submit"><i class="fa fa-check"></i> Send Message</button>
                  </div>
                </div>
              </div>
            </div>
             
</body>
<script type="text/javascript">	
 
$(function(){
	
		$("#general_submit").click(function() {
	
	 var parameters = $("#frm_general").serialize();
	var form = $("#frm_general");
    $.post('<?php echo base_url() ?>index.php/preview/request_view', parameters, function(data) {
        if (data.status == true) {
            //show success message
				$('.error', form).remove();
			$("#msg_sucess").show();
            setTimeout(function() { $("#msg_sucess").hide(); }, 5000);
        }else{
				$('.error', form).remove();
            $.each(data.errors, function(key, val) {
                $('[name="'+ key +'"]', form).after(val);
				
            })
        }
    }, "json");
});
});
$(document).ready(function(){



	// Scroll page to the bottom

	$('#button-contact').click(function(){		

		$('html, body').animate({scrollTop: 750}, 'slow');

		return false;

	});	



});

</script> 
</html>