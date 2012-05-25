<?php
class Tuner_model extends Model {
    var $id;
    var $name;
    var $num_card;
    var $frequence_transponder;
    var $polarite;
    var $srate;
    var $modulation;
    var $coderate;
    var $dvb_s2;
    var $dvr;
    var $is_active;
    
    public function __construct() {
        parent::Model();
    }
    
    public function findAll() {
        $query = $this->db->get('tuner');
        return $query->result();
    }
    
    public function find($id) {
        $query = $this->db->get_where('tuner', array('id' => $id));
        return $query->row();
    }
    
    public function findByIsActive() {
        $query = $this->db->get_where('tuner', array('is_active' => 1));
        return $query->result();
    }
    
    public function countAll() {
        $query = $this->db->get('tuner');
        return $query->num_rows();
    }
    
    public function add($data) {
        $this->db->insert('tuner', $data);
        return $this->db->insert_id();
    }
    
    public function delete($id) {
        $query = $this->db->query('SELECT * FROM tuner WHERE id="'.$id.'"');
        $tunerid = $query->row();
        $this->db->query('DELETE FROM chaine WHERE tuner_id="'.$tunerid->id.'"');
		$this->db->delete('tuner', array('id' => $id));
		return true;
    }
    
	public function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('tuner', $data);
    }
}