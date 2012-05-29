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

class EXPORT extends Controller {
    public function __construct() {
        parent::Controller();
        $this->load->model('config_model');
        $this->load->model('tuner_model');
        $this->load->model('chaine_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->database();
    }

    public function index($status='', $type='') {
    	$data['config'] = $this->config_model->findAll();
    	$data['transponder'] = $this->tuner_model->findByIsActive();
    	$data['chaine'] = $this->chaine_model->findAll();
        $this->load->view('header');
        $this->load->view('navigation');
        $this->load->view('export/index', $data);
        $this->load->view('footer');
    }
    
    public function send() {
    	exec('sudo /etc/init.d/mumudvb stop');
    	$path = '/etc/mumudvb';
    	$opath = opendir($path);
    	while ($f = readdir($opath)) {
    		if (substr($f, -5) == '.conf') {
    			unlink($path.'/'.$f);
    		}
    	}
    	
    	for ($i=1; $i <= $this->input->post('nb_file', true); $i++) {
    		//echo $this->input->post('nb_file', true);
    		//echo $this->input->post('exportfile-'.$i, true);
    		//echo $this->input->post("export-2", true);
    		$handle = fopen($path.'/'.$this->input->post('exportfile-'.$i, true), 'w');
	    	fwrite($handle, $this->input->post('export-'.$i, true));
	    	fclose($handle);
    	}
    	exec('sudo /etc/init.d/mumudvb start');
    	$this->load->view('header');
        $this->load->view('navigation');
        $this->load->view('export/send');
        $this->load->view('footer');
    }
}
