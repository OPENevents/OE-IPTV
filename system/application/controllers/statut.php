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

class Statut extends Controller {
    public function __construct() {
        parent::Controller();
        $this->load->model('tuner_model');
        $this->load->model('chaine_model');
        $this->load->model('config_model');
        $this->load->helper('url');
        $this->load->helper('exec');
        $this->load->helper('toolbox');
        $this->load->database();
    }

    public function index($status='', $type='') {
        $data['tuners'] = $this->tuner_model->findAll();
        
        $this->load->view('header');
        $this->load->view('navigation');
        $this->load->view('statut/index', $data);
        $this->load->view('footer');
    }
    
    public function info($id) {
    	$transponder = $this->tuner_model->find($id);
    	$data['transponder'] = $transponder->name;
    	$num_card = $transponder->num_card;
    	$http_port = $this->config_model->findOneByName('port_http');
    	$port = $http_port->value+$num_card;
    	$ip = $this->config_model->findOneByName('ip_http');
    	if (@fopen("http://".$ip->value.":".$port."/monitor/state.xml", "r")) {
    		$dom = new DomDocument;
    		$dom->load('http://'.$ip->value.':'.$port.'/monitor/state.xml');
    		$data['chaines'] = $dom->getElementsByTagName('name');
    		$data['ip_multicast'] = $dom->getElementsByTagName('ip_multicast');
    		$data['port_multicast'] = $dom->getElementsByTagName('port_multicast');
    		$data['traffic'] = $dom->getElementsByTagName('traffic');
    		$data['chaines'] = $dom->getElementsByTagName('name');
    		$data['version'] = $dom->getElementsByTagName('global_version');
    		$data['uptime'] = $dom->getElementsByTagName('global_uptime');
    		$data['signal'] = $dom->getElementsByTagName('frontend_signal');
    	}
    	else {
    		$data['err'] = true;
    	}
        $this->load->view('popup');
        $this->load->view('statut/info', $data);
    }
	
    public function startAll() {
    	exec('sudo /etc/init.d/mumudvb start');
    	redirect('statut/wait');
    }
	
    public function stopAll() {
    	exec('sudo /etc/init.d/mumudvb stop');
    	redirect('statut/wait');
    }
    
    public function start($id) {
    	$tuner = $this->tuner_model->find($id);    	
    	exec('sudo /etc/init.d/mumudvb start '.strtolower($tuner->name));
    	redirect('statut/wait');
    }
    
    public function stop($id) {
    	$tuner = $this->tuner_model->find($id);    	
    	exec('sudo /etc/init.d/mumudvb stop '.strtolower($tuner->name));
    	redirect('statut/wait');
    }
    
    public function wait() {
    	$this->load->view('header');
        $this->load->view('navigation');
        $this->load->view('statut/wait');
        $this->load->view('footer');
    }
}
