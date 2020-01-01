
function toggleChecked()
{
//---------------------------------------------

//              LEAVE ME HERE

//---------------------------------------------
}

var listingType = 0;

$(document).ready(function()
{

    $("#aSendNewsletter").click(function(e){
        e.preventDefault();

        //TODO: get comma-separated list of reference numbers, of users (receipients), template id, title and message

        var listingIDs = [];
        $('#listings_row input:checked').each(function() {
            listingIDs.push($(this).attr('value'));
        });

        var contactIDs = [];
        $('#contacts_row input:checked').each(function() {
            var row = $(this).parents('tr:eq(0)');
            contactIDs.push($(this).attr('value'));
        });

        var templateID = $("#selTemp option:selected").val();

        var emailtitle = $("#txtEmailTitle").val();

        var emailBody = tinyMCE.get('description_demo').getContent();

        $.ajax({
            type: "POST",
            url: mainurl + "Newsletters/SendNewsletter",
            data: {
                'listingIDs': listingIDs,
                'contactIDs': contactIDs,
                'templateID': templateID,
                'emailtitle': emailtitle,
                'emailBody': emailBody
                },
            datatype: "html",
            success: function(res) {
               // PopulateDataTable(res);
            }
        });
    });

    $(".templatebox img").hide();

    $("#selTemp").change(function(){
        var selectedTemplateId = parseInt($("#selTemp option:selected").val()) ;

        $(".templatebox img").hide()
        $(".templatebox img:eq("+selectedTemplateId+")").show()
    });

    $(".ListingType").click(function(){
        oListingsTable.draw();
    });

    $(".ContactType").click(function(){
        oContactsTable.draw();
    });    

    $(".CheckAll").click(function(){
        //alert("this.id: " + this.id);
        var tableId = "";

        if(this.id == "CheckAllListings"){
            $("#listings_row tbody input[type=checkbox]").each( function() {
                $(this).prop('checked', $("#CheckAllListings").is(":checked"));
            });                 
        }
        else if(this.id == "CheckAllContacts"){
            $("#contacts_row tbody input[type=checkbox]").each( function() {
                $(this).prop('checked', $("#CheckAllContacts").is(":checked"));
            });
        } 
    });

    var last_id = '';

    var oListingsTable, oContactsTable;

    //TODO: populate data table
    oListingsTable = $('#listings_row').DataTable({
        "bProcessing": true,
        "sDom": 'R<>rt<ilp><"clear">',
        "aoColumnDefs": [
            {
                'render': function(data, type, full, meta)
                {
                    //check the main check box
                    $('#check_all_checkboxes').attr('checked', false);
                    return '<div style="text-align:center;"><input style="align:center;" type="checkbox" value="' + data + '">  <span class="lbl"></span></div>';
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
        "aoColumns": [
            {"mDataProp": "id"},
            {"mDataProp": "type"},
            {"mDataProp": "ref"},
            {"mDataProp": "unit"},
            {"mDataProp": "category"},
            {"mDataProp": "region_id"},
            {"mDataProp": "area_location_id"},
            {"mDataProp": "sub_area_location_id"},
            {"mDataProp": "beds"},
            {"mDataProp": "size"},
            {"mDataProp": "price"},
            {"mDataProp": "agent_id"},
            {"mDataProp": "landlord_id"},
            {"mDataProp": "dateadded"},
            {"mDataProp": "dateupdated"},
            {"mDataProp": "user_id"},
            {"mDataProp": "key_location"},
        ],
        "columns": [
            {"data": "id"},
            {"data": "type"},
            {"data": "ref"},
            {"data": "unit"},
            {"data": "category"},
            {"data": "region_id"},
            {"data": "area_location_id"},
            {"data": "sub_area_location_id"},
            {"data": "beds"},
            {"data": "size"},
            {"data": "price"},
            {"data": "agent_id"},
            {"data": "landlord_id"},
            {"data": "dateadded"},
            {"data": "dateupdated"},
            {"data": "user_id"},
            {"data": "key_location"},
        ],
        "iDisplayLength": 25,
        "bServerSide": true,
        "sAjaxSource": config.siteUrl + "Newsletters/GetListings?listingType="+$("#rgroup_listingtype input[type=radio]:checked").val(),
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        'fnServerData': function(url, data, callback) {
            data.type = $("#rgroup_listingtype input[type=radio]:checked").val();

            $.ajax({
                "dataType": 'json',
                "type": "POST",
                "url": config.siteUrl + "Newsletters/GetListings?listingType="+$("#rgroup_listingtype input[type=radio]:checked").val(),
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

    oContactsTable = $('#contacts_row').DataTable({
        "bProcessing": true,
        "sDom": 'R<>rt<ilp><"clear">',
        "aoColumnDefs": [
            {
                'render': function(data, type, full, meta)
                {
                    //check the main check box
                    $('#check_all_checkboxes').attr('checked', false);
                    return '<div style="text-align:center;"><input style="align:center;" type="checkbox" value="' + data + '">  <span class="lbl"></span></div>';
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

                    var contact_type = 0;

                    if(data == 1)
                        contact_type = "Tenant";
                    else if(data == 2)
                        contact_type = "Buyer";                        
                    else if(data == 3)
                        contact_type = "Landlord";                        
                    else if(data == 4)
                        contact_type = "Seller";                        
                    else if(data == 5)
                        contact_type = "Landlord+Seller";                        
                    else if(data == 6)
                        contact_type = "Rep. of Tenant";                        
                    else if(data == 7)
                        contact_type = "Other";

                    return contact_type;
                }
            }
        ],
        "aoColumns": [
            {"mDataProp": "id"},
            {"mDataProp": "contact_type"},
            {"mDataProp": "name"},
            {"mDataProp": "last_name"},
            {"mDataProp": "company"},
            {"mDataProp": "phone"},
            {"mDataProp": "mobile"},
            {"mDataProp": "email"},
            {"mDataProp": "dateadded"},
            {"mDataProp": "created_by"}
        ],
        "columns": [
            {"data": "id"},
            {"data": "contact_type"},
            {"data": "name"},
            {"data": "last_name"},
            {"data": "company"},
            {"data": "phone"},
            {"data": "mobile"},
            {"data": "email"},
            {"data": "dateadded"},
            {"data": "created_by"}
        ],
        "iDisplayLength": 25,
        "bServerSide": true,
        "sAjaxSource": config.siteUrl + "Newsletters/GetContacts?contactType="+$("#rgroup_contacttype input[type=radio]:checked").val(),
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        'fnServerData': function(url, data, callback) {
            data.type = $("#rgroup_contacttype input[type=radio]:checked").val();

            $.ajax({
                "dataType": 'json',
                "type": "POST",
                "url": config.siteUrl + "Newsletters/GetContacts?contactType="+$("#rgroup_contacttype input[type=radio]:checked").val(),
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

    $('#txtSmartSearch').on( 'keyup', function () {
      oListingsTable.search( this.value ).draw();
    } );

//
//document ready end    
});