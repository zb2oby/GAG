<?php 
if (isset($_SESSION['idExpo'])) {
        $idExpo = $_SESSION['idExpo'];
        $managerExpo = new ExpositionManager($bdd);
        $expo = $managerExpo->infoExpo($idExpo);

}

 ?>
<div class="expo-content">
    <form class="expoForm" action="../modules/traitementExpo.php" method="POST">
                    
    	<fieldset>
            <legend>Infos générales</legend>
            <label for="titre">Titre</label>
            <input type="text" name="titre" id="titre" value="<?php echo $expo->getTitre() ?>"><br>
            <label for="theme">Theme</label>
            <input type="text" name="theme" id="theme" value="<?php echo $expo->getTheme() ?>"><br>
            <label for="dateDebut">Date de début</label>
            <input type="date" name="dateDebut" id="dateDebut" value="<?php echo $expo->getDateDeb() ?>"><br>
            <label for="dateFin">Date de fin</label>
            <input type="date" name="dateFin" id="dateFin" value="<?php echo $expo->getDateFin() ?>"><br> 
            
            <label for="descriptif">descriptif</label>
            <textarea name="descriptif" id="descriptif" cols="30" rows="7" value="<?php echo $expo->getDescriptifFR() ?>"><?php echo $expo->getDescriptifFR() ?></textarea>
 
        </fieldset>
        <fieldset class="expo-cpl">
            <legend>Info Complémentaires</legend>
            <label for="couleurExpo">Couleur de l'expo</label>
            <input type="color" name="couleurExpo" id="couleurExpo" value="<?php echo $expo->getCouleurExpo() ?>"><br>
            
            <label for="horaireO">Horaire d'ouverture</label>
            <input type="time" name="horaireO" id="horaireO" value="<?php echo $expo->getHoraireO() ?>"><br>
            <label for="horaireF">Horaire de fermeture</label>
            <input type="time" name="horaireF" id="horaireF" value="<?php echo $expo->getHoraireF() ?>"><br>
            <label>Langues Disponibles</label>
            <div class="langues">
                <?php $listLangueDispo = $managerExpo->getIdLangueExpo($idExpo);
                    foreach ($listLangueDispo as $idLangue) {
                        switch ($idLangue) {
                            case 1:
                                $fr = 'checked';
                                break;
                            case 2:
                                $en = 'checked';
                                break;
                            case 3:
                                $ru = 'checked';
                                break;
                            case 4:
                                $de = 'checked';
                                break;
                            case 5:
                                $cn = 'checked';
                                break;
                            
                            default:
                                # code...
                                break;
                        }
                    }
                ?>
                <label for="fr">Fr</label>
                <input type="checkbox" name="idLangue[]" id="fr" value="1" <?php if(isset($fr)){echo $fr;} ?> >
                <label for="en">En</label>
                <input type="checkbox" name="idLangue[]" id="en" value="2" <?php if(isset($en)){echo $en;} ?>>
                <label for="de">De</label>
                <input type="checkbox" name="idLangue[]" id="de" value="4" <?php if(isset($de)){echo $de;} ?>>
                <label for="cn">Cn</label>
                <input type="checkbox" name="idLangue[]" id="cn" value="5" <?php if(isset($cn)){echo $cn;} ?>>
                <label for="ru">Ru</label>
                <input type="checkbox" name="idLangue[]" id="ru" value="3" <?php if(isset($ru)){echo $ru;} ?>>
            </div>
       </fieldset>
        <div class="submit">
            <input type="hidden" name="req" value="updateExpo">
            <input type="hidden" name="idExpo" value="<?php echo $idExpo ?>">
    		<button type="submit">Enregistrer les modifications</button>
    		<button><a href="../modules/traitementExpo.php?req=deleteExpo&idExpo=<?php echo $idExpo ?>">Supprimer Expo</a></button>
            
        </div>
    </form>
   
    <ul class="list-button-expo">
        <li><div><img style="width:50px; height:50px; margin: 10px;" src="../img/expositions/expo<?php echo $expo->getIdExpo(); ?>/<?php echo $expo->getTeaser(); ?>" alt=""></div><button class="action-button" id="modifTeaser">Modifier le Teaser</button></li>
        <li><div><img style="width:50px; height:50px; margin:10px;" src="../img/expositions/expo<?php echo $expo->getIdExpo(); ?>/<?php echo $expo->getAffiche(); ?>" alt=""></div><button class="action-button" id="modifAffiche">Modifier l'affiche</button></li>
    </ul> 


    <form class="card-form pop-modifTeaser popGestionCard" action="../modules/traitementExpo.php" method="POST" enctype="multipart/form-data">
        <div>
            <label for="teaser">Teaser (JPG GIF JPEG PNG| max. 500Ko)</label>
            <input type="file" name="teaser[]" id="teaser" accept=".jpg, .jpeg, .gif, .png">
            <input type="hidden" id="maxSize" name="MAX_FILE_SIZE" value="500000">       
        </div>
        <input type="hidden" name="req" value="updateTeaser">
        <input type="hidden" name="idExpo" value="<?php echo $idExpo ?>"> 

        <button type="submit">Enregistrer le teaser</button>
    </form>


    <form class="card-form pop-modifAffiche popGestionCard" action="../modules/traitementExpo.php" method="POST" enctype="multipart/form-data"> 
        <div>
            <label for="affiche">Affiche (JPG GIF JPEG PNG| max. 500Ko)</label>
            <input type="file" name="affiche[]" id="affiche" accept=".jpg, .jpeg, .gif, .png">
            <input type="hidden" id="maxSize" name="MAX_FILE_SIZE" value="500000">         
        </div>
        <input type="hidden" name="req" value="updateAffiche">
        <input type="hidden" name="idExpo" value="<?php echo $idExpo ?>">
        <button type="submit">Enregistrer l'affiche'</button>
    </form>


</div>