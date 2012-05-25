<?php
class Chaine_model extends Model {
    var $id;
    var $name;
    var $ip_multicast;
    var $num_service;
    var $pid;
    var $tuner_id;
	var $is_active;
        
    public function __construct() {
        parent::Model();
    }
    
    public function findAll() {
        //$query = $this->db->get('chaine');
        $query = $this->db->query('SELECT * FROM chaine ORDER BY tuner_id ASC');
        return $query->result();
    }
    
    public function findByTunerId($id) {
    	$query = $this->db->get_where('chaine', array('tuner_id' => $id));
    	return $query->result();
    }
    
    public function find($id) {
        $query = $this->db->get_where('chaine', array('id' => $id));
        return $query->row();
    }
    
    public function countAll() {
        $query = $this->db->get('chaine');
        return $query->num_rows();
    }
    
    public function add($data) {
        $this->db->insert('chaine', $data);
        return $this->db->insert_id();
    }
    
    public function delete($id) {
        if ($this->db->delete('chaine', array('id' => $id))) return true;
    }
    
	public function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('chaine', $data);
    }
}