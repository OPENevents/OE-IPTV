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

class Tuner extends Controller {
    public function __construct() {
        parent::Controller();
        $this->load->model('tuner_model');
        $this->load->model('chaine_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('toolbox');
        $this->load->database();
    }

    public function index($status='', $type='') {
        $data['all'] = $this->tuner_model->findAll();
        if ($status != '') $data['user_msg']['status'] = $status;
        if ($type != '') $data['user_msg']['type'] = $type;
        
        $this->load->view('header');
        $this->load->view('navigation');
        $this->load->view('tuner/index', $data);
        $this->load->view('footer');
    }
    
    public function view($id, $status='') {
    	$data['tuner'] = $this->tuner_model->find($id);
    	$data['chaine'] = $this->chaine_model->findByTunerId($data['tuner']->id);
    	
    	$this->load->view('header');
        $this->load->view('navigation');
        $this->load->view('tuner/view', $data);
        $this->load->view('footer');
    }
    
	public function add() {
        $this->setValidation();
        if ($this->form_validation->run() == true) {
        	$data['name'] = $this->input->post('name', true);
        	$data['num_card'] = $this->input->post('num_card', true);
        	$data['frequence_transponder'] = $this->input->post('frequence_transponder', true);
	        $data['is_active'] = $this->input->post('is_active', true);
        	if ($this->input->post('DVBS') == true) {
        		$data['polarite'] = $this->input->post('polarite', true);
        		$data['srate'] = $this->input->post('srate', true);
        		$data['modulation'] = $this->input->post('modulation', true);
        		$data['coderate'] = $this->input->post('coderate', true);
        		$data['dvb_s2'] = $this->input->post('dvb_s2', true);
        		$data['dvr'] = $this->input->post('dvr', true);
        		if ($data['dvb_s2'] == true) $data['dvb_s2'] = 1;
        		if ($data['dvr'] == true) $data['dvr'] = 1;
        	}            
            $this->tuner_model->add($data);
            redirect('tuner/index/success/form');
        }
        else {
            redirect('tuner/index/error/form');
        }
    }
    
	public function edit($id, $status='') {
		if ($status == '' OR $status == 'error') {
			$data['tuner'] = $this->tuner_model->find($id);
			$this->load->view('header');
        	$this->load->view('navigation');			
			$this->load->view('tuner/edit', $data);
			$this->load->view('footer');
		}
		elseif ($status == 'valid') {
			$this->setValidation();
	        if ($this->form_validation->run() == true) {
	        	$data['name'] = $this->input->post('name', true);
	        	$data['num_card'] = $this->input->post('num_card', true);
	        	$data['frequence_transponder'] = $this->input->post('frequence_transponder', true);
	        	$data['is_active'] = $this->input->post('is_active', true);
	        	if ($this->input->post('DVBS') == true) {
	        		$data['polarite'] = $this->input->post('polarite', true);
	        		$data['srate'] = $this->input->post('srate', true);
	        		$data['modulation'] = $this->input->post('modulation', true);
	        		$data['coderate'] = $this->input->post('coderate', true);
	        		$data['dvb_s2'] = $this->input->post('dvb_s2', true);
	        		$data['dvr'] = $this->input->post('dvr', true);
	        		if ($data['dvb_s2'] == true) $data['dvb_s2'] = 1;
	        		if ($data['dvr'] == true) $data['dvr'] = 1;
	        	}
	        	else {
	        		$data['polarite'] = null;
	        		$data['srate'] = null;
	        		$data['modulation'] = null;
	        		$data['coderate'] = null;
	        		$data['dvb_s2'] = null;
	        		$data['dvr'] = null;
	        	}     
	            $this->tuner_model->update($id, $data);
	            redirect('tuner/index/success/form');
	        }
	        else {
	            redirect('tuner/edit/'.$id.'/error');
	        }
		}
    }
    
    public function setValidation() {
        $this->form_validation->set_rules('name', 'Nom', 'required');
        $this->form_validation->set_rules('num_card', 'Carte', 'required');
        $this->form_validation->set_rules('frequence_transponder', 'Frequence du transpondeur', 'required');
        if ($this->input->post('DVBS') == true) {
        	$this->form_validation->set_rules('polarite', 'Polarite', 'required');
        	$this->form_validation->set_rules('srate', 'Srate', 'required');
        	$this->form_validation->set_rules('modulation', 'Modulation', 'required');
        	$this->form_validation->set_rules('coderate', 'Coderate', 'required');
        }
    }
    
    public function delete($id) {
    	if ($this->tuner_model->delete($id)) {
    		redirect('tuner/index/success/delete');
    	}
    	else {
    		redirect('tuner/index/error/delete');
    	}
    	
    }
}
