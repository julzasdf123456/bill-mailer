<?php 

require 'PHPMailer/PHPMailerAutoload.php';
require 'config/billing-db.php';
require('PDFMaker.php');

$recipient = $_GET['recipient'];
$body = $_GET['body'];
$acctNo = $_GET['acctNo'];
$prevRead = $_GET['prevRead'];
$presRead = $_GET['presRead'];
$dateFrom = $_GET['dateFrom'];
$consumerName = $_GET['consumerName'];
$dateTo = $_GET['dateTo'];
$consumerAddress = $_GET['consumerAddress'];
$coreLoss = $_GET['coreLoss'];
$dueDate = $_GET['dueDate'];
$route = $_GET['route'];
$demand = $_GET['demand'];
$period = $_GET['period'];
$meterNumber = $_GET['meterNumber'];
$multiplier = $_GET['multiplier'];
$billNumber = $_GET['billNumber'];
$consumerType = $_GET['consumerType'];
$kwhUsed = $_GET['kwhUsed'];
$generationSystemRate = $_GET['generationSystemRate'];
$generationSystemAmount = $_GET['generationSystemAmount'];
$transmissionDeliveryKWHRate = $_GET['transmissionDeliveryKWHRate'];
$transmissionDeliveryKWHAmount = $_GET['transmissionDeliveryKWHAmount'];
$transmissionDeliveryKWRate = $_GET['transmissionDeliveryKWRate'];
$transmissionDeliveryKWAmount = $_GET['transmissionDeliveryKWAmount'];
$systemLossRate = $_GET['systemLossRate'];
$systemLossAmount = $_GET['systemLossAmount'];
$lifelineSubsidyChargeRate = $_GET['lifelineSubsidyChargeRate'];
$lifelineSubsidyChargeAmount = $_GET['lifelineSubsidyChargeAmount'];
$rfscRate = $_GET['rfscRate'];
$rfscAmount = $_GET['rfscAmount'];
$fitAllRate = $_GET['fitAllRate'];
$fitAllAmount = $_GET['fitAllAmount'];
$otherChargesAmount = $_GET['otherChargesAmount'];
$distributionNetworkKWHRate = $_GET['distributionNetworkKWHRate'];
$distributionNetworkKWHAmount = $_GET['distributionNetworkKWHAmount'];
$distributionNetworkKWRate = $_GET['distributionNetworkKWRate'];
$distributionNetworkKWAmount = $_GET['distributionNetworkKWAmount'];
$retailElectricServiceKWHRate = $_GET['retailElectricServiceKWHRate'];
$retailElectricServiceKWHAmount = $_GET['retailElectricServiceKWHAmount'];
$retailElectricServiceKWRate = $_GET['retailElectricServiceKWRate'];
$retailElectricServiceKWAmount = $_GET['retailElectricServiceKWAmount'];
$meteringChargeRate = $_GET['meteringChargeRate'];
$meteringChargeAmount = $_GET['meteringChargeAmount'];
$meteringRetailRate = $_GET['meteringRetailRate'];
$meteringRetailAmount = $_GET['meteringRetailAmount'];
$generationRate = $_GET['generationRate'];
$generationAmount = $_GET['generationAmount'];
$transmissionRate = $_GET['transmissionRate'];
$transmissionAmount = $_GET['transmissionAmount'];
$systemLossKWHRate = $_GET['systemLossKWHRate'];
$systemLossKWHAmount = $_GET['systemLossKWHAmount'];
$distributionRate = $_GET['distributionRate'];
$distributionAmount = $_GET['distributionAmount'];
$daaRate = $_GET['daaRate'];
$daaAmount = $_GET['daaAmount'];
$acrmRate = $_GET['acrmRate'];
$acrmAmount = $_GET['acrmAmount'];
$otherRate = $_GET['otherRate'];
$otherAmount = $_GET['otherAmount'];
$missionaryElectrificationRate = $_GET['missionaryElectrificationRate'];
$missionaryElectrificationAmount = $_GET['missionaryElectrificationAmount'];
$npcStrandedDebtsRate = $_GET['npcStrandedDebtsRate'];
$npcStrandedDebtsAmount = $_GET['npcStrandedDebtsAmount'];
$npcStrandedCostRate = $_GET['npcStrandedCostRate'];
$npcStrandedCostAmount = $_GET['npcStrandedCostAmount'];
$environmentalRate = $_GET['environmentalRate'];
$environmentalAmount = $_GET['environmentalAmount'];
$tafppcaRate = $_GET['tafppcaRate'];
$tafppcaAmount = $_GET['tafppcaAmount'];
$tafxaRate = $_GET['tafxaRate'];
$tafxaAmount = $_GET['tafxaAmount'];
$gramRate = $_GET['gramRate'];
$gramAmount = $_GET['gramAmount'];
$iceraRate = $_GET['iceraRate'];
$iceraAmount = $_GET['iceraAmount'];
$transformerRentalRate = $_GET['transformerRentalRate'];
$transformerRentalAmount = $_GET['transformerRentalAmount'];
$scRate = $_GET['scRate'];
$scAmount = $_GET['scAmount'];
$mandatoryReductionRate = $_GET['mandatoryReductionRate'];
$mandatoryReductionAmount = $_GET['mandatoryReductionAmount'];
$amountDue = $_GET['amountDue'];
$vatAmount = $_GET['vatAmount'];
$totalAmountDue = $_GET['totalAmountDue'];
$katasNgVat = $_GET['katasNgVat'];
$currentAmountDue = $_GET['currentAmountDue'];
$arrearsNoMonth = $_GET['arrearsNoMonth'];
$arrearsTotal = $_GET['arrearsTotal'];
$discount = $_GET['discount'];
$bir2306 = $_GET['bir2306'];
$bir2307 = $_GET['bir2307'];

$model = [
	'AccountNumber' => $acctNo,
	'PreviousReading' => $prevRead,
	'PresentReading' => $presRead,
	'DateFrom' => $dateFrom,
	'ConsumerName' => $consumerName,
	'DateTo' => $dateTo,
	'ConsumerAddress' => $consumerAddress,
	'CoreLoss' => $coreLoss,
	'DueDate' => $dueDate,
	'Route' => $route,
	'Demand' => $demand,
	'Period' => $period,
	'MeterNumber' => $meterNumber,
	'Multiplier' => $multiplier,
	'BillNumber' => $billNumber,
	'ConsumerType' => $consumerType,
	'KWHUsed' => $kwhUsed,
	'GenerationSystemRate' => $generationSystemRate,
	'GenerationSystemAmount' => $generationSystemAmount,
	'TransmissionDeliveryKWHRate' => $transmissionDeliveryKWHRate,
	'TransmissionDeliveryKWHAmount' => $transmissionDeliveryKWHAmount,
	'TransmissionDeliveryKWRate' => $transmissionDeliveryKWRate,
	'TransmissionDeliveryKWAmount' => $transmissionDeliveryKWAmount,
	'SystemLossRate' => $systemLossRate,
	'SystemLossAmount' => $systemLossAmount,
	'LifelineSubsidyChargeRate' => $lifelineSubsidyChargeRate,
	'LifelineSubsidyChargeAmount' => $lifelineSubsidyChargeAmount,
	'RFSCRate' => $rfscRate,
	'RFSCAmount' => $rfscAmount,
	'FitAllRate' => $fitAllRate,
	'FitAllAmount' => $fitAllAmount,
	'OtherChargesAmount' => $otherChargesAmount,
	'DistributionNetworkKWHRate' => $distributionNetworkKWHRate,
	'DistributionNetworkKWHAmount' => $distributionNetworkKWHAmount,
	'DistributionNetworkKWRate' => $distributionNetworkKWRate,
	'DistributionNetworkKWAmount' => $distributionNetworkKWAmount,
	'RetailElectricServiceKWHRate' => $retailElectricServiceKWHRate,
	'RetailElectricServiceKWHAmount' => $retailElectricServiceKWHAmount,
	'RetailElectricServiceKWRate' => $retailElectricServiceKWRate,
	'RetailElectricServiceKWAmount' => $retailElectricServiceKWAmount,
	'MeteringChargeRate' => $meteringChargeRate,
	'MeteringChargeAmount' => $meteringChargeAmount,
	'MeteringRetailRate' => $meteringRetailRate,
	'MeteringRetailAmount' => $meteringRetailAmount,
	'GenerationRate' => $generationRate,
	'GenerationAmount' => $generationAmount,
	'TransmissionRate' => $transmissionRate,
	'TransmissionAmount' => $transmissionAmount,
	'SystemLossKWHRate' => $systemLossKWHRate,
	'SystemLossKWHAmount' => $systemLossKWHAmount,
	'DistributionRate' => $distributionRate,
	'DistributionAmount' => $distributionAmount,
	'DAARate' => $daaRate,
	'DAAAmount' => $daaAmount,
	'ACRMRate' => $acrmRate,
	'ACRMAmount' => $acrmAmount,
	'OtherRate' => $otherRate,
	'OtherAmount' => $otherAmount,
	'MissionaryElectrificationRate' => $missionaryElectrificationRate,
	'MissionaryElectrificationAmount' => $missionaryElectrificationAmount,
	'NPCStrandedDebtsRate' => $npcStrandedDebtsRate,
	'NPCStrandedDebtsAmount' => $npcStrandedDebtsAmount,
	'NPCStrandedCostRate' => $npcStrandedCostRate,
	'NPCStrandedCostAmount' => $npcStrandedCostAmount,
	'EnvironmentalRate' => $environmentalRate,
	'EnvironmentalAmount' => $environmentalAmount,
	'TAFPPCARate' => $tafppcaRate,
	'TAFPPCAAmount' => $tafppcaAmount,
	'TAFXARate' => $tafxaRate,
	'TAFXAAmount' => $tafxaAmount,
	'GRAMRate' => $gramRate,
	'GRAMAmount' => $gramAmount,
	'ICERARate' => $iceraRate,
	'ICERAAmount' => $iceraAmount,
	'TransformerRentalRate' => $transformerRentalRate,
	'TransformerRentalAmount' => $transformerRentalAmount,
	'SCRate' => $scRate,
	'SCAmount' => $scAmount,
	'MandatoryReductionRate' => $mandatoryReductionRate,
	'MandatoryReductionAmount' => $mandatoryReductionAmount,
	'AmountDue' => $amountDue,
	'VATAmount' => $vatAmount,
	'TotalAmountDue' => $totalAmountDue,
	'KatasNgVAT' => $katasNgVat,
	'CurentAmountDue' => $currentAmountDue,
	'ArrearsNoMonth' => $arrearsNoMonth,
	'ArrearsTotal' => $arrearsTotal,
	'Discount' => $discount,
	'BIR2306' => $bir2306,
	'BIR2307' => $bir2307,
];

$pdf = new PDFMaker();
$pdf->setParams($model);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',10);
$pdf->Output('F', __DIR__ . '/files/' . 'Statement-of-Account-' . $acctNo . '-' . $period . '.pdf');
// $pdf->Output('D', 'test.pdf');

// $mail = new PHPMailer;
// //$mail->SMTPDebug = 2;
// $mail->isSMTP();
// $mail->Host = 'smtp.gmail.com';
// $mail->SMTPSecure = 'tls';
// $mail->Port = 587;
// $mail->SMTPAuth = true;
// $mail->isHTML(true);
// $mail->Username = 'boheco1mailer@gmail.com';
// $mail->Password = 'w@st3b@sk3t';
// $mail->setFrom('no-reply@gmail.com', "BOHECO I");
// $mail->addAddress($recipient, $recipient);
// $mail->Subject = 'BOHECO I PREPAYMENTS NOTIFICATION';
// $mail->Body = $body;
// $mail->AddAttachment(__DIR__ . '/files/' . 'Statement-of-Account-' . $acctNo . '-' . $period . '.pdf', 
// 					$name = 'Statement-of-Account-' . $acctNo . '-' . $period . '.pdf',  
// 					$encoding = 'base64', 
// 					$type = 'application/pdf');


// if ($mail->Send()) {
// 	echo "Sent";
// } else {
// 	echo "Not sent <br>" . $mail->ErrorInfo;
// }
?>
