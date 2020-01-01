<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Broucher extends CI_Controller {
	public function __construct()
	{
     	parent::__construct();
     	// Your own constructor code
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('text');
		$this->load->helper('form');
		$this->load->library('form_validation');
        $this->load->helper('captcha');
		
		
	$this->load->model('broucher_model');
				
    }
	/**
	***** Developer Name: Shafiq
	** email: muhammad.royalhome@gmail.com
	 */
	public function index()
	{
		 //$this->load->helper('pdf_helper');
		 require_once(base_url().'applications/helpers/tcpdf/config/lang/eng.php');
        require_once(base_url().'applications/helpers/tcpdf/tcpdf.php');
		 $type =  $this->uri->segment(3);
         $id =  $this->uri->segment(4);
		 if (ob_get_contents()) ob_end_clean();
	     //ob_start();
		 if($type == "Sale")
		{
			 $for_type = "For Sale";
		$agent = $this->broucher_model->get_Agent($type,$id);
		$lisitng = $this->broucher_model->get_Listing($type,$id);
		$features = $this->broucher_model->get_Features($type,$id);
		$list_images = $this->broucher_model->get_Images($type,$id);
		foreach ($list_images as $listing)
		{
			$thumbs[] = 'http://royalhome.ae/crm/uploads/listings/sales/images/'.htmlspecialchars($listing['watermark_image']);//'images/big-img.jpg';
			 //$thumbs[] = base_url().'crm/uploads/listings/sales/images/'.htmlspecialchars($rw['watermark_image']);//'images/big-img.jpg';
		     $pic_title[] = htmlspecialchars($listing['title']);
		}
		}else{
			 $for_type = "For Rent";
		$agent = $this->broucher_model->get_Agent($type,$id);
		$lisitng = $this->broucher_model->get_Listing($type,$id);
		$features = $this->broucher_model->get_Features($type,$id);
		$list_images = $this->broucher_model->get_Images($type,$id);
		foreach ($list_images as $listing)
		{
			$thumbs[] = 'http://royalhome.ae/crm/uploads/listings/images/'.htmlspecialchars($listing['watermark_image']);//'images/big-img.jpg';
			 //$thumbs[] = base_url().'crm/uploads/listings/sales/images/'.htmlspecialchars($rw['watermark_image']);//'images/big-img.jpg';
		     $pic_title[] = htmlspecialchars($listing['title']);
		}
		}
		$ag_name = $agent->name;
		$ag_mobile = $agent->mobile_no_new;
		$ag_title = $agent->job_title;
		$ag_email = $agent->email;
		$u_img = $agent->id;
		$rera = $agent->rera;
		//pdf setting
		 $pageLayout = array(1110, 819); //  or array($height, $width) 
        $pdf =new TCPDF('P', 'pt', $pageLayout, true, 'UTF-8', true);
		// set document information
	   $pdf->SetCreator(PDF_CREATOR);
	   $pdf->SetPrintHeader(false);
       $pdf->SetPrintFooter(false);
		$pdf->SetAuthor('RoyalHome.ae');
		$pdf->SetTitle('Listing ');
		$pdf->SetSubject('PDF of Listings');
		$pdf->SetKeywords('Royalhome, PDF, listing');

        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->SetMargins(70, PDF_MARGIN_TOP, 70,true);
      //set image scale factor
       $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); 
	   $pdf->AddPage();
	   $ref = $lisitng->ref;
		$name = htmlspecialchars($lisitng->name);
		$category = $lisitng->category;
		$AreaLocation =$lisitng->AreaLocation;
		$SubAreaLocation = $lisitng->SubAreaLocation;
		$description_count = $lisitng->description_count;
		
		$description  = str_replace('<br />', '<br>', $lisitng->description_demo);
		$de = preg_replace("/&#?[a-z0-9]{2,8};/i","",$description);
	        $descr = trim(str_replace("&nbsp;","",$de));
	        $description = str_replace("nbsp;","",$descr);
		$description = $oAppl->shortenText(strip_tags($description),100);
		$View = $lisitng->View;
		$beds = $lisitng->beds;
		$size = $lisitng->size;
		$baths = $lisitng->baths;
		$parking = $lisitng->parking;
		$price = number_format($lisitng->price);
		$unit_size_price = $lisitng->unit_size_price;
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
			   $image2 =  '<img src="'.$thumbs[2].'" width="255" height="188" style="padding:8px 0 8px 0;"/>';
				}
				 if (file_exists('http://royalhome.ae/crm/images/agent_pics/'.$u_img.'.png')) {
							$agent_pic = ' <img src="http://royalhome.ae/crm/images/agent_pics/'.$u_img.'.png"    />';
						} else {
						$agent_pic = ' <img src="http://royalhome.ae/crm/images/default.jpg"    />';
						}
		
		//create html
		$html = '<body><table   cellpadding="2" cellspacing="2"  width="819"  style="border-left:3px solid #C09526;border-right:3px solid #C09526;border-top:3px solid #C09526;border-bottom:3px solid #C09526; border-collapse:collapse" >
<tbody>
  <tr>
    <td>
	<table bgcolor="#0a4c88" style="border-collapse:collapse" width="819" border="0">
        <tr style="height:102px; background:#0a4c88; margin:0; padding:0;">
          <td height="86" align="left" valign="middle" width="603"  style="padding-left:15px;">
		  <img src="images/rpt_logo.jpg" width="205" height="84" /></td>
          <td align="left" valign="middle" height="86" width="207"  style="padding-right:15px;">
		  <img src="images/phn_dtl.jpg" width="185" height="64" /></td>
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
				<h1  style="font-size:14px;font-weight:normal; padding-left:15px; color:#FFF;">Selling Price: '.$price.' AED</h1></td>
				<td width="200">
				<table style="border-collapse:collapse" width="100%" border="0">
				<tr>
				<td>
				<img style="padding-right:4px;" src="images/bed_ico.jpg"    />
				<strong style="font:normal 14px Arial, Helvetica, sans-serif; color:#FFF; padding-right:20px;">'.$beds.'</strong> 
				</td><td>
				<img style="padding-right:4px;" src="images/bath_ico.jpg"    />
				<strong style="font:normal 14px Arial, Helvetica, sans-serif; color:#FFF; padding-right:20px;">'.$baths.'</strong> 
				</td><td>
				<img style="padding-right:4px;" src="images/park_ico.jpg"    />
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
              <h1 style="font-weight:bold;font-size:16px;font-family:Arial;padding-bottom:8px; color:#000;">Property Details</h1><br/>
		</td></tr>	  
              <tr><br />
                <td style="font-size:12px;  ">
				<p><img style="padding-right:10px;" src="images/dot.jpg"    />&nbsp; Ref. No: &nbsp;<strong style="color:#000;">'.$ref.'</strong></p></td>
              </tr>
              <tr>
                <td></td>
              </tr>
              <tr>
                <td style="font-size:12px;  ">
				<p><img style="padding-right:10px;" src="images/dot.jpg"    /> &nbsp;Area: &nbsp;<strong style="color:#000;">'.$AreaLocation.'</strong></p></td>
              </tr>
              <tr>
                <td></td>
              </tr>
              <tr>
                <td style="font-size:12px;  ">
				<p><img style="padding-right:10px;" src="images/dot.jpg"    /> &nbsp;
				Project: &nbsp;<strong style="color:#000;">'.$SubAreaLocation.'</strong></p></td>
              </tr>
              <tr>
                <td></td>
              </tr>
              <tr>
                <td style="font-size:12px;  ">
				<img style="padding-right:10px;" src="images/dot.jpg" /> &nbsp;
				Type: &nbsp;<strong style="color:#000;">'.$category.'</strong>
				</td>
              </tr>
              <tr>
                <td></td>
              </tr>
              <tr>
                <td style="font-size:12px;  ">
				<p><img style="padding-right:10px;" src="images/dot.jpg"  /> &nbsp;
				Price: &nbsp;<strong style="color:#000;">'.$price.' AED</strong></p></td>
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
			  <h1 style="font-weight:bold;font-size:16px;font-family:Arial;padding-bottom:8px; color:#000;">Unit Details</h1><br /></td></tr>
              <tr>
                <td style="font-size:12px;  "><br />
				<p><img style="padding-right:10px;" src="images/dot.jpg"    /> &nbsp;Bedrooms: &nbsp;<strong style="color:#000;">'.$beds.'</strong></p></td>
              </tr>
              <tr>
                <td></td>
              </tr>
              <tr>
                <td style="font-size:12px;  ">
				<p>
				<img style="padding-right:10px;" src="images/dot.jpg"    /> &nbsp;
				Bathrooms: &nbsp;<strong style="color:#000;">'.$baths.'</strong></p></td>
              </tr>
              <tr>
                <td></td>
              </tr>
              <tr>
                <td style="font-size:12px;  ">
				<p><img style="padding-right:10px;" src="images/dot.jpg"    /> &nbsp;Unit View: 
				&nbsp;<strong style="color:#000;">'.$View.'</strong></p>
				</td>
              </tr>
              <tr>
                <td></td>
              </tr>
              <tr>
                <td style="font-size:12px;  ">
				<p><img style="padding-right:10px;" src="images/dot.jpg"    /> &nbsp;Total Size: &nbsp;
				<strong style="color:#000;">'.$size.' sq.ft.</strong>
				</p></td>
              </tr>
              <tr>
                <td></td>
              </tr>
              <tr>
                <td style="font-size:12px;  ">
				<p><img style="padding-right:10px;" src="images/dot.jpg"    /> &nbsp;
				Completion Date: &nbsp;<strong style="color:#000;">Ready</strong></p>
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
			  <h1 style="font-weight:bold;font-size:16px;font-family:Arial;color:#000; padding-bottom:8px;">Other Details</h1><br/></td></tr>';
			   foreach ($features as $listing)
				{
					
             $html = $html.'  <tr>
                <td></td>
              </tr><tr>
                <td style="font-size:12px;  ">
				<p>
				<img style="padding-right:10px;" src="images/dot.jpg"    />  &nbsp;
				<strong style="color:#000;">'.$listing['title'].'</strong>
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
                <td style="font-size:12px;">
				<p><img style="padding-right:10px;" src="images/dot.jpg"    /> &nbsp;ID/Name: &nbsp;<strong style="color:#000;">'.$ag_name.'</strong></p></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td style="font-size:12px;">
				<p><img style="padding-right:10px;" src="images/dot.jpg"    /> &nbsp;
				Contact No: &nbsp;
				<strong style="color:#000;">+971 '.$ag_mobile.'</strong></p></td>
              </tr>
            </table> 
			</td>
          <td >&nbsp;</td>
          <td width="350">
		  <table style="border-collapse:collapse" width="100%" border="0">
              <tr>
                <td style="font-size:12px;">
				<p><img style="padding-right:10px;" src="images/dot.jpg"    /> &nbsp;Email Address: &nbsp;<strong style="color:#000;">'.$ag_email.'</strong></p></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td style="font-size:12px;">
				<p><img style="padding-right:10px;" src="images/dot.jpg"    /> &nbsp;Broker ID: &nbsp;<strong style="color:#000;">'.$rera.'</strong></p></td>
              </tr>
            </table></td>
          <td width="50"></td>
        </tr>
		<tr><td colspan="7" height="2"></td></tr>
      </table>
	  
	  </td>
  </tr>
  <tr  >
    <td>
	<table bgcolor="#0a4c88" height="60" width="100%" style="height:36px; line-height:60px;"><tr style="height:36px; line-height:36px;"><td align="center" valign="middle">
	<p style="font-size:13px; color:#FFFFFF;"> &nbsp;&nbsp;Al Fattan Marine Towers II, First Floor, Office No.9, Dubai Marina. P.O. Box 214392, ORN: 2533
	</p></td></tr></table></td>
  </tr>
  
  </tbody>
  
  
  </table></body>';
  
//echo $html;exit;			
$pdf->writeHTML($html, true, false, false, false, '');
$pdf->lastPage();
$pdf->AddPage();

	$html = '<table   cellpadding="2" cellspacing="2"  width="819"  style="border-left:3px solid #C09526;border-right:3px solid #C09526;border-top:3px solid #C09526;border-bottom:3px solid #C09526; border-collapse:collapse" >
  <tr>
    <td><table bgcolor="#0a4c88" style="border-collapse:collapse" width="819" border="0">
        <tr style="height:102px; background:#0a4c88; margin:0; padding:0;">
          <td height="86" align="left" valign="middle" width="603"  style="padding-left:15px;">
		  <img src="images/rpt_logo.jpg" width="205" height="84" /></td>
          <td align="left" valign="middle" height="86" width="207"  style="padding-right:15px;">
		  <img src="images/phn_dtl.jpg" width="185" height="64" /></td>
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
          <td width="60" align="center"><img src="images/map_ico.jpg"    />
            <h1 style="color:#11467b; font-size:12px;font-weight:normal;font-family:arial; padding-top:8px; padding-bottom:15px; text-align:center; margin:0;">Location Map</h1></td>
          <td width="30" height="40"></td>
          <td width="60" align="center"><img src="images/gallery_ico.jpg"    />
            <h1 style="color:#11467b; font-size:12px;font-weight:normal;font-family:arial; padding-top:8px; padding-bottom:15px; text-align:center; margin:0;">Image Gallery</h1></td>
          <td width="30" height="40"></td>
          <td width="80" align="center"><img src="images/tour_ico.jpg"    />
            <h1 style="color:#11467b; font-size:12px;font-weight:normal;font-family:arial; padding-top:8px; padding-bottom:15px; text-align:center; margin:0;">360 Virtual Tour</h1></td>
          <td width="30" height="40"></td>
          <td width="70" align="center"><img src="images/info_ico.jpg"    />
            <h1 style="color:#11467b; font-size:12px;font-weight:normal;font-family:arial; padding-top:8px; padding-bottom:15px; text-align:center; margin:0;">Property Information</h1></td>
          <td width="30" height="40"></td>
          <td width="60" align="center"><img src="images/pdf_ico.jpg"    />
            <h1 style="color:#11467b; font-size:12px;font-weight:normal;font-family:arial; padding-top:8px; padding-bottom:15px; text-align:center; margin:0;">PDF Brochure</h1></td>
          <td width="30" height="40"></td>
          <td width="100" align="center"><img src="images/curr_ico.jpg"    />
            <h1 style="color:#11467b; font-size:12px;font-weight:normal;font-family:arial; padding-top:8px; padding-bottom:15px; text-align:center; margin:0;">Auto Currency converter</h1></td>
          <td width="30" height="40"></td>
          <td width="60" align="center"><img src="images/cal_ico.jpg"    />
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
                <td style="  font-size:12px;">
				<p><img style="padding-right:10px;" src="images/dot.jpg" /> &nbsp;ID/Name: &nbsp;<strong style="color:#000;">'.$ag_name.'</strong></p></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td style="font-size:12px;  ">
				<p><img style="padding-right:10px;" src="images/dot.jpg"    /> &nbsp;Contact No: &nbsp;<strong style="color:#000;">+971 '.$ag_mobile.'</strong></p></td>
              </tr>
            </table></td>
          <td >&nbsp;</td>
          <td width="300"><table width="100%" border="0">
              <tr>
                <td style="font-size:12px;  ">
				<p><img style="padding-right:10px;" src="images/dot.jpg"    /> &nbsp;Email Address: &nbsp;<strong style="color:#000;">'.$ag_email.'</strong></p></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td style="font-size:12px;  ">
				<p><img style="padding-right:10px;" src="images/dot.jpg"    /> &nbsp;Broker ID: &nbsp;<strong style="color:#000;">'.$rera.'</strong></p></td>
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
  if (ob_get_contents()) ob_end_clean();
  //ob_start();
  $obj_pdf->Output($sr, 'I');
  exit;
	}
}
