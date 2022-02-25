<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class PayoutModel extends CI_Model {
        var $table = "payout_setting";
        var $column_order = array('id', 'name', 'pimg','amt', 'trans_id', 'bname', 'ifsc', 'pname', 'acno', 'upi','status', 'date');
        var $order = array('id', 'name', 'pimg','amt', 'trans_id', 'bname', 'ifsc', 'pname', 'acno', 'upi','status', 'date');

        public function __construct(){
            parent::__construct();
        }

        private function _get_data_query(){
            $this->db->select('a.*, b.name');
            $this->db->from('payout_setting a');
            $this->db->join('partner b', 'a.pid = b.id');

            if(isset($_POST['search']['value'])){
                $search = '';
                if($_POST['search']['value'] == 'Approved'){
                    $search = 1;
                }elseif($_POST['search']['value'] == 'Pendding'){
                    $search = 0;
                }else{
                    $search = $_POST['search']['value'];
                }
                $this->db->like('b.name', trim($search));
                $this->db->or_like('b.pimg', trim($search));
                $this->db->or_like('a.amt', trim($search));
                $this->db->or_like('a.trans_id', trim($search));
                $this->db->or_like('a.bname', trim($search));
                $this->db->or_like('a.ifsc', trim($search));
                $this->db->or_like('a.pname', trim($search));
                $this->db->or_like('a.acno', trim($search));
                $this->db->or_like('a.upi', trim($search));
                $this->db->or_like('a.status', trim($search));
            }
    
            if(isset($_POST['order'])){
                $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            }else{
                $this->db->order_by('id', 'DESC');
            }
        }

        public function getPayoutList(){
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
            $this->db->from('payout_setting a');
            $this->db->join('partner b', 'a.pid = b.id');
            return $this->db->count_all_results();
        }

        public function updatePayout($data,$id=null){
            if(empty($id)){
                return $this->db->insert($this->table, $data);
            }else{
                $this->db->where('id', $id);
                return $this->db->update($this->table, $data);
            }
        }

        public function getPartnerWallet($pid){
            $this->db->select('wallet');
            $this->db->where('id', $pid);
            return $this->db->get('partner')->result();
        }

        public function partnerCredit($data,$pid){
            return $result = $this->db->insert("partner_wallet_report", $data);
        }

        public function updatePartnerWallet($pid, $wallet){
            $this->db->set('wallet', $wallet);
            $this->db->where('id', $pid);
            return $this->db->update('partner');
        }

    }

?>