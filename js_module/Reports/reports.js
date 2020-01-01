/* Author: Kevin Espaldon
 * Date: 7 Feb, 2016
 * Notes:
 * What is up with tdCounter?
 * It's counts the number of the headers of the main table then concatenates a '<td/>' tag in each iteration.
 * Then on the first row of the tbody, tdCounter is added to the row where the total number of listings will be added,
 * so the total count of listings will always fall on the correct column.
 */

var objFilters = [];

function ResetValueSection() {
    $("#filter_value").html('');
    $("#filter_value").show();
    $("#divSliderSection").hide();
    $(".sol-container").hide();
}

function ResetFilters(){
     $("#filter_parameter").val(0);
     $("#filter_condition").val(0);
     $("#filter_value").val(0);
     ResetValueSection();
}

function WhereClauseBuilder() {

    //alert("value: " + value);

    var parameter, condition, value;
    var output = [];
    var typeFilter = 0, bedsFilter = 0, locationFilter = 0;

    objFilters = [];

    /* Parameters
    ------------------
    <option value="0">Please select</option>
    <option value="1">Type</option>
    <option value="2">No. of Beds</option>
    <option value="3">Location</option>
    */

    /* Conditions
    ------------------
        if parameter = type
            '0':'Please Select',
            '1':'is equal to'

        if parameter = beds
            '0':'Please Select',
            '1':'is equal to',
            '2':'greater than',
            '3':'less than',
            '4':'between'

        if parameter = location
            '0':'Please Select',    
            '1':'is equal to',
            '2':'in'
            */

    /* Values
    ------------------
        if parameter = type
            if condition = is
                Rent
                Sale

        if parameter = beds
            if condition = is
                Studio-9
            if condition = is
                from Studio-9 to Studio-9

        if parameter = location
            if condition = is
                single location
            if condition = in
                list of locations
            */

    if($("#rbeds").length)
    {
        switch($("#rbeds td:eq(2)").text()) {
            case "is equal to":
                bedsFilter = "beds = " + $("#rbeds td:eq(3)").attr('value');
                break;
            case "greater than":
                bedsFilter = "beds > " + $("#rbeds td:eq(3)").attr('value');
                break;
            case "less than":
                bedsFilter = "beds < " + $("#rbeds td:eq(3)").attr('value');
                break;
            case "between":
                var bedsRange = $("#beds td:eq(3)").text().split(',');
                bedsFilter = "beds between " + bedsRange[0] + " and " + bedsRange[1];
                break;
            default:
                bedsFilter = 0;
        }

        objFilters.push({
          "parameter": $("#rbeds td:eq(1)").attr('value'),
          "condition": $("#rbeds td:eq(2)").attr('value'),
          "value": $("#rbeds td:eq(3)").attr('value')
        });

        output.push(bedsFilter);
    }   

    if($("#rtype").length){
        typeFilter = "type = " + $("#rtype td:eq(3)").attr('value');

        objFilters.push({
          "parameter": $("#rtype td:eq(1)").attr('value'),
          "condition": $("#rtype td:eq(2)").attr('value'),
          "value": $("#rtype td:eq(3)").attr('value')
        });

        output.push(typeFilter);
    }   

    if($("#rlocation").length){
        switch($("#rlocation td:eq(2)").text()) {
            case "is equal to":
                locationFilter = "area_location_id = " + $("#rlocation td:eq(3)").attr('value');
                break;
            default: locationFilter = 0;
        }

        objFilters.push({
          "parameter": $("#rlocation td:eq(1)").attr('value'),
          "condition": $("#rlocation td:eq(2)").attr('value'),
          "value": $("#rlocation td:eq(3)").attr('value')
        });

        output.push(locationFilter);
    }       

    var where = output.join(" and ");

    //alert("objFilters: " + JSON.stringify(objFilters));

    return where;
}

function PopulateDataTable(res){
    var type, category, count;

    $("#tblReport thead").html('');
    $("#tblReport tbody").html('No Data Found');

    $("#tblReport thead").append('<tr><th></th>');

    var tdCounter = '';

    $.each(res[0], function(key, value) {
        tdCounter += '<td/>';
        $("#tblReport thead tr").append('<th>' + key + '</th>');
    });

    $("#tblReport thead tr").append('<th>Distribution of Listings</th>');

    $("#tblReport thead").append('</tr>');

    $("#tblReport tbody").html('');

    var totalCount = 0;

    $.each(res, function(index, record) {

        if (index == 'Total') {
            totalCount = record;
            $("#tblReport tbody").prepend('<tr>' + tdCounter + '<td><font size="3"><b>' + record + '</b></font></td><td/></tr>');
        } else {
            var row = '';
            var column = '';
            row = '<tr><td></td>';

            $.each(record, function(key, value) {
                column += '<td>' + value + '</td>';
            });

            column += '<td/>';

            row += column + '</tr>';

            $("#tblReport tbody").append(row);
        }
    });

    //now that the datatable is finished, iterate through and compute for ditribution values
    $("#tblReport tbody tr").each(function() {

        var $tds = $(this).find('td');

        var columnLength = $tds.length;

        var num = $tds.eq(columnLength - 2).text();

        var distrib = (num / totalCount) * 100;

        $tds.eq(columnLength - 1).text(distrib.toFixed(2) + '%');
    });
}

function GetReportIdFromURL(){

    var url = window.location.href;
    var hViewName = $("#hViewName").val();

    url = url.substring(url.lastIndexOf('/') + 1 );

    //alert("url: " + url +" | hViewName: " + hViewName);

    return (url == hViewName)?false:url;
}

function LoadSavedReport(res){

    /* expected value of res:
     [{
         ,"customname"       : "Sales Report by Category"
         ,"subgroupedby"     : "1"
         ,"filter"           : "[{
             'parameter':1,
             'condition':1,
             'value':1
                                     }]"
         ,"daterange"        : "-"
         ,"controllername":"ListingCategory"
     }]
    ---------------------*/

    var objFilters = [];
    objFilters = JSON.parse(res[0].filter);

    //Recreate saved configuration
    $("#selSubGroup").val(res[0].subgroupedby);

    //TODO: populate filter table, use each to iterate through the objFilter
    $.each(objFilters, function(key, val){
        $("#filter_parameter").val(objFilters[key].parameter);
        parameter_change();
        $("#filter_condition").val(objFilters[key].condition);
        condition_change();
        $("#filter_value").val(objFilters[key].value);
        addFilter();
    });

    // alert("res[0].functionname: " + res[0].controllername);

    populateTable_ClickEvent(res[0].controllername);
}
    
function parameter_change(){
    ResetValueSection();
        $("#filter_condition").html('');

        parameter = $("#filter_parameter").val();
        $("#filter_condition").prop("disabled", ($("#filter_parameter").val() === 0));

        if (parameter == "type") {
            options = {
                '0': 'Please Select',
                '1': 'is equal to'
            }
        } else if (parameter == "beds") {
            options = {
                '0': 'Please Select',
                '1': 'is equal to',
                '2': 'greater than',
                //'greaterthanorequalto':'greater than or equal to',
                '3': 'less than',
                //'lessthanorequalto':'less than or equal to',
                //'in':'in',
                '4': 'between'
            }
        } else if (parameter == "location") {
            options = {
                '0': 'Please Select',
                '1': 'is equal to',
                '2': 'in'
            }
        }


        $.each(options, function(val, text) {
            $("#filter_condition").append(
                $('<option></option>').val(val).html(text)
            );
        });
}

function condition_change(){

        parameter = $("#filter_parameter").val();
        condition = $("#filter_condition").val();

        ResetValueSection();

        if (parameter == "type") {
            $("#filter_value").css('width', '100px');
            $("#filter_value").css('height', '35px');


            solOptions = {
                "1": "Rent",
                "2": "Sale"
            };

            $.each(solOptions, function(val, text) {
                $("#filter_value").append(
                    $('<option></option>').val(val).html(text)
                );
            });

        } else if (parameter == "beds") {
            $("#filter_value").css('width', '100px');
            $("#filter_value").css('height', '35px');

            if (condition == 'between') {
                $("#filter_value").hide();
                $("#divSliderSection").show();


                $("#divSlider").slider({
                    range: true,
                    min: 0,
                    max: 10,
                    values: [1, 3],
                    slide: function(event, ui) {
                        if (ui.values[0] === 0 && ui.values[1] === 0)
                            $("#amount").html("Studio - Studio");
                        else {
                            //alert(2);
                            if (ui.values[0] === 0)
                                $("#amount").html("Studio" + " - " + ui.values[1]);
                            else
                                $("#amount").html(ui.values[0] + " - " + ui.values[1]);
                        }
                    }
                });
            } else {

                $("#filter_value").show();
                $("#filter_value").html('');
                $("#filter_value").append(
                    $('<option></option>').val(0).html('Studio'));

                for (var i = 1; i <= 10; i++) {
                    $("#filter_value").append(
                        $('<option></option>').val(i).html(i)
                    );
                }

                $("#filter_value").append(
                    $('<option></option>').val(11).html('More than 10'));
            }
        } else if (parameter == "location") {

            $("#filter_value").html('');
            $("#filter_value").css('width', '300px');
            $("#filter_value").css('height', '30px');

            $("#filter_condition").css('width', '110px');
            $("#filter_condition").css('height', '35px');

            var snum_dropdown = '<option value=0 label="Select">Select</option>';

            var multiple = false;

            //snum_dropdown += '<optgroup />';
            $('#filter_value').html(snum_dropdown);

            if (condition == "1") {
                $("#filter_value").hide();
                $("#filter_value").html('');
                $(".sol-container ").show();

                $(".sol-inner-container").css('height', '30px');

                $.each(location_json_array[1], function(locId, locDesc) {
                    snum_dropdown += '<option value="' + locId * 1 + '" label="' + locDesc + '">' + locDesc + '</option>';
                });

                $("#filter_value").append(snum_dropdown);

                $('#filter_value').searchableOptionList({
                    maxHeight: '150px',
                    showSelectionBelowList: true
                });                 
            }          
        }
}

function addFilter(){
    var parameter = $("#filter_parameter option:selected").text();
    var condition = $("#filter_condition option:selected").text();
    var text = ($("#filter_value option:selected").text() == "")?0:$("#filter_value option:selected").text();
    var value = $("#filter_value option:selected").val();

    if($("#filter_parameter option:selected").val() == 'beds')
    {
        if($("#filter_condition option:selected").val() == 'between'){
            text = $("#amount").text().split(' - ');
            value = "range";        
        }
    } 

    var roomsRange = $("#amount").text().split(' - ');

    if ((parameter === 0)||(condition === 0)||(text === 0))
        bootbox.alert("Please select a filter");
    else {

        if($("#tblFilters").find("#r" + $("#filter_parameter option:selected").val()).length > 0)
            bootbox.alert(parameter + " is already set.");
        else{

            var row = "<tr id='r"+$("#filter_parameter option:selected").val()+"'><td></td>";
            row += "<td value='"+$("#filter_parameter option:selected").val()+"'>"+parameter+"</td>";
            row += "<td value='"+$("#filter_condition option:selected").val()+"'>"+condition+"</td>";
            row += "<td value = "+value+">"+text+"</td>";
            row += "<td id='delete'><a class='rep-filterdelete'> <span aria-hidden='true' class='glyphicon glyphicon-trash rep-filterdelete'></span></a></td>";
            row += "</tr>";

            $("#tblFilters tbody").append(row);
            $("#tblFilters").show();
        }

        ResetFilters();
    }
}

function populateTable_ClickEvent(reportName){

    var subGroup = $("#selSubGroup option:selected").text();

    //var reportName = this.id;

    //alert(reportName);

    var whereClause = WhereClauseBuilder();

    //alert("whereClause: " + whereClause);

    $.ajax({
        type: "POST",
        url: mainurl + "Reports/" + reportName,
        data: {
            'subGroup': subGroup,
            'where': whereClause},
        datatype: "html",
        success: function(res) {
            PopulateDataTable(res);
            pieChart(res);
            barChart(res);
        }
    });
}

function pieData(res){
    var data = [];
    var r;

    for (var i = 0; i < Object.keys(res).length - 1; i++) {
        r = res[i];
        var row = Object.keys(r).sort();

        data.push([
            '"'+r.Type +' - '+ r[row[0]]+'"',
            parseInt(r["Count"])]);
    };

    return data;
}

function barData(res){
    var categories = [], data = [];
    for (var i = 0; i < Object.keys(res).length - 1; i++) {
        r = res[i];
        categories.push(['"'+r.Type +' '+ r.Category+'"']);
        data.push(parseInt(r["Count"]));
    }    

    var bar = new Object;
    bar.categories = categories;
    bar.data = data;

    return bar;
}

function pieChart(res){

    $('#piechart1').highcharts({
        chart: {
            type: 'pie'
        },
        title: {
            text: ''
        },
        plotOptions: {
            pie: {
                shadow: false
            }
        },
        tooltip: {
            formatter: function() {
                return this.point.name + ": " + this.y;//'<b>'+  +'</b>: '
            }
        },
        title: {
            text: ''
        },        
        series: [{
            name: 'Listings',
            data: pieData(res),
            size: '90%',
            innerSize: '60%',
            showInLegend:true,
            dataLabels: {
                enabled: false
            }
        }]
    });    
}

function barChart(res){
    var info = new Object;
    info = barData(res);

    $('#barchart1').highcharts({
        chart: {
            type: 'column'
        },
        legend: {
          enabled: false
        },
        title: {
            text: ''
        },
        xAxis: {
            categories: info.categories,
            crosshair: true
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Sales',
            colorByPoint: true,
            data: info.data
        }]
    });
}

function SaveReport(name){

    var _btnPopulateTableid = $(".btnPopulateTable").prop("id");

    var reportId = GetReportIdFromURL();

    var type = 0;

    if (_btnPopulateTableid.indexOf('Contact') >= 0)
        type = 1;
    else if (_btnPopulateTableid.indexOf('Deal') >= 0)
        type = 2;
    else if (_btnPopulateTableid.indexOf('Lead') >= 0)
        type = 3;
    else if (_btnPopulateTableid.indexOf('Listing') >= 0)
        type = 4;

    var objData = {
        'type': type
        ,'reference': (reportId.length > 0)? reportId : ""
        ,'reportname': $("h3.gist-reportinghead").text()
        ,'customname': name
        ,'functionname': $("#hViewName").val()
        ,'createdBy':  $("#hUserId").val()
        ,'subgroupedby': $("#selSubGroup option:selected").val()
        ,'filter': JSON.stringify(objFilters)
        ,'controllername': _btnPopulateTableid
    };

    $.ajax({    
        type: "POST",
        url: mainurl + "Reports/SaveReport",
        data: {
            'objData': objData},
        datatype: "json",
        success: function(res) {
            //show("Report saved successfully.");
        }
    });
}

//document.ready
$(document).ready(function() {

    var _btnPopulateTableid = $(".btnPopulateTable").prop('id');

    if($(".btnPopulateTable").length > 0)
        populateTable_ClickEvent(_btnPopulateTableid);

    var reportId = GetReportIdFromURL();

    if(reportId){

        $.ajax({
           type: "POST",
           url: mainurl + "Reports/GetSavedReport/" + reportId,
           datatype: "html",
           success: function(res) {
               LoadSavedReport(res);
        }
        });
    }

    var screenname = 'Reports';

    var subGroup = $("#selSubGroup").val();

    $("#amount").val(1);

    //ResetValueSection();    

    var parameter, condition, value;
    var filterString = "hello";

    var options = {
        'is': 'is equal to',
        'isnot': 'is not equal to',
        'greaterthan': 'greater than',
        'greaterthanorequalto': 'greater than or equal to',
        'lessthan': 'less than',
        'lessthanorequalto': 'less than or equal to',
        'like': 'like',
        'notlike': 'not like',
        'in': 'in'
    };

    var solOptions = {
        "type": "option",
        "apple": "apple",
        "orange": "orange",
        "banana": "banana",
        "guava": "guava",
        "grapes": "grapes",
        "pomegranate": "pomegranate"
    };

    $("#filter_parameter").change(function() {
        parameter_change();
    });

    $("#filter_condition").change(function() {
        condition_change();
    });

    $("#btnAddFilter").click(function() {
        addFilter();
    });

    $("#btnSaveFilters").click(function(){
        populateTable_ClickEvent(_btnPopulateTableid);
        //$("#addmorefilter")
    });

    $('#tblFilters').on('click', '#delete', function(e){
        //$e.preventDefault();
        $(this).closest('tr').remove();
    });

    $(".btnPopulateTable").click(function() {
        populateTable_ClickEvent(this.id);
    });

    $("#aSaveReport").click(function(e){
        e.preventDefault();

        //var xType = (reportId)?reportId:'new';
        
        //TODO: 
        //    1. HTML elements for user to assign custom name
        //    2. prevent duplicate data, insert, if existing, update
       
        var customReportName;
        
        bootbox.dialog({
          title: "Would you like to assign a custom report name?",
          message: "<input type='text' class='form-control' placeholder='Enter report name' id='txtCustomReportName'>",
          buttons: {
            warning: {
              label: "Save without naming",
              className: "btn-warning",
              callback: function() {
                customReportName = "";
                SaveReport(customReportName);
              }
            },
            success: {
              label: "Save",
              className: "btn-success",
              callback: function() {
                customReportName = $("#txtCustomReportName").val();
                SaveReport(customReportName);
              }
            }
          }
        });

        

        //alert("savereport: " + JSON.stringify(objFilters));
    });


    $("#btnSendReport").click(function(){
        $.ajax({
            type: "POST",
            url: mainurl + "Reports/SendEmail",
            data: {
                "email": $("#txtEmail").val(),
                "message":$("#txtAreaEmail").val()
                },

            datatype: "html",
            success: function(result) {

            }
        });
    });
});

