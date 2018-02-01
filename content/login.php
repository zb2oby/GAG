<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>GAG Login</title>
        <link rel="stylesheet" href="../css/ionicons.min.css">
        <link rel="stylesheet" href="../css/login.css">
    </head>
    <body>

    	<div class="container">
        <div class="login-form">
			<span class="form-title"><img class="logo" src="../img/logo.png" alt="logo"><h1>Grand Angle Gestion</h1></span>
			<?php if (isset($_GET['message'])) {
					$message = htmlentities($_GET['message']);
					$class = 'error-area';
			} ?>
			<div class="<?php echo $class; ?>">
				
					<?php if(isset($message)){echo $message;} ?>
				

			</div>
			<form action="../modules/traitementLogin.php" method="POST">
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
		</div>
		<a href="../modules/decoHTTP.php">deco HTTP</a>
        </div>
    </body>
</html>

	

