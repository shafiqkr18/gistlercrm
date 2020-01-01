   <ul id="eemail_list">
   	
   	<?php 
   
   	foreach($res as $listing):
   	
   	if($listing['emails'] != ''){
   	?>
   	<li class="efinalemails"><div id="" class="eemailusers"><span value="" class="eemailid"><?php echo $listing['emails'];?></span></div></li>
   	
   	<?php
   	}
      endforeach;?>
   	
   	</ul>