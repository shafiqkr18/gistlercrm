/* Author: Kevin Espaldon
* Date: 17 Mar 2016
* Notes:
* 
*/


var screenname = 'PM';

function debugMode(){
	$("#newServiceProvider").click();

	$("#frm_serviceprovider #ref").val('');
	$("#frm_serviceprovider #serviceprovidername").val('Deco Farm');
	$("#frm_serviceprovider #type").val(1);
	$("#frm_serviceprovider #subtypes").val(2);
	$("#frm_serviceprovider #address").val('Office 101, Amwaj 4, JBR');
	$("#frm_serviceprovider #firstname").val('Morti');
	$("#frm_serviceprovider #lastname").val('Bhai');
	$("#frm_serviceprovider #countrycode1").val(971); 
	$("#frm_serviceprovider #mobilenumber1").val('504648484');
	$("#frm_serviceprovider #email").val('bossmorty@decofarn.ae');	
}

function ResetFields(){
	$("#editServiceProvider").hide();
	$("#cancelServiceProvider").hide();
	$("[id=ref]").val('');
	$("[id=serviceprovidername]").val('');
	$("[id=type]").val('');
	$("[id=subtypes]").val('')
	$("[id=address]").val('');
	$("[id=firstname]").val('');
	$("[id=lastname]").val('');
	$("[id=countrycode1]").val(''); 
	$("[id=mobilenumber1]").val('');
	$("[id=email]").val('');
    $("#mobilenumbertitle").val('');

    $("#divWorkOrderInProgressHeader span").show();
    $("#divWorkOrderInProgressDetails").hide();
    $("#divWorkOrderInProgressDetails table tbody").html('');

    $("#divWorkOrderCompletedHeader span").show();
    $("#divWorkOrderCompletedDetails").hide();
    $("#divWorkOrderCompletedDetails table tbody").html('');

    $("#divAllTransactionsdHeader span").show();
    $("#divAllTransactionsDetails").hide();
    $("#divAllTransactionsDetails table tbody").html('');

    $("#divPendingTransactionsHeader span").show();
    $("#divPendingTransactionsDetails").hide();
    $("#divPendingTransactionsDetails table tbody").html('');

    $("#divPaidTransactionsHeader span").show();
    $("#divPaidTransactionsDetails").hide();
    $("#divPaidTransactionsDetails table tbody").html('');

    $("#editServiceProvider").hide();
    $("#cancelServiceProvider").hide();

    $("#tabNotes").find('*').prop("disabled", true);    
    $("#txtNote").val("");
    $("#divNoteContent").html("");
}

function SaveServiceProvider(){
    var objServiceProvider = {};
    var parameters = jQuery('#frm_serviceprovider').serializeArray();
    // var arr = parameters.split('&');

    $.each(parameters, function() {
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
            ResetFields();
            $('#tblServiceProviders').DataTable().draw();
        }
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

            $("#editServiceProvider").show();
            $("#cancelServiceProvider").show();
            $("#tabNotes").find('*').prop("disabled", false)
        }
    });
}

function FillServiceProvider(result){

    var sp = {}, wInProgress = {}, wCompleted = {}, alltransactions = {}, pendingTransactions = {}, paidTransactions = {}, notes = {}, documents = {};
    
    sp = result.spDetails;
    wInProgress = result.workOrderInProgress;
    wCompleted = result.workOrderCompleted;
    alltransactions = result.allTransactions;
    pendingTransactions = result.pendingTransactions;
    paidTransactions = result.paidTransactions;
    notes = result.spNotes;

    /* [dev note] Habibi, why use [id=idname] instead of #idname?
	 * #idname matches the first instance of this id,
	 * when [id=idname] matches ALL instances of this id.
	 * i needed to use the latter because we have two controls, 
	 * one for the main page where you view data, 
	 * and one modal box to update it.
    ------------------------------------------------------------------*/
	$("#modaltitle h4").text("Update Lease for " + sp.ref);

	$("#frm_serviceprovider #id").val(sp.id);
	$("#frm_serviceprovider #dateadded").val(sp.dateadded);
	$("#frm_serviceprovider #created_by").val(sp.created_by);

	$("#rand_key").val(sp.rand_key);

    $("[id=ref]").val(sp.ref);
	$("[id=serviceprovidername]").val(sp.serviceprovidername);
	$("[id=type]").val(sp.type);
	$("[id=subtypes]").val(sp.subtypes);
	$("[id=address]").val(sp.address);
	$("[id=firstname]").val(sp.firstname);
	$("[id=lastname]").val(sp.lastname);
	$("[id=countrycode1]").val(sp. countrycode1);
    $("[id=mobilenumber1]").val(sp.mobilenumber1);
    $("[id=mobilenumbertitle]").val("+" + sp. countrycode1 + sp.mobilenumber1);
	$("[id=email]").val(sp.email);

 //    //work orders
    if(wInProgress.length > 0){
        $("#divWorkOrderInProgressDetails label").text('');
        $("#divWorkOrderInProgressDetails").show();
        $("#divWorkOrderInProgressHeader span").hide();

        $.each(wInProgress, function(key, val){
            var row = "<tr>"+
            "<td>"+_workorder.priority[val.priority]+"</td>"+
            "<td>"+val.ref+"</td>"+
            "<td>"+val.unit+"</td>"+
            "<td>"+_workorder.type[val.type]+"</td>"+
            "<td>"+val.subtype+"</td>"+
            "<td><a href='#'><i class='fa fa-eye'></i></a></td>"+
            "</tr>";   

            $("#divWorkOrderInProgressDetails table tbody").append(row);   
        });         
    }

    if(wCompleted.length > 0){
        $("#divWorkOrderCompletedDetails label").text('');
        $("#divWorkOrderCompletedDetails").show();
        $("#divWorkOrderCompletedHeader span").hide();

        $.each(wCompleted, function(key, val){
            var row = "<tr>"+
            "<td>"+_workorder.priority[val.priority]+"</td>"+
            "<td>"+val.ref+"</td>"+
            "<td>"+val.unit+"</td>"+
            "<td>"+_workorder.type[val.type]+"</td>"+
            "<td>"+val.subtype+"</td>"+
            "<td><a href='#'><i class='fa fa-eye'></i></a></td>"+
            "</tr>";   

            $("#divWorkOrderCompletedDetails table tbody").append(row);   
        });         
    }


    if(alltransactions.length > 0){
        $("#divAllTransactionsDetails label").text('');
        $("#divAllTransactionsDetails").show();
        $("#divAllTransactionsdHeader span").hide();

        $.each(alltransactions, function(key, val){
            var row = "<tr>"+
                "<td>"+val.ref+"</td>"+
                "<td>"+val.type+"</td>"+
                "<td>"+val.subtype+"</td>"+
                "<td>"+val.amount+"</td>"+
                "<td><a href='#'><i class='fa fa-eye'></i></a></td>"+
            "</tr>"; 

            $("#divAllTransactionsDetails table tbody").append(row);   
        });
    }

    if(pendingTransactions.length > 0){
        $("#divPendingTransactionsDetails label").text('');
        $("#divPendingTransactionsDetails").show();
        $("#divPendingTransactionsHeader span").hide();
        
        $.each(pendingTransactions, function(key, val){
            var row = "<tr>"+
                "<td>"+val.ref+"</td>"+
                "<td>"+val.type+"</td>"+
                "<td>"+val.subtype+"</td>"+
                "<td>"+val.amount+"</td>"+
                "<td><a href='#'><i class='fa fa-eye'></i></a></td>"+
            "</tr>"; 

            $("#divPendingTransactionsDetails table tbody").append(row);   
        });
    }

    if(paidTransactions.length > 0){
        $("#divPaidTransactionsDetails label").text('');
        $("#divPaidTransactionsDetails").show();
        $("#divPaidTransactionsHeader span").hide();
        
        $.each(paidTransactions, function(key, val){
            var row = "<tr>"+
                "<td>"+val.ref+"</td>"+
                "<td>"+val.type+"</td>"+
                "<td>"+val.subtype+"</td>"+
                "<td>"+val.amount+"</td>"+
                "<td><a href='#'><i class='fa fa-eye'></i></a></td>"+
            "</tr>"; 

            $("#divPaidTransactionsDetails table tbody").append(row);   
        });
    }    

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



                            // <div class="row">
                            //   <div class="col-md-7">
                            //     <label><strong>Tenancy Contract.docx</strong></label>
                            //   </div>
                            //   <div class="col-md-5">
                            //     <label><a href="#">View</a> | <a href="#">Delete</a></label>
                            //   </div>
                            // </div>	
}


$(document).ready(function(){
    ResetFields();
	// debugMode();
    $("#divSPDetails :input").prop("readonly", true);

	GetServiceProviders();

	$("#btnSaveServiceProvider").click(function(){
		SaveServiceProvider();
	});

    $('#tblServiceProviders tbody').on('click', 'tr', function () {
        $("#tblServiceProviders tbody tr").removeClass('selected');
        $(this).toggleClass('selected');
        $(this).find("input").prop("checked", true);
        var serviceproviderId = $(this).find("input").val();

        GetServiceProvider(serviceproviderId);
        $("#cancelServiceProvider").show();
    });

    $("#newServiceProvider, #cancelServiceProvider").click(function(){
      if($.fn.DataTable.isDataTable('#tblServiceProviders')){
        $('#tblServiceProviders').DataTable().draw();
      }        
        ResetFields();
    });

    $("#btnSaveNote").click(function(e){
        e.preventDefault();

        var serviceproviderId = $("#id").val();
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
                url: mainurl + "PM_Common/SaveServiceProviderNote",
                data: {
                    'serviceproviderId': serviceproviderId,
                    'note': note},
                datatype: "html",
                success: function(result) {
                    ResetFields();
                    GetServiceProvider(serviceproviderId);
                }
            });
        }
    });

});