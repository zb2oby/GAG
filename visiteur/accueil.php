<?php 
session_start();
require('../includes/functions.php');
spl_autoload_register('loader');
include('../includes/bdd/connectbdd.php');
$page="accueil";
if (isset($_SESSION['langue'])) {
	$idLangue = $_SESSION['langue'];

}
?>
<!doctype html>
<html lang="FR">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Untitled</title>
	<link rel="stylesheet" href="style.css">

</head>
<body>
	<?php 
	if(isset($_SESSION['langue'])){
		$langue=$_SESSION['langue'];
		header('Location: accueil.php');
	}
	else {
		?>
		<div class="question">
			Quelle est votre langue ?
		</div>
		<div class="reponses">
			<?php 
			$managerlangue = new ExpositionManager($bdd);
			$listlangueExpo = $managerlangue->getIdLangueExpo($currentExpo);
			?><div class="reponse">
				<?php echo '<a href="'.$_SERVER['PHP_SELF']'".php?langue='.$idLangue.'"><img src="drapeau/drapeau'.$idLangue.'.jpg">';
				?>
			</div>
		<?php endforeach ?>
	</div>
	<?php } ?>
</body>
</html>
