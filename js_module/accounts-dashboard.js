$(document).ready(function() {
    loadDetails(selectedBankId);
    $("#bankNames").change(function(e){
        if($("select[name='bankNames'] option:selected").index() > 0 ){
            selectedBankId = $("select[name='bankNames'] option:selected").val();
            loadDetails(selectedBankId);
        }
   });
});

var income_by_category_chart = {
	                chart: {
	                    renderTo: 'income_by_category',
	            plotBackgroundColor: null,
	            plotBorderWidth: null,
	            plotShadow: false
	        },
	        title: {
	            text: 'Income By Category',
	            style: {
	                color: '#0E6E0F',
	                font: 'Museo300Regular'
	            }
	        },
	        credits: {
	            text: 'Propspace',
	            href: 'http://propspace.com'
	        },
	        tooltip: {
	            formatter: function() {
	                return '<b>'+ this.point.name +'</b>: '+ Math.round(this.percentage) +' % <br />' + this.point.config.currency + ' ' + this.point.config.total;
	            }
	        },
	        exporting: {
	            buttons: {
	                exportButton: {
	                    enabled: true
	                },
	                printButton: {
	                    enabled: false
	                }
	            }
	        },
	        plotOptions: {
	            pie: {
	                allowPointSelect: true,
	                cursor: 'pointer',
	                dataLabels: {
	                    enabled: true,
	                    color: '#000000',
	                    connectorColor: '#000000',
	                    distance:6,
	                    formatter: function() {
	                        return '<b>'+ this.point.name +'</b>: '+ Math.round(this.percentage) +' % <br />' + this.point.config.currency + ' ' + this.point.config.total;
	                    }
	                }
	            }
	        },
	        series: [{
	            type: 'pie',
	            name: 'Income By Category',
	            data: []
	        }]
	    }



var expense_by_category_chart = {
        chart: {
            renderTo: 'expenses_by_category',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Expenses By Category',
            style: {
                color: '#990000'
            }
        },
        credits: {
            text: 'Propspace',
            href: 'http://propspace.com'
        },
        tooltip: {
            formatter: function() {
                return '<b>'+ this.point.name +'</b>: '+ Math.round(this.percentage) +' % <br />' + this.point.config.currency + ' ' + this.point.config.total;
            }
        },
        exporting: {
            buttons: {
                exportButton: {
                    enabled: true
                },
                printButton: {
                    enabled: false
                }
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    color: '#000000',
                    connectorColor: '#000000',
                    distance:6,
                    formatter: function() {
                        return '<b>'+ this.point.name +'</b>: '+ Math.round(this.percentage) +' % <br />' + this.point.config.currency + ' ' + this.point.config.total;
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Expenses By Category',
            data: []
        }]
    }
    
function isEmptyObj(obj){
        return (JSON.stringify(obj) === '[]');
    }
    
function loadDetails(bankId, starttime, endtime){
       
       $.getJSON(mainurl+"accounts/single_bank_account/"+bankId, function(data){
            var bankDetailsData = '';
            bankDetailsData = "<b>Account:</b> "+ data.name + "<br />";
            bankDetailsData = bankDetailsData + " <b>Account #:</b> "+ data.account_no + "<br />";
            
            if(data.branch_name !== null){
                bankDetailsData = bankDetailsData + "<b>Branch:</b> " + data.branch_name + "<br />";
            }
            
            if(data.currency_code !== null){
                bankDetailsData = bankDetailsData + "<b>Currency:</b> " + data.currency_code + " - " + data.currency_name + "<br />";
            }
            
            if(data.iban_no !== null){
                bankDetailsData = bankDetailsData + "<b>IBAN: </b>"+ data.iban_no;
            }
            
            
            $("#bankDetails").html(bankDetailsData);
            $("#bankNameDetails").html(data.name);
            $('#account_current_balance').html("Current Balance: "+ data.currency_code + " " +data.currentBalance);
        });
        
        if(starttime === undefined){
            starttime = 0;
        }
        if(endtime === undefined){
            endtime = 0;
        }
        
        var url = mainurl+"accounts/getChartData/"+bankId + '?starttime=' + starttime + '&endtime=' + endtime;
        
        $.getJSON(url, function(data){
                            
            $('#expense_data_table').html('');
            $('#income_data_table').html('');
            $('#income_by_category').html('');
            $('#expenses_by_category').html('');
            
            if(isEmptyObj(data.income) && isEmptyObj(data.expense)){
                $('#no-data-available').css('display','block');
            }else{
                $('#no-data-available').css('display','none');
            }
            
            if(isEmptyObj(data.income)){
            // Data Empty
            }else{
                income_by_category_chart.series[0].data = data.income;
                income_chart = new Highcharts.Chart(income_by_category_chart);
                
                $('#income_data_table').append('<tr><td width=\'50%\' style=\'border-right: 1px solid #999999; border-bottom: 1px solid #999999; padding-bottom: 5px;\'>Income Breakdown </td><td style=\'border-bottom: 1px solid #999999\'>&nbsp;</td></tr>');
                        $.each(data.income, function(k, v){
                            $('#income_data_table').append('<tr><td style=\'border-right: 1px solid #999999; padding-top: 5px;\'>'+ v.name +'</td><td style=\'color: #999999; padding-left: 10px; padding-top: 5px;\'>'+ v.currency + ' ' + v.total+'</td></tr>');
                });
                
            }
            
            if(isEmptyObj(data.expense)){
                //Expense is empty
            }else{
                expense_by_category_chart.series[0].data = data.expense;
                expense_chart = new Highcharts.Chart(expense_by_category_chart);

                $('#expense_data_table').append('<tr><td width=\'50%\' style=\'border-right: 1px solid #999999; border-bottom: 1px solid #999999; padding-bottom: 5px;\'>Expenses Breakdown</td><td style=\'border-bottom: 1px solid #999999\'>&nbsp;</td></tr>');
                $.each(data.expense, function(k, v){
                    $('#expense_data_table').append('<tr><td style=\'border-right: 1px solid #999999; padding-top: 5px;\'>'+ v.name +'</td><td style=\'color: #999999; padding-left: 10px; padding-top: 5px;\'>'+ v.currency + ' ' + v.total+'</td></tr>');
                });
            }

            $('#total_amount').html(data.currency + '&nbsp;' + data.total_income +  '<br />' + data.currency + '&nbsp;' + data.total_expense);
        });
   }
   
$(function()
{

    /*
     define a new language named "custom"
     */

	$.dateRangePickerLanguages['custom'] = {
	        'selected': 'Choosed:',
	        'days': 'Days',
	        'apply': 'Close',
	        'week-1': 'Mon',
	        'week-2': 'Tue',
	        'week-3': 'Wed',
	        'week-4': 'Thu',
	        'week-5': 'Fri',
	        'week-6': 'Sat',
	        'week-7': 'Sun',
	        'month-name': ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
	        'shortcuts': 'Shortcuts',
	        'past': 'Past',
	        '7days': '7days',
	        '14days': '14days',
	        '30days': '30days',
	        'previous': 'Previous',
	        'prev-week': 'Week',
	        'prev-month': 'Month',
	        'prev-quarter': 'Quarter',
	        'prev-year': 'Year',
	        'less-than': 'Date range should longer than %d days',
	        'more-than': 'Date range should less than %d days',
	        'default-more': 'Please select a date range longer than %d days',
	        'default-less': 'Please select a date range less than %d days',
	        'default-range': 'Please select a date range between %d and %d days',
	        'default-default': 'This is costom language'
    };

    $('#date-range10').dateRangePicker({
	        format: 'MMM Do, YYYY',
	        seperator: ' to ',
	        language: 'en',
	        startOfWeek: 'sunday',
	        getValue: function()
	        {
	            return this.value;
	        },
	        setValue: function(s)
	        {
	            this.value = s;
	        },
	        shortcuts:
	                {
	                    'prev-days': [3, 7, 14, 30],
	                    'Current month': ['Current month']
	                },
	        customShortcuts:
	                [
	                    {
	                        name: 'Current month',
	                        dates: function()
	                        {
	                            var date = new Date();
	                            var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
	                            var current_day = new Date();
	                            return [firstDay, current_day];
	                        }
	                    }
	                ]
	    }).bind('datepicker-change',function(event,obj){
	        $('#daterangeFirst').html(obj.date1.toDateString());
	        $('#daterangeLast').html(obj.date2.toDateString());
	        var startDate = Math.round((obj.date1).getTime()/ 1000);
	        var endDate = Math.round((obj.date2).getTime()/ 1000);
	        loadDetails(selectedBankId, startDate, endDate);
			}).bind('datepicker-close',function(){
	        	$('#date-range10').removeClass('selected').addClass('selected');
		});
});