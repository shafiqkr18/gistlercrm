/* Author: Kevin Espaldon
 * Date: 10 Mar 2016
 * Notes:
 * $("#divTransactionType button.selected").val()
 */

 var screenname = 'PM';

function debugMode() {
    $("#newTransaction").click();

    $("#frm_accounts #leaseId").val("1");
    $("#frm_accounts #leaseTitle").val("GIS-LE-0023");
    $("#frm_accounts #unitId").val("1");
    $("#frm_accounts #unitRefNo").val("GIS-UN-0011");
    $("#frm_accounts #unitTitle").val("1001 - JA Oasis Beach Tower");
    $("#frm_accounts #landlord").val("Jon Snow");
    $("#frm_accounts #paymenttype").val("1");
    $("#frm_accounts #subtype").val("2");
    $("#frm_accounts #from").val("1");
    $("#frm_accounts #to").val("2");
    $("#frm_accounts #amount").val("2300");
    $("#frm_accounts #mode").val("2");
    $("#frm_accounts #status").val("1");
    $("#frm_accounts #memo").val("Test Memo");
}

function ResetFields() {

    $("#editTransaction").hide();
    $("#cancelTransaction").hide();
    
    $("#modaltitle h4").text("Add Transaction Information");
    $("[id=unitNo]").val("");
    $("[id=unitId]").val("");
    $("[id=unitRefNo]").val("");
    $("[id=id]").val("");
    $("[id=dateadded]").val("");
    $("[id=created_by]").val("");
    $("[id=unitTitle]").val("");
    $("[id=leaseId]").val("");
    $("[id=type]").val("");
    $("[id=subtype]").val("");
    $("[id=from]").val("");
    $("[id=to]").val("");
    $("[id=amount]").val("");
    $("[id=mode]").val("");
    $("[id=status]").val("");
    $("[id=memo]").val("");
    $("[id=dateupdated]").val("");
    $("[id=dateadded]").val("");
    $("[id=landlord]").val("");
    $("[id=leaseId]").val("");
    $("[id=leaseTitle]").val("");

    $("#rand_key").val("");
    $("[id=ref]").val("");
    $("[id=createdby]").val("");

    SetTransactionType(0);

    $("#divUnitDetails").hide();
    $("#divUnitDetails label").text('');
    $("#divUnitHeader span").show();

    $("#divLeaseDetails").hide();
    $("#divLeaseDetails label").text('');
    $("#divLeaseHeader span").show();   

    $("#tabNotes").find('*').prop("disabled", true);    
    $("#txtNote").val("");
    $("#divNoteContent").html(""); 

    GetAccountsHeaderCounts();
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

function SaveTransaction() {
    var objTransaction = {};
    var parameters = jQuery('#frm_accounts').serializeArray();
    //var arr = parameters.split('&');

    $.each(parameters, function() {
        objTransaction[this.name] = this.value;
    });

    // $.each(arr, function(index, pair) {
    //     var pairArray = pair.split('=');
    //     //alert("key----> " + pairArray[0] +" | val----> " + pairArray[1]);
    //     objTransaction[pairArray[0]] = pairArray[1];
    // });

    objTransaction["transactiontype"] = $("#divTransactionType button.selected").val();

    $.ajax({
        type: "POST",
        url: mainurl + "PM_Common/SaveTransaction/",
        data: {
            'objTransaction': objTransaction
        },
        datatype: "object",
        success: function(res) {
            ResetFields();
            $("#tblTransactions").DataTable().draw();
        }
    });
}

function FillTransaction(result) {

    var transaction = {}, unit = {}, tenant = {}, lease = {}, notes = {}, documents = {};
    unit = result.unitDetails;
    transaction = result.transactionDetails;
    tenant = result.tenantDetails;
    lease = result.leaseDetails;
    notes = result.accountNotes;

    /* [dev note] Habibi, why use [id=idname] instead of #idname?
     * #idname matches the first instance of this id,
     * when [id=idname] matches ALL instances of this id.
     * i needed to use the latter because we have two controls, 
     * one for the main page where you view data, 
     * and one modal box to update it.
     ------------------------------------------------------------------*/
     $("#modaltitle h4").text("Update Work Order for " + transaction.ref);
     $("#divTransactionDetails #unitNo").val(transaction.unit);
     $("#unitId").val(unit.unitId);
     $("#unitRefNo").val(unit.unitRefNo);
     $("#frm_accounts #id").val(transaction.id);
     $("#frm_accounts #dateadded").val(transaction.dateadded);
     $("#frm_accounts #created_by").val(transaction.created_by);
     $("[id=unitId]").val(unit.unitId);
     $("[id=unitRefNo]").val(unit.unitRefNo);
     $("[id=unitTitle]").val(transaction.unit + " - " + unit.SubLocation);
     $("[id=type]").val(transaction.type);
     $("[id=subtype]").val(transaction.subtype);
     $("[id=from]").val(transaction.from);
     $("[id=to]").val(transaction.to);
     $("[id=amount]").val(transaction.amount);
     $("[id=mode]").val(transaction.mode);
     $("[id=status]").val(transaction.status);
     $("[id=memo]").val(transaction.memo);
     $("[id=dateupdated]").val(transaction.dateupdated);
     $("[id=dateadded]").val(transaction.dateadded);
     $("[id=landlord]").val(unit.Owner);
     $("[id=leaseId]").val(lease.leaseId);
     $("[id=leaseTitle]").val(lease.ref);

     $("#rand_key").val(transaction.rand_key);
     $("[id=ref]").val(transaction.ref);
     $("[id=createdby]").val(transaction.CreatedBy);

     SetTransactionType(transaction.transactiontype);
    //TODO: payment in and out on fill


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

    $("#divLeaseDetails label").text('');
    $("#divLeaseDetails").show();
    $("#divLeaseHeader span").hide();

    //lease details
    $("#uName").text(tenant.firstname + " " + tenant.lastname);
    $("#uNationality").text(tenant.nationality);
    $("#uStartDate").text(lease.startdate);
    $("#uEndDate").text(lease.enddate);
    $("#uLeaseAmount").text(lease.leaseamount);
    $("#uFeePercentage").text(lease.fees_percentage);
    $("#uFeeAmount").text(lease.fees_amount);
    $("#uPaymentMode").text(_account.mode[lease.paymentmode]);
    $("#uPaymentTerms").text(_account.paymentterm[lease.paymentterm]);
    $("#uStatus").text(_account.ejaristatus[lease.ejaristatus]);


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


    // $.each(documents, function(i, documentArray){
    // 	var doc = '<div id="'+documentArray.id+'">'+documentArray.dateUploaded+'</div>'+
    // 	'<div class="row">'+
    // 	'<div class="col-md-7">'+
    // 	'<label><strong>'+documentArray.filename+'</strong></label>'+
    // 	'</div>'+
    // 	'<div class="col-md-5">'+
    // 	'<label><a href="#">View</a> | <a href="#">Delete</a></label>'+
    // 	'</div>'+
    // 	'</div>';

    // 	$("#documents").append(doc);
    // }); 

    // //TODO: convert Unit Details into a table and color odd-numbered rows
    // // $("#divUnitDetails ul li").each(function(i){
    // //     if(i%2)
    // //         alert(i);
    // // });    
}

//use in the future
function GetDropdownData(selectId){

    var object = {};

    $("#"+selectId+" option").each(function(){
        object[$(this).val()] = $(this).text();
    });
    return object;
}

$(document).ready(function() {

    // debugMode();
    ResetFields();
    GetUnits();
    GetTransactions();

    $("#divTransactionDetails").find("*").prop("disabled", true);

    $("[id=btnPIn]").click(function() {
        SetTransactionType(this.value);
    });

    $("[id=btnPOut]").click(function() {
        SetTransactionType(this.value);
    });

    $("#ulAccounts li").click(function(e){
        e.preventDefault();

        $("#ulAccounts li").removeClass("active");
        $(this).addClass("active");

        $('#tblTransactions').DataTable().draw();
    });    

    $("#btnSelectUnit").click(function() {
        var unitId = $("#tblUnits tr.selected input").val();
        var unitRefNo = $("#tblUnits tr.selected td:eq(2)").text();
        var unitNumber = $("#tblUnits tr.selected td:eq(3)").text();
        var subloc = $("#tblUnits tr.selected td:eq(7)").text();
        var owner = $("#tblUnits tr.selected td:eq(12)").text();

        $("#frm_accounts #unitId").val(unitId);
        $("#frm_accounts #unitRefNo").val(unitRefNo);
        $("#frm_accounts #unitTitle").val(unitNumber + " - " + subloc);
        $("#frm_accounts #landlord").val(owner);
    });

    $("#btnSaveTransaction").click(function() {
        SaveTransaction();
    });

    $('#tblTransactions tbody').on('click', 'tr', function() {
        $("#tblTransactions tbody tr").removeClass('selected');
        $(this).toggleClass('selected');
        $(this).find("input").prop("checked", true);
        var transactionId = $(this).find("input").val();

        ResetFields();
        GetTransaction(transactionId);
        $("#cancelTransaction").show();
    });

    $("#newTransaction, #cancelTransaction").click(function() {
      if($.fn.DataTable.isDataTable('#tblTransactions')){
        $('#tblTransactions').DataTable().draw();
      }
      ResetFields();
    });

    $("#btnSaveNote").click(function(e){
        e.preventDefault();

        var transactionId = $("#id").val();
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
                url: mainurl + "PM_Common/SaveTransactionNote",
                data: {
                    'transactionId': transactionId,
                    'note': note},
                datatype: "html",
                success: function(result) {
                    ResetFields();
                    GetTransaction(transactionId);
                }
            });
        }
    });    

});