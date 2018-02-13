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
			<div id="error-area" class="<?php if(isset($class)){echo $class;} ?>">
				
					<?php if(isset($message)){echo $message;} ?>
				

			</div>
			<span class="first-connect">Premiere Connexion : veuillez modifier votre mot de passe</span>
			<form id="mdpForm" action="../modules/traitementNewMdp.php" method="POST">
			 	<div>
			 		<label for="mdp1">Nouveau mot de passe</label>
			 		<input type="password" id="mdp1" name="mdp1">
			 	</div>
			 	<div>
			 		<label for="mdp2">Resaissez le nouveau mot de passe</label>
			 		<input type="password" id="mdp2" name="mdp2">
			 	</div>
			 	<div class="submit">
			 		<input type="hidden" name="idUser" id="idUser" value="<?php echo $_GET['idUser']; ?>">
			 		<button>Envoyer</button>
			 	</div>
			 </form>
		</div>
		<script src="../js/lib/jquery-min-3.2.1.js"></script>
        <script src="../js/mdp.js"></script>
    </body>
</html>
 