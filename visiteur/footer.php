<?php 
if (isset($_SESSION['precedent'])) {
	$previous = $_SESSION['precedent'];
	$explodePrev = explode('/', $previous);
	$pagePrev = $explodePrev[count($explodePrev)-1];
}





$current = $_SERVER['PHP_SELF'];
$segments = explode('/', $current);
$page = $segments[count($segments)-1];

$pageArtiste = 'artiste.php';
$pageOeuvre = 'oeuvre.php';
$pageHome = 'index.php';

switch ($page) {
	case 'artiste.php':
		$left = $pageHome;
		$right = $pageOeuvre;
		$iconR = 'ion-android-image';
		$iconL = 'ion-android-home';
		$textR = 'Oeuvres';
		$textL = '';
		$displayCenter = 'none';
		$display = 'block';
		break;
	case 'oeuvre.php':
		$left = $pageHome;
		$right = $pageArtiste;
		$iconR = 'ion-android-color-palette';
		$iconL = 'ion-android-home';
		$textR = 'Artistes';
		$textL = '';
		$displayCenter = 'none';
		$display = 'block';
		break;
	case 'index.php':
		$left = $pageArtiste;
		$right = $pageOeuvre;
		$iconR = 'ion-android-image';
		$iconL = 'ion-android-color-palette';
		$textR = 'Oeuvres';
		$textL = 'Artistes';
		$displayCenter = 'none';
		$display = 'block';
		break;
	default:
		$center = $previous;
		
		$icon = 'ion-reply';
		$text = '';
		$displayCenter = 'block';
		$display = 'none';
		break;
}

 ?>
<!-- fin de main -->
</div>

<div class="footer" >
			<div class="center" style="display:<?php echo $displayCenter; ?>;">
				<a href="<?php echo $center; ?>"><i class="<?php echo $icon ?>"></i><?php echo $text; ?></a>
			</div>
			<div class="left" style="display:<?php echo $display; ?>;">
				<a href="<?php echo $left; ?>"><i class="<?php echo $iconL; ?>"></i><?php echo $textL; ?></a>
			</div>
			<div class="right" style="display:<?php echo $display; ?>;">
				<a href="<?php echo $right; ?>"><i class="<?php echo $iconR; ?>"></i><?php echo $textR; ?></a>
			</div>
		</div>
	</div>
	<script src="../js/lib/jquery-min-3.2.1.js"></script>
	<script src="scrollHead.js"></script>
</body>

</html>