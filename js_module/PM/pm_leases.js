/* Author: Kevin Espaldon
* Date: 3 Mar 2016
* Notes:
* 
*/
var screenname = 'PM';


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

    var lease = {}, unit = {}, tenant = {}, notes = {}, documents = {};
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
    $("[id=tenantId]").val(tenant.id);
    $("[id=tenantName]").val(tenant.firstname + " " + tenant.lastname);
    $("[id=tName]").text(tenant.firstname + " " + tenant.lastname);
    $("[id=tMobile]").text(tenant.countrycode1 + tenant.mobilenumber1);
    $("[id=tEmail]").text(tenant.email);
    $("[id=tNationality]").text(tenant.nationality);
    $("[id=tDOB]").text(tenant.dob);
    $("[id=startdate]").val(lease.startdate);
    $("[id=enddate]").val(lease.leaseamount);
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

    // //TODO: fill notes and documents
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

function ResetFields(){
	$("#editLease").hide();
	$("#cancellease").hide();
	$("#modaltitle h4").text("Add Lease");
	$("#divLeaseDetails #unitNo").val("");
	$("#unitId").val("");
	$("#unitRefNo").val("");
	$("[id=unitTitle]").val("");
	$("[id=tenantId]").val("");
	$("[id=tenantName]").val("");
	$("[id=tName]").text("--");
	$("[id=tMobile]").text("--");
	$("[id=tEmail]").text("--");
	$("[id=tNationality]").text("--");
	$("[id=tDOB]").text("--");
	$("[id=startdate]").val("");
	$("[id=enddate]").val("");
	$("[id=leaseamount]").val("");
	$("[id=deposit_percentage]").val("");
	$("[id=deposit_amount]").val("");
	$("[id=fees_percentage]").val("");
	$("[id=fees_amount]").val("");
	$("[id=commission]").val("");
	$("[id=paymentmode]").val("");
	$("[id=paymentterm]").val("");
	$("[id=cheques]").val("");
	$("[id=sourceoftenancy]").val("");
	$("[id=depositheldby]").val("");
	$("[id=ejaristatus]").val("");
	$("[id=ejarinumber]").val("");
	$("[id=reminder]").val("");

	$("#rand_key").val("");
	$("#ref").val("");	

	$("#divUnitDetails").hide();
	$("#divUnitDetails label").text('');
	$("#divUnitHeader span").show();

	$("#tabNotes").find('*').prop("disabled", true);	

	$("#txtNote").val("");
	$("#notes").html("");
}

function debugMode(){
	//debug mode only
	$("#newLease").click();
	//$("#aUnits").click();

	$("#frm_lease #unitId").val(1);
	$("#frm_lease #unitRefNo").val("GIS-PM-0001");
	$("#frm_lease #unitTitle").val("1107 - Murjan 1");
	$("#frm_lease #tenantId").val(1);
	$("#frm_lease #tenantName").val("Jon Snow");
	$("#frm_lease #startdate").val("2016-03-03");
	$("#frm_lease #enddate").val("2016-03-03");
	$("#frm_lease #deposit_percentage").val(5);
	$("#frm_lease #deposit_amount").val(25000);
	$("#frm_lease #ejaristatus").val(1);
	$("#frm_lease #cheques").val(3);
	$("#frm_lease #leaseamount").val(12000);
	$("#frm_lease #paymentmode").val(1);
	$("#frm_lease #depositheldby").val(1);
	$("#frm_lease #ejarinumber").val(1234687);
	$("#frm_lease #reminder").val(5);
	$("#frm_lease #fees_percentage").val(3);
	$("#frm_lease #fees_amount").val(1000);
	$("#frm_lease #paymentterm").val(1);
	$("#frm_lease #sourceoftenancy").val(1);
	$("#frm_lease #commission").val(3000);

	$("#frm_lease #tenandId").val(2);
	$("#frm_lease #tenantName").val("Bran Stark");
}

$(document).ready(function(){

	//debugMode();

	GetUnits();
	GetLeases();

	$("#divLeaseDetails").find('*').prop("disabled", true);

    $('#tblUnits tbody').on('click', 'tr', function () {
        $("#tblUnits tbody tr").removeClass('selected');
        $(this).toggleClass('selected');
        $(this).find("input").prop("checked", true);
        var unitId = $(this).find("input").val();

        // GetUnit(unitId);
        // $("#editUnit").show();
    });  

    $('#tblLeases tbody').on('click', 'tr', function () {
        $("#tblLeases tbody tr").removeClass('selected');
        $(this).toggleClass('selected');
        $(this).find("input").prop("checked", true);
        var leaseId = $(this).find("input").val();
        
        $("#frm").slideDown(600);
        
        ResetFields();
        GetLease(leaseId);
        $("#cancellease").show();
    });
    
    $("#ulLeases li").click(function(e){
	    e.preventDefault();

	    $("#ulLeases li").removeClass("active");
	    $(this).addClass("active");

	    $('#tblLeases').DataTable().draw();
    });

    $("#btnSelectUnit").click(function(){
    	var unitId = $("#tblUnits tr.selected input").val();
    	var unitRefNo = $("#tblUnits tr.selected td:eq(2)").text();
    	var unitNumber = $("#tblUnits tr.selected td:eq(3)").text();
    	var subloc = $("#tblUnits tr.selected td:eq(7)").text();

    	$("#frm_lease #unitId").val(unitId);
    	$("#frm_lease #unitRefNo").val(unitRefNo);
    	$("#frm_lease #unitTitle").val(unitNumber + " - " + subloc);
    });

	$("#btnSaveLease").click(function(){
        SaveLease();
    });    

    $("#newLease, #cancellease").click(function(){

        if($.fn.DataTable.isDataTable('#tblLeases')){
            $('#tblLeases').DataTable().draw();
        }
        
		ResetFields();
    });

    $("#btnSaveNote").click(function(e){
    	//insert/update note to table then redraw notes.
        e.preventDefault();

		var leaseId = $("#id").val();
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
		        url: mainurl + "PM_Common/SaveLeaseNote",
		        data: {
		            'leaseId': leaseId,
		            'note': note},
		        datatype: "html",
		        success: function(result) {
		        	ResetFields();
		        	GetLease(leaseId);
		        }
		    });
		}
	});

	$("#btnSaveDocument").click(function(){

	});

    $("#aTenants").click(function(){
        GetTenants();
    });

    $("#btnSelectTenant").click(function(){
        var tenantInfo = {};
        tenantInfo["id"] = $("#tblTenants tr.selected input").val();
        tenantInfo["ref"] = $("#tblTenants tr.selected td:eq(1)").text();
        tenantInfo["firstname"] = $("#tblTenants tr.selected td:eq(2)").text();
        tenantInfo["lastname"] = $("#tblTenants tr.selected td:eq(3)").text();
        tenantInfo["mobile"] = $("#tblTenants tr.selected td:eq(4)").text();
        tenantInfo["dob"] = $("#tblTenants tr.selected td:eq(5)").text();
        tenantInfo["email"] = $("#tblTenants tr.selected td:eq(6)").text();
        tenantInfo["nationality"] = $("#tblTenants tr.selected td:eq(7)").text();

        $("#frm_lease #tName").text(tenantInfo.firstname + " " + tenantInfo.lastname);
        $("#frm_lease #tMobile").text(tenantInfo.mobile);
        $("#frm_lease #tEmail").text(tenantInfo.email);
        $("#frm_lease #tNationality").text(tenantInfo.nationality);
        $("#frm_lease #tDOB").text(tenantInfo.dob);
        $("#frm_lease #tenantId").val(tenantInfo.id);
        $("#frm_lease #tenantName").val(tenantInfo.firstname + " " + tenantInfo.lastname);
    });    

});