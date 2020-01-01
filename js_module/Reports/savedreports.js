var base_url = config.baseUrl;

function GetSavedReports(type) {
  $.ajax({
    type: "POST",
    url: mainurl + "Reports/GetSavedReports",
    data: {
      'type': type
    },
    datatype: "html",
    success: function(res) {
      PopulateDataTable(res);
    }
  });
}

function PopulateDataTable(res) {

  $("#tblSavedReports tbody").html('');

  $.each(res, function(index, record) {

    var row = '';
    var column = '';
    row = '<tr><td/><td>' 
    + '<a class="redirect" href="#" target="_blank" title="Go to report"><i class="fa fa-desktop"></i></a>&nbsp;&nbsp;&nbsp;' 
    + '<a class="delete" href="#" title="Delete this report"><i class="fa fa-times-circle"></i></a>' 
    + '</td>';

    var reference = '';

    $.each(record, function(key, value) {

      if (key != 'reference')
        column += '<td class="' + key + '">' + value + '</td>';
      else{
        column += '<td class="' + key + '">' + value + '</td>';
        reference = value;
      }

    });

    row += column + '</tr>';
    $("#tblSavedReports tbody").append(row);

    var $row = $("#tblSavedReports tbody tr:last");

    var viewname = $("#tblSavedReports tbody tr:last .viewname").text();

    $row.find('.redirect').prop("href", base_url + "Reports/" + viewname + "/" + reference);
    $row.prop("id", reference);
  });

  $(".id, .viewname, .reference").hide();
}

function DeleteReport(rowId){

  $.ajax({
    type: "POST",
    url: mainurl + "Reports/DeleteReport",
    data: {
      'reference': rowId,
      'type': $("#reportType").val()
    },
    datatype: "html",
    success: function(res) {
      PopulateDataTable(res);
    }
  });
}

$(document).ready(function() {
  var reportType = $("#reportType").val();

  GetSavedReports(reportType);

  $('#tblSavedReports tbody').on('click', 'tr', function() {

    $("#tblSavedReports tbody tr").removeClass('selected');
    $(this).toggleClass('selected');
  });

  $("#tblSavedReports tbody").on("click", "tr td a.delete", function(){

    var rowId = $(this).closest("tr").prop("id");

    bootbox.confirm("Do you really want to delete this report?", function(result){
      if(result)
        DeleteReport(rowId);
    });
  });

});