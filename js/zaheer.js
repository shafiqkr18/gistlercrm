// Zaheer JS don't add yours
//Dashboard top tabs
$("#crm-expandlisting").click(function(){
	$("#crm-mysamblocks").addClass('crm-hideme');
	$("#crm-mylisting").show();
})
$("#crm-closelisting").click(function(){

	$("#crm-mysamblocks").removeClass('crm-hideme');
	$("#crm-mylisting").hide();
})

$("#crm-expandleads").click(function(){
	$("#crm-mysamblocks").addClass('crm-hideme');
	$("#crm-myleadsoverview").show();
})
$(".crm-closelisting").click(function(){
	
	$("#crm-mysamblocks").removeClass('crm-hideme');
	$("#crm-myleadsoverview").hide();
})

$("#crm-expanddeals").click(function(){
	$("#crm-mysamblocks").addClass('crm-hideme');
	$("#crm-mydealsoverview").show();
})
$(".crm-closelisting").click(function(){
	
	$("#crm-mysamblocks").removeClass('crm-hideme');
	$("#crm-mydealsoverview").hide();
})

$("#crm-expandcontacts").click(function(){
	$("#crm-mysamblocks").addClass('crm-hideme');
	$("#crm-mycontactsoverview").show();
})
$(".crm-closelisting").click(function(){
	
	$("#crm-mysamblocks").removeClass('crm-hideme');
	$("#crm-mycontactsoverview").hide();
})

// DashBoard Js
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