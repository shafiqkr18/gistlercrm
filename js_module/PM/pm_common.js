var _lease = {};
var _contact = {};
var _account = {};
var _workorder = {};
var _servicesprovider = {};

//_lease
_lease["paymentmode"]={
  1: "Cash",
  2: "Bank Transfer",
  3: "Cheque",
  4: "Others",
};
_lease["depositheldby"]={
  1: "Landlord",
  2: "Property Management"
};
_lease["ejaristatus"]={
  1: "Active",
  2: "Inactive"
};
_lease["paymentterm"]={
  1: "Semi-Annually",
  2: "Annually"
};
_lease["sourceoftenancy"]={
  1: "Landlord",
  2: "Tenant"
};
_lease["reminder"]={
  1:"Same Day",
  2:"Day Before",
  3:"Three Days",
  4:"One Week",
  5:"Fifteen Days",
  6:"One Month",
  7:"Two Month",
  8:"Three Month"
};

//_contact
_contact["title"] = {
  1: "Sheikh",
  2: "Engr.",
  3: "Dr."
};
_contact["salutation"] = {
  1: "Mr.",
  2: "Ms.",
  3: "Mrs."
};
_contact["nationality"] = {};
_contact["countrycode"] = {};

//_servicesprovider
_servicesprovider["type"] = {
  1: "Maintenance",
  2: "Pest Control",
  3: "Interior Decoration",
  4: "Landscaping"
};

_servicesprovider["subtype"] = {
  1: {
    1: "Electrical",
    2: "Plumbing",
    3: "Painting",
    4: "Airconditioning"
  },
  2: {
    1: "Rodent Removal",
    2: "Bedbugs Removal",
    3: "Pesticidal Services",
    4: "Termite Removal",
  },
  3: {
    1: "Consultation",
    2: "Remodeling",
    3: "Room Review"
  },
  4: {
    1: "Consultation",
    2: "Hardscaping and Construction",
    3: "Landscape Maintenance",
    4: "Design Services"
  }
};

_servicesprovider["maintenance"] = {
  1: "Electrical",
  2: "Plumbing",
  3: "Painting",
  4: "Airconditioning"
};
_servicesprovider["pestcontrol"] = {
  1: "Rodent Removal",
  2: "Bedbugs Removal",
  3: "Pesticidal Services",
  4: "Termite Removal",
};
_servicesprovider["interiordecoration"] = {
  1: "Consultation",
  2: "Remodeling",
  3: "Room Review"
};
_servicesprovider["landscaping"] = {
  1: "Consultation",
  2: "Hardscaping and Construction",
  3: "Landscape Maintenance",
  4: "Design Services"
};

//_account
_account["transactiontype"] = {
  1: "Payment In",
  2: "Payment Out"
};
_account["type"] = {
  1: "Unit",
  2: "Lease",
  3: "Work Order"
};
_account["subtype"] = {};

_account["from"] = {
  1: "Property Management",
  2: "Landlord",
  3: "Tenant",
  4: "Service Provider"
};
_account["to"] = {
  1: "Property Management",
  2: "Landlord",
  3: "Tenant",
  4: "Service Provider"
};
_account["mode"] = {
  1: "Cash",
  2: "Bank Transfer",
  3: "Cheque",
  4: "Others"
};
_account["status"] = {
  1:"Paid",
  2:"Due"
};
_account["paymentterm"] = {
  1: "Semi-Annually",
  2: "Annually"
};
_account["ejaristatus"] = {
  1:"Active",
  2:"Inactive"
};


//workorders
_workorder["type"] = {
  1: "Maintenance",
  2: "Pest Control",
  3: "Interior Decoration",
  4: "Landscaping"
};
_workorder["subtype"] = {
  1: {
    1: "Electrical",
    2: "Plumbing",
    3: "Painting",
    4: "Airconditioning"
  },
  2: {
    1: "Rodent Removal",
    2: "Bedbugs Removal",
    3: "Pesticidal Services",
    4: "Termite Removal",
  },
  3: {
    1: "Consultation",
    2: "Remodeling",
    3: "Room Review"
  },
  4: {
    1: "Consultation",
    2: "Hardscaping and Construction",
    3: "Landscape Maintenance",
    4: "Design Services"
  }
};
_workorder["status"] = {
  1: "Scheduled",
  2: "Not Scheduled",
  3: "In Progress",
  4: "Completed",
};
_workorder["paidby"] = {
  1: "Landlord",
  2: "Tenant",
  3: "Property Management"
};
_workorder["paymentstatus"] = {
  1: "Not Paid",
  2: "Paid By Cash",
  3: "Paid By Cheque",
  4: "Partly Paid"
};
_workorder["priority"] = {
  1: "Low",
  2: "Medium",
  3: "High"
};


function GetHeaderCounts(module){

  if(module == "pmunits") 
    GetUnitsHeaderCounts();

  else if(module == "pmleases") 
    GetLeasesHeaderCounts();

  else if(module == "pmworkorders") 
    GetWorkOrdersHeaderCounts();

  else if(module == "pmaccounts") 
    GetAccountsHeaderCounts

  else if(module == "pmlandlords") 
    GetLandlordsHeaderCounts();

  else if(module == "pmtenants") 
    GetTenantsHeaderCounts();

  else if(module == "pmserviceproviders") 
    GetServiceProvidersHeaderCounts();
}

function GetUnitsHeaderCounts(){
  $.ajax({
    type: "POST",
    url: mainurl + "PM_Common/GetUnitsHeaderCounts",
    datatype: "html",
    success: function(result) {
      $("#cntAll").text("("+result["AllCount"]+")");
      $("#cntAvailable").text("("+result["AvailableCount"]+")");
      $("#cntRented").text("("+result["RentedCount"]+")");
    }
  });
}

function GetLeasesHeaderCounts(){
  $.ajax({
    type: "POST",
    url: mainurl + "PM_Common/GetLeasesHeaderCounts",
    datatype: "html",
    success: function(result) {
        $("#cntAll").text("("+result["AllCount"]+")");
        $("#cntExpiring").text("("+result["ExpiringCount"]+")");
    }
  });
}

function GetLandlordsHeaderCounts(){
  $.ajax({
    type: "POST",
    url: mainurl + "PM_Common/GetLandlordsHeaderCounts",
    datatype: "html",
    success: function(result) {
        $("#cntAll").text("("+result["AllCount"]+")");
    }
  });
}

function GetTenantsHeaderCounts(){
  $.ajax({
    type: "POST",
    url: mainurl + "PM_Common/GetTenantsHeaderCounts",
    datatype: "html",
    success: function(result) {
        $("#cntAll").text("("+result["AllCount"]+")");
    }
  });
}

function GetServiceProvidersHeaderCounts(){
  $.ajax({
    type: "POST",
    url: mainurl + "PM_Common/GetServiceProvidersHeaderCounts",
    datatype: "html",
    success: function(result) {
        $("#cntAll").text("("+result["AllCount"]+")");
    }
  });
}

function GetAccountsHeaderCounts(){
  $.ajax({
    type: "POST",
    url: mainurl + "PM_Common/GetAccountsHeaderCounts",
    datatype: "html",
    success: function(result) {
        $("#cntAll").text("("+result["AllCount"]+")");
        $("#cntIn").text("("+result["PaymentInCount"]+")");
        $("#cntOut").text("("+result["PaymentOutCount"]+")");
    }
  });
}

function GetWorkOrdersHeaderCounts(){
  $.ajax({
    type: "POST",
    url: mainurl + "PM_Common/GetWorkOrdersHeaderCounts",
    datatype: "html",
    success: function(result) {
        $("#cntAll").text("("+result["AllCount"]+")");
        $("#cntInProgress").text("("+result["InProgressCount"]+")");
        $("#cntCompleted").text("("+result["CompletedCount"]+")");
    }
  });
}

function GetLeases(unitId){
  console.log("getleases-->" + unitId)
  if($.fn.DataTable.isDataTable('[id=tblLeases]'))
    $('[id=tblLeases]').DataTable().destroy();
  
    var last_id = '';
    oUnitsTable = $('[id=tblLeases]').DataTable({
        "bProcessing": true,
        "dom": '<"top"f>rt<"bottom"ilp><"clear">',
        "aoColumnDefs": [
            {
                'render': function(data, type, full, meta)
                {
                    //check the main check box
                    //$('#check_all_checkboxes').attr('checked', false);
                    return '<div style="text-align:center;"><input style="align:center;" type="radio" name="listing" value="' + data + '">  <span class="lbl"></span></div>';
                },
                "aTargets": [0],
                "bSortable": false
            }
            // ,s{
            //     "aTargets": [1],
            //     'render': function(data, type, full, meta){
            //         return (data == 1)?"Rent":"Sale";
            //     }
            // }
        ]
        ,"iDisplayLength": 25,
        // "bServerSide": true,
        "sAjaxSource": config.siteUrl + "PM_Common/GetLeases?unitId=" + unitId ,
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        'fnServerData': function(url, data, callback) {
            //data.type = $("#rgroup_listingtype input[type=radio]:checked").val();

            $.ajax({
                "dataType": 'json',
                "type": "POST",
                "url": config.siteUrl + "PM_Common/GetLeases?unitId=" + unitId ,
                "data": data,
                "success": function(json) {
                    callback(json);
                    // updateUserStatusPanel();;
                    if (last_id > 0) {
                        // $('#tblLeases #'+last_id+' td').addClass('yellowCSS');
                    }
                }
            });
        }
    });

    // $('.datatable-setbotclass').next().addClass('fixedpagination-bottom');

    $('#txtSmartSearch_leases').on( 'keyup', function () {
      oUnitsTable.search( this.value ).draw();
    });
}

function GetWorkOrders(unitId) {
  if($.fn.DataTable.isDataTable('[id=tblWorkOrders]'))
    $('[id=tblWorkOrders]').DataTable().destroy();

    var last_id = '';
    oWorkOrdersTable = $('[id=tblWorkOrders]').DataTable({
      "bProcessing": true,
      "dom": '<"top"f>rt<"bottom"ilp><"clear">',
      "aoColumnDefs": [{
        'render': function(data, type, full, meta) {
          //check the main check box
          //$('#check_all_checkboxes').attr('checked', false);
          return '<div style="text-align:center;"><input style="align:center;" type="radio" name="listing" value="' + data + '">  <span class="lbl"></span></div>';
        },
        "aTargets": [0],
        "bSortable": false
      }, 
      // {
      //   //Status
      //   "aTargets": [2],
      //   'render': function(data, type, full, meta) {
      //     // alert(data)
      //     return _workorder.status[data];
      //   }
      // }, 
      // {
      //   //Priority
      //   "aTargets": [3],
      //   'render': function(data, type, full, meta) {
      //     return _workorder.priority[data];
      //   }
      // }, {
      //   //Type
      //   "aTargets": [10],
      //   'render': function(data, type, full, meta) {
      //     return _workorder.type[data];
      //   }
      // }, {
      //   //Subtype
      //   "aTargets": [11],
      //   'render': function(data, type, full, meta) {
      //     switch (data) {
      //       case "1":
      //         return "Sub Type 1";
      //         break;
      //       case "2":
      //         return "Sub Type 2";
      //         break;
      //       case "3":
      //         return "Sub Type 3";
      //         break;
      //       case "4":
      //         return "Sub Type 4";
      //         break;
      //       case "5":
      //         return "Sub Type 5";
      //         break;
      //       case "6":
      //         return "Sub Type 6";
      //         break;
      //       case "7":
      //         return "Sub Type 7";
      //         break;
      //       default:
      //         "None";
      //     }
      //   }
      // }, {
      //   //Payment Status
      //   "aTargets": [12],
      //   'render': function(data, type, full, meta) {
      //     switch (data) {
      //       case "1":
      //         return "Not Paid";
      //         break;
      //       case "2":
      //         return "Paid";
      //         break;
      //       default:
      //         "None";
      //     }
      //   }
      // }
      ],
      "iDisplayLength": 25,
      // "bServerSide": true,
      "sAjaxSource": config.siteUrl + "PM_Common/GetWorkOrders?unitId=" + unitId ,
      "iDisplayStart": 0,
      "sPaginationType": "full_numbers",
      'fnServerData': function(url, data, callback) {
        //data.type = $("#rgroup_listingtype input[type=radio]:checked").val();

        $.ajax({
          "dataType": 'json',
          "type": "POST",
          "url": config.siteUrl + "PM_Common/GetWorkOrders?unitId=" + unitId ,
          "data": data,
          "success": function(json) {
            callback(json);
            // updateUserStatusPanel();;
            if (last_id > 0) {
              // $('#tblWorkOrders #'+last_id+' td').addClass('yellowCSS');
            }
          }
        });
      }
    });

    // $('.datatable-setbotclass').next().addClass('fixedpagination-bottom');

    $('#txtSmartSearch_workorders').on('keyup', function() {
      oWorkOrdersTable.search(this.value).draw();
    });
}

function GetServiceProvider(serviceproviderId){
    //alert(serviceproviderId);

    $.ajax({
        type: "POST",
        url: mainurl + "PM_Common/GetServiceProvider",
        data: {
            'serviceproviderId': serviceproviderId},
        datatype: "html",
        success: function(result) {
          FillServiceProvider(result);
        }
    });
}

function ResetModal(modal){
  var $modal = $("#" + modal);
  var $modalheader = $modal.find(".modal-header h4");
  $modal.trigger("reset");

  switch(modal){
    case "serviceproviderform":
      $modalheader.text("Add New Service Provider");
      $modal.find("#btnDeleteTransactions").remove();
      break;
    default: ""
  }
}

function FillServiceProvider(result){

  var $modal = $("#serviceproviderform");

  var spDetails = result.spDetails;

  // console.log(result.spDetails);
  $modal.find("#frm_serviceprovider [id=id]").val(spDetails.id);
  $modal.find("#frm_serviceprovider [id=ref]").val(spDetails.ref);
  $modal.find("#frm_serviceprovider [id=created_by]").val(spDetails.created_by);
  $modal.find("#frm_serviceprovider [id=accountnumber]").val(spDetails.accountnumber);
  $modal.find("#frm_serviceprovider [id=serviceprovidername]").val(spDetails.serviceprovidername);
  $modal.find("#frm_serviceprovider [id=type]").val(spDetails.type);
  $modal.find("#frm_serviceprovider [id=subtypes]").val(spDetails.subtypes);
  $modal.find("#frm_serviceprovider [id=address]").val(spDetails.address);
  $modal.find("#frm_serviceprovider [id=firstname]").val(spDetails.firstname);
  $modal.find("#frm_serviceprovider [id=lastname]").val(spDetails.lastname);
  $modal.find("#frm_serviceprovider [id=countrycode1]").val(spDetails.countrycode1);
  $modal.find("#frm_serviceprovider [id=mobilenumber1]").val(spDetails.mobilenumber1);
  $modal.find("#frm_serviceprovider [id=email]").val(spDetails.email);

  $modal.find(".modal-header h4").text("Edit Service Provider for " + spDetails.serviceprovidername);

}

function GetTenants(){
  if($.fn.DataTable.isDataTable('#tblTenants')){
    $('#tblTenants').DataTable().draw();
  }
  else{
    var last_id = '';
    oTenantsTable = $('#tblTenants').DataTable({
        "bProcessing": true,
        
        "aoColumnDefs": [
        {
            'render': function(data, type, full, meta)
            {
                //check the main check box
                //$('#check_all_checkboxes').attr('checked', false);
                return '<div style="text-align:center;"><input style="align:center;" type="radio" name="listing" value="' + data + '">  <span class="lbl"></span></div>';
            },
            "aTargets": [0],
            "bSortable": false
        }                     
        ],
        "iDisplayLength": 5,
        // "bServerSide": true,
        "sAjaxSource": config.siteUrl + "PM_Common/GetTenants", //?prop_status=+$("#ulLeases li.active").val(),
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        'fnServerData': function(url, data, callback) {
            //data.type = $("#rgroup_listingtype input[type=radio]:checked").val();

            $.ajax({
                "dataType": 'json',
                "type": "POST",
                "url": config.siteUrl + "PM_Common/GetTenants", //?prop_status=+$("#ulLeases li.active").val(),
                "data": data,
                "success": function(json) {
                    callback(json);
                }
            });
        }
    });

    // $('.datatable-setbotclass').next().addClass('fixedpagination-bottom');

    $('#tblTenants tbody').on('click', 'tr', function() {
        $("#tblTenants tbody").find("tr").removeClass("selected");
        $(this).addClass('selected');
        $(this).find("input").prop("checked", true);
        var tenantId = $(this).find("input").val();
    });    
  }
}

function GetServiceProviders(){
  if($.fn.DataTable.isDataTable('[id=tblServiceProviders]')){//#tblServiceProviders
    $('[id=tblServiceProviders]').DataTable().draw();
  }
  else{

    /*sDOm cheatsheet
      l - length changing input control
      f - filtering input
      t - The table!
      i - Table information summary
      p - pagination control
      r - processing display element
    -----------------------------------*/

    var last_id = '';
    oUnitsTable = $('#tblServiceProviders').DataTable({
        "bProcessing": true,
        "dom": '<"top"f>rt<"bottom"ilp><"clear">', //"lfrti",
        // "dom": '<"top"f>rt<"bottom"ilp><"clear">',
        "aoColumnDefs": [
            {
                'render': function(data, type, full, meta)
                {
                    //check the main check box
                    //$('#check_all_checkboxes').attr('checked', false);
                    return '<div style="text-align:center;"><input style="align:center;" type="radio" name="listing" value="' + data + '">  <span class="lbl"></span></div>';
                },
                "aTargets": [0],
                "bSortable": false
            }
        ],
        "iDisplayLength": 7,
        // "bServerSide": true, // makes the searching not working
        "sAjaxSource": config.siteUrl + "PM_Common/GetServiceProviders",//?prop_status=+$("#ulLeases li.active").val(),
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",    
        // "bPaginate": false, 
        'fnServerData': function(url, data, callback) {
            //data.type = $("#rgroup_listingtype input[type=radio]:checked").val();

            $.ajax({
                "dataType": 'json',
                "type": "POST",
                "url": config.siteUrl + "PM_Common/GetServiceProviders",//?prop_status=+$("#ulLeases li.active").val(),
                "data": data,
                "success": function(json) {
                    callback(json);
                    // updateUserStatusPanel();;
                    if (last_id > 0) {
                        // $('#tblServiceProviders #'+last_id+' td').addClass('yellowCSS');
                    }
                }
            });
        }
    });

    // $('.datatable-setbotclass').next().addClass('fixedpagination-bottom');

    $('#txtSmartSearch_serviceproviders').on( 'keyup', function () {
      // console.log("searching for " + this.value);
      $('#tblServiceProviders').DataTable().search( this.value ).draw();
    } );

    $('#tblServiceProviders tbody').on('click', 'tr', function () {
        // console.log("row clicked");
        $("#tblServiceProviders tbody tr").removeClass('selected');
        $(this).toggleClass('selected');
        $(this).find("input").prop("checked", true);
        $("#btnEditSP").show();
    });   
  }
}

function GetLandlords(){
  if($.fn.DataTable.isDataTable('[id=tblLandlords]')){
    $('[id=tblLandlords]').DataTable().draw();
  }
  else{
    var last_id = '';
    oLandlordsTable = $('[id=tblLandlords]').DataTable({
        "bProcessing": true,
        "dom": '<"top"f>rt<"bottom"ilp><"clear">',
        "aoColumnDefs": [
        {
            'render': function(data, type, full, meta)
            {
                //check the main check box
                //$('#check_all_checkboxes').attr('checked', false);
                return '<div style="text-align:center;"><input style="align:center;" type="radio" name="listing" value="' + data + '">  <span class="lbl"></span></div>';
            },
            "aTargets": [0],
            "bSortable": false
        }                     
        ],
        "iDisplayLength": 25,
        // "bServerSide": true,
        "sAjaxSource": config.siteUrl + "PM_Common/GetLandlords", //?prop_status=+$("#ulLeases li.active").val(),
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        'fnServerData': function(url, data, callback) {
            //data.type = $("#rgroup_listingtype input[type=radio]:checked").val();

            $.ajax({
                "dataType": 'json',
                "type": "POST",
                "url": config.siteUrl + "PM_Common/GetLandlords", //?prop_status=+$("#ulLeases li.active").val(),
                "data": data,
                "success": function(json) {
                    callback(json);
                    // updateUserStatusPanel();;
                    if (last_id > 0) {
                        // $('[id=tblLandlords] #'+last_id+' td').addClass('yellowCSS');
                    }
                }
            });
        }
    });

    // $('.datatable-setbotclass').next().addClass('fixedpagination-bottom');

    $('#txtSmartSearch_Landlords').on('keyup', function() {
        oLandlordsTable.search(this.value).draw();
    });
  }
}

function GetTransactions() {
  if($.fn.DataTable.isDataTable('[id=tblTransactions]')){
    $('[id=tblTransactions]').DataTable().draw();
  }
  else{
    var last_id = '';
    oTransactionsTable = $('[id=tblTransactions]').DataTable({
      "bProcessing": true,
      "dom": '<"top"f>rt<"bottom"ilp><"clear">',
      "aoColumnDefs": [{
        'render': function(data, type, full, meta) {
          //check the main check box
          //$('#check_all_checkboxes').attr('checked', false);
          return '<div style="text-align:center;"><input style="align:center;" type="radio" name="listing" value="' + data + '">  <span class="lbl"></span></div>';
        },
        "aTargets": [0],
        "bSortable": false
      }, {
        //Transaction Type
        "aTargets": [2],
        'render': function(data, type, full, meta) {
          return _account.transactiontype[data]; // _transactionType[data];
        }
      }, {
        //Payment Type
        "aTargets": [3],
        'render': function(data, type, full, meta) {
          return _account.type[data];
        }
      }, {
        //Payment Sub-Type
        "aTargets": [4],
        'render': function(data, type, full, meta) {
          return ""; //_account.subtype[data];
        }
      }, {
        //Payment From
        "aTargets": [5],
        'render': function(data, type, full, meta) {
          return _account.from[data];
        }
      }, {
        //Payment To
        "aTargets": [6],
        'render': function(data, type, full, meta) {
          return _account.to[data];
        }
      }, {
        //Payment Mode
        "aTargets": [7],
        'render': function(data, type, full, meta) {
          return _account.mode[data];
        }
      }, ],
      "iDisplayLength": 25,
      // "bServerSide": true,
      "sAjaxSource": config.siteUrl + "PM_Common/GetTransactions?transactiontype=" + $("#ulAccounts li.active").val(), //?prop_status=+$("#ulLeases li.active").val(),
      "iDisplayStart": 0,
      "sPaginationType": "full_numbers",
      'fnServerData': function(url, data, callback) {
        //data.type = $("#rgroup_listingtype input[type=radio]:checked").val();

        $.ajax({
          "dataType": 'json',
          "type": "POST",
          "url": config.siteUrl + "PM_Common/GetTransactions?transactiontype=" + $("#ulAccounts li.active").val(), //?prop_status=+$("#ulLeases li.active").val(),
          "data": data,
          "success": function(json) {
            callback(json);
            // updateUserStatusPanel();;
            if (last_id > 0) {
              // $('#tblTransactions #'+last_id+' td').addClass('yellowCSS');
            }
          }
        });
      }
    });

    // $('.datatable-setbotclass').next().addClass('fixedpagination-bottom');

    $('#txtSmartSearch_Transactions').on('keyup', function() {
      oTransactionsTable.search(this.value).draw();
    });
  }
}

function GetTransaction(transactionId) {
  $.ajax({
      type: "POST",
      url: mainurl + "PM_Common/GetTransaction",
      data: {
          'transactionId': transactionId
      },
      datatype: "html",
      success: function(result) {
          FillTransaction(result);

          $("#editTransaction").show();
          $("#cancelTransaction").show();
          $("#tabNotes").find('*').prop("disabled", false);
      }
  });
}

function SaveWorkOrder(){
  var objWorkOrder = {};
  var parameters = jQuery('#frm_workorders').serializeArray();
  // var arr = parameters.split('&');

  $.each(parameters, function() {
      objWorkOrder[this.name] = this.value;
  });

  $.ajax({
      type: "POST",
      url: mainurl + "PM_Common/SaveWorkOrder/",
      data: {
          'objWorkOrder': objWorkOrder
      },
      datatype: "object",
      success: function(res) {
          ResetFields();
          GetUnit(objWorkOrder.unitId);
          // GetWorkOrder(objWorkOrder.id);
      }
  });
}

function SaveLease(){
  var objLease = {};  
  var parameters = jQuery('#frm_lease').serializeArray();
  //var arr = parameters.split('&');  

    $.each(parameters, function() {
        objLease[this.name] = this.value;
    });

    $.ajax({
        type: "POST",
        url: mainurl + "PM_Common/SaveLease/",
        data: {
            'objLease': objLease},
        datatype: "object",
        success: function(res) {
          GetUnit(objLease.unitId);
        }
    }); 
}

function GetWorkOrder(workorderID){
    $.ajax({
        type: "POST",
        url: mainurl + "PM_Common/GetWorkOrder",
        data: {
            'workorderID': workorderID},
        datatype: "html",
        success: function(result) {
            FillWorkOrder(result);

            $("#editWorkOrder").show();
            $("#cancelWorkOrder").show();
            $("#tabNotes").find('*').prop("disabled", false);
        }
    });
}

function FillWorkOrder(result){

    var workorder = {};
    var unit = {};
    var tenant = {};
    var notes = {};
    var documents = {};
    var transactions = {};
    var sp = {};
    unit = result.unitDetails;
    workorder = result.workorderDetails;
    tenant = result.tenantDetails;
    notes = result.workOrderNotes;
    transactions = result.transactionDetails;
    sp = result.serviceproviderDetails;

    var unit_status = "";
    switch(unit.prop_status){
        case "1": 
            unit_status = "Available";
        break;
        case "2": 
            unit_status = "Pending";
        break;
        case "3": 
            unit_status = "Rented";
        break;
        case "4": 
            unit_status = "Upcoming";
        break;
        case "5": 
            unit_status = "Reserved";
        break;
        case "6": 
            unit_status = "Renewed";
        break;
        case "7": 
            unit_status = "Blocked";
        break;
        default: "None";
    }

    /* [dev note] Habibi, why use [id=idname] instead of #idname?
     * #idname matches the first instance of this id,
     * when [id=idname] matches ALL instances of this id.
     * i needed to use the latter because we have two controls, 
     * one for the main page where you view data, 
     * and one modal box to update it.
    ------------------------------------------------------------------*/
    $("#modaltitle h4").text("Update Work Order for " + workorder.ref);
    $("#divWorkOrderDetails #unitNo").val(workorder.unit);
    $("#unitId").val(unit.unitId);
    $("#unitRefNo").val(unit.unitRefNo);
    $("#frm_workorders #id").val(workorder.id);
    $("#frm_workorders #ref").val(workorder.ref);
    $("#frm_workorders #dateadded").val(workorder.dateadded);
    $("#frm_workorders #created_by").val(workorder.created_by);
    $("[id=unitTitle]").val(workorder.unit +" - "+ unit.SubLocation);
    $("[id=serviceProviderId]").val(workorder.serviceProviderId);
    $("[id=serviceProviderRefNo]").val(workorder.serviceProviderRefNo);
    $("[id=serviceprovider]").val(workorder.serviceprovider);
    $("[id=description]").val(workorder.description);
    $("[id=type]").val(workorder.type);
    $("[id=subtype]").val(workorder.subtype);
    $("[id=assignedto]").val(workorder.assignedto);
    $("[id=status]").val(workorder.status);
    $("[id=startdate]").val(workorder.startdate);
    $("[id=enddate]").val(workorder.enddate);    
    $("[id=cost]").val(workorder.cost);
    $("[id=paidby]").val(workorder.paidby);
    $("[id=paymentstatus]").val(workorder.paymentstatus);
    $("[id=priority]").val(workorder.priority); 


    $("#rand_key").val(workorder.rand_key);
    $("#ref").val(workorder.ref);    

    //unit details
    $("#divUnitDetails label").text('');
    $("#divUnitDetails").show();
    $("#divUnitHeader span").hide();

    var type = (unit.type == 1)?"Rent":"Sale";

    $("#divUnitDetails #uType").text(type);
    $("#divUnitDetails #uRef").text(unit.unitRefNo);
    $("#divUnitDetails #uCategory").text(unit.category);
    $("#divUnitDetails #uLocation").text(unit.Location);
    $("#divUnitDetails #uSubLocation").text(unit.SubLocation);
    $("#divUnitDetails #uRegion").text(unit.Emirate);
    $("#divUnitDetails #uBeds").text(unit.beds);
    $("#divUnitDetails #uLandlord").text(unit.Owner);
    $("#divUnitDetails #uAgent").text(unit.PropertyMgr);

    //TODO: fill notes and documents

    if(notes.length > 0){

        notes = notes.sort(function(a, b){return b-a});
        
        $.each(notes, function(i, noteArray){
            var note = '<div id="'+noteArray.id+'">'+
            '<label><i>'+noteArray.datecreated+'</i></label>'+
            '<p align="left"><strong>'+noteArray.note+'</strong></p>'+
            '<hr></div>';

            $("#divNoteContent").append(note);
        });    
    }

    if(transactions.length > 0){

        $("#divAccountDetail").show();
        $("#divAccountHeader span").hide();

        transactions = transactions.sort(function(a, b){return b-a});
        var dueSum = 0, paidSum = 0;

        $.each(transactions, function(key, val){
            var row = "<tr>"+
            "<td>"+_account.status[val.status]+"</td>"+
            "<td>"+val.amount+"</td>"+
             "<td><a href='#'><i class='fa fa-eye'></i></a></td>"+
            +"</tr>";
            $("#divAccountDetail table").append(row);

            (val.status == 1)?paidSum += Math.round(val.amount):dueSum += Math.round(val.amount);
        });

        $("#spPaid").text(paidSum.toFixed(2));
        $("#spDue").text(dueSum.toFixed(2));
    }

    $.each(documents, function(i, documentArray){
        var doc = '<div id="'+documentArray.id+'">'+documentArray.dateUploaded+'</div>'+
        '<div class="row">'+
        '<div class="col-md-7">'+
        '<label><strong>'+documentArray.filename+'</strong></label>'+
        '</div>'+
        '<div class="col-md-5">'+
        '<label><a href="#">View</a> | <a href="#">Delete</a></label>'+
        '</div>'+
        '</div>';

        $("#documents").append(doc);
    });  

    $(".well table").show();
    $("#serviceProviderId").val(sp.id);
    $("#serviceProviderRefNo").val(sp.ref);
    $("[id=serviceprovider]").val(sp.serviceprovidername)
    $("[id=uType]").text(sp.type);
    $("[id=uSubTypes]").text(sp.subtypes);
    $("[id=uContact]").text(sp.firstname + " " + sp.lastname);
    $("[id=uMobile]").text(sp.mobilenumber);
    $("[id=uEmail]").text(sp.email);
}

function GetLease(leaseId){
    //alert(leaseId);

    $.ajax({
        type: "POST",
        url: mainurl + "PM_Common/GetLease",
        data: {
            'leaseId': leaseId},
        datatype: "html",
        success: function(result) {
            FillLease(result);

            $("#editLease").show();
            $("#cancellease").show();
            $("#tabNotes").find('*').prop("disabled", false)
        }
    });
}

function FillLease(result){

    var lease = {};
    var unit = {};
    var tenant = {};
    var notes = {};
    var documents = {};
    unit = result.unitDetails;
    lease = result.leaseDetails;
    tenant = result.tenantDetails;
    notes = result.leaseNotes;

    var unit_status = "";
    switch(unit.prop_status){
        case "1": 
            unit_status = "Available";
        break;
        case "2": 
            unit_status = "Pending";
        break;
        case "3": 
            unit_status = "Rented";
        break;
        case "4": 
            unit_status = "Upcoming";
        break;
        case "5": 
            unit_status = "Reserved";
        break;
        case "6": 
            unit_status = "Renewed";
        break;
        case "7": 
            unit_status = "Blocked";
        break;
        default: "None";
    }

    /* [dev note] Habibi, why use [id=idname] instead of #idname?
   * #idname matches the first instance of this id,
   * when [id=idname] matches ALL instances of this id.
   * i needed to use the latter because we have two controls, 
   * one for the main page where you view data, 
   * and one modal box to update it.
    ------------------------------------------------------------------*/
  $("#modaltitle h4").text("Update Lease for " + lease.ref);
  $("#divLeaseDetails #unitNo").val(lease.unit);
  $("#unitId").val(unit.unitId);
  $("#unitRefNo").val(unit.unitRefNo);
  $("#frm_lease #id").val(lease.id);
  $("#frm_lease #dateadded").val(lease.dateadded);
  $("#frm_lease #created_by").val(lease.created_by);
  $("[id=unitTitle]").val(lease.unit +" - "+ unit.SubLocation);
  $("[id=tenantId]").val('5');
  $("[id=tenantName]").val(tenant.firstname + " " + tenant.lastname);
  $("[id=tName]").text(tenant.firstname + " " + tenant.lastname);
  $("[id=tMobile]").text(tenant.countrycode1 + tenant.mobilenumber1);
  $("[id=tEmail]").text(tenant.email);
  $("[id=tNationality]").text(tenant.nationality);
  $("[id=tDOB]").text(tenant.dob);
  $("[id=startdate]").val(lease.startdate);
  $("[id=enddate]").val(lease.enddate);
  $("[id=leaseamount]").val(lease.leaseamount);
  $("[id=deposit_percentage]").val(lease.deposit_percentage);
  $("[id=deposit_amount]").val(lease.deposit_amount);
  $("[id=fees_percentage]").val(lease.fees_percentage);
  $("[id=fees_amount]").val(lease.fees_amount);
  $("[id=commission]").val(lease.commission);
  $("[id=paymentmode]").val(lease.paymentmode);
  $("[id=paymentterm]").val(lease.paymentterm);
  $("[id=cheques]").val(lease.cheques);
  $("[id=sourceoftenancy]").val(lease.sourceoftenancy);
  $("[id=depositheldby]").val(lease.depositheldby);
  $("[id=ejaristatus]").val(lease.ejaristatus);
  $("[id=ejarinumber]").val(lease.ejarinumber);
  $("[id=reminder]").val(lease.reminder);

  $("[id=rand_key]").val(lease.rand_key);
  $("[id=ref]").val(lease.ref);    

    //unit details
  $("#divUnitDetails label").text('');
  $("#divUnitDetails").show();
  $("#divUnitHeader span").hide();

  var type = (unit.type == 1)?"Rent":"Sale";

  $("#uType").text(type);
  $("#uRef").text(unit.unitRefNo);
  $("#uCategory").text(unit.category);
  $("#uLocation").text(unit.Location);
  $("#uSubLocation").text(unit.SubLocation);
  $("#uRegion").text(unit.Emirate);
  $("#uBeds").text(unit.beds);
  $("#uLandlord").text(unit.Owner);
  $("#uAgent").text(unit.PropertyMgr);

    //TODO: fill notes and documents
    if(notes.length > 0){    
        notes = notes.sort(function(a, b){return b-a});
        
      $.each(notes, function(i, noteArray){
        var note = '<div id="'+noteArray.id+'">'+
        '<label><i>'+noteArray.datecreated+'</i></label>'+
        '<p align="left"><strong>'+noteArray.note+'</strong></p>'+
        '<hr></div>';

        $("#notes").append(note);
      });
    }

  $.each(documents, function(i, documentArray){
    var doc = '<div id="'+documentArray.id+'">'+documentArray.dateUploaded+'</div>'+
    '<div class="row">'+
    '<div class="col-md-7">'+
    '<label><strong>'+documentArray.filename+'</strong></label>'+
    '</div>'+
    '<div class="col-md-5">'+
    '<label><a href="#">View</a> | <a href="#">Delete</a></label>'+
    '</div>'+
    '</div>';

    $("#documents").append(doc);
  });



                            // <div class="row">
                            //   <div class="col-md-7">
                            //     <label><strong>Tenancy Contract.docx</strong></label>
                            //   </div>
                            //   <div class="col-md-5">
                            //     <label><a href="#">View</a> | <a href="#">Delete</a></label>
                            //   </div>
                            // </div> 
}

function GetUnits() {
  if($("#tblUnits").hasClass("dataTable")){
    // $("#tblunits").DataTable().clear();//.draw();
    // alert("if");
  }
  else{
    // alert("else");
    var last_id = '';
    oUnitsTable = $('#tblUnits').DataTable({
      "bProcessing": true,
      "dom": '<"top"f>rt<"bottom"ilp><"clear">',
      "aoColumnDefs": [{
        'render': function(data, type, full, meta) {
          //check the main check box
          //$('#check_all_checkboxes').attr('checked', false);
          return '<div style="text-align:center;"><input style="align:center;" type="radio" name="listing" value="' + data + '">  <span class="lbl"></span></div>';
        },
        "aTargets": [0]
      }, {
        "bSortable": false,
        "aTargets": [0]
      }, {
        "aTargets": [1],
        'render': function(data, type, full, meta) {
          return (data == 1) ? "Rent" : "Sale";
        }
      }],
      "aoColumns": [{
        "mDataProp": "id"
      }, {
        "mDataProp": "type"
      }, {
        "mDataProp": "ref"
      }, {
        "mDataProp": "unit"
      }, {
        "mDataProp": "category"
      }, {
        "mDataProp": "region_id"
      }, {
        "mDataProp": "area_location_id"
      }, {
        "mDataProp": "sub_area_location_id"
      }, {
        "mDataProp": "beds"
      }, {
        "mDataProp": "size"
      }, {
        "mDataProp": "price"
      }, {
        "mDataProp": "agent_id"
      }, {
        "mDataProp": "landlord_name"
      }, {
        "mDataProp": "dateadded"
      }, {
        "mDataProp": "dateupdated"
      }, {
        "mDataProp": "user_id"
      }, {
        "mDataProp": "key_location"
      }, ],
      "columns": [{
        "data": "id"
      }, {
        "data": "type"
      }, {
        "data": "ref"
      }, {
        "data": "unit"
      }, {
        "data": "category"
      }, {
        "data": "region_id"
      }, {
        "data": "area_location_id"
      }, {
        "data": "sub_area_location_id"
      }, {
        "data": "beds"
      }, {
        "data": "size"
      }, {
        "data": "price"
      }, {
        "data": "agent_id"
      }, {
        "data": "landlord_name"
      }, {
        "data": "dateadded"
      }, {
        "data": "dateupdated"
      }, {
        "data": "user_id"
      }, {
        "data": "key_location"
      }, ],
      "iDisplayLength": 25,
      "bServerSide": true,
      "sAjaxSource": config.siteUrl + "PM_Common/GetUnits?prop_status=" + $("#ulUnits li.active").val() + "&type=" + $('input[name=listtype_]:checked').val(),
      "iDisplayStart": 0,
      "sPaginationType": "full_numbers",
      'fnServerData': function(url, data, callback) {
        data.type = $("#rgroup_listingtype input[type=radio]:checked").val();

        $.ajax({
          "dataType": 'json',
          "type": "POST",
          "url": config.siteUrl + "PM_Common/GetUnits?prop_status=" + $("#ulUnits li.active").val() + "&type=" + $('input[name=listtype_]:checked').val(),
          "data": data,
          "success": function(json) {
            callback(json);
          }
        });
      }
    });

    $('.datatable-setbotclass').next().addClass('fixedpagination-bottom');


  }
}

// function scrollToAnchor(aid){
//     var aTag = $("th[id='"+ aid +"']");
//     $('html,body').animate({scrollTop: aTag.offset().top},'slow');
// }

function CheckDueDates(){

  var $tablebody = $("#tblPayments tbody");

  $.each($tablebody.find("td.payment.s2"), function(i, cell){

    var payee = $(cell).attr("payee");
    var day = $(cell).attr("day");
    var month = $(cell).attr("month")-1;
    var year = $(cell).attr("year");
    var dueAmount = parseFloat($(cell).find("span").text().replace(/,/g,''));
    var spanColor;

    var status = $(cell).attr("status");//($(cell).attr("status") == 2)?"Due":"Paid";

    if(!isNaN(dueAmount)){
      var tdDate = new Date(year, month, day);

      var $siblingCell = $("td.s1.m" + $(cell).attr("month") + ".p" + payee + ".payment");

      var paidAmount = parseFloat($siblingCell.find("span").text().replace(/,/g,''));

      var d1 = new Date();
      d1.setDate(d1.getDate() + 7);

      var day = d1.getDate();
      var m = d1.getMonth();
      var y = d1.getFullYear();

      var noticeDate = new Date(y, m, day);

      var difference = GetDays(tdDate, noticeDate);
      
      // if(month == 4){
      //   console.log("tdDate-->" + tdDate + "\n");  
      //   console.log("noticeDate-->" + noticeDate + "\n");  
      //   console.log("difference-->" + difference + "\n");  
      //   console.log("------------------");  
      // } 

      if(difference <= 7 )
        spanColor = "goldenrod";
      else
        spanColor = "black";

      if(paidAmount == dueAmount)
        spanColor = "green";
    }
    else spanColor = "black";

    $(cell).find("span").attr("style", "color:" + spanColor);
  });
}

function GetDays(tdDate, noticeDate){

  // var timeDiff = noticeDate.getTime() - tdDate.getTime();
  var timeDiff = tdDate.getTime() - noticeDate.getTime();
  var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
  
  return diffDays;
}

function addCommas(nStr) {
  nStr += '';
  x = nStr.split('.');
  x1 = x[0];
  x2 = x.length > 1 ? '.' + x[1] : '';
  var rgx = /(\d+)(\d{3})/;
  while (rgx.test(x1)) {
    x1 = x1.replace(rgx, '$1' + ',' + '$2');
  }
  return x1 + x2;
}

function getQuarter(d) {
  var m = new Date();
  d = d || m.getMonth(); // If no date supplied, use today
  
  var q = [1,2,3,4];
  var i = Math.floor(d / 3);
  return (q[i] == undefined)?q[3]:q[i];
}

function ResetAccountForm(){
  $modal = $("#accountform");
  $modal.find("#hdnPayeeId").val(0);
  $modal.find("#hdnPayeeId").text("");
  $modal.find("#cost").val('');
  $modal.find("#day").val('');
  $modal.find("#selMonth").val(0);
  $modal.find("#selYear").val(0);
  $modal.find("#status").val(0);
  $modal.find("#selectedPayee").text("Select");
}

function ResetServiceProviderForm(){
  var $spForm = $("#serviceproviderform");
  $spForm.find("#ref").val('');
  $spForm.find("#serviceprovidername").val('');
  $spForm.find("#type").val('');
  $spForm.find("#subtypes").val('')
  $spForm.find("#address").val('');
  $spForm.find("#firstname").val('');
  $spForm.find("#lastname").val('');
  $spForm.find("#countrycode1").val(''); 
  $spForm.find("#mobilenumber1").val('');
  $spForm.find("#email").val('');
  $spForm.find("#mobilenumbertitle").val('');  
  $spForm.find("#accountnumber").val('');  
}

function SaveServiceProvider(){
    var objServiceProvider = {};
    var parameters = $('#frm_serviceprovider').serializeArray();
    // var arr = parameters.split('&');

    $.each(parameters, function() {
        // console.log("this.name-->" + this.name)
        objServiceProvider[this.name] = this.value;
    });

    $.ajax({
        type: "POST",
        url: mainurl + "PM_Common/SaveServiceProvider/",
        data: {
            'objServiceProvider': objServiceProvider
        },
        datatype: "object",
        success: function(res) {
            // ResetFields();
            // $('#tblServiceProviders').DataTable().draw();
            GetServiceProviders();
        }
    });
}

function GetServiceProviderNames(){
  var spDropdown = $("#selPayee").next("ul");

  $.ajax({
      type: "POST",
      url: mainurl + "PM_Common/GetServiceProviderNames",
      // data: {};
      datatype: "html",
      success: function(result) {
        spDropdown.html('<li><a href="#" value="0">Select</a></li>');

        $.each(result.spnames, function(key, payeeArray){
          spDropdown.append('<li><a href="#" value="'+payeeArray.id+'">'+payeeArray.name+'</a></li>');
          // spDropdown.append($("<option></option>").val(payeeArray.id).html());
        });

        var liFooter = '<li role="separator" class="divider"></li>'+
        '<li><a href="#" value="new">Create New...</a></li>';

        spDropdown.append(liFooter);
      }
  });
}

function GetMonths(quarter){
  var m = [];
  m.push((quarter == 1)? 1: 1 + ( 3 * (quarter - 1)));
  m.push((quarter == 1)? 2: 2 + ( 3 * (quarter - 1)));
  m.push((quarter == 1)? 3: 3 + ( 3 * (quarter - 1)));
  return m;
}

function SavePayments(){
  var objPayment = [];  
  var objPaymentDetails = {};
  
  var $table = $("#tblPayments");

  $.each($table.find("td.payment"), function(i, cell){

    var objPaymentDetails = {};  

    var payment = parseFloat($(cell).find("span").html().replace(/,/g,''));//

    /*dev note:
      I commented out the condition payment > 0 in order to commit changes
      when a user zeroes-out a payment (might be due to erroneous entry).
    -----------------------------------------------------------------------*/
    // if(payment > 0){

      objPaymentDetails["detailId"] = $(cell).closest("tr").attr("detailid");    
      objPaymentDetails["payeeId"] = $(cell).attr("payee");
      objPaymentDetails["status"] = $(cell).attr("status");
      objPaymentDetails["month"] = $(cell).attr("month");
      objPaymentDetails["day"] = $(cell).attr("day");
      objPaymentDetails["year"] = $(cell).attr("year");
      objPaymentDetails["payment"] = parseFloat(payment);

      objPayment.push(objPaymentDetails);    
    // }
  });

  if(objPayment.length > 0){
    $.ajax({
      type: "POST",
      url: mainurl + "PM_Common/SavePayments/",
      data: {
          'headerId': ($("#accountform").find("#id").val() == "")? 0 :$("#accountform").find("#id").val(),
          'unitId': $("#unitform #id").val(),
          'ref': $("#accountform").find("#ref").val(),
          'objPayment': objPayment
      },
      datatype: "object",
      success: function(res) {
        //do something
      }
    }); 
  }
  else
    $("#accountform").modal("hide");
}

function GetPayments(){
  var unitId = $("#unitform #id").val();

  $.ajax({
      type: "POST",
      url: mainurl + "PM_Common/GetPayments",
      data: {
          'unitId': unitId }, // , 'quarter': quarter},
      datatype: "html",
      success: function(result) {
        FillPayments(result);
      }
  });  
}

function AddPayment(){

  var $pcontrols = $("#paymentControls");

  var payment = {};
  payment["payee"] = $("#hdnPayeeId").text();
  payment["payeeId"] = $("#hdnPayeeId").val();
  payment["amount"] = $pcontrols.find("#cost").val();
  payment["status"] = $pcontrols.find("#status option:selected").val();
  payment["month"] = $("#selMonth option:selected").val();
  payment["day"] = $pcontrols.find("#day").val();
  payment["year"] = $("#selYear option:selected").val();

  var m = GetMonths(payment["quarter"]);

  var $row = $("tr.r" + payment["payeeId"]);

  if($row.length == 0){
    var row =
    "<tr class='r"+payment["payeeId"]+"'>"+
      "<td class='p"+payment["payeeId"]+" payee' id='"+payment["payeeId"]+"'><i class='fa fa-pencil editServiceProvider' title='Edit Service Provider info'></i> "+payment["payee"]+"</td>";

    for (var i = 1; i <= 12; i++) {
      row +=
      '<td class="m'+i+' p'+payment["payeeId"]+' s1 payment" year="'+payment["year"]+'" status="1" payee="'+payment["payeeId"]+'" day="1" month="'+i+'" ><a  class="popoverlink" title="" data-container="body" data-toggle="popover" tabindex="0"><span>--</span></a> </td>' +
      '<td class="m'+i+' p'+payment["payeeId"]+' s2 payment" year="'+payment["year"]+'" status="2" payee="'+payment["payeeId"]+'" day="1" month="'+i+'" ><a  class="popoverlink" title="" data-container="body" data-toggle="popover" tabindex="0"><span>--</span></a> </td>';
    }
    row += '</tr>';

    $("#tblPayments tbody").append(row);

    $row = $("tr.r" + payment["payeeId"]);

    //change log: this function always goes to Due
    $row.find("td.m" + payment["month"] + ".s2.payment").find("span").text(addCommas(parseFloat(payment["amount"]).toFixed(2)));    
    $row.find("td.m" + payment["month"] + ".s2.payment").attr("day", payment["day"]);
  }

  CheckDueDates();

  ResetAccountForm();
}

function FillPayments(result){

  // console.log("result--> " + result);
  jsonres = JSON.parse(result);//result
  // console.log("jsonres--> " + jsonres);

  var $modal = $("#accountform");

  var payments = {};
  var headerInfo = {};
  var payees = {};
  payments = jsonres.payments;
  payees = jsonres.payees;
  headerInfo = jsonres.headerInfo;
  // console.log(headerInfo);

  $modal.find("#id").val(headerInfo.headerId);
  $modal.find("#ref").val(headerInfo.ref);

  var $tablebody = $("#tblPayments tbody");

  $tablebody.html("");

  //construct tablebody first
  $.each(payees, function(i, array){

    var row = "<tr class='r"+array.payeeId+"'>" +
              "<td class='p"+array.payeeId+" payee' id='"+array.payeeId+"'><i class='fa fa-pencil editServiceProvider' title='Edit Service Provider info'></i> "+array.payeeName+"</td>" +
              "</tr>";

    $tablebody.append(row);
  }); 

  $.each(payments, function(i, array){

    // console.log("array.payment-->" + parseFloat(array.payment));

    var payment  = (parseFloat(array.payment) == 0)? "--" : addCommas(parseFloat(array.payment).toFixed(2));

    for (var j = 1; j <= 12; j++) {

      if($("tr").find('td.m'+j+'.p'+array.payeeId+'.payment').length != 2){
        // console.log("array.day-->" + array.day);  
        $(".r"+array.payeeId).append("<td month='"+j+"' day='1' payee='"+array.payeeId+"' status='1' year='"+array.year+"' class='m"+j+" p"+array.payeeId+" s1 payment'><a  class='popoverlink' title='' data-container='body' data-toggle='popover' tabindex='0'><span>--</span></a> </td>");
        $(".r"+array.payeeId).append("<td month='"+j+"' day='1' payee='"+array.payeeId+"' status='2' year='"+array.year+"' class='m"+j+" p"+array.payeeId+" s2 payment'><a  class='popoverlink' title='' data-container='body' data-toggle='popover' tabindex='0'><span>--</span></a> </td>");
      }
    };
    // console.log("array.day-->" + array.day);  
    $("tr.r" + array.payeeId).find("td.m" + array.month + ".s" + array.status + ".payment").find("span").text(payment);     
    $("tr.r" + array.payeeId).find("td.m" + array.month + ".s" + array.status + ".payment").attr("day", array.day);     
  });

  CheckDueDates();
}

function DeleteTransactions(headerId, payeeId){
  // alert("payee--> " + payee);

  $.ajax({
      type: "POST",
      url: mainurl + "PM_Common/DeletePaymentRecord",
      data: {
          'headerId': headerId,
          'payeeId': payeeId}, // , 'quarter': quarter},
      datatype: "html",
      success: function(result) {
        $("#serviceproviderform").modal("hide");
      }
  }); 
}

function SaveTenant(){

  var objTenant = {};
  var parameters = jQuery('#frm_tenant').serializeArray();

  $.each(parameters, function() {
      objTenant[this.name] = this.value;
  });

  $.ajax({
      type: "POST",
      url: mainurl + "PM_Common/SaveTenant/",
      data: {
          'objTenant': objTenant
      },
      datatype: "object",
      success: function(res) {
          $("#tenantform").modal("hide");
          GetTenant(res);
      }
  });
}

function SelectTenant(tenant){
  $("#divTenantInfo").find("label").text("");
  // console.log(tenant);

  $("#tenantName, #tenantId").val("");

  var $leaseModal = $("#leaseform");

  var $tenantInfo = $leaseModal.find("#divTenantInfo");

  $tenantInfo.find("#tenantId").val(tenant.id);
  $leaseModal.find("#tenantId").val(tenant.id);
  $leaseModal.find("#tenantName").val(tenant.firstname + " " + tenant.lastname);
  $tenantInfo.find("#tName").text(tenant.firstname + " " + tenant.lastname);
  $tenantInfo.find("#tMobile").text(tenant.countrycode1 + tenant.mobilenumber1);
  $tenantInfo.find("#tEmail").text(tenant.email);
  $tenantInfo.find("#tNationality").text(tenant.nationality);
  $tenantInfo.find("#tDOB").text(tenant.dob);
}

function GetTenant(tenantId){

    $.ajax({
        type: "POST",
        url: mainurl + "PM_Common/GetTenant",
        data: {
            'tenantId': tenantId
        },
        datatype: "html",
        success: function(result) {
          $("#tenantform").modal("hide");
          SelectTenant(result.tenantDetails);
        }
    });
}

$(document).ready(function(){
  var _module = $("body").prop("class");  

  $("#btnSelectTenant").click(function(){
    var tenant = new Object();

    var $row = $("#tblTenants tbody").find("tr.selected");

    var action = $("#tenantform").find("#nav li.active a").attr("id");
    if(action == "tabnew")
      SaveTenant();
    else
      GetTenant($row.find("input").val());
  });

  $('#txtSmartSearch_units').on('keyup', function() {
    $('#tblUnits').DataTable().search(this.value).draw();
  });

  $('#txtSmartSearch_Tenants').on('keyup', function() {
    // console.log(this.value);
    $('#tblTenants').DataTable().search(this.value).draw();
  });

  $(".pActions").hide();

  $("#frm").slideUp(600);

  $.each(_lease, function(id, element) {
      $("#leaseform [id="+id+"]").html("").append("<option value='0'>Select</option>");

      $.each(element, function(key, value){
        
        $("#leaseform [id="+id+"]").append("<option value='"+key+"'>"+value+"</option>");
      });
  });  

  $.each(_servicesprovider, function(id, element) {
      $("serviceproviderform [id="+id+"]").html("").append("<option value='0'>Select</option>");

      $.each(element, function(key, value){
        
        $("#serviceproviderform [id="+id+"]").append("<option value='"+key+"'>"+value+"</option>");
      });      
  });

  $.each(_account, function(id, element) {
      $("#accountform [id="+id+"]").html("").append("<option value='0'>Select</option>");

      $.each(element, function(key, value){
        $("#accountform [id="+id+"]").append("<option value='"+key+"'>"+value+"</option>");
      });        
  }); 

  $.each(_workorder, function(id, element) {
      $("#workorderform [id="+id+"]").html("").append("<option value='0'>Select</option>");

      $.each(element, function(key, value){
        if(id != "subtype")      
          $("#workorderform [id="+id+"]").append("<option value='"+key+"'>"+value+"</option>");
      });           
  });  

  $("#workorderform #type").change(function(){
    $("#workorderform #subtype").html("").append("<option value='0'>Select</option>");

    $.each(_workorder.subtype[this.value], function(key, val){
      $("#workorderform #subtype").append("<option value='"+key+"'>"+val+"</option>");
    });
  });

  GetHeaderCounts(_module);

  $(".dataTable tbody").on('click', 'tr', function() {
      $(this).find("tr").removeClass('selected');
      $(this).toggleClass('selected');
      $(this).find("input").prop("checked", true);
  });  

  /*modal section
  -----------------*/
  var modalList = new Array();
  var parentModal = "", childModal = "";

  $(".modal")
  .on("show.bs.modal", function (e) {

    ResetModal(this.id);

    childModal = this.id;
    // alert(childModal);

    if(modalList.length > 0){
      if(modalList.indexOf(this.id) < 0){ //if id is existing not array
        modalList.push(this.id);
      }    
    }
    else modalList.push(this.id);

    parentModal = modalList[modalList.length-2];
    $("#" + parentModal).modal("hide");
    // alert("parentModal-->" +parentModal);

    /*for console
    for (var i = 0; i < modalList.length; i++) {
      console.log("modalList["+i+"]-->" + modalList[i]);
    };
    ---------------------------------------------------- */   
  })
  .on("hidden.bs.modal", function (e) {

    ResetModal(this.id);

    if(modalList.length > 1){
      if(this.id == modalList[modalList.length - 1]){
        $("#" + parentModal).modal("show");
              modalList.pop();
      }
    }
    else modalList.pop();

    /* for console
    for (var i = 0; i < modalList.length; i++) {
      console.log("modalList["+i+"]-->" + modalList[i]);
    };
    ----------------------------------------------------*/
  });
  
  $("#unitSelector").on("show.bs.modal", function (e) {
    GetUnits();
  });

  $("#tenantSelector").on("show.bs.modal", function (e) {
    GetTenants();
  });

  $("#landlordSelector").on("show.bs.modal", function (e) {
    GetLandlords();
  });

  $("#serviceproviderSelector").on("show.bs.modal", function (e) {
    GetServiceProviders();
  });

  $("#leases").on("show.bs.modal", function (e) {
    console.log("yo");
    var unitId = $("#unitform #id").val();
    GetLeases(unitId);
  });

  $("#workorders").on("show.bs.modal", function (e) {
    var unitId = $("#unitform #id").val();
    GetWorkOrders(unitId);
  });  

  $("#accountform")
  .on("show.bs.modal", function (e) {

    $("#loading").show();

    var unitId = $("#unitform #id").val();

    ResetAccountForm();

    GetServiceProviderNames();
    GetPayments();
  })
  .on("shown.bs.modal", function (e) {
    $("#loading").hide();
  });

  $("#tenantform").on("show.bs.modal", function (e) {
    $("#frm_tenant").trigger("reset");
  });    

  $("#serviceproviderform")
  .on("show.bs.modal", function (e) {
    var button = $(e.relatedTarget);

    var lnkParent = button.data("parent");

    // console.log("relatedTarget-->" + $(e.relatedTarget));

    $(this).find("div#nav").attr("style", (lnkParent == null)?"display:none":"display:block");

    ResetServiceProviderForm();
  })
  .on("click", "#btnDeleteTransactions", function(){
    var headerId = $("#accountform").find("#id").val();
    var payeeId = $(this).attr("payee");

    bootbox.confirm("Are you sure? This action is irreversible.", function(result) {
      if(result){
        DeleteTransactions(headerId, payeeId);
        $("#serviceproviderform").modal("hide");
      }
        
    });
  });

  $("#tenantform a#tabimport").click(function(){
     GetTenants();// $('#tblTenants').DataTable().draw();
  });  

  $("#serviceproviderform a#tabimport").click(function(){
     GetServiceProviders();// $('#tblTenants').DataTable().draw();
  });    


  /* Manage Payments section
  ---------------------------*/

  $("#tblPayments")
  .on("mouseenter", "td.payment", function(){

    var status = $(this).attr("status");

    var duedate = $(this).attr("day") + "/" + $(this).attr("month") + "/" + $(this).attr("year");
    var amount = parseFloat($(this).find("span").text().replace(/,/g,''));

    if(amount > 0){
      $( this ).append(' <i class="fa fa-pencil" title="Add Note"></i> <i class="fa fa-trash deleteAmount" title="Remove"></i>');

      if(status == 2){
        $( this ).append('  <i class="fa fa-calendar editDueDate" title="Edit Date"></i> ');


        $('.popoverlink').popover('destroy');

        $(this).find('.popoverlink').popover({
          placement: 'top',
          trigger: 'manual',
          html: true,
          title: "Due Date",
          content: duedate,
          container:'body'
        });


        $(this).find(".popoverlink").popover("show");        
      }

    }
    else{
      $( this ).append(' <i class="fa fa-info-circle" title="Double click to edit amount"></i> ');
    }
  })
  .on("mouseleave", "td.payment", function(){

    $(this).find(".popoverlink").popover("destroy");
    $( this ).find("i").remove();      
  })
  .on("dblclick", "td.payment", function() {
    $(this).find(".popoverlink").popover("destroy"); 

    if(OriginalContent == "--")
      $(this).text('');

    var OriginalContent = $(this).text();
    var originalClasses = $(this).attr("class");

    // console.log("originalClasses--> " + originalClasses);

    $(this).addClass("cellEditing");
    $(this).html('<input type="text" class="form-control tdEditor numOnly" value="'+OriginalContent+'">'); // <i class="fa fa-floppy-o" title="Save"></i> <i class="fa fa-times-circle" title="Cancel"></i>
    $(this).children().first().focus();

    $(this).children().first().keypress(function (e) {
        if (e.which == 13) {
          $(this).parent().find(".popoverlink").popover("destroy");

          var newContent;

          newContent = (isNaN($(this).val()) || $(this).val() <= 0)?"--":addCommas(parseFloat($(this).val()).toFixed(2));

          $(this).parent().html("<a class='popoverlink' title='' href='#' data-container='body' data-toggle='popover' tabindex='0'><span>"+newContent+"</span></a>");
          $(this).removeClass();
          // $(this).parent().addClass(originalClasses);

          CheckDueDates();

          SavePayments();
        }
    });

    //k--> here is when the user clicks out of the input box. if ever they want to save the new data on "click out", here's were you change it.
    $(this).children().first().blur(function(){
        $(this).parent().text(OriginalContent);
        $(this).parent().removeClass("cellEditing");
    });

    $(this).find('input').dblclick(function(e){
        e.stopPropagation(); 
    });
  })
  .on("click", ".editDueDate", function(){
    // $("#accountform").find("#day").focus();
    // console.log($(this).closest("td").parent().find("td.payee").html());

    var $duedatemod = $("#editDueDateModal");
    var $parentTd = $(this).closest("td");
    var payee = $parentTd.parent().find("td.payee").html();

    var monthNames = ["January", "February", "March", "April", "May", "June",
      "July", "August", "September", "October", "November", "December"
    ]; 

    var cDay = $parentTd.attr("day");
    var cMonth = monthNames[$parentTd.attr("month") - 1];
    var cYear = $parentTd.attr("year"); 

    bootbox.dialog({
      title: function(){
        return "Edit " + payee + " due date for " 
        + $duedatemod.find("#selMonth option:selected").text() + " " + $duedatemod.find("#selYear option:selected").text();
      },
      message: '<div id="editDueDateModal">'+
                '<form class="row">'+
              '    <div class="col-md-2">'+
                    '<div class="form-group">'+
                      '<label>Day</label>'+
                      '<input type="text" class="form-control" id="newday" name="day" value="'+cDay+'">'+
                    '</div>'+
              '    </div>'+
              '    <div class="col-md-5">'+
                    '<div class="form-group">'+
                      '<label>Month</label>'+
                      '<input type="text" class="form-control" id="month" name="month" readonly="" value="'+cMonth+'">'+
                    '</div>'+
              '    </div>'+
              '    <div class="col-md-5">'+
                    '<div class="form-group">'+
                      '<label>Year</label>'+
                      '<input type="text" class="form-control" id="year" name="year" readonly="" value="'+cYear+'">'+
                    '</div>'+
              '    </div>'+
                '</form>'+
              '</div>',
      buttons: {
        success: {
          label: "Save",
          className: "btn-success",
          callback: function(e) {
            $parentTd.attr("day", $("#newday").val());
            CheckDueDates();
          }
        }
      }
    });
  })
  .on("click", ".editServiceProvider", function(){

    var spId = $(this).closest("td.payee").attr("id");
    GetServiceProvider(spId);

    // console.log("spId-->" + spId);
    var $modal = $("#serviceproviderform");
    $modal.modal("show");

    $modal.find(".modal-footer")
    .append('<button class="btn btn-danger" id="btnDeleteTransactions" payee="'+spId+'" type="button"><i class="fa fa-trash"></i> Delete transactions</button>');

  })
  .on("click", ".deleteAmount", function(){
    var $parentTd = $(this).closest("td");

    // console.log("delete clicked.");
    bootbox.confirm("Are you sure?", function(result) {
      // console.log("Confirm result: "+result);
     
      if(result){
        $parentTd.find("span").text("--");
        CheckDueDates();
      }
    }); 
  });

  $(".popover").on('click', '[data-dismiss="popover"]', function (e) {
    e.preventDefault();
    alert("hide!");
      $(this).popover('hide');
  });

  $("#btnAddPayment").click(function(){
    if($("#hdnPayeeId").val() > 0){
      AddPayment();
      SavePayments();
    }
    else bootbox.alert("Please select payee.");
  });

  $("#paymentControls").on('click', '#spDropdown li a', function () {
    $("#hdnPayeeId").val($(this).attr("value"));
    $("#hdnPayeeId").text($(this).text());

    $("#selectedPayee").text($(this).text());

      if($(this).attr("value") == "new"){
        $("#serviceproviderform").modal("show");
      }
  });

  $("#btnSelectServiceProvider").click(function(){
    var tenant = new Object();

    var $row = $("#tblTenants tbody").find("tr.selected");

    var action = $("#serviceproviderform").find("#nav li.active a").attr("id");
    if(action == "tabnew")
      SaveServiceProvider();
    else{
      var $row = $("#tblServiceProviders tbody").find("tr.selected");

      var spInfo = new Object();

      spInfo["id"] = $row.find("input").val();
      spInfo["ref"] = $row.find("td:eq(1)").text();
      spInfo["spName"] = $row.find("td:eq(2)").text();
      spInfo["type"] = $row.find("td:eq(3)").text();
      spInfo["subtype"] = $row.find("td:eq(4)").text();
      spInfo["contactname"] = $row.find("td:eq(5)").text();
      spInfo["mobilenumber"] = $row.find("td:eq(6)").text();
      spInfo["email"] = $row.find("td:eq(7)").text();

      $(".well table").show();

      $("#workorderform #serviceProviderId").val(spInfo.id);
      $("#workorderform #serviceProviderRefNo").val(spInfo.ref);
      $("#workorderform #serviceprovider").val(spInfo.spName);
      $("#workorderform #uType").text(_servicesprovider[spInfo.type]);
      $("#workorderform #uSubTypes").text(spInfo.subtype);
      $("#workorderform #uContact").text(spInfo.contactname);
      $("#workorderform #uMobile").text(spInfo.mobilenumber);
      $("#workorderform #uEmail").text(spInfo.email);         
    }
 
  });

  $("#btnSavePayments").click(function(){
    // if()
    SavePayments();
  })

  $("#accountform").on("keyup", "input.numOnly", function(){
    var n = this.value;
    $(this).val(n.replace(/[^\d,.]/g, ''));    
  });

  $("#btnSaveTenant").click(function() {
      SaveTenant();
  });   

  $('#tblLeases tbody').on('click', 'tr', function () {
    // console.log($(this).html());
    var tenantId = $(this).find("input").attr("value");
    $("#leaseform").modal("show");

    // ResetModal("serviceproviderform");
    // $("#leaseform").find("#btnDeleteTransactions").remove();

    GetLease(tenantId);
  });
});