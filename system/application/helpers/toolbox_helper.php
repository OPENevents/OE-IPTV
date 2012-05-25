<?php
function slug($string) {
	$return = strtolower($string);
	$return = str_replace('', 'e', $return);
	$return = str_replace('', 'e', $return);
	$return = str_replace('', 'e', $return);
	$return = str_replace('‘', 'e', $return);
	$return = str_replace('ˆ', 'a', $return);
	$return = str_replace('', 'c', $return);
	$return = str_replace('', 'u', $return);
	$return = str_replace('!', '', $return);
	$return = str_replace('?', '', $return);
	$return = str_replace('\'', '', $return);
	$return = str_replace('(', '', $return);
	$return = str_replace(')', '', $return);
	$return = str_replace('>', '', $return);
	$return = str_replace('<', '', $return);
	$return = str_replace('=', '', $return);
	$return = str_replace('+', '', $return);
	$return = str_replace('-', '', $return);
	$return = str_replace('*', '', $return);
	$return = str_replace('&', '', $return);
	$return = str_replace('_', '', $return);
	$return = str_replace('%', '', $return);
	$return = str_replace(',', '', $return);
	$return = str_replace(';', '', $return);
	$return = str_replace('.', '', $return);
	$return = str_replace(' ', '', $return);
	return $return;
}
?>