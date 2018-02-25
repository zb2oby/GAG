<?php include('../config.php'); ?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>GAG Login</title>
        <link rel="stylesheet" href="../css/ionicons.min.css">
        <link href="https://fonts.googleapis.com/css?family=Overpass" rel="stylesheet">
        <link rel="stylesheet" href="../css/login.css">
    </head>
    <body>
    	<div class="overlay"></div>
		<div class="confirmSet">
				Un email vous a été envoyé.
		</div>
    	<div class="container">
	        <div class="login-form">
				<span class="form-title"><img class="logo" src="../img/logo.png" alt="logo"><h1>Grand Angle Gestion</h1></span>
				<?php if (isset($_GET['message'])) {
						$message = htmlentities($_GET['message']);
						$class = 'error-area';
				} ?>
				<div id="error-area" class="<?php if(isset($class)){echo $class;} ?>">
					
						<?php if(isset($message)){echo $message;} ?>
					

				</div>
				<form id="login-form" action="../modules/traitementLogin.php" method="POST">
					<div class="login-input">
						<label for="login"><i class="ion-person"></i>Identifiant</label>
						<input type="text" name="login" id="login">
					</div>
					<div class="passwd-input">
						<label for="passwd"><i class="ion-key"></i>Mot de passe</label>
						<input type="password" name="passwd" id="passwd">
					</div>
					<div class="submit">
						<button type="submit">Connexion</button>
					</div>
				</form>
				<form id="forget-form" action="#" method="GET">
					<div class="login-input">
						<label for="email">Email(*)</label>
						<input type="email" id="email" name="email">
					</div>
					<div class="submit">
						<button type="submit">Reinitialiser mon mot de passe</button>
					</div>
				</form>
			</div>
			<?php if (DEV == true) { ?>
				<a href="../modules/decoHTTP.php">deco HTTP</a>
			<?php } ?>
				<a class="forgotten" href="#">Mot de passe oublié ?</a>
				<a class="return" href="../content/login.php">Retour au Login</a>
				

        </div>
		<script src="../js/lib/jquery-min-3.2.1.js"></script>
        <script src="../js/login.js"></script>
    </body>
</html>

	

