<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class InvoiceModel extends CI_Model {
        var $table = "tbl_invoice";
        var $column_order = array('id', 'recipt_invoice', 'tax_invoice', 'oid', 'user_name', 'partner_name');
        var $order = array('id', 'recipt_invoice', 'tax_invoice', 'oid', 'user_name', 'partner_name');

        public function __construct(){
            parent::__construct();
        }

        private function _get_data_query(){
            $this->db->select('a.*, b.name as user_name, c.name as partner_name');
            $this->db->from('tbl_invoice a');
            $this->db->join('tbl_user b', 'a.uid = b.id');
            $this->db->join('partner c', 'a.pid = c.id');
            
            if(isset($_POST['search']['value'])){
                $search = '';
                if($_POST['search']['value'] == 'Published'){
                    $search = 1;
                }elseif($_POST['search']['value'] == 'Unpublished'){
                    $search = 0;
                }else{
                    $search = $_POST['search']['value'];
                }
                $this->db->or_like('a.oid', $search);
                $this->db->or_like('b.name', $search);
                $this->db->or_like('c.name', $search);
            }
    
            if(isset($_POST['order'])){
                $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            }else{
                $this->db->order_by('id', 'DESC');
            }
        }
    
        public function getInvoiceList(){
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
            $this->db->select('a.*, b.name as user_name, c.name as partner_name');
            $this->db->from('tbl_invoice a');
            $this->db->join('tbl_user b', 'a.uid = b.id');
            $this->db->join('partner c', 'a.pid = c.id');
            return $this->db->count_all_results();
        }
    }