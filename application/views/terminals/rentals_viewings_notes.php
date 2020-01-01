<div class="col-lg-12">


			 <?php foreach ($listNotes as $listing):?>

                        <h4 class="text-primary">Listing Notes #1</h4>
                        <div class="well">
                        <div class="row">
                        <div class="col-md-6"><strong>Username:</strong> <?php echo $listing['first_name'];?> <?php echo $listing['last_name'];?></div>
                        <div class="col-md-6"><strong>Date:</strong> <?php echo $listing['dateadded'];?></div>
                        </div>
                        </div>
                        
                        <p><?php echo $listing['notes'];?></p>

                         <?php endforeach;?>
                     
                     
                     
                        </div>