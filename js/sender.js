$(document).ready(function() {

	$('#test-email').on('click', function() {

		// 1.) GET ALL THE ACCOUNT WITH EMAILS

		// 2.) LOOP ALL THE ACCOUNTS

			// 2.1) AJAX QUERY THE CURRENT ACCOUNT ON THE LOOP

			// 2.2) AJAX SEND THE BILL
		$.ajax({
			url : "https://automailer.boheco1.com/test-pdf.php?recipient=julzasdf123456@gmail.com&body=SOA&acctNo=0101062555&prevRead=6814935&presRead=6893505&dateFrom=2019-12-26&consumerName=BOHOL+AGRO-MARINE+CORPORATION&dateTo=2020-01-25&consumerAddress=POBLACION+TUBIGON&coreLoss=0.0&dueDate=2020-02-08&route=2701&demand=266.28&period=Jan+2020&meterNumber=205029059202001&multiplier=1.0&billNumber=20435002&consumerType=I&kwhUsed=78570.00&generationSystemRate=4.8108&generationSystemAmount=377984.56&transmissionDeliveryKWHRate=0.0&transmissionDeliveryKWHAmount=0.0&transmissionDeliveryKWRate=394.04&transmissionDeliveryKWAmount=104925.59&systemLossRate=0.3843&systemLossAmount=30194.45&lifelineSubsidyChargeRate=0.0123&lifelineSubsidyChargeAmount=966.41&rfscRate=0.2904&rfscAmount=22816.73&fitAllRate=0.2226&fitAllAmount=17489.68&otherChargesAmount=0.00&distributionNetworkKWHRate=0.0&distributionNetworkKWHAmount=0.0&distributionNetworkKWRate=219.68&distributionNetworkKWAmount=58496.39&retailElectricServiceKWHRate=0.0&retailElectricServiceKWHAmount=0.0&retailElectricServiceKWRate=42.920&retailElectricServiceKWAmount=42.92&meteringChargeRate=0.0&meteringChargeAmount=0.0&meteringRetailRate=35.940&meteringRetailAmount=35.94&generationRate=0.3379&generationAmount=26548.80&transmissionRate=0.0866&transmissionAmount=6804.16&systemLossKWHRate=0.0285&systemLossKWHAmount=2239.25&distributionRate=0.1200&distributionAmount=6600.04&daaRate=0.0020&daaAmount=154.78&acrmRate=0.0007&acrmAmount=57.36&otherRate=0.1200&otherAmount=505.89&missionaryElectrificationRate=0.1561&missionaryElectrificationAmount=12264.78&npcStrandedDebtsRate=0.0428&npcStrandedDebtsAmount=3362.80&npcStrandedCostRate=0.0543&npcStrandedCostAmount=4266.35&environmentalRate=0.0025&environmentalAmount=196.43&tafppcaRate=0.0304&tafppcaAmount=2390.89&tafxaRate=0.0&tafxaAmount=0.0&gramRate=0.0891&gramAmount=7001.37&iceraRate=0.0&iceraAmount=0.0&transformerRentalRate=4200.00&transformerRentalAmount=4200.00&scRate=0.0002&scAmount=15.71&mandatoryReductionRate=0.0578&mandatoryReductionAmount=-4541.35&amountDue=642109.63&vatAmount=42910.27&totalAmountDue=685019.00&katasNgVat=0.0",
			success : function(response) {
				alert(response);
				if (response == 'Sent') {
					$('#notif').text('Sent');
				} else {
					$('#notif').text('Not sent, obviously.');
					alert(response);
				}			
			},
			error : function (error) {
				$('#notif').text('Not sent, obviously.');
				alert(error);
			}
		});


		function generateHTMLBody() {
			return '<div class="container">' +
						'<h1>Test Bill</h1>' +
						'<p>This is a test email with a test HTML body.</p>' +
					'</div>' ;
		}
	});

		
});