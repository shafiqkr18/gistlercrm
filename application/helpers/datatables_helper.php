<?php
/*
 * function that generate the action buttons edit, delete
 * This is just showing the idea you can use it in different view or whatever fits your needs
 */
function get_buttons($id)
{
    $ci = & get_instance();
    $html = '<span class="actions">';
    $html .= '<a href="' . base_url() . 'subscriber/edit/' . $id . '"><img src="' . base_url() . 'assets/images/edit.png"/></a>';
    $html .= '<a href="' . base_url() . 'subscriber/delete/' . $id . '"><img src="' . base_url() . 'assets/images/delete.png"/></a>';
    $html .= '</span>';
 
    return $html;
}

function get_Overall($id)
{
	$ci = & get_instance();
	$html = '<a href="javascript:;" class="qt-tooltip" data-type="overall_score"><div class="progress">';
    $html .=' <div class="progress-bar bg-limegreen" role="progressbar" aria-valuenow="76" aria-valuemin="0" aria-valuemax="100" style="width: 76%">';
        $html .='</div> </div> <span class="pb-label limegreen">(76) Very Good</span></a>';
                        return $html;
}

function get_mediascore($id)
{
	$ci = & get_instance();
	$html = '<a href="javascript:;" class="qt-tooltip" data-type="media_score">68</a>';
	return $html;
}

function get_addressqty($id)
{
	$ci = & get_instance();
	$html = '<a href="javascript:;" class="qt-tooltip" data-type="address_score">100</a>';
	return $html;
}
function get_TargetHit($id)
{
	$ci = & get_instance();
	$html = '<a href=""><i class="fa fa-check"></i></a>';
	return $html;
}
function get_titledesc($id)
{
	$ci = & get_instance();
	$html = '<a href="javascript:;" class="qt-tooltip" data-type="description_score">80</a>';
	return $html;
}
function get_priceqty($id)
{
	$ci = & get_instance();
	$html = '<a href="javascript:;" class="qt-tooltip" data-type="price_score">100</a>';
	return $html;
}
function get_Download($id)
{
	$ci = & get_instance();
	$html ='<a href="' . base_url() . 'noticeboard/download/' . $id . '" class="text-info" ><i class="fa fa-cloud"></i></a>';
	
	return $html;
}
function get_addinfoqty($id)
{
	
	$CI = & get_instance();
	//$CI->load->database();
	$CI->load->model('common_model');
	$score = $CI->common_model->beds_baths_score($id);
	$qry = "select id from crm_listings where id='".$id."'";
	$query = $CI->db->query($qry);
	$cnt = 0;
		foreach ($query->result_array() as $row)
		{
		   $cnt= 1;
		}
// 	 
	 $html = '<a href="javascript:;" class="qt-tooltip" data-type="beds_baths_score">'.$score.'</a>';
	return $html;
}
function get_facilityqty($id)
{
	$ci = & get_instance();
	$html = '<a href="javascript:;" class="qt-tooltip" data-type="facilities_score">90</a>';
	return $html;
}
function get_user_full_name($userId) {

    //the database functions can not be called from within the helper
    //so we have to explicitly load the functions we need in to an object
    //that I will call ci. then we use that to access the regular stuff.
    $ci=& get_instance();
    $ci->load->database();

    //select the required fields from the database
    $ci->db->select('first_name, last_name');

    //tell the db class the criteria
    $ci->db->where('id', $userId);

    //supply the table name and get the data
    $row = $ci->db->get('crm_users')->row();

    //get the full name by concatinating the first and last names
    $fullName = $row->first_name . " " . $row->last_name;

    // return the full name;
    return $fullName;

}
