// JavaScript Document
//<![CDATA[

//$('#hiddencolums').fadeOut('slow').load('http://crm.propspace.com/index.php/dashboard/items').fadeIn("slow"); //fetches the tables

//$('#listItem_1').appendTo('#col-1');$('.listItem_1').css('display','none');$('#listItem_2').appendTo('#col-1');$('.listItem_2').css('display','none');$('#listItem_5').appendTo('#col-1');$('.listItem_5').css('display','none');$('#listItem_4').appendTo('#col-2');$('.listItem_4').css('display','none');$('#listItem_6').appendTo('#col-2');$('.listItem_6').css('display','none');$('#listItem_3').appendTo('#col-3');$('.listItem_3').css('display','none');

//$('a.close_module').live('click', function() { //When clicking on the close or fade layer...
	$(document).on("click", "a.close_module", function () {

			var id = $(this).attr('id');
			
				$(".ccolums #"+id).fadeOut('slow', function() {
			
				//$('#hiddencolums').fadeOut('slow').load('http://crm.propspace.com/index.php/dashboard/items').fadeIn("slow");
				
				$(".ccolums #"+id).remove();
				var col_1 = $('#col-1').sortable('serialize');
				var col_2 = $('#col-2').sortable('serialize');
				var col_3 = $('#col-3').sortable('serialize');	
				var data="col_1:"+col_1+",col_2:"+col_2+",col_3:"+col_3;
				//$("#info").load("http://crm.propspace.com/index.php/dashboard/updatesort?dashboard_sorting="+data.replace(/&/g, '-'));
				$('.'+id).css('display','');
				});
		}); 

		
//$('#listItem_1').appendTo("#col-1");

// You must also include jQuery UI for this to work
$('.button').draggable({
    cursor: 'pointer',
    connectWith: '.dropme',
    helper: 'clone',
    opacity: 0.5,
    zIndex: 10
});

$('.dropme').sortable({
    connectWith: '.dropme',
	activeClass: 'highlight',
	opacity: 0.5,
    cursor: 'pointer',

      update : function () {
		var col_1 = $('#col-1').sortable('serialize');
		var col_2 = $('#col-2').sortable('serialize');
		var col_3 = $('#col-3').sortable('serialize');	
		var data="col_1:"+col_1+",col_2:"+col_2+",col_3:"+col_3;
		//$("#info").load("http://crm.propspace.com/index.php/dashboard/updatesort?dashboard_sorting="+data.replace(/&/g, '-'));
      }
}).droppable({
    accept: '.button',
    activeClass: 'highlight',
    drop: function(event, ui) {
		var dragID = ui.draggable.attr("data-item");
        var $li = $('<div id="'+dragID+'">').html($("#"+dragID).html());
     //  alert($("#"+dragID).html());
		$li.appendTo(this);
		
		var col_1 = $('#col-1').sortable('serialize');
		var col_2 = $('#col-2').sortable('serialize');
		var col_3 = $('#col-3').sortable('serialize');	
		var data="col_1:"+col_1+",col_2:"+col_2+",col_3:"+col_3;
//alert(data);
		//$("#info").load("http://crm.propspace.com/index.php/dashboard/updatesort?dashboard_sorting="+data.replace(/&/g, '-'));
		ui.draggable.css('display','none');
    }
});
//]]> 


//listing overview	

$.getJSON(site_url+"/dashboard/get_listing_overview", function(json){ 

				 json = json[0];

				$.each(json, function (key, val) {

					

						//----------- live listings ------------

						if(key =='tot_live')

						{

							$("#tot_live_listing1").text(val);

							$("#tot_live_listing2").text(val);

							$("#tot_live_listing3").text(val);

							$("#tot_live_listing4").text(val);

							$("#tot_live_listing5").text(val);

						}else if(key =='tot_rent1')

						{

							$('#tot_live_listing1_r').attr('title', val);

							$('#tot_live_listing2_r').attr('title', val);

							$('#tot_live_listing3_r').attr('title', val);

							$('#tot_live_listing4_r').attr('title', val);

							$('#tot_live_listing5_r').attr('title', val);

						}else if(key =='tot_sale1')

						{

							$('#tot_live_listing1_s').attr('title', val);

							$('#tot_live_listing2_s').attr('title', val);

							$('#tot_live_listing3_s').attr('title', val);

							$('#tot_live_listing4_s').attr('title', val);

							$('#tot_live_listing5_s').attr('title', val);

							

							

						//---------- pending listings ---------	

							

						}else if(key =='tot_pend')

						{

							$("#listing2_tot_pend").text(val);

						}else if(key =='pen_rentals')

						{

							$('#listing2_tot_pend_r').attr('title', val);

						}else if(key =='pen_sales')

						{

							$('#listing2_tot_pend_s').attr('title', val);

						

						//---------- listings with less than 10 photos -------

						}else if(key =='tot_img')

						{

							$("#listing2_tot_img").text(val);

							

						}else if(key =='rent_pics')

						{

							$('#listing2_tot_img_r').attr('title', val);

						}else if(key =='sale_pics')

						{

							$('#listing2_tot_img_s').attr('title', val);

							

							

						//---------- litings expired in last 15-30 days -------	

						}else if(key =='expd_rentals')	

						{

							$("#listing2_expd_r").attr('title', val);

						}else if(key =='expd_sales')

						{

							$('#listing2_expd_s').attr('title', val);

						}else if(key =='tot_expd')

						{

							$('#listing2_expd').text(val);

							

							

						//---------- litings expiring in next 15-30 days -------	

						}else if(key =='expg_rentals')

						{

							$('#listing2_tot_expg_r').attr('title', val);

						}else if(key =='expg_sales')

						{

							$('#listing2_tot_expg_s').attr('title', val);

						}else{

							

							$("#listing2_tot_expg").text(val);

						}

					});

					//Pie Chart

						var tot_live	=	json['tot_live'];

						var tot_pend	=	json['tot_pend'];

						var tot_img	    =	json['tot_img'];

						var tot_expg	=	json['tot_expg'];

						var tot_expd	=	json['tot_expd'];

						drawChart(tot_live,tot_pend,tot_img,tot_expg,tot_expd);

						drawChartListing(json['tot_live'],json['tot_sale1'],json['tot_rent1'],json['tot_pend'],json['pen_sales'],json['pen_rentals'],json['tot_img'],json['rent_pics'],json['sale_pics']);

					

					

				

				

			});

	//users listings overview		

			$.getJSON(site_url+"/dashboard/users_listings_overview", function(json){ 

				 

				

				if(config.user.accessLevel == 3)

				{

					json = json[0];

					var data = [];

				   data[0] = {label: "Total Rentals",data: Number(json['rentals'])};

				   data[1] = {label: "Total Sales",data: Number(json['sales'])};

				  var companyleads = $("#listings_by_users");

					

					$.plot(companyleads, data, {

						series: {

							pie: {

								show: true

							}

						},

						grid: {

							hoverable: true,

							clickable: true

						},

						 legend: {

					        container: '#graphLegend_listings_by_users'     

					   },

						tooltip: {

							show: true,

							content: "%p.0%, %s", // show percentages, rounding to 2 decimal places

							shifts: {

							  x: 20,

							  y: 0

							},

							defaultTheme: false

						  }

					}

					

					

					);

				}else{

					//json = json[0];

					var data = [];

					

						$.each(json, function (key, val) {

							

							var lis,ag;

							$.each(val, function (key1, val1) {

						

									if(key1 == "listings")

									{

										lis = val1;

									}

									if(key1 == "agent")

									{

										ag = val1;

									}

					

				  			});

				 		 data[key] = {label: ag,data: Number(lis)};

					});

				

				  var companyleads = $("#listings_by_users");

					

					$.plot(companyleads, data, {

						series: {

							pie: {

								show: true

							}

						},

						grid: {

							hoverable: true,

							clickable: true

						},

						 legend: {

					        container: '#graphLegend_listings_by_users'     

					   },

						tooltip: {

							show: true,

							content: "%p.0%, %s", // show percentages, rounding to 2 decimal places

							shifts: {

							  x: 20,

							  y: 0

							},

							defaultTheme: false

						  }

					}

					

					

					);

				}

			});				

	//leads overview		

			$.getJSON(site_url+"/dashboard/leads_overview", function(json){ 

				 json = json[0];

				

				$.each(json, function (key, val) {

				

							

						if(key =='successfull_ld')

						{

							$("#tot_live_leads1").text(Number(val));

							$("#tot_live_leads1").attr('title', val);

							$("#tot_live_leads2").text(Number(val));

							$("#tot_live_leads2").attr('title', val);

							$("#tot_live_leads3").text(Number(val));

							$("#tot_live_leads3").attr('title', val);

							$("#tot_live_leads4").text(Number(val));

							$("#tot_live_leads4").attr('title', val);

							$("#tot_live_leads5").text(Number(val));

							$("#tot_live_leads5").attr('title', val);

						}else if(key =='successfull_ld_r')

						{

							$("#tot_live_leads1_r").attr('title',val);

							$("#tot_live_leads2_r").attr('title',val);

							$("#tot_live_leads3_r").attr('title',val);

							$("#tot_live_leads4_r").attr('title',val);

							$("#tot_live_leads5_r").attr('title',val);

						}else if(key =='successfull_ld_s')

						{

							$("#tot_live_leads1_s").attr('title',val);

							$("#tot_live_leads2_s").attr('title',val);

							$("#tot_live_leads3_s").attr('title',val);

							$("#tot_live_leads4_s").attr('title',val);

							$("#tot_live_leads5_s").attr('title',val);

						}else if(key =='lst_one_week')

						{

							$("#tot_live_leads3_week").text(val);

							

						}else if(key =='lst_one_week_r')

						{

							$("#tot_live_leads3_week_r").attr('title',val);

						}else if(key =='lst_one_week_s')

						{

							$("#tot_live_leads3_week_s").attr('title',val);

						}else if(key =='twinty_four')

						{

							$("#tot_live_leads3_24").text(val);

							$("#tot_live_leads3_24").attr('title', val);

						}else if(key =='twinty_four_r')

						{

							$("#tot_live_leads3_24_r").attr('title',val);

						}else if(key =='twinty_four_s')

						{

							$("#tot_live_leads3_24_s").attr('title',val);

						}else if(key =='lst_month_ld')

						{

							$("#lst_month_ld").text(val);

							$("#lst_month_ld").attr('title', val);

						}else if(key =='lst_month_ld_r')

						{

							$("#lst_month_ld_r").attr('title',val);

						}else if(key =='lst_month_ld_r')

						{

							$("#lst_month_ld_r").attr('title',val);

						}else if(key =='lst_month_ld_s')

						{

							$("#lst_month_ld_s").attr('title',val);

						}else if(key =='open_ld')

						{

							$("#tot_live_leads3_open").text(val);

							$("#tot_live_leads3_open").attr('title', val);

						}else if(key =='open_ld_r')

						{

							$("#tot_live_leads3_open_r").attr('title',val);

						}else if(key =='open_ld_s')

						{

							$("#tot_live_leads3_open_s").attr('title',val);

						}else if(key =='closed_ld')

						{

							$("#tot_live_leads3_closed").text(val);

							$("#tot_live_leads3_closed").attr('title', val);

						}else if(key =='closed_ld_r')

						{

							$("#tot_live_leads3_closed_r").attr('title',val);

						}else if(key =='closed_ld_s')

						{

							$("#tot_live_leads3_closed_s").attr('title',val);

						}

						

					});

					//draw chart

					 var successfull_ld	=	json['successfull_ld'];

					 var twinty_four	=	json['twinty_four'];

					 var open_ld		=	json['open_ld'];

					 var lst_one_week	=	json['lst_one_week'];

					 var closed_ld		=	json['closed_ld'];

					 var lst_month_ld	=	json['lst_month_ld'];

					 drawChartLead(successfull_ld,twinty_four,open_ld,lst_one_week,closed_ld,lst_month_ld);

					 drawChartLeads("Sucessful",json['successfull_ld_s'],json['successfull_ld_r'],"Leads in 24hrs",json['twinty_four_s'],json['twinty_four_r'],"Open Leads",json['open_ld_s'],json['open_ld_r'],"Closed Leads",json['closed_ld_s'],json['closed_ld_r']);

					

					});	

					

	//my deals overview

		$.getJSON(site_url+"/dashboard/mydeals_overview", function(json){ 

				 json = json[0];

				

				$.each(json, function (key, val) {

						if(key =='tot_completed')

						{

					   		$("#tot_live_deals1").text(val);

					    	$("#tot_live_deals2").text(val);

							$("#tot_live_deals3").text(val);

							$("#tot_live_deals4").text(val);

							$("#tot_live_deals5").text(val);

						}else if(key =='tot_progress')

						{

							$("#tot_live_deals4_p").text(val);

							

						}else if(key =='lst_deal')

						{

							$("#tot_live_deals4_m").text(val);

							$("#tot_mydeal_lst_month_h").text(val);

							$("#tot_mydeal_lst_month_sh").text(val);

						}else if(key =='tot_ren_cmp')

						{

							$('#tot_live_deals1_r').attr('title', val);

							$('#tot_live_deals2_r').attr('title', val);

							$('#tot_live_deals3_r').attr('title', val);

							$('#tot_live_deals4_r').attr('title', val);

							$('#tot_live_deals5_r').attr('title', val);

						}

						else if(key =='tot_sale_cmp')

						{

							$('#tot_live_deals1_s').attr('title', val);

							$('#tot_live_deals2_s').attr('title', val);

							$('#tot_live_deals3_s').attr('title', val);

							$('#tot_live_deals4_s').attr('title', val);

							$('#tot_live_deals5_s').attr('title', val);

						}

						else if(key =='tot_ren_p')

						{

							$('#tot_live_deals4_pr').attr('title', val);

							$('#db_prog_r_h').attr('title', val);

						}

						else if(key =='tot_sale_p')

						{

							$('#tot_live_deals4_ps').attr('title', val);

							$('#db_prog_s_h').attr('title', val);

						}

						else if(key =='lst_ren')

						{

							$('#tot_live_deals4_mr').attr('title', val);

							$('#db_lst_dr_h').attr('title', val);

							$('#db_lst_dr_f').attr('title', val);

						}else if(key =='lst_sale')

						{

							$('#tot_live_deals4_ms').attr('title', val);

							$('#db_lst_ds_h').attr('title', val);

							$('#db_lst_ds_f').attr('title', val);

						

						}else if(key =='year_to_end')

						{

							$("#tot_live_deals4_y").text(Number(val));

					    	

						}else if(key =='year_to_endr')

						{

							$('#tot_live_deals4_yr').attr('title', val);

							//$('#ren_2014_h').attr('title', val);

						}else if(key =='year_to_ends')

						{

							$('#tot_live_deals4_ys').attr('title', val);

							//$('#sale_2014_h').attr('title', val);

						}

					});

					 var tot_mydeal_cmp	=	json['tot_completed'];

					 var year_to_end	=	json['year_to_end'];

					 

					 var tot_progress	=	json['tot_progress'];

					 var lst_deal		=	json['lst_deal'];

				

					drawChartDeal(tot_mydeal_cmp,year_to_end,tot_progress,lst_deal);

				

					drawChartDealBar("Company Deals",json['tot_sale_cmp'],json['tot_ren_cmp'],"Year to end",json['year_to_ends'],json['year_to_endr'],"Deals in Progress",json['tot_sale_p'],json['tot_ren_p'],"Complete last Month",json['lst_sale'],json['lst_ren']);

			});	

			

			

			

			function drawChartLead(successfull_ld,twinty_four,open_ld,lst_one_week,closed_ld,lst_month_ld) {

			  

					

			  var data = [];

				   data[0] = {label: "Total Successful Leads",data: Number(successfull_ld)};

				   data[1] = {label: "Leads received in 24 hours",data: Number(twinty_four)};

				   data[2] = {label: "Open leads",data: Number(open_ld)};

				   data[3] = {label: "Leads received in one week",data: Number(lst_one_week)};

				   data[4] = {label: "Closed leads",data: Number(closed_ld)};

				   data[5] = {label: "Leads received in one month",data: Number(lst_month_ld)};

					

				

					

					

				  	var companyleads = $("#companyleads");

					

					$.plot(companyleads, data, {

						series: {

							pie: {

								show: true

							}

						},

						grid: {

							hoverable: true,

							clickable: true

						},

						 legend: {

					        container: '#graphLegend_Leads'     

					   },

						tooltip: {

							show: true,

							content: "%p.0%, %s", // show percentages, rounding to 2 decimal places

							shifts: {

							  x: 20,

							  y: 0

							},

							defaultTheme: false

						  }

					}

					

					

					);

					}

				

			function drawChartDeal(tot_mydeal_cmp,year_to_end,tot_progress,lst_deal) {

				  var data1 = [];

				   data1[0] = {label: "Company Deals",data: Number(tot_mydeal_cmp)};

				   data1[1] = {label: "Year to end deals",data: Number(year_to_end)};

				   data1[2] = {label: "Deals in progress",data: Number(tot_progress)};

				   data1[3] = {label: "Deals completed in a month",data: Number(lst_deal)};

				 

			

			var companydeals = $("#companydeals");

			$.plot(companydeals, data1, {

				series: {

					pie: {

						show: true

					}

				},

				grid: {

					hoverable: true,

					clickable: true

				},

				legend: {

					        container: '#graphLegend_Deals'     

					   },

				tooltip: {

							show: true,

							content: "%p.0%, %s", // show percentages, rounding to 2 decimal places

							shifts: {

							  x: 20,

							  y: 0

							},

							defaultTheme: false

						  }

			});

			$("#companydeals").bind("plotclick", function(event, pos, obj){

       

					if (!obj){return;}

					percent = parseFloat(obj.series.percent).toFixed(2);

					alert(obj.series.label + " ("+ percent+ "%)");

				  

				});

			}

			

			function drawChart(tot_live,tot_pend,tot_img,tot_expg,tot_expd) {

				

				   var data = [];

				   data[0] = {label: "Live",data: Number(tot_live)};

				   data[1] = {label: "Pending",data: Number(tot_pend)};

				   data[2] = {label: "less than 10 photos",data: Number(tot_img)};

				   data[3] = {label: "Expiring 15–30 days",data: Number(tot_expg)};

				   data[4] = {label: "Expired Last 15–30 days",data: Number(tot_expd)};

					

				

					

					

				  	var placeholder = $("#placeholder");

					placeholder.unbind();

					$.plot(placeholder, data, {

						series: {

							pie: {

								show: true

							}

						},

						grid: {

							hoverable: true,

							clickable: true

						},

						legend: {

						        container: '#graphLegend'     

						    },

						tooltip: {

							show: true,

							content: "%p.0%, %s", // show percentages, rounding to 2 decimal places

							shifts: {

							  x: 20,

							  y: 0

							},

							defaultTheme: false

						  }

					}

					

					

					);

					

			

			}

			drawChartContacts();

			function drawChartContacts() {

				

				   var data = [];

				   data[0] = {label: "Buyer",data: Number($('#buyer_lst').text())};

				   data[1] = {label: "Seller",data: Number($('#seller_lst').text())};

				   data[2] = {label: "Landlord",data: Number($('#landlord_lst').text())};

				  

					

				

					

					

				  	var companycontacts = $("#companycontacts");

					companycontacts.unbind();

					$.plot(companycontacts, data, {

						series: {

							pie: {

								show: true

							}

						},

						grid: {

							hoverable: true,

							clickable: true

						},

						 legend: {

					        container: '#graphLegend_Contacts'     

					   },

						tooltip: {

							show: true,

							content: "%p.0%, %s", // show percentages, rounding to 2 decimal places

							shifts: {

							  x: 20,

							  y: 0

							},

							defaultTheme: false

						  }

					}

					

					

					);

					

			

			}

			drawChartPortals();

			function drawChartPortals() {

				

				   var data = [];

				   data[0] = {label: "JustRentals",data: Number($('#justrentals').text())};

				   data[1] = {label: "JustProperty",data: Number($('#justproperty').text())};

				   data[2] = {label: "Dubizzle",data: Number($('#dubizzle').text())};

				   data[3] = {label: "Propertyfinder",data: Number($('#propertyfinder').text())};

				    data[4] = {label: "Others",data: Number($('#others').text())};

				  

					

				

					

					

				  	var portalsoverview = $("#portalsoverview");

					portalsoverview.unbind();

					$.plot(portalsoverview, data, {

						series: {

							pie: {

								show: true

							}

						},

						grid: {

							hoverable: true,

							clickable: true

						},

						legend: {

					        container: '#graphLegend_Portals'     

					   },

						tooltip: {

							show: true,

							content: "%p.0%, %s", // show percentages, rounding to 2 decimal places

							shifts: {

							  x: 20,

							  y: 0

							},

							defaultTheme: false

						  }

					}

					

					

					);

					

			

			}

			

			

			//bar chart area

			//drawChartListing();

			function drawChartListing(livelist,livesale,liverent,pendinglist,pendsale,pendrent,lesspics,lesspicssale,lesspicsrent)

			{

				var portalsArray = [];

				var salesArray = [];

				var rentalsArray = [];

				var itemsCount = 0;

				//$.each(portalData, function( index, value ) {

				  portalsArray.push([1,livelist]);

				  salesArray.push([1,livesale]);

				  rentalsArray.push([1,liverent]);

				 // itemsCount++;

				//});

				  portalsArray.push([2,pendinglist]);

				  salesArray.push([2,pendsale]);

				  rentalsArray.push([2,pendrent]);

				   portalsArray.push([3,lesspics]);

				  salesArray.push([3,lesspicssale]);

				  rentalsArray.push([3,lesspicsrent]);

				  itemsCount = 3;

				  plotDataMe(salesArray,rentalsArray,portalsArray,itemsCount);

		

				

			}

			function plotDataMe(salesDataArray , rentalsDataArray, portalsDataArray,itemsCount){

	var dataToPlot = [

        {

            label: "Sales",

            data: salesDataArray,

            bars: {

                show: true,

                barWidth: 0.25,

                fill: true,

                lineWidth: 1,

                order: 1,

                fillColor:  "#2C9950"

            },

            color: "#2C9950"

        },

        {

            label: "Rentals",

            data: rentalsDataArray,

            bars: {

                show: true,

                barWidth: 0.25,

                fill: true,

                lineWidth: 1,

                order: 2,

                fillColor:  "#D13C39"

            },

            color: "#D13C39"

        }

    ];

    

    $.plot($("#listings_bar"), dataToPlot, {

        xaxis: {

                    min: 0,

                    max: itemsCount+1,

                    mode: null,

                    ticks: portalsDataArray,

                    tickLength: 0,

                    axisLabel: "Portals",

                    axisLabelUseCanvas: false,

                    axisLabelFontSizePixels: 12,

                    axisLabelFontFamily: "Raleway, Arial, Helvetica, Tahoma, sans-serif",

                    axisLabelPadding: 5

                }, yaxis: {

                    axisLabel: "No of Listings",

                    tickDecimals: 0,

                    axisLabelUseCanvas: false,

                    axisLabelFontSizePixels: 12,

                    axisLabelFontFamily: "Raleway, Arial, Helvetica, Tahoma, sans-serif",

                    axisLabelPadding: 5

                },

        grid: {

            hoverable: true,

            clickable: false,

            borderWidth: 0.5

        },

        legend: {'position': 'ne', 'show': true, 'margin': [-3, -20], 'backgroundOpacity': 0.1, 'noColumns'

: 3, 'container': null},

        series: {

            shadowSize: 1

        },

        tooltip: true,

        tooltipOpts: {

            content: "%y %s Listings",

            shifts: {

                x: -60,

                y: 25

            }

        }

    });

		

		   

		    

		

   }

     ////////////////js code for bar chart view -leads /////////////////////////////

			 function drawChartLeads(s_ld,s_lds,s_ldr,ttf,ttfs,ttfr,old,olds,oldr)

			{

				var portalsArray = [];

				var salesArray = [];

				var rentalsArray = [];

				var itemsCount = 0;

				//$.each(portalData, function( index, value ) {

				  portalsArray.push([1,s_ld]);

				  salesArray.push([1,s_lds]);

				  rentalsArray.push([1,s_ldr]);

				 // itemsCount++;

				//});

				  portalsArray.push([2,ttf]);

				  salesArray.push([2,ttfs]);

				  rentalsArray.push([2,ttfr]);

				   portalsArray.push([3,old]);

				  salesArray.push([3,olds]);

				  rentalsArray.push([3,oldr]);

				  itemsCount = 3;

				  plotDataLead(salesArray,rentalsArray,portalsArray,itemsCount);

			}

				 function plotDataLead(salesDataArray , rentalsDataArray, portalsDataArray,itemsCount){ 

				  var dataToPlot = [

        {

            label: "Sales",

            data: salesDataArray,

            bars: {

                show: true,

                barWidth: 0.25,

                fill: true,

                lineWidth: 1,

                order: 1,

                fillColor:  "#2C9950"

            },

            color: "#2C9950"

        },

        {

            label: "Rentals",

            data: rentalsDataArray,

            bars: {

                show: true,

                barWidth: 0.25,

                fill: true,

                lineWidth: 1,

                order: 2,

                fillColor:  "#D13C39"

            },

            color: "#D13C39"

        }

    ];

    

    $.plot($("#leads_bar"), dataToPlot, {

        xaxis: {

                    min: 0,

                    max: itemsCount+1,

                    mode: null,

                    ticks: portalsDataArray,

                    tickLength: 0,

                    axisLabel: "Leads Category",

                    axisLabelUseCanvas: false,

                    axisLabelFontSizePixels: 12,

                    axisLabelFontFamily: "Raleway, Arial, Helvetica, Tahoma, sans-serif",

                    axisLabelPadding: 5

                }, yaxis: {

                    axisLabel: "No of Listings",

                    tickDecimals: 0,

                    axisLabelUseCanvas: false,

                    axisLabelFontSizePixels: 12,

                    axisLabelFontFamily: "Raleway, Arial, Helvetica, Tahoma, sans-serif",

                    axisLabelPadding: 5

                },

        grid: {

            hoverable: true,

            clickable: false,

            borderWidth: 0.5

        },

        legend: {'position': 'ne', 'show': true, 'margin': [-3, -20], 'backgroundOpacity': 0.1, 'noColumns'

: 3, 'container': null},

        series: {

            shadowSize: 1

        },

        tooltip: true,

        tooltipOpts: {

            content: "%y %s Listings",

            shifts: {

                x: -60,

                y: 25

            }

        }

    });

		

				

			}

				 function drawChartDealBar(cd,cds,cdr,yte,ytes,yter,dp,dps,dpr,lst,lsts,lstr)

			{

				var portalsArray = [];

				var salesArray = [];

				var rentalsArray = [];

				var itemsCount = 0;

				//$.each(portalData, function( index, value ) {

				  portalsArray.push([1,cd]);

				  salesArray.push([1,cds]);

				  rentalsArray.push([1,cdr]);

				 // itemsCount++;

				//});

				  portalsArray.push([2,yte]);

				  salesArray.push([2,ytes]);

				  rentalsArray.push([2,yter]);

				   portalsArray.push([3,dp]);

				  salesArray.push([3,dps]);

				  rentalsArray.push([3,dpr]);

				  portalsArray.push([3,lst]);

				  salesArray.push([3,lsts]);

				  rentalsArray.push([3,lstr]);

				  itemsCount = 4;

				  plotDataDeal(salesArray,rentalsArray,portalsArray,itemsCount);

			}

			 function plotDataDeal(salesDataArray , rentalsDataArray, portalsDataArray,itemsCount){ 

				  var dataToPlot = [

        {

            label: "Sales",

            data: salesDataArray,

            bars: {

                show: true,

                barWidth: 0.25,

                fill: true,

                lineWidth: 1,

                order: 1,

                fillColor:  "#2C9950"

            },

            color: "#2C9950"

        },

        {

            label: "Rentals",

            data: rentalsDataArray,

            bars: {

                show: true,

                barWidth: 0.25,

                fill: true,

                lineWidth: 1,

                order: 2,

                fillColor:  "#D13C39"

            },

            color: "#D13C39"

        }

    ];

    

    $.plot($("#deals_bar"), dataToPlot, {

        xaxis: {

                    min: 0,

                    max: itemsCount+1,

                    mode: null,

                    ticks: portalsDataArray,

                    tickLength: 0,

                    axisLabel: "Deals Category",

                    axisLabelUseCanvas: false,

                    axisLabelFontSizePixels: 12,

                    axisLabelFontFamily: "Raleway, Arial, Helvetica, Tahoma, sans-serif",

                    axisLabelPadding: 5

                }, yaxis: {

                    axisLabel: "No of Listings",

                    tickDecimals: 0,

                    axisLabelUseCanvas: false,

                    axisLabelFontSizePixels: 12,

                    axisLabelFontFamily: "Raleway, Arial, Helvetica, Tahoma, sans-serif",

                    axisLabelPadding: 5

                },

        grid: {

            hoverable: true,

            clickable: false,

            borderWidth: 0.5

        },

        legend: {'position': 'ne', 'show': true, 'margin': [-3, -20], 'backgroundOpacity': 0.1, 'noColumns'

: 3, 'container': null},

        series: {

            shadowSize: 1

        },

        tooltip: true,

        tooltipOpts: {

            content: "%y %s Listings",

            shifts: {

                x: -60,

                y: 25

            }

        }

    });

		

				

			}

			

			//portals for bar chart	

			$.getJSON(site_url+"/dashboard/get_portal_overview", function(portalData){

    	var portalsArray = [];

    	var salesArray = [];

    	var rentalsArray = [];

		var itemsCount = 0;

    	$.each(portalData, function( index, value ) {

    	  portalsArray.push([index+1,value['portal']]);

    	  salesArray.push([index+1,value['sales']]);

    	  rentalsArray.push([index+1,value['rentals']]);

    	  itemsCount++;

		});

		

		plotDataPortals(salesArray,rentalsArray,portalsArray,itemsCount);

    });

	function plotDataPortals(salesDataArray , rentalsDataArray, portalsDataArray,itemsCount){

	var dataToPlot = [

        {

            label: "Sales",

            data: salesDataArray,

            bars: {

                show: true,

                barWidth: 0.25,

                fill: true,

                lineWidth: 1,

                order: 1,

                fillColor:  "#2C9950"

            },

            color: "#2C9950"

        },

        {

            label: "Rentals",

            data: rentalsDataArray,

            bars: {

                show: true,

                barWidth: 0.25,

                fill: true,

                lineWidth: 1,

                order: 2,

                fillColor:  "#D13C39"

            },

            color: "#D13C39"

        }

    ];

    

    $.plot($("#portal_bar"), dataToPlot, {

        xaxis: {

                    min: 0,

                    max: itemsCount+1,

                    mode: null,

                    ticks: portalsDataArray,

                    tickLength: 0,

                    axisLabel: "Portals",

                    axisLabelUseCanvas: false,

                    axisLabelFontSizePixels: 12,

                    axisLabelFontFamily: "Raleway, Arial, Helvetica, Tahoma, sans-serif",

                    axisLabelPadding: 5

                }, yaxis: {

                    axisLabel: "No of Listings",

                    tickDecimals: 0,

                    axisLabelUseCanvas: false,

                    axisLabelFontSizePixels: 12,

                    axisLabelFontFamily: "Raleway, Arial, Helvetica, Tahoma, sans-serif",

                    axisLabelPadding: 5

                },

        grid: {

            hoverable: true,

            clickable: false,

            borderWidth: 0.5

        },

        legend: {'position': 'ne', 'show': true, 'margin': [-3, -20], 'backgroundOpacity': 0.1, 'noColumns'

: 3, 'container': null},

        series: {

            shadowSize: 1

        },

        tooltip: true,

        tooltipOpts: {

            content: "%y %s Listings",

            shifts: {

                x: -60,

                y: 25

            }

        }

    });

}