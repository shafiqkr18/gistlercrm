function GetServiceProviderTypes(){
  $.ajax({
      type: "POST",
      url: mainurl + "PM_Common/GetServiceProviderTypes",
      datatype: "html",
      success: function(result) {
        FillServiceProviderTypes(result);
      }
  });
}

function FillServiceProviderTypes(result){

  var $typelist = $("#lgTypes");
  $typelist.html("");

  $.each(result, function(){

  var listgroupitem = '<a class="list-group-item" href="#">\
                        <h4 value="'+this.id+'" class="list-group-item-heading">'+this.name+'</h4>\
                        <p class="list-group-item-text">'+this.description+'</p>\
                      </a>';    

    $typelist.append(listgroupitem);
  });
}

function ShowUnderMaintenance(){
  bootbox.dialog({
        title: "This is a form in a modal.",
        message: '<div class="row">  ' +
            '<div class="col-md-12"> ' +
            '<form class="form-horizontal"> ' +
            '<div class="form-group"> ' +
            '<label class="col-md-4 control-label" for="name">Name</label> ' +
            '<div class="col-md-4"> ' +
            '<input id="name" name="name" type="text" placeholder="Your name" class="form-control input-md"> ' +
            '<span class="help-block">Here goes your name</span> </div> ' +
            '</div> ' +
            '<div class="form-group"> ' +
            '<label class="col-md-4 control-label" for="awesomeness">How awesome is this?</label> ' +
            '<div class="col-md-4"> <div class="radio"> <label for="awesomeness-0"> ' +
            '<input type="radio" name="awesomeness" id="awesomeness-0" value="Really awesome" checked="checked"> ' +
            'Really awesome </label> ' +
            '</div><div class="radio"> <label for="awesomeness-1"> ' +
            '<input type="radio" name="awesomeness" id="awesomeness-1" value="Super awesome"> Super awesome </label> ' +
            '</div> ' +
            '</div> </div>' +
            '</form> </div>  </div>'
      }
  );
}

$(document).ready(function(){



	GetServiceProviders();

  $divSP = $("#rServiceProviders");

  $divSP.on("click", "#liTypes", function(){
    GetServiceProviderTypes();
  })
  .on("click", ".list-group-item", function(e){
    e.preventDefault();
    $("#lgTypes a").removeClass("active");

    $(this).addClass("active");
  });

  $('#tblServiceProviders tbody').on('click', 'tr', function () {
    // console.log($(this).html());
    var spId = $(this).find("input").attr("value");
    $("#serviceproviderform").modal("show");

    // ResetModal("serviceproviderform");
    $("#serviceproviderform").find("#btnDeleteTransactions").remove();

    GetServiceProvider(spId);
  });


});