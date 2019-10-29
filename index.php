<?php
session_start();
?>
<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="./node_modules/materialize-css/dist/css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
		<style>
			textarea.materialize-textarea{height: 9rem;}
		</style>
		<?php 
		require_once('countries.php');
		if(isset($_SESSION['error']))
		{
			var_dump($_SESSION['error']);	
		}
		?>

    <body>
			<div class="section white">
				<div class="row container">
					<div class="image" style="text-align:center">
						<img  src="assets/hackers-poulette-logo.png">
					</div>
					<form action="sendform.php" method="post" class="col s12">
						<div class="row">
							<div class="input-field col s4">
								<input placeholder="John" id="first_name" type="text" name="first-name" class="validate">
								<label for="first_name">First Name</label>
							</div>
							<div class="input-field col s4">
								<input placeholder="Smith" id="last_name" type="text" name="last-name" class="validate">
								<label for="last_name">Last Name</label>
							</div>
							<div class="input-field col s4">
								<select id="gender" name="gender">
									<option value="" selected>Select your gender</option>
									<option value="m">Male</option>
									<option value="f">Female</option>
									<option value="x">Other</option>
								</select>
								<label for="gender">Gender</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s4">
								<input placeholder="john.doe@gmail.com" id="email" type="text" name="email" class="validate">
								<label for="email">Email</label>
							</div>
						
							<div class="input-field col s4">
								<select id="country" name="country">
									<option value="" selected>Select your country</option>		
									<?php 
										foreach($countries as $code => $country)
										{
											echo '<option value="'.$code.'">'.$country.'</option>';
										}
									?>						
								</select>
								<label for="country">Country</label>
							</div>
							<div class="input-field col s4">
								<select id="subject" name="subject">
									<option value="1" selected>Others</option>
									<option value="2">Php</option>
									<option value="3">Javascript</option>
									<option value="4">MySQL</option>
								</select>
								<label for="subject">Subject</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<textarea class="materialize-textarea" id="message" name="message" rows="10">
								</textarea>
								<label for="message">Message</label>
								
							</div>
						</div>
						<button class="btn waves-effect waves-light" type="submit" name="action">Submit
							<i class="material-icons right">send</i>
						</button>
					</form>
				</div>
      </div>
      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="./node_modules/materialize-css/dist/js/materialize.min.js"></script>
			<script>
				document.addEventListener('DOMContentLoaded', function() {
					var elems = document.querySelectorAll('select');
					var instances = M.FormSelect.init(elems, {classes: ''});
				});
			</script>
		</body>
  </html>