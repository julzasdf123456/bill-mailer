$(document).ready(function() {
	/*
	 * ACTIVATING MENUS & SETTING TITLE
	 */
	var pathname = window.location.pathname;
	if (pathname == '/bill-mailer/billing.php') {
		$('#billing').addClass('active');
		$('#document-title').text('Bills | BOHECO I');
	} else if (pathname == '/bill-mailer/disconnections.php') {
		$('#disconnections').addClass('active');
		$('#document-title').text('Disconnections | BOHECO I');
	} else if (pathname == '/bill-mailer/new-email.php') {
		$('#document-title').text('Add New Email | BOHECO I');
	} else {
		$('#document-title').text('Bill Mailer | BOHECO I');
	}



	/*
	* INITALIZATIONS OF PLUGINS & SCRIPTS
	*/
	$('.sidenav').sidenav();
	$('.fixed-action-btn').floatingActionButton();
	$('select').formSelect();



	/*
	 * ADD NEW EMAIL EVENT
	 * ------------------------------------------
	 * 		Updates table [AccountMaster] in @Billing database in server ~config.parentIp
	 */
	$('#add-email-btn').on('click', function() {
		$('#add-email-loader').removeClass('hide');
		var acctNo = $('#accountNumber').val();
		var email = $('#email').val();
		var contact = $('#contact').val();
		$.ajax({
			url : config.parentIp + config.controllers + 'add-email.php?accountNumber=' + acctNo + '&email=' + email + '&contact=' + contact,
			success : function(response) {
				var data = JSON.parse(response);
				if (jQuery.isEmptyObject(data)) {
					alert('Account not found!');
				} else {
					if (data['response'] == 'ok') {
						M.toast({html: 'Email added successfully!'});
						$('#details').text('');
						$('#accountNumber').val("");
						$('#email').val("");
						$('#contact').val("");
					} else {
						alert('Database error critical! Contact IT immediately. Err: ' + data['response']);
					}
				}
				$('#add-email-loader').addClass('hide');
			},
			error : function(error) {
				alert(error);
				$('#add-email-loader').addClass('hide');
			}
		});
	});




	/*
	 *	ACCOUNT NUMBER FIELD COFUS OUT
	 * -----------------------------------------
	 * 		Displays the details of the inputted account number on <p> tag below the contact number field in new email menu
	 */
	$('#accountNumber').focusout(function() {
		$.ajax({
			url : config.parentIp + config.controllers + 'get-account-particulars.php?acctNo=' + this.value,
			success : function(json) {
				var data = JSON.parse(json);
				if (jQuery.isEmptyObject(data)) {
					$('#details').text('Account number not found!');
				} else {
					$('#details').text('Name: ' + data[0]['ConsumerName'] + ' - Address: ' + data[0]['ConsumerAddress']);					
					$('#email').val(jQuery.isEmptyObject(data[0]['Email']) ? '' : data[0]['Email']);
					$('#contact').val(jQuery.isEmptyObject(data[0]['ContactNumber']) ? '' : data[0]['ContactNumber']);
				}
				
			}, 
			error : function(error) {
				$('#details').text(error);
			}
		});
	});




	/*
	 * TOWN SELECTION EVENT
	 * -------------------------------------------
	 * 		Queries and displays all the accounts with emails in [AccountMaster] table 
	 *  -- RELATED METHODS
	 * 		1. addRowToBillingTable(accountNumber, accountName, email)
	 */
	$('#town-select').change(function() {
		$('#bills-table tbody tr').remove();
		$.ajax({
			url : config.parentIp + config.controllers + 'get-all-email.php?townCode=' + this.value,
			success : function(response) {
				var data = JSON.parse(response);
				if (jQuery.isEmptyObject(data)) {
					M.toast({html: 'No emails associated within this town.'});
					$('#emailTotal').text('');
				} else {
					var i = 0;
					$.each(data, function(index, element) {
						$('#bills-table tbody').append(addRowToBillingTable(data[index]['AccountNumber'], data[index]['AccountName'], data[index]['Email']));
						i++;
					});
					$('#emailTotal').text((i) + ' total email recipients');
				}
			},
			error : function(error) {
				alert(error);
			}
		});
	});




	/*
	 * addRowToBillingTable
	 * --------------------------------------
	 * 		- Appends a new row to email-account number table
	 *		@returs the whole table row <tr> containg the 1. accountNumber, 2. accountName, 3. email
	 */
	function addRowToBillingTable(accountNumber, accountName, email) {
		return '<tr id="' + accountNumber + '" title="' + accountNumber + '"><td>' + accountName + '</td><td>' + email + '</td></tr>'
	}




	/*
	 * SEND BILLS BUTTON EVENT
	 * ---------------------------------------
	 * 		Loops and sends all the SOA/bill details to automailer.boheco1.com (sub-domain) for processing, which then sends it to smtp.google.com (gmail SMTP servers)
	 * 	  -- RELATED METHODS
	 * 		1. splitEmails(emails)
	 */
	$('#send-bills-btn').on('click', function() {
		// show progress loader
		$('#send-email-loader').removeClass('hide');
		$('#send-loader-details').removeClass('hide');
		$('#send-loader-details').text('Connecting to @TonyStarkServers...');
		$(this).addClass('disabled');

		var mailBody = $('#bills-compose').val() == null ? 'Monthly BOHECO I Bill' : $('#bills-compose').val();
		var svcperiod = $('#period-select').val();
		// LOOP ALL EMAIL IN TABLE
		var i = 0;
		var totalTr = $('#bills-table tbody tr').length;

		// handler of the ajax loop
		var promises = [];

		// LOOP ALL ITEMS ON THE TABLE
		$('#bills-table tbody tr').each(function() {

			var emailRaw = $(this).find("td").eq(1).text();
			var accountNo = this.id;
			
			// LOOP ALL EMAILS OF ACCOUNS THAT HAS TWO OR MORE EMAIL
			var allEmails = splitEmails(emailRaw);
			for (var x = 0; x < allEmails.length; x++) {
				var email = allEmails[x];
				// Display progress
				$('#send-loader-details').text((i+1) + '/' + totalTr + ' emails sent (' + accountNo + ', ' + email + ')');

				var dataSets;

				// GET THE ALL THE FUCKIN ACCOUNT DETAILS ON EVERY ACCOUNT INSIDE THE LOOP THRU AJAX -_- Damn it.
				var sends = $.ajax({
					url : config.parentIp + config.controllers + 'get-account-details.php?period=' + svcperiod + '&acctNo=' + accountNo,
					success : function(response) {
						var data = JSON.parse(response);
						dataSets = data;

						// SEND EMAIL
						$.ajax({
							url : "https://automailer.boheco1.com/test-pdf.php?recipient=" + email  
																			+ "&body=" + mailBody 
																			+ "&acctNo=" + accountNo 
																			+ "&prevRead=" + dataSets[0]['PreviousReading']
																			+ "&presRead=" + dataSets[0]['PresentReading']
																			+ "&dateFrom=" + dataSets[0]['DateFrom'] 
																			+ "&consumerName=" + encodeURIComponent(dataSets[0]['ConsumerName'])
																			+ "&dateTo=" + dataSets[0]['DateTo']
																			+ "&consumerAddress=" + dataSets[0]['ConsumerAddress']
																			+ "&coreLoss=" + dataSets[0]['CoreLoss']
																			+ "&dueDate=" + dataSets[0]['DueDate']
																			+ "&route=" + dataSets[0]['Route']
																			+ "&demand=" + dataSets[0]['Demand']
																			+ "&period=" + dataSets[0]['Period']
																			+ "&meterNumber=" + dataSets[0]['MeterNumber']
																			+ "&multiplier=" + dataSets[0]['Multiplier'] 
																			+ "&billNumber=" + dataSets[0]['BillNumber'] 
																			+ "&consumerType=" + dataSets[0]['ConsumerType'] 
																			+ "&kwhUsed=" + dataSets[0]['KWHUsed'] 
																			+ "&generationSystemRate=" + dataSets[0]['GenerationSystemRate'] 
																			+ "&generationSystemAmount=" + dataSets[0]['GenerationSystemAmount'] 
																			+ "&transmissionDeliveryKWHRate=" + dataSets[0]['TransmissionDeliveryKWHRate'] 
																			+ "&transmissionDeliveryKWHAmount=" + dataSets[0]['TransmissionDeliveryKWHAmount'] 
																			+ "&transmissionDeliveryKWRate=" + dataSets[0]['TransmissionDeliveryKWRate'] 
																			+ "&transmissionDeliveryKWAmount=" + dataSets[0]['TransmissionDeliveryKWAmount'] 
																			+ "&systemLossRate=" + dataSets[0]['SystemLossRate'] 
																			+ "&systemLossAmount=" + dataSets[0]['SystemLossAmount'] 
																			+ "&lifelineSubsidyChargeRate=" + dataSets[0]['LifelineSubsidyChargeRate'] 
																			+ "&lifelineSubsidyChargeAmount=" + dataSets[0]['LifelineSubsidyChargeAmount'] 
																			+ "&rfscRate=" + dataSets[0]['RFSCRate'] 
																			+ "&rfscAmount=" + dataSets[0]['RFSCAmount'] 
																			+ "&fitAllRate=" + dataSets[0]['FitAllRate'] 
																			+ "&fitAllAmount=" + dataSets[0]['FitAllAmount'] 
																			+ "&otherChargesAmount=" + dataSets[0]['OtherChargesAmount'] 
																			+ "&distributionNetworkKWHRate=" + dataSets[0]['DistributionNetworkKWHRate'] 
																			+ "&distributionNetworkKWHAmount=" + dataSets[0]['DistributionNetworkKWHAmount'] 
																			+ "&distributionNetworkKWRate=" + dataSets[0]['DistributionNetworkKWRate'] 
																			+ "&distributionNetworkKWAmount=" + dataSets[0]['DistributionNetworkKWAmount'] 
																			+ "&retailElectricServiceKWHRate=" + dataSets[0]['RetailElectricServiceKWHRate'] 
																			+ "&retailElectricServiceKWHAmount=" + dataSets[0]['RetailElectricServiceKWHAmount'] 
																			+ "&retailElectricServiceKWRate=" + dataSets[0]['RetailElectricServiceKWRate'] 
																			+ "&retailElectricServiceKWAmount=" + dataSets[0]['RetailElectricServiceKWAmount'] 
																			+ "&meteringChargeRate=" + dataSets[0]['MeteringChargeRate'] 
																			+ "&meteringChargeAmount=" + dataSets[0]['MeteringChargeAmount'] 
																			+ "&meteringRetailRate=" + dataSets[0]['MeteringRetailRate'] 
																			+ "&meteringRetailAmount=" + dataSets[0]['MeteringRetailAmount'] 
																			+ "&generationRate=" + dataSets[0]['GenerationRate'] 
																			+ "&generationAmount=" + dataSets[0]['GenerationAmount'] 
																			+ "&transmissionRate=" + dataSets[0]['TransmissionRate'] 
																			+ "&transmissionAmount=" + dataSets[0]['TransmissionAmount'] 
																			+ "&systemLossKWHRate=" + dataSets[0]['SystemLossKWHRate'] 
																			+ "&systemLossKWHAmount=" + dataSets[0]['SystemLossKWHAmount'] 
																			+ "&distributionRate=" + dataSets[0]['DistributionRate'] 
																			+ "&distributionAmount=" + dataSets[0]['DistributionAmount'] 
																			+ "&daaRate=" + dataSets[0]['DAARate'] 
																			+ "&daaAmount=" + dataSets[0]['DAAAmount'] 
																			+ "&acrmRate=" + dataSets[0]['ACRMRate'] 
																			+ "&acrmAmount=" + dataSets[0]['ACRMAmount'] 
																			+ "&otherRate=" + dataSets[0]['OtherRate'] 
																			+ "&otherAmount=" + dataSets[0]['OtherAmount'] 
																			+ "&missionaryElectrificationRate=" + dataSets[0]['MissionaryElectrificationRate'] 
																			+ "&missionaryElectrificationAmount=" + dataSets[0]['MissionaryElectrificationAmount'] 
																			+ "&npcStrandedDebtsRate=" + dataSets[0]['NPCStrandedDebtsRate'] 
																			+ "&npcStrandedDebtsAmount=" + dataSets[0]['NPCStrandedDebtsAmount'] 
																			+ "&npcStrandedCostRate=" + dataSets[0]['NPCStrandedCostRate'] 
																			+ "&npcStrandedCostAmount=" + dataSets[0]['NPCStrandedCostAmount'] 
																			+ "&environmentalRate=" + dataSets[0]['EnvironmentalRate'] 
																			+ "&environmentalAmount=" + dataSets[0]['EnvironmentalAmount'] 
																			+ "&tafppcaRate=" + dataSets[0]['TAFPPCARate'] 
																			+ "&tafppcaAmount=" + dataSets[0]['TAFPPCAAmount'] 
																			+ "&tafxaRate=" + dataSets[0]['TAFXARate'] 
																			+ "&tafxaAmount=" + dataSets[0]['TAFXAAmount'] 
																			+ "&gramRate=" + dataSets[0]['GRAMRate'] 
																			+ "&gramAmount=" + dataSets[0]['GRAMAmount'] 
																			+ "&iceraRate=" + dataSets[0]['ICERARate'] 
																			+ "&iceraAmount=" + dataSets[0]['ICERAAmount'] 
																			+ "&transformerRentalRate=" + dataSets[0]['TransformerRentalRate'] 
																			+ "&transformerRentalAmount=" + dataSets[0]['TransformerRentalAmount'] 
																			+ "&scRate=" + dataSets[0]['SCRate'] 
																			+ "&scAmount=" + dataSets[0]['SCAmount'] 
																			+ "&mandatoryReductionRate=" + dataSets[2]['MandatoryReductionRate'] 
																			+ "&mandatoryReductionAmount=" + dataSets[0]['MandatoryReductionAmount'] 
																			+ "&amountDue=" + dataSets[0]['AmountDue'] 
																			+ "&vatAmount=" + dataSets[0]['VATAmount'] 
																			+ "&totalAmountDue=" + dataSets[0]['TotalAmountDue'] 
																			+ "&katasNgVat=" + dataSets[0]['KatasNgVAT'] 
																			+ "&currentAmountDue=" + dataSets[0]['CurentAmountDue'] 
																			+ "&arrearsNoMonth=" + dataSets[0]['ArrearsNoMonth'] 
																			+ "&arrearsTotal=" + dataSets[0]['ArrearsTotal'] 
																			+ "&discount=" + dataSets[1]['Discount'] 
																			+ "&bir2306=" + dataSets[1]['BIR2306'] 
																			+ "&bir2307=" + dataSets[1]['BIR2307'],
							success : function(response) {
								//alert(response);
								if (response == 'Sent') {
									//alert('Sent');
									console.log('sent');

								} else {
									//alert(response);
									console.log(response);
								}			
							},
							error : function (error) {
								alert(error);
							}
						});
					}
				});
			}				
			i++;	
			promises.push(sends);		
		});

		$.when.apply(null, promises).done(function(){
			   // hide progress loader
			$('#send-email-loader').addClass('hide');
			$('#send-loader-details').text('All SOA mails sent!');
			$('#send-bills-btn').removeClass('disabled');
		});
		
	});



	
	/* 
	 * splitEmails (emails)
	 *		- Splits multiple emails of an account number using comma (,) as a separator
	 *		@returns an array of emails
	 */
	function splitEmails(emails) {
		var iMails = emails.split(",");
		return iMails;
	}
});
