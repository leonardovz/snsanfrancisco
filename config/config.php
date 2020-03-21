<?php 
$bd_config = array(
    'host' => 'localhost',
	'database' => 'snsanfra_sistema',
	'usuario' => 'snsanfra_init',
	'pass' => 'VPg0DI$wl596'
);

if ($_SERVER['HTTP_HOST'] == "localhost") {
	$bd_config = array(
		'host' => 'localhost',
		'database' => 'snsanfrancisco',
		'usuario' => 'rootLeo',
		'pass' => 'data1122'
	);
}

?>