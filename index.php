<?php 
	$settings['wwwpatern'] = '';
	include 'php/index.php';


	$temp['name'] = 'Index Project';
	$temp['type'] = 'source';
	// $temp['action']['path'] = 'prod';
	// $temp['action']['path'] = 'wwwpatern';
	$temp['action']['open'] = true;

	$temp['file'] = file_open($temp, 'done');

	// $temp['done'] = construct_html(array('input' => $temp['file']['done']), 'print');
	$temp['done'] = construct_html(array('input' => $temp['file']['done']), 'done')['done'];

	echo $temp['done'];
?>

