<?php include 'header.php' ?>
<?php 

$towns = [
	'23' => 'Albur',
	'12' => 'Antequera',
	'14' => 'Baclayon',
	'22' => 'Balilihan',
	'10' => 'Batuan',
	'11' => 'Bilar',
	'06' => 'Calape',
	'09' => 'Carmen',
	'04' => 'Catigbian',
	'02' => 'Clarin',
	'24' => 'Corella',
	'18' => 'Cortes',
	'16' => 'Dauis',
	'20' => 'Dimiao',
	'08' => 'Inabanga',
	'05' => 'San Isidro',
	'15' => 'Loay',
	'26' => 'Lila',
	'19' => 'Loboc',
	'07' => 'Loon',
	'13' => 'Maribojoc',
	'17' => 'Panglao',
	'03' => 'Sagbayan',
	'25' => 'Sevilla',
	'21' => 'Sikatuna',
	'01' => 'Tubigon',
];

$servicePeriods = [];

$strtTime = date('m/d/Y', strtotime('first day of next month'));

for ($i=0; $i<10; $i++) {
    $servicePeriods[date('m/d/Y', strtotime($strtTime . ' -' . ($i+1) . ' month'))] = date('m/d/Y', strtotime($strtTime . ' -' . ($i+1) . ' month'));
}

?>
<div class="billing">
	
	<div class="row">
		<br>
		
		<!-- LEFT PANEL -->
		<div class="col s12 m5 l5">
			<!-- TOWN SELECTOR -->
			<div class="card">
				<div class="card-content">
					<div class="row">
						<div class="input-field col s12">
					    	<select id="period-select">
					      		<option value="" disabled selected>Periods</option>
					      		<?php foreach ($servicePeriods as $key => $value) : ?>
					      			<option value="<?= $key ?>"><?= $value ?></option>
					      		<?php endforeach ?>				      		
					    	</select>
					    	<label>Select Period</label>
					  	</div>

						<div class="input-field col s12">
					    	<select id="town-select">
					      		<option value="" disabled selected>Towns</option>
					      		<?php foreach ($towns as $key => $value) : ?>
					      			<option value="<?= $key ?>"><?= $value ?></option>
					      		<?php endforeach ?>				      		
					    	</select>
					    	<label>Select Town</label>
					  	</div>
					</div>
				</div>
			</div>
					
				
			<!-- EMAIL DISPLAY TABLE -->
			<p id="emailTotal" style="color: #878787;"></p>
			<table id="bills-table" class="striped highlight">
				<thead>
					<tr>
						<td>Accounts</td>
						<td>Emails</td>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
		</div>

		<!-- RIGHT PANEL -->
		<div class="col s12 m7 l7">
			<!-- Compose -->
			<div class="row">
				<div class="card">
					<div class="card-content">
						<span class="card-title">Message Compose</span>
						<div class="row">
							<div class="input-field col s12">
						    	<textarea id="bills-compose" class="materialize-textarea" rows="3" wrap=true>BOHECO I Monthly Statement of Account</textarea>
						    	<label for="bills-compose">Compose Body</label>
						  	</div>
						</div>
						<button id='send-bills-btn' class="btn"><i class="material-icons left">send</i>SEND EMAILS</button>

						<!-- LOADER -->
						<div id="send-email-loader" class="preloader-wrapper small active right hide">
						    <div class="spinner-layer spinner-teal-only">
							    <div class="circle-clipper left">
							        <div class="circle"></div>
							    </div>
							    <div class="gap-patch">
							    	<div class="circle">
							    </div>
							    </div><div class="circle-clipper right">
							        <div class="circle"></div>
							    </div>
						    </div>
					  	</div>

					  	<p id="send-loader-details" class="send-load-details right hide">Loading</p>
					</div>
				</div>					
			</div>
		</div>
	</div>

	<div class="fixed-action-btn">
		<a class="btn-floating btn-large teal" href="new-email.php"><i class="large material-icons">add</i></a>
	</div>
</div>

<?php include 'footer.php' ?>