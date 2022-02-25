<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class BannerModel extends CI_Model {
        var $table = "banner";
        var $column_order = array('id', 'img', 'status');
        var $order = array('id', 'img', 'status');

        public function __construct(){
            parent::__construct();
        }

        private function _get_data_query(){
            $this->db->from($this->table);
            if(isset($_POST['search']['value'])){
                $search = '';
                if($_POST['search']['value'] == 'Published'){
                    $search = 1;
                }elseif($_POST['search']['value'] == 'Unpublished'){
                    $search = 0;
                }else{
                    $search = $_POST['search']['value'];
                }
                $this->db->or_like('status', $search);
            }
    
            if(isset($_POST['order'])){
                $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            }else{
                $this->db->order_by('id', 'DESC');
            }
        }
    
        public function getBannerList(){
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

        public function insertBanner($data){
            return $this->db->insert($this->table, $data);
        }

        public function deleteBanner($id){
            $this->db->where('id', $id);	
            return $this->db->delete($this->table);
        }

        public function changeBannerStatus($data, $id){
            $this->db->where('id', $id);
            return $this->db->update($this->table, $data);
        }
        
        public function getBannerDetailsById($id){
            return $this->db->get_where($this->table,['id'=>$id])->result();
        }

        public function updateBannerOtherDetails($data,$id){
            $this->db->where('id', $id);
            return $this->db->update($this->table, $data);
        }

    }

?>