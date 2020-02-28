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

?>

<div class="new-email">
	<div class="row">
		<div class="col s12 m6 l6 offset-m3 offset-l3">
			<br>
			<br>
			<h3>Add Email to Existing Account</h3>
			<div class="row">
				<div class="input-field col s12 m12 l12">
					<input id="accountNumber" name="accountNumber" type="text" class="validate">
          			<label for="accountNumber">Account Number</label>
				</div>

				<div class="input-field col s12 m12 l12">
					<input id="email" name="email" type="text" class="validate">
          			<label for="email">Email Address</label>
				</div>

				<div class="input-field col s12 m12 l12">
					<input id="contact" name="contact" type="text" class="validate">
          			<label for="contact">Contact Number</label>
				</div>
			</div>
			<button id="add-email-btn" class="btn btn-teal right"><i class="material-icons left">done</i>SAVE</button>
			<!-- LOADER -->
			<div id="add-email-loader" class="preloader-wrapper small active hide">
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

		  	<!-- DETAILS -->
		  	<p id="details" style="color: #878787;">.</p>
		</div>
	</div>
</div>

<?php include 'footer.php' ?>