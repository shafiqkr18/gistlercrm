/* Author: Kevin Espaldon
* Date: 3 Mar 2016
* Notes:
* 
*/
var screenname = 'PM';

function debugMode(){
    //debug mode only
    $("#newWorkOrder").click();
    //$("#aUnits").click();

    $("#frm_workorders #unitId").val(5);
    $("#frm_workorders #unitRefNo").val("GIS-PM-0005");
    $("#frm_workorders #unitTitle").val("504 - Odora");
    $("#frm_workorders #serviceProviderId").val("1");
    $("#frm_workorders #serviceProviderRefNo").val("GIS-SP-0001");
    $("#frm_workorders #serviceprovider").val("DecoFarn Utilities");
    $("#frm_workorders #description").val("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dapibus euismod velit laoreet tincidunt. Aliquam tincidunt, nunc at efficitur efficitur, mi orci rutrum metus, lacinia porta tortor erat quis felis.");
    $("#frm_workorders #type").val(1);
    $("#frm_workorders #subtype").val(2);
    $("#frm_workorders #assignedto").val(1);
    $("#frm_workorders #status").val(2);
    $("#frm_workorders #startdate").val("2016-03-03");
    $("#frm_workorders #enddate").val("2016-03-03");
    $("#frm_workorders #cost").val("5,200.5");
    $("#frm_workorders #paidby").val(1);
    $("#frm_workorders #paymentstatus").val(2);
    $("#frm_workorders #priority").val(1);
}

function ResetFields(){
    $("#editWorkOrder").hide();
    $("#cancelWorkOrder").hide();
    
    $("#modaltitle h4").text("Add Work Order");
    $("#unitId").val("");
    $("#unitRefNo").val("");
    $("#divWorkOrderDetails #unitNo").val("");

    $("#frm_workorders #id").val("");
    $("#frm_workorders #dateadded").val("");
    $("#frm_workorders #created_by").val("");
    $("[id=unitTitle]").val("");
    $("[id=serviceProviderId]").val("");
    $("[id=serviceProviderRefNo]").val("");
    $("[id=serviceprovider]").val("");
    $("[id=description]").val("");
    $("[id=type]").val("");
    $("[id=subtype]").val("");
    $("[id=assignedto]").val("");
    $("[id=status]").val("");
    $("[id=startdate]").val("");
    $("[id=enddate]").val("");
    $("[id=cost]").val("");
    $("[id=paidby]").val("");
    $("[id=paymentstatus]").val("");
    $("[id=priority]").val("");

    $("#rand_key").val("");
    $("#ref").val("");  

    $("#divUnitDetails").hide();
    $("#divUnitDetails label").text('');
    $("#divUnitHeader span").show();

    $("#tabNotes").find('*').prop("disabled", true);    
    $("#txtNote").val("");
    $("#divNoteContent").html("");   

    $("#divAccountDetail table tbody").html("");
    $("#divAccountDetail").hide();

    $(".well table").hide();
    $(".well table label").text("");

    GetWorkOrdersHeaderCounts();
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
            $('#tblWorkOrders').DataTable().draw();
        }
    });
}

function GetWorkOrders() {
  var last_id = '';
  oWorkOrdersTable = $('#tblWorkOrders').DataTable({
    "bProcessing": true,
    "sDom": 'R<>rt<ilp><"clear">',
    "aoColumnDefs": [{
      'render': function(data, type, full, meta) {
        //check the main check box
        //$('#check_all_checkboxes').attr('checked', false);
        return '<div style="text-align:center;"><input style="align:center;" type="radio" name="listing" value="' + data + '">  <span class="lbl"></span></div>';
      },
      "aTargets": [0],
      "bSortable": false
    }, {
      //Status
      "aTargets": [2],
      'render': function(data, type, full, meta) {
        // alert(data)
        return _workorder.status[data];
      }
    }, {
      //Priority
      "aTargets": [3],
      'render': function(data, type, full, meta) {
        return _workorder.priority[data];
      }
    }, {
      //Type
      "aTargets": [10],
      'render': function(data, type, full, meta) {
        return _workorder.type[data];
      }
    }, {
      //Subtype
      "aTargets": [11],
      'render': function(data, type, full, meta) {
        switch (data) {
          case "1":
            return "Sub Type 1";
            break;
          case "2":
            return "Sub Type 2";
            break;
          case "3":
            return "Sub Type 3";
            break;
          case "4":
            return "Sub Type 4";
            break;
          case "5":
            return "Sub Type 5";
            break;
          case "6":
            return "Sub Type 6";
            break;
          case "7":
            return "Sub Type 7";
            break;
          default:
            "None";
        }
      }
    }, {
      //Payment Status
      "aTargets": [12],
      'render': function(data, type, full, meta) {
        switch (data) {
          case "1":
            return "Not Paid";
            break;
          case "2":
            return "Paid";
            break;
          default:
            "None";
        }
      }
    }],
    "iDisplayLength": 25,
    "bServerSide": true,
    "sAjaxSource": config.siteUrl + "PM_Common/GetWorkOrders?lease_status=" + $("#ulWorkOrders li.active").val(), //?lease_status=+$("#ulLeases li.active").val(),
    "iDisplayStart": 0,
    "sPaginationType": "full_numbers",
    'fnServerData': function(url, data, callback) {
      //data.type = $("#rgroup_listingtype input[type=radio]:checked").val();

      $.ajax({
        "dataType": 'json',
        "type": "POST",
        "url": config.siteUrl + "PM_Common/GetWorkOrders?lease_status=" + $("#ulWorkOrders li.active").val(), //?lease_status=+$("#ulLeases li.active").val(),
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

  $('.datatable-setbotclass').next().addClass('fixedpagination-bottom');

  $('#txtSmartSearch_workorders').on('keyup', function() {
    oWorkOrdersTable.search(this.value).draw();
  });
}


function GetWorkOrder(workorderID){

    //alert(workorderID);

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


    var workorder = {}, unit = {}, tenant = {}, notes = {}, documents = {}, transactions = {}, sp = {};
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

    // //TODO: fill notes and documents

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

$(document).ready(function(){
	//debugMode();
    ResetFields();
	GetUnits();
    GetWorkOrders();
    GetServiceProviders();

    $("#divWorkOrderDetails :input").prop("readonly", true);

    $('#tblUnits tbody').on('click', 'tr', function () {
        $("#tblUnits tbody tr").removeClass('selected');
        $(this).toggleClass('selected');
        $(this).find("input").prop("checked", true);
        var unitId = $(this).find("input").val();

        // GetUnit(unitId);
        // $("#editUnit").show();
    }); 

    $("#btnSelectUnit").click(function(){
    	var unitId = $("#tblUnits tr.selected input").val();
    	var unitRefNo = $("#tblUnits tr.selected td:eq(2)").text();
    	var unitNumber = $("#tblUnits tr.selected td:eq(3)").text();
    	var subloc = $("#tblUnits tr.selected td:eq(7)").text();

    	$("#frm_workorders #unitId").val(unitId);
    	$("#frm_workorders #unitRefNo").val(unitRefNo);
    	$("#frm_workorders #unitTitle").val(unitNumber + " - " + subloc);
    });

    $("#btnSaveWorkOrder").click(function(){
        SaveWorkOrder();
    });

    $('#tblWorkOrders tbody').on('click', 'tr', function () {
        $("#tblWorkOrders tbody tr").removeClass('selected');
        $(this).toggleClass('selected');
        $(this).find("input").prop("checked", true);
        var workorderID = $(this).find("input").val();
        
        ResetFields();
        $("#txtNote").prop("disabled", false);  
        GetWorkOrder(workorderID);
        $("#cancelWorkOrder").show();
    });         

    $("#ulWorkOrders li").click(function(e){
        e.preventDefault();

        ResetFields();

        $("#ulWorkOrders li").removeClass("active");
        $(this).addClass("active");

        $('#tblWorkOrders').DataTable().draw();

    });   	

    $("#btnSaveNote").click(function(e){
        e.preventDefault();

        var workorderID = $("#id").val();
        var note = $("#txtNote").val();
        var minChars = 5;

        if(note.length == 0){
            alert("Please enter a note.");
        }
        else if(note.length < minChars){
            alert("Please enter a longer note. Min chars is " + minChars + ".");
        }
        else{
            $.ajax({
                type: "POST",
                url: mainurl + "PM_Common/SaveWorkOrderNote",
                data: {
                    'workorderID': workorderID,
                    'note': note},
                datatype: "html",
                success: function(result) {
                    ResetFields();
                    GetWorkOrder(workorderID);
                }
            });
        }
    });

    $("#newWorkOrder, #cancelWorkOrder").click(function(){
        if($.fn.DataTable.isDataTable('#tblWorkOrders')){
            $('#tblWorkOrders').DataTable().draw();              
        }        
        ResetFields();
    });  

    $("#aTenants").click(function(){
        GetServiceProviders();
    });

    $('#tblServiceProviders tbody').on('click', 'tr', function () {
        $("#tblServiceProviders tbody tr").removeClass('selected');
        $(this).toggleClass('selected');
        $(this).find("input").prop("checked", true);
        var serviceproviderId = $(this).find("input").val();
    }); 

    $("#btnSelectServiceProvider").click(function(){
        var spInfo = {};
        spInfo["id"] = $("#tblServiceProviders tr.selected input").val();
        spInfo["ref"] = $("#tblServiceProviders tr.selected td:eq(1)").text();
        spInfo["spName"] = $("#tblServiceProviders tr.selected td:eq(2)").text();
        spInfo["type"] = $("#tblServiceProviders tr.selected td:eq(3)").text();
        spInfo["subtype"] = $("#tblServiceProviders tr.selected td:eq(4)").text();
        spInfo["contactname"] = $("#tblServiceProviders tr.selected td:eq(5)").text();
        spInfo["mobilenumber"] = $("#tblServiceProviders tr.selected td:eq(6)").text();
        spInfo["email"] = $("#tblServiceProviders tr.selected td:eq(7)").text();

        $(".well table").show();

        $("#frm_workorders #serviceProviderId").val(spInfo.id);
        $("#frm_workorders #serviceProviderRefNo").val(spInfo.ref);
        $("#frm_workorders #serviceprovider").val(spInfo.spName);
        $("#frm_workorders #uType").text(spInfo.type);
        $("#frm_workorders #uSubTypes").text(spInfo.subtype);
        $("#frm_workorders #uContact").text(spInfo.contactname);
        $("#frm_workorders #uMobile").text(spInfo.mobilenumber);
        $("#frm_workorders #uEmail").text(spInfo.email);
    });     

});
