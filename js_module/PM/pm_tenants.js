/*
id,
 ref,
 rand_key,
 salutation,
 title,
 firstname,
 lastname,
 nationality,
 dob,
 countrycode1,
 mobilenumber1,
 countrycode2,
 mobilenumber2,
 countrycode3,
 mobilenumber3,
 email,
 activitytime,
 dateupdated,
 dateadded,
 created_by 
 */


 var screenname = "PM";

 function ResetFields(){
 	$("[id=id]").val("");
 	$("[id=ref]").val("");
 	$("[id=rand_key]").val("");
 	$("[id=salutation]").val("");
 	$("[id=title]").val("");
 	$("[id=firstname]").val("");
 	$("[id=lastname]").val("");
 	$("[id=nationality]").val("");
 	$("[id=dob]").val("");
 	$("[id=countrycode1]").val("");
 	$("[id=mobilenumber1]").val("");
 	$("[id=countrycode2]").val("");
 	$("[id=mobilenumber2]").val("");
 	$("[id=countrycode3]").val("");
 	$("[id=mobilenumber3]").val("");
 	$("[id=email]").val("");
 	$("[id=activitytime]").val("");
 	$("[id=dateupdated]").val("");
 	$("[id=dateadded]").val("");
 	$("[id=created_by]").val("");

 	$("#divUnitDetails table tbody").html("");

 	$("#editTenant").hide();
 	$("#cancelTenant").hide();

    $("#divNoteContent").html('');
    $("#txtNote").text('');

    $("#divAllTransactions").hide();
    $("#divAllTransactions table tbody").html("");
 }

 function debugMode(){

	$("#newTenant").click();

 	$("#frm_tenant #salutation").val(1);
 	$("#frm_tenant #title").val(2);
 	$("#frm_tenant #firstname").val("Oberyn");
 	$("#frm_tenant #lastname").val("Martell");
 	$("#frm_tenant #nationality").val("Barbados");
 	$("#frm_tenant #dob").val("2016-03-14");
 	$("#frm_tenant #countrycode1").val(971);
 	$("#frm_tenant #mobilenumber1").val("56484948");
 	$("#frm_tenant #countrycode2").val(971);
 	$("#frm_tenant #mobilenumber2").val("56484948");
 	$("#frm_tenant #countrycode3").val("");
 	$("#frm_tenant #mobilenumber3").val("");
 	$("#frm_tenant #email").val("obmartell@dorne.com");

 }

 function SaveTenant(){
    var objTenant = {};
    var parameters = jQuery('#frm_tenant').serializeArray();
    //var arr = parameters.split('&');

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
            ResetFields();
            $('#tblTenants').DataTable().draw();            
        }
    });
}

function GetTenants(){
    var last_id = '';
    oTenantsTable = $('#tblTenants').DataTable({
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
            "aTargets": [0],
            "bSortable": false
        }                     
        ],
        "iDisplayLength": 25,
        "bServerSide": true,
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
                    // updateUserStatusPanel();;
                    if (last_id > 0) {
                        // $('#tblTenants #'+last_id+' td').addClass('yellowCSS');
                    }
                }
            });
        }
    });

	$('.datatable-setbotclass').next().addClass('fixedpagination-bottom');

	$('#txtSmartSearch_Tenants').on('keyup', function() {
	    oTenantsTable.search(this.value).draw();
	});
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
            FillTenant(result);

            $("#editTenant").show();
            $("#cancelTenant").show();
            $("#tabNotes").find('*').prop("disabled", false);
        }
    });
}

function FillTenant(result){

	var tenant = {}, unit = {}, tenant = {}, lease = {}, notes = {}, documents = {}
    , alltransactions = {}
    , pendingtransactions = {}
    , paidtransactions = {};

	unit = result.unitDetails;
	tenant = result.tenantDetails;
	tenant = result.tenantDetails;
	lease = result.leaseDetails;
	notes = result.tenantNotes;
    alltransactions = result.accountDetails;
    pendingtransactions = result.pendingDetails;
    paidtransactions = result.paidDetails;
    
	/* [dev note] Habibi, why use [id=idname] instead of #idname?
	* #idname matches the first instance of this id,
	* when [id=idname] matches ALL instances of this id.
	* i needed to use the latter because we have two controls, 
	* one for the main page where you view data, 
	* and one modal box to update it.
	------------------------------------------------------------------*/
	$("#modaltitle h4").text("Update information for " + tenant.ref);
	// $("#divTenantDetails #unitNo").val(tenant.unit);
	$("#unitId").val(unit.unitId);
	$("#unitRefNo").val(unit.unitRefNo);
	$("#frm_accounts #id").val(tenant.id);
	$("#frm_accounts #dateadded").val(tenant.dateadded);
	$("#frm_accounts #created_by").val(tenant.created_by);

 	$("[id=id]").val(tenant.id);
 	$("[id=ref]").val(tenant.ref);
 	$("[id=rand_key]").val(tenant.rand_key);
 	$("[id=salutation]").val(tenant.salutation);
 	$("[id=title]").val(tenant.title);
 	$("[id=firstname]").val(tenant.firstname);
 	$("[id=lastname]").val(tenant.lastname);
 	$("[id=nationality]").val(tenant.nationality);
 	$("[id=dob]").val(tenant.dob);
 	$("[id=countrycode1]").val(tenant.countrycode1);
 	$("[id=mobilenumber1]").val(tenant.mobilenumber1);
 	$("[id=countrycode2]").val(tenant.countrycode2);
 	$("[id=mobilenumber2]").val(tenant.mobilenumber2);
 	$("[id=countrycode3]").val(tenant.countrycode3);
 	$("[id=mobilenumber3]").val(tenant.mobilenumber3);
 	$("[id=email]").val(tenant.email);

	$("#rand_key").val(tenant.rand_key);

    //leased unit details
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
    $("#uTenant").text(unit.Owner);
    $("#uAgent").text(unit.PropertyMgr);

    $.each(unit, function(key, val){
	    var row = "<tr>"+
	    "<td>"+val.unitRefNo+"</td>"+
	    "<td>"+val.unit+"</td>"+
	    "<td><a href='#'><i class='fa fa-eye'></i></a></td>"+
		"</tr>";   

		$("#divUnitDetails table tbody").append(row); 	
    });

    if(alltransactions.length > 0){
        $("#divAllTransactions").show();
        $.each(alltransactions, function(key, val){

            var row = "<tr>"+
                "<td>"+val.unitref+"</td>"+
                "<td>"+val.unittitle+"</td>"+
                "<td>"+_account.transactiontype[val.transactiontype]+"</td>"+
                "<td>"+_account.type[val.type]+"</td>"+
                "<td>"+_account.subtype[val.subtype]+"</td>"+
                "<td>"+val.amount+"</td>"+
                "<td><a href='#'><i class='fa fa-eye'></i></a></td>"+
            "</tr>"; 

            $("#divAllTransactions table tbody").append(row);   
        });
    }

    if(paidtransactions.length > 0){

        $("#divPaidTransactions").show();

        $.each(paidtransactions, function(key, val){
            var row = "<tr>"+
                "<td>"+val.unitref+"</td>"+
                "<td>"+val.unittitle+"</td>"+
                "<td>"+_account.transactiontype[val.transactiontype]+"</td>"+
                "<td>"+_account.type[val.type]+"</td>"+
                "<td>"+_account.subtype[val.subtype]+"</td>"+
                "<td>"+val.amount+"</td>"+
                "<td><a href='#'><i class='fa fa-eye'></i></a></td>"+
            "</tr>"; 

            $("#divPaidTransactions table tbody").append(row);  
        });
    }   

    if(pendingtransactions.length > 0){    

    $("#divPendingTransactions").show();

        $.each(pendingtransactions, function(key, val){
            var row = "<tr>"+
                "<td>"+val.unitref+"</td>"+
                "<td>"+val.unittitle+"</td>"+
                "<td>"+_account.transactiontype[val.transactiontype]+"</td>"+
                "<td>"+_account.type[val.type]+"</td>"+
                "<td>"+_account.subtype[val.subtype]+"</td>"+
                "<td>"+val.amount+"</td>"+
                "<td><a href='#'><i class='fa fa-eye'></i></a></td>"+
            "</tr>"; 

            $("#divPendingTransactions table tbody").append(row);   
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

    // //TODO: convert Unit Details into a table and color odd-numbered rows
    // // $("#divUnitDetails ul li").each(function(i){
    // //     if(i%2)
    // //         alert(i);
    // // });    
}

 $(document).ready(function(){
 	ResetFields();
	//debugMode();

	GetTenants();

	$("#divTenantDetails").find("*").prop("readonly", true);

    $("#btnSaveTenant").click(function() {
        SaveTenant();
    }); 	

    $('#tblTenants tbody').on('click', 'tr', function() {
        $("#tblTenants tbody tr").removeClass('selected');
        $(this).toggleClass('selected');
        $(this).find("input").prop("checked", true);
        var tenantId = $(this).find("input").val();

        ResetFields();
        GetTenant(tenantId);
        $("#cancelTenant").show();
        $("#editTenant").show();
    });

    $("#newTenant, #cancelTenant").click(function() {
      if($.fn.DataTable.isDataTable('#tblTenants')){
        $('#tblTenants').DataTable().draw();
      }        
        ResetFields();
    });

    $("#btnSaveNote").click(function(e){
        e.preventDefault();

        var tenantId = $("#id").val();
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
                url: mainurl + "PM_Common/SaveTenantNote",
                data: {
                    'tenantId': tenantId,
                    'note': note},
                datatype: "html",
                success: function(result) {
                    ResetFields();
                    GetTenant(tenantId);
                }
            });
        }
    });        
 });