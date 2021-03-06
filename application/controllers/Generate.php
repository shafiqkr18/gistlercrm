<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Muhammad Shafiq
 * Email: muhammad.royalhome@gmail.com
 * Description: generate contoller class
 * Date: 1 Dec,2015
 */
class Generate extends CI_Controller {
	  var $original_path;
      var $profileImage_path;
	public function __construct()
	{
		
     	parent::__construct();
     	// Your own constructor code
		 $this->original_path = base_url()."uploads/listings/";
		  $this->profileImage_path = base_url()."uploads/user/profile/";
		 
		if ( ! $this->session->userdata('validated'))
		{ 
			redirect('login');
		}
			
	$this->load->model('generate_model');
	$this->load->model('common_model');
	
	include(FCPATH.'application/helpers/tcpdf/config/lang/eng.php');
    include(FCPATH.'application/helpers/tcpdf/tcpdf.php');
				
    }
	public function index()
	{
		show_404();
	}
function exportCSV(){
			 
			$type_listing = $this->input->get('type_listing');
			$exportPDFIds = $this->input->get('exportCSV');
	       
			
			$this->load->dbutil();
			$this->load->helper('file');
			$this->load->helper('download');
			/* get the object   */
			$report = $this->generate_model->exportCSV($type_listing,$exportPDFIds);
			/*  pass it to db utility function  */
			$new_report = $this->dbutil->csv_from_result($report);
			/*  Now use it to write file. write_file helper function will do it */
			$name = random_string('alnum', 16);
			force_download("listing_".$name.'.csv',$new_report);
			/*  Done    */
}
function exportCSVdeal()
{
			$exportIds = $this->input->get('exportCSV');
			$this->load->dbutil();
			$this->load->helper('file');
			$this->load->helper('download');
			/* get the object   */
			$report = $this->generate_model->exportCSVdeal($exportIds);
			/*  pass it to db utility function  */
			$new_report = $this->dbutil->csv_from_result($report);
			/*  Now use it to write file. write_file helper function will do it */
			$name = random_string('alnum', 16);
			force_download("deals_".$name.'.csv',$new_report);
			/*  Done    */
}
 function PDFbrochure()
		 {
			    $dir_path =  $_SERVER['DOCUMENT_ROOT'];
				$image_path_local = base_url()."mydata/images/";
			$exportPDFIds = $this->input->post('exportPDFIds');
			$exportPDFIds = explode(',',trim($exportPDFIds,','));
			$id = $exportPDFIds[0];
			$agent_details = $this->input->post('agent_details');
			$type = $this->input->post('listtype');//rent or sale
			$rand_key = $this->input->post('listrand');
			$image_upload_folder = $this->original_path.$this->session->userdata('client_id')."/".md5($rand_key)."/";
			//get data
			 if($type == 1)
		{
			 $for_type = "For Rent";
		$agent = $this->generate_model->get_Agent($type,$id);
		$lisitng = $this->generate_model->get_Listing($type,$id);
		$features = $this->generate_model->get_Features($type,$id);
		$list_images = $this->generate_model->get_Images($type,$id);
		foreach ($list_images as $listing)
		{
			$thumbs[] = $image_upload_folder.htmlspecialchars($listing['watermark_image']);//'images/big-img.jpg';
			 //$thumbs[] = base_url().'crm/uploads/listings/sales/images/'.htmlspecialchars($rw['watermark_image']);//'images/big-img.jpg';
		     $pic_title[] = htmlspecialchars($listing['title']);
		}
			
		}else{
			$for_type = "For Sale";
		$agent = $this->generate_model->get_Agent($type,$id);
		$lisitng = $this->generate_model->get_Listing($type,$id);
		$features = $this->generate_model->get_Features($type,$id);
		$list_images = $this->generate_model->get_Images($type,$id);
		foreach ($list_images as $listing)
		{
			$thumbs[] = $image_upload_folder.htmlspecialchars($listing['watermark_image']);//'images/big-img.jpg';
			 //$thumbs[] = base_url().'crm/uploads/listings/sales/images/'.htmlspecialchars($rw['watermark_image']);//'images/big-img.jpg';
		     $pic_title[] = htmlspecialchars($listing['title']);
		}
		}
		
		if(isset($thumbs[0]))
			{
			   $image0 =  '<img src="'.$thumbs[0].'" width="545" height="384" />';
			}
		if(isset($thumbs[1]))
		   {
			   $image1 =  '<img src="'.$thumbs[1].'" width="255" height="188"  style="padding:8px 0 8px 0;"/>';
			}
		if(isset($thumbs[2]))
			{
			   $image2 =  '<img src="'.$thumbs[2].'" width="255" height="188"/>';
			}
				 
	       if (file_exists($this->profileImage_path.$rand_key.'/'.$agent->photo_agent)) {
							$agent_pic = ' <img src="'.$this->profileImage_path.$rand_key.'/'.$agent->photo_agent.'"    />';
						} else {
						$agent_pic = ' <img src="'.$image_path_local.'images/default.jpg"    />';
						}
						
			if($agent_details)
			{
				$ag_name = $agent->name;
				$ag_mobile = $agent->mobile_no_new;
				$ag_title = $agent->job_title;
				$ag_email = $agent->email;
				$u_img = $agent->id;
				$rera = $agent->rera;
			}else{
				$u_img = $this->session->userdata('userid');
				$ag_name = $this->session->userdata('user_fullname');
				$ag_mobile = $this->session->userdata('mobileNo');
				$ag_title = $this->session->userdata('job_title');
				$ag_email = $this->session->userdata('email');
				$rera = $this->session->userdata('rera');
			}
				
				//populate varibles
				
				
		$ref = htmlspecialchars($lisitng->ref);
		$name = htmlspecialchars($lisitng->name);
		$category = htmlspecialchars($lisitng->category);
		$AreaLocation = htmlspecialchars($lisitng->AreaLocation);
		$SubAreaLocation = htmlspecialchars($lisitng->SubAreaLocation);
		$description_count = $lisitng->description_count;
		$View = $lisitng->View;
		$description  = str_replace('<br />', '<br>', $lisitng->description_demo);
		$de = preg_replace("/&#?[a-z0-9]{2,8};/i","",$description);
	        $descr = trim(str_replace("&nbsp;","",$de));
	        $description = str_replace("nbsp;","",$descr);
		$description = word_limiter(strip_tags($description),100);
		
		$beds = $lisitng->beds;
		$size = $lisitng->size;
		$baths = $lisitng->baths;
		$parking = $lisitng->parking;
		$price = number_format($lisitng->price);
		$unit_size_price = $lisitng->unit_size_price;
		
		$my_status = $lisitng->prop_status;
		if($my_status==1)
		{
		$amiready = "Available";
		}else if($my_status==2)
		{
		$amiready = "Pending";
		}else if($my_status==3)
		{
		$amiready = "Sold/Rented";
		}else if($my_status==4)
		{
		$amiready = "Upcoming";
		}else if($my_status==5)
		{
		$amiready = "Reserved";
		}else{
		$amiready = "Available";
		}
				
		// start of pdf code from here
		$pageLayout = array(1100, 819); //  or array($height, $width) 
        $pdf =new TCPDF('P', 'pt', $pageLayout, true, 'UTF-8', true);
		// set document information
	   $pdf->SetCreator(PDF_CREATOR);
	    $pdf->SetPrintHeader(false);
       $pdf->SetPrintFooter(false);
		$pdf->SetAuthor('Gistler');
		$pdf->SetTitle('Listing ');
		$pdf->SetSubject('PDF of Listings');
		$pdf->SetKeywords('Gistler, PDF, listing');

        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->SetMargins(70, PDF_MARGIN_TOP, 70,true);
		//set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); 
	    $pdf->AddPage();
		
		// prepare html
		$html = '<body><table   cellpadding="2" cellspacing="2"  width="819"  style="border-left:3px solid #C09526;border-right:3px solid #C09526;border-top:3px solid #C09526;border-bottom:3px solid #C09526; border-collapse:collapse" >
}
<tbody>
  <tr>
    <td>
	<table bgcolor="#0a4c88" style="border-collapse:collapse" width="819" border="0">
        <tr style="height:102px; background:#0a4c88; margin:0; padding:0;">
          <td height="86" align="left" valign="middle" width="603"  style="padding-left:15px;">
		  <img src="'.$image_path_local.'images/rpt_logo.jpg" width="205" height="84" /></td>
          <td align="left" valign="middle" height="86" width="207"  style="padding-right:15px;">
		  <img src="'.$image_path_local.'images/phn_dtl.jpg" width="185" height="64" /></td>
        </tr>
      </table>
	  </td>
  </tr>
  <tr>
    <td>
	<table style="border-collapse:collapse" width="100%" border="0">
        <tr>
          <td width="545" style="padding:8px 0 0 8px;">'.$image0.'</td>
          <td width="255">
		 '.$image1.'<br/>
		  '.$image2.'</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td>
	<table style="border-collapse:collapse" width="100%" border="0">
        <tr>
          <td width="6"></td>
          <td bgcolor="#0a4c88" width="624" style="height:89px; width:624px; background:#0a4c88;" >
		  <table style="border-collapse:collapse" width="100%" border="0">
              <tr>
				
				<td width="5"></td>				
				<td width="610">
				<table style="border-collapse:collapse" width="100%" border="0">
				<tr>
				<td colspan="2" height="2" ></td>
				</tr>
				<tr>
				<td colspan="2" height="45" >
				<h1 style="font-size:18px; padding-left:15px; color:#FFF;">'.$name.'</h1>
				</td>
				</tr><tr>
				<td width="410">
				<h1  style="font-size:18px;font-weight:normal; padding-left:15px; color:#FFF;"> Price: '.$price.' AED</h1></td>
				<td width="200">
				<table style="border-collapse:collapse" width="100%" border="0">
				<tr>
				<td>
				<img style="padding-right:4px;" src="'.$image_path_local.'images/bed_ico.jpg"    />
				<strong style="font:normal 14px Arial, Helvetica, sans-serif; color:#FFF; padding-right:20px;">'.$beds.'</strong> 
				</td><td>
				<img style="padding-right:4px;" src="'.$image_path_local.'images/bath_ico.jpg"    />
				<strong style="font:normal 14px Arial, Helvetica, sans-serif; color:#FFF; padding-right:20px;">'.$baths.'</strong> 
				</td><td>
				<img style="padding-right:4px;" src="'.$image_path_local.'images/park_ico.jpg"    />
				<strong style="font:normal 14px Arial, Helvetica, sans-serif; color:#FFF; padding-right:20px;">'.$parking.'</strong>
				</td>
				</tr></table>
				
				</td>
				
				</tr>
				</table>
				
                
				</td>
				
                
              </tr>
            </table>
			</td>
          <td width="8"></td>
          <td valign="middle" align="center" bgcolor="#0a4c88" width="175" style="height:89px; line-height:89px; color:#FFF; font-size:30px;font-weight:bold;font-family:Arial, sans-serif; text-align:center; background:#0a4c88;">
<table width="100%" cellpadding="0" cellpadding="0">
<tr><td height="2"></td></tr>
<tr><td>'.$for_type.'</td></tr></table></td>
          <td width="2"></td>
        </tr>
      </table></td>
  </tr>
  <tr>
  <td>
  <table width="100%" cellpadding="0" cellspacing="0">
  
  <tr><td width="6"></td>
    <td width="800" style="padding:10px;"><h1 style="font:bold 16px Arial, Helvetica, sans-serif; color:#000;">'.$name.'</h1>
      <p style="font:normal 13px Arial, Helvetica, sans-serif; color:#000; padding-bottom:10px;">'.$description.'</p>
      <p style="font:normal 13px Arial, Helvetica, sans-serif; color:#000; padding-bottom:10px;">Royal Home Real Estate provides full service to each and every clientele. We offer comprehensive properties for sale and rentals. Our team is
        highly adept property consultants who are experts in every aspect of the real estate industry.</p>
      <p style="font:normal 13px Arial, Helvetica, sans-serif; color:#000; padding-bottom:10px;">For further details on this property please contact Royal Home Real Estate or visit our website: www.royalhome.ae</p></td>
  </tr>
  </table>
  </td>
  
  
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
    <table style="border-top:1px dotted #333;font-size:12px;border-collapse:collapse;" width="100%" border="0">
        <tr valign="top" style="border-bottom:#000 1px dashed; border-top:#000 1px dashed; margin:0 15px; padding:15px 0; vertical-align:sub;">
          <td width="20" style="border-top:#000 1px dashed;"></td>
          <td width="242" style="border-top:#000 1px dashed;border-right:#000 1px dashed; padding-right:20px;padding-top:10px;">
		  <table style="border-collapse:collapse" width="100%" border="0">
		  <tr><td style=" border-bottom:#000 1px dashed;">
              <h1 style="font-weight:bold;font-size:20px;font-family:Arial;padding-bottom:8px; color:#000;">Property Details</h1><br/>
		</td></tr>	  
              <tr><br />
                <td >
				<p>&nbsp; <strong style="color:#000; font-size:18px;">Ref. No: </strong>&nbsp;<strong style="color:#000; font-size:16px;">'.$ref.'</strong></p></td>
              </tr>
              <tr>
                <td></td>
              </tr>
              <tr>
                <td >
				<p> &nbsp;<strong style="color:#000; font-size:18px;">Area: </strong> &nbsp;<strong style="color:#000; font-size:16px;">'.$AreaLocation.'</strong></p></td>
              </tr>
              <tr>
                <td></td>
              </tr>
              <tr>
                <td >
				<p>&nbsp;
				<strong style="color:#000; font-size:18px;">Project: </strong>&nbsp;<strong style="color:#000; font-size:16px;">'.$SubAreaLocation.'</strong></p></td>
              </tr>
              <tr>
                <td></td>
              </tr>
              <tr>
                <td >
				
				<strong style="color:#000; font-size:18px;">&nbsp;Type:</strong> &nbsp;<strong style="color:#000; font-size:16px;">'.$category.'</strong>
				</td>
              </tr>
              <tr>
                <td></td>
              </tr>
              <tr>
                <td >
				<p>&nbsp;
				<strong style="color:#000; font-size:18px;">Price:</strong> &nbsp;<strong style="color:#000; font-size:16px;">'.$price.' AED</strong></p></td>
              </tr>
              <tr>
                <td></td>
              </tr>
            </table>
			</td>
          <td width="20" style="border-top:#000 1px dashed;"></td>
          <td width="242" style="border-top:#000 1px dashed;border-right:#000 1px dashed; padding-right:20px;">
		  <table style="border-collapse:collapse" width="100%" border="0">
              <tr>
			  <td style=" border-bottom:#000 1px dashed;">
			  <h1 style="font-weight:bold;font-size:20px;font-family:Arial;padding-bottom:8px; color:#000;">Unit Details</h1><br /></td></tr>
              <tr>
                <td><br />
				<p>&nbsp; <strong style="color:#000; font-size:18px;">
				Bedrooms:</strong> &nbsp;<strong style="color:#000; font-size:16px;">'.$beds.'</strong></p></td>
              </tr>
              <tr>
                <td></td>
              </tr>
              <tr>
                <td>
				<p>
				&nbsp; <strong style="color:#000; font-size:18px;">
				Bathrooms:</strong> &nbsp;<strong style="color:#000; font-size:16px;">'.$baths.'</strong></p></td>
              </tr>
              <tr>
                <td></td>
              </tr>
              <tr>
                <td >
				<p>&nbsp; <strong style="color:#000; font-size:18px;">
				View: </strong>&nbsp;<strong style="color:#000; font-size:16px;">'.$View.'</strong></p>
				</td>
              </tr>
              <tr>
                <td></td>
              </tr>
              <tr>
                <td>
				<p>&nbsp; <strong style="color:#000; font-size:18px;"> 
				Total Size: </strong>&nbsp;
				<strong style="color:#000; font-size:16px;">'.$size.' sq.ft.</strong>
				</p></td>
              </tr>
              <tr>
                <td></td>
              </tr>
              <tr>
                <td>
				<p>&nbsp; <strong style="color:#000; font-size:18px;">
				Status:</strong> &nbsp;<strong style="color:#000; font-size:16px;">'.$amiready.'</strong></p>
				</td>
              </tr>
              <tr>
                <td></td>
              </tr>
            </table>
			</td>
          <td width="20" style="border-top:#000 1px dashed;"></td>
          <td width="242" style="border-top:#000 1px dashed;">
		  <table style="border-collapse:collapse" width="100%" border="0">
              <tr><td style="border-bottom:#000 1px dashed;">
			  <h1 style="font-weight:bold;font-size:20px;font-family:Arial;color:#000; padding-bottom:8px;">Other Details</h1><br/></td></tr>';
			   foreach($features as $f){
					
             $html = $html.'  <tr>
                <td></td>
              </tr><tr>
                <td >
				<p>
				&nbsp;
				<strong style="color:#000; font-size:16px;">'.$f['title'].'</strong>
				</p></td>
              </tr>';
			  }
            
           
			  
             $html = $html .'
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table>
			</td>
          <td width="20" style="border-top:#000 1px dashed;"></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="border-top:#000 1px dashed;border-bottom:#000 1px dashed;">
	
    <table style="font-size:12px;border-collapse:collapse" width="100%" border="0">
	<tr><td colspan="7" height="2"></td></tr>
        <tr style="margin:0 15px;">
          <td width="10"></td>
          <td width="77">
		  
		  '. $agent_pic.'
		  
		  </td>
		  
          <td width="50"></td>
          <td width="242">
		  <table style="border-collapse:collapse" width="100%" border="0">
              <tr>
                <td>
				<p><strong style="color:#000; font-size:17px;">- Name:</strong> &nbsp;<strong style="color:#000; font-size:15px;">'.$ag_name.'</strong></p></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>
				<p>
				<strong style="color:#000; font-size:17px;">- Contact#:</strong> &nbsp;
				<strong style="color:#000; font-size:15px;">'.$ag_mobile.'</strong></p></td>
              </tr>
            </table> 
			</td>
          <td >&nbsp;</td>
          <td width="350">
		  <table style="border-collapse:collapse" width="100%" border="0">
              <tr>
                <td>
				<p><strong style="color:#000; font-size:17px;">- Email:</strong> &nbsp;<strong style="color:#000; font-size:15px;">'.$ag_email.'</strong></p></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>
				<p><strong style="color:#000; font-size:17px;">- Broker ID:</strong> &nbsp;<strong style="color:#000; font-size:15px;">'.$rera.'</strong></p></td>
              </tr>
            </table></td>
          <td width="50"></td>
        </tr>
		<tr><td colspan="7" height="2"></td></tr>
      </table>
	  
	  </td>
  </tr>
  <tr  >
    <td >
	<table bgcolor="#0a4c88" height="60" style="height:36px; line-height:60px;"><tr style="height:36px; line-height:36px;"><td align="center" valign="middle">
	<p style="font-size:13px; color:#FFFFFF;"> &nbsp;&nbsp;Al Fattan Marine Towers II, First Floor, Office No.9, Dubai Marina. P.O. Box 214392, ORN: 2533
	</p></td></tr></table>
	</td>
  </tr>
  
  </tbody>
  
  
  </table></body>';
  
	
$pdf->writeHTML($html, true, false, false, false, '');
$pdf->lastPage();
$pdf->AddPage();
		
	//second page
	$html = '<table   cellpadding="2" cellspacing="2"  width="819"  style="border-left:3px solid #C09526;border-right:3px solid #C09526;border-top:3px solid #C09526;border-bottom:3px solid #C09526; border-collapse:collapse" >
  <tr>
    <td><table bgcolor="#0a4c88" style="border-collapse:collapse" width="819" border="0">
        <tr style="height:102px; background:#0a4c88; margin:0; padding:0;">
          <td height="86" align="left" valign="middle" width="603"  style="padding-left:15px;">
		  <img src="'.$image_path_local.'images/rpt_logo.jpg" width="205" height="84" /></td>
          <td align="left" valign="middle" height="86" width="207"  style="padding-right:15px;">
		  <img src="'.$image_path_local.'images/phn_dtl.jpg" width="185" height="64" /></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
        <tr>
          <td width="10"></td>';
		  if(isset($thumbs[0]))
				 {
         $html =$html .' <td width="262" style="  ;" align="center"><img style="padding:15px;" src="'.$thumbs[0].'" width="255" height="188"   />
            <h1 style="font-weight:bold;font-size:14px;font-family:verdana; margin:0; color:#000;   ; text-align:center;">'.$pic_title[0].' - '.$SubAreaLocation.', '.$AreaLocation.'</h1></td>';
			}
			if(isset($thumbs[1]))
				 {
         $html =$html .' <td width="262" style="  ;" align="center"><img style="padding:15px;" src="'.$thumbs[1].'" width="255" height="188"   />
            <h1 style="font-weight:bold;font-size:14px;font-family:verdana; margin:0; color:#000;   ; text-align:center;">'.$pic_title[1].' - '.$SubAreaLocation.', '.$AreaLocation.'</h1></td>';
			}
			if(isset($thumbs[2]))
				 {
          $html =$html .' <td width="262" style="  ;" align="center"><img style="padding:15px;" src="'.$thumbs[2].'" width="255" height="188"    />
            <h1 style="font-weight:bold;font-size:14px;font-family:verdana; margin:0; color:#000;   ; text-align:center;">'.$pic_title[2].' - '.$SubAreaLocation.', '.$AreaLocation.'</h1></td>';
			}
			
         $html =$html .' <td width="10"></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
        <tr>
          <td width="10"></td>';
		  if(isset($thumbs[3]))
				 {
          $html =$html .'<td width="262" style="  ;" align="center"><img style="padding:15px;" src="'.$thumbs[3].'" width="255" height="188"   />
            <h1 style="font-weight:bold;font-size:14px;font-family:verdana; margin:0; color:#000;   ; text-align:center;">'.$pic_title[3].' - '.$SubAreaLocation.', '.$AreaLocation.'</h1></td>';
			}
			if(isset($thumbs[4]))
				 {
         $html =$html .' <td width="262" style="  ;" align="center"><img style="padding:15px;" src="'.$thumbs[4].'"  width="255" height="188"  />
            <h1 style="font-weight:bold;font-size:14px;font-family:verdana; margin:0; color:#000;   ; text-align:center;">'.$pic_title[4].' - '.$SubAreaLocation.', '.$AreaLocation.'</h1></td>';
			}
			if(isset($thumbs[5]))
				 {
         $html =$html .' <td width="262" style="  ;" align="center"><img style="padding:15px;" src="'.$thumbs[5].'" width="255" height="188"   />
            <h1 style="font-weight:bold;font-size:14px;font-family:verdana; margin:0; color:#000;   ; text-align:center;">'.$pic_title[5].' - '.$SubAreaLocation.', '.$AreaLocation.'</h1></td>';
			}
        $html =$html .'  <td width="10"></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
        <tr>
          <td width="10"></td>';
		  if(isset($thumbs[6]))
				 {
          $html =$html .' <td width="262" style="  ;" align="center"><img style="padding:15px;" src="'.$thumbs[6].'"  width="255" height="188"  />
            <h1 style="font-weight:bold;font-size:14px;font-family:verdana; margin:0; color:#000;   ; text-align:center;">'.$pic_title[6].' - '.$SubAreaLocation.', '.$AreaLocation.'</h1></td>';
			}
			if(isset($thumbs[7]))
				 {
         $html =$html .' <td width="262" style="  ;" align="center"><img style="padding:15px;" src="'.$thumbs[7].'"  width="255" height="188"  />
            <h1 style="font-weight:bold;font-size:14px;font-family:verdana; margin:0; color:#000;   ; text-align:center;">'.$pic_title[7].' - '.$SubAreaLocation.', '.$AreaLocation.'</h1></td>';
			}
			if(isset($thumbs[8]))
				 {
          $html =$html .' <td width="262" style="  ;" align="center"><img style="padding:15px;" src="'.$thumbs[8].'" width="255" height="188"   />
            <h1 style="font-weight:bold;font-size:14px;font-family:verdana; margin:0; color:#000;   ; text-align:center;">'.$pic_title[8].' - '.$SubAreaLocation.', '.$AreaLocation.'</h1></td>';
			}
			 
          $html =$html .' <td width="10"></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td style="padding:15px 0; color:#000; text-align:center; font:normal 15px Arial, Helvetica, sans-serif; ">Contact us: +971 4 399 0990 or visit www.royalhome.ae and get all these options at your fingertip </td>
  </tr>
  <tr>
    <td height="60">
	
	<table width="100%" border="0" >
	<tr><td colspan="15" height="5"></td></tr>
        <tr style="border-bottom:#000 1px dashed; padding:0 15px;">
          <td width="30" ></td>
          <td width="60" align="center"><img src="'.$image_path_local.'images/map_ico.jpg"    />
            <h1 style="color:#11467b; font-size:12px;font-weight:normal;font-family:arial; padding-top:8px; padding-bottom:15px; text-align:center; margin:0;">Location Map</h1></td>
          <td width="30" height="40"></td>
          <td width="60" align="center"><img src="'.$image_path_local.'images/gallery_ico.jpg"    />
            <h1 style="color:#11467b; font-size:12px;font-weight:normal;font-family:arial; padding-top:8px; padding-bottom:15px; text-align:center; margin:0;">Image Gallery</h1></td>
          <td width="30" height="40"></td>
          <td width="80" align="center"><img src="'.$image_path_local.'images/tour_ico.jpg"    />
            <h1 style="color:#11467b; font-size:12px;font-weight:normal;font-family:arial; padding-top:8px; padding-bottom:15px; text-align:center; margin:0;">360 Virtual Tour</h1></td>
          <td width="30" height="40"></td>
          <td width="70" align="center"><img src="'.$image_path_local.'images/info_ico.jpg"    />
            <h1 style="color:#11467b; font-size:12px;font-weight:normal;font-family:arial; padding-top:8px; padding-bottom:15px; text-align:center; margin:0;">Property Information</h1></td>
          <td width="30" height="40"></td>
          <td width="60" align="center"><img src="'.$image_path_local.'images/pdf_ico.jpg"    />
            <h1 style="color:#11467b; font-size:12px;font-weight:normal;font-family:arial; padding-top:8px; padding-bottom:15px; text-align:center; margin:0;">PDF Brochure</h1></td>
          <td width="30" height="40"></td>
          <td width="100" align="center"><img src="'.$image_path_local.'images/curr_ico.jpg"    />
            <h1 style="color:#11467b; font-size:12px;font-weight:normal;font-family:arial; padding-top:8px; padding-bottom:15px; text-align:center; margin:0;">Auto Currency converter</h1></td>
          <td width="30" height="40"></td>
          <td width="60" align="center"><img src="'.$image_path_local.'images/cal_ico.jpg"    />
            <h1 style="color:#11467b; font-size:12px;font-weight:normal;font-family:arial; padding-top:8px; padding-bottom:15px; text-align:center; margin:0;">Mortgage Calculator</h1></td>
          <td width="30" height="40"></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td>
    <table style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" width="100%" border="0">
        <tr style="border-bottom:#000 1px dashed; margin:0 15px;">
          <td width="10"></td>
          <td width="77"> '. $agent_pic.'</td>
          <td width="50"></td>
          <td width="200"><table width="100%" border="0">
              <tr>
                <td>
			<p><strong style="color:#000; font-size:17px;">- Name:</strong> &nbsp;<strong style="color:#000; font-size:15px;">'.$ag_name.'</strong></p></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>
				<p><strong style="color:#000; font-size:17px;">- Contact#:</strong> &nbsp;
				<strong style="color:#000; font-size:15px;">0'.$ag_mobile.'</strong></p></td>
              </tr>
            </table></td>
          <td >&nbsp;</td>
          <td width="300"><table width="100%" border="0">
              <tr>
                <td>
				<p><strong style="color:#000; font-size:17px;">- Email:</strong> &nbsp;<strong style="color:#000; font-size:15px;">'.$ag_email.'</strong></p></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>
				<p><strong style="color:#000; font-size:17px;">- Broker ID:</strong> &nbsp;<strong style="color:#000; font-size:15px;">'.$rera.'</strong></p></td>
              </tr>
            </table></td>
          <td width="50"></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr  >
    <td>
	<table bgcolor="#0a4c88" height="60" style="height:36px; line-height:60px;"><tr style="height:36px; line-height:36px;"><td align="center" valign="middle">
	<p style="font-size:13px; color:#FFFFFF;"> &nbsp;&nbsp;Al Fattan Marine Towers II, First Floor, Office No.9, Dubai Marina. P.O. Box 214392, ORN: 2533
	</p></td></tr></table></td>
  </tr>
</table>';

$pdf->writeHTML($html, true, false, false, false, '');
 $pdf->lastPage();
$fileName = "Brochure_Royal_Home_Real_Estate";


 $sr =  $fileName . '.pdf';
// echo $html;exit;
//Close and output PDF document
   ob_end_clean();
  ob_start();
  
 //echo $html;exit;
$pdf->Output($sr, 'D');	//D for download	
	exit;	
		
}	
 
 function exportPDF()
 {
 	//get data here
 	$exportPDFIds = $this->input->get('exportPDF');
	$exportPDFIds = explode(',',trim($exportPDFIds,','));
 	$lisitngs = $this->generate_model->get_Listing_selected($exportPDFIds);
 	// create new PDF document
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Gistler.com');
		$pdf->SetTitle('Listing ');
		$pdf->SetSubject('PDF of Listings');
		$pdf->SetKeywords('Gistler, PDF, listing');
		
		$pdf->SetFont('Helvetica', 'B', 10);
		
		// add a page
		$pdf->AddPage();
		
		//create html
		
		$html='<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
		          <tr >
		       
		            <td bgcolor="#D6D6D6" style=" font-size:24px; text-align:center; border-left: #000 1px solid;border-right: #000 1px solid;border-top: #000 1px solid;border-bottom: #000 1px solid;padding: 0;margin: 0;vertical-align: bottom;background: #d6d6d6;height: 20px"><strong>Refrence</strong></td>
		           
		            <td bgcolor="#D6D6D6" style="font-size:24px; text-align:center;border-left: #000 1px solid;border-right: #000 1px solid;border-top: #000 1px solid;border-bottom: #000 1px solid;padding: 0;margin: 0;vertical-align: bottom;background: #d6d6d6;height: 20px"><strong>Name</strong></td>  
								<td bgcolor="#D6D6D6" style="font-size:24px; text-align:center; border-left: #000 1px solid;border-right: #000 1px solid;border-top: #000 1px solid;border-bottom: #000 1px solid;padding: 0;margin: 0;vertical-align: bottom;background: #d6d6d6;height: 20px"><strong>Type</strong></td>
								<td bgcolor="#D6D6D6" style="font-size:24px; text-align:center; border-left: #000 1px solid;border-right: #000 1px solid;border-top: #000 1px solid;border-bottom: #000 1px solid;padding: 0;margin: 0;vertical-align: bottom;background: #d6d6d6;height: 20px"><strong>Category</strong></td>
		           
		            <td bgcolor="#D6D6D6" style="font-size:24px; text-align:center; border-left: #000 1px solid;border-right: #000 1px solid;border-top: #000 1px solid;border-bottom: #000 1px solid;padding: 0;margin: 0;vertical-align: bottom;background: #d6d6d6;height: 20px"><strong>Location</strong></td>  
								<td bgcolor="#D6D6D6" style="font-size:24px; text-align:center; border-left: #000 1px solid;border-right: #000 1px solid;border-top: #000 1px solid;border-bottom: #000 1px solid;padding: 0;margin: 0;vertical-align: bottom;background: #d6d6d6;height: 20px"><strong>Sub Location</strong></td>
								<td bgcolor="#D6D6D6" style="font-size:24px; text-align:center; border-left: #000 1px solid;border-right: #000 1px solid;border-top: #000 1px solid;border-bottom: #000 1px solid;padding: 0;margin: 0;vertical-align: bottom;background: #d6d6d6;height: 20px"><strong>Beds</strong></td>
		           
		            <td bgcolor="#D6D6D6" style="font-size:24px; text-align:center; border-left: #000 1px solid;border-right: #000 1px solid;border-top: #000 1px solid;border-bottom: #000 1px solid;padding: 0;margin: 0;vertical-align: bottom;background: #d6d6d6;height: 20px"><strong>Size</strong></td>  
								<td bgcolor="#D6D6D6" style="font-size:24px; text-align:center; border-left: #000 1px solid;border-right: #000 1px solid;border-top: #000 1px solid;border-bottom: #000 1px solid;padding: 0;margin: 0;vertical-align: bottom;background: #d6d6d6;height: 20px"><strong>Price</strong></td>
		         
		          </tr>';
				 foreach($lisitngs as $listing)
				 {
				 	
					$ref = $listing['ref'];
					$name = htmlspecialchars($listing['name']);
					$category = htmlspecialchars($listing['category']);
					$AreaLocation = htmlspecialchars($listing['AreaLocation']);
					$SubAreaLocation = htmlspecialchars($listing['SubAreaLocation']);
					$beds = $listing['beds'];
					$size = $listing['size'];
					$price = number_format($listing['price']);
					$t = $listing['Type'];
					
					
				  							
			$html = $html.'	<tr class="odd"><td valign="top" style=" font-size:18px; text-align:center; border-left: #000 1px solid;border-right: #000 1px solid;border-top: #000 1px solid;border-bottom: #000 1px solid;padding: 0;margin: 0;vertical-align: bottom;background: #d6d6d6;height: 10px">'.$ref.'</td>';
			$html = $html.'<td valign="top" style=" font-size:18px; text-align:center; border-left: #000 1px solid;border-right: #000 1px solid;border-top: #000 1px solid;border-bottom: #000 1px solid;padding: 0;margin: 0;vertical-align: bottom;background: #d6d6d6;height: 10px">'.word_limiter($name,15).'</td>';
			$html = $html.'<td valign="top" style="font-size:18px; text-align:center; border-left: #000 1px solid;border-right: #000 1px solid;border-top: #000 1px solid;border-bottom: #000 1px solid;padding: 0;margin: 0;vertical-align: bottom;background: #d6d6d6;height: 10px"> '.$t.'</td>';
			$html = $html.'	<td valign="top" style="font-size:18px; text-align:center; border-left: #000 1px solid;border-right: #000 1px solid;border-top: #000 1px solid;border-bottom: #000 1px solid;padding: 0;margin: 0;vertical-align: bottom;background: #d6d6d6;height: 10px">'.$category.'</td>';
			$html = $html.'	<td valign="top" style="font-size:18px; font-size:18px; text-align:center; border-left: #000 1px solid;border-right: #000 1px solid;border-top: #000 1px solid;border-bottom: #000 1px solid;padding: 0;margin: 0;vertical-align: bottom;background: #d6d6d6;height: 10px">  &nbsp;'.$AreaLocation.'</td>';
			$html = $html.'	<td valign="top" style="font-size:18px; text-align:center; border-left: #000 1px solid;border-right: #000 1px solid;border-top: #000 1px solid;border-bottom: #000 1px solid;padding: 0;margin: 0;vertical-align: bottom;background: #d6d6d6;height: 10px"> '.$SubAreaLocation.'</td>';
			$html = $html.'	<td valign="top" style="font-size:18px; text-align:center; border-left: #000 1px solid;border-right: #000 1px solid;border-top: #000 1px solid;border-bottom: #000 1px solid;padding: 0;margin: 0;vertical-align: bottom;background: #d6d6d6;height: 10px">'.$beds.'</td>';
			$html = $html.'	<td valign="top" style="font-size:18px;text-align:center; border-left: #000 1px solid;border-right: #000 1px solid;border-top: #000 1px solid;border-bottom: #000 1px solid;padding: 0;margin: 0;vertical-align: bottom;background: #d6d6d6;height: 10px">'.$size.'</td>';
			$html = $html.'	<td valign="top" style="font-size:18px; text-align:center; border-left: #000 1px solid;border-right: #000 1px solid;border-top: #000 1px solid;border-bottom: #000 1px solid;padding: 0;margin: 0;vertical-align: bottom;background: #d6d6d6;height: 10px"> '.$price.'</td>';
			$html = $html.'	</tr>';
					
				 } 
	  $html = $html.'	 </table>';
	  $created_date	=	date('Y-m-d');
      $rand = random_string('alnum', 8);
	  $fileName = "Listings_".$rand;
	//$pdf->writeHTML(utf8_decode($html));
		$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->SetFillColor(255,255,0);
		$pdf->lastPage();
		 $sr =  $fileName . '.pdf';

         $pdf->Output($sr, 'D');	
		
 }
 function emailHTML()
 {
 	$ccto = $this->input->post('ccto');
	$emailHTML = $this->input->post('emailHTML');
	$message = $this->input->post('message');
	$sendto = $this->input->post('sendto');
	$sentfrom = $this->input->post('sentfrom');//from email
	//$show_signature = $this->input->post('show_signature');
	$subject = $this->input->post('subject');
	$ccto = $this->input->post('ccto');
//get listing data
    $message1 =str_replace(' ', '&nbsp;', $message);
	//str_replace(' ', '&nbsp;', $stringVariable);
	$u_img = $this->session->userdata('userid');
				$ag_name = $this->session->userdata('user_fullname');
				$ag_mobile = $this->session->userdata('mobileNo');
				$ag_title = $this->session->userdata('job_title');
				$ag_email = $this->session->userdata('email');
				$rera = $this->session->userdata('rera');
				
				$userName = $this->session->userdata('user_fullname');
				$job_title = $this->session->userdata('job_title');
				$mob = $this->session->userdata('mobileNo');
				$email = $this->session->userdata('email');
	   
	if ($this->input->post('show_signature')) { 
	$message1 = $message1."<br><br><br><br>";
	$message1 = $message1.$ag_name."<br>";
	$message1 = $message1.$ag_title."<br>";
	$message1 = $message1.$ag_mobile."<br>";
	$message1 = $message1.$ag_email."<br>";
	
	}
    	
	$message = '<div style="border:solid #e1e1e1 1.0pt;padding:8.0pt 8.0pt 8.0pt 8.0pt">
	<br>
	'.$message1.'
	<u></u><u></u></p>';
	
	$exportPDFIds = explode(',',trim($emailHTML,','));
 	$lisitngs = $this->generate_model->get_Listing_selected($exportPDFIds);
	 foreach($lisitngs as $listing)
				 {
				 	$id = $listing['id'];
					$ref = $listing['ref'];
					$title = htmlspecialchars($listing['name']);
					$category = htmlspecialchars($listing['category']);
					$AreaLocation = htmlspecialchars($listing['AreaLocation']);
					$SubAreaLocation = htmlspecialchars($listing['SubAreaLocation']);
					$beds = $listing['beds'];
					$size = $listing['size'];
					$price = number_format($listing['price']);
					$fitted            	=$listing["fitted"];
					$View = $listing['View'];
					 if($category_id == 3 || $category_id==4 || $category_id == 6 || $category_id==12)
	 					{
				 				if($fitted == 1)
								{
								$beds = "Semi-Fitted";
								}else if($fitted == 2)
								{
								$beds = "Fitted Space";
								}else if($fitted == 3)
								{
								$beds = "Shell and core";
								}else
								{
								}
	 					}else{
	 
									 if($beds<1)
									 {
									 $beds = "Studio ";
									 }else{
									 $beds = $beds." Bed(s)"; 
									 }
	 
	 					}
					$type = 1;
		$list_images = $this->generate_model->get_Images($type,$id);
		foreach ($list_images as $listing)
		{
			$thumbs[] = $image_upload_folder.htmlspecialchars($listing['watermark_image']);//'images/big-img.jpg';
			 //$thumbs[] = base_url().'crm/uploads/listings/sales/images/'.htmlspecialchars($rw['watermark_image']);//'images/big-img.jpg';
		     $pic_title[] = htmlspecialchars($listing['title']);
			 $img = $thumbs[0];
		}
			$message = $message.'<div style="border:none;border-bottom:dashed #cccccc 1.0pt;padding:0in 0in 0in 0in;margin-bottom:11.25pt"><p class="MsoNormal"><span style="font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">&nbsp;<u></u><u></u></span></p></div>';
           $message = $message.'<table width="600" cellpadding="0" border="0" style="width:6.25in"><tbody>';
           $message = $message.'<tr><td width="152" valign="top" style="width:114.0pt;padding:1.5pt 1.5pt 1.5pt 1.5pt" rowspan="4">';
           $message = $message.'<p align="center" style="text-align:center" class="MsoNormal">';
           $message = $message.'<span style="font-size:10.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;"><img src="'.$img.'" width="150" height="150"><u></u><u></u>';
           $message = $message.'</span></p></td><td width="434" style="width:325.5pt;padding:1.5pt 1.5pt 1.5pt 1.5pt"><p class="MsoNormal"><b>';
           $message = $message.'<span style="font-size:11.5pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#2184e7">'.$title.'  <u></u><u></u></span></b></p><div><p class="MsoNormal">';
           $message = $message.'<span style="font-size:11.5pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#2184e7">'.$beds.' '.$category.' for Rent - Ref: '.$ref.'<u></u>';
           $message = $message.'<u></u></span></p></div></td></tr><tr><td style="padding:1.5pt 1.5pt 1.5pt 1.5pt"><div>';
           $message = $message.'<p class="MsoNormal"><span style="font-size:9.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#555555">'.$AreaLocation.', '.$SubAreaLocation.', Dubai<u></u><u>';
           $message = $message.'</u></span></p></div><p align="center" style="text-align:center" class="MsoNormal"><strong><span style="font-size:11.5pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#2184e7">AED '.$price.'</span></strong>';
           $message = $message.'<span style="font-size:11.5pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#2184e7"><u></u><u></u></span></p></td></tr><tr><td style="padding:1.5pt 1.5pt 1.5pt 1.5pt">';
           $message = $message.'<p class="MsoNormal"><span style="font-size:10.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">'.$title.' <u></u><u></u>';
           $message = $message.'</span></p></td></tr><tr><td style="padding:1.5pt 1.5pt 1.5pt 1.5pt"><p align="center" style="text-align:center;background:#2184e7" class="MsoNormal">';
           $message = $message.'<strong><span style="font-size:8.5pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:white">';
           $message = $message.'<a target="_blank" href="http://royalhome.ae/crm/preview_rental.php?id='.$id.'">';
           $message = $message.'<span style="color:white;text-decoration:none">click here to view full details</span></a></span></strong><span><span style="text-decoration:none"><u>';
           $message = $message.'</u><u></u></span></span></p><p class="MsoNormal"><span style="font-size:10.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;"><u></u>&nbsp;<u>';
           $message = $message.'</u></span></p></td></tr></tbody></table>';		
				}
           $message = $message.'<div style="border:none;border-bottom:dashed #cccccc 1.0pt;padding:0in 0in 0in 0in;margin-bottom:11.25pt">';
            $message = $message.'<p class="MsoNormal"><span style="font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">&nbsp;<u></u><u></u></span></p></div><p>';
            $message = $message.'<span style="font-size:9.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">For further information or to arrange a viewing appointment, please do not hesitate to contact me:<u>';
           $message = $message.' </u><u></u></span></p><p><span style="font-size:9.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">Kind Regards<u></u><u></u></span></p>';
            $message = $message.'<table width="100%" cellspacing="5" cellpadding="0" border="0" style="width:100.0%"><tbody><tr>';
           $message = $message.' <td width="40%" valign="top" style="width:40.0%;padding:3.75pt 3.75pt 3.75pt 3.75pt"><h3><span style="font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">'.$userName.'<br></span>';
            $message = $message.'<span style="font-size:8.5pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">'.$job_title.'</span><span style="font-family:&quot;Arial&quot;,&quot;sans-serif&quot;"><u></u>';
            $message = $message.'<u></u></span></h3><p class="MsoNormal"><span style="font-size:9.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">Phone: '.$mob.' <br>Email: <a target="_blank" href="mailto:'.$email.'">';
           $message = $message.' <span style="color:#2184e7">'.$email.'</span></a> <u></u><u></u></span></p></td></tr></tbody></table><div style="border:none;border-bottom:dashed #cccccc 1.0pt;padding:0in 0in 0in 0in;margin-bottom:11.25pt">';
           $message = $message.' <p class="MsoNormal">&nbsp;<u></u><u></u></p></div><table width="100%" cellspacing="5" cellpadding="0" border="0" style="width:100.0%"><tbody><tr><td width="40%" valign="top" style="width:40.0%;padding:3.75pt 3.75pt 3.75pt 3.75pt"><h3>';
           $message = $message.' <span style="font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">Royal Home Real Estate<u></u><u></u></span></h3><p class="MsoNormal"><span style="font-size:9.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">';
           $message = $message.' <br>Web: <a target="_blank" href="http://www.royalhome.ae"><span style="color:#2184e7">www.royalhome.ae</span></a> <br>Email: <a target="_blank" href="mailto:property@royalhome.ae"><span style="color:#2184e7">property@royalhome.ae</span></a>';
           $message = $message.'  <br>Phone: +97143990990 <u></u><u></u></span></p></td><td width="30%" style="width:30.0%;padding:3.75pt 3.75pt 3.75pt 3.75pt"><p align="center" style="text-align:center" class="MsoNormal"><span style="font-size:9.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">';
            $message = $message.' <img height="80" border="0" src="http://royalhome.ae/crm/images/1067.png"><u></u><u></u></span></p></td></tr></tbody></table><div style="border:none;border-bottom:solid #cccccc 1.0pt;padding:0in 0in 0in 0in;margin-bottom:11.25pt">';
             $message = $message.'<p class="MsoNormal">&nbsp;<u></u><u></u></p></div><div style="margin-right:7.5pt;margin-bottom:7.5pt"><p align="right" style="text-align:right" class="MsoNormal">';
            $message = $message.' <span style="font-size:8.5pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">Powered by royalhome.ae <a target="_blank" title="http://royalhome.ae" href="http://royalhome.ae">';
             $message = $message.'<span style="text-decoration:none"></span></a><u></u><u></u></span></p></div></div>';
// load email library
$this->load->library('email');
// prepare email

$this->email
    ->from($sentfrom, 'Gistler')
    ->to($sendto)
    ->subject($subject)
    ->message($message)
    ->set_mailtype('html');

// send email
$this->email->send();
//->message($this->load->view('email_template', $data, true))
 } 		
 function exportnewCSV(){
			 
			$type_listing = $this->input->get('exportCSV');
			
			$this->load->dbutil();
			$this->load->helper('file');
			$this->load->helper('download');
			/* get the object   */
			$report = $this->generate_model->exportLeadCSV($type_listing);
			/*  pass it to db utility function  */
			$new_report = $this->dbutil->csv_from_result($report);
			/*  Now use it to write file. write_file helper function will do it */
			$name = rand();
			force_download($name."_Leads_All_".date('Y-m-d').'.csv',$new_report);
			/*  Done    */
		}
 function generate_landlord()
 {
	       $type_listing = $this->input->get('exportCSV');
	     
		
			$this->load->dbutil();
			$this->load->helper('file');
			$this->load->helper('download');
			/* get the object   */
			$report = $this->generate_model->generate_landlord($type_listing);
			/*  pass it to db utility function  */
			$new_report = $this->dbutil->csv_from_result($report);
			/*  Now use it to write file. write_file helper function will do it */
			$name = rand();
			force_download($name."_landlords_All_".date('Y-m-d').'.csv',$new_report);
			/*  Done    */
 }
}