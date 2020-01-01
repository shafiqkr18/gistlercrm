<div id="login_wrapper">

        <div class="container">

        <div class="row fadeInUp">

        <div class="col-md-6 col-md-offset-3">

        

         <?php

		 $attributes = array('class' => 'frm', 'id' => 'myform');

	    echo form_open('verifylogin', $attributes);

        ?>	

        <div class="login_cont text-center">

        <img class="login_logo" src="<?php echo base_url(); ?>images/page-logo.png" alt="">

         <?php echo validation_errors(); ?>

        <div class="form-group">

            <label>username</label>

            

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-lg fa-user"></i></span>

              <input type="text" class="form-control" id="username" name="username">

              

            </div>

           

        </div>

        

        <div class="form-group">

            <label>Password</label>

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-lg fa-lock"></i></span>

              <input type="password" class="form-control" id="passowrd" name="password" >

          

            </div>

                

        </div>

        <div class="form-group">

     <a id="subbutton" href="javascript:;" onclick="document.getElementById('myform').submit();" class=" btn btn-success btn-block btn-lg"><i class="fa fa-lg fa-check"></i> LOGIN</a>

        </div>

        

        <p class="forgot_text">Forgot your password ? <a href="javascript:;" class="text-primary" id="reset_pw">Click here to reset</a></p>

        

        </div>

        

        </div>

        </form>

        

        </div>

        </div>

        </div>

        </div>







        

                 

       





    <!-- jQuery -->

    <script src="<?php echo base_url(); ?>js/jquery-1.10.2.js"></script>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>

    



    <!-- Bootstrap Core JavaScript -->

    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    

 

    

   



  

    

     <!-- Top phone popover -->

    <script>
    function sendMail()
    {
        var parameters = $("#name").val();
       
    $.post('<?php echo base_url() ?>common/reset', parameters, function(data) {

        if (data.status == true) {
            //show success message
            $('.error', form).remove(); 
            $("#msg_sucess").show();
            setTimeout(function() { $("#msg_sucess").hide(); }, 5000);
        }else{
            $("#msg_error").show();
        }
    })
    }
	$(function () {

	  $('[data-toggle="popover"]').popover();

      $("#passowrd,#subbutton").keypress(function(event) {

            if (event.which == 13) {
                event.preventDefault();
                $("#myform").submit();
            }
        });

	})

    

    </script>

     <script>
  $(function() {
    $('#reset_pw').click(function(){
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height:300,
      modal: true,
      buttons: {
       "Reset Password": function() {
          sendMail();return false;
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
   });
  });
  </script>


<div id="dialog-confirm" title="Forgot your password?" style="display:none;">
  <p>Enter your username below, and we'll reset your password and email you the new one.</p>
   

 <form id="frm_general" >
    <fieldset>
      <label for="name">username</label>
      <input type="text" name="name" id="name" value="" class="text ui-widget-content ui-corner-all"><?php echo form_error('name'); ?>
</fieldset>
  </form>
           
 <style>
.error{
    color:red;
}
</style>
<div id="msg_sucess" class="alert alert-success text-center" style="display:none;">Your mail has been sent successfully!</div>
<div id="msg_error" class="alert alert-danger text-center" style="display:none;">There is error in sending mail! Please try again later</div>
        
</div>
</body>



</html>

