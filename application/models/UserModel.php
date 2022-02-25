<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class UserModel extends CI_Model {
        var $table = "tbl_user";
        var $column_order = array('id', 'name', 'email', 'mobile', 'uimg', 'wallet', 'status', 'img');
        var $order = array('id', 'name', 'email', 'mobile', 'uimg', 'wallet', 'status', 'img');
    
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
                $this->db->or_like('status', $search);
            }
    
            if(isset($_POST['order'])){
                $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            }else{
                $this->db->order_by('id', 'DESC');
            }
        }
    
        public function getUserList(){
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

        public function changeUserStatus($data, $id){
            $this->db->where('id', $id);
            return $this->db->update($this->table, $data);
        }

                public function getLastTNum(){
            $this->db->select('t_number');	
            $this->db->from('wallet_report');
            $this->db->order_by('id', 'desc');
            $this->db->limit(1);
            return $this->db->get()->result();
        }

        public function updateUserWallet($data, $id){
            $this->db->where('id', $id);
            return $this->db->update($this->table, $data);
        }

        public function insertTransaction($data){
            return $this->db->insert("wallet_report", $data);
        }

    }

?>