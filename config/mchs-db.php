<?php 
// THIS CONNECTION IS FOR THE BILLING/ACCOUNTSMASTER SECTION
$server = '192.168.10.16';
$params = [
	'Database' => 'MMS',
	'UID' => 'sa',
	'PWD' => 'Wrangler)(*&!'
];

$mchs = sqlsrv_connect($server, $params);

// if ($billing) {
// 	echo "Billing database handshake stable!";
// } else {
// 	echo "Handshake failed!";
// 	die(print_r(sqlsrv_errors(), true));
// }
?>