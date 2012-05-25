<?php
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