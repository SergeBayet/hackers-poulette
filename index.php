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
		input[type="text"]#website { display: none; }
		@font-face {
			font-family: Bellota;
			src: url("assets/Bellota-Regular.otf") format("opentype");
		}

		@font-face {
			font-family: Bellota;
			font-weight: bold;
			src: url("assets/Bellota-Bold.otf") format("opentype");
		}
		textarea.materialize-textarea{height: 9rem;}
		body {
			font-family: Bellota !important;
		}
		button, input, optgroup, select, textarea {
			font-family: Bellota !important;
			font-weight: bold;
			font-size: 24px !important;
		}
		li {
			font-weight: 700;
		}
		</style>
		<?php 
		require_once('countries.php');
		$subjects = array('Other', 'Javascript', 'HTML', 'CSS', 'Php', 'SQL');
		$genders = array('0' => 'Select your gender', 'm' => 'Male', 'f' => 'Female', 'x' => 'Other');
		if(isset($_SESSION['error']))
		{
			if(empty($_SESSION['error']))
			{
				echo '<p class="green">Message sent</p>';
			}
			else{
				echo '<p class="red">Message hasn\'t been sent. Check these fields!</p>';
			}
		}
		
		?>

    <body>
			<div class="section white">
				<div class="row container">
					<div class="image" style="text-align:center">
						<img  src="assets/hackers-poulette-logo.png">
					</div>
					<form id="form" action="sendform.php" method="post" class="col s12">
						<input id="website" name="website" type="text" value=""  />
						<div class="row">
							<div class="input-field col s4">
								<input value="<?php echo isset($_SESSION['post']['first-name']) ? $_SESSION['post']['first-name'] : ''; ?>" placeholder="John" id="first_name" type="text" name="first-name" class="validate">
								<label for="first_name">First Name</label>
								<span class="helper-text red-text">
								<?php
									if(isset($_SESSION['error']['first-name'])) {
										echo $_SESSION['error']['first-name'];
									}
								?>
								</span>
								
							</div>
							<div class="input-field col s4">
								<input value="<?php echo isset($_SESSION['post']['last-name']) ? $_SESSION['post']['last-name'] : ''; ?>" placeholder="Smith" id="last_name" type="text" name="last-name" class="validate">
								<label for="last_name">Last Name</label>
								<span class="helper-text red-text">
								<?php
									if(isset($_SESSION['error']['last-name'])) {
										echo $_SESSION['error']['last-name'];
									}
								?>
								</span>
							</div>
							<div class="input-field col s4">
								<select id="gender" name="gender">
								<?php
										$selected = "0";
										if(isset($_SESSION['post']['gender']))
										{
											$selected = $_SESSION['post']['gender'];
										}
										foreach($genders as $key => $gender)
										{
											echo '<option value="'.$key.'"'. ($key == $selected ? 'selected' : '') .'>'.$gender.'</option>';
										}
									?>
								</select>
								<label for="gender">Gender</label>
								<span class="helper-text red-text">
								<?php
									if(isset($_SESSION['error']['gender'])) {
									echo $_SESSION['error']['gender'];
									}
								?>
								</span>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s4">
								<input value="<?php echo isset($_SESSION['post']['email']) ? $_SESSION['post']['email'] : ''; ?>" placeholder="john.doe@gmail.com" id="email" type="text" name="email" class="validate">
								<label for="email">Email</label>
								<span class="helper-text red-text">
								<?php
									if(isset($_SESSION['error']['email'])) {
										echo $_SESSION['error']['email'];
									}
								?>
								</span>
							</div>
						
							<div class="input-field col s4">
								<select id="country" name="country">
									<?php
									$selected = "0";
									if(isset($_SESSION['post']['country']))
									{
										$selected = $_SESSION['post']['country'];
									}
									foreach($countries as $key => $country)
									{
										echo '<option value="'.$key.'"'. ($key == $selected ? 'selected' : '') .'>'.$country.'</option>';
									}
										
									?>	
								</select>
								<label for="country">Country</label>
								<span class="helper-text red-text">
								<?php
									if(isset($_SESSION['error']['country'])) {
										echo $_SESSION['error']['country'];
									}
								?>
								</span>
							</div>
							<div class="input-field col s4">
								<select id="subject" name="subject">
									<?php
										$selected = "0";
										if(isset($_SESSION['post']['subject']))
										{
											$selected = $_SESSION['post']['subject'];
										}
										foreach($subjects as $key => $subject)
										{
											echo '<option value="'.$key.'"'. ($key == $selected ? 'selected' : '') .'>'.$subject.'</option>';
										}
									?>
									
								</select>
								<label for="subject">Subject</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<textarea class="materialize-textarea" id="message" name="message" rows="10"><?php echo isset($_SESSION['post']['message']) ? $_SESSION['post']['message'] : '' ?></textarea>
								
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
					let elems = document.querySelectorAll('select');
					let instances = M.FormSelect.init(elems, {classes: ''});

					let formElement = document.querySelector('#form');
					formElement.addEventListener('submit', function() {
						let a = document.querySelector('input#website').value;
						
						if(a.length != 0)
						{
							event.preventDefault();
							return false;
						}
						
					});
				});



			</script>
		</body>
  </html>