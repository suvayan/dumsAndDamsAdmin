<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class HomeModel extends CI_Model {
        public function __construct(){
            parent::__construct();
        }

        public function auth($username,$password){
            $this->db->select('*');
            $this->db->where('username',$username);
            $this->db->where('password',$password);
            return $this->db->get('admin')->result();
        }

        public function totalUser(){
            $this->db->select('*');
            $query = $this->db->get('tbl_user');
            return $query->num_rows();
        }

        public function totalPartner(){
            $this->db->select('*');
            $query = $this->db->get('partner');
            return $query->num_rows();
        }

        public function totalOrder(){
            $this->db->select('*');
            $query = $this->db->get('tbl_order');
            return $query->num_rows();
        }

        public function totalIncome(){
            $this->db->select_sum('p_amt');
            $this->db->where("status !=","Pending");
            return $this->db->get('tbl_sub_order')->result();
        }

        public function totalTax(){
            $this->db->select_sum('c_amt');
            $this->db->where("status !=","Pending");
            return $this->db->get('tbl_sub_order')->result();
        }
        
        public function productList(){
            $this->db->select('*');
            $this->db->order_by("id", "desc");
            $this->db->limit(5);
            return $this->db->get('tbl_brand')->result();
        }

        public function getCategories(){
            $this->db->select('id, cat_name');
            return $this->db->get('category')->result();
        }

        public function getSubCategoriesByCid($cid){
            $this->db->select('id, title');
            $this->db->where('cid',$cid);
            return $this->db->get('g_subcategory')->result();
        }

        public function getChilds(){
            $this->db->select('id, title');
            return $this->db->get('tbl_child')->result();
        }

        public function getBestOffers(){
            $this->db->select('id, title');
            return $this->db->get('tbl_home')->result();
        }

        public function getCities(){
            $this->db->select('id, cname');
            return $this->db->get('tbl_city')->result();
        }

        public function getBrands(){
            $this->db->select('id, brand');
            return $this->db->get('tbl_brand')->result();
        }
        
        public function getMonthlyRevenue(){
            $sql = 'SELECT sum(subtotal) as monthlyOrder, sum(p_amt) as monthlyExpence, sum(c_amt) as monthlyRevenue FROM tbl_sub_order WHERE status !=  "Pending" AND MONTH(datetime) = MONTH(CURRENT_DATE()) AND YEAR(datetime) = YEAR(CURRENT_DATE())';
            return $this->db->query($sql)->result();
        }

        public function orderList(){
            $this->db->select('a.*, b.name, b.email, b.mobile');
            $this->db->from('tbl_order a');
            $this->db->join('tbl_user b','a.uid=b.id');
            $this->db->order_by("id", "desc");
            $this->db->limit(5);
            return $this->db->get()->result();
        }

    }

?>