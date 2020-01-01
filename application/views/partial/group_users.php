<?php
 foreach ($grp_users as $listing)
				 {
					 ?>
                     <div class="checkbox">
             	<label class="">
                    <input name="input" id="<?php echo $listing['id'];?>" type="checkbox" class="" value="<?php echo $listing['id'];?>">
                    <span class="lbl padding"><?php echo $listing["first_name"]." ".$listing["last_name"]; ?> </span>
                </label>
                </div>
                     <?php
				 }
				 ?>