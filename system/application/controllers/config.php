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

class Config extends Controller {
    public function __construct() {
        parent::Controller();
        $this->load->model('config_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->database();
    }

    public function index($status='', $type='') {
        $data['all'] = $this->config_model->findAll();
        if ($status != '') $data['user_msg']['status'] = $status;
        if ($type != '') $data['user_msg']['type'] = $type;
        
        $this->load->view('header');
        $this->load->view('navigation');
        $this->load->view('config/index', $data);
        $this->load->view('footer');
    }
    
    
	public function edit($id, $status='') {
		if ($status == '' OR $status == 'error') {
			$data['config'] = $this->config_model->find($id);
			$this->load->view('header');
        	$this->load->view('navigation');			
			$this->load->view('config/edit', $data);
			$this->load->view('footer');
		}
		elseif ($status == 'valid') {
			$this->setValidation();
	        if ($this->form_validation->run() == true) {
	        	$data['value'] = $this->input->post('value', true);
    
	            $this->config_model->update($id, $data);
	            redirect('config/index/success/form');
	        }
	        else {
	            redirect('config/edit/'.$id.'/error');
	        }
		}
    }
    
    public function setValidation() {
        $this->form_validation->set_rules('value', 'Valeur', 'required');
    }
}
