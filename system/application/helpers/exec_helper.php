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

function check_status($name) {
	exec('/etc/init.d/mumudvb status '.$name, $result);
	//print_r($result);
	if (@$result[0] == 1) {
		return true;
	}
	else {
		return false;
	}
}
?>
