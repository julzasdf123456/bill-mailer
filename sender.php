<?php 
require 'PHPMailer/PHPMailerAutoload.php';
require 'config/billing-db.php';
require 'PDFMaker.php';

/**
 *  @PARAMS
 *  $recipient 		= The email of the recipient, obviously
 *  $body 			= The body of the email. Could be HTML, could be raw text
 * 	$accountNo		= The account number of the recipient
 *  $period 		= The service period of the bill that's about to be sent
 * 	$isDiscounted 	= YES if discounted, NO if not
 *  $is2306			= YES if 2306 is enabled, NO if not (really? do I need to specify each and every one of these fuckers up)
 *  $is2307			= YES if 2307 is enabled, NO if not (okay I'm done)
 */

$recipient = $_GET['recipient'];
$body = $_GET['body'];
$accountNo = $_GET['accountNo'];
$period = $_GET['period'];

/**
 * GENERATE PDF FIRST
 */
$pdf = new PDFMaker;
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',10);
$pdf->Output('F', __DIR__ . '/files/' . 'Statement-of-Account-' . $accountNo . '-' . $period . '.pdf');


$mail = new PHPMailer;
//$mail->SMTPDebug = 2;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->isHTML(true);
$mail->Username = 'boheco1mailer@gmail.com';
$mail->Password = 'w@st3b@sk3t';
$mail->setFrom('no-reply@gmail.com', "BOHECO I");
$mail->addAddress($recipient, $recipient);
$mail->Subject = 'BOHECO I PREPAYMENTS NOTIFICATION';
$mail->Body = $body;
$mail->AddAttachment(__DIR__ . '/files/' . 'Statement-of-Account-' . $accountNo . '-' . $period . '.pdf', 
					$name = 'Statement-of-Account-' . $accountNo . '-' . $period . '.pdf',  
					$encoding = 'base64', 
					$type = 'application/pdf');


if ($mail->Send()) {
	echo "Sent";
} else {
	echo "Not sent <br>" . $mail->ErrorInfo;
}

?>