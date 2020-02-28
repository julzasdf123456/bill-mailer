<?php 

include '../config/billing-db.php';
include 'opts.php';

$townCode = $_GET['townCode'];

if ($billing) {
	$qry = "SELECT * FROM AccountMaster WHERE Area = '" . $townCode . "' AND Email IS NOT NULL AND AccountStatus='ACTIVE'";
	// $qryParams = [$townCode];
	$qryRes = sqlsrv_query($billing, $qry, null, $cursor);

	if ($qryRes) {
		$data = [];
		while ($obj = sqlsrv_fetch_object($qryRes)) {
			array_push($data,
				[
					'AccountNumber' => $obj->AccountNumber,
					'Email' => $obj->Email,
					'AccountName' => $obj->ConsumerName,
				]
			);
		}
		echo json_encode($data, JSON_FORCE_OBJECT);
	} else {
		echo json_encode([], JSON_FORCE_OBJECT);
	}
} 

?>