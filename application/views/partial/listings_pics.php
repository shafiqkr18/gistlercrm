<div id="showimages">
 <div class="row" id="images_lst">

 <?php 
				// print_r($getPic);exit;
				 $photo_count=1;
				 $chk=0;
				  $text='No Image Found!';
				 foreach ($getPic as $listing)
				 {
			$targetPath = base_url()."uploads/listings/".$this->session->userdata('client_id')."/".md5($listing["rand_key"])."/watermark/";
					 ?>
            <div class="col-md-2">
                                    <div class="thumbnail" id="PhotoOrder_<?php echo $listing["id"]; ?>">
                                    <img src="<?php echo $targetPath.$listing["thumb"]; ?>" alt="" class="img-responsive" id="image_<?php echo $listing["id"]; ?>">
                                    </div>
                                     <a  class="btn btn-default btn-xs margin-bottom-15 bar_link" id="<?php echo $listing["id"]; ?>">Delete</a>
                                     <a  class="btn btn-default btn-xs margin-bottom-15 edit_title" id="<?php echo $listing["id"]; ?>">Edit Title</a>
                                        <div class="form-group form_group_checkbox">
                                            <label class="">
                                               <input type="checkbox" checked="checked" value="" class="enable_watermark" name="<?php echo $listing["id"]; ?>" id="<?php echo $listing["id"]; ?>">
                                                <span class="lbl padding">Watermark</span>
                                            </label>
                                        </div>
                                     	<div class="form-group form_group_checkbox">
                                            <label class="">
                                               <input type="checkbox" value="" class="enable_photo" name="<?php echo $listing["id"]; ?>" id="<?php echo $listing["id"]; ?>">
                                                <span class="lbl padding">Contact Image</span>
                                            </label>
                                      </div>
                                    </div>
                                  
				 <?php
  }
  ?>

                                    
  </div>

  <div class="row"  id="images_floor" style="display:none;">

 <?php 
				// print_r($getPic);exit;
				 $photo_count=1;
				 $chk=0;
				  $text='No Image Found!';
				 foreach ($getfloor as $listing)
				 {
			$targetPath = base_url()."uploads/listings/".$this->session->userdata('client_id')."/".md5($listing["rand_key"])."/watermark/";
					 ?>
            <div class="col-md-2">
                                    <div class="thumbnail" id="PhotoOrder_<?php echo $listing["id"]; ?>">
                                    <img src="<?php echo $targetPath.$listing["thumb"]; ?>" alt="" class="img-responsive" id="image_<?php echo $listing["id"]; ?>">
                                    </div>
                                     <a  class="btn btn-default btn-xs margin-bottom-15 bar_link" id="<?php echo $listing["id"]; ?>">Delete</a>
                                     <a  class="btn btn-default btn-xs margin-bottom-15 edit_title" id="<?php echo $listing["id"]; ?>">Edit Title</a>
                                        <div class="form-group form_group_checkbox">
                                            <label class="">
                                               <input type="checkbox" checked="checked" value="" class="enable_watermark" name="<?php echo $listing["id"]; ?>" id="<?php echo $listing["id"]; ?>">
                                                <span class="lbl padding">Watermark</span>
                                            </label>
                                        </div>
                                     	<div class="form-group form_group_checkbox">
                                            <label class="">
                                               <input type="checkbox" value="" class="enable_photo" name="<?php echo $listing["id"]; ?>" id="<?php echo $listing["id"]; ?>">
                                                <span class="lbl padding">Contact Image</span>
                                            </label>
                                      </div>
                                    </div>
                                    			 <?php
  }
  ?>
     
                                    
  </div>

  <script type="text/javascript">
    var controller = 'archived' ;
    if( controller == 'archived'){
        controller = 'listings';
    }
  // When the document is ready set up our sortable with it's inherant function(s)
  $(document).ready(function() {
    $("#image-sort,#image-sort-floor").sortable({
	  opacity: 0.5,
	  zIndex: 5,
	  cursor: 'pointer',
          update : function () {
		var order1 = $('#image-sort').sortable('serialize');
                var order2 = $('#image-sort-floor').sortable('serialize');
                var order = order1+'&amp;'+order2;
		        
        $.ajax({
            type: "GET",
            url: image_url+"/"+controller+"/photoorder/?data=PhotoOrder[]=test&amp;"+order+"&amp;listing_id="+$('#myForm input#id').val(),
            beforeSend: function( xhr ) {
                xhr.withCredentials = true;
            },
            success: function(data){
                $("#info").html(data);
            },
            xhrFields: {
                withCredentials: true
            },
            crossDomain: true
        });
      }
    });
   
        if($('#tabs_image').attr('image_type') == 'floor'){
              $("#images_lst").css('display','none');
              $("#images_floor").css('display','');
         }else{
              $("#images_lst").css('display','');
              $("#images_floor").css('display','none');
         }
                               
});

$(".edit_title").click(function () {
			var title;
			var id;
                        var current_title = $("#image_"+this.id).attr('title');
			title = prompt('Current title : '+current_title+'\nPlease enter the picture title below.')
			id	  = this.id;
                        
			if(title==null || title==''){
				title=current_title;
			}
            
            submitObject = { title : title,id : id};
            
            $.ajax({
                type: "POST",
                url: image_url+"/"+controller+"/phototitle/",
                beforeSend: function( xhr ) {
                    xhr.withCredentials = true;
                },
                data: submitObject,
                success: function(data){
                     $("#image_"+id).attr('title', title);
                },
                xhrFields: {
                    withCredentials: true
                },
                crossDomain: true
            });
});

$(".enable_watermark").click(function () {
			var id = this.id;
			var watermark;
			
			if($(this).attr("checked")){
				watermark = 1;
			}
			else{
				watermark = 0;
			}
            
            submitObject = { watermark : watermark , id : id};
            
            $.ajax({
                type: "POST",
                url: image_url+"/"+controller+"/photowatermark/",
                beforeSend: function( xhr ) {
                    xhr.withCredentials = true;
                },
                data: submitObject,
                success: function(data){
                    
                },
                xhrFields: {
                    withCredentials: true
                },
                crossDomain: true
            });

			
});

$(".enable_photo").click(function () {
			var id = this.id;
			var photo;
			
			if($(this).attr("checked")){
				photo = 1;
			}
			else{
				photo = 0;
			}
            
            submitObject = { photo : photo,id : id};
            
            $.ajax({
                type: "POST",
                url: image_url+"/"+controller+"/enablephoto/",
                beforeSend: function( xhr ) {
                    xhr.withCredentials = true;
                },
                data: submitObject,
                success: function(data){
                    
                },
                xhrFields: {
                    withCredentials: true
                },
                crossDomain: true
            });
			
});

</script>
<script>
//delete image
	$(document).ready(function(){
    	
		$('#photos').val(arr_images.length);
        $('#floor_plans').val('');
		//When you click on a link with class of poplight and the href starts with a # 
		$('.col-md-2 .bar_link').bind("click", function() {
			if(confirm('Do you really want to delete this?')){
				image_id = $(this).attr('id');
				
                for(var i = arr_images.length; i--;) {
                    if(arr_images[i] == image_id) {
                        arr_images.splice(i, 1);
                    }
                }

                $.ajax({
                      type: "GET",
                      url: mainurl+"/listings/deleteimage/"+image_id,
                      beforeSend: function( xhr ) {
                          xhr.withCredentials = true;
                      },
                      success: function(data){
                        $('#photos').val($('#photos').val() - 1);
                        submitObject = { arr_images:arr_images, controller: controller , linked_id:$('input#id').val(),rand_key:$('input#rand_key').val()};
                          $.ajax({
                              type: "POST",
                               url: mainurl+"listings/show_images",
                              beforeSend: function( xhr ) {
                                  xhr.withCredentials = true;
                              },
                              data: submitObject,
                              success: function(data){
                                  $("#showimages").html(data);
                              },
                              xhrFields: {
                                  withCredentials: true
                              },
                              crossDomain: true
                          });
                        },
                      xhrFields: {
                          withCredentials: true
                      },
                      crossDomain: true
                  });

			}
		 });

        var tabId = $("#tabs_image li.active").attr("id");
        var type = (tabId == 'tab_n2') ? 'floor' : 'photos';
        //changeDeleteLinkStatus(type);
	});	
</script>
<div id="info"></div>


</div>