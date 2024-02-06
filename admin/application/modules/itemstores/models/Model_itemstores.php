<?php
class Model_itemstores extends CI_Model {
    
    public function getOrderByMemberID($seller_store_id)
    {
        $this->db->select("*");
        $this->db->from("store_transaction");
        $this->db->where("seller_store_id",$seller_store_id);
        $this->db->where("amount_total !=",0);

        $this->db->group_by("store_transaction.depositor_store_id");
        $this->db->order_by("store_transaction.timestamp","DESC");

        $query = $this->db->get();
        
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getInfoOrderByMemberID($seller_store_id,$depositor_store_id)
    {

        $this->db->select("*");
        $this->db->from("store_transaction");
        $this->db->where("seller_store_id",$seller_store_id);
        $this->db->where("depositor_store_id",$depositor_store_id);
        $this->db->where("amount !=",0);

        $this->db->order_by("store_transaction.timestamp","DESC");
        $query = $this->db->get();
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getPlaceByID($place_id)
    {
        $query = $this->db->query('SELECT * FROM  store_place WHERE place_id = '.$place_id);
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getStoreByID($store_id)
    {
        $query = $this->db->query('SELECT * FROM  store WHERE store_id = '.$store_id);
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getTranType($tran_id)
    {
        $query = $this->db->query('SELECT * FROM  store_transaction_type WHERE id = '.$tran_id);
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }



















}

?>
