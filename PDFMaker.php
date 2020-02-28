<?php 

require('FPDF/fpdf.php');

class PDFMaker extends FPDF {

	const H1_SIZE = 9;
	const REG_SIZE = 8;
	const DUE_SIZE = 10;

	public $model = [];

	function setParams($model) {
		$this->model = $model;
	}

	/**
	 * Inserts header
	 */
	function Header() {
		$this->Image('img/boheco-1-logo.png', 50, 6, 20);

		$this->SetFont('Times', 'B', PDFMaker::H1_SIZE);
		$this->Cell(80);
		$this->Cell(30, 0, 'BOHOL I ELECTRIC COOPERATIVE, INC.', 0, 0, 'C');

		$this->SetFont('Times', '', PDFMaker::REG_SIZE);
		$this->Ln(4);
		$this->Cell(80);
		$this->Cell(30, 0, 'Cabulijan, Tubigon, Bohol', 0, 0, 'C');
		$this->Ln(4);
		$this->Cell(80);
		$this->Cell(30, 0, 'Tel. Nos. (038) 508-9731 * 508-9751 * 508-9741', 0, 0, 'C');
		$this->Ln(4);
		$this->Cell(80);
		$this->Cell(30, 0, 'VAT REG. TIN: 000-534-418-000', 0, 0, 'C');

		$this->Ln(8);
		$this->SetFont('Times', 'B', PDFMaker::H1_SIZE);
		$this->Cell(80);
		$this->Cell(30, 0, 'STATEMENT OF ACCOUNT', 0, 0, 'C');

		/**
		* CONTENTS
		*/

		// ROW 1
		$this->SetFont('Times', '', PDFMaker::REG_SIZE);
		$this->Ln(8);
		$this->Cell(1);
		$this->Cell(28, 4, 'Questions or concerns?', 1, 0, 'C');
		$this->Cell(1);
		$this->Cell(22, 4, 'Account Number:', 0, 0, 'R');
		$this->Cell(1);
		$this->Cell(58, 4, $this->model['AccountNumber'], 0, 0, 'L');
		$this->Cell(12);
		$this->Cell(8, 4, 'Prev. Reading:', 0, 0, 'R');
		$this->Cell(1);
		$this->Cell(18, 4, $this->model['PreviousReading'], 0, 0, 'L');
		$this->Cell(6);
		$this->Cell(8, 4, 'Date From:', 0, 0, 'R');
		$this->Cell(1);
		$this->Cell(18, 4, $this->model['DateFrom'], 0, 0, 'L');

		// ROW 2
		$this->Ln(4);
		$this->Cell(1);
		$this->Cell(28, 4, 'Please Contact Us', 0, 0, 'C');
		$this->Cell(1);
		$this->Cell(22, 4, 'Consumer Name:', 0, 0, 'R');
		$this->Cell(1);
		$this->Cell(58, 4, $this->model['ConsumerName'], 0, 0, 'L');
		$this->Cell(12);
		$this->Cell(8, 4, 'Pres. Reading:', 0, 0, 'R');
		$this->Cell(1);
		$this->Cell(18, 4, $this->model['PresentReading'], 0, 0, 'L');
		$this->Cell(6);
		$this->Cell(8, 4, 'Date To:', 0, 0, 'R');
		$this->Cell(1);
		$this->Cell(18, 4, $this->model['DateTo'], 0, 0, 'L');

		// ROW 3
		$this->Ln(4);
		$this->Cell(1);
		$this->Cell(28, 4, 'anytime at these', 0, 0, 'C');
		$this->Cell(1);
		$this->Cell(22, 4, 'Consumer Address:', 0, 0, 'R');
		$this->Cell(1);
		$this->Cell(58, 4, $this->model['ConsumerAddress'], 0, 0, 'L');
		$this->Cell(12);
		$this->Cell(8, 4, 'Core Loss:', 0, 0, 'R');
		$this->Cell(1);
		$this->Cell(18, 4, $this->model['CoreLoss'], 0, 0, 'L');
		$this->Cell(6);
		$this->Cell(8, 4, 'Due Date:', 0, 0, 'R');
		$this->Cell(1);
		$this->Cell(18, 4, $this->model['DueDate'], 0, 0, 'L');

		// ROW 4
		$this->Ln(4);
		$this->Cell(1);
		$this->Cell(28, 4, 'following numbers:', 0, 0, 'C');
		$this->Cell(1);
		$this->Cell(22, 4, 'Route:', 0, 0, 'R');
		$this->Cell(1);
		$this->Cell(58, 4, $this->model['Route'], 0, 0, 'L');
		$this->Cell(12);
		$this->Cell(8, 4, 'Demand:', 0, 0, 'R');
		$this->Cell(1);
		$this->Cell(18, 4, $this->model['Demand'], 0, 0, 'L');
		$this->Cell(6);
		$this->Cell(8, 4, 'Period:', 0, 0, 'R');
		$this->Cell(1);
		$this->Cell(18, 4, $this->model['Period'], 0, 0, 'L');

		// ROW 5
		$this->Ln(4);
		$this->Cell(1);
		$this->Cell(28, 4, '(038)508-9731 * 508-', 0, 0, 'C');
		$this->Cell(1);
		$this->Cell(22, 4, 'Meter Number:', 0, 0, 'R');
		$this->Cell(1);
		$this->Cell(58, 4, $this->model['MeterNumber'], 0, 0, 'L');
		$this->Cell(12);
		$this->Cell(8, 4, 'Multiplier:', 0, 0, 'R');
		$this->Cell(1);
		$this->Cell(18, 4, $this->model['Multiplier'], 0, 0, 'L');
		$this->Cell(6);
		$this->Cell(8, 4, 'Bill Number:', 0, 0, 'R');
		$this->Cell(1);
		$this->Cell(18, 4, $this->model['BillNumber'], 0, 0, 'L');

		// ROW 6
		$this->Ln(4);
		$this->Cell(1);
		$this->Cell(28, 4, '9751 * 508-9741', 0, 0, 'C');
		$this->Cell(1);
		$this->Cell(22, 4, 'Consumer Type:', 0, 0, 'R');
		$this->Cell(1);
		$this->Cell(58, 4, $this->model['ConsumerType'], 0, 0, 'L');
		$this->Cell(12);
		$this->Cell(8, 4, 'KWH Used:', 0, 0, 'R');
		$this->Cell(1);
		$this->Cell(18, 4, $this->model['KWHUsed'], 0, 0, 'L');

		$this->Line(10, 63, 200, 63);

		// ROW 7 (CHARGES, RATE, AMOUNT Heading)
		$this->Ln(6);
		$this->SetFont('Times', 'B', PDFMaker::REG_SIZE);
		$this->Cell(6);
		$this->Cell(22, 4, 'CHARGES', 0, 0, 'R');
		$this->Cell(20);
		$this->Cell(14, 4, 'RATE', 0, 0, 'R');
		$this->Cell(6);
		$this->Cell(14, 4, 'AMOUNT', 0, 0, 'R');
		$this->Cell(22);
		$this->Cell(22, 4, 'CHARGES', 0, 0, 'R');
		$this->Cell(20);
		$this->Cell(14, 4, 'RATE', 0, 0, 'R');
		$this->Cell(6);
		$this->Cell(14, 4, 'AMOUNT', 0, 0, 'R');

		// ROW 8 (Generation Charges & Other Charges)
		$this->Ln(5);
		$this->Cell(1);
		$this->Cell(22, 4, 'Generation Charges', 0, 0, '');
		$this->Cell(66);
		$this->Cell(22, 4, 'Other Charges', 0, 0, '');

		// ROW 9
		$this->Ln(4);
		$this->SetFont('Times', '', PDFMaker::REG_SIZE);
		$this->Cell(4);
		$this->Cell(22, 4, 'Generation System', 0, 0, '');
		$this->Cell(11);
		$this->Cell(13, 4, 'Per KWH', 0, 0, '');
		$this->Cell(1);
		$this->Cell(12, 4, $this->model['GenerationSystemRate'], 0, 0, '');
		$this->Cell(3);
		$this->Cell(16, 4, number_format($this->model['GenerationSystemAmount'], 2), 0, 0, 'R');
		$this->Cell(10);
		$this->Cell(32, 4, 'Lifeline Subsidy Charge(Discount)', 0, 0, '');
		$this->Cell(12);
		$this->Cell(13, 4, 'Per KWH', 0, 0, '');
		$this->Cell(1);
		$this->Cell(12, 4, $this->model['LifelineSubsidyChargeRate'], 0, 0, '');
		$this->Cell(3);
		$this->Cell(16, 4, number_format($this->model['LifelineSubsidyChargeAmount'], 2), 0, 0, 'R');

		// ROW 10
		$this->Ln(4);
		$this->Cell(4);
		$this->Cell(22, 4, 'Transmission Delivery', 0, 0, '');
		$this->Cell(11);
		$this->Cell(13, 4, 'Per KWH', 0, 0, '');
		$this->Cell(1);
		$this->Cell(12, 4, $this->model['TransmissionDeliveryKWHRate'], 0, 0, '');
		$this->Cell(3);
		$this->Cell(16, 4, number_format($this->model['TransmissionDeliveryKWHAmount'], 2), 0, 0, 'R');
		$this->Cell(10);
		$this->Cell(32, 4, 'RFSC', 0, 0, '');
		$this->Cell(12);
		$this->Cell(13, 4, 'Per KWH', 0, 0, '');
		$this->Cell(1);
		$this->Cell(12, 4, $this->model['RFSCRate'], 0, 0, '');
		$this->Cell(3);
		$this->Cell(16, 4, number_format($this->model['RFSCAmount'], 2), 0, 0, 'R');

		// ROW 11
		$this->Ln(4);
		$this->Cell(4);
		$this->Cell(22, 4, 'Transmission Delivery', 0, 0, '');
		$this->Cell(11);
		$this->Cell(13, 4, 'Per KW', 0, 0, '');
		$this->Cell(1);
		$this->Cell(12, 4, $this->model['TransmissionDeliveryKWRate'], 0, 0, '');
		$this->Cell(3);
		$this->Cell(16, 4, number_format($this->model['TransmissionDeliveryKWAmount'], 2), 0, 0, 'R');
		$this->Cell(10);
		$this->Cell(32, 4, 'Feed-In Tariff Allow(FIT-ALL)', 0, 0, '');
		$this->Cell(12);
		$this->Cell(13, 4, 'Per KWH', 0, 0, '');
		$this->Cell(1);
		$this->Cell(12, 4, $this->model['FitAllRate'], 0, 0, '');
		$this->Cell(3);
		$this->Cell(16, 4, number_format($this->model['FitAllAmount'], 2), 0, 0, 'R');

		// ROW 12
		$this->Ln(4);
		$this->Cell(4);
		$this->Cell(22, 4, 'System Loss', 0, 0, '');
		$this->Cell(11);
		$this->Cell(13, 4, 'Per KWH', 0, 0, '');
		$this->Cell(1);
		$this->Cell(12, 4, $this->model['SystemLossRate'], 0, 0, '');
		$this->Cell(3);
		$this->Cell(16, 4, number_format($this->model['SystemLossAmount'], 2), 0, 0, 'R');
		$this->Cell(10);
		$this->Cell(32, 4, 'Other Charges', 0, 0, '');
		$this->Cell(12);
		$this->Cell(13, 4, 'Per KWH', 0, 0, '');
		$this->Cell(1);
		$this->Cell(12, 4, '', 0, 0, '');
		$this->Cell(3);
		$this->Cell(16, 4, number_format($this->model['OtherChargesAmount'], 2), 0, 0, 'R');

		// ROW 13 (Distribution Charges & VAT Charges)
		$this->Ln(5);
		$this->SetFont('Times', 'B', PDFMaker::REG_SIZE);
		$this->Cell(1);
		$this->Cell(22, 4, 'Distribution Charges', 0, 0, '');
		$this->Cell(66);
		$this->Cell(22, 4, 'VAT Charges', 0, 0, '');

		// ROW 14
		$this->Ln(4);
		$this->SetFont('Times', '', PDFMaker::REG_SIZE);
		$this->Cell(4);
		$this->Cell(22, 4, 'Distribution Network', 0, 0, '');
		$this->Cell(11);
		$this->Cell(13, 4, 'Per KWH', 0, 0, '');
		$this->Cell(1);
		$this->Cell(12, 4, $this->model['DistributionNetworkKWHRate'], 0, 0, '');
		$this->Cell(3);
		$this->Cell(16, 4, number_format($this->model['DistributionNetworkKWHAmount'], 2), 0, 0, 'R');
		$this->Cell(10);
		$this->Cell(32, 4, 'Generation', 0, 0, '');
		$this->Cell(12);
		$this->Cell(13, 4, 'Per KWH', 0, 0, '');
		$this->Cell(1);
		$this->Cell(12, 4, $this->model['GenerationRate'], 0, 0, '');
		$this->Cell(3);
		$this->Cell(16, 4, number_format($this->model['GenerationAmount'], 2), 0, 0, 'R');

		// ROW 15
		$this->Ln(4);
		$this->Cell(4);
		$this->Cell(22, 4, 'Distribution Network', 0, 0, '');
		$this->Cell(11);
		$this->Cell(13, 4, 'Per KW', 0, 0, '');
		$this->Cell(1);
		$this->Cell(12, 4, $this->model['DistributionNetworkKWRate'], 0, 0, '');
		$this->Cell(3);
		$this->Cell(16, 4, number_format($this->model['DistributionNetworkKWAmount'], 2), 0, 0, 'R');
		$this->Cell(10);
		$this->Cell(32, 4, 'Transmission', 0, 0, '');
		$this->Cell(12);
		$this->Cell(13, 4, 'Per KWH', 0, 0, '');
		$this->Cell(1);
		$this->Cell(12, 4, $this->model['TransmissionRate'], 0, 0, '');
		$this->Cell(3);
		$this->Cell(16, 4, number_format($this->model['TransmissionAmount'], 2), 0, 0, 'R');

		// ROW 16
		$this->Ln(4);
		$this->Cell(4);
		$this->Cell(22, 4, 'Retail Electric Service', 0, 0, '');
		$this->Cell(11);
		$this->Cell(13, 4, 'Per KWH', 0, 0, '');
		$this->Cell(1);
		$this->Cell(12, 4, $this->model['RetailElectricServiceKWHRate'], 0, 0, '');
		$this->Cell(3);
		$this->Cell(16, 4, number_format($this->model['RetailElectricServiceKWHAmount'], 2), 0, 0, 'R');
		$this->Cell(10);
		$this->Cell(32, 4, 'System Loss', 0, 0, '');
		$this->Cell(12);
		$this->Cell(13, 4, 'Per KWH', 0, 0, '');
		$this->Cell(1);
		$this->Cell(12, 4, $this->model['SystemLossKWHRate'], 0, 0, '');
		$this->Cell(3);
		$this->Cell(16, 4, number_format($this->model['SystemLossKWHAmount'], 2), 0, 0, 'R');

		// ROW 17
		$this->Ln(4);
		$this->Cell(4);
		$this->Cell(22, 4, 'Retail Electric Service', 0, 0, '');
		$this->Cell(11);
		$this->Cell(13, 4, 'Per', 0, 0, '');
		$this->Cell(1);
		$this->Cell(12, 4, $this->model['RetailElectricServiceKWRate'], 0, 0, '');
		$this->Cell(3);
		$this->Cell(16, 4, number_format($this->model['RetailElectricServiceKWAmount'], 2), 0, 0, 'R');
		$this->Cell(10);
		$this->Cell(32, 4, 'Distribution', 0, 0, '');
		$this->Cell(12);
		$this->Cell(13, 4, 'Per KWH', 0, 0, '');
		$this->Cell(1);
		$this->Cell(12, 4, $this->model['DistributionRate'], 0, 0, '');
		$this->Cell(3);
		$this->Cell(16, 4, number_format($this->model['DistributionAmount'], 2), 0, 0, 'R');

		// ROW 18
		$this->Ln(4);
		$this->Cell(4);
		$this->Cell(22, 4, 'Metering System Charge', 0, 0, '');
		$this->Cell(11);
		$this->Cell(13, 4, 'Per KWH', 0, 0, '');
		$this->Cell(1);
		$this->Cell(12, 4, $this->model['MeteringChargeRate'], 0, 0, '');
		$this->Cell(3);
		$this->Cell(16, 4, number_format($this->model['MeteringChargeAmount'], 2), 0, 0, 'R');
		$this->Cell(10);
		$this->Cell(32, 4, 'DAA', 0, 0, '');
		$this->Cell(12);
		$this->Cell(13, 4, 'Per KWH', 0, 0, '');
		$this->Cell(1);
		$this->Cell(12, 4, $this->model['DAARate'], 0, 0, '');
		$this->Cell(3);
		$this->Cell(16, 4, number_format($this->model['DAAAmount'], 2), 0, 0, 'R');

		// ROW 19
		$this->Ln(4);
		$this->Cell(4);
		$this->Cell(22, 4, 'Metering Retail Cust.', 0, 0, '');
		$this->Cell(11);
		$this->Cell(13, 4, 'Per', 0, 0, '');
		$this->Cell(1);
		$this->Cell(12, 4, $this->model['MeteringRetailRate'], 0, 0, '');
		$this->Cell(3);
		$this->Cell(16, 4, number_format($this->model['MeteringRetailAmount'], 2), 0, 0, 'R');		
		$this->Cell(10);
		$this->Cell(32, 4, 'ACRM', 0, 0, '');
		$this->Cell(12);
		$this->Cell(13, 4, 'Per KWH', 0, 0, '');
		$this->Cell(1);
		$this->Cell(12, 4, $this->model['ACRMRate'], 0, 0, '');
		$this->Cell(3);
		$this->Cell(16, 4, number_format($this->model['ACRMAmount'], 2), 0, 0, 'R');
		$this->Ln(4);
		$this->Cell(92);
		$this->Cell(32, 4, 'Other', 0, 0, '');
		$this->Cell(12);
		$this->Cell(13, 4, 'Per KWH', 0, 0, '');
		$this->Cell(1);
		$this->Cell(12, 4, $this->model['OtherRate'], 0, 0, '');
		$this->Cell(3);
		$this->Cell(16, 4, number_format($this->model['OtherAmount'], 2), 0, 0, 'R');

		// ROW 20 (Universal Charges & Other)
		$this->Ln(5);
		$this->SetFont('Times', 'B', PDFMaker::REG_SIZE);
		$this->Cell(1);
		$this->Cell(22, 4, 'Universal Charges', 0, 0, '');
		$this->Cell(66);
		$this->Cell(22, 4, 'QC/EP/PC', 0, 0, '');

		// ROW 21
		$this->Ln(4);
		$this->SetFont('Times', '', PDFMaker::REG_SIZE);
		$this->Cell(4);
		$this->Cell(22, 4, 'Missionary Electrification', 0, 0, '');
		$this->Cell(11);
		$this->Cell(13, 4, 'Per KWH', 0, 0, '');
		$this->Cell(1);
		$this->Cell(12, 4, $this->model['MissionaryElectrificationRate'], 0, 0, '');
		$this->Cell(3);
		$this->Cell(16, 4, number_format($this->model['MissionaryElectrificationAmount'], 2), 0, 0, 'R');
		$this->SetFont('Times', 'B', PDFMaker::REG_SIZE);
		$this->Cell(7);
		$this->Cell(22, 4, 'Transformer Rental', 0, 0, '');				
		$this->SetFont('Times', '', PDFMaker::REG_SIZE);
		$this->Cell(25);
		$this->Cell(13, 4, 'Per Month', 0, 0, '');
		$this->Cell(1);
		$this->Cell(12, 4, $this->model['TransformerRentalRate'], 0, 0, '');
		$this->Cell(3);
		$this->Cell(16, 4, number_format($this->model['TransformerRentalAmount'], 2), 0, 0, 'R');

		// ROW 22
		$this->Ln(4);
		$this->Cell(4);
		$this->Cell(22, 4, 'NPC Stranded Debts', 0, 0, '');
		$this->Cell(11);
		$this->Cell(13, 4, 'Per KWH', 0, 0, '');
		$this->Cell(1);
		$this->Cell(12, 4, $this->model['NPCStrandedDebtsRate'], 0, 0, '');
		$this->Cell(3);
		$this->Cell(16, 4, number_format($this->model['NPCStrandedDebtsAmount'], 2), 0, 0, 'R');
		$this->SetFont('Times', 'B', PDFMaker::REG_SIZE);
		$this->Cell(7);
		$this->Cell(22, 4, 'Senior Citizen Subsidy(Discount)', 0, 0, '');		
		$this->SetFont('Times', '', PDFMaker::REG_SIZE);
		$this->Cell(25);
		$this->Cell(13, 4, '', 0, 0, '');
		$this->Cell(1);
		$this->Cell(12, 4, $this->model['SCRate'], 0, 0, '');
		$this->Cell(3);
		$this->Cell(16, 4, number_format($this->model['SCAmount'], 2), 0, 0, 'R');

		// ROW 23
		$this->Ln(4);
		$this->Cell(4);
		$this->Cell(22, 4, 'NPC Stranded Con. Cost', 0, 0, '');
		$this->Cell(11);
		$this->Cell(13, 4, 'Per KWH', 0, 0, '');
		$this->Cell(1);
		$this->Cell(12, 4, $this->model['NPCStrandedCostRate'], 0, 0, '');
		$this->Cell(3);
		$this->Cell(16, 4, number_format($this->model['NPCStrandedCostAmount'], 2), 0, 0, 'R');
		$this->SetFont('Times', 'B', PDFMaker::REG_SIZE);
		$this->Cell(7);
		$this->Cell(22, 4, 'Mandatory Rate Reduction', 0, 0, '');	
		$this->SetFont('Times', '', PDFMaker::REG_SIZE);
		$this->Cell(25);
		$this->Cell(13, 4, 'Per KWH', 0, 0, '');
		$this->Cell(1);
		$this->Cell(12, 4, $this->model['MandatoryReductionRate'], 0, 0, '');
		$this->Cell(3);
		$this->Cell(16, 4, number_format($this->model['MandatoryReductionAmount'], 2), 0, 0, 'R');

		// ROW 24
		$this->Ln(4);
		$this->Cell(4);
		$this->Cell(22, 4, 'Environmental', 0, 0, '');
		$this->Cell(11);
		$this->Cell(13, 4, 'Per KWH', 0, 0, '');
		$this->Cell(1);
		$this->Cell(12, 4, $this->model['EnvironmentalRate'], 0, 0, '');
		$this->Cell(3);
		$this->Cell(16, 4, number_format($this->model['EnvironmentalAmount'], 2), 0, 0, 'R');
		$this->SetFont('Times', 'B', PDFMaker::REG_SIZE);
		$this->Cell(7);
		$this->Cell(22, 4, 'Amount Due', 0, 0, '');			
		$this->SetFont('Times', '', PDFMaker::REG_SIZE);
		$this->Cell(25);
		$this->Cell(13, 4, '', 0, 0, '');
		$this->Cell(1);
		$this->Cell(12, 4, '', 0, 0, '');
		$this->Cell(3);
		$this->Cell(16, 4, number_format($this->model['AmountDue'], 2), 0, 0, 'R');

		// ROW 25
		$this->Ln(4);
		$this->Cell(4);
		$this->Cell(22, 4, 'ACRM - TAFPPCA', 0, 0, '');
		$this->Cell(11);
		$this->Cell(13, 4, 'Per KWH', 0, 0, '');
		$this->Cell(1);
		$this->Cell(12, 4, $this->model['TAFPPCARate'], 0, 0, '');
		$this->Cell(3);
		$this->Cell(16, 4, number_format($this->model['TAFPPCAAmount'], 2), 0, 0, 'R');
		$this->SetFont('Times', 'B', PDFMaker::REG_SIZE);
		$this->Cell(7);
		$this->Cell(22, 4, 'VAT Amount', 0, 0, '');		
		$this->SetFont('Times', '', PDFMaker::REG_SIZE);
		$this->Cell(25);
		$this->Cell(13, 4, '', 0, 0, '');
		$this->Cell(1);
		$this->Cell(12, 4, '', 0, 0, '');
		$this->Cell(3);
		$this->Cell(16, 4, number_format($this->model['VATAmount'], 2), 0, 0, 'R');


		// ROW 26
		$this->Ln(4);
		$this->Cell(4);
		$this->Cell(22, 4, 'ACRM - TAFxA', 0, 0, '');
		$this->Cell(11);
		$this->Cell(13, 4, 'Per KWH', 0, 0, '');
		$this->Cell(1);
		$this->Cell(12, 4, $this->model['TAFXARate'], 0, 0, '');
		$this->Cell(3);
		$this->Cell(16, 4, number_format($this->model['TAFXAAmount'], 2), 0, 0, 'R');
		$this->SetFont('Times', 'B', PDFMaker::REG_SIZE);
		$this->Cell(7);
		$this->Cell(22, 4, 'Total Amount Due', 0, 0, '');		
		$this->SetFont('Times', '', PDFMaker::REG_SIZE);
		$this->Cell(25);
		$this->Cell(13, 4, '', 0, 0, '');
		$this->Cell(1);
		$this->Cell(12, 4, '', 0, 0, '');
		$this->Cell(3);
		$this->Cell(16, 4, number_format($this->model['TotalAmountDue'], 2), 0, 0, 'R');

		// ROW 27
		$this->Ln(4);
		$this->Cell(4);
		$this->Cell(22, 4, 'DAA - GRAM', 0, 0, '');
		$this->Cell(11);
		$this->Cell(13, 4, 'Per KWH', 0, 0, '');
		$this->Cell(1);
		$this->Cell(12, 4, $this->model['GRAMRate'], 0, 0, '');
		$this->Cell(3);
		$this->Cell(16, 4, number_format($this->model['GRAMAmount'], 2), 0, 0, 'R');
		$this->SetFont('Times', 'B', PDFMaker::REG_SIZE);
		$this->Cell(7);
		$this->Cell(22, 4, 'Katas ng VAT', 0, 0, '');		
		$this->SetFont('Times', '', PDFMaker::REG_SIZE);		
		$this->Cell(25);
		$this->Cell(13, 4, '', 0, 0, '');
		$this->Cell(1);
		$this->Cell(12, 4, '', 0, 0, '');
		$this->Cell(3);
		$this->Cell(16, 4, number_format($this->model['KatasNgVAT'], 2), 0, 0, 'R');

		// ROW 28
		$this->Ln(4);
		$this->Cell(4);
		$this->Cell(22, 4, 'DAA - ICERA', 0, 0, '');
		$this->Cell(11);
		$this->Cell(13, 4, 'Per KWH', 0, 0, '');
		$this->Cell(1);
		$this->Cell(12, 4, $this->model['ICERARate'], 0, 0, '');
		$this->Cell(3);
		$this->Cell(16, 4, number_format($this->model['ICERAAmount'], 2), 0, 0, 'R');

		// LINE 2
		$this->Line(10, 160, 200, 160);

		// FOOTER
		$this->Ln(7);
		$this->Cell(1);
		$this->Cell(38, 4, 'Arrear Details as of ' . date('Y-m-d'), 1, 0, 'C');
		$this->Cell(3);
		$this->Cell(38, 4, 'Available Discount', 1, 0, 'C');
		$this->Cell(3);
		$this->Cell(38, 4, 'Available 2306', 1, 0, 'C');
		$this->Cell(3);
		$this->Cell(38, 4, 'Available 2307', 1, 0, 'C');

		$this->Ln(5);
		$this->Cell(1);
		$this->Cell(38, 4, 'No. of Months: ' . $this->model['ArrearsNoMonth'], 0, 0, '');
		$this->Cell(3);
		$this->Cell(38, 4, number_format($this->model['Discount'], 2), 0, 0, 'C');
		$this->Cell(3);
		$this->Cell(38, 4, number_format($this->model['BIR2306'], 2), 0, 0, 'C');
		$this->Cell(3);
		$this->Cell(38, 4, number_format($this->model['BIR2307'], 2), 0, 0, 'C');

		$this->Ln(5);
		$this->Cell(1);
		$this->Cell(38, 4, 'Total Amount: ' . number_format($this->model['ArrearsTotal'], 2), 0, 0, '');

		// LINE 3
		$this->Line(10, 178, 200, 178);

		$this->Ln(8);
		$this->SetFont('Times', 'B', PDFMaker::DUE_SIZE);
		$this->Cell(1);
		$this->Cell(38, 4, 'CURRENT AMOUNT DUE', 0, 0, '');
		$this->Cell(3);
		$this->Cell(115, 4, "------------------------------------------------------------------------------------------", 0, 0, 'C');
		$this->Cell(1);
		$this->Cell(28, 4, "P " . number_format($this->model['CurentAmountDue'], 2), 0, 0, 'R');
	}
}


?>