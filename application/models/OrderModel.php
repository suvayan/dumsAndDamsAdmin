<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class OrderModel extends CI_Model {
        var $table = "tbl_order";
        
        var $column_order = array('id', 'name', 'mobile','cat_name', 'title', 'odate', 'otime', 'address', 'o_status', 'comment_reject', '	datetime', 'subtotal');
        var $order = array('id',  'name', 'mobile','cat_name', 'title', 'odate', 'otime', 'address', 'o_status', 'comment_reject', '	datetime', 'subtotal');

        public function __construct(){
            parent::__construct();
        }

        private function _get_data_query(){
            $this->db->select('a.*, b.cat_name, c.name, c.mobile,d.title');
            $this->db->from('tbl_order a');
            $this->db->join('category b', 'a.cid = b.id');
            $this->db->join('tbl_user c', 'a.uid = c.id');
            $this->db->join('tbl_payment_list d', 'a.p_method_id = d.id','left');
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
                $this->db->or_like('c.name', trim($search));
                $this->db->or_like('c.mobile', trim($search));
                $this->db->or_like('d.title', trim($search));
                $this->db->or_like('a.odate', trim($search));
                $this->db->or_like('a.otime', trim($search));
                $this->db->or_like('a.address', trim($search));
                $this->db->or_like('a.o_status', trim($search));
                $this->db->or_like('a.comment_reject', trim($search));
                $this->db->or_like('a.datetime', trim($search));
                $this->db->or_like('a.subtotal', trim($search));
            }
    
            if(isset($_POST['order'])){
                $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            }else{
                $this->db->order_by('id', 'DESC');
            }
        }

        public function getOrderList(){
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
            $this->db->from('tbl_order a');
            $this->db->join('category b', 'a.cid = b.id');
            $this->db->join('tbl_user c', 'a.uid = c.id');
            $this->db->join('tbl_payment_list d', 'a.p_method_id = d.id','left');
            return $this->db->count_all_results();
        }
        
        public function getInvoice($oid, $uid){
            $this->db->select('a.*, b.name');
            $this->db->from('tbl_invoice a');
            $this->db->join('partner b','a.pid = b.id','left');
            $this->db->where('a.oid',$oid);
            $this->db->where('a.uid',$uid);
            return $this->db->get()->result();
        }
        
        public function getSubOrder($oid, $uid){
            $this->db->select('a.*, b.name');
            $this->db->from('tbl_sub_order a');
            $this->db->join('partner b','a.pid = b.id','left');
            $this->db->where('a.oid',$oid);
            $this->db->where('a.uid',$uid);
            return $this->db->get()->result();
        }
    }