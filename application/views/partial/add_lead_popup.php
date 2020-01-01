<script>
$('#table_lead_popup input' ).css('width','113px');
$('#table_lead_popup select') .css('width','120px');

//$('#listings_id').val($('#prop_status option:selected').text());
$('#myForm_lead_popup #enquired_for_ref').val($('#myForm').find('#id').val());
$('#myForm_lead_popup #enquired_for_referance').val($('#myForm').find('#ref').val());
$('#myForm_lead_popup #listings_type').val($('#myForm').find('#category_id').val());
$('#myForm_lead_popup #listings_beds').val($('#myForm').find('#beds').val());
$('#myForm_lead_popup #region_id').val($('#myForm').find('#region_id').val());
$('#myForm_lead_popup #listings_location').val($('#myForm').find('#area_location_id').val());
$('#myForm_lead_popup #listings_sub_location').val($('#myForm').find('#sub_area_location_id').val());
$('#popup_record_reference_Lead').text($('#ref').val());
$('#myForm_lead_popup #min_budget').val($('#myForm').find('#price').val());
$('#myForm_lead_popup #min_beds').val($('#myForm').find('#beds').val());
$('#myForm_lead_popup #min_area').val($('#myForm').find('#size').val());
$('#myForm_lead_popup #unit_no').val($('#myForm').find('#unit').val());
//$('#myForm_lead_popup #property_req_1_data').val($('#myForm').find('#category_id option:selected').text());



/* Insert / Update function */
		 $(document).ready(function() {
			$('#myForm_lead_popup').ajaxForm({
			  beforeSubmit : function() { 
			  return $("#myForm_lead_popup").validate({rules: { price: { number: true, }, size: { number: true, }} , errorClass: 'form_fields_error',  errorPlacement: function(error, element) {
						//$(element).attr({"title": error.text('asdasd')});
							
							$('#showpopupdata').animate({ 'color': 'red'}, "slow");
							$('#showpopupdata').fadeIn("slow");
							$('#showpopupdata').html('Please complete all required fields');
							setTimeout(function() {  
								$('#showpopupdata').fadeOut("slow");
								$('#showpopupdata').animate({ 'color': 'red'}, "slow");
						    }, 5000);
							
						//alert('Please fill the required fields')
					}}).form() ;
			  },
			  target: '#showpopupdata',
			  success: function() {
				 
				  SaveAndClode();
				  $('#showpopupdata').animate({ 'color': '#49AC44'}, "slow");
				  $('#showpopupdata').fadeIn("slow");
				   
			  }
			});
		  });

//date and time picker
$(function() {
	plot_requirements_info(1);
	json_prop_requirments(1);
	agentsOnDemand('agent_id_lead');
	$('.datepicker').datetimepicker({
				format: 'YYYY-MM-DD'
			});
});

 $(document).ready(function(){
                $(".ltrim").numeric();
				
    });
            $(".ltrim").blur(function() {
                var str = $(this).val();
                $(this).val((ltrim(str, "0")));
            });
 function ltrim(str, chars) {
    chars = chars || "\\s";
    return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
 }
//auto complete landlord details
$(document).ready(function () {
    //$('#landlord_name').autocomplete({
//        source: "http://crm.propspace.com/index.php/contracts/autoFindLandlord",
//        minLength: 0,
//        select: function (event, ui) {
//            $('#landlord_id').val(ui.item.id);
//        }
//    }).focus(function(){
//        $(this).val('');
//        $(this).keydown();
//    });
});

function plot_requirements_info(popup_id) {
	var prop_req_data = '';
	if ($('#type').val() != 0) {
		prop_req_data = prop_req_data + $("#myForm_lead_popup #type option[value='" + $('#myForm_lead_popup #type').val() + "']").text();
	}
	if ($('#category_id').val() != 0) {
		prop_req_data = prop_req_data + ', ' + $("#category_id option[value='" + $('#category_id').val() + "']").text();
	}
	var minBed = $('#min_beds').val();
	var maxBed = $('#max_beds').val();
	
	if((minBed == null) || (minBed == 0)){
		minBed = '';
	}
	
	if((maxBed == null) || (maxBed == 0) ){
		maxBed = '';
	}

	if (minBed != '' & maxBed != '' ) {
		prop_req_data = prop_req_data + ', ' + minBed + '-' + maxBed + ' beds';
	}
	if (minBed >= 1 & maxBed == '') {
		prop_req_data = prop_req_data + ', Min ' + minBed + ' bed(s)';
	}
	if (minBed == '' & maxBed >= 1) {
		prop_req_data = prop_req_data + ', Max ' + maxBed + ' beds';
	}
	if ($('#unit_type').val() != '') {
		prop_req_data = prop_req_data + ', ' + 'Type: ' + $('#unit_type').val();
	}
	if ($('#unit_no').val() != '') {
		prop_req_data = prop_req_data + ', ' + 'Unit: ' + $('#unit_no').val();
	}
        
//        alert(prop_req_data);
	if ($('#sub_area_location_id').val() != 0) {
		prop_req_data = prop_req_data + ', ' + $("#sub_area_location_id option[value='" + $('#sub_area_location_id').val() + "']").text();
	}
	if ($('#area_location_id').val() != 0) {
		prop_req_data = prop_req_data + ', ' + $("#area_location_id option[value='" + $('#area_location_id').val() + "']").text();
	}
	if ($('#region_id').val() != 0) {
		prop_req_data = prop_req_data + ', ' + $("#region_id option[value='" + $('#region_id').val() + "']").text();
	}
	var minPrice = $('#min_budget').val();
	var maxPrice = $('#max_budget').val();
	if (minPrice >= 1 & maxPrice >= 1) {
		prop_req_data = prop_req_data + ', ' + 'Price: ' + minPrice + ' - ' + maxPrice;
	}
	if (minPrice >= 1 & maxPrice < 1) {
		prop_req_data = prop_req_data + ', ' + 'Min price: ' + minPrice;
	}
	if (minPrice < 1 & maxPrice >= 1) {
		prop_req_data = prop_req_data + ', ' + 'Max price: ' + maxPrice;
	}
	var minArea = $('#min_area').val();
	var maxArea = $('#max_areat').val();
	if (minArea >= 1 & maxArea >= 1) {
		prop_req_data = prop_req_data + ', ' + 'Size: ' + minArea + ' - ' + maxArea;
	}
	if (minArea >= 1 & maxArea < 1) {
		prop_req_data = prop_req_data + ', ' + 'Min size: ' + minArea;
	}
	if (minArea < 1 & maxArea >= 1) {
		prop_req_data = prop_req_data + ', ' + 'Max Size: ' + maxArea;
	}
	
	prop_req_data = prop_req_data.split(',');
	prop_req_data = cleanArray(prop_req_data);

	prop_req_data = prop_req_data.join(',');
	$('#property_req_' + popup_id + '_data').val(prop_req_data);
}
 function json_prop_requirments(popup_id) {
	var json_data = '';

	json_data = '{"lead_req_id":"' + $('#lead_req_id').val() + '","lead_id":"' + $('#id').val() + '","category_id":"' + $('#category_id').val() + '","region_id":"' + $('#region_id').val() + '","area_location_id":"' + $('#area_location_id').val() + '","area_location_id":"' + $('#area_location_id').val() + '","sub_area_location_id":"' + $('#sub_area_location_id').val() + '","min_beds":"' + $('#min_beds').val() + '","max_beds":"' + $('#max_beds').val() + '","min_budget":"' + $('#min_budget').val() + '","max_budget":"' + $('#max_budget').val() + '","min_area":"' + $('#min_area').val() + '","max_area":"' + $('#max_area').val() + '","unit_type":"' + $('#unit_type').val() + '","unit_no":"' + $('#unit_no').val() + '","listing_id_' + popup_id + '_ref":"' + $('#listing_id_' + popup_id + '_ref').val() + '","listing_id_' + popup_id + '":"' + $('#listing_id_' + popup_id).val() + '"}';
	$('#property_req_' + popup_id).val(json_data);
}
function cleanArray(actual){
  var newArray = new Array();
  for(var i = 0; i<actual.length; i++){
      if (actual[i] && actual[i] != " "){
        newArray.push(actual[i]);
    }
  }
  return newArray;
}

		  
</script>
<form id="myForm_lead_popup" action="<?php echo base_url();?>listings/addleadsubmit" method="post">
<div class="modal-body">
                <!--hidden variable-->
                 
                <input type="hidden" id="listings_type" name="listings_type" value="" />
                <input type="hidden" id="listings_beds" name="listings_beds" value="" />
                 <input type="hidden" id="listings_location" name="listings_location" value="" />
                  <input type="hidden" id="listings_sub_location" name="listings_sub_location" value="" />
                 <input type="hidden" id="property_req_1_data" name="property_req_1_data" value="" />
                 <input type="hidden" id="property_req_1" name="property_req_1" value="" />
                 <input type="hidden" id="min_budget" name="min_budget" value="" />
                 <input type="hidden" id="region_id" name="region_id" value="" />
                  <input type="hidden" id="min_beds" name="min_beds" value="" />
                  <input type="hidden" id="min_area" name="min_area" value="" />
                   <input type="hidden" id="unit_no" name="unit_no" value="" />
                 
               
               <!-- /*end hidden variable*/-->
               <!-- <button type="button" class="btn btn-success" data-dismiss="modal">-->
                 <button type="submit" id="SaveLeadPopup"  class="btn btn-success" name="SaveLeadPopup" value="Save Lead" >
                <i class="fa fa-check"></i> Save &amp; Close</button>
                <div class="showdata" id="showpopupdata"></div>
                <div class="row">
                <h4 class="add_new_rental">Add New Lead</h4>
                </div>
                
                <div class="row">
                
                <div class="col-md-4">
                  <div class="form-group">
                      <label>Type</label>
                 
            <select name="type" type="text"  class="form-control input-sm required" id="type"  tabindex="11">
            <option value="" selected>Select</option>
            <option value="1" >Rental inquiry</option>
            <option value="2" >Sales inquiry</option>
        </select>
                   </div>
                   <div class="form-group">
                      <label>First Name</label>
                      <input type="text" class="form-control input-sm" id="first_name" name="first_name">
                  </div>
                  <div class="form-group">
                      <label>Last Name</label>
                      <input type="text" class="form-control input-sm" id="last_name" name="last_name">
                  </div>
                  <div class="form-group">
                      <label>Mobile</label>
                     
                      <div class="input-group">
                        <select class="form-control col-md-4 input-sm 3_landlord_search phone-code-field" id="mobile_code_lead" name="mobile_code_lead">

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
 <option value="44">UK (+44)</option> 
 <option value="380">Ukraine (+380)</option> 
 <option selected="selected" value="971">United Arab Emirates (+971)</option> 
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
  						 <input type="text" class="form-control input-sm col-md-8 ltrim" id="mobile_no" name="mobile_no">
                  
                     </div>
                  </div>
                  <div class="form-group">
                      <label>Home Tel</label>
                       <div class="input-group">
                      <select class="form-control col-md-4 input-sm 3_landlord_search phone-code-field" id="phone_code_lead" name="phone_code_lead">

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
 <option value="44">UK (+44)</option> 
 <option value="380">Ukraine (+380)</option> 
 <option selected="selected" value="971">United Arab Emirates (+971)</option> 
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
                      <input type="text" class="form-control input-sm col-md-8 ltrim" id="home_no" name="home_no">
                  </div>
                </div>
                </div>
                
                
                <div class="col-md-4">
                  <div class="form-group">
                      <label>Email</label>
                      <input type="text" class="form-control input-sm" id="email" name="email">
                  </div>
                  <div class="form-group">
                       <label>Date of enquiry</label>
                       
                       <div class="input-group">
                        <input type="text" class="form-control input-sm datepicker" id="date_of_enquiry" name="date_of_enquiry">
                        <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                        </div>
                        </div>
                       
                       
                       
                      
                   </div>
                  <div class="form-group">
                      <label>Listing Ref</label>
                    
                       <input name="enquired_for_referance" type="text" class="form-control input-sm" id="enquired_for_referance" value="" tabindex="8" readonly="readonly">
            <input name="enquired_for_ref" type="text" class="form-control input-sm required" id="enquired_for_ref" value="" tabindex="8" style="display:none;" >
                  </div>
                   <div class="form-group">
                      <label>Assigned to agent</label>
               
                    <select name="agent_id" class="form-control input-sm" id="agent_id_lead" >
                      </select>
                   </div>
                  <div class="form-group">
                      <label>Property requirements</label>
                    
                       <input name="property_requirement" class="form-control input-sm" id="property_requirement" type="text" value='' readonly>
                          <input id="features_id" name="features_id" type="text" readonly="readonly" value="" hidden="hidden"/>
                  </div>
                </div>
                
                
                
                <div class="col-md-4">
                <div class="form-group">
                      <label>Source of lead</label>
                  
                     <select name="source_of_lead" type="text"  class="form-control input-sm required" id="source_of_lead"  tabindex="11">
            <option value="" selected>Select</option>
            <option value="Bayut.com" >Bayut.com</option>
            <option value="Cold call" >Cold call</option>
            <option value="Website" >Company website</option>
            <option value="Direct call" >Direct call</option>
            <option value="Dubizzle.com" >Dubizzle.com</option>
            <option value="Email campaign" >Email campaign</option>
            <option value="JustProperty.com" >JustProperty.com</option>
            <option value="JustRentals.com" >JustRentals.com</option>
            <option value="Newspaper advert" >Newspaper advert</option>
            <option value="Other portal" >Other portal</option>
            <option value="Propertyfinder.ae" >Propertyfinder.ae</option>
            <option value="Referral within company" >Referral within company</option>
            <option value="SMS campaign" >SMS campaign</option>
            <option value="Walk-in" >Walk-in</option>
            <option value="Other" >Other</option>
          </select>
           <input style="width:93px;" type="text" class="form_fields" name="other_source_of_lead" id="other_source_of_lead" hidden>
          
          <select style="display:none; width:100px;" name="reffered_by_agent" class="form_select_fields required" id="reffered_by_agent">
            <option value="0" selected>Select</option>
                                <option value="871">Ahmed Abdelaziz</option>
                                <option value="897">Diana Orynabassarova</option>
                                <option value="1227">Dmitrii Kislitcyn</option>
                                <option value="887">Elena Timchenko</option>
                                <option value="888">Emilia Dimitrova</option>
                                <option value="889">Farida Khudaykulova</option>
                                <option value="890">Firdavs Kadamaliev</option>
                                <option value="891">Inna Daurova</option>
                                <option value="872">Khalil Ahmad</option>
                                <option value="1089">Larisa Petina</option>
                                <option value="772">Mahmoud Khalil</option>
                                <option value="1228">Minavat Abdyrasulova</option>
                                <option value="894">Mohammed Al Hashim</option>
                                <option value="1091">Oleg Nikitenko</option>
                                <option value="870">Royal Home</option>
                                <option value="1112">Sanya Beranovic</option>
                                <option value="895">Sasha Toleski</option>
                                <option value="1088">Tsvety Borisova</option>
                                <option value="1090">Valentina Zhangorazova</option>
                                <option value="886">Victoria Antonova</option>
                                <option value="1272">victoria sivitskaya</option>
                                <option value="896">Virginia Dobrovolskyte</option>
                                <option value="898">Yelena Mirkina</option>
                                <option value="1229">Zarina Baitursynova</option>
                            </select>
                   </div>
                 <div class="form-group">
                      <label>Status</label>
                  
                     <select name="status" type="text"  class="form-control input-sm" id="status">
                          <option value="" selected="selected">Select</option>
                          <option value="1" >Open</option>
                           <option value="2" >Closed</option>
                           <option value="3" selected>Not Specified</option>
            </select>
                   </div>
                      <div class="form-group">
                      <label>Sub-Status</label>
                   <select name="sub_status" id="sub_status" class=" form-control required input-sm" required>
	                    <option value="4" >Not yet contacted</option>
                                        <option value="5" >Called no reply</option>
                                        <option value="6" >Follow up</option>
                                        <option value="10">Needs more info</option>
                                        <option value="9" >Offer Made</option>
                                        <option value="7" >Viewing arranged</option>
                                        <option value="17">Look-see</option>
                                        <option value="11">Budget differs</option>
                                        <option value="12">Needs time</option>
                                        <option value="13">Client to revert</option>
                                        <option value="14">Interested</option>
                                        <option value="15">Interested to Meet</option>
                                        <option value="2" >Successful</option>
                                        <option value="1" >In progress</option>
                                        <option value="3" >Unsuccessful</option>
                                        <option value="16">Not Interested</option>
                                        <option value="8" selected>Not Specified</option>
	                    </select>
                   
                   </div>
                  <div class="form-group">
                      <label>Notes</label>
                 
                      <input  class="form-control input-sm" name="notes" id="notes" cols="30" rows="4" tabindex=13>
                  </div>
                 
                </div>
                
                
                </div>
                </div>
  </form>              