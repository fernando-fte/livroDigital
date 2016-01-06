<?php 
	$settings['wwwpatern'] = '';
	include 'php/index.php';


	$temp['name'] = 'Projeto';
	$temp['type'] = 'source';
	// $temp['action']['path'] = 'prod';
	// $temp['action']['path'] = 'wwwpatern';
	$temp['action']['open'] = true;

	$temp['file'] = file_open($temp, 'done');

	$temp['html']['input'] = $temp['file']['done'];
	// $temp['html']['pattern']['src']['path'] = "dist";

	// $temp['done'] = construct_html($temp['html'], 'print');
	$temp['done'] = construct_html($temp['html'], false)['done'];

	print_r($temp['done']);
?>

