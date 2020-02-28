<?php 
// THIS CONNECTION IS FOR THE BILLING/ACCOUNTSMASTER SECTION
$server = '192.168.10.11';
$params = [
	'Database' => 'Billing',
	'UID' => 'sa',
	'PWD' => 'Wrangler)(*&!'
];

$billing = sqlsrv_connect($server, $params);

// if ($billing) {
// 	echo "Billing database handshake stable!";
// } else {
// 	echo "Handshake failed!";
// 	die(print_r(sqlsrv_errors(), true));
// }
?>