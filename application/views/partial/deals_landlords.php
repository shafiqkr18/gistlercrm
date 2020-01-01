 <script>
   /* Insert / Update function */
    landlord_id_list_input = 'landlord_id_list';landlord_id_input = 'landlord_id';landlord_name_input
 = 'landlord_name';    
 $(".ltrim").blur(function() {
		
		var str = $(this).val();
		$(this).val((ltrim(str, "0")));
	});
 $(document).ready(function() {
	 var rand_key_contacts = '';
		rand_key_contacts=$('input#rand_key_contacts').val();
                if (rand_key_contacts<1 || rand_key_contacts=='' || rand_key_contacts==0) { 
				rand_key_contacts=genRandKey();
				$('#rand_key_contacts').val(rand_key_contacts);
			}	
	$(".ltrim").numeric();
        $("#mobile_no_new, #email").change( function () {
            if(this.id == 'mobile_no_new'){
                $("#email").removeClass('form_fields_error');
            }else{
                $("#mobile_no_new").removeClass('form_fields_error');
            }
        });

        $("#mobile, #phone, #landlord_search_table #landlord_popup_4, #landlord_search_table #landlord_popup_5").numeric();

        $('#myForm_landlord').ajaxForm({
            beforeSubmit : function() {
				
                var lookup	 = '';
                var validate 	 = '';
			
			 	//  validate =  $("#myForm_landlord").validate({rules: { price: { number: true, }, size: { number: true },
				//	 email: { email:true, require_from_group: [1, ".phone-group"]}, mobile_no_new: { require_from_group: [1, ".phone-group"]}} ,
 				validate =  $("#myForm_landlord").validate({rules: { mobile_no_new: { number: true, }, name: { required: true }} ,
				  errorClass: 'form_fields_error',  errorPlacement: function(error, element)
					 {
                    //$(element).attr({"title": error.text('asdasd')});

                    $('#successMsg').animate({ 'color': 'red'}, "slow");
                    $('#successMsg').fadeIn("slow");
                    $('#successtxt').html('Please complete all required fields');
                    setTimeout(function() {
                        $('#successMsg').fadeOut("slow");
                        $('#successMsg').animate({ 'color': 'red'}, "slow");
                    }, 5000);

                    //alert('Please fill the required fields')
                }}).form() ;
				
			if(!validate) return false;

                $.ajax({
                    async: false,
                    url: mainurl+'contacts/lookupnew/?email='+$('#email').val()+'&mobile_no_new='+$('#mobile_no_new').val()+'&phone='+$('#phone').val()+ '&area_code='+$('#myForm_landlord #mobile_no_new_ccode').val()+ '&country_code_mobile='+$('#c_code_phone_1').val(),
                    success: function(data) {
						
                        if(data>0){
                            lookup = false;
                           alert("This contact is already exist,please search in existing list");
                        }
                        else{
                            lookup = true;
                        }
                    }
                })


            

				
                if(lookup && validate){
                    return true;
                }
                else{
                    return false;
                }

            },
            target: '#successtxt',
            success: function() {
             //   fnClickAddRowB(),
                    formDataChange=false;
                $('#add_new_contact_table').hide();
				$('#successtxt').text('Saved Data');
                $('#successMsg').animate({ 'color': '#49AC44'}, "slow"),
                    $('#successMsg').fadeIn("slow"),
                    $("#myForm_landlord")[ 0 ].reset(),
                    setTimeout(function() {
                        $('#successMsg').fadeOut("slow")
                    }, 5000);
            }
        });
    });

    function fnClickAddRowB() {
        $('#listings_row_landlord').dataTable().fnAddData( [
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',


            '',

        ] );
    }

    //end update
//datatable initilization
$(document).ready(function() {
	 var oTable = $('#listings_row_landlord').dataTable({
		 "bProcessing": true,
            "bServerSide": true,
            "sDom": 'R<>rt<ilp><"clear">',
			"pageLength": 5,
                  'columnDefs': [{
         'targets': 0,
         'searchable':false,
         'orderable':false,
        // 'className': 'dt-body-center',
         'render': function (data, type, full, meta){
			
             $('#check_all_checkboxes_owner').attr('checked', false);
			// return '<div style="text-align:center;"><input style="align:center;" type="checkbox" value="' + data + '">  <span class="lbl"></span></div>';
			return '<div style="text-align:center; width:22px;" id="item_action"><input type="radio" name="select_landlord" style="opacity:1;" id="checkbox_'+ data +'" value="'+ data +'"></div>';
         }
      }],

			
		"columns": [
			{ "data": "id" },
			{ "data": "name" },{ "data": "last_name" },
			{ "data": "mobile_no_new_ccode"},{ "data": "mobile_no_new" },{ "data": "phone" },{ "data": "email" },{ "data": "first_name" },{ "data": "first_name" },{ "data": "dateupdated" }
			],
		"bServerSide": true,
		 "sAjaxSource": config.siteUrl+"common/datatable_landlord_popup",
                "bJQueryUI": true,
                "sPaginationType": "full_numbers",
                "iDisplayStart ":0,
         
       
                'fnServerData': function (url, data, callback) 
            {
				
				data.contact_type = $('#contact_type').val();
              $.ajax
              ({
                'dataType': 'json',
                'type'    : 'POST',
                'url'     : url,
                'data'    : data,
                'success' : callback
				
              });
            }
	});
	
	$('.datatable-setbotclass').next().addClass('fixedpagination-bottom');
	
	 //search button code
        $("#search_landlord").click(function () {
			
			if(($.trim($('.1_landlord_search').val())!="" || $.trim($('.2_landlord_search').val())!="") && $('.1_landlord_search').val().length<2){
				//alert("First name field must have at least 2 characters.");
			}
			else if(($.trim($('.2_landlord_search').val())!="" || $.trim($('.1_landlord_search').val())!="") && $('.2_landlord_search').val().length<2){
				//alert("Last name field must have at least 2 characters.");
			}
			else if($.trim($('.1_landlord_search').val())!="" && $('.4_landlord_search').val().length<7 && $.trim($('.5_landlord_search').val())=="" && $.trim($('.5_landlord_search').val())==""){
				//alert("To search using name you must enter a valid mobile no, email address or a phone number.");
			}
			else if($('.4_landlord_search').val().length<7 && $.trim($('.4_landlord_search').val())!=""){
				alert("Mobile No field must have at least 7 digits.");
			}
			else if($('.5_landlord_search').val().length<7 && $.trim($('.5_landlord_search').val())!=""){
			//	alert("Phone No field must have at least 5 digits.");
			}
			else if($('.6_landlord_search').val().length<3 && $.trim($('.6_landlord_search').val())!=""){
			//	alert("Email Address field must have at least 3 characters.");
			}
			else{
				dummy_id = '';
				 var oTable2 = $('#listings_row_landlord').dataTable();
        		 oTable2.fnDraw();
				oTable2.fnFilter( $('.4_landlord_search').val(), 4 );
			}
			
		} );
		 //add new contact button code
        $("#add_new_contact").click(function () {
            var count = 1;

            /*
             //alert ('hello');
             //var country_code=$('#myForm_landlord_search #3').val();

             alert($('#landlord_search_table #1').val());

             $('#myForm_landlord #name').val( $('#myForm_landlord_search #1').val() );
             $('#myForm_landlord #last_name').val( $('#myForm_landlord_search #2').val() );
             //$("#myForm_landlord #mobile_no_new_ccode option[value='"+country_code+"']").attr("selected"
, "selected");
             //$('#myForm_landlord #3').val( $('#myForm_landlord_search #3').val() );
             $('#myForm_landlord #mobile_no_new').val( $('#myForm_landlord_search #4').val() );
             $('#myForm_landlord #phone').val( $('#myForm_landlord_search #5').val() );
             $('#myForm_landlord #email').val( $('#myForm_landlord_search #6').val() );
             */

            $('#add_new_contact_table').show();
        } );
		  $("#hide_new_contact_form").click(function () {
            $('#add_new_contact_table').hide();
        } );



	  $('#listings_row_landlord').change(function(){

            if($('#landlord_id').val()!=''){
                //var confirm_change = confirm('Are you sure you want to change the contact detail?');
                var confirm_change = true;
            }
            else{
                confirm_change     = true;
            }

            if(confirm_change){

                var value;
				 var first_name;
				 var last_name;
                $('#listings_row_landlord input:checked').each(function() {
                    value = $(this).val();
					first_name = $(this).closest("tr").find("td:eq(1)").text();
					last_name = $(this).closest("tr").find("td:eq(2)").text();
               
                    /*if($(this).val()!='checkbox_'+value){

                     $('#listings_row_landlord inbox').attr('checked', '');
                     }*/
                });


              //  var first_name  = $('#'+value).find("td:nth-child(2) div").html();
               // var last_name   = $('#'+value).find("td:nth-child(3) div").html();
			
                var landlord_id = value;
				$('#landlord_id').val(value);

                if(last_name==null){
                    last_name = '';
                }

                if(first_name==null){
                    first_name = '';
                }

            }
			$('#landlord_name').val(first_name+' '+last_name);
			
			//check for buyer and seller
			if($('#contact_type').val() == 1)
			{
				$('#tenant_buyer_name').val(first_name+' '+last_name);
				$('#tenant_buyer_id').val(value);
			}else{
				$('#landlord_seller_name').val(first_name+' '+last_name);
				$('#landlord_seller_id').val(value);
			}
			

            //$("td.yellowCSS", oTable2.fnGetNodes()).removeClass("yellowCSS");
            $('#listings_row_landlord tbody #'+value).find("td").addClass("yellowCSS");


        });
	
	
//get agents
 $.getJSON(config.siteUrl+'common/getAgents', function(data){
  //check for agents
  if(config.user.user_access==3)
  {
     var len = data.length;
    for (var i = 0; i< len; i++) {
	
	   if(admid == data[i].id)
	{
        html = '<option selected="" value="' + data[i].id + '">' + data[i].name + '</option>';
   }else{
        html += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
		}
    }
  }else{
    var html = "<option  value=''>Assign To</option>";
    var len = data.length;
    for (var i = 0; i< len; i++) {
	html += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
	
    }
}
	$('#assigned_to_id1').append(html);

	$('.selectpicker').selectpicker('refresh');
});
 

});
</script>

   <h4 class="text-primary">Search for existing contact details:</h4>
                 <!-- <a href="#" class="btn btn-primary margin-bottom-15 "><i class="fa fa-search"></i> Search Contacts</a>-->
                  <button type="button" id="search_landlord" class="btn btn-primary margin-bottom-15"><i class="fa fa-search"></i>Search Contacts
</button>
                  <div class="row">
                  	<div class="col-md-2">
                   <!-- <input type="text" class="form-control" placeholder="First Name">-->
                    <input id='landlord_popup_1' type="text" class=" form-control 1_landlord_search"
 placeholder="First Name">
                    </div>
                    <div class="col-md-2">
                   <input id='landlord_popup_2' type="text" class=" form-control 2_landlord_search"
 placeholder="Last Name">
                    </div>
                    <div class="col-md-2">
                     
                        <select name="3" id="3" class="form-control 3_landlord_search phone-code-field">

 <option value="1">USA (+1)</option> 
 <option value="213">Algeria (+213)</option> 
 <option value="376">Andorra (+376)</option> 
 <option value="244">Angola (+244)</option> 
 <option value="1264">Anguilla (+1264)</option> 
 <option value="1268">Antigua &amp; Barbuda (+1268)</option> 
 <option value="599">Antilles (Dutch) (+599)</option> 
 <option value="54">Argentina (+54)</option> 
 <option value="374">Armenia (+374)</option> 
 <option value="297">Aruba (+297)</option> 
 <option value="247">Ascension Island (+247)</option> 
 <option value="61">Australia (+61)</option> 
 <option value="43">Austria (+43)</option> 
 <option value="994">Azerbaijan (+994)</option> 
 <option value="1242">Bahamas (+1242)</option> 
 <option value="973">Bahrain (+973)</option> 
 <option value="880">Bangladesh (+880)</option> 
 <option value="1246">Barbados (+1246)</option> 
 <option value="375">Belarus (+375)</option> 
 <option value="32">Belgium (+32)</option> 
 <option value="501">Belize (+501)</option> 
 <option value="229">Benin (+229)</option> 
 <option value="1441">Bermuda (+1441)</option> 
 <option value="975">Bhutan (+975)</option> 
 <option value="591">Bolivia (+591)</option> 
 <option value="387">Bosnia Herzegovina (+387)</option> 
 <option value="267">Botswana (+267)</option> 
 <option value="55">Brazil (+55)</option> 
 <option value="673">Brunei (+673)</option> 
 <option value="359">Bulgaria (+359)</option> 
 <option value="226">Burkina Faso (+226)</option> 
 <option value="257">Burundi (+257)</option> 
 <option value="855">Cambodia (+855)</option> 
 <option value="237">Cameroon (+237)</option> 
 <option value="1">Canada (+1)</option> 
 <option value="238">Cape Verde Islands (+238)</option> 
 <option value="1345">Cayman Islands (+1345)</option> 
 <option value="236">Central African Republic (+236)</option> 
 <option value="56">Chile (+56)</option> 
 <option value="86">China (+86)</option> 
 <option value="57">Colombia (+57)</option> 
 <option value="269">Comoros (+269)</option> 
 <option value="242">Congo (+242)</option> 
 <option value="682">Cook Islands (+682)</option> 
 <option value="506">Costa Rica (+506)</option> 
 <option value="385">Croatia (+385)</option> 
 <option value="53">Cuba (+53)</option> 
 <option value="90392">Cyprus North (+90392)</option> 
 <option value="357">Cyprus South (+357)</option> 
 <option value="42">Czech Republic (+42)</option> 
 <option value="45">Denmark (+45)</option> 
 <option value="2463">Diego Garcia (+2463)</option> 
 <option value="253">Djibouti (+253)</option> 
 <option value="1809">Dominica (+1809)</option> 
 <option value="1809">Dominican Republic (+1809)</option> 
 <option value="593">Ecuador (+593)</option> 
 <option value="20">Egypt (+20)</option> 
 <option value="353">Eire (+353)</option> 
 <option value="503">El Salvador (+503)</option> 
 <option value="240">Equatorial Guinea (+240)</option> 
 <option value="291">Eritrea (+291)</option> 
 <option value="372">Estonia (+372)</option> 
 <option value="251">Ethiopia (+251)</option> 
 <option value="500">Falkland Islands (+500)</option> 
 <option value="298">Faroe Islands (+298)</option> 
 <option value="679">Fiji (+679)</option> 
 <option value="358">Finland (+358)</option> 
 <option value="33">France (+33)</option> 
 <option value="594">French Guiana (+594)</option> 
 <option value="689">French Polynesia (+689)</option> 
 <option value="241">Gabon (+241)</option> 
 <option value="220">Gambia (+220)</option> 
 <option value="7880">Georgia (+7880)</option> 
 <option value="49">Germany (+49)</option> 
 <option value="233">Ghana (+233)</option> 
 <option value="350">Gibraltar (+350)</option> 
 <option value="30">Greece (+30)</option> 
 <option value="299">Greenland (+299)</option> 
 <option value="1473">Grenada (+1473)</option> 
 <option value="590">Guadeloupe (+590)</option> 
 <option value="671">Guam (+671)</option> 
 <option value="502">Guatemala (+502)</option> 
 <option value="224">Guinea (+224)</option> 
 <option value="245">Guinea - Bissau (+245)</option> 
 <option value="592">Guyana (+592)</option> 
 <option value="509">Haiti (+509)</option> 
 <option value="504">Honduras (+504)</option> 
 <option value="852">Hong Kong (+852)</option> 
 <option value="36">Hungary (+36)</option> 
 <option value="354">Iceland (+354)</option> 
 <option value="91">India (+91)</option> 
 <option value="62">Indonesia (+62)</option> 
 <option value="98">Iran (+98)</option> 
 <option value="964">Iraq (+964)</option> 
 <option value="972">Israel (+972)</option> 
 <option value="39">Italy (+39)</option> 
 <option value="225">Ivory Coast (+225)</option> 
 <option value="1876">Jamaica (+1876)</option> 
 <option value="81">Japan (+81)</option> 
 <option value="962">Jordan (+962)</option> 
 <option value="7">Kazakhstan (+7)</option> 
 <option value="254">Kenya (+254)</option> 
 <option value="686">Kiribati (+686)</option> 
 <option value="850">Korea North (+850)</option> 
 <option value="82">Korea South (+82)</option> 
 <option value="965">Kuwait (+965)</option> 
 <option value="996">Kyrgyzstan (+996)</option> 
 <option value="856">Laos (+856)</option> 
 <option value="371">Latvia (+371)</option> 
 <option value="961">Lebanon (+961)</option> 
 <option value="266">Lesotho (+266)</option> 
 <option value="231">Liberia (+231)</option> 
 <option value="218">Libya (+218)</option> 
 <option value="417">Liechtenstein (+417)</option> 
 <option value="370">Lithuania (+370)</option> 
 <option value="352">Luxembourg (+352)</option> 
 <option value="853">Macao (+853)</option> 
 <option value="389">Macedonia (+389)</option> 
 <option value="261">Madagascar (+261)</option> 
 <option value="265">Malawi (+265)</option> 
 <option value="60">Malaysia (+60)</option> 
 <option value="960">Maldives (+960)</option> 
 <option value="223">Mali (+223)</option> 
 <option value="356">Malta (+356)</option> 
 <option value="692">Marshall Islands (+692)</option> 
 <option value="596">Martinique (+596)</option> 
 <option value="222">Mauritania (+222)</option> 
 <option value="269">Mayotte (+269)</option> 
 <option value="52">Mexico (+52)</option> 
 <option value="691">Micronesia (+691)</option> 
 <option value="373">Moldova (+373)</option> 
 <option value="377">Monaco (+377)</option> 
 <option value="976">Mongolia (+976)</option> 
 <option value="1664">Montserrat (+1664)</option> 
 <option value="212">Morocco (+212)</option> 
 <option value="258">Mozambique (+258)</option> 
 <option value="95">Myanmar (+95)</option> 
 <option value="264">Namibia (+264)</option> 
 <option value="674">Nauru (+674)</option> 
 <option value="977">Nepal (+977)</option> 
 <option value="31">Netherlands (+31)</option> 
 <option value="687">New Caledonia (+687)</option> 
 <option value="64">New Zealand (+64)</option> 
 <option value="505">Nicaragua (+505)</option> 
 <option value="227">Niger (+227)</option> 
 <option value="234">Nigeria (+234)</option> 
 <option value="683">Niue (+683)</option> 
 <option value="672">Norfolk Islands (+672)</option> 
 <option value="670">Northern Marianas (+670)</option> 
 <option value="47">Norway (+47)</option> 
 <option value="968">Oman (+968)</option> 
 <option value="92">Pakistan (+92)</option> 
 <option value="680">Palau (+680)</option> 
 <option value="507">Panama (+507)</option> 
 <option value="675">Papua New Guinea (+675)</option> 
 <option value="595">Paraguay (+595)</option> 
 <option value="51">Peru (+51)</option> 
 <option value="63">Philippines (+63)</option> 
 <option value="48">Poland (+48)</option> 
 <option value="351">Portugal (+351)</option> 
 <option value="1787">Puerto Rico (+1787)</option> 
 <option value="974">Qatar (+974)</option> 
 <option value="262">Reunion (+262)</option> 
 <option value="40">Romania (+40)</option> 
 <option value="7">Russia (+7)</option> 
 <option value="250">Rwanda (+250)</option> 
 <option value="378">San Marino (+378)</option> 
 <option value="239">Sao Tome &amp; Principe (+239)</option> 
 <option value="966">Saudi Arabia (+966)</option> 
 <option value="221">Senegal (+221)</option> 
 <option value="381">Serbia (+381)</option> 
 <option value="248">Seychelles (+248)</option> 
 <option value="232">Sierra Leone (+232)</option> 
 <option value="65">Singapore (+65)</option> 
 <option value="421">Slovak Republic (+421)</option> 
 <option value="386">Slovenia (+386)</option> 
 <option value="677">Solomon Islands (+677)</option> 
 <option value="252">Somalia (+252)</option> 
 <option value="27">South Africa (+27)</option> 
 <option value="34">Spain (+34)</option> 
 <option value="94">Sri Lanka (+94)</option> 
 <option value="290">St. Helena (+290)</option> 
 <option value="1869">St. Kitts (+1869)</option> 
 <option value="1758">St. Lucia (+1758)</option> 
 <option value="249">Sudan (+249)</option> 
 <option value="597">Suriname (+597)</option> 
 <option value="268">Swaziland (+268)</option> 
 <option value="46">Sweden (+46)</option> 
 <option value="41">Switzerland (+41)</option> 
 <option value="963">Syria (+963)</option> 
 <option value="886">Taiwan (+886)</option> 
 <option value="7">Tajikstan (+7)</option> 
 <option value="66">Thailand (+66)</option> 
 <option value="228">Togo (+228)</option> 
 <option value="676">Tonga (+676)</option> 
 <option value="1868">Trinidad &amp; Tobago (+1868)</option> 
 <option value="216">Tunisia (+216)</option> 
 <option value="90">Turkey (+90)</option> 
 <option value="7">Turkmenistan (+7)</option> 
 <option value="993">Turkmenistan (+993)</option> 
 <option value="1649">Turks &amp; Caicos Islands (+1649)</option> 
 <option value="688">Tuvalu (+688)</option> 
 <option value="256">Uganda (+256)</option> 
 <option value="44" >UK (+44)</option> 
 <option value="380">Ukraine (+380)</option> 
 <option value="971" selected="selected">United Arab Emirates (+971)</option> 
 <option value="598">Uruguay (+598)</option> 
 <option value="1">USA (+1)</option> 
 <option value="7">Uzbekistan (+7)</option> 
 <option value="678">Vanuatu (+678)</option> 
 <option value="379">Vatican City (+379)</option> 
 <option value="58">Venezuela (+58)</option> 
 <option value="84">Vietnam (+84)</option> 
 <option value="84">Virgin Islands - British (+1284)</option> 
 <option value="84">Virgin Islands - US (+1340)</option> 
 <option value="681">Wallis &amp; Futuna (+681)</option> 
 <option value="969">Yemen (North)(+969)</option> 
 <option value="967">Yemen (South)(+967)</option> 
 <option value="381">Yugoslavia (+381)</option> 
 <option value="243">Zaire (+243)</option> 
 <option value="260">Zambia (+260)</option> 
 <option value="263">Zimbabwe (+263)</option>
  </select>
                    </div>
                    <div class="col-md-2">
                     <input id='landlord_popup_4' type="text" class="ltrim 4_landlord_search  form-control phone-number-field"
 placeholder="Mobile #">
                    </div>
                    <div class="col-md-2">
                     <input id='landlord_popup_5' type="text" class="ltrim 5_landlord_search form-control"
 placeholder="Phone #">
                    </div>
                    <div class="col-md-2">
                    <input id='landlord_popup_6' type="text" class="6_landlord_search form-control"
 placeholder="Email Address">
                    </div>
                  </div>
                  
                  <hr>
                  <p>Select a record below or: 
              
                   <button type="button" id="add_new_contact" class="btn btn-success"><i class="fa fa-plus-square"></i>Add New Contact
</button>
<form id="myForm_landlord" action="<?php echo site_url();?>contacts/submit" method="post">
<input type="hidden" id="contact_type" name="contact_type" value="<?php echo $con_type;?>" />
<input type="hidden" id="rand_key_contacts" name="rand_key_contacts" value="" />
 <div id="add_new_contact_table" style="display: none;">
                  <div class="row">
                  	<div class="col-md-3">
                
                    <input id="name" name="name" type="text" class="form-control required" placeholder="First Name">
                    </div>
                    <div class="col-md-3">
                   <input name="last_name" class="form-control required" id="last_name"
 placeholder="Last Name">
                    </div>
                    <div class="col-md-3">
                     <select name="mobile_no_new_ccode" id="mobile_no_new_ccode" class="form-control phone-code-field" >

 <option value="1">USA (+1)</option> 
 <option value="213">Algeria (+213)</option> 
 <option value="376">Andorra (+376)</option> 
 <option value="244">Angola (+244)</option> 
 <option value="1264">Anguilla (+1264)</option> 
 <option value="1268">Antigua &amp; Barbuda (+1268)</option> 
 <option value="599">Antilles (Dutch) (+599)</option> 
 <option value="54">Argentina (+54)</option> 
 <option value="374">Armenia (+374)</option> 
 <option value="297">Aruba (+297)</option> 
 <option value="247">Ascension Island (+247)</option> 
 <option value="61">Australia (+61)</option> 
 <option value="43">Austria (+43)</option> 
 <option value="994">Azerbaijan (+994)</option> 
 <option value="1242">Bahamas (+1242)</option> 
 <option value="973">Bahrain (+973)</option> 
 <option value="880">Bangladesh (+880)</option> 
 <option value="1246">Barbados (+1246)</option> 
 <option value="375">Belarus (+375)</option> 
 <option value="32">Belgium (+32)</option> 
 <option value="501">Belize (+501)</option> 
 <option value="229">Benin (+229)</option> 
 <option value="1441">Bermuda (+1441)</option> 
 <option value="975">Bhutan (+975)</option> 
 <option value="591">Bolivia (+591)</option> 
 <option value="387">Bosnia Herzegovina (+387)</option> 
 <option value="267">Botswana (+267)</option> 
 <option value="55">Brazil (+55)</option> 
 <option value="673">Brunei (+673)</option> 
 <option value="359">Bulgaria (+359)</option> 
 <option value="226">Burkina Faso (+226)</option> 
 <option value="257">Burundi (+257)</option> 
 <option value="855">Cambodia (+855)</option> 
 <option value="237">Cameroon (+237)</option> 
 <option value="1">Canada (+1)</option> 
 <option value="238">Cape Verde Islands (+238)</option> 
 <option value="1345">Cayman Islands (+1345)</option> 
 <option value="236">Central African Republic (+236)</option> 
 <option value="56">Chile (+56)</option> 
 <option value="86">China (+86)</option> 
 <option value="57">Colombia (+57)</option> 
 <option value="269">Comoros (+269)</option> 
 <option value="242">Congo (+242)</option> 
 <option value="682">Cook Islands (+682)</option> 
 <option value="506">Costa Rica (+506)</option> 
 <option value="385">Croatia (+385)</option> 
 <option value="53">Cuba (+53)</option> 
 <option value="90392">Cyprus North (+90392)</option> 
 <option value="357">Cyprus South (+357)</option> 
 <option value="42">Czech Republic (+42)</option> 
 <option value="45">Denmark (+45)</option> 
 <option value="2463">Diego Garcia (+2463)</option> 
 <option value="253">Djibouti (+253)</option> 
 <option value="1809">Dominica (+1809)</option> 
 <option value="1809">Dominican Republic (+1809)</option> 
 <option value="593">Ecuador (+593)</option> 
 <option value="20">Egypt (+20)</option> 
 <option value="353">Eire (+353)</option> 
 <option value="503">El Salvador (+503)</option> 
 <option value="240">Equatorial Guinea (+240)</option> 
 <option value="291">Eritrea (+291)</option> 
 <option value="372">Estonia (+372)</option> 
 <option value="251">Ethiopia (+251)</option> 
 <option value="500">Falkland Islands (+500)</option> 
 <option value="298">Faroe Islands (+298)</option> 
 <option value="679">Fiji (+679)</option> 
 <option value="358">Finland (+358)</option> 
 <option value="33">France (+33)</option> 
 <option value="594">French Guiana (+594)</option> 
 <option value="689">French Polynesia (+689)</option> 
 <option value="241">Gabon (+241)</option> 
 <option value="220">Gambia (+220)</option> 
 <option value="7880">Georgia (+7880)</option> 
 <option value="49">Germany (+49)</option> 
 <option value="233">Ghana (+233)</option> 
 <option value="350">Gibraltar (+350)</option> 
 <option value="30">Greece (+30)</option> 
 <option value="299">Greenland (+299)</option> 
 <option value="1473">Grenada (+1473)</option> 
 <option value="590">Guadeloupe (+590)</option> 
 <option value="671">Guam (+671)</option> 
 <option value="502">Guatemala (+502)</option> 
 <option value="224">Guinea (+224)</option> 
 <option value="245">Guinea - Bissau (+245)</option> 
 <option value="592">Guyana (+592)</option> 
 <option value="509">Haiti (+509)</option> 
 <option value="504">Honduras (+504)</option> 
 <option value="852">Hong Kong (+852)</option> 
 <option value="36">Hungary (+36)</option> 
 <option value="354">Iceland (+354)</option> 
 <option value="91">India (+91)</option> 
 <option value="62">Indonesia (+62)</option> 
 <option value="98">Iran (+98)</option> 
 <option value="964">Iraq (+964)</option> 
 <option value="972">Israel (+972)</option> 
 <option value="39">Italy (+39)</option> 
 <option value="225">Ivory Coast (+225)</option> 
 <option value="1876">Jamaica (+1876)</option> 
 <option value="81">Japan (+81)</option> 
 <option value="962">Jordan (+962)</option> 
 <option value="7">Kazakhstan (+7)</option> 
 <option value="254">Kenya (+254)</option> 
 <option value="686">Kiribati (+686)</option> 
 <option value="850">Korea North (+850)</option> 
 <option value="82">Korea South (+82)</option> 
 <option value="965">Kuwait (+965)</option> 
 <option value="996">Kyrgyzstan (+996)</option> 
 <option value="856">Laos (+856)</option> 
 <option value="371">Latvia (+371)</option> 
 <option value="961">Lebanon (+961)</option> 
 <option value="266">Lesotho (+266)</option> 
 <option value="231">Liberia (+231)</option> 
 <option value="218">Libya (+218)</option> 
 <option value="417">Liechtenstein (+417)</option> 
 <option value="370">Lithuania (+370)</option> 
 <option value="352">Luxembourg (+352)</option> 
 <option value="853">Macao (+853)</option> 
 <option value="389">Macedonia (+389)</option> 
 <option value="261">Madagascar (+261)</option> 
 <option value="265">Malawi (+265)</option> 
 <option value="60">Malaysia (+60)</option> 
 <option value="960">Maldives (+960)</option> 
 <option value="223">Mali (+223)</option> 
 <option value="356">Malta (+356)</option> 
 <option value="692">Marshall Islands (+692)</option> 
 <option value="596">Martinique (+596)</option> 
 <option value="222">Mauritania (+222)</option> 
 <option value="269">Mayotte (+269)</option> 
 <option value="52">Mexico (+52)</option> 
 <option value="691">Micronesia (+691)</option> 
 <option value="373">Moldova (+373)</option> 
 <option value="377">Monaco (+377)</option> 
 <option value="976">Mongolia (+976)</option> 
 <option value="1664">Montserrat (+1664)</option> 
 <option value="212">Morocco (+212)</option> 
 <option value="258">Mozambique (+258)</option> 
 <option value="95">Myanmar (+95)</option> 
 <option value="264">Namibia (+264)</option> 
 <option value="674">Nauru (+674)</option> 
 <option value="977">Nepal (+977)</option> 
 <option value="31">Netherlands (+31)</option> 
 <option value="687">New Caledonia (+687)</option> 
 <option value="64">New Zealand (+64)</option> 
 <option value="505">Nicaragua (+505)</option> 
 <option value="227">Niger (+227)</option> 
 <option value="234">Nigeria (+234)</option> 
 <option value="683">Niue (+683)</option> 
 <option value="672">Norfolk Islands (+672)</option> 
 <option value="670">Northern Marianas (+670)</option> 
 <option value="47">Norway (+47)</option> 
 <option value="968">Oman (+968)</option> 
 <option value="92">Pakistan (+92)</option> 
 <option value="680">Palau (+680)</option> 
 <option value="507">Panama (+507)</option> 
 <option value="675">Papua New Guinea (+675)</option> 
 <option value="595">Paraguay (+595)</option> 
 <option value="51">Peru (+51)</option> 
 <option value="63">Philippines (+63)</option> 
 <option value="48">Poland (+48)</option> 
 <option value="351">Portugal (+351)</option> 
 <option value="1787">Puerto Rico (+1787)</option> 
 <option value="974">Qatar (+974)</option> 
 <option value="262">Reunion (+262)</option> 
 <option value="40">Romania (+40)</option> 
 <option value="7">Russia (+7)</option> 
 <option value="250">Rwanda (+250)</option> 
 <option value="378">San Marino (+378)</option> 
 <option value="239">Sao Tome &amp; Principe (+239)</option> 
 <option value="966">Saudi Arabia (+966)</option> 
 <option value="221">Senegal (+221)</option> 
 <option value="381">Serbia (+381)</option> 
 <option value="248">Seychelles (+248)</option> 
 <option value="232">Sierra Leone (+232)</option> 
 <option value="65">Singapore (+65)</option> 
 <option value="421">Slovak Republic (+421)</option> 
 <option value="386">Slovenia (+386)</option> 
 <option value="677">Solomon Islands (+677)</option> 
 <option value="252">Somalia (+252)</option> 
 <option value="27">South Africa (+27)</option> 
 <option value="34">Spain (+34)</option> 
 <option value="94">Sri Lanka (+94)</option> 
 <option value="290">St. Helena (+290)</option> 
 <option value="1869">St. Kitts (+1869)</option> 
 <option value="1758">St. Lucia (+1758)</option> 
 <option value="249">Sudan (+249)</option> 
 <option value="597">Suriname (+597)</option> 
 <option value="268">Swaziland (+268)</option> 
 <option value="46">Sweden (+46)</option> 
 <option value="41">Switzerland (+41)</option> 
 <option value="963">Syria (+963)</option> 
 <option value="886">Taiwan (+886)</option> 
 <option value="7">Tajikstan (+7)</option> 
 <option value="66">Thailand (+66)</option> 
 <option value="228">Togo (+228)</option> 
 <option value="676">Tonga (+676)</option> 
 <option value="1868">Trinidad &amp; Tobago (+1868)</option> 
 <option value="216">Tunisia (+216)</option> 
 <option value="90">Turkey (+90)</option> 
 <option value="7">Turkmenistan (+7)</option> 
 <option value="993">Turkmenistan (+993)</option> 
 <option value="1649">Turks &amp; Caicos Islands (+1649)</option> 
 <option value="688">Tuvalu (+688)</option> 
 <option value="256">Uganda (+256)</option> 
 <option value="44" >UK (+44)</option> 
 <option value="380">Ukraine (+380)</option> 
 <option value="971" selected="selected">United Arab Emirates (+971)</option> 
 <option value="598">Uruguay (+598)</option> 
 <option value="1">USA (+1)</option> 
 <option value="7">Uzbekistan (+7)</option> 
 <option value="678">Vanuatu (+678)</option> 
 <option value="379">Vatican City (+379)</option> 
 <option value="58">Venezuela (+58)</option> 
 <option value="84">Vietnam (+84)</option> 
 <option value="84">Virgin Islands - British (+1284)</option> 
 <option value="84">Virgin Islands - US (+1340)</option> 
 <option value="681">Wallis &amp; Futuna (+681)</option> 
 <option value="969">Yemen (North)(+969)</option> 
 <option value="967">Yemen (South)(+967)</option> 
 <option value="381">Yugoslavia (+381)</option> 
 <option value="243">Zaire (+243)</option> 
 <option value="260">Zambia (+260)</option> 
 <option value="263">Zimbabwe (+263)</option>
  </select>
                        
                    </div>
                    <div class="col-md-3">
                      <input name="mobile_no_new" class="form-control required ltrim phone-group phone-number-field" id="mobile_no_new" placeholder="Mobile #">
                    </div>
                  
                      </div>
                      <p></p>
                   <div class="row">
                  	  <div class="col-md-3">
                    <select name="c_code_phone_1" id="c_code_phone_1" class="form-control phone-code-field" >

 <option value="1">USA (+1)</option> 
 <option value="213">Algeria (+213)</option> 
 <option value="376">Andorra (+376)</option> 
 <option value="244">Angola (+244)</option> 
 <option value="1264">Anguilla (+1264)</option> 
 <option value="1268">Antigua &amp; Barbuda (+1268)</option> 
 <option value="599">Antilles (Dutch) (+599)</option> 
 <option value="54">Argentina (+54)</option> 
 <option value="374">Armenia (+374)</option> 
 <option value="297">Aruba (+297)</option> 
 <option value="247">Ascension Island (+247)</option> 
 <option value="61">Australia (+61)</option> 
 <option value="43">Austria (+43)</option> 
 <option value="994">Azerbaijan (+994)</option> 
 <option value="1242">Bahamas (+1242)</option> 
 <option value="973">Bahrain (+973)</option> 
 <option value="880">Bangladesh (+880)</option> 
 <option value="1246">Barbados (+1246)</option> 
 <option value="375">Belarus (+375)</option> 
 <option value="32">Belgium (+32)</option> 
 <option value="501">Belize (+501)</option> 
 <option value="229">Benin (+229)</option> 
 <option value="1441">Bermuda (+1441)</option> 
 <option value="975">Bhutan (+975)</option> 
 <option value="591">Bolivia (+591)</option> 
 <option value="387">Bosnia Herzegovina (+387)</option> 
 <option value="267">Botswana (+267)</option> 
 <option value="55">Brazil (+55)</option> 
 <option value="673">Brunei (+673)</option> 
 <option value="359">Bulgaria (+359)</option> 
 <option value="226">Burkina Faso (+226)</option> 
 <option value="257">Burundi (+257)</option> 
 <option value="855">Cambodia (+855)</option> 
 <option value="237">Cameroon (+237)</option> 
 <option value="1">Canada (+1)</option> 
 <option value="238">Cape Verde Islands (+238)</option> 
 <option value="1345">Cayman Islands (+1345)</option> 
 <option value="236">Central African Republic (+236)</option> 
 <option value="56">Chile (+56)</option> 
 <option value="86">China (+86)</option> 
 <option value="57">Colombia (+57)</option> 
 <option value="269">Comoros (+269)</option> 
 <option value="242">Congo (+242)</option> 
 <option value="682">Cook Islands (+682)</option> 
 <option value="506">Costa Rica (+506)</option> 
 <option value="385">Croatia (+385)</option> 
 <option value="53">Cuba (+53)</option> 
 <option value="90392">Cyprus North (+90392)</option> 
 <option value="357">Cyprus South (+357)</option> 
 <option value="42">Czech Republic (+42)</option> 
 <option value="45">Denmark (+45)</option> 
 <option value="2463">Diego Garcia (+2463)</option> 
 <option value="253">Djibouti (+253)</option> 
 <option value="1809">Dominica (+1809)</option> 
 <option value="1809">Dominican Republic (+1809)</option> 
 <option value="593">Ecuador (+593)</option> 
 <option value="20">Egypt (+20)</option> 
 <option value="353">Eire (+353)</option> 
 <option value="503">El Salvador (+503)</option> 
 <option value="240">Equatorial Guinea (+240)</option> 
 <option value="291">Eritrea (+291)</option> 
 <option value="372">Estonia (+372)</option> 
 <option value="251">Ethiopia (+251)</option> 
 <option value="500">Falkland Islands (+500)</option> 
 <option value="298">Faroe Islands (+298)</option> 
 <option value="679">Fiji (+679)</option> 
 <option value="358">Finland (+358)</option> 
 <option value="33">France (+33)</option> 
 <option value="594">French Guiana (+594)</option> 
 <option value="689">French Polynesia (+689)</option> 
 <option value="241">Gabon (+241)</option> 
 <option value="220">Gambia (+220)</option> 
 <option value="7880">Georgia (+7880)</option> 
 <option value="49">Germany (+49)</option> 
 <option value="233">Ghana (+233)</option> 
 <option value="350">Gibraltar (+350)</option> 
 <option value="30">Greece (+30)</option> 
 <option value="299">Greenland (+299)</option> 
 <option value="1473">Grenada (+1473)</option> 
 <option value="590">Guadeloupe (+590)</option> 
 <option value="671">Guam (+671)</option> 
 <option value="502">Guatemala (+502)</option> 
 <option value="224">Guinea (+224)</option> 
 <option value="245">Guinea - Bissau (+245)</option> 
 <option value="592">Guyana (+592)</option> 
 <option value="509">Haiti (+509)</option> 
 <option value="504">Honduras (+504)</option> 
 <option value="852">Hong Kong (+852)</option> 
 <option value="36">Hungary (+36)</option> 
 <option value="354">Iceland (+354)</option> 
 <option value="91">India (+91)</option> 
 <option value="62">Indonesia (+62)</option> 
 <option value="98">Iran (+98)</option> 
 <option value="964">Iraq (+964)</option> 
 <option value="972">Israel (+972)</option> 
 <option value="39">Italy (+39)</option> 
 <option value="225">Ivory Coast (+225)</option> 
 <option value="1876">Jamaica (+1876)</option> 
 <option value="81">Japan (+81)</option> 
 <option value="962">Jordan (+962)</option> 
 <option value="7">Kazakhstan (+7)</option> 
 <option value="254">Kenya (+254)</option> 
 <option value="686">Kiribati (+686)</option> 
 <option value="850">Korea North (+850)</option> 
 <option value="82">Korea South (+82)</option> 
 <option value="965">Kuwait (+965)</option> 
 <option value="996">Kyrgyzstan (+996)</option> 
 <option value="856">Laos (+856)</option> 
 <option value="371">Latvia (+371)</option> 
 <option value="961">Lebanon (+961)</option> 
 <option value="266">Lesotho (+266)</option> 
 <option value="231">Liberia (+231)</option> 
 <option value="218">Libya (+218)</option> 
 <option value="417">Liechtenstein (+417)</option> 
 <option value="370">Lithuania (+370)</option> 
 <option value="352">Luxembourg (+352)</option> 
 <option value="853">Macao (+853)</option> 
 <option value="389">Macedonia (+389)</option> 
 <option value="261">Madagascar (+261)</option> 
 <option value="265">Malawi (+265)</option> 
 <option value="60">Malaysia (+60)</option> 
 <option value="960">Maldives (+960)</option> 
 <option value="223">Mali (+223)</option> 
 <option value="356">Malta (+356)</option> 
 <option value="692">Marshall Islands (+692)</option> 
 <option value="596">Martinique (+596)</option> 
 <option value="222">Mauritania (+222)</option> 
 <option value="269">Mayotte (+269)</option> 
 <option value="52">Mexico (+52)</option> 
 <option value="691">Micronesia (+691)</option> 
 <option value="373">Moldova (+373)</option> 
 <option value="377">Monaco (+377)</option> 
 <option value="976">Mongolia (+976)</option> 
 <option value="1664">Montserrat (+1664)</option> 
 <option value="212">Morocco (+212)</option> 
 <option value="258">Mozambique (+258)</option> 
 <option value="95">Myanmar (+95)</option> 
 <option value="264">Namibia (+264)</option> 
 <option value="674">Nauru (+674)</option> 
 <option value="977">Nepal (+977)</option> 
 <option value="31">Netherlands (+31)</option> 
 <option value="687">New Caledonia (+687)</option> 
 <option value="64">New Zealand (+64)</option> 
 <option value="505">Nicaragua (+505)</option> 
 <option value="227">Niger (+227)</option> 
 <option value="234">Nigeria (+234)</option> 
 <option value="683">Niue (+683)</option> 
 <option value="672">Norfolk Islands (+672)</option> 
 <option value="670">Northern Marianas (+670)</option> 
 <option value="47">Norway (+47)</option> 
 <option value="968">Oman (+968)</option> 
 <option value="92">Pakistan (+92)</option> 
 <option value="680">Palau (+680)</option> 
 <option value="507">Panama (+507)</option> 
 <option value="675">Papua New Guinea (+675)</option> 
 <option value="595">Paraguay (+595)</option> 
 <option value="51">Peru (+51)</option> 
 <option value="63">Philippines (+63)</option> 
 <option value="48">Poland (+48)</option> 
 <option value="351">Portugal (+351)</option> 
 <option value="1787">Puerto Rico (+1787)</option> 
 <option value="974">Qatar (+974)</option> 
 <option value="262">Reunion (+262)</option> 
 <option value="40">Romania (+40)</option> 
 <option value="7">Russia (+7)</option> 
 <option value="250">Rwanda (+250)</option> 
 <option value="378">San Marino (+378)</option> 
 <option value="239">Sao Tome &amp; Principe (+239)</option> 
 <option value="966">Saudi Arabia (+966)</option> 
 <option value="221">Senegal (+221)</option> 
 <option value="381">Serbia (+381)</option> 
 <option value="248">Seychelles (+248)</option> 
 <option value="232">Sierra Leone (+232)</option> 
 <option value="65">Singapore (+65)</option> 
 <option value="421">Slovak Republic (+421)</option> 
 <option value="386">Slovenia (+386)</option> 
 <option value="677">Solomon Islands (+677)</option> 
 <option value="252">Somalia (+252)</option> 
 <option value="27">South Africa (+27)</option> 
 <option value="34">Spain (+34)</option> 
 <option value="94">Sri Lanka (+94)</option> 
 <option value="290">St. Helena (+290)</option> 
 <option value="1869">St. Kitts (+1869)</option> 
 <option value="1758">St. Lucia (+1758)</option> 
 <option value="249">Sudan (+249)</option> 
 <option value="597">Suriname (+597)</option> 
 <option value="268">Swaziland (+268)</option> 
 <option value="46">Sweden (+46)</option> 
 <option value="41">Switzerland (+41)</option> 
 <option value="963">Syria (+963)</option> 
 <option value="886">Taiwan (+886)</option> 
 <option value="7">Tajikstan (+7)</option> 
 <option value="66">Thailand (+66)</option> 
 <option value="228">Togo (+228)</option> 
 <option value="676">Tonga (+676)</option> 
 <option value="1868">Trinidad &amp; Tobago (+1868)</option> 
 <option value="216">Tunisia (+216)</option> 
 <option value="90">Turkey (+90)</option> 
 <option value="7">Turkmenistan (+7)</option> 
 <option value="993">Turkmenistan (+993)</option> 
 <option value="1649">Turks &amp; Caicos Islands (+1649)</option> 
 <option value="688">Tuvalu (+688)</option> 
 <option value="256">Uganda (+256)</option> 
 <option value="44" >UK (+44)</option> 
 <option value="380">Ukraine (+380)</option> 
 <option value="971" selected="selected">United Arab Emirates (+971)</option> 
 <option value="598">Uruguay (+598)</option> 
 <option value="1">USA (+1)</option> 
 <option value="7">Uzbekistan (+7)</option> 
 <option value="678">Vanuatu (+678)</option> 
 <option value="379">Vatican City (+379)</option> 
 <option value="58">Venezuela (+58)</option> 
 <option value="84">Vietnam (+84)</option> 
 <option value="84">Virgin Islands - British (+1284)</option> 
 <option value="84">Virgin Islands - US (+1340)</option> 
 <option value="681">Wallis &amp; Futuna (+681)</option> 
 <option value="969">Yemen (North)(+969)</option> 
 <option value="967">Yemen (South)(+967)</option> 
 <option value="381">Yugoslavia (+381)</option> 
 <option value="243">Zaire (+243)</option> 
 <option value="260">Zambia (+260)</option> 
 <option value="263">Zimbabwe (+263)</option>
  </select>
                    
                    
                    </div>
                    <div class="col-md-3">
                    <input name="phone" class="form-control ltrim phone-number-field" id="phone" placeholder="Phone#">
                  
                    </div>
                      <div class="col-md-3">
                        <input name="email" class="form-control required phone-group" id="email" placeholder="Email Address">
                   
                    </div>
                    <div class="col-md-3">
                     <select  name="assigned_to_id1" class="form_fields required phone-group" id="assigned_to_id1"></select>
                    </div>
                    
                      </div>   
                  <p></p>
                 <div class="row">
                 <div class="col-md-2">
                    <button type="submit" id="SaveLandlord" class="btn btn-lg btn-success" name="SaveLandlord" value="Save Landlord">Save Contact</button>
					</div>
						<div class="col-md-2">
                                <a id="hide_new_contact_form" type="text" class="btn btn-lg btn-default">Cancel</a></div>
                  </div>     
                  
   </div>   
   
   </form>            
                  
                  <div class="table-responsive">
                
                                <table width="100%" class="table display table-striped table-bordered table-hover datatable-setbotclass" id="listings_row_landlord">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center;">
                                            
                                            <!-- <label class="states">
                                            <input onClick="toggleCheckedPopUp(this.checked)" id='' type="checkbox">
                                            <span class="lbl"></span>
                                            </label>-->
											</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Country Code</th>
                                            <th>Mobile No</th>
                                            <th>Phone No</th>
                                            <th>Email</th>
                                            <th>Created By</th>
                                            <th>Assigned To</th>
                                            <th>Listed</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                    