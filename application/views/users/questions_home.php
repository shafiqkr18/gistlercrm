<div id="wrapper">

            <div class="container">

            

            

            <!-- Page Heading -->

            <div class="row">

                <div class="col-lg-12">

                	<div class="page_head_area"><h1><i class="fa fa-group"></i> Questions</h1></div>

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

                    <li ><a href="<?php echo site_url('users');?>">Manage Users</a></li>

                    <li ><a href="<?php echo site_url('users/groups');?>">Manage Groups</a></li>

                    <li  class="active"><a href="<?php echo site_url('users/questions');?>">Manage Security Questions</a></li>

                </ul>

            </div>

            

            

            <!-- Tab content -->

    <div class="tab-content">

            <form id="myForm_question" action="<?php echo base_url();?>users/saveQuestion" method="post" >

            

            <div class="row">

            <div class="col-lg-12">

            					

                <button type="button" id="edit_question" class="btn btn-lg btn-warning"><i class="fa fa-plus-circle"></i>Edit Questions</button>

               <button  style="display:none;" type="submit" id="Save_question"  class="btn btn-lg btn-success" name="Save" value="Save Questions">

            <i class="fa fa-plus-circle"></i> Save Questions</button>

                   

            <a href="javascript:void(0)" id="cancel_question" class="btn btn-lg btn-default"  style="display:none;"><i class="fa fa-times"></i> Cancel</a>

                                                <div class="showdata" id="showdata"></div>

            </div>

            </div>

            

            

            <h4 class="add_new_rental">Edit Your Questions </h4>

            <p>You can re-set your security questions here. Security questions will be used to verify your account if you need to re-set your password in the future. You cannot use the same answer for more than one security question.</p>

            

            

            <div class="row fadeInUp">

            <div class="col-lg-12">

            

            <div class="row">

            <div class="col-md-6">

           		 <div class="form-group">

                    <label>Qestion 1</label>

                   

                   <select class=" form-control input-sm" name="question1" id="question1">

                                                 <option value="" >Select one</option>                    

                                                    <option value='1'> What Is The Name Of Your Favourite Sports Team? </option><option value='2'> What Is The Make Of Your First Car? </option><option value='3'> In Which City Was Your High School? </option><option value='4'> What Is Your Favourite Colour? </option><option value='5'> What Is Your Favourite Movie? </option><option value='6'> In What City Were You Born? </option><option value='7'> Who Is Your Favourite Actor Or Musician? </option><option value='8'> What Is The Name Of Your Favourite Pet? </option><option value='9'> What Is Your Favourite Holiday Place? </option>  

                                    </select>

                  </div>

            </div>

            <div class="col-md-6">

           		 <div class="form-group">

                    <label>Answer</label>

                

                   <input name="ansr_1" type="text" class="form-control input-sm required"   id="ansr_1" value="" >

                  </div>

            </div>

            </div>

            <div class="row">

            <div class="col-md-6">

           		 <div class="form-group">

                    <label>Qestion 2</label>

                

                   <select class="form-control input-sm" name="question2" id="question2">

                                                    <option value="" >Select one</option>                    

                                                    <option value='1'> What Is The Name Of Your Favourite Sports Team? </option><option value='2'> What Is The Make Of Your First Car? </option><option value='3'> In Which City Was Your High School? </option><option value='4'> What Is Your Favourite Colour? </option><option value='5'> What Is Your Favourite Movie? </option><option value='6'> In What City Were You Born? </option><option value='7'> Who Is Your Favourite Actor Or Musician? </option><option value='8'> What Is The Name Of Your Favourite Pet? </option><option value='9'> What Is Your Favourite Holiday Place? </option>  

                                     </select>

                  </div>

            </div>

            <div class="col-md-6">

           		 <div class="form-group">

                    <label>Answer</label>

                  <input name="ansr_2" type="text" class="form-control input-sm required"   id="ansr_2" value="" >

                  </div>

            </div>

            </div>

            <div class="row">

            <div class="col-md-6">

           		 <div class="form-group">

                    <label>Qestion 3</label>

                  

                    <select class="form-control input-sm" name="question3" id="question3">

                                         <option value="" >Select one</option>                    

	                                        <option value='1'> What Is The Name Of Your Favourite Sports Team? </option><option value='2'> What Is The Make Of Your First Car? </option><option value='3'> In Which City Was Your High School? </option><option value='4'> What Is Your Favourite Colour? </option><option value='5'> What Is Your Favourite Movie? </option><option value='6'> In What City Were You Born? </option><option value='7'> Who Is Your Favourite Actor Or Musician? </option><option value='8'> What Is The Name Of Your Favourite Pet? </option><option value='9'> What Is Your Favourite Holiday Place? </option>  

                                    </select>

                  </div>

            </div>

            <div class="col-md-6">

           		 <div class="form-group">

                    <label>Answer</label>

                  <input name="ansr_3" type="text" class="form-control required input-sm"   id="ansr_3" value="" >

                  </div>

            </div>

            </div>

            </div>

            

            </div>

            </form>

            </div>

            </div>

            </div>

           

            

            <script src="<?php echo base_url();?>js_module/users-questions.js"></script>

            

            

            </div>

            



 			</div>

            </div>