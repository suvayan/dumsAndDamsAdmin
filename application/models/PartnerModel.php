<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class PartnerModel extends CI_Model {
        var $table = "partner";
        var $column_order = array('id', 'name', 'email', 'mobile', 'pimg', 'wallet', 'is_active', 'img');
        var $order = array('id', 'name', 'email', 'mobile', 'pimg', 'wallet', 'is_active', 'img');
    
        public function __construct(){
            parent::__construct();
        }
    
        private function _get_data_query(){
            $this->db->from($this->table);
            if(isset($_POST['search']['value'])){
                $search = '';
                if($_POST['search']['value'] == 'Active'){
                    $search = 1;
                }elseif($_POST['search']['value'] == 'In-active'){
                    $search = 0;
                }else{
                    $search = $_POST['search']['value'];
                }
                $this->db->like('name', $search);
                $this->db->or_like('email', $search);
                $this->db->or_like('mobile', $search);
                $this->db->or_like('wallet', $search);
                $this->db->or_like('is_active', $search);
            }
    
            if(isset($_POST['order'])){
                $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            }else{
                $this->db->order_by('id', 'DESC');
            }
        }
    
        public function getPartnerList(){
            $this->_get_data_query();
            if($_POST["length"] != -1){  
                $this->db->limit($_POST['length'], $_POST['start']);  
            } 
            $query = $this->db->get();
            return $query->result();
        }
    
        public function count_filtered_data(){
            $this->_get_data_query();
            $query = $this->db->get();
            return $query->num_rows();
        }
    
        public function count_all_data(){
            $this->db->from($this->table);
            return $this->db->count_all_results();
        }

        // public function getCityDetailsById($id){
        //     $this->db->where('id', $id);
        //     return $this->db->get($this->table)->result();
        // }

        // public function insertUpdateCity($data,$id=null){
        //     if(empty($id)){
        //         return $this->db->insert($this->table, $data);
        //     }else{
        //         $this->db->where('id', $id);
        //         return $this->db->update($this->table, $data);
        //     }
        // }

        public function changePartnerStatus($data, $id){
            $this->db->where('id', $id);
            return $this->db->update($this->table, $data);
        }

        public function getLastTNum(){
            $this->db->select('t_number');	
            $this->db->from('partner_wallet_report');
            $this->db->order_by('id', 'desc');
            $this->db->limit(1);
            return $this->db->get()->result();
        }

        public function updatePartnerWallet($data, $id){
            $this->db->where('id', $id);
            return $this->db->update($this->table, $data);
        }

        public function insertTransaction($data){
            return $this->db->insert("partner_wallet_report", $data);
        }
        
        public function getPartnerServices($id){
            $this->db->where('mid', $id);
            return $this->db->get("tbl_partner_service")->result();
        }

    }

?>