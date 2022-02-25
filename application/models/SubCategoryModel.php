<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class SubCategoryModel extends CI_Model {
        var $table = "g_subcategory";
        var $column_order = array('id', 'cat_name', 'title', 'img', 'video', 'status');
        var $order = array('id', 'cat_name', 'title', 'img', 'video', 'status');

        public function __construct(){
            parent::__construct();
        }

        private function _get_data_query(){
            $this->db->select('a.*, b.cat_name');
            $this->db->from('g_subcategory a');
            $this->db->join('category b', 'a.cid = b.id');

            if(isset($_POST['search']['value'])){
                $search = '';
                if($_POST['search']['value'] == 'Published'){
                    $search = 1;
                }elseif($_POST['search']['value'] == 'Unpublished'){
                    $search = 0;
                }else{
                    $search = $_POST['search']['value'];
                }
                $this->db->like('b.cat_name', trim($search));
                $this->db->or_like('a.title', trim($search));
                $this->db->or_like('a.status', trim($search));
            }
    
            if(isset($_POST['order'])){
                $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            }else{
                $this->db->order_by('id', 'DESC');
            }
        }

        public function getSubCategoryList(){
            $this->_get_data_query();
            if($_POST["length"] != -1){  
                $this->db->limit($_POST['length'], $_POST['start']);  
            } 
            $query = $this->db->get();
            return $query->result();
        }
    
        public function count_filtered_data(){
            $this->_get_data_query();
            //return $this->db->get_compiled_select();
            $query = $this->db->get();
            return $query->num_rows();
        }
    
        public function count_all_data(){
            $this->db->from('g_subcategory a');
            $this->db->join('category b', 'a.cid = b.id');
            return $this->db->count_all_results();
        }

        public function insertUpdateSubCategory($data,$id=null){
            if(empty($id)){
                return $this->db->insert($this->table, $data);
            }else{
                $this->db->where('id', $id);
                return $this->db->update($this->table, $data);
            }
        }

        public function getSubCategoryDetailsById($id){
            $this->db->where('id', $id);
            return $this->db->get($this->table)->result();
        }

        public function changeSubCategoryStatus($data, $id){
            $this->db->where('id', $id);
            return $this->db->update($this->table, $data);
        }

        public function deleteSubCategory($id){
            $this->db->where('id', $id);	
            return $this->db->delete($this->table);
        }

    }

?>