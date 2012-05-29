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

class Home extends Controller {
    public function __construct() {
        parent::Controller();
        $this->load->helper('url');
    }
    
    public function index() {
        $this->load->view('header');
        $this->load->view('navigation');
        $this->load->view('home/index');
        $this->load->view('footer');
    }
}
