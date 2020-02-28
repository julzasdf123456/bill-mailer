<?php 

include '../config/mchs-db.php';
include '../config/billing-db.php';

$accountNumber = $_GET['accountNumber'];
$email = $_GET['email'];
$contact = $_GET['contact'];

$response = [];

if ($billing) {
	$qry = "SELECT * FROM AccountMaster WHERE AccountNumber = '" . $accountNumber . "'";
	$params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );

	$result = sqlsrv_query($billing, $qry, $params, $options);
	
	if ($result !== false) {
		if (sqlsrv_num_rows($result) > 0) { // IF ACCOUNT EXISTS
			while ($obj = sqlsrv_fetch_object($result)) {
				$response['ConsumerName'] = $obj->ConsumerName;
				$response['ConsumerAddress'] = $obj->ConsumerAddress;
				$response['Route'] = $obj->Route;
			}

			// INSERT NEW EMAIL TO ACCOUNT MASTER
			$updt = 'UPDATE AccountMaster SET Email = ?, ContactNumber = ? WHERE AccountNumber = ?';
			$insrtParams = [$email, $contact, $accountNumber];

			// // INSERT NEW EMAIL TO MMS DB
			// $insrt = 'INSERT INTO AutoEmailAccounts VALUES (?, ?, ?, ?, ?)';
			// $insrtParams = [$accountNumber, $response['Route'], $response['ConsumerName'], $email, $town];

			$insrtRes = sqlsrv_query($billing, $updt, $insrtParams);

			if ($insrtRes) {
				echo json_encode(['response' => 'ok'], JSON_FORCE_OBJECT);
			} else {
				echo json_encode(['response' => 'failed'], JSON_FORCE_OBJECT);
			}
		} else { // IF ACCOUNT DOESNT EXIST
			echo json_encode(['response' => 'acct_not_existing'], JSON_FORCE_OBJECT);
		}
			
	} else {
		echo "error";
	}

} else {
	die(print_r(sqlsrv_errors(), true));
}

?>