<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/* Author: Shafiq

* Description: dashboard model class

*/
class Dashboard_model extends CI_Model
{
	
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    //***********************************Listing******************************//
    //********* get new listings ******//
    
    function get_listing_overview()
    {
        $results  = array();
        $adm_type = $this->session->userdata('adm_type');
        $admin_ID = $this->session->userdata('userid');
        //============================= LIVE LISTINGS =============================================//
        if ($adm_type == 3) {
            $q         = "select @table1:=( select count(id) as tot_live from crm_listings where agent_id=" . $admin_ID . " AND status = 2 and 

		is_active=1 and is_archive=0 and type=1) as rentals,@table2:=(select count(id) as tot_live from crm_listings where agent_id=" . $admin_ID . " 

		AND status = 2 and is_active=1 and is_archive=0 and type=2) as sales, (@table1 +@table2) as tot_live";
            $query     = $this->db->query($q);
            $row       = $query->row();
            $tot_live  = $row->tot_live;
            $tot_rent1 = $row->rentals;
            $tot_sale1 = $row->sales;
        } else {
            $q         = "select @table1:=( select count(id) as tot_live from crm_listings where status = 2 and is_active=1 and is_archive=0 and type=1) as rentals,

             @table2:=(select count(id) as tot_live from crm_listings where status = 2 and is_active=1 and is_archive=0 and type=2) as sales, 

            (@table1 +@table2) as tot_live";
            $query     = $this->db->query($q);
            $row       = $query->row();
            $tot_live  = $row->tot_live;
            $tot_rent1 = $row->rentals;
            $tot_sale1 = $row->sales;
        }
        //=========================== PENDING LISTINGS ===============================//
        if ($adm_type == 3) {
            $q           = "select @table1_pen:=( select count(id) as tot_pend from crm_listings where agent_id=" . $admin_ID . " AND status = 3 and is_active=1 and is_archive=0 and type=1)

			  as pen_rentals,

             @table2_pen:=(select count(id) as tot_pend from crm_listings where agent_id=" . $admin_ID . " AND status = 3 and is_active=1 and is_archive=0 and type=2) as pen_sales, 

            (@table1_pen +@table2_pen) as tot_pend";
            $query       = $this->db->query($q);
            $row         = $query->row();
            $tot_pend    = $row->tot_pend;
            $pen_rentals = $row->pen_rentals;
            $pen_sales   = $row->pen_sales;
        } else {
            $q           = "select @table1_pen:=( select count(id) as tot_pend from crm_listings where status = 3 and is_active=1 and is_archive=0 and type=1) as pen_rentals,

             @table2_pen:=(select count(id) as tot_pend from crm_listings where status = 3 and is_active=1 and is_archive=0 and type=2) as pen_sales, 

            (@table1_pen +@table2_pen) as tot_pend";
            $query       = $this->db->query($q);
            $row         = $query->row();
            $tot_pend    = $row->tot_pend;
            $pen_rentals = $row->pen_rentals;
            $pen_sales   = $row->pen_sales;
        }
        //================ LISTINGS EXPIRING IN NEXT 15-30 DAYS ======================//
        if ($adm_type == 3) {
            $q            = "select @table1_expg:=( select count(id) as tot_expg from crm_listings where dateupdated < DATE_SUB(CURRENT_DATE, INTERVAL 15 DAY) 

			 and agent_id=" . $admin_ID . " AND status = 1 and is_active=1 and is_archive=0 and type=1) as expg_rentals,

             @table2_expg:=(select count(id) as tot_expg from crm_listings where dateupdated < DATE_SUB(CURRENT_DATE, INTERVAL 30 DAY) and agent_id=" . $admin_ID . "

			 AND status = 1 and is_active=1 and is_archive=0 and type=2) as expg_sales,(@table1_expg +@table2_expg) as tot_expg";
            $query        = $this->db->query($q);
            $row          = $query->row();
            $tot_expg     = $row->tot_expg;
            $expg_rentals = $row->expg_rentals;
            $expg_sales   = $row->expg_sales;
        } else {
            $q            = "select @table1_expg:=( select count(id) as tot_expg from crm_listings where dateupdated < DATE_SUB(CURRENT_DATE, INTERVAL 15 DAY) and status = 1 

			and is_active=1 and is_archive=0 and type=1) as expg_rentals,

             @table2_expg:=(select count(id) as tot_expg from crm_listings where dateupdated < DATE_SUB(CURRENT_DATE, INTERVAL 30 DAY) and status = 1 

			 and is_active=1 and is_archive=0 and type=2) as expg_sales,(@table1_expg +@table2_expg) as tot_expg";
            $query        = $this->db->query($q);
            $row          = $query->row();
            $tot_expg     = $row->tot_expg;
            $expg_rentals = $row->expg_rentals;
            $expg_sales   = $row->expg_sales;
        }
        //===============listings with less than ten photos===============================//
        if ($adm_type == 3) {
            $q         = "select @table1_pic:=( select count(id) as t from crm_listings where status = 2 and is_active=1 and is_archive=0 and photos<10 

			 AND agent_id=" . $admin_ID . " and type=1) as rent_pics,@table2_pic:=( select count(id) as t from crm_listings where status = 2 and is_active=1 and 

			 is_archive=0 and photos<10 AND agent_id=" . $admin_ID . " and type=2) as sale_pics,(@table1_pic +@table2_pic) as tot_img";
            $query     = $this->db->query($q);
            $row       = $query->row();
            $tot_img   = $row->tot_img;
            $rent_pics = $row->rent_pics;
            $sale_pics = $row->sale_pics;
        } else {
            $q         = "select @table1_pic:=( select count(id) as t from crm_listings where status = 2 and is_active=1 and is_archive=0 and photos<10 and type=1) as rent_pics,

             @table2_pic:=( select count(id) as t from crm_listings where status = 2 and is_active=1 and is_archive=0 and photos<10 and type=2) as sale_pics, 

           (@table1_pic +@table2_pic) as tot_img";
            $query     = $this->db->query($q);
            $row       = $query->row();
            $tot_img   = $row->tot_img;
            $rent_pics = $row->rent_pics;
            $sale_pics = $row->sale_pics;
        }
        //================ LISTINGS EXPIRED IN LAST 15-30 DAYS ======================//
        if ($adm_type == 3) {
            $q            = "select @table1_expd:=( select count(id) as tot_expd from crm_listings where date(dateUpdated) = CURDATE() - INTERVAL 15 DAY 

			 and agent_id=" . $admin_ID . " AND status = 1 and is_active=1 and is_archive=0 and type=1) as expd_rentals,

             @table2_expd:=(select count(id) as tot_expd from crm_listings where date(dateUpdated) = CURDATE() - INTERVAL 30 DAY and agent_id=" . $admin_ID . " 

			 AND status = 1 and is_active=1 and is_archive=0 and type=1) as expd_sales, 

            (@table1_expd +@table2_expd) as tot_expd";
            $query        = $this->db->query($q);
            $row          = $query->row();
            $tot_expd     = $row->tot_expd;
            $expd_rentals = $row->expd_rentals;
            $expd_sales   = $row->expd_sales;
        } else {
            $q            = "select @table1_expd:=( select count(id) as tot_expd from crm_listings where date(dateUpdated) = CURDATE() - INTERVAL 15 DAY 

				 and status = 1 and is_active=1 and is_archive=0 and type=1) as expd_rentals,

             @table2_expd:=(select count(id) as tot_expd from crm_listings where date(dateUpdated) = CURDATE() - INTERVAL 30 DAY 

			 and status = 1 and is_active=1 and is_archive=0 and type=2) as expd_sales, 

            (@table1_expd +@table2_expd) as tot_expd";
            $query        = $this->db->query($q);
            $row          = $query->row();
            $tot_expd     = $row->tot_expd;
            $expd_rentals = $row->expd_rentals;
            $expd_sales   = $row->expd_sales;
        }
        $results[] = array(
            'tot_live' => $tot_live, //live listings
            'tot_rent1' => $tot_rent1,
            'tot_sale1' => $tot_sale1,
            'tot_pend' => $tot_pend, //pending listings
            'pen_rentals' => $pen_rentals,
            'pen_sales' => $pen_sales,
            'tot_img' => $tot_img, //listings with less than 10 photos
            'rent_pics' => $rent_pics,
            'sale_pics' => $sale_pics,
            'tot_expd' => $tot_expd, //expired listings
            'expd_rentals' => $expd_rentals,
            'expd_sales' => $expd_sales,
            'tot_expg' => $tot_expg, //expiring listings
            'expg_rentals' => $expg_rentals,
            'expg_sales' => $expg_sales
        );
        return $results;
    }
    
    function get_leads_overview()
    {
        $results  = array();
        $adm_type = $this->session->userdata('adm_type');
        $admin_ID = $this->session->userdata('userid');
        //========================total open leads=================================//
        if ($adm_type == 3) {
            $q                = "select @table1:=( select count(id) as open_ld from crm_leads where status = 1 and agent_id= " . $admin_ID . " AND type IN(1,3)) as rentals,

             @table2:=(select count(id) as open_ld from crm_leads where status = 1 and agent_id= " . $admin_ID . " AND type IN(2,4) ) as sales, 

            (@table1 +@table2) as open_ld";
            $query            = $this->db->query($q);
            $row              = $query->row();
            $open_ld          = $row->open_ld;
            $open_ld_r        = $row->rentals;
            $open_ld_s        = $row->sales;
            //========================total closed leads=================================//
            $q                = "select @table1:=( select count(id) as closed_ld from crm_leads where status = 2 and agent_id= " . $admin_ID . " AND type IN(1,3,5,6)) as rentals,

             @table2:=(select count(id) as closed_ld from crm_leads where status = 2 and agent_id= " . $admin_ID . " AND type IN(2,4,5,6) ) as sales, 

            (@table1 +@table2) as closed_ld";
            $query            = $this->db->query($q);
            $row              = $query->row();
            $closed_ld        = $row->closed_ld;
            $closed_ld_r      = $row->rentals;
            $closed_ld_s      = $row->sales;
            //=========================leads sucessfull=====//
            $q                = "select @table1:=( SELECT count(id) as successfull_ld FROM crm_leads

		WHERE sub_status=2 and type IN(1,3,5,6) and agent_id= " . $admin_ID . ") as rentals,

             @table2:=(SELECT count(id) as successfull_ld FROM crm_leads

		WHERE sub_status=2 and type IN(2,4,5,6) and agent_id= " . $admin_ID . " ) as sales, 

            (@table1 +@table2) as successfull_ld";
            $query            = $this->db->query($q);
            $row              = $query->row();
            $successfull_ld   = $row->successfull_ld;
            $successfull_ld_r = $row->rentals;
            $successfull_ld_s = $row->sales;
            //===============================received in previous month//
            $q                = "select @table1:=( SELECT count(id) as lst_month_ld FROM crm_leads

		WHERE YEAR(date_of_enquiry) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)

		AND MONTH(date_of_enquiry) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) and agent_id= " . $admin_ID . " AND type IN(1,3,5,6)) as rentals,

             @table2:=(SELECT count(id) as lst_month_ld FROM crm_leads

		WHERE YEAR(date_of_enquiry) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)

		AND MONTH(date_of_enquiry) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) and agent_id= " . $admin_ID . "  AND type IN(2,4,5,6) ) as sales, 

            (@table1 +@table2) as lst_month_ld";
            $query            = $this->db->query($q);
            $row              = $query->row();
            $lst_month_ld     = $row->lst_month_ld;
            $lst_month_ld_r   = $row->rentals;
            $lst_month_ld_s   = $row->sales;
            //===============================received in one week//
            $q                = "select @table1:=(SELECT count(id) as lst_one_week FROM crm_leads

		WHERE date_of_enquiry > DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK) and agent_id= " . $admin_ID . " AND type IN(1,3,5,6)) as rentals,

             @table2:=(SELECT count(id) as lst_one_week FROM crm_leads

		WHERE date_of_enquiry > DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK) and agent_id= " . $admin_ID . "  AND type IN(2,4,5,6) ) as sales, 

            (@table1 +@table2) as lst_one_week";
            $query            = $this->db->query($q);
            $row              = $query->row();
            $lst_one_week     = $row->lst_one_week;
            $lst_one_week_r   = $row->rentals;
            $lst_one_week_s   = $row->sales;
            //===============================received in 24 hours//
            $q                = "select @table1:=( SELECT count(id) as twinty_four FROM crm_leads

		WHERE date_of_enquiry > DATE_SUB(CURRENT_DATE, INTERVAL 1 DAY) and agent_id= " . $admin_ID . " AND type IN(1,3,5,6)) as rentals,

             @table2:=(SELECT count(id) as twinty_four FROM crm_leads

		WHERE date_of_enquiry > DATE_SUB(CURRENT_DATE, INTERVAL 1 DAY) and agent_id= " . $admin_ID . "  AND type IN(2,4,5,6) ) as sales, 

            (@table1 +@table2) as twinty_four";
            $query            = $this->db->query($q);
            $row              = $query->row();
            $twinty_four      = $row->twinty_four;
            $twinty_four_r    = $row->rentals;
            $twinty_four_s    = $row->sales;
        } else {
            //========================total open leads=================================//
            $q                = "select @table1:=( select count(id) as open_ld from crm_leads where status = 1 AND type IN(1,3,5,6)) as rentals,

             @table2:=(select count(id) as open_ld from crm_leads where status = 1  AND type IN(2,4,5,6) ) as sales, 

            (@table1 +@table2) as open_ld";
            $query            = $this->db->query($q);
            $row              = $query->row();
            $open_ld          = $row->open_ld;
            $open_ld_r        = $row->rentals;
            $open_ld_s        = $row->sales;
            //========================total closed leads=================================//
            $q                = "select @table1:=( select count(id) as closed_ld from crm_leads where status = 2 AND type IN(1,3,5,6)) as rentals,

             @table2:=(select count(id) as closed_ld from crm_leads where status = 2  AND type IN(2,4,5,6) ) as sales, 

            (@table1 +@table2) as closed_ld";
            $query            = $this->db->query($q);
            $row              = $query->row();
            $closed_ld        = $row->closed_ld;
            $closed_ld_r      = $row->rentals;
            $closed_ld_s      = $row->sales;
            //=========================successfull leads ===========//
            $q                = "select @table1:=( SELECT count(id) as successfull_ld FROM crm_leads

		WHERE sub_status=2 and type IN(1,3,5,6)) as rentals,

             @table2:=(SELECT count(id) as successfull_ld FROM crm_leads

		WHERE sub_status=2 and type IN(2,4,5,6) ) as sales, 

            (@table1 +@table2) as successfull_ld";
            $query            = $this->db->query($q);
            $row              = $query->row();
            $successfull_ld   = $row->successfull_ld;
            $successfull_ld_r = $row->rentals;
            $successfull_ld_s = $row->sales;
            //===============================received in previous month//
            $q                = "select @table1:=( SELECT count(id) as lst_month_ld FROM crm_leads

		WHERE YEAR(date_of_enquiry) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)

		AND MONTH(date_of_enquiry) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) AND type IN(1,3,5,6)) as rentals,

             @table2:=(SELECT count(id) as lst_month_ld FROM crm_leads

		WHERE YEAR(date_of_enquiry) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)

		AND MONTH(date_of_enquiry) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)  AND type IN(2,4,5,6) ) as sales, 

            (@table1 +@table2) as lst_month_ld";
            $query            = $this->db->query($q);
            $row              = $query->row();
            $lst_month_ld     = $row->lst_month_ld;
            $lst_month_ld_r   = $row->rentals;
            $lst_month_ld_s   = $row->sales;
            //===============================received in one week//
            $q                = "select @table1:=(SELECT count(id) as lst_one_week FROM crm_leads

		WHERE date_of_enquiry > DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK) AND type IN(1,3,5,6)) as rentals,

             @table2:=(SELECT count(id) as lst_one_week FROM crm_leads

		WHERE date_of_enquiry > DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)  AND type IN(2,4,5,6) ) as sales, 

            (@table1 +@table2) as lst_one_week";
            $query            = $this->db->query($q);
            $row              = $query->row();
            $lst_one_week     = $row->lst_one_week;
            $lst_one_week_r   = $row->rentals;
            $lst_one_week_s   = $row->sales;
            //===============================received in 24 hours//
            $q                = "select @table1:=( SELECT count(id) as twinty_four FROM crm_leads

		WHERE date_of_enquiry > DATE_SUB(CURRENT_DATE, INTERVAL 1 DAY) AND type IN(1,3,5,6)) as rentals,

             @table2:=(SELECT count(id) as twinty_four FROM crm_leads

		WHERE date_of_enquiry > DATE_SUB(CURRENT_DATE, INTERVAL 1 DAY)  AND type IN(2,4,5,6) ) as sales, 

            (@table1 +@table2) as twinty_four";
            $query            = $this->db->query($q);
            $row              = $query->row();
            $twinty_four      = $row->twinty_four;
            $twinty_four_r    = $row->rentals;
            $twinty_four_s    = $row->sales;
        }
        $results[] = array(
            'twinty_four' => $twinty_four,
            'twinty_four_r' => $twinty_four_r,
            'twinty_four_s' => $twinty_four_s,
            'lst_one_week' => $lst_one_week,
            'lst_one_week_s' => $lst_one_week_s,
            'lst_one_week_r' => $lst_one_week_r,
            'lst_month_ld' => $lst_month_ld,
            'lst_month_ld_r' => $lst_month_ld_r,
            'lst_month_ld_s' => $lst_month_ld_s,
            'successfull_ld' => $successfull_ld,
            'successfull_ld_r' => $successfull_ld_r,
            'successfull_ld_s' => $successfull_ld_s,
            'closed_ld' => $closed_ld,
            'closed_ld_r' => $closed_ld_r,
            'closed_ld_s' => $closed_ld_s,
            'open_ld' => $open_ld,
            'open_ld_r' => $open_ld_r,
            'open_ld_s' => $open_ld_s
        );
        return $results;
    }
    
    function get_mydeals_overview()
    {
        $results  = array();
        $adm_type = $this->session->userdata('adm_type');
        $admin_ID = $this->session->userdata('userid');
        //========================Deals=================================//
        if ($adm_type == 3) {
            //==================total deals completed by this agent===============//
            $q             = "select @table1:=( select count(id) as completed from crm_deals where status=2 and sub_status=2 AND type=1  AND agent_1_id = " . $admin_ID . ") as rentals,

             @table2:=(select count(id) as completed from crm_deals where status=2 and sub_status=2  AND type=2  AND agent_1_id = " . $admin_ID . ") as sales, 

            (@table1 +@table2) as completed";
            $query         = $this->db->query($q);
            $row           = $query->row();
            $tot_completed = $row->completed;
            $tot_ren_cmp   = $row->rentals;
            $tot_sale_cmp  = $row->sales;
            //total pending/inprogress deals for this agent==========================================================//
            $q             = "select @table1:=( select count(id) as completed from crm_deals where status=1  AND type=1 AND agent_1_id = " . $admin_ID . ") as rentals,

             @table2:=(select count(id) as completed from crm_deals where status=1  AND type=2 AND agent_1_id = " . $admin_ID . " ) as sales, 

            (@table1 +@table2) as inprogress";
            $query         = $this->db->query($q);
            $row           = $query->row();
            $tot_progress  = $row->inprogress;
            $tot_ren_p     = $row->rentals;
            $tot_sale_p    = $row->sales;
            //===========================completed in one month/30 days for this agent=================================//
            $q             = "select @table1:=(SELECT count(id) as lst_deal FROM crm_deals

		WHERE YEAR(deal_estimated_date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)

		AND MONTH(deal_estimated_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)

		AND status=2  AND type=1 AND agent_1_id = " . $admin_ID . ") as rentals,

             @table2:=(SELECT count(id) as lst_deal FROM crm_deals

		WHERE YEAR(deal_estimated_date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)

		AND MONTH(deal_estimated_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)

		AND status=2  AND type=2 AND agent_1_id = " . $admin_ID . " ) as sales, 

            (@table1 +@table2) as lst_deal";
            $query         = $this->db->query($q);
            $row           = $query->row();
            $lst_deal      = $row->lst_deal;
            $lst_ren       = $row->rentals;
            $lst_sale      = $row->sales;
            //==================completed in 2014 for agent==================//
            $q             = "select @table1:=(SELECT count(id) as year_to_end FROM crm_deals

		WHERE YEAR(deal_estimated_date) = YEAR(Now())

		AND status=2  AND type=1 AND agent_1_id = " . $admin_ID . ") as rentals,

             @table2:=(SELECT count(id) as year_to_end FROM crm_deals

		WHERE YEAR(deal_estimated_date) = YEAR(Now())

		AND status=2  AND type=2 AND agent_1_id = " . $admin_ID . ") as sales, 

            (@table1 +@table2) as year_to_end";
            $query         = $this->db->query($q);
            $row           = $query->row();
            $year_to_end   = $row->year_to_end;
            $year_to_endr  = $row->rentals;
            $year_to_ends  = $row->sales;
        } else { //admin area
            //total deals completed
            $q             = "select @table1:=( select count(id) as completed from crm_deals where status=2 and sub_status=2 AND type=1) as rentals,

             @table2:=(select count(id) as completed from crm_deals where status=2 and sub_status=2  AND type=2 ) as sales, 

            (@table1 +@table2) as completed";
            $query         = $this->db->query($q);
            $row           = $query->row();
            $tot_completed = $row->completed;
            $tot_ren_cmp   = $row->rentals;
            $tot_sale_cmp  = $row->sales;
            //total pending or inprogress==========================================================//
            $q             = "select @table1:=( select count(id) as completed from crm_deals where status=1  AND type=1) as rentals,

             @table2:=(select count(id) as completed from crm_deals where status=1  AND type=2 ) as sales, 

            (@table1 +@table2) as inprogress";
            $query         = $this->db->query($q);
            $row           = $query->row();
            $tot_progress  = $row->inprogress;
            $tot_ren_p     = $row->rentals;
            $tot_sale_p    = $row->sales;
            //===========================completed in one month/30 days=================================//
            $q             = "select @table1:=(SELECT count(id) as lst_deal FROM crm_deals

		WHERE YEAR(deal_estimated_date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)

		AND MONTH(deal_estimated_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)

		AND status=2  AND type=1) as rentals,

             @table2:=(SELECT count(id) as lst_deal FROM crm_deals

		WHERE YEAR(deal_estimated_date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)

		AND MONTH(deal_estimated_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)

		AND status=2  AND type=2 ) as sales, 

            (@table1 +@table2) as lst_deal";
            $query         = $this->db->query($q);
            $row           = $query->row();
            $lst_deal      = $row->lst_deal;
            $lst_ren       = $row->rentals;
            $lst_sale      = $row->sales;
            //==================Year to end deals==================//
            $q             = "select @table1:=(SELECT count(id) as year_to_end FROM crm_deals

		WHERE YEAR(deal_estimated_date) = YEAR(Now())

		AND status=2  AND type=1) as rentals,

             @table2:=(SELECT count(id) as year_to_end FROM crm_deals

		WHERE YEAR(deal_estimated_date) = YEAR(Now())

		AND status=2  AND type=2 ) as sales, 

            (@table1 +@table2) as year_to_end";
            //echo $q;exit;
            $query         = $this->db->query($q);
            $row           = $query->row();
            $year_to_end   = $row->year_to_end;
            $year_to_endr  = $row->rentals;
            $year_to_ends  = $row->sales;
        }
        $results[] = array(
            'tot_completed' => $tot_completed,
            'tot_ren_cmp' => $tot_ren_cmp,
            'tot_sale_cmp' => $tot_sale_cmp,
            'tot_progress' => $tot_progress,
            'tot_ren_p' => $tot_ren_p,
            'tot_sale_p' => $tot_sale_p,
            'lst_deal' => $lst_deal,
            'lst_ren' => $lst_ren,
            'lst_sale' => $lst_sale,
            'year_to_end' => $year_to_end,
            'year_to_endr' => $year_to_endr,
            'year_to_ends' => $year_to_ends
        );
        return $results;
    }
    //************************users listings**************//
    
    function get_users_listings_overview()
    {
        $adm_type = $this->session->userdata('adm_type');
        $admin_ID = $this->session->userdata('userid');
        if ($adm_type == 3) {
            $query = $this->db->query("select count(id) as listings,type from crm_listings where agent_id=" . $admin_ID . " and status=2 and is_active=1 and is_archive=0 group by type");
            $query = $this->db->get();
            $rows  = $query->result();
            $data  = array();
            foreach ($rows as $key => $row) {
                if ($row->type == 1) {
                    $rentals = $row->listings;
                } else {
                    $sales = $row->listings;
                }
            }
            $results[] = array(
                'rentals' => $rentals,
                'sales' => $sales
            );
            return $results;
        } else {
            $this->db->select("count(l.id) as listings,CONCAT(u.first_name, '', u.last_name) as agent");
            $this->db->from("crm_listings l");
            $this->db->join('crm_users u', 'u.id = l.agent_id', 'left');
            $where = "l.is_active=1 and l.status=2 and l.is_archive=0 ";
            $this->db->where($where);
            $this->db->group_by('l.agent_id');
            $query = $this->db->get();
            return $query->result_array();
        }
    }
    //******************end users listings****************//
    //******************************portals******************//
    
    function get_portals_overview()
    {
        //$results = array();
        $adm_type = $this->session->userdata('adm_type');
        $admin_ID = $this->session->userdata('userid');
        //============================= LIVE LISTINGS =============================================//
        if ($adm_type == 3) {
            $q              = "select ((select count(id) as dubizzle from crm_listings where agent_id=" . $admin_ID . " and portals_name like '%dubizzle%') + (select count(id) as dubizzle from crm_listings where agent_id=" . $admin_ID . " and portals_name like '%dubizzle%') ) as dubizzle";
            $query          = $this->db->query($q);
            $row            = $query->row();
            $dubizzle       = $row->dubizzle;
            $q              = "select ((select count(id) as propertyfinder from crm_listings where agent_id=" . $admin_ID . " and portals_name like '%propertyfinder%') + (select count(id) as propertyfinder from crm_listings where agent_id=" . $admin_ID . " and portals_name like '%propertyfinder%') ) as propertyfinder";
            $query          = $this->db->query($q);
            $row            = $query->row();
            $propertyfinder = $row->propertyfinder;
            $q              = "select ((select count(id) as JustRentals from crm_listings where agent_id=" . $admin_ID . " and portals_name like '%JustRentals%') + (select count(id) as JustRentals from crm_listings where agent_id=" . $admin_ID . " and portals_name like '%JustRentals%') ) as JustRentals";
            $query          = $this->db->query($q);
            $row            = $query->row();
            $JustRentals    = $row->JustRentals;
            $q              = "select ((select count(id) as JustProperty from crm_listings where agent_id=" . $admin_ID . " and portals_name like '%JustProperty%') + (select count(id) as JustProperty from crm_listings where agent_id=" . $admin_ID . " and portals_name like '%JustProperty%') ) as JustProperty";
            $query          = $this->db->query($q);
            $row            = $query->row();
            $JustProperty   = $row->JustProperty;
        } else {
              $q              = "select ((select count(id) as dubizzle from crm_listings where agent_id=" . $admin_ID . " and portals_name like '%dubizzle%') + (select count(id) as dubizzle from crm_listings where agent_id=" . $admin_ID . " and portals_name like '%dubizzle%') ) as dubizzle";
            $query          = $this->db->query($q);
            $row            = $query->row();
            $dubizzle       = $row->dubizzle;
            $q              = "select ((select count(id) as propertyfinder from crm_listings where is_active=1 and is_archive=0 and status=2 and  portals_name like '%propertyfinder%') + (select count(id) as propertyfinder from crm_listings where is_active=1 and is_archive=0 and status=2 and  portals_name like '%propertyfinder%') ) as propertyfinder";
            $query          = $this->db->query($q);
            $row            = $query->row();
            $propertyfinder = $row->propertyfinder;
            $q              = "select ((select count(id) as JustRentals from crm_listings where is_active=1 and is_archive=0 and status=2 and  portals_name like '%JustRentals%') + (select count(id) as JustRentals from crm_listings where is_active=1 and is_archive=0 and status=2 and  portals_name like '%JustRentals%') ) as JustRentals";
            $query          = $this->db->query($q);
            $row            = $query->row();
            $JustRentals    = $row->JustRentals;
            $q              = "select ((select count(id) as JustProperty from crm_listings where is_active=1 and is_archive=0 and status=2 and  portals_name like '%JustProperty%') + (select count(id) as JustProperty from crm_listings where is_active=1 and is_archive=0 and status=2 and  portals_name like '%JustProperty%') ) as JustProperty";
            $query          = $this->db->query($q);
            $row            = $query->row();
            $JustProperty   = $row->JustProperty;
        }
        $results = array(
            'propertyfinder' => $propertyfinder,
           
            'dubizzle' => $dubizzle,
            'JustRentals' => $JustRentals,
            'JustProperty' => $JustProperty
        );
        return $results;
    }
    //******************************contacts******************//
    
    function get_contacts_overview()
    {
        $results  = array();
        $adm_type = $this->session->userdata('adm_type');
        $admin_ID = $this->session->userdata('userid');
        //============================= LIVE LISTINGS =============================================//
        if ($adm_type == 3) {
            $this->db->select("count(id) as cnt_all,contact_type");
            $this->db->from('crm_owners');
            $where = "contact_type != '' and assigned_to_id= " . $admin_ID . " group by contact_type";
        } else {
            $this->db->select("count(id) as cnt_all,contact_type");
            $this->db->from('crm_owners');
            $where = "contact_type != '' group by contact_type";
        }
        $this->db->where($where);
        //echo $this->db->get_compiled_select();exit;
        $query = $this->db->get();
        return $query->result_array();
    }
    //******************************contacts******************//
    
    function get_allusers()
    {
        $results  = array();
        $adm_type = $this->session->userdata('adm_type');
        $admin_ID = $this->session->userdata('userid');
        $this->db->select("u.*,sum(d.commission) as 'commission'");
        $this->db->from('crm_users u');
        $this->db->join('crm_deals as d', 'u.id = d.agent_id', 'left');
        $where = "u.is_active=1 and u.status=1";
        $this->db->where($where);
        

        // Dev note 06132016 I commented thse lines of code for the time being because there is no data for deals.
        // $this->db->where('d.is_active', 1);
     //    $where = " YEAR(d.deal_date) = YEAR(NOW())
					// AND MONTH(d.deal_date) = MONTH(NOW())";
     //    $this->db->where($where);
        $this->db->group_by("agent_id");
        //$this->db->group_by(array("deal_date", "agent_id")); 
        // echo $this->db->get_compiled_select();exit;
        $query = $this->db->get();
        // echo var_dump($query->result_array());exit;
        return $query->result_array();
    }
    
    function get_company_users()
    {
        //$results = array();
        $adm_type = $this->session->userdata('adm_type');
        $admin_ID = $this->session->userdata('userid');
        //============================= company users =============================================//
        // if ($adm_type == 3) {
        // } else {
            $q     = "select

						  u.id,u.first_name,u.last_name,u.photo_agent,u.client_id,

						  s.salecount,

						  r.rentcount

						 

						from

						  crm_users u

						  left join (

							select 

							   agent_id,

							  count(*) as rentcount

							from crm_listings

							group by agent_id

						  ) r ON r.agent_id = u.id 

						  left join (

							select

							  agent_id,

							  count(*) as salecount

							from crm_listings 

							group by agent_id

						  ) s ON s.agent_id = u.id  where is_active=1 and `status`=1";
            $query = $this->db->query($q);
            return $query->result_array();
       // }
    }
    
    function get_agent_details($agentid)
    {
        $results             = array();
        $adm_type            = $this->session->userdata('adm_type');
        $admin_ID            = $this->session->userdata('userid');
        //============================= LIVE LISTINGS =============================================//
        $q                   = "SELECT username,email,mobile_no_new,rera,photo_agent,agent_target FROM crm_users WHERE id = " . $agentid;
        $query               = $this->db->query($q);
        $row                 = $query->row();
        $username            = $row->username;
        $email               = $row->email;
        $mobile_no_new       = $row->mobile_no_new;
        $rera                = $row->rera;
        $photo_agent         = $row->photo_agent;
        $agent_target        = $row->agent_target;
        //get this agent commision
        $q2                  = "SELECT sum(commission) as current_commission,deal_date,deal_estimated_date 

				FROM crm_deals 

				WHERE YEAR(deal_estimated_date) = YEAR(CURRENT_DATE)

				AND MONTH(deal_estimated_date) = MONTH(CURRENT_DATE)and agent_1_id = " . $agentid;
        $query               = $this->db->query($q2);
        $row                 = $query->row();
        $current_commission  = $row->current_commission;
        $deal_date           = $row->deal_date;
        $deal_estimated_date = $row->deal_estimated_date;
        //percentage
        //avoid division by zero or null
        if ($agent_target == 0 || $agent_target == '') {
            $percent_commission = 0;
        } else {
            $percent_commission = ($current_commission / $agent_target) * 100;
        }
        $results   = array();
        $results[] = array(
            'username' => $username,
            'email' => $email,
            'mobile_no_new' => $mobile_no_new,
            'rera' => $rera,
            'photo_agent' => $photo_agent,
            'agent_target' => $agent_target,
            'percent_commission' => $percent_commission
        );
        return $results;
    }
    
    function getCalendarData()
    {
        //$sql = 'SELECT title,event_type,description,start_date as start,end_date as end FROM crm_events';
        // use the same table as calendar
        $sql   = 'SELECT event_name as title,event_type,description,start_date as start,end_date as end FROM events';
        $query = $this->db->query($sql);
        // Fetch the result array from the result object and return it
        return $query->result();
    }
    
    function getPortalsChartData()
    {
        /*****************************for dubizzle**************************/
        $q     = "select * from ((select 'dubizzle' as portal, count(id) as rentals from crm_listings where is_active=1 and is_archive=0 and status=2 and 

			portals_name like '%dubizzle%' and type=1) r ,

			(select  count(id) as sales from crm_listings where is_active=1 and is_archive=0 and status=2 and portals_name like '%dubizzle%' and type=2) t)



union all



select * from ((select 'propertyfinder' as portal, count(id) as rentals from crm_listings where is_active=1 and is_archive=0 and status=2 and 

				portals_name like '%propertyfinder%' and type=1) r ,      

				 (select count(id) as sales from crm_listings where is_active=1 and is_archive=0 and status=2 and portals_name like '%propertyfinder%' and type=2) t)

				 

				 union all



select * from ((select 'JustRentals' as portal, count(id) as rentals from crm_listings where is_active=1 and is_archive=0 and status=2 and 

				portals_name like '%JustRentals%' and type=1) r ,      

				 (select count(id) as sales from crm_listings where is_active=1 and is_archive=0 and status=2 and portals_name like '%JustRentals%' and type=2) t)

				 

				  union all



select * from ((select 'JustProperty' as portal, count(id) as rentals from crm_listings where is_active=1 and is_archive=0 and status=2 and 

				portals_name like '%JustProperty%' and type=1) r ,      

				 (select count(id) as sales from crm_listings where is_active=1 and is_archive=0 and status=2 and portals_name like '%JustProperty%' and type=2) t)

				 

				 ";
        $query = $this->db->query($q);
        return $query->result();
    }
}