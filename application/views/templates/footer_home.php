<div class="footer">
<p class="copyright_txt text-center">© Gistler. All rights reserved.</p>
</div>

</body>
    <!-- jQuery -->


    <script language="javascript" type="text/javascript" 
	src="<?php echo base_url(); ?>js/plugins/flot/jquery.flot.min.js"></script>
    <script language="javascript" type="text/javascript" 
    src="<?php echo base_url(); ?>js/plugins/flot/jquery.flot.pie.min.js"></script>
    <script language="javascript" type="text/javascript" 
    src="<?php echo base_url(); ?>js/plugins/flot/jquery.flot.time.min.js"></script>
    <script language="javascript" type="text/javascript" 
    src="<?php echo base_url(); ?>js/plugins/flot/jquery.flot.axislabels.js"></script>
    <script language="javascript" type="text/javascript" 
    src="<?php echo base_url(); ?>js/plugins/flot/jquery.flot.orderBars.js"></script>
    <script language="javascript" type="text/javascript" 
    src="http://cdnjs.cloudflare.com/ajax/libs/flot/0.8.2/jquery.flot.resize.min.js"></script>
      <script language="javascript" type="text/javascript" 
    src="<?php echo base_url(); ?>js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    
    
    
    
    
    
    
    <script src="<?php echo base_url(); ?>js/dev.js"></script>
   
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
    
    <!-- Left menu JavaScript -->
    <script src="<?php echo base_url(); ?>js/classie.js"></script>
    <!-- <script src="js/gnmenu.js"></script> 
    <script>
        new gnMenu( document.getElementById( 'gn-menu' ) );
    </script>
    -->
    <script src='http://fullcalendar.io/js/fullcalendar-2.4.0/lib/moment.min.js'></script>
    <script src='http://fullcalendar.io/js/fullcalendar-2.4.0/fullcalendar.min.js'></script>


    
    <!-- Left menu sub item open JavaScript -->
    <script type="text/javascript">

         var h ={};
		    h = {
                left: 'title',
                center: '',
                right: 'prev, next, today,month,agendaWeek,agendaDay'
            };
		  $('#calendar').fullCalendar({
			header: h,
			editable: false,
			events: '<?php echo site_url(); ?>/dashboard/getCalendarData',
                       // timeFormat: 'HH(:mm) tt {- HH(:mm) tt}',
			eventClick: function(calEvent, jsEvent, view) {
				
					$('#event-type').html(calEvent.event_type);
					$('#event-description').html(calEvent.description);
					$('#event-startdate').text(calEvent.start);
					$('#event-enddate').text(calEvent.end);
					$('#event-name').html(calEvent.title);
					//$('#myModal').modal(options);
					$('#myModal').modal('show');
			}
		});
        $('#collapseExample').on('show.bs.collapse', function () {
                $("#agentparea").addClass('heightme110')
        });
        $('#collapseExample').on('hide.bs.collapse', function () {
                $("#agentparea").removeClass('heightme110')
        });
    
        
      $(document).ready(function(){
        $('#cssmenu > ul > li.sidebar_dropdown > a').click(function() {
      
        var checkElement = $(this).next();
        $('#cssmenu li.sidebar_dropdown').removeClass('active');
        $(this).closest('li.sidebar_dropdown').addClass('active'); 
      
        if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
          $(this).closest('li.sidebar_dropdown').removeClass('active');
          checkElement.slideUp('fast');
        }
        if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
          $('#cssmenu ul ul:visible').slideUp('fast');
          checkElement.slideDown('fast');
        }
      
        if($(this).closest('li').find('ul').children().length == 0) {
          return true;
        } else {
          return false; 
        }
      });
      });
    </script>

<!-- custom scroll bar Js -->
<script src="<?php echo base_url(); ?>js/scrollbar.js"></script>

<script type="text/javascript">
    jQuery(document).ready(function(){
    jQuery('.scrollbar-inner').scrollbar();
    });
</script>
<!-- Page Scrolling Js -->
<script src="<?php echo base_url(); ?>js/page-scrolling.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
    jQuery('.fadeInUp').addClass("hidden").viewportChecker({
    classToAdd: 'visible animated fadeInUp', // Class to add to the elements when they are visible
    offset: 100    
           });   
});            
</script>


        
     <!-- Top phone popover -->
    <script>
    $(function () {
      $('[data-toggle="popover"]').popover()
    })
    </script>
    <script src="<?php echo base_url(); ?>js_module/dashboard.js"></script>
</html>