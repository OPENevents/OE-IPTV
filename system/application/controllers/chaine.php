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

class Chaine extends Controller {

    public function __construct() {
        parent::Controller();
        $this->load->model('tuner_model');
        $this->load->model('chaine_model');
        $this->load->helper('form');
        $this->load->helper('toolbox');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->database();
    }

    public function index($status='', $type='') {
        $data['all'] = $this->chaine_model->findAll();
        $data['tuners'] = $this->tuner_model->findAll();
        foreach ($data['tuners'] as $item) {
        	$id = $item->id;
        	$tuner[$id]['name'] = $item->name;
        	$tuner[$id]['num_card'] = $item->num_card;
        	$tuner[$id]['frequence_transponder'] = $item->frequence_transponder;
        	$tuner[$id]['is_active'] = $item->is_active;
        }
        //unset($data['tuners']);
        $data['tuners2'] = @$tuner;
        if ($status != '') $data['user_msg']['status'] = $status;
        if ($type != '') $data['user_msg']['type'] = $type;
        
        $this->load->view('header');
        $this->load->view('navigation');
        $this->load->view('chaine/index', $data);
        $this->load->view('footer');
    }
    
	public function add() {
        $this->setValidation();
        if ($this->form_validation->run() == true) {
        	$data['name'] = $this->input->post('name', true);
        	$data['ip_multicast'] = $this->input->post('ip_multicast', true);
        	$data['num_service'] = $this->input->post('num_service', true);
        	$data['pid'] = $this->input->post('pid', true);
        	$data['tuner_id'] = $this->input->post('tuner_id', true);        
            $this->chaine_model->add($data);
            redirect('tuner/view/'.$data['tuner_id'].'/success');
        }
        else {
            redirect('tuner/view/'.$this->input->post('tuner_id', true).'/error');
        }
    }
    
	public function edit($id, $status='') {
		if ($status == '' OR $status == 'error') {
			$data['chaine'] = $this->chaine_model->find($id);
			$data['tuners'] = $this->tuner_model->findAll();
        	foreach ($data['tuners'] as $item) {
        		$id = $item->id;
        		$tuner[$id] = $item->name;
        	}
       	 	//unset($data['tuners']);
       	 	$data['tuners2'] = $tuner;
			$this->load->view('header');
        	$this->load->view('navigation');			
			$this->load->view('chaine/edit', $data);
			$this->load->view('footer');
		}
		elseif ($status == 'valid') {
			$this->setValidation();
	        if ($this->form_validation->run() == true) {
	        	$data['name'] = $this->input->post('name', true);
	        	$data['ip_multicast'] = $this->input->post('ip_multicast', true);
	        	$data['num_service'] = $this->input->post('num_service', true);
	        	$data['pid'] = $this->input->post('pid', true);
	        	$data['tuner_id'] = $this->input->post('tuner_id', true);
	        	
	        	$this->chaine_model->update($id, $data);
	            redirect('chaine/index/success/form');
	        }
	        else {
	            redirect('chaine/edit/'.$id.'/error');
	        }
		}
    }
    
    public function setValidation() {
        $this->form_validation->set_rules('name', 'Nom', 'required');
        $this->form_validation->set_rules('ip_multicast', 'IP Multicast', 'required');
        $this->form_validation->set_rules('num_service', 'Num service', 'required');
        $this->form_validation->set_rules('pid', 'PIDs', 'required');
        $this->form_validation->set_rules('tuner_id', 'Tuner', 'required');
    }
    
    public function delete($id) {
    	if ($this->chaine_model->delete($id)) {
    		redirect('chaine/index/success/delete');
    	}
    	else {
    		redirect('chaine/index/error/delete');
    	}
    	
    }
}
