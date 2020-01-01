/* Author: Kevin Espaldon
* Date: 24 Feb, 2016
* Notes:
* 
*/

var screenname = 'PM';

function GetCategories(){
    $.ajax({
        type: "POST",
        url: mainurl + "PM_Common/GetCategories",
        success: function(res) {
           $.each(res, function(key, data){

            $("[id=category_id]").append(
                $('<option></option>').val(data["id"]).html(data["category"])
            );
           });
        }
    });
}

function getLocations(regionId){
	$("[id=area_location_id]").html('');

	var snum_dropdown = '';
	snum_dropdown += '<option value="" Selected="selected">Select</option>';

	$.each(location_json_array[regionId], function(locId, locDesc) {
		snum_dropdown += '<option value="' + locId * 1 + '" label="' + locDesc + '">' + locDesc + '</option>';
	});

	$("[id=area_location_id]").append(snum_dropdown);

	//TODO: convert location and sublocation dropdowns to SOL (Nice to have)	
}

function getSubLocations(locationid){
	$("[id=sub_area_location_id]").html('');

	var snum_dropdown = '';
    snum_dropdown += '<option value="" selected="selected">Select</option>';

    $.each(sub_location_json_array[locationid], function(key, val) {
        snum_dropdown += '<option value="'+ key*1 +'" >'+ val +'</option>'; 
    });

    $("[id=sub_area_location_id]").append(snum_dropdown);
}

function getAgents(){
}

function newClickEvent(){
	GetCategories();

    //for the modal box
    $("#adUnit h4").text("Add Unit");
    $("#adUnit #tabnew").text("Add New Unit");
    $("#adUnit #tabimport").show();
}

function debug_fillData(){
	//this series of commands is for debug purposes only. 
	//comment this out later on
	$("#newUnit").click();
	newClickEvent();

	$("#unit").val(1001);
	$("#type").val(1);
	$("#street_no").val(11);
	$("#floor_no").val(40);
	$("#category_id").val(1);

	$("#region_id").val(1);
		getLocations(1);
	$("#area_location_id").val(19);
		getSubLocations(19);
	$("#sub_area_location_id").val(8588);
		//getSubLocations(8588);
	$("#beds").val(2);
	$("#baths").val(1);
	$("#size").val(1200);
	$("#plot_size").val(1500);
	$("#guide_price").val(300);
	$("#fee").val(500);
	$("#prop_furnish").val(1);
	$("#view_id").val("Marina View");
	$("#landlordId").val("Mr. Landlord");
	$("#name").val("Test Title");
	$("#description_demo").val("Test Description");
	$("#agent_id").val(1);
}

function GetListings(){
    var last_id = '';

    //TODO: populate data table
    oListingsTable = $('#listings_row').DataTable({
        "bProcessing": true,
        "sDom": 'R<>rt<ilp><"clear">',
        "aoColumnDefs": [
            {
                'render': function(data, type, full, meta)
                {
                    //check the main check box
                    //$('#check_all_checkboxes').attr('checked', false);
                    return '<div style="text-align:center;"><input style="align:center;" type="radio" name="listing" value="' + data + '">  <span class="lbl"></span></div>';
                },
                "aTargets": [0]
            },
            {
                "bSortable": false,
                "aTargets": [0]
            },
            {
                "aTargets": [1],
                'render': function(data, type, full, meta){
                    return (data == 1)?"Rent":"Sale";
                }
            }
        ],
        // "aoColumns": [
        //     {"mDataProp": "id"},
        //     {"mDataProp": "type"},
        //     {"mDataProp": "status"},
        //     {"mDataProp": "ref"},
        //     {"mDataProp": "unit"},
        //     {"mDataProp": "category"},
        //     {"mDataProp": "region_id"},
        //     {"mDataProp": "area_location_id"},
        //     {"mDataProp": "sub_area_location_id"},
        //     {"mDataProp": "beds"},
        //     {"mDataProp": "size"},
        //     {"mDataProp": "agent_id"},
        //     {"mDataProp": "landlordId"},
        //     {"mDataProp": "dateadded"},
        //     {"mDataProp": "dateupdated"},
        //     {"mDataProp": "user_id"},
        //     {"mDataProp": "key_location"},
        // ],
        // "columns": [
        //     {"data": "id"},
        //     {"data": "type"},
        //     {"data": "status"},
        //     {"data": "ref"},
        //     {"data": "unit"},
        //     {"data": "category"},
        //     {"data": "region_id"},
        //     {"data": "area_location_id"},
        //     {"data": "sub_area_location_id"},
        //     {"data": "beds"},
        //     {"data": "size"},
        //     {"data": "agent_id"},
        //     {"data": "landlordId"},
        //     {"data": "dateadded"},
        //     {"data": "dateupdated"},
        //     {"data": "user_id"},
        //     {"data": "key_location"},
        // ],
        "iDisplayLength": 25,
        "bServerSide": true,
        "sAjaxSource": config.siteUrl + "PM_Common/GetListings?listingType="+$("#rgroup_listingtype input[type=radio]:checked").val(),
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        'fnServerData': function(url, data, callback) {
            data.type = $("#rgroup_listingtype input[type=radio]:checked").val();

            $.ajax({
                "dataType": 'json',
                "type": "POST",
                "url": config.siteUrl + "PM_Common/GetListings?listingType="+$("#rgroup_listingtype input[type=radio]:checked").val(),
                "data": data,
                "success": function(json) {
                    callback(json);
                    // updateUserStatusPanel();;
                    if (last_id > 0) {
                        // $('#listings_row #'+last_id+' td').addClass('yellowCSS');
                    }
                }
            });
        }
    });

    $('.datatable-setbotclass').next().addClass('fixedpagination-bottom');

    // $('#txtSmartSearch').on( 'keyup', function () {
    //   oListingsTable.search( this.value ).draw();
    // } );
}

function GetUnit(unitId){
    //alert(unitId);

    $.ajax({
        type: "POST",
        url: mainurl + "PM_Common/GetUnit",
        data: {
            'unitId': unitId},
        datatype: "html",
        success: function(result) {
            FillUnit(result);
            $(".hiddenbuttons").show();
            // $("#ulActionsDropdown").show();
        }
    });
}

function FillUnit(result){

    var details = {}, photos = {}, currentLease = {}, pastLease = {}, futureLease = {},
    inProgressWO = {}, completedWO = {}, unitNotes = {},
    transactions = {};
    details = result.unitDetails;
    photos = result.unitPhotos;
    currentLease = result.currentLease;
    pastLease = result.previousLease;
    futureLease = result.futureLease;
    inProgressWO = result.inProgressWO;
    completedWO = result.completedWO;
    unitNotes = result.unitNotes;
    transactions = result.transactionDetails

    // $("#adUnit .modal-header h4").text("Edit Unit Ref for " + details.ref);
    //for the modal box
    $("#adUnit h4").text("Edit Unit Ref for " + details.ref);
    $("#adUnit #tabnew").text("Edit Unit");
    $("#adUnit #tabimport").hide();   

    $("#addnewunit").show();
    $("#impfrmlist").hide();

    var unit_status = "";
    switch(details.prop_status){
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

    /*for the other modals*/
    $("[id=unitId").val(details.id);
    $("[id=unitRefNo").val(details.ref);
    $("[id=unitTitle").val(details.unit +" - "+ details.sub_area_location_id);
    // $("#aUnits").hide();

    $("#id").val(details.id);
    $("[id=rand_key]").val(details.rand_key);
    $("[id=ref]").val(details.ref);
    $("[id=dateadded]").val(details.dateadded);
    $("[id=created_by]").val(details.created_by);

    $("[id=unit]").val(details.unit);
    $("[id=type]").val(details.type);
    $("[id=street_no]").val(details.street_no);
    $("[id=floor_no]").val(details.floor_no);
    $("[id=prop_status]").val(details.prop_status);
    $("[id=category_id]").val(details.category_id);
    $("[id=region_id]").val(details.region_id);
    getLocations(details.region_id)
    $("[id=area_location_id]").val(details.loc_id);
    getSubLocations(details.loc_id);
    $("[id=sub_area_location_id]").val(details.sub_loc_id);
    $("[id=beds]").val(details.beds);
    $("[id=baths]").val(details.baths);
    $("[id=size]").val(details.size);
    $("[id=plot_size]").val(details.plot_size);
    $("[id=guide_price]").val(details.guide_price);
    $("[id=fee]").val(details.fee);
    $("[id=prop_furnish]").val(details.prop_furnish);
    $("[id=view_id]").val(details.view_id);

    $("[id=landlordId]").val(details.landlordId);
    $("[id=landlordname]").val(details.landlord_name);
    $("[id=name]").val(details.name);
    $("[id=description_demo]").val(details.description_demo);

    $("[id=view_id").val(details.view_id);

    $("[id=agent_id").val(details.agent_id);

    $("#divUnitDetails #unitPhotos").html('');

    if(photos.length > 0){
        $.each(photos, function(key, value){
           
            //alert(value.image);
            var link = mainurl + "uploads/PM/documents/"
            + $("#hdnClientId").val() + "/"
            + value.image;

            var img = "<a href="+ link
            +" target='_blank'><img src='" + link
            + "' height='40px' maxwidth='40px'/></a>";

            $("#divUnitDetails #unitPhotos").append(img);
        });        
    }

    if(Object.keys(currentLease).length > 0){
        $("#divCurrentLeasesHeader span").hide();

        var $current = $("#divCurrentLeasesDetails");
        $current.show();
        $current.find("table body label").html("");

        $current.find("#uRef").text(currentLease.ref);
        $current.find("#uTenant").text(currentLease.tenant);
        $current.find("#uLeaseAmount").text(currentLease.leaseamount);
        $current.find("#uCommission").text(currentLease.commission);
        $current.find("#uEndDate").text(currentLease.enddate);
        $current.find("#tdView a").attr("data-id", currentLease.id);
    }

    if(Object.keys(pastLease).length > 0){
        $("#divPreviousLeasesHeader span").hide();

        var $past = $("#divPreviousLeasesDetails");
        $past.show();
        $past.find("table body label").html("");

        $past.find("#uRef").text(pastLease.ref);
        $past.find("#uTenant").text(pastLease.tenant);
        $past.find("#uLeaseAmount").text(pastLease.leaseamount);
        $past.find("#uCommission").text(pastLease.commission);
        $past.find("#uEndDate").text(pastLease.enddate);
        $past.find("#tdView a").attr("data-id", pastLease.id);
    }

    if(Object.keys(futureLease).length > 0){
        $("#divFutureLeasesHeader span").hide();

        var $future = $("#divFutureLeasesDetails");
        $future.show();
        $future.find("table body label").html("");

        $future.find("#uRef").text(futureLease.ref);
        $future.find("#uTenant").text(futureLease.tenant);
        $future.find("#uLeaseAmount").text(futureLease.leaseamount);
        $future.find("#uCommission").text(futureLease.commission);
        $future.find("#uEndDate").text(futureLease.enddate);
        $future.find("#tdView a").attr("data-id", futureLease.id);
    }    

    if(inProgressWO.length > 0){
        $("#divInProgrressWODetail label").text('');
        $("#divInProgrressWODetail").show();
        $("#divInProgrressWOHeader span").hide();
        var row = "";
        $.each(inProgressWO, function(key, val){
            row = "<tr id="+val.id+">"+
                "<td>"+ key +"</td>"+
                "<td><a href='#' class='openWOForm' data-toggle='modal' data-id="+val.id+" data-target='#workorderform'>"+val.ref+"</a></td>"+
                "<td>"+_workorder.subtype[val.type][val.subtype]+"</td>"+
                "<td>"+val.cost+"</td>"+
                "<td>"+val.serviceprovidername+"</td>"+
                "<td>"+_workorder.priority[val.priority]+"</td>"+
                "<td>"+val.enddate+"</td>"+
            "</tr>"; 

            $("#divInProgrressWODetail table tbody").append(row);   
        });
    }

    if(completedWO.length > 0){
        $("#divCompletedWODetail label").text('');
        $("#divCompletedWODetail").show();
        $("#divCompletedWOHeader span").hide();
        var row = "";
        $.each(completedWO, function(key, val){
            row = "<tr id="+val.id+">"+
                "<td>"+ key +"</td>"+
                "<td><a href='#' class='openWOForm' data-toggle='modal' data-id="+val.id+" data-target='#workorderform'>"+val.ref+"</a></td>"+
                "<td>"+_workorder.subtype[val.type][val.subtype]+"</td>"+
                "<td>"+val.cost+"</td>"+
                "<td>"+val.serviceprovidername+"</td>"+
                "<td>"+_workorder.priority[val.priority]+"</td>"+
                "<td>"+val.enddate+"</td>"+
            "</tr>";  

            $("#divCompletedWODetail table tbody").append(row);   
        });
    }

    if(unitNotes.length > 0){

        unitNotes = unitNotes.sort(function(a, b){return b-a});
        
        $.each(unitNotes, function(i, noteArray){
            var note = '<div id="'+noteArray.id+'">'+
            '<label><i>'+noteArray.datecreated+'</i></label>'+
            '<p align="left"><strong>'+noteArray.note+'</strong></p>'+
            '<hr></div>';

            $("#divNoteContent").append(note);
        }); 
    }

    /*
    //$("#showDocuments").append('
    <div id="doc_div_'+data+'">
        <div style="border-bottom:#999 dashed 1px; padding: 0px 0px 5px 0px; margin: 5px 5px 0px 5px;" >
            <div style="display:inline-block;" id="shafi_'+data+'" >'+$('#listings_documents').val()+'
            </div>
            <div  style="display:inline-block; float:right;">
            </div>
            <div  style="display:inline-block; float:right;">
                <a href="<?php echo base_url();?>uploads/PM/documents/<?php echo $this->session->userdata('client_id');?>/'+data+'" target="_blank">
                    Download
                </a> | 
                <a id='+data+' name='+data+' class="delete_list" href="# S"> Delete 
                </a>
            </div>
        </div>
    </div>');
    */

    $("#frm").slideDown(600);
}

function GetTransactionsPerUnit(unitId){
    if($.fn.DataTable.isDataTable('[id=tblTransactions]')){
      $('[id=tblTransactions]').DataTable().destroy();
    }
  // else{
    var last_id = '';
    oTransactionsTable = $('[id=tblTransactions]').DataTable({
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
      "bServerSide": true,
      "sAjaxSource": config.siteUrl + "PM_Common/GetTransactionsPerUnit?unitId=" + unitId,
      "iDisplayStart": 0,
      "sPaginationType": "full_numbers",
      'fnServerData': function(url, data, callback) {
        //data.type = $("#rgroup_listingtype input[type=radio]:checked").val();

        $.ajax({
          "dataType": 'json',
          "type": "POST",
          "url": config.siteUrl + "PM_Common/GetTransactionsPerUnit?unitId=" + unitId,
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

    $('.datatable-setbotclass').next().addClass('fixedpagination-bottom');

    $('#txtSmartSearch_Transactions').on('keyup', function() {
      oTransactionsTable.search(this.value).draw();
    });
  // }
}

function SaveUnit(){

    var objUnit = {};

    if($("#nav li:eq(0)").hasClass("active")){
        var parameters = jQuery('#frm_unit').serializeArray();//JSON.parse(JSON.stringify(jQuery('#frm_unit').serializeArray()));// ;

        //var arr = parameters.split('&');

        $.each(parameters, function() {
            objUnit[this.name] = this.value;
        });

        $.ajax({
            type: "POST",
            url: mainurl + "PM_Common/SaveNewUnit/",// + parameters,
            data: {
                'objUnit': objUnit},
            datatype: "object",
            success: function(res) {
                ResetFields();
                $('#tblUnits').DataTable().draw();
                GetUnit(objUnit.id);
            }
        });            
    }
    else{
        var listingID = $('#listings_row input[name=listing]:checked').val();
        //alert(listingID);
        //TODO: call ajax function to get data with given listing ID and save to units table

        $.ajax({
            type: "POST",
            url: mainurl + "PM_Common/ImportUnit",
            data: {
                'listingID': listingID},
            datatype: "html",
            success: function(res) {
                ResetFields();
               $('#tblUnits').DataTable().draw();
            }
        });            
    }
}

function ResetFields(){
    //$("#frm_unit").find('*').val("");
    $("[id=id]").val("");
    $("[id=rand_key]").val("");
    $("[id=ref]").val("");
    $("[id=dateadded]").val("");
    $("[id=created_by]").val("");
    $("[id=type]").val("");
    $("[id=unit]").val("");
    $("[id=street_no]").val("");
    $("[id=floor_no]").val("");
    $("[id=prop_status]").val("");
    $("[id=category_id]").val("");
    $("[id=region_id]").val(0);
    $("[id=area_location_id]").val("");
    $("[id=sub_area_location_id]").val("");
    $("[id=beds]").val("");
    $("[id=baths]").val("");
    $("[id=size]").val("");
    $("[id=plot_size]").val("");
    $("[id=guide_price]").val("");
    $("[id=fee]").val("");
    $("[id=prop_furnish]").val("");
    $("[id=view_id]").val("");
    $("[id=landlordId]").val("");
    $("[id=landlordname]").val("");
    $("[id=name]").val("");
    $("[id=description_demo]").val("");

    $("#unitPhotos").html("");
    $(".hiddenbuttons").hide();

    $("#divCurrentLeasesHeader span").show();
    $("#divPreviousLeasesHeader span").show();
    $("#divFutureLeasesHeader span").show();
    $("#divInProgrressWOHeader span").show();
    $("#divCompletedWOHeader span").show();

    $("#divCurrentLeasesDetails").hide();
    $("#divPreviousLeasesDetails").hide();
    $("#divFutureLeasesDetails").hide();
    $("#divInProgrressWODetail").hide();
    $("#divInProgrressWODetail").hide();

    $("#divCurrentLeasesDetails table tbody label").val("");
    $("#divPreviousLeasesDetails table tbody label").val("");
    $("#divFutureLeasesDetails table tbody label").val("");    

    $("#divInProgrressWODetail table tbody").html("");
    $("#divCompletedWODetail table tbody").html("");

    $("#tabNotes :input").val("");
    $("#divNoteContent").html("");

    // $("#ulActionsDropdown").hide();

    /*for the other modals*/
    $("[id=unitId").val("");
    $("[id=unitRefNo").val("");
    $("[id=unitTitle").val("");
    // $("#aUnits").hide();

    GetUnitsHeaderCounts();
    //$("#frm").slideUp(600);
}

function SetTransactionType(transactiontype){
    // $("[id=btnPIn]").removeClass();
    // $("[id=btnPOut]").removeClass();

    if(transactiontype == 1){
        $("[id=btnPIn]").addClass("btn-info");
        $("[id=btnPIn]").addClass("selected");
        $("[id=btnPOut]").removeClass("btn-danger");
        $("[id=btnPOut]").removeClass("selected");

        $("#type").val(this.value);
    }
    else if(transactiontype == 2){
        $("[id=btnPOut]").addClass("btn-danger");
        $("[id=btnPOut]").addClass("selected");
        $("[id=btnPIn]").removeClass("btn-info");
        $("[id=btnPIn]").removeClass("selected");

        $("#type").val(this.value);
    }
    else{
       $("[id=btnPIn]").addClass("btn");
       $("[id=btnPIn]").addClass("btn-info");
       $("[id=btnPOut]").addClass("btn");
       $("[id=btnPOut]").addClass("btn-danger");        
   }
}


$(document).ready(function(){

    //debug_fillData();
    $("#divUnitDetails").find("*").prop("disabled", true);
    $("#tabNotes :input").prop("readonly", true);

    var oUnitsTable, oListingsTable;

    GetUnits();
    GetListings();
    GetCategories();

    ResetFields();

    $("#newUnit").click(function(){
        //for the modal box
        $("#adUnit h4").text("Add Unit");
        $("#adUnit #tabnew").text("Add New Unit");
        $("#adUnit #tabimport").show();

        $("#editUnit").hide();

        ResetFields();

        // if($.fn.DataTable.isDataTable('#tblUnits'))
        //     $('#tblLandlords').DataTable().draw();
    });

    $("#editUnit").click(function(){

    });

    $("#region_id").change(function(){
    	getLocations(this.value);
    });

    $("#area_location_id").change(function(){
    	getSubLocations(this.value);
    });

    $(".ListingType, #tabimport").click(function(){
       $('#listings_row').DataTable().draw();
    });

    //Rent | Sale radio buttons
    $(".UnitsListingType").click(function(){
       $("#tblUnits").DataTable().draw();
    });

    $('#listings_row tbody').on('click', 'tr', function () {
        $("#listings_row tbody").removeClass('selected');
        $(this).addClass('selected');
        $(this).find("input").prop("checked", true);
    });    

    $('#tblUnits tbody').on('click', 'tr', function () {
        
        
        var unitId = $(this).find("input").val();
        $("#unitform #id").val(unitId);
        ResetFields();
        $("#ulActionsDropdown").show();
        $("#tabNotes :input").prop("readonly", false);

        GetUnit(unitId);
        $("#cancelUnit").show();
    });     

    $("#btnSelectLandlord").click(function(){
        var landlordId = $("#tblLandlords tr.selected input").val();
        var firstname = $("#tblLandlords tr.selected td:eq(2)").text();
        var lastname = $("#tblLandlords tr.selected td:eq(3)").text();

        $("[id=landlordId]").val(landlordId);
        $("[id=landlordname]").val(firstname + " " + lastname);
    });

    $("#btnSave").click(function(){
        SaveUnit();
    });

    $("#btnSaveLease").click(function(){
        SaveLease();
    });  

    $("#btnSaveWorkOrder").click(function(){
        SaveWorkOrder();
    });    

    $("#ulUnits li").click(function(e){
        e.preventDefault();

        $("#ulUnits li").removeClass("active");
        $(this).addClass("active");

        GetUnits();
    });

    $("#cancelUnit").click(function(){
        if($.fn.DataTable.isDataTable('#tblUnits')){
            $('#tblUnits').DataTable().draw();              
        }

        ResetFields();
        $("#frm").slideUp(400);
        $("#tblUnits tbody input").prop('checked', false);
    });

    $("#btnSaveNote").click(function(e){
        e.preventDefault();

        var unitId = $("#id").val();
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
                url: mainurl + "PM_Common/SaveUnitNote",
                data: {
                    'unitId': unitId,
                    'note': note},
                datatype: "html",
                success: function(result) {
                    //ResetFields();
                    GetUnit(unitId);
                }
            });
        }
    });

    // $("#btnSelectTenant").click(function(){
    //     var $row = $("#tblTenants tbody").find("tr.selected");

    //     var tenantId = $row.find("input").val();

    //     GetTenant(tenantId);
    // });   

    $('#accountform').on("show.bs.modal", function (e) {
        $("#accountform div.modal-header h4").html("Manage transaction records for " + $("#unitTitle").val());
        GetTransactionsPerUnit($("#id").val());
    });    

    $("#recentview").on("click", ".openWOForm", function(){
        var woId = $(this).data('id');
        GetWorkOrder(woId);
    });

    $("#tabpersonal, #tabwork, #tabother").on("click", ".openLeaseForm", function(){
        var woId = $(this).data('id');
        GetLease(woId);
    });

    $("#btnPIn").click(function() {
        SetTransactionType(this.value);
    });

    $("#btnPOut").click(function() {
        SetTransactionType(this.value);
    });   

    $(".btntoolbar").click(function(e){
        e.preventDefault();
        var id = this.id;

        if(id == "lease"){
            $("#uLeaseMenu").toggle();
        }
    });


});
