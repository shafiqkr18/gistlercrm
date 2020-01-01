// Zaheer JS don't add yours
//Dashboard top tabs
$(document).ready(function() {
$("#crm-expandlisting").click(function(){
    console.log('hi');
	$("#crm-mysamblocks").addClass('crm-hideme');
	$("#crm-mylisting").show("slow");
})
$("#crm-closelisting").click(function(){

	$("#crm-mysamblocks").removeClass('crm-hideme');
	$("#crm-mylisting").hide();
})

$("#crm-expandleads").click(function(){
	$("#crm-mysamblocks").addClass('crm-hideme');
	$("#crm-myleadsoverview").show("slow");
})
$(".crm-closelisting").click(function(){
	
	$("#crm-mysamblocks").removeClass('crm-hideme');
	$("#crm-myleadsoverview").hide();
})

$("#crm-expanddeals").click(function(){
	$("#crm-mysamblocks").addClass('crm-hideme');
	$("#crm-mydealsoverview").show("slow");
})
$(".crm-closelisting").click(function(){
	
	$("#crm-mysamblocks").removeClass('crm-hideme');
	$("#crm-mydealsoverview").hide();
})

$("#crm-expandcontacts").click(function(){
	$("#crm-mysamblocks").addClass('crm-hideme');
	$("#crm-mycontactsoverview").show("slow");
})
$(".crm-closelisting").click(function(){
	
	$("#crm-mysamblocks").removeClass('crm-hideme');
	$("#crm-mycontactsoverview").hide();
});
});


//Date & Time Picker
$(function () {
    $('.datetimepicker').datetimepicker({
      		  format: 'YYYY-MM-DD hh:mm:ss'
   			 });
   				 //Date Picker
			$('.datepicker').datetimepicker({
				format: 'YYYY-MM-DD'
			});
});
//Full Screen Code
function toggleFullScreen() {
  	if ((document.fullScreenElement && document.fullScreenElement !== null) ||    
  		(!document.mozFullScreen && !document.webkitIsFullScreen)) {
  			if (document.documentElement.requestFullScreen) {  
    			document.documentElement.requestFullScreen();  
  			} else if (document.documentElement.mozRequestFullScreen) {  
    			document.documentElement.mozRequestFullScreen();  
  			} else if (document.documentElement.webkitRequestFullScreen) {  
    			document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);  
  			}  
  	} else {  
  		if (document.cancelFullScreen) {  
    		document.cancelFullScreen();  
  		} else if (document.mozCancelFullScreen) {  
    		document.mozCancelFullScreen();  
  		} else if (document.webkitCancelFullScreen) {  
    		document.webkitCancelFullScreen();  
  		}  
  	}  
  }

$(document).ready(function() {
var maparea = $('#mymap_area');
if(maparea.length>0) {}// if condition function home dashboard
 
})


// DashBoard Js
$(document).ready(function() {
$(document).on('click', '.panel-heading span.clickable', function(e){
    var $this = $(this);
	if(!$this.hasClass('panel-collapsed')) {
		$this.parents('.panel').find('.panel-body').slideUp();
		$this.addClass('panel-collapsed');
		$this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
	} else {
		$this.parents('.panel').find('.panel-body').slideDown();
		$this.removeClass('panel-collapsed');
		$this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
	}
})
$("#sortable").sortable({
        handle: ".moveme",
        revert: true,
        opacity: 0.5
    });
});
//ADD NEW LISTING BTN
$(document).ready(function() {
    
    $('#new').click(function(){
        
        var checkparent = $('.required').parent();
        checkparent.addClass('has-error');
        if(checkparent.hasClass('input-group')){ 
            var secondparent = $('.input-group.has-error').parent();
            secondparent.addClass('has-error');
            $('.input-group').removeClass('has-error');

        }
    });

    //Select Something
    // $('#openSelsome').on('shown.bs.collapse', function () {
    //     $('#openSelsome').attr('id','closeSelsome');
    // })
    // $('#closeSelsome').on('hidden.bs.collapse', function () {
    //     $('#closeSelsome').attr('id','openSelsome');
    // })

});
 //Title Count 
    function countChar(val) {
        var len = val.value.length;
    if (len >= 500) {
        val.value = val.value.substring(0, 500);
    } else {
        $('#charNum').text(len);
    }
}


//High Charts
// Dashborad agent leadboard
//var agentleadb = $("#agentLeadbord").length;

$(document).ready(function() {

if ($('#agentLeadbord').length >0) {
    
       $(function () {
        $('#agentLeadbord').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            legend: {
              enabled: false
            },
            xAxis: {
                categories: [
                    '1st',
                    '2nd',
                    '3rd',
                    '4th',
                    '5th'
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: ''
                }
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
            legend: {
        container: '#graphLegend'     
    },
            series: [{
                name: 'Sales',
                colorByPoint: true,
                data: [{
                    name: 'Jhon',
                    y: 288
                }, {
                    name: 'Neil',
                    y: 267
                }, {
                    name: 'Patrick',
                    y: 210
                }, {
                    name: 'Sara',
                    y: 166
                }, {
                    name: 'Marry',
                    y: 150
                }]
            }]
        });
      });  
  }

// Commented out by kespaldon
// if ($('#piechart1').length >0) {

//     $(function() {
//         // Create the chart
//         chart = new Highcharts.Chart({
//             chart: {
//                 renderTo: 'piechart1',
//                 type: 'pie'
//             },
//             title: {
//                 text: ''
//             },
//             yAxis: {
//                 title: {
//                     text: ''
//                 }
//             },
//             plotOptions: {
//                 pie: {
//                     shadow: false
//                 }
//             },
//             tooltip: {
//                 formatter: function() {
//                     return '<b>'+ this.point.name +'</b>: '+ this.y +' %';
//                 }
//             },
//             series: [{
//                 name: 'Browsers',
//                 data: [["Firefox",6],["MSIE",4],["Chrome",7],["Apple",5],["Dell",4]],
//                 size: '90%',
//                 innerSize: '60%',
//                 showInLegend:true,
//                 dataLabels: {
//                     enabled: false
//                 }
//             }]
//         });
//     });
// }

// if ($('#barchart1').length >0) {
    
//        $(function () {
//         $('#barchart1').highcharts({
//             chart: {
//                 type: 'column'
//             },
//             title: {
//                 text: ''
//             },
//             subtitle: {
//                 text: ''
//             },
//             legend: {
//               enabled: false
//             },
//             xAxis: {
//                 categories: [
//                     '1st',
//                     '2nd',
//                     '3rd',
//                     '4th',
//                     '5th'
//                 ],
//                 crosshair: true
//             },
//             yAxis: {
//                 min: 0,
//                 title: {
//                     text: ''
//                 }
//             },
//             tooltip: {
//                 headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
//                 pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
//                     '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
//                 footerFormat: '</table>',
//                 shared: true,
//                 useHTML: true
//             },
//             plotOptions: {
//                 column: {
//                     pointPadding: 0.2,
//                     borderWidth: 0
//                 }
//             },
//             series: [{
//                 name: 'Sales',
//                 colorByPoint: true,
//                 data: [{
//                     name: 'Jhon',
//                     y: 288
//                 }, {
//                     name: 'Neil',
//                     y: 267
//                 }, {
//                     name: 'Patrick',
//                     y: 210
//                 }, {
//                     name: 'Sara',
//                     y: 166
//                 }, {
//                     name: 'Marry',
//                     y: 150
//                 }]
//             }]
//         });
//       });  
//   }

})