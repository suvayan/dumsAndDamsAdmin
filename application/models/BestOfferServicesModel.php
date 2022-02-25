<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class BestOfferServicesModel extends CI_Model {
        var $table = "tbl_home_service";
        var $column_order = array('id', 'bestOffer', 'category', 'subCategory','title', 'img', 'description', 'status');
        var $order = array('id', 'bestOffer', 'category', 'subCategory','title', 'img', 'description', 'status');

        public function __construct(){
            parent::__construct();
        }

        private function _get_data_query(){
            $this->db->select('a.*, b.title as bestOffer, c.cat_name as category, d.title as subCategory');
            $this->db->from('tbl_home_service a');
            $this->db->join('tbl_home b', 'a.hid = b.id');
            $this->db->join('category c', 'a.cid = c.id');
            $this->db->join('g_subcategory d', 'a.sid = d.id');

            if(isset($_POST['search']['value'])){
                $search = '';
                if($_POST['search']['value'] == 'Published'){
                    $search = 1;
                }elseif($_POST['search']['value'] == 'Unpublished'){
                    $search = 0;
                }else{
                    $search = $_POST['search']['value'];
                }
                $this->db->like('b.title', trim($search));
                $this->db->or_like('c.cat_name', trim($search));
                $this->db->or_like('d.title', trim($search));
                $this->db->or_like('a.title', trim($search));
                $this->db->or_like('a.description', trim($search));
                $this->db->or_like('a.img', trim($search));
                $this->db->or_like('a.status', trim($search));
            }
    
            if(isset($_POST['order'])){
                $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            }else{
                $this->db->order_by('id', 'DESC');
            }
        }

        public function getBestOfferServicesList(){
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
            $this->db->from('tbl_home_service a');
            $this->db->join('tbl_home b', 'a.hid = b.id');
            $this->db->join('category c', 'a.cid = c.id');
            $this->db->join('g_subcategory d', 'a.sid = d.id');
            return $this->db->count_all_results();
        }


        public function insertUpdateBestOfferServices($data,$id=null){
            if(empty($id)){
                $getCount = $this->getCountOfIsChildOfParent($data['hid']);
                $count = $getCount[0]->is_child;
                $data1 = array(
                    'is_child' => (int)$count + 1
                );
                if($this->updateCountOfIsChildOfParent($data['hid'], $data1)){
                    return $this->db->insert($this->table, $data);
                }else{
                    return false;
                }

            }else{
                $this->db->where('id', $id);
                return $this->db->update($this->table, $data);
            }
        }

        public function getBestOfferServicesDetailsById($id){
            $this->db->where('id', $id);
            return $this->db->get($this->table)->result();
        }

        public function changeBestOfferServicesStatus($data, $id){
            $this->db->where('id', $id);
            return $this->db->update($this->table, $data);
        }

        public function deleteBestOfferServices($id){
            $this->db->where('id', $id);	
            return $this->db->delete($this->table);
        }

        public function getCountOfIsChildOfParent($hid){
            $this->db->select('is_child');
            $this->db->where('id', $hid);
            return $this->db->get('tbl_home')->result();
        }

        public function updateCountOfIsChildOfParent($hid, $data){
            $this->db->where('id', $hid);
            return $this->db->update('tbl_home', $data);
        }
    }
