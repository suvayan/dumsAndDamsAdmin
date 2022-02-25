<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class CategoryModel extends CI_Model {

        var $table = "category";
        var $column_order = array('id', 'cat_subtitle', 'cat_name', 'cat_status', 'cat_img');
        var $order = array('id', 'cat_subtitle', 'cat_name', 'cat_status', 'cat_img');

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
                $this->db->like('cat_subtitle', $search);
                $this->db->or_like('cat_name', $search);
                $this->db->or_like('cat_status', $search);
            }
    
            if(isset($_POST['order'])){
                $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            }else{
                $this->db->order_by('id', 'DESC');
            }
        }
    
        public function getCategoryList(){
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

        public function insertUpdateCategory($data, $id=null){
            if(empty($id)){
                return $this->db->insert($this->table, $data);
            }else{
                $this->db->where('id', $id);
                return $this->db->update($this->table, $data);
            }
        }

        public function getCategoryDetailsById($id){
            $this->db->where('id', $id);
            return $this->db->get($this->table)->result();
        }

        public function changeCategoryStatus($data, $id){
            $this->db->where('id', $id);
            return $this->db->update($this->table, $data);
        }

        public function deleteCategory($id){
            $this->db->where('id', $id);	
            return $this->db->delete($this->table);
        }
    }
?>