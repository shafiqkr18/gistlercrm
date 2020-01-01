<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/* Author: Shafiq

* Description: rentals model class

*/
class Listings_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();

    }
    
    public function getusers()
    {
        $admin_ID  = $this->session->userdata('userid');
        $user_type = $this->session->userdata('user_type');
        $this->db->select("id,CONCAT(first_name, ' ', last_name) As name");
        $this->db->from("crm_users");
        $where = "is_active = 1 AND STATUS=1";
        $this->db->where($where);
        $this->db->order_by("name", "asc");
        //echo $this->db->get_compiled_select();exit;
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_floorpics($filename, $arr_images, $linked_id, $rand_key)
    {
        $admin_ID  = $this->session->userdata('userid');
        $user_type = $this->session->userdata('user_type');
        $this->db->select('*');
        $this->db->from('crm_listings_images');
         if (empty($arr_images) || !($arr_images) || !(isset($arr_images)) ) {
            $this->db->where('rand_key', $rand_key);
        } else {
             $this->db->where_in('id', $arr_images);
           
        }
        $this->db->where('is_active', 1);
        $this->db->where('image_type', 'floor');
        return $this->db->get()->result_array();
    }
    
    public function get_pics($filename, $arr_images, $linked_id, $rand_key)
    {
        $admin_ID  = $this->session->userdata('userid');
        $user_type = $this->session->userdata('user_type');
        $this->db->select('*');
        $this->db->from('crm_listings_images');
       // $arr_images = array_filter($arr_images);
       // if (!empty($arr_images)) {
        if (empty($arr_images) || !($arr_images) || !(isset($arr_images)) ) {
            $this->db->where('rand_key', $rand_key);
        } else {
             $this->db->where_in('id', $arr_images);
           
        }
        $this->db->where('is_active', 1);
        $this->db->where('image_type', 'photos');
        return $this->db->get()->result_array();
    }
    
    public function delete_images($id)
    {
        $admin_ID = $this->session->userdata('userid');
        $data     = array(
            'is_active' => 0,
            'created_by' => $admin_ID
        );
        $this->db->where('id', $id);
        return $this->db->update('crm_listings_images', $data);
    }
    
    public function save_images($rand_key, $new_name, $listing_id, $type_dummy, $image_type)
    {
        $admin_ID     = $this->session->userdata('userid');
        $created_date = date('Y-m-d');
        //$xary = array('rand_key','rentals_id','created_date','image', 'thumb','watermark_image','created_by');
        if ($image_type != 'floor')
            $image_type = 'photos';
        $data = array(
            'rand_key' => $rand_key,
            'listing_id' => $listing_id,
            'listing_type' => $type_dummy,
            'created_date' => $created_date,
            'image' => $new_name,
            'thumb' => $new_name,
            'watermark_image' => $new_name,
            'created_by' => $admin_ID,
            'image_type' => $image_type
        );
        $this->db->insert('crm_listings_images', $data); // insert new record
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    
    public function save_documents($rand_key, $new_name, $listing_id, $title)
    {
        $admin_ID  = $this->session->userdata('userid');
        $client_id = $this->session->userdata('client_id');
        $dateadded = date('Y-m-d');
        //$xary = array('rand_key','rentals_id','created_date','image', 'thumb','watermark_image','created_by');
        $data      = array(
            'document_name' => $new_name,
            'title' => $title,
            'listing_id' => $listing_id,
            'rand_key' => $rand_key,
            'created_by' => $admin_ID,
            'client_id' => $client_id,
            'dateadded' => $dateadded
        );
        return $this->db->insert('crm_listings_documents', $data); // insert new record
        //  $insert_id = $this->db->insert_id();
        // return $insert_id;
    }
    
    public function datatable($type)
    {
        // get user
        $admin_ID      = $this->session->userdata('userid');
        $user_type     = $this->session->userdata('user_type');
        // to avoid "The SELECT would examine more than MAX_JOIN_SIZE rows;"
        $query_For_Max = $this->db->query("SET SQL_BIG_SELECTS=1");
        if ($type == "rentals") {
            $type = 1;
        } else {
            $type = 2;
        }
        /***********************check user starts here *******/
        if ($user_type == 3) // user is agent
            {
            //CASE WHEN crm_listings.agent_id=".$admin_ID." THEN crm_listings.unit ELSE '--' END AS unit
            //CASE WHEN crm_listings.agent_id=".$admin_ID." THEN crm_listings.landlord_name ELSE '--' END AS landlord_id
            $c = "crm_listings.id as id,crm_listings.terminal as terminal,crm_listings.status as status,crm_listings.managed as managed,crm_listings.exclusive as exclusive,crm_listings.shared as shared,crm_listings.ref as ref,
					    crm_listings.unit,
					    crm_category.category as category,crm_city.name as region_id,crm_location.loc_name as area_location_id,crm_subloc.sub_sub_loc as sub_area_location_id,crm_listings.beds as beds,crm_listings.size as size,

				crm_listings.price as price,CONCAT(crm_users.first_name, ' ', crm_users.last_name) as agent_id,
				 crm_listings.landlord_id, crm_listings.landlord_name,
				 crm_listings.unit_type as unit_type,crm_listings.baths as baths,crm_listings.street_no as street_no,crm_listings.floor_no as floor_no,crm_listings.dewa_no as dewa_no,crm_listings.photos as photos,crm_listings.cheques as cheques,crm_listings.fitted as fitted,crm_listings.prop_status as prop_status,crm_listings.source_of_listing as source_of_listing,crm_listings.available_date as available_date,

				crm_listings.remind_me as remind_me,crm_listings.furnished as furnished,crm_listings.featured as featured,crm_listings.maintenance as maintenance,crm_listings.strno as strno,crm_listings.amount as amount,crm_listings.tenanted as tenanted,crm_listings.plot_size as plot_size,crm_listings.name as name,crm_listings.view_id as view_id,crm_listings.commission as commission,crm_listings.deposit as deposit,crm_listings.unit_size_price as unit_size_price,crm_listings.dateadded as dateadded,crm_listings.dateupdated as dateupdated,

				CONCAT(crm_users.first_name, ' ', crm_users.last_name) as user_id,crm_listings.key_location as key_location,crm_listings.development_unit_id as development_unit_id";
            $this->datatables->select($c)->unset_column('id') //this means if you want to include in columns or search
                ->from('crm_listings');
            $this->datatables->join('crm_category', 'crm_listings.category_id = crm_category.id', 'left');
            $this->datatables->join('crm_city', 'crm_city.id = crm_listings.region_id', 'left');
            $this->datatables->join('crm_location', 'crm_location.loc_id = crm_listings.area_location_id', 'left');
            $this->datatables->join('crm_subloc', 'crm_subloc.sub_loc_id = crm_listings.sub_area_location_id', 'left');
            $this->datatables->join('crm_users', 'crm_users.id = crm_listings.agent_id', 'left');
            //$this->datatables ->where('crm_listings.agent_id', $admin_ID); 
        } else {
            //CASE WHEN crm_listings.agent_id='.$admin_ID.' THEN crm_listings.unit ELSE "--" END AS unit
            $c = 'crm_listings.id as id,crm_listings.terminal as terminal,crm_listings.status as status,crm_listings.managed as managed,crm_listings.exclusive as exclusive,crm_listings.shared as shared,crm_listings.ref as ref,
					crm_listings.unit,
					crm_category.category as category,crm_city.name as region_id,crm_location.loc_name as area_location_id,crm_subloc.sub_sub_loc as sub_area_location_id,crm_listings.beds as beds,crm_listings.size as size,

				crm_listings.price as price,CONCAT(crm_users.first_name, " ", crm_users.last_name) as agent_id,crm_listings.landlord_id as landlord_id,crm_listings.unit_type as unit_type,crm_listings.baths as baths,crm_listings.street_no as street_no,crm_listings.floor_no as floor_no,crm_listings.dewa_no as dewa_no,crm_listings.photos as photos,crm_listings.cheques as cheques,crm_listings.fitted as fitted,crm_listings.prop_status as prop_status,crm_listings.source_of_listing as source_of_listing,crm_listings.available_date as available_date,

				crm_listings.remind_me as remind_me,crm_listings.furnished as furnished,crm_listings.featured as featured,crm_listings.maintenance as maintenance,crm_listings.strno as strno,crm_listings.amount as amount,crm_listings.tenanted as tenanted,crm_listings.plot_size as plot_size,crm_listings.name as name,crm_listings.view_id as view_id,crm_listings.commission as commission,crm_listings.deposit as deposit,crm_listings.unit_size_price as unit_size_price,crm_listings.dateadded as dateadded,crm_listings.dateupdated as dateupdated,

				CONCAT(crm_users.first_name, " ", crm_users.last_name) as user_id,crm_listings.key_location as key_location,crm_listings.development_unit_id as development_unit_id';
            $this->datatables->select($c)->unset_column('id') //this means if you want to include in columns or search
                ->from('crm_listings');
            $this->datatables->join('crm_category', 'crm_listings.category_id = crm_category.id', 'left');
            $this->datatables->join('crm_city', 'crm_city.id = crm_listings.region_id', 'left');
            $this->datatables->join('crm_location', 'crm_location.loc_id = crm_listings.area_location_id', 'left');
            $this->datatables->join('crm_subloc', 'crm_subloc.sub_loc_id = crm_listings.sub_area_location_id', 'left');
            $this->datatables->join('crm_users', 'crm_users.id = crm_listings.agent_id', 'left');
        }
        /***********************check user ends here *******/
        /***********************common where conditions starts here *******/
        $this->datatables->where('crm_listings.is_active', 1);
        $this->datatables->where('crm_listings.is_archive', 0);
        $this->datatables->where('crm_listings.type', $type);
        /***********************where conditions starts here *******/
        if ($this->input->post('status')) {
            if ($this->input->post('status') == 100) {
                $where = "date(dateUpdated) = CURDATE() - INTERVAL 30 DAY";
                $this->datatables->where($where);
            } elseif ($this->input->post('status') == 101) {
                $this->datatables->where('crm_listings.photos < ', 10);
            } elseif ($this->input->post('status') == 102) {
                if ($type == "rentals") {
                    $where = "dateupdated < DATE_SUB(CURRENT_DATE, INTERVAL 15 DAY)";
                } else {
                    $where = "dateupdated < DATE_SUB(CURRENT_DATE, INTERVAL 30 DAY)";
                }
                $this->datatables->where($where);
            } else {
                $this->datatables->where('crm_listings.status', $this->input->post('status'));
            }
        }
        if ($this->input->post('listing_agent')) {
            $this->datatables->where('crm_listings.agent_id', $this->input->post('listing_agent'));
        }
        //&as_prop_status=3&as_available_date_from=2016-03-16&as_prop_furnish=1&as_source_of_listing=Cold+call
        //check post for advanced search
        $crm_listingsfields = $this->db->list_fields('crm_listings');
        foreach ($crm_listingsfields as $field) {
            if ($this->input->post('as_' . $field)) {
                $this->datatables->where('crm_listings.' . $field, $this->input->post('as_' . $field));
            }
        }

        /**********************where ends here*********************/
        return $this->datatables->generate();
    }
    
    public function datatable_archive($type)
    {
        if ($type == "rentals") {
            $type = 1;
        } else {
            $type = 2;
        }
        //CASE WHEN crm_listings.agent_id='.$admin_ID.' THEN crm_listings.unit ELSE "--" END AS unit
        $c = 'crm_listings.id as id,crm_listings.status as status,crm_listings.managed as managed,crm_listings.exclusive as exclusive,crm_listings.shared as shared,crm_listings.ref as ref,
				crm_listings.unit,

				crm_category.category as category,crm_city.name as region_id,crm_location.loc_name as area_location_id,crm_subloc.sub_sub_loc as sub_area_location_id,crm_listings.beds as beds,crm_listings.size as size,

				crm_listings.price as price,CONCAT(crm_users.first_name, " ", crm_users.last_name) as agent_id,crm_listings.landlord_id as landlord_id,crm_listings.dateadded as dateadded,crm_listings.dateupdated as dateupdated';
        $this->datatables->select($c)->unset_column('id') //this means if you want to include in columns or search
            ->from('crm_listings');
        $this->datatables->join('crm_category', 'crm_listings.category_id = crm_category.id', 'left');
        $this->datatables->join('crm_city', 'crm_city.id = crm_listings.region_id', 'left');
        $this->datatables->join('crm_location', 'crm_location.loc_id = crm_listings.area_location_id', 'left');
        $this->datatables->join('crm_subloc', 'crm_subloc.sub_loc_id = crm_listings.sub_area_location_id', 'left');
        $this->datatables->join('crm_users', 'crm_users.id = crm_listings.agent_id', 'left');
        //$this->datatables->join('crm_users', 'crm_users.id = crm_listings.created_by', 'left');
        $this->datatables->where('crm_listings.is_archive', 1);
        $this->datatables->where('crm_listings.type', $type);
        return $this->datatables->generate();
    }
    
    public function datatable_quality($type)
    {
        if ($type == "rentals") {
            $type = 1;
        } else {
            $type = 2;
        }
        $c = 'crm_listings.id as id,crm_listings.status as status,crm_listings.ref as ref,crm_category.category as category,crm_city.name as region_id,crm_location.loc_name as area_location_id,crm_subloc.sub_sub_loc as sub_area_location_id,

			crm_listings.beds as beds,CONCAT(crm_users.first_name, " ", crm_users.last_name) as agent_id,crm_listings.dateupdated as dateupdated,

			crm_listings.overall_score,crm_listings.media_score,crm_listings.address_score,

			crm_listings.description_score,crm_listings.price_score,crm_listings.beds_baths_score,crm_listings.facilities_score';
        $this->datatables->select($c)->unset_column('id') //this means if you want to include in columns or search
            
        //->add_column('Overall', get_Overall('$1'), 'overall_score')
            
        // ->add_column('media',get_mediascore('$1'),'id')
            
        // ->add_column('addressqty', get_addressqty('$1'), 'id')
            
        // ->add_column('titledesc',get_titledesc('$1'),'id')
            
        // ->add_column('priceqty', get_priceqty('$1'), 'id')
            
        // ->add_column('addinfoqty',get_addinfoqty('$1'),'id')
            
        // ->add_column('facilityqty',get_facilityqty('$1'),'id')
            ->from('crm_listings');
        $this->datatables->join('crm_category', 'crm_listings.category_id = crm_category.id', 'left');
        $this->datatables->join('crm_city', 'crm_city.id = crm_listings.region_id', 'left');
        $this->datatables->join('crm_location', 'crm_location.loc_id = crm_listings.area_location_id', 'left');
        $this->datatables->join('crm_subloc', 'crm_subloc.sub_loc_id = crm_listings.sub_area_location_id', 'left');
        $this->datatables->join('crm_users', 'crm_users.id = crm_listings.agent_id', 'left');
        //$this->datatables->join('crm_users', 'crm_users.id = crm_listings.created_by', 'left');
        $this->datatables->where('crm_listings.is_active', 1);
        $this->datatables->where('crm_listings.type', $type);
        return $this->datatables->generate();
    }
    /**********************save data section**************/
    public function save_listing()
    {
        if (!$this->session->userdata('validated')) {
            redirect('login');
        }
        /*************get session values*********/
        $created_by      = $this->session->userdata('userid');
        $updated_by      = $this->session->userdata('userid');
        $user_type       = $this->session->userdata('user_type');
        $disable_publish = $this->session->userdata('disable_publish');
        $edit_listings   = $this->session->userdata('edit_listings');
        /*************end session values*********/
        $dateadded       = date('Y-m-d H:i:s');
        $dateupdated     = date('Y-m-d H:i:s');
        //set type for lisitng
        $type            = $this->input->post('type_dummy');
        //check either it is new entry or updation
        if (($this->input->post('id')) && ($this->input->post('ref'))) { //this is update
            $id  = $this->input->post('id');
            $ref = $this->input->post('ref');
        } else {
            $id  = 0;
            $ret = $this->db->query("select IFNULL(max(id),0) as id from crm_listings")->row()->id;
            $ret = str_pad($ret, 4, '0', STR_PAD_LEFT);
            $ret = $ret + 0001;
            //set ref number here
            if ($type == 1) {
                $ref = "GIS-R-" . $ret;
            } else {
                $ref = "GIS-S-" . $ret;
            }
        }
        $is_international = $this->input->get('ineternational');


        // check if it is sales or rentals
        if($type == 2)
        {
            $cheques = 0;
        }else{
            $cheques = $this->input->post('cheques');
        }
        /***************** setting users data **************/
        //check if agent is saving it,it should be filtered first
        if ($user_type == 3) //this is agent
            {
            //check if agent has permission to approve
            if ($disable_publish == 0) //no approval required
                {
                //no approval req.so do what he selected
                $status = $this->input->post('status');
            } else {
                //if user/agent selected publish this means its waiting for approval
                if ($this->input->post('status') == 1) {
                    $status = 3; //unapproved
                } else {
                    //users selected unpublish,means he want to draft it
                    $status = 4; // draft it
                }
            }
        } else {
            //this is not agent so do what he selected
            $status = $this->input->post('status');
        }
        /********************end setting user data**********/
        /*********************start of listing 	quality****/
        //media score
        $othermedia_count = $this->input->post('othermedia_count');
        if ($othermedia_count > 3)
            $media_score = 75;
        else
            $media_score = 50;
        //address score
        $address_score = 0;
        if ($this->input->post('region_id') > 0)
            $address_score = $address_score + 33;
        if ($this->input->post('area_location_id') > 0)
            $address_score = $address_score + 33;
        if ($this->input->post('sub_area_location_id') > 0)
            $address_score = $address_score + 33;
        //description score
        $description_score = 80;
        if ($this->input->post('description_count') > 970 && $this->input->post('description_count') < 1010) {
            $description_score = 100;
        }
        //price score check here
        $price_score      = 75;
        //beds & baths score
        $beds_baths_score = 0;
        if ($this->input->post('beds') > 0)
            $beds_baths_score = $beds_baths_score + 50;
        if ($this->input->post('baths') > 0)
            $beds_baths_score = $beds_baths_score + 50;
        $facilities_score = 75;
        $price_diff       = 75;
        //now overall score
        $overall_score    = (($media_score + $address_score + $description_score + $price_score + $beds_baths_score + $facilities_score + $price_diff) / 7);
        /********************end of listing quality*******/
        // Create two arrays, one for save and other for update
        $data_save        = array(
            'client_id' => $this->input->post('client_id'),
            'rand_key' => $this->input->post('rand_key'),
            'type' => $type,
            'ref' => $ref,
            'name' => $this->input->post('name'),
            'description_demo' => $this->input->post('description_demo'),
            'description_count' => ($this->input->post('description_count') ? $this->input->post('description_count'):0),
            'beds' => $this->input->post('beds'),
            'fitted' => $this->input->post('fitted'),
            'baths' => $this->input->post('baths'),
            'unit' => $this->input->post('unit'),
            'unit_type' => $this->input->post('unit_type'),
            'size' => $this->input->post('size'),
            'plot_size' => $this->input->post('plot_size'),
            'street_no' => $this->input->post('street_no'),
            'floor_no' => $this->input->post('floor_no'),
            'parking' => ($this->input->post('parking') ? $this->input->post('parking'):0),
            'price' => $this->input->post('price'),
            'deposit' => ($this->input->post('deposit') ? $this->input->post('deposit'):0),
            'deposit_percentage' => ($this->input->post('deposit_percentage') ? $this->input->post('deposit_percentage'):0),
            'cheques' => $cheques,
            'commission_percentage' => ($this->input->post('commission_percentage') ? $this->input->post('commission_percentage'):0),
            'commission' => ($this->input->post('commission') ? $this->input->post('commission'):0),
            'unit_size_price' => $this->input->post('unit_size_price'),
            'frequency' => $this->input->post('frequency'),
            'dateadded' => $dateadded,
            'dateupdated' => $dateupdated,
            'category_id' => $this->input->post('category_id'),
            'region_id' => $this->input->post('region_id'),
            'area_location_id' => $this->input->post('area_location_id'),
            'sub_area_location_id' => $this->input->post('sub_area_location_id'),
            'view_id' => $this->input->post('view_id'),
            'prop_furnish' => ($this->input->post('prop_furnish') ? $this->input->post('prop_furnish'):0),
            'landlord_id' => ($this->input->post('landlord_id') ? $this->input->post('landlord_id'):0),
            'landlord_name' => $this->input->post('landlord_name'),
            'photos' => ($this->input->post('photos') ? $this->input->post('photos'):0),
            'portals_count' => ($this->input->post('portals_count') ? $this->input->post('portals_count'):0),
            'portals_name' => $this->input->post('portals_name'),
            'othermedia_count' => ($this->input->post('othermedia_count') ? $this->input->post('othermedia_count'):0),
            'features_count' => ($this->input->post('features_count') ? $this->input->post('features_count'):0),
            'features_id' => $this->input->post('features_id'),
            'area_iformation_data' => ($this->input->post('area_iformation_data') ? $this->input->post('area_iformation_data'):''),
            'leads' => $this->input->post('leads'),
            'viewings_count' => ($this->input->post('viewings_count') ? $this->input->post('viewings_count'):0),
            'add_info' => $this->input->post('add_info'),
            'agent_id' => $this->input->post('agent_id'),
            'status' => $status,
            'managed' => $this->input->post('managed'),
            'exclusive' => $this->input->post('exclusive'),
            'shared' => $this->input->post('shared'),
            'created_by' => $created_by,
            'updated_by' => $updated_by,
            'lat' => $this->input->post('lat'),
            'lon' => $this->input->post('lon'),
            'other_languages' => $this->input->post('other_languages'),
            'other_title_1' => $this->input->post('other_title_1'),
            'other_description_1' => $this->input->post('other_description_1'),
            'other_title_2' => $this->input->post('other_title_2'),
            'other_description_2' => $this->input->post('other_description_2'),
            'featured' => $this->input->post('featured'),
            'refreshed' => $this->input->post('refreshed'),
            'video_embed_code' => $this->input->post('video_embed_code'),
            '360_embed_code' => $this->input->post('360_embed_code'),
            'audio_embed_code' => $this->input->post('audio_embed_code'),
            'virtual_tour_embed_code' => $this->input->post('virtual_tour_embed_code'),
            'qr_code_link' => $this->input->post('qr_code_link'),
            'pdf_brochure' => $this->input->post('pdf_brochure'),
            'video_path' => $this->input->post('video_path'),
            'video_path_upload' => $this->input->post('video_path_upload'),
            'price_1' =>($this->input->post('price_1') ? $this->input->post('price_1'):0),
            'cheques_1' => ($this->input->post('cheques_1') ? $this->input->post('cheques_1'):0),
            'price_2' => ($this->input->post('price_2') ? $this->input->post('price_2'):0),
            'cheques_2' => ($this->input->post('cheques_2') ? $this->input->post('cheques_2'):0),
            'price_3' => ($this->input->post('price_3') ? $this->input->post('price_3'):0),
            'cheques_3' => ($this->input->post('cheques_3') ? $this->input->post('cheques_3'):0),
            'price_4' => ($this->input->post('price_4') ? $this->input->post('price_4'):0),
            'cheques_4' => ($this->input->post('cheques_4') ? $this->input->post('cheques_4'):0),
            'prop_status' => ($this->input->post('prop_status') ? $this->input->post('prop_status'):0),
            'agent_rent_sold' => ($this->input->post('agent_rent_sold') ? $this->input->post('agent_rent_sold'):0),
            'source_of_listing' => ($this->input->post('source_of_listing') ? $this->input->post('source_of_listing'):0),
            'flcheck' => ($this->input->post('flcheck') ? $this->input->post('flcheck'):0),
            'dewa_no' => $this->input->post('dewa_no'),
            'strno' => $this->input->post('strno'),
            'available_date' => ($this->input->post('available_date') ? $this->input->post('available_date'): date('Y-m-d')),
            'remind_me' => ($this->input->post('remind_me') ? $this->input->post('remind_me'):0),
            'key_location' => $this->input->post('key_location'),
            'tenanted' => ($this->input->post('tenanted') ? $this->input->post('tenanted'):0),
            'amount' => ($this->input->post('amount') ? $this->input->post('amount'):0),
            'amount_date' => $this->input->post('amount_date'),
            'maintenance' => $this->input->post('maintenance'),
            'unit_size_price_2' => ($this->input->post('unit_size_price_2') ? $this->input->post('unit_size_price_2'):0),
            'notes' => $this->input->post('notes'),
            'leads_notes' => $this->input->post('leads_notes'),
            'document_name' => $this->input->post('document_name'),
            'terminal' => ($this->input->post('terminal') ? $this->input->post('terminal'):0),
            'furnished' => ($this->input->post('furnished') ? $this->input->post('furnished'):0),
            'development_unit_id' => ($this->input->post('development_unit_id') ? $this->input->post('development_unit_id'):0),
            'is_international' => $is_international,
            'overall_score' => $overall_score,
            'media_score' => $media_score,
            'address_score' => $address_score,
            'description_score' => $description_score,
            'price_score' => $price_score,
            'beds_baths_score' => $beds_baths_score,
            'facilities_score' => $facilities_score,
            'price_diff' => $price_diff
        );
        ////////////////////////////////////////////////////////////////////////
        $data_update      = array(
            'id' => $id,
            'client_id' => $this->input->post('client_id'),
            'rand_key' => $this->input->post('rand_key'),
            'type' => $type,
            'ref' => $ref,
            'name' => $this->input->post('name'),
            'description_demo' => $this->input->post('description_demo'),
            'description_count' => ($this->input->post('description_count') ? $this->input->post('description_count'):0),
            'beds' => $this->input->post('beds'),
            'fitted' => $this->input->post('fitted'),
            'baths' => $this->input->post('baths'),
            'unit' => $this->input->post('unit'),
            'unit_type' => $this->input->post('unit_type'),
            'size' => $this->input->post('size'),
            'plot_size' => $this->input->post('plot_size'),
            'street_no' => $this->input->post('street_no'),
            'floor_no' => $this->input->post('floor_no'),
            'parking' => ($this->input->post('parking') ? $this->input->post('parking'):0),
            'price' => $this->input->post('price'),
            'deposit' => ($this->input->post('deposit') ? $this->input->post('deposit'):0),
            'deposit_percentage' => ($this->input->post('deposit_percentage') ? $this->input->post('deposit_percentage'):0),
            'cheques' => $cheques,
            'commission_percentage' => ($this->input->post('commission_percentage') ? $this->input->post('commission_percentage'):0),
            'commission' => ($this->input->post('commission') ? $this->input->post('commission'):0),
            'unit_size_price' => $this->input->post('unit_size_price'),
            'frequency' => $this->input->post('frequency'),
            'dateadded' => $dateadded,
            'dateupdated' => $dateupdated,
            'category_id' => $this->input->post('category_id'),
            'region_id' => $this->input->post('region_id'),
            'area_location_id' => $this->input->post('area_location_id'),
            'sub_area_location_id' => $this->input->post('sub_area_location_id'),
            'view_id' => $this->input->post('view_id'),
            'prop_furnish' => ($this->input->post('prop_furnish') ? $this->input->post('prop_furnish'):0),
            'landlord_id' => ($this->input->post('landlord_id') ? $this->input->post('landlord_id'):0),
            'landlord_name' => $this->input->post('landlord_name'),
            'photos' => ($this->input->post('photos') ? $this->input->post('photos'):0),
            'portals_count' => ($this->input->post('portals_count') ? $this->input->post('portals_count'):0),
            'portals_name' => $this->input->post('portals_name'),
            'othermedia_count' => ($this->input->post('othermedia_count') ? $this->input->post('othermedia_count'):0),
            'features_count' => ($this->input->post('features_count') ? $this->input->post('features_count'):0),
            'features_id' => $this->input->post('features_id'),
            'area_iformation_data' => ($this->input->post('area_iformation_data') ? $this->input->post('area_iformation_data'):''),
            'leads' => $this->input->post('leads'),
            'viewings_count' => ($this->input->post('viewings_count') ? $this->input->post('viewings_count'):0),
            'add_info' => $this->input->post('add_info'),
            'agent_id' => $this->input->post('agent_id'),
            'status' => $this->input->post('status'),
            'managed' => $this->input->post('managed'),
            'exclusive' => $this->input->post('exclusive'),
            'shared' => $this->input->post('shared'),
            'updated_by' => $updated_by,
            'lat' => $this->input->post('lat'),
            'lon' => $this->input->post('lon'),
            'other_languages' => $this->input->post('other_languages'),
            'other_title_1' => $this->input->post('other_title_1'),
            'other_description_1' => $this->input->post('other_description_1'),
            'other_title_2' => $this->input->post('other_title_2'),
            'other_description_2' => $this->input->post('other_description_2'),
            'featured' => $this->input->post('featured'),
            'refreshed' => $this->input->post('refreshed'),
            'video_embed_code' => $this->input->post('video_embed_code'),
            '360_embed_code' => $this->input->post('360_embed_code'),
            'audio_embed_code' => $this->input->post('audio_embed_code'),
            'virtual_tour_embed_code' => $this->input->post('virtual_tour_embed_code'),
            'qr_code_link' => $this->input->post('qr_code_link'),
            'pdf_brochure' => $this->input->post('pdf_brochure'),
            'video_path' => $this->input->post('video_path'),
            'video_path_upload' => $this->input->post('video_path_upload'),
            'price_1' =>($this->input->post('price_1') ? $this->input->post('price_1'):0),
            'cheques_1' => ($this->input->post('cheques_1') ? $this->input->post('cheques_1'):0),
            'price_2' => ($this->input->post('price_2') ? $this->input->post('price_2'):0),
            'cheques_2' => ($this->input->post('cheques_2') ? $this->input->post('cheques_2'):0),
            'price_3' => ($this->input->post('price_3') ? $this->input->post('price_3'):0),
            'cheques_3' => ($this->input->post('cheques_3') ? $this->input->post('cheques_3'):0),
            'price_4' => ($this->input->post('price_4') ? $this->input->post('price_4'):0),
            'cheques_4' => ($this->input->post('cheques_4') ? $this->input->post('cheques_4'):0),
            'prop_status' => ($this->input->post('prop_status') ? $this->input->post('prop_status'):0),
            'agent_rent_sold' => ($this->input->post('agent_rent_sold') ? $this->input->post('agent_rent_sold'):0),
            'source_of_listing' => ($this->input->post('source_of_listing') ? $this->input->post('source_of_listing'):0),
            'flcheck' => ($this->input->post('flcheck') ? $this->input->post('flcheck'):0),
            'dewa_no' => $this->input->post('dewa_no'),
            'strno' => $this->input->post('strno'),
            'available_date' => ($this->input->post('available_date') ? $this->input->post('available_date'): date('Y-m-d')),
            'remind_me' => ($this->input->post('remind_me') ? $this->input->post('remind_me'):0),
            'key_location' => $this->input->post('key_location'),
            'tenanted' => ($this->input->post('tenanted') ? $this->input->post('tenanted'):0),
            'amount' => ($this->input->post('amount') ? $this->input->post('amount'):0),
            'amount_date' => $this->input->post('amount_date'),
            'maintenance' => $this->input->post('maintenance'),
            'unit_size_price_2' => ($this->input->post('unit_size_price_2') ? $this->input->post('unit_size_price_2'):0),
            'notes' => $this->input->post('notes'),
            'leads_notes' => $this->input->post('leads_notes'),
            'document_name' => $this->input->post('document_name'),
            'terminal' => ($this->input->post('terminal') ? $this->input->post('terminal'):0),
            'furnished' => ($this->input->post('furnished') ? $this->input->post('furnished'):0),
            'development_unit_id' => ($this->input->post('development_unit_id') ? $this->input->post('development_unit_id'):0),
            'is_international' => $is_international,
            'overall_score' => $overall_score,
            'media_score' => $media_score,
            'address_score' => $address_score,
            'description_score' => $description_score,
            'price_score' => $price_score,
            'beds_baths_score' => $beds_baths_score,
            'facilities_score' => $facilities_score,
            'price_diff' => $price_diff
        );
        //print_r($data_save);
        /*************************images section**********/
        //check iamges
        $imagesArray      = $this->input->post('images_ids');
        /******************************end images*/
        /***************************everything clear now either save or update***********************************/
        if (($this->input->post('id')) && ($this->input->post('ref'))) { // this is update section
            $listing_id = $this->input->post('id');
            $this->db->where('id', $listing_id);
            $this->db->update('crm_listings', $data_update); // update the record
            //create history now
            $data_update['id']         = 0;
            $data_update['action']     = "update";
            $data_update['listing_id'] = $listing_id;
          //  $this->db->insert('crm_listings_history', $data_update); // insert new record in history
        } else {
            $this->db->insert('crm_listings', $data_save); // insert new record
            $listing_id              = $this->db->insert_id();
            //create history now
            $data_save['action']     = "insert";
            $data_save['listing_id'] = $listing_id;
           // $this->db->insert('crm_listings_history', $data_save); // insert new record in history
        }
        /*****************************Once data saved,Now update images for this listing*********************************************/
        if (count($imagesArray) > 1) {
            $q1 = "update crm_listings_images set listing_id=" . $listing_id . " WHERE id IN(" . implode(",", $imagesArray) . ")";
            $this->db->query($q1);
        }
        /************************save notes*********************************/
        if ($this->input->post('notes')) {
            $data_notes = array(
                'created_by' => $created_by,
                'notes' => $this->input->post('notes'),
                'created_date' => date("Y-m-d H:i:s"),
                'listing_id' => $listing_id,
                'rand_key' => $this->input->post('rand_key')
            );
            $this->db->insert('crm_listings_notes', $data_notes);
        }
        return true;
    } //end save data function
    public function getSingleRow($id, $type)
    {
        // get user
        $admin_ID  = $this->session->userdata('userid');
        $user_type = $this->session->userdata('user_type');
        $this->db->select('*');
        $this->db->from('crm_listings');
        $where = "id=" . $id;
        $this->db->where($where);
        $query         = $this->db->get();
        /*********************get notes for this listing******************/
        $queryNotes    = $this->db->query("select r.notes,r.created_date,CONCAT(u.first_name, ' ', u.last_name) As user_name  FROM crm_listings_notes r 

		   LEFT JOIN crm_users u on u.id=r.created_by  WHERE  r.listing_id=" . $id . " ORDER BY r.activitytime desc");
        $results_notes = array();
        foreach ($queryNotes->result() as $rowNote) {
            $date            = date_create($rowNote->created_date);
            $mydt            = date_format($date, 'Y-m-d H:i');
            $results_notes[] = array(
                'notes' => $rowNote->notes,
                'date' => $mydt,
                'user_name' => $rowNote->user_name
            );
        }
        $queryNotes->free_result();
        /*******************end of notes*********************************/
        /*********************get documents for this listing******************/
        $querydocs    = $this->db->query("select id,document_name,title,rand_key FROM crm_listings_documents WHERE  listing_id=" . $id . " and is_active=1 ORDER BY activitytime desc");
        $results_docs = array();
        foreach ($querydocs->result() as $rowDoc) {
            $link           = base_url() . "uploads/documents/listings/" . $this->session->userdata('client_id') . "/" . $this->session->userdata('userid') . "/" . md5($rowDoc->rand_key) . "/" . $rowDoc->document_name;
            $results_docs[] = array(
                'document_link' => $link,
                'document_name' => $rowDoc->title
            );
        }
        $querydocs->free_result();
        /*******************end of documents*********************************/
        /*******************leads*************/
        $this->db->where("listing_id_1=" . $id . " OR listing_id_2 = '$id' OR listing_id_3 = '$id' OR listing_id_4 = '$id'");
        $this->db->from('crm_leads');
        $leads = $this->db->count_all_results();
        /**************end leads**************/
        if ($query->num_rows() == 1) {
            // One row, match!
            $row         = $query->row();
            //quality calculation
            $results_qty = array();
            $results_qty = array(
                'overall_score' => $row->overall_score,
                'media_score' => $row->media_score,
                'address_score' => $row->address_score,
                'description_score' => $row->description_score,
                'price_score' => $row->price_score,
                'beds_baths_score' => $row->beds_baths_score,
                'facilities_score' => $row->facilities_score,
                'price_diff' => $row->price_diff,
                'status' => $row->status,
                'ref' => $row->ref,
                'category_id' => $row->category_id,
                'region_id' => $row->region_id,
                'area_location' => $row->area_location_id,
                'sub_area_location' => $row->sub_area_location_id,
                'beds' => $row->beds,
                'agent_id' => $row->agent_id,
                'dateupdated' => $row->dateupdated,
                'floor_plans' => 0,
                'type' => $row->type
            );
            // "overall_score":"0","media_score":"0","address_score":"0","description_score":"0","price_score":null,"beds_baths_score":"0",
            //"facilities_score":"0","price_diff":null,"status":"1","ref":"ROH-R-1188","category_id":"1","region_id":"1","area_location"
            //:"8238","sub_area_location":"0","beds":"1","agent_id":"1448804","dateupdated":"1448862338","floor_plans":"0","type":"1"
            //end of quality
            // check user role
            if ($user_type == 3) {
                $unit          = "--";
                $landlord_name = "--";
            } else {
                $unit          = $row->unit;
                $landlord_name = $row->landlord_name;
            }
            //end user role check
            return array(
                'id' => '' . $row->id . '',
                'client_id' => '' . $row->client_id . '',
                'rand_key' => '' . $row->rand_key . '',
                'ref' => '' . $row->ref . '',
                'name' => '' . $row->name . '',
                //'description_demo'=> ''.$row->description_demo.'',
                'description' => '' . $row->description_demo . '',
                'description_count' => '' . $row->description_count . '',
                'beds' => '' . $row->beds . '',
                'fitted' => '' . $row->fitted . '',
                'baths' => '' . $row->baths . '',
                'unit' => '' . $unit . '',
                'unit_type' => '' . $row->unit_type . '',
                'size' => '' . $row->size . '',
                'plot_size' => '' . $row->plot_size . '',
                'street_no' => '' . $row->street_no . '',
                'floor_no' => '' . $row->floor_no . '',
                'parking' => '' . $row->parking . '',
                'price' => '' . $row->price . '',
                'deposit' => '' . $row->deposit . '',
                'deposit_percentage' => '' . $row->deposit_percentage . '',
                'cheques' => '' . $row->cheques . '',
                'commission_percentage' => '' . $row->commission_percentage . '',
                'commission' => '' . $row->commission . '',
                'unit_size_price' => '' . $row->unit_size_price . '',
                'frequency' => '' . $row->frequency . '',
                'dateadded' => '' . $row->dateadded . '',
                'dateupdated' => '' . $row->dateupdated . '',
                'category_id' => '' . $row->category_id . '',
                'region_id' => '' . $row->region_id . '',
                'area_location_id' => '' . $row->area_location_id . '',
                'sub_area_location_id' => '' . $row->sub_area_location_id . '',
                'view_id' => '' . $row->view_id . '',
                'prop_furnish' => '' . $row->prop_furnish . '',
                'landlord_id' => '' . $row->landlord_id . '',
                'landlord_name' => '' . $landlord_name . '',
                'photos' => '' . $row->photos . '',
                'portals_count' => '' . $row->portals_count . '',
                'portals_name' => '' . $row->portals_name . '',
                'othermedia_count' => '' . $row->othermedia_count . '',
                'features_count' => '' . $row->features_count . '',
                'features_id' => '' . $row->features_id . '',
                'area_iformation_data' => '' . $row->area_iformation_data . '',
                'leads' => '' . $row->leads . '',
                'viewings_count' => '' . $row->viewings_count . '',
                'add_info' => '' . $row->add_info . '',
                'agent_id' => '' . $row->agent_id . '',
                'status' => '' . $row->status . '',
                'managed' => '' . $row->managed . '',
                'exclusive' => '' . $row->exclusive . '',
                'shared' => '' . $row->shared . '',
                'created_by' => '' . $row->created_by . '',
                'lat' => '' . $row->lat . '',
                'lon' => '' . $row->lon . '',
                'other_languages' => '' . $row->other_languages . '',
                'other_title_1' => '' . $row->other_title_1 . '',
                'other_description_1' => '' . $row->other_description_1 . '',
                'other_title_2' => '' . $row->other_title_2 . '',
                'other_description_2' => '' . $row->other_description_2 . '',
                'featured' => '' . $row->featured . '',
                'refreshed' => '' . $row->refreshed . '',
                'video_embed_code' => '' . $row->video_embed_code . '',
                //'360_embed_code'=> ''.$row->embed_code.'',
                'audio_embed_code' => '' . $row->audio_embed_code . '',
                'virtual_tour_embed_code' => '' . $row->virtual_tour_embed_code . '',
                'qr_code_link' => '' . $row->qr_code_link . '',
                'pdf_brochure' => '' . $row->pdf_brochure . '',
                'video_path' => '' . $row->video_path . '',
                'video_path_upload' => '' . $row->video_path_upload . '',
                'price_1' => '' . $row->price_1 . '',
                'cheques_1' => '' . $row->cheques_1 . '',
                'price_2' => '' . $row->price_2 . '',
                'cheques_2' => '' . $row->cheques_2 . '',
                'price_3' => '' . $row->price_3 . '',
                'cheques_3' => '' . $row->cheques_3 . '',
                'price_4' => '' . $row->price_4 . '',
                'cheques_4' => '' . $row->cheques_4 . '',
                'prop_status' => '' . $row->prop_status . '',
                'agent_rent_sold' => '' . $row->agent_rent_sold . '',
                'source_of_listing' => '' . $row->source_of_listing . '',
                'flcheck' => '' . $row->flcheck . '',
                'dewa_no' => '' . $row->dewa_no . '',
                'strno' => '' . $row->strno . '',
                'available_date' => '' . $row->available_date . '',
                'remind_me' => '' . $row->remind_me . '',
                'key_location' => '' . $row->key_location . '',
                'tenanted' => '' . $row->tenanted . '',
                'amount' => '' . $row->amount . '',
                'amount_date' => '' . $row->amount_date . '',
                'maintenance' => '' . $row->maintenance . '',
                'unit_size_price_2' => '' . $row->unit_size_price_2 . '',
                'notes' => $results_notes,
                'documents' => $results_docs,
                'leads_notes' => '' . $row->leads_notes . '',
                'document_name' => '' . $row->document_name . '',
                'terminal' => '' . $row->terminal . '',
                'furnished' => '' . $row->furnished . '',
                'development_unit_id' => '' . $row->development_unit_id . '',
                'leads' => '' . $leads . '',
                'quality' => $results_qty
            );
        } else {
            // None
            return 0;
        }
    }
    
    public function lookup($cat, $region_id, $loc, $subloc, $unit, $type)
    {
        return $this->db->query("select IFNULL(max(id),0) as id from crm_listings where type= '$type' and region_id = '$region_id'and area_location_id='$loc' and 

		sub_area_location_id = '$subloc' and unit = '$unit' and category_id = '$cat' and is_active=1")->row()->id;
    }
    function getUserAndAgentDetails($id)
    {
        $this->db->select('*');
        $this->db->from('crm_listings ');
        $this->datatables->join('crm_users', 'crm_users.id = crm_listings.agent_id', 'left');
        $where = "crm_listings.id=" . $id;
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            // One row, match!
            $row = $query->row();
            return array(
                'myName' => '' . $row->username . '',
                'myTitle' => '' . $row->job_title . '',
                'myMobile' => '' . $row->mobile_no_new . '',
                'myEmail' => '' . $row->email . '',
                'agentName' => '' . $row->first_name . ' ' . $row->last_name . '',
                'agentTitle' => '' . $row->job_title . '',
                'agentMobile' => '' . $row->mobile_no_new . '',
                'agentEmail' => '' . $row->email . '',
                'listingTitle' => '' . $row->name . ''
            );
        }
    }
    //this function doing exactly same as above,why i redevelop??
    function getUserDetails($id)
    {
        $this->db->select('*');
        $this->db->from('crm_listings ');
        $this->datatables->join('crm_users', 'crm_users.id = crm_listings.agent_id', 'left');
        $where = "crm_listings.id=" . $id;
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            // One row, match!
            $row = $query->row();
            return array(
                'myName' => '' . $row->username . '',
                'myTitle' => '' . $row->job_title . '',
                'myMobile' => '' . $row->mobile_no_new . '',
                'myEmail' => '' . $row->email . '',
                'agentName' => '' . $row->first_name . ' ' . $row->last_name . '',
                'agentTitle' => '' . $row->job_title . '',
                'agentMobile' => '' . $row->mobile_no_new . '',
                'agentEmail' => '' . $row->email . '',
                'listingTitle' => '' . $row->name . ''
            );
        }
    }
    function updateStatus()
    {
        $admin_ID    = $this->session->userdata('userid');
        $dateupdated = date('Y-m-d H:i:s');
        //get data
        $type        = $this->input->post('type');
        $delid       = $this->input->post('ids');
        $table       = $this->input->post('table');
        $msg         = "invalid operation";
        if ($type == 'publish') //publish these ids
            {
            $query = $this->db->query("SELECT id FROM crm_listings WHERE id IN(" . implode(",", $delid) . ")");
            foreach ($query->result_array() as $row) {
                $this->db->query("UPDATE crm_listings SET status = 2,dateupdated='$dateupdated'  WHERE id = '" . $row["id"] . "'");
            }
            $msg = "Published Sucessfully";
        }
        if ($type == 'unpublish') //publish these ids
            {
            $query = $this->db->query("SELECT id FROM crm_listings WHERE id IN(" . implode(",", $delid) . ")");
            foreach ($query->result_array() as $row) {
                $this->db->query("UPDATE crm_listings SET status = 1,dateupdated='$dateupdated'  WHERE id = '" . $row["id"] . "'");
            }
            $msg = "unpublished Sucessfully";
        }
        if (($type == 'move_to_archive') || $type == 'move_to_listings') {
            $query = $this->db->query("SELECT id FROM crm_listings WHERE id IN(" . implode(",", $delid) . ")");
            foreach ($query->result_array() as $row) {
                $this->db->query("UPDATE crm_listings SET is_archive= IF(is_archive=1, 0, 1),dateupdated='$dateupdated'  WHERE id = '" . $row["id"] . "'");
            }
            $msg = $this->input->post('message') . " Sucessfully";
        }
        if ($type == 'delete') {
            $query = $this->db->query("SELECT id FROM crm_listings WHERE id IN(" . implode(",", $delid) . ")");
            foreach ($query->result_array() as $row) {
                $this->db->query("UPDATE crm_listings SET is_active= IF(is_active=1, 0, 1),dateupdated='$dateupdated'  WHERE id = '" . $row["id"] . "'");
            }
            $msg = "Deleted Sucessfully";
        }
        //echo final message
        echo $msg;
    }
    function savesearch()
    {
        $created_by      = $this->session->userdata('userid');
        $dateadded       = date('Y-m-d H:i:s');
        //get data
        $savesearch_name = $this->input->post('name');
        $savesearch_name = $savesearch_name . "-" . $created_by . "-" . date('Y-m-d');
        $data_save       = array(
            'savesearch_name' => $savesearch_name,
            'status' => $this->input->post('1'),
            'share' => $this->input->post('4'),
            'ref' => $this->input->post('5'),
            'unit' => $this->input->post('6'),
            'category_id' => $this->input->post('7'),
            'region_id' => $this->input->post('8'),
            'location_id' => $this->input->post('9'),
            'subloc_id' => $this->input->post('10'),
            'price' => $this->input->post('13'),
            'agent' => $this->input->post('14'),
            'minprice' => $this->input->post('minprice'),
            'maxprice' => $this->input->post('maxprice'),
            'minarea' => $this->input->post('minarea'),
            'maxarea' => $this->input->post('maxarea'),
            'dateupdatedS' => $this->input->post('dateupdatedS'),
            'dateupdatedSto' => $this->input->post('dateupdatedSto'),
            'dateaddedS' => $this->input->post('dateaddedS'),
            'dateaddedSto' => $this->input->post('dateaddedSto'),
            'as_prop_status' => $this->input->post('as_prop_status'),
            'as_source_of_listing' => $this->input->post('as_source_of_listing'),
            'as_unit_type' => $this->input->post('as_unit_type'),
            'as_min_bua' => $this->input->post('as_min_bua'),
            'as_max_bua' => $this->input->post('as_max_bua'),
            'as_min_deposit' => $this->input->post('as_min_deposit'),
            'as_max_deposit' => $this->input->post('as_max_deposit'),
            'as_baths' => $this->input->post('as_baths'),
            'as_view' => $this->input->post('as_view'),
            'as_available_date_from' => $this->input->post('as_available_date_from'),
            'as_available_date_to' => $this->input->post('as_available_date_to'),
            //'as_floor_no' => $this->input->post('as_floor_no'),
            //'as_street_no' => $this->input->post('as_street_no'),
            //'as_min_uap' => $this->input->post('as_min_uap'),
            //'as_max_uap' => $this->input->post('as_max_uap'),
            //'as_min_ps' => $this->input->post('as_min_ps'),
            //'as_max_ps' => $this->input->post('as_max_ps'),
            //'name' => $this->input->post('name'),
            //'as_prop_furnish' => $this->input->post('as_prop_furnish'),
            'flcheck' => $this->input->post('flcheck'),
            'created_by' => $created_by,
            'dateadded' => $dateadded
        );
        $this->db->insert('crm_savedsearch', $data_save); // insert new record
        return $this->db->insert_id();
    }
    
    public function delete_savedsearch($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('crm_savedsearch');
    }
    function lead_single($id)
    {
        $this->db->select('id,ref');
        $this->db->from('crm_leads');
        $where = "id=" . $id;
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            // One row, match!
            $row = $query->row();
            return array(
                'lead_id' => '' . $row->id . '',
                'lead_ref' => '' . $row->ref . ''
            );
        }
    }
    
    public function save_todo()
    {
        $created_by = $this->session->userdata('userid');
        $id         = 0;
        $ret        = $this->db->query("select IFNULL(max(id),0) as id from crm_todo")->row()->id;
        $ret        = str_pad($ret, 4, '0', STR_PAD_LEFT);
        $ret        = $ret + 0001;
        $ref        = "GIS-TODO-" . $ret;
        if ($this->input->post('ref')) {
            $ref = $this->input->post('ref');
        } else {
            $ref = $ref;
        }
        if ($this->input->post('dateadded')) {
            $dateadded = $this->input->post('dateadded');
        } else {
            $dateadded = date('Y-m-d H:i:s');
        }
        $data_save = array(
            'title' => $this->input->post('title'),
            'ref' => $ref,
            'dateadded' => $dateadded,
            'priority' => ($this->input->post('priority') ? $this->input->post('priority'):0),
            'due_date' => gistler_dateformat(($this->input->post('due_date') ? $this->input->post('due_date'):date('Y-m-d')), "Y-m-d"),
            'assigned_by' => ($this->input->post('assigned_by') ? $this->input->post('assigned_by'):0),
            'notes' => $this->input->post('notes'),
            'assigned_to_id' => ($this->input->post('assigned_to_id') ? $this->input->post('assigned_to_id'):0),
            'listings_id' => ($this->input->post('listings_id') ? $this->input->post('listings_id'):0),
            'listings_ref' =>($this->input->post('listings_ref') ? $this->input->post('listings_ref'):0),
            'status' => ($this->input->post('status') ? $this->input->post('status'):0),
            'lead_id' => ($this->input->post('lead_id') ? $this->input->post('lead_id'):0),
            'lead_ref' => ($this->input->post('lead_ref') ? $this->input->post('lead_ref'):0),
            'created_by' => $created_by,
            'screenname' => ($this->input->post('screenname') ? $this->input->post('screenname'):''),
        );
        $this->db->insert('crm_todo', $data_save); // insert new record
        if ($this->input->post('screenname')) {
            return "Saved sucessfully!";
        }
        echo "Saved sucessfully!";
    }
    
    public function deletedocument($id)
    {
        $admin_ID = $this->session->userdata('userid');
        $data     = array(
            'is_active' => 0,
            'created_by' => $admin_ID
        );
        $this->db->where('document_name', $id);
        return $this->db->update('crm_listings_documents', $data);
    }
    
    public function updateFeilds()
    {

        $updated_by      = $this->session->userdata('userid');
        $fieldName       = $this->input->post('field_name_bulk');
        $bulk_update_ids = $this->input->post('bulk_update_ids');
        $bulk_update_ids = explode(',', trim($bulk_update_ids, ','));
        $data            = array(
            array(
                'id' => $bulk_update_ids[0],
                '' . $fieldName . '' => $this->input->post('' . $fieldName . '_f'),
                'updated_by' => $updated_by
            ),
            array(
                'id' => $bulk_update_ids[1],
                '' . $fieldName . '' => $this->input->post('' . $fieldName . '_f'),
                'updated_by' => $updated_by
            )
        );

       // print_r($data);exit;
        //note: crm_listings has triggers which create issue while update few records. so delete tirggers
       
        return $this->db->update_batch('crm_listings', $data, 'id');

    }
    
    public function single_priceindex($id, $type)
    {
        $this->db->select('*');
        $this->db->from('crm_listings');
        $where = "id=" . $id;
        $this->db->where($where);
        $query = $this->db->get();
        //{"id":"1033506","week_num":"47","year":"2015","date":"2015-11-16","stid":"1","locid":"12","snum_id":"0"
        //,"cid":"2","beds":"6.0","listings_count":"44","raw_avg":"384614","raw_std":"118632","raw_low":"266000"
        //,"raw_high":"503000","final_avg":"345718","final_std":"42322","final_low":"303,000","final_high":"388
        //,000","final_low_loc":0,"final_high_loc":0}
        if ($query->num_rows() == 1) {
            // One row, match!
            $row   = $query->row();

            // get low and high values
            $this->db->select_max('price');
            $this->db->where('area_location_id', $row->area_location_id);
            $res1 = $this->db->get('crm_listings');
            $row1   = $res1->row();
            $max_price = $row1->price;
            //----------------------------
            $this->db->select_min('price');
            $this->db->where('area_location_id', $row->area_location_id);
            $res1 = $this->db->get('crm_listings');
            $row1   = $res1->row();
            $min_price = $row1->price;
            //for sublocation
            if($row->sub_area_location_id)
            {
                  // get low and high values
            $this->db->select_max('price');
            $this->db->where('sub_area_location_id', $row->sub_area_location_id);
            $res1 = $this->db->get('crm_listings');
            $row1   = $res1->row();
            $final_high = $row1->price;
            //----------------------------
            $this->db->select_min('price');
            $this->db->where('sub_area_location_id', $row->sub_area_location_id);
           
            $res1 = $this->db->get('crm_listings');
            $row1   = $res1->row();
            $final_low = $row1->price;
            }else{
                $final_low = $min_price;
                $final_high = $max_price;
            }

            //get data first
            $ddate = getGistlerDate('Y-m-d', $row->dateadded);
            $date  = new DateTime($ddate);
            $week  = $date->format("W");
            return array(
                'id' => '' . $row->id . '',
                'week_num' => '' . $week . '',
                'year' => '' . getGistlerYear($row->dateadded) . '',
                'date' => '' . getGistlerDate('Y-m-d', $row->dateadded) . '',
                'stid' => '' . $row->region_id . '',
                'locid' => '' . $row->area_location_id . '',
                'snum_id' => '' . $row->sub_area_location_id . '',
                'cid' => '' . $row->category_id . '',
                'beds' => '' . $row->beds . '',
                'listings_count' => '100',
                'raw_avg' => '200',
                'raw_std' => '300',
                'raw_low' => '400',
                'final_low_loc' => $min_price,
                'final_high_loc' => $max_price,
                'raw_high' => '700',
                'final_avg' => '800',
                'final_std' => '900',
                'final_low' => $final_low,
                'final_high' => $final_high
            );
        } else {
            // None
            return 0;
        }
    }
    
    public function datatable_price_index($type)
    {
        if ($type == "rentals") {
            $type = 1;
        } elseif ($type == "sales") {
            $type = 2;
        } else {
            $type = $type;
        }
        $c = 'crm_listings.id as id,crm_city.name as stid,crm_location.loc_name as locid,crm_subloc.sub_sub_loc as snum_id,crm_category.category as cid,crm_listings.beds as beds,

				crm_listings.price as price_index';
        $this->datatables->select($c)->unset_column('id') //this means if you want to include in columns or search
            ->from('crm_listings');
        $this->datatables->join('crm_category', 'crm_listings.category_id = crm_category.id', 'left');
        $this->datatables->join('crm_city', 'crm_city.id = crm_listings.region_id', 'left');
        $this->datatables->join('crm_location', 'crm_location.loc_id = crm_listings.area_location_id', 'left');
        $this->datatables->join('crm_subloc', 'crm_subloc.sub_loc_id = crm_listings.sub_area_location_id', 'left');
        $this->datatables->where('crm_listings.is_active', 1);
        $this->datatables->where('crm_listings.type', $type);
        return $this->datatables->generate();
    }
    
    public function agent_performance()
    {
        //$query = $this->db->query("SELECT agent_id, count(id) as cnt,sum(overall_score) as allscore FROM `crm_listings` group by agent_id");
        $this->db->select("CONCAT(crm_users.first_name,' ', crm_users.last_name) as agent, count(l.id) as cnt,sum(l.overall_score) as allscore");
        $this->db->from("crm_listings l");
        $this->db->join('crm_users', 'crm_users.id = l.agent_id');
        $this->db->group_by("agent_id");
        //echo $this->db->get_compiled_select();exit;
        $query = $this->db->get();
        return $query->result_array();
    }
}