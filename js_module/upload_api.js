// JavaScript Document

;(function($){  

    $.fn.UPLOAD_IMAGES= function(options) {

        var  

          defaults = {  

               main_url         :  mainurl,

               imageUrl         :  mainurl,

               listing_id_field :  'id',

               photos_field          :  'photos',

               image_type       : 'tabs_image',

               type             :  '',

               controller       : '',

               clientId         :  client_id,

               object_type      : ''

          };

	

            var options = $.extend(defaults, options);

            var o = options; 

           // var URLscript  =  o.imageUrl+'upload/uploadify/?client_id='+o.clientId+'&type='+o.type;

		   if($('#rand_key').val() =='' || $('#rand_key').val()<1)

		   {

			   alert("Please press New/Edit button first!");return false;

		   }

		   var URLscript  =  o.imageUrl+'/listings/uploadify/'+$('#rand_key').val()+'/'+$('#type_dummy').val();

            var element = this.selector;

           $(element).uploadifive({

                  'uploadScript'      : URLscript ,

                  'onUpload': function(filesToUpload) {

                                          var settings = $(this).data('uploadifive').settings;

                                          settings.formData.photos     = $('#'+o.photos_field).val() ;

                                          settings.formData.listing_id = $('#'+o.listing_id_field).val() ;

                                          settings.formData.object_type = o.object_type ;

                                          settings.formData.image_type = $('#'+o.image_type).attr('image_type');

                                          $(this).data('uploadifive').settings = settings;

                                      },

                   'cancelImg'         : o.main_url+'uploadifive/uploadifive-cancel.png',

                  'folder'            : 'uploads',

                  'buttonText' : 'Select Images to Upload',

                  'width'             : '200px',

                  'fileType': [

                                      'image/png',

                                      'image/jpg',

                                      'image/jpeg'

                              ],

                  'fileSizeLimit'     : 4 * 1024 * 1024,

                  'queueSizeLimit'    : 20,

                  'removeCompleted'   : true,

                  'multi'             : true, 

                  'auto'              : true,

                  'fileDesc': 'All supported files types (.png, .jpeg, .jpg)',

                  'onError'      : function(e, q, f, o) {

                       $(element).uploadifive("cancel",q);

                       try{

                          //alert('Only PNG, JPEG and JPG file formats are accepted');
                          alert('There is an issue while uploading image. Try again later!');

                        }catch(err) {

                                  return false;

                        }

                  },

                  'onQueueFull'       : function(event, queueSizeLimit) {

                      alert("Please don't put anymore files in me! You can upload " + queueSizeLimit + " files at once");

                      return false;

                  },

                  'onUploadComplete': function(file, info) {

					

					 // console.log(info);

                      var data = JSON.parse(info);

					

                      if(data.error == "error") {

                          alert("There has been an error uploading your images, please try again later");

                          return ;

                      }



                       window.arr_images.push(data.image_id);

                       

                       submitObject = {filename:data.filename, controller: o.controller , arr_images:window.arr_images, linked_id:$('#'+o.listing_id_field).val(),rand_key:$('#rand_key').val()};

					    //alert(submitObject);

					   console.log(submitObject);

                            $.ajax({

                            type: "POST",

                            url: o.imageUrl+"listings/show_images",

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

                  }

              });



          // returns the jQuery object to allow for chainability.  

          return this;  

    }  

})(jQuery);



