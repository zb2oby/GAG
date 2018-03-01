<?php 
include('header.php');
include ('../class/Traduction.class.php');
if (isset($_SERVER['HTTP_REFERER'])) {
	if (!isset($_SESSION['precedent'])) {
		$previous = $_SERVER['HTTP_REFERER'];
		$_SESSION['precedent'] = $previous;		
	}	
}


$idartiste=$_GET['artiste'];
$managerartiste = new artisteManager($bdd);
$artiste = $managerartiste->infoArtiste($idartiste);

?>
<div class="main">
	<div class="artiste">
		<div class="artisteimage">
			<img src="../img/artistes/<?php echo $artiste->getImage();?>" alt="image artiste">
		</div>
		<div class="description">
			<div class="block">
				Nom :
				<?php 
				echo ucfirst($artiste->getNom());
				?>
				<?php
				echo ucfirst($artiste->getPrenom());
				?>
			</div>
			<div class="block">
				<h4>Description : </h4>
			<?php 
					if ($idLangue != 1) {
						$traduction = new Traduction();
						$desc = $traduction->getTraduction($idLangue, $idartiste, 'idArtiste');
						if (strlen($desc)>300) 
						{
						  $more = substr($desc, 306);
						  $desc=substr($desc, 0, 310);

						  $dernier_mot=strrpos($desc," ");
						  $desc=substr($desc,0,$dernier_mot);
						  $desc.='<a class="readmore" href="#" > Lire la suite <i class="ion-arrow-right-c"></i></a>';
						}
						echo $desc;
						?>
						<p class="more"><?php if(isset($more)){ echo $more; } ?></p>
						<?php
					}else{
						$desc = ucfirst($artiste->getDescriptifFR());
						if (strlen($desc)>300) 
						{
						  $more = substr($desc, 306);
						  $desc=substr($desc, 0, 310);

						  $dernier_mot=strrpos($desc," ");
						  $desc=substr($desc,0,$dernier_mot);
						  $desc.='<a class="readmore" href="#" > Lire la suite <i class="ion-arrow-right-c"></i></a>';
						}
						echo $desc;
						?>
						<p class="more"><?php if(isset($more)){ echo $more; } ?></p>
						<?php
					}
				 ?>
			</div>
		</div>
	</div>

<?php include 'footer.php'; ?>
?>
