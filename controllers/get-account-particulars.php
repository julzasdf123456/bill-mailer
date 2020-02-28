<?php 

include '../config/billing-db.php';
include 'opts.php';

$acctNo = $_GET['acctNo'];


if ($billing) {
	$qry = "SELECT * FROM AccountMaster WHERE AccountNumber = '" . $acctNo . "'";
	// $qryParams = [$townCode];
	$qryRes = sqlsrv_query($billing, $qry, null, $cursor);

	if ($qryRes) {
		$data = [];
		while ($obj = sqlsrv_fetch_object($qryRes)) {
			array_push($data,
				[
					'ConsumerAddress' => $obj->ConsumerAddress,
					'ConsumerName' => $obj->ConsumerName,
					'Email' => $obj->Email,
					'ContactNumber' => $obj->ContactNumber
				]
			);
		}
		echo json_encode($data, JSON_FORCE_OBJECT);
	} else {
		echo json_encode(['response' => 'error query'], JSON_FORCE_OBJECT);
	}
} 

?>