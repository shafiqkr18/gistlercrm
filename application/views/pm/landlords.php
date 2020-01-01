
<script src="<?php echo site_url();?>js_module/PM/pm_common.js"></script>    
<script src="<?php echo site_url();?>js_module/PM/pm_landlords.js"></script>
<script src="<?php echo site_url();?>js_module/common.js"></script>
<script src="<?php echo site_url();?>js_module/Reports/sol.js"></script>

  <body class="pmlandlords">
  <div id="wrapper">
    <div class="container">
      <!-- Page Heading -->
      <div class="row">
        <div class="col-md-10">
          <div class="page_head_area">
            <h1><i class="fa fa fa-home"></i> Property Management - Landlords  </h1>
          </div>
        </div>
      </div>
      <div class="row">
        <!-- Tab content -->
        <div class="tab-content tab-white">
          <div class="row">
            <div class="col-lg-12">
              <button type="button" id="newLandlord" data-toggle="modal" data-target="#landlordModal" class="btn btn-lg btn-primary"><i class="fa fa-plus-circle"></i> Add Landlord</button>
              <button style="display:none;" type="button" id="editLandlord" data-toggle="modal" data-target="#landlordModal" class="btn btn-lg btn-warning"><i class="fa fa-plus-circle"></i>Edit Landlord</button>
              <button style="display:none;" type="button" id="cancelLandlord" class="btn btn-lg btn-default"><i class="fa fa-plus-circle"></i> Cancel</button>
            </div>
          </div>
          <div class="row">
            <h4 class="add_new_rental">Property Management - Landlords</h4> </div>
          <div class="row fadeInUp">
            <div class="col-md-3">
              <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-home"></i> Landlord Details
                  <div class="panel-option">
                    <span class="pull-right clickable">
                        <i class="glyphicon glyphicon-chevron-up"></i>
                      </span>
                  </div>
                </div>
                <div id="divLandlordDetails" class="panel-body pmp-samehieght">
                  <div class="form-group">
                    <label>Ref</label>
                    <input type="text" class="form-control input-sm" readonly="" id="ref" name="ref">
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                          <label>Salutation</label>
                          <select class="form-control required input-sm" id="salutation" name="salutation">
                            <option value="">Select</option>
                            <option value="1">Mr.</option>
                            <option value="2">Ms.</option>
                            <option value="3">Mrs.</option>
                          </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Title</label>
                          <select class="form-control required input-sm" id="title" name="title">
                            <option value="">Select</option>
                            <option value="1">Sheikh</option>
                            <option value="2">Engr.</option>
                            <option value="3">Dr.</option>
                          </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>First Name</label>
                    <input type="text" class="form-control input-sm" id="firstname" name="firstname">
                  </div>
                  <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" class="form-control input-sm" id="lastname" name="lastname">
                  </div>
                  <div class="form-group">
                    <label>Nationality</label>
                    <input type="text" class="form-control input-sm" id="nationality" name="nationality">
                  </div>
                  <div class="form-group">
                    <label>DOB</label>
                    <div class="input-group">
                      <input type="text" class="form-control input-sm datepicker" id="dob" name="dob">
                      <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                    </div>
                  </div>
                  <div id="mob1" class="form-group">
                    <label>Mobile Number (Primary)</label>
                    <input type="text" class="form-control input-sm" id="mobilenumber1" name="mobilenumber1">

                  </div>
                  <div id="mob2" class="form-group">
                    <label>Mobile Number (Secondary)</label>
                    <input type="text" class="form-control input-sm" id="mobilenumber2" name="mobilenumber2">

                  </div>
                  <div id="mob3" class="form-group">
                    <label>Home Number</label>
                    <input type="text" class="form-control input-sm" id="mobilenumber3" name="mobilenumber3">

                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control input-sm" id="email" name="email"> </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="panel panel-default" style="height:150px">
                <div class="panel-heading"><i class="fa fa-group"></i> Leased Units
                    <div class="panel-option"> 
                        <span class="pull-right clickable">
                            <i class="glyphicon glyphicon-chevron-up"></i>
                        </span> 
                    </div>
                </div>
                <div class="panel-body tab-nopadding pmp-samehieght"><!--  <span class="text-info">come here!</span>  -->
                  <div id="divUnitHeader" class="tab-nopadding">
                    <span class="text-warning">No Unit</span>
                    <div id="divUnitDetails" style="display:none">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <td>Ref</td>
                            <td>Unit No.</td>      
                            <td>View</td>      
                          </tr>
                        </thead>
                        <tbody>
                              
                        </tbody>
                      </table>
                    </div>                        
                  </div>
                </div>
              </div>
              <div class="panel panel-default" style="height:220px">
                <div class="panel-heading"><i class="fa fa-dollar"></i> Accounts
                  <div class="panel-option"> <span class="pull-right clickable">
                              <i class="glyphicon glyphicon-chevron-up"></i>
                            </span> </div>
                </div>
                <div class="panel-body tab-nopadding">
                  <div class="panel panel-default gist-formsmartpanel gist-leasetabs" style="height: 170px">
                    <div class="panel-heading panel-gistab gist-contab">
                      <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tabAll" aria-controls="tabAll" role="tab" data-toggle="tab">All</a> </li>
                        <li role="presentation"><a href="#tabPending" aria-controls="tabPending" role="tab" data-toggle="tab">Pending</a> </li>
                        <li role="presentation"><a href="#tabPaid" aria-controls="tabPaid" role="tab" data-toggle="tab">Paid</a> </li>
                      </ul>
                    </div>
                    <div id="divAccounts" class="panel-body">  <!-- style="padding: 0px; overflow-x:visible; position: relative; width: 260px;height: 280px" -->
                      <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="tabAll">
                          <div class="gist-showmeonclick allcontent"> 
                            <div id="divAllTransactions" style="display:none; overflow: auto; overflow-x:visible;">
                              <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <td>Ref</td>
                                    <td>Unit No.</td>      
                                    <td>Transaction Type</td>      
                                    <td>Type</td>      
                                    <td>Sub-Type</td>      
                                    <td>Amount</td>      
                                  </tr>
                                </thead>
                                <tbody>
                                      
                                </tbody>
                              </table>
                            </div>   
                          </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tabPending">
                          <div class="gist-showmeonclick pendingcontent">
                            <div id="divPendingTransactions" style="display:none; overflow: auto; overflow-x:visible;">
                              <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <td>Ref</td>
                                    <td>Unit No.</td>      
                                    <td>Transaction Type</td>      
                                    <td>Type</td>      
                                    <td>Sub-Type</td>      
                                    <td>Amount</td>      
                                  </tr>
                                </thead>
                                <tbody>
                                      
                                </tbody>
                              </table>
                            </div>   
                         </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tabPaid">
                          <div class="gist-showmeonclick paidcontent">
                            <div id="divPaidTransactions" style="display:none; overflow: auto; overflow-x:visible;">
                              <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <td>Ref</td>
                                    <td>Unit No.</td>      
                                    <td>Transaction Type</td>      
                                    <td>Type</td>      
                                    <td>Sub-Type</td>      
                                    <td>Amount</td>      
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
                </div>
              </div>              
            </div>
            <div class="col-md-3">
              <div class="panel panel-default ">
                <div class="panel-heading panel-gistab tab-nopadding">
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#recentview" aria-controls="recentview" role="tab" data-toggle="tab">Notes</a> </li>
                    <li role="presentation"><a href="#recentsaved" aria-controls="recentsaved" role="tab" data-toggle="tab">Documents</a> </li>
                  </ul>
                </div>
                <div class="panel-body tab-nopadding pmp-samehieght">
                  <div class="tab-content tab-nopadding">
                    <div role="tabpanel" class="tab-pane active" id="tabNotes">
                      <div class="input-group">
                        <input type="text" placeholder="Enter Notes" id="txtNote" class="form-control input-sm">
                        <div class="input-group-addon" style="background-color: cornflowerblue;">
                          <button id="btnSaveNote" style="background-color: cornflowerblue;color: white"><i class="fa fa-save"></i></button>
                        </div>
                      </div>
                      <div id="divNoteContent" class="form-group" style="overflow: auto; overflow-x: hidden;padding-left: 10px;padding-top: 10px">

                      </div>


                    </div>
                    <div role="tabpanel" class="tab-pane" id="tabDocuments">



                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Rental Form End -->
        </div>
      </div>
      <div class="row fadeInUp">
        <div class="inner_tab_nav">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#">All Landlords <span id="cntAll" class="text-info">(<?php echo $all;?>)</span></a></li>
          </ul>
        </div>
        <div class="tab-content tab-white"> 
            <div style="Save Report"> <input style="width:300px" 
                class="form-control input-sm search_init" type='text' id='txtSmartSearch_Accounts' 
                placeholder="Search here"/> 
            </div>            
            <table id="tblLandlords" aria-describedby="dataTables-current-listing_info" class="table table-striped table-hover datatables datatable-setbotclass dataTable no-footer">
            <thead class="listing_headings">
              <tr>
                  <th><!-- <label class=""><input id='CheckAllListings' class='CheckAll' onclick="toggleChecked()" type="checkbox" value=''>
                    <span class="lbl"></span></label> -->
                  </th>
                  <th>
                    <div style="cursor:pointer;min-width:50px;" title="Click here to sort">
                      Ref
                    </div>
                  </th> 
                  <th>
                    <div style="cursor:pointer;" title="Click here to sort">
                      First Name
                    </div>
                  </th>
                  <th>
                    <div style="cursor:pointer;" title="Click here to sort">
                      Last Name
                    </div>
                  </th>                                                                               
                  <th>
                    <div style="cursor:pointer;" title="Click here to sort">
                      Mobile Number
                    </div>
                  </th>
                  <th>
                    <div style="cursor:pointer;" title="Click here to sort">
                      DOB
                    </div>
                  </th>
                  <th>
                    <div style="cursor:pointer;" title="Click here to sort">
                      Email
                    </div>
                  </th>
                  <th>
                    <div style="cursor:pointer; white-space:nowrap;" title="Click here to sort">
                      Nationality
                    </div>
                  </th>
                  <th>
                    <div style="cursor:pointer;" title="Click here to sort">
                      Date Added
                    </div>
                  </th>
                  <th>
                    <div style="cursor:pointer;" title="Click here to sort">
                      Date Updated
                    </div>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="dataTables_empty" colspan="6">
                    Loading data from server
                  </td>
                </tr>
              </tbody>                      
            </table>            
        </div>
      </div>
    </div>
  </div>
  <!-- container end -->
  </div>
  <!-- wrapper end -->

  <!-- Landlord Modal -->
  <div class="modal fade" id="landlordModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <label id="modaltitle">
            <h4 class="modal-title">Add Landlord Information</h4>
          </label>
        </div>
        <div class="modal-body">
          <div class="tab-content tab-nopadding">
            <div role="tabpanel" class="tab-pane active" id="addnewunit">
              <form id="frm_landlord">
                <input type="hidden" id="id" name="id" value="0" />
                <input type="hidden" id="rand_key" name="rand_key" value="" />
                <input type="hidden" id="ref" name="ref" value="" />
                <input type="hidden" id="dateadded" name="dateadded" value="" />
                <input type="hidden" id="created_by" name="created_by" value="" />
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Ref</label>
                      <input type="text" class="form-control input-sm" readonly="" id="ref" name="ref">
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Salutation</label>
                          <select class="form-control required input-sm" id="salutation" name="salutation">
                            <option value="">Select</option>
                            <option value="1">Mr.</option>
                            <option value="2">Ms.</option>
                            <option value="3">Mrs.</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Title</label>
                          <select class="form-control required input-sm" id="title" name="title">
                            <option value="">Select</option>
                            <option value="1">Sheikh</option>
                            <option value="2">Engr.</option>
                            <option value="3">Dr.</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>First Name</label>
                      <input type="text" class="form-control input-sm" id="firstname" name="firstname">
                    </div>
                    <div class="form-group">
                      <label>Last Name</label>
                      <input type="text" class="form-control input-sm" id="lastname" name="lastname">
                    </div>
                    <div class="form-group">
                      <label>Nationality</label>
                      <select required="" class="form-control required input-sm" id="nationality" name="nationality">
                        <option value="">Please select</option>
                        <option value="" selected="selected">Select Nationality</option>
                        <option value="Afghanistan">Afghanistan</option>
                        <option value="Albania">Albania</option>
                        <option value="Algeria">Algeria</option>
                        <option value="American Samoa">American Samoa</option>
                        <option value="Andorra">Andorra</option>
                        <option value="Angola">Angola</option>
                        <option value="Anguilla">Anguilla</option>
                        <option value="Antarctica">Antarctica</option>
                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Armenia">Armenia</option>
                        <option value="Aruba">Aruba</option>
                        <option value="Australia">Australia</option>
                        <option value="Austria">Austria</option>
                        <option value="Azerbaijan">Azerbaijan</option>
                        <option value="Bahamas">Bahamas</option>
                        <option value="Bahrain">Bahrain</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Barbados">Barbados</option>
                        <option value="Belarus">Belarus</option>
                        <option value="Belgium">Belgium</option>
                        <option value="Belize">Belize</option>
                        <option value="Benin">Benin</option>
                        <option value="Bermuda">Bermuda</option>
                        <option value="Bhutan">Bhutan</option>
                        <option value="Bolivia">Bolivia</option>
                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                        <option value="Botswana">Botswana</option>
                        <option value="Bouvet Island">Bouvet Island</option>
                        <option value="Brazil">Brazil</option>
                        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                        <option value="Bulgaria">Bulgaria</option>
                        <option value="Burkina Faso">Burkina Faso</option>
                        <option value="Burundi">Burundi</option>
                        <option value="Cambodia">Cambodia</option>
                        <option value="Cameroon">Cameroon</option>
                        <option value="Canada">Canada</option>
                        <option value="Cape Verde">Cape Verde</option>
                        <option value="Cayman Islands">Cayman Islands</option>
                        <option value="Central African Republic">Central African Republic</option>
                        <option value="Chad">Chad</option>
                        <option value="Chile">Chile</option>
                        <option value="China">China</option>
                        <option value="Christmas Island">Christmas Island</option>
                        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                        <option value="Colombia">Colombia</option>
                        <option value="Comoros">Comoros</option>
                        <option value="Congo">Congo</option>
                        <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                        <option value="Cook Islands">Cook Islands</option>
                        <option value="Costa Rica">Costa Rica</option>
                        <option value="Cote D'ivoire">Cote D'ivoire</option>
                        <option value="Croatia">Croatia</option>
                        <option value="Cuba">Cuba</option>
                        <option value="Cyprus">Cyprus</option>
                        <option value="Czech Republic">Czech Republic</option>
                        <option value="Denmark">Denmark</option>
                        <option value="Djibouti">Djibouti</option>
                        <option value="Dominica">Dominica</option>
                        <option value="Dominican Republic">Dominican Republic</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="Egypt">Egypt</option>
                        <option value="El Salvador">El Salvador</option>
                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                        <option value="Eritrea">Eritrea</option>
                        <option value="Estonia">Estonia</option>
                        <option value="Ethiopia">Ethiopia</option>
                        <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                        <option value="Faroe Islands">Faroe Islands</option>
                        <option value="Fiji">Fiji</option>
                        <option value="Finland">Finland</option>
                        <option value="France">France</option>
                        <option value="French Guiana">French Guiana</option>
                        <option value="French Polynesia">French Polynesia</option>
                        <option value="French Southern Territories">French Southern Territories</option>
                        <option value="Gabon">Gabon</option>
                        <option value="Gambia">Gambia</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Germany">Germany</option>
                        <option value="Ghana">Ghana</option>
                        <option value="Gibraltar">Gibraltar</option>
                        <option value="Greece">Greece</option>
                        <option value="Greenland">Greenland</option>
                        <option value="Grenada">Grenada</option>
                        <option value="Guadeloupe">Guadeloupe</option>
                        <option value="Guam">Guam</option>
                        <option value="Guatemala">Guatemala</option>
                        <option value="Guinea">Guinea</option>
                        <option value="Guinea-bissau">Guinea-bissau</option>
                        <option value="Guyana">Guyana</option>
                        <option value="Haiti">Haiti</option>
                        <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                        <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                        <option value="Honduras">Honduras</option>
                        <option value="Hong Kong">Hong Kong</option>
                        <option value="Hungary">Hungary</option>
                        <option value="Iceland">Iceland</option>
                        <option value="India">India</option>
                        <option value="Indonesia">Indonesia</option>
                        <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                        <option value="Iraq">Iraq</option>
                        <option value="Ireland">Ireland</option>
                        <option value="Israel">Israel</option>
                        <option value="Italy">Italy</option>
                        <option value="Jamaica">Jamaica</option>
                        <option value="Japan">Japan</option>
                        <option value="Jordan">Jordan</option>
                        <option value="Kazakhstan">Kazakhstan</option>
                        <option value="Kenya">Kenya</option>
                        <option value="Kiribati">Kiribati</option>
                        <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                        <option value="Korea, Republic of">Korea, Republic of</option>
                        <option value="Kuwait">Kuwait</option>
                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                        <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                        <option value="Latvia">Latvia</option>
                        <option value="Lebanon">Lebanon</option>
                        <option value="Lesotho">Lesotho</option>
                        <option value="Liberia">Liberia</option>
                        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                        <option value="Liechtenstein">Liechtenstein</option>
                        <option value="Lithuania">Lithuania</option>
                        <option value="Luxembourg">Luxembourg</option>
                        <option value="Macao">Macao</option>
                        <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                        <option value="Madagascar">Madagascar</option>
                        <option value="Malawi">Malawi</option>
                        <option value="Malaysia">Malaysia</option>
                        <option value="Maldives">Maldives</option>
                        <option value="Mali">Mali</option>
                        <option value="Malta">Malta</option>
                        <option value="Marshall Islands">Marshall Islands</option>
                        <option value="Martinique">Martinique</option>
                        <option value="Mauritania">Mauritania</option>
                        <option value="Mauritius">Mauritius</option>
                        <option value="Mayotte">Mayotte</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                        <option value="Moldova, Republic of">Moldova, Republic of</option>
                        <option value="Monaco">Monaco</option>
                        <option value="Mongolia">Mongolia</option>
                        <option value="Montserrat">Montserrat</option>
                        <option value="Morocco">Morocco</option>
                        <option value="Mozambique">Mozambique</option>
                        <option value="Myanmar">Myanmar</option>
                        <option value="Namibia">Namibia</option>
                        <option value="Nauru">Nauru</option>
                        <option value="Nepal">Nepal</option>
                        <option value="Netherlands">Netherlands</option>
                        <option value="Netherlands Antilles">Netherlands Antilles</option>
                        <option value="New Caledonia">New Caledonia</option>
                        <option value="New Zealand">New Zealand</option>
                        <option value="Nicaragua">Nicaragua</option>
                        <option value="Niger">Niger</option>
                        <option value="Nigeria">Nigeria</option>
                        <option value="Niue">Niue</option>
                        <option value="Norfolk Island">Norfolk Island</option>
                        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                        <option value="Norway">Norway</option>
                        <option value="Oman">Oman</option>
                        <option value="Pakistan">Pakistan</option>
                        <option value="Palau">Palau</option>
                        <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                        <option value="Panama">Panama</option>
                        <option value="Papua New Guinea">Papua New Guinea</option>
                        <option value="Paraguay">Paraguay</option>
                        <option value="Peru">Peru</option>
                        <option value="Philippines">Philippines</option>
                        <option value="Pitcairn">Pitcairn</option>
                        <option value="Poland">Poland</option>
                        <option value="Portugal">Portugal</option>
                        <option value="Puerto Rico">Puerto Rico</option>
                        <option value="Qatar">Qatar</option>
                        <option value="Reunion">Reunion</option>
                        <option value="Romania">Romania</option>
                        <option value="Russian Federation">Russian Federation</option>
                        <option value="Rwanda">Rwanda</option>
                        <option value="Saint Helena">Saint Helena</option>
                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                        <option value="Saint Lucia">Saint Lucia</option>
                        <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                        <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                        <option value="Samoa">Samoa</option>
                        <option value="San Marino">San Marino</option>
                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                        <option value="Saudi Arabia">Saudi Arabia</option>
                        <option value="Senegal">Senegal</option>
                        <option value="Serbia and Montenegro">Serbia and Montenegro</option>
                        <option value="Seychelles">Seychelles</option>
                        <option value="Sierra Leone">Sierra Leone</option>
                        <option value="Singapore">Singapore</option>
                        <option value="Slovakia">Slovakia</option>
                        <option value="Slovenia">Slovenia</option>
                        <option value="Solomon Islands">Solomon Islands</option>
                        <option value="Somalia">Somalia</option>
                        <option value="South Africa">South Africa</option>
                        <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                        <option value="Spain">Spain</option>
                        <option value="Sri Lanka">Sri Lanka</option>
                        <option value="Sudan">Sudan</option>
                        <option value="Suriname">Suriname</option>
                        <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                        <option value="Swaziland">Swaziland</option>
                        <option value="Sweden">Sweden</option>
                        <option value="Switzerland">Switzerland</option>
                        <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                        <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                        <option value="Tajikistan">Tajikistan</option>
                        <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Timor-leste">Timor-leste</option>
                        <option value="Togo">Togo</option>
                        <option value="Tokelau">Tokelau</option>
                        <option value="Tonga">Tonga</option>
                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                        <option value="Tunisia">Tunisia</option>
                        <option value="Turkey">Turkey</option>
                        <option value="Turkmenistan">Turkmenistan</option>
                        <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                        <option value="Tuvalu">Tuvalu</option>
                        <option value="Uganda">Uganda</option>
                        <option value="Ukraine">Ukraine</option>
                        <option value="United Arab Emirates">United Arab Emirates</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="United States">United States</option>
                        <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                        <option value="Uruguay">Uruguay</option>
                        <option value="Uzbekistan">Uzbekistan</option>
                        <option value="Vanuatu">Vanuatu</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="Viet Nam">Viet Nam</option>
                        <option value="Virgin Islands, British">Virgin Islands, British</option>
                        <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                        <option value="Wallis and Futuna">Wallis and Futuna</option>
                        <option value="Western Sahara">Western Sahara</option>
                        <option value="Yemen">Yemen</option>
                        <option value="Zambia">Zambia</option>
                        <option value="Zimbabwe">Zimbabwe</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>DOB</label>
                        <div class="input-group">
                            <input type="text" class="form-control input-sm datepicker" id="dob" name="dob">
                            <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                        </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-6">
                          <label>Mobile Number (Primary)</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3">
                          <select class="form-control required input-sm" id="countrycode1" name="countrycode1">
                            <option>Select</option>
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
                        <div class="col-md-9">
                          <input type="text" class="form-control input-sm" placeholder="mobile number" id="mobilenumber1" name="mobilenumber1">
                        </div>
                      </div> 
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-6">
                          <label>Mobile Number (Secondary)</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3">
                          <select class="form-control required input-sm" id="countrycode2" name="countrycode2">
                            <option>Select</option>
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
                        <div class="col-md-9">
                          <input type="text" class="form-control input-sm" placeholder="mobile number" id="mobilenumber2" name="mobilenumber2">
                        </div>
                      </div> 
                    </div>                
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-4">
                          <label>Home Number</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3">
                          <select class="form-control required input-sm" id="countrycode3" name="countrycode3">
                            <option>Select</option>
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
                        <div class="col-md-9">
                          <input type="text" class="form-control input-sm" placeholder="home number" id="mobilenumber3" name="mobilenumber3">
                        </div>
                      </div> 
                    </div>
                    <div class="form-group">
                      <label>Email</label>
                      <input type="text" class="form-control input-sm" id="email" name="email">
                    </div>
                <div class="clear"></div>
                <!-- to fix overflow issue -->
              </form>
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal" id="btnSaveLandlord"><i class="fa fa-check"></i> Save and Close</button>
        </div>
      </div>
    </div>
  </div>
