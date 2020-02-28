<?php 

include '../config/billing-db.php';
include 'opts.php';

$tmpPeriod = $_GET['period'];
$acctNo = $_GET['acctNo'];
$period = date('Y-m-d', strtotime($tmpPeriod));

if ($billing) {
	
	$qry = "EXEC sp_SOA @ServicePeriodEnd='" . $period . "', @WhereClause='Bi.AccountNumber=''" . $acctNo . "'''";
	$qryRes = sqlsrv_prepare($billing, $qry, null);

	$consType = "";
	$data = [];
	if (sqlsrv_execute($qryRes)) {		
		while ($obj = sqlsrv_fetch_array($qryRes)) {
			$consType = $obj[49] . $obj[7];
			array_push($data,
				[
					'AccountNumber' => $acctNo,
					'PreviousReading' => $obj[8],
					'PresentReading' => $obj[9],
					'DateFrom' => $obj[32],
					'ConsumerName' => $obj[5],
					'DateTo' => $obj[33],
					'ConsumerAddress' => $obj[6],
					'CoreLoss' => $obj[36],
					'DueDate' => $obj[34],
					'Route' => $obj[2],
					'Demand' => $obj[23],
					'Period' => $period,
					'MeterNumber' => $obj[48],
					'Multiplier' =>  $obj[50],
					'BillNumber' =>  $obj[35],
					'ConsumerType' =>  $obj[49],
					'KWHUsed' =>  $obj[25],
					'GenerationSystemRate' =>  $obj[68],
					'GenerationSystemAmount' =>  $obj[51],
					'TransmissionDeliveryKWHRate' =>  $obj[73],
					'TransmissionDeliveryKWHAmount' =>  $obj[56],
					'TransmissionDeliveryKWRate' => $obj[72],
					'TransmissionDeliveryKWAmount' => $obj[55],
					'SystemLossRate' => $obj[80],
					'SystemLossAmount' => $obj[63],
					'LifelineSubsidyChargeRate' => $obj[84],
					'LifelineSubsidyChargeAmount' => $obj[65],
					'RFSCRate' =>  $obj[87],
					'RFSCAmount' => $obj[108],
					'FitAllRate' => $obj[88],
					'FitAllAmount' => $obj[41],
					'OtherChargesAmount' => $obj[42],
					'DistributionNetworkKWHRate' =>  $obj[75],
					'DistributionNetworkKWHAmount' =>  $obj[58],
					'DistributionNetworkKWRate' =>  $obj[74],
					'DistributionNetworkKWAmount' =>  $obj[57],
					'RetailElectricServiceKWHRate' => $obj[77],
					'RetailElectricServiceKWHAmount' =>  $obj[60],
					'RetailElectricServiceKWRate' =>  $obj[59],
					'RetailElectricServiceKWAmount' =>  $obj[76],
					'MeteringChargeRate' =>  $obj[79],
					'MeteringChargeAmount' =>  $obj[62],
					'MeteringRetailRate' =>  $obj[78],
					'MeteringRetailAmount' =>  $obj[61],
					'GenerationRate' =>  $obj[93],
					'GenerationAmount' => $obj[97],
					'TransmissionRate' =>  $obj[94],
					'TransmissionAmount' =>  $obj[98],
					'SystemLossKWHRate' =>  $obj[81],
					'SystemLossKWHAmount' =>  $obj[64],
					'DistributionRate' =>  $obj[92],
					'DistributionAmount' =>  $obj[100],
					'DAARate' =>  $obj[116],
					'DAAAmount' =>  $obj[122],
					'ACRMRate' =>  $obj[115],
					'ACRMAmount' => $obj[121],
					'OtherRate' =>  $obj[92],
					'OtherAmount' =>  $obj[101],
					'MissionaryElectrificationRate' => $obj[82],
					'MissionaryElectrificationAmount' =>  $obj[66],
					'NPCStrandedDebtsRate' =>  $obj[70],
					'NPCStrandedDebtsAmount' => $obj[53],
					'NPCStrandedCostRate' =>  $obj[71],
					'NPCStrandedCostAmount' =>  $obj[54],
					'EnvironmentalRate' =>  $obj[83],
					'EnvironmentalAmount' =>  $obj[67],
					'TAFPPCARate' =>  $obj[119],
					'TAFPPCAAmount' =>  $obj[125],
					'TAFXARate' =>  $obj[120],
					'TAFXAAmount' =>  $obj[126],
					'GRAMRate' =>  $obj[117],
					'GRAMAmount' =>  $obj[123],
					'ICERARate' =>  $obj[118],
					'ICERAAmount' => $obj[124],
					'TransformerRentalRate' =>  $obj[29],
					'TransformerRentalAmount' =>  $obj[38],
					'SCRate' =>  $obj[89],
					'SCAmount' => $obj[110],
					'MandatoryReductionAmount' => $obj[105],
					'AmountDue' => ($obj[30] - $obj[95]),
					'VATAmount' => $obj[95],
					'TotalAmountDue' => $obj[30],
					'KatasNgVAT' => $obj[103], 
					'CurentAmountDue' => $obj[30],
					'ArrearsNoMonth' => $obj[106],
					'ArrearsTotal' => $obj[107],
				]
			);
		}
	} else {
		echo json_encode(['response' => 'query_failure'], JSON_FORCE_OBJECT);
		echo print_r(sqlsrv_errors());
	}

	// // SELECT DISCOUNTS
	$qryDiscounts = "SELECT * FROM BillsForDCRRevision WHERE AccountNumber='" . $acctNo . "' AND ServicePeriodEnd='" . $period . "'";
	$qryDiscountsRes = sqlsrv_query($billing, $qryDiscounts, null, $cursor);
	if ($qryDiscountsRes) {
		while ($obj = sqlsrv_fetch_object($qryDiscountsRes)) {
			array_push($data,
				[
					'Discount' => ($obj->NetAmountLessCharges * .01),
					'BIR2306' => $obj->Form2306,
					'BIR2307' => $obj->Form2307
				]
			);
		}
	}

	// MANDATORY REDUCTION RATE
	$qryRates = "SELECT * FROM UnbundledRatesExtension WHERE ConsumerType='" . $consType . "' AND ServicePeriodEnd='" . $period . "'";
	$qryRatesRes = sqlsrv_query($billing, $qryRates, null, $cursor);
	if ($qryRatesRes) {
		while ($obj = sqlsrv_fetch_object($qryRatesRes)) {
			array_push($data,
				[					
					'MandatoryReductionRate' => $obj->Item5
				]
			);
		}
	}

	echo json_encode($data, JSON_FORCE_OBJECT);
} else {
	echo json_encode(['response' => 'billing_db_failure'], JSON_FORCE_OBJECT);
}

?>