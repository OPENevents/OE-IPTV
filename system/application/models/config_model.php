<?php
/**
 * OE IPTV
 *
 * Webinterface for MuMuDVB
 *
 * @package          OE-IPTV
 * @author           OPENevents
 * @license          http://www.gnu.org/licenses/gpl-2.0.txt
 * @link             http://www.openevents.fr
 * @version          1.0
 */

class Config_model extends Model {
    var $id;
    var $name;
    var $value;
    
    public function __construct() {
        parent::Model();
    }
    
    public function findAll() {
        $query = $this->db->get('config');
        return $query->result();
    }
    
    public function find($id) {
        $query = $this->db->get_where('config', array('id' => $id));
        return $query->row();
    }
    
    public function findOneByName($name) {
        $query = $this->db->get_where('config', array('name' => $name));
        return $query->row();
    }
    
    public function countAll() {
        $query = $this->db->get('config');
        return $query->num_rows();
    }
    
    public function add($data) {
        $this->db->insert('config', $data);
        return $this->db->insert_id();
    }
    
    public function delete($id) {
        if ($this->db->delete('config', array('id' => $id))) return true;
    }
    
	public function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('config', $data);
    }
}
