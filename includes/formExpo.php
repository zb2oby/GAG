<?php 
if (isset($_SESSION['idExpo'])) {
        $idExpo = $_SESSION['idExpo'];
        $managerExpo = new ExpositionManager($bdd);
        $expo = $managerExpo->infoExpo($idExpo);

}

 ?>
<div class="expo-content">
    <div class="confirmPopup">
        <span>Souhaitez vous réellement supprimer l'élément ?</span>
        <button class="deleteExpo">Supprimer</button>
        <button class="cancelButton-global">Oula tout cela va bien trop vite</button>
    </div>
    <ul class="list-button-expo">
        <li><div><img style="width:50px; height:50px; margin: 10px;" src="../img/expositions/expo<?php echo $expo->getIdExpo(); ?>/<?php echo $expo->getTeaser(); ?>" alt=""></div><button class="action-button" id="modifTeaser">Modifier le Teaser</button></li>
        <li><div><img style="width:50px; height:50px; margin:10px;" src="../img/expositions/expo<?php echo $expo->getIdExpo(); ?>/<?php echo $expo->getAffiche(); ?>" alt=""></div><button class="action-button" id="modifAffiche">Modifier l'affiche</button></li>
    </ul> 

    <form class="expoForm" action="../modules/traitementExpo.php" method="POST">
                    
    	<fieldset class="expoField">
            <div>
                <label for="titre">Titre</label>
                <input type="text" name="titre" id="titre" value="<?php echo $expo->getTitre() ?>">
            </div>
            <div>
                <label for="theme">Theme</label>
                <input type="text" name="theme" id="theme" value="<?php echo $expo->getTheme() ?>">
            </div>
            <div>
            <label for="dateDebut">Date de début</label>
            <input type="date" name="dateDebut" id="dateDebut" value="<?php echo $expo->getDateDeb() ?>">
            </div>
            <div>
                <label for="dateFin">Date de fin</label>
                <input type="date" name="dateFin" id="dateFin" value="<?php echo $expo->getDateFin() ?>">
            </div>
            <div>
            <label for="descriptif">descriptif</label>
                <textarea name="descriptif" id="descriptif" cols="30" rows="7" value="<?php echo $expo->getDescriptifFR() ?>"><?php echo $expo->getDescriptifFR() ?></textarea>
            </div>
        </fieldset>
        <fieldset class="expo-cpl expoField">
            <div>
                <label for="couleurExpo">Couleur de l'expo</label>
                <input type="color" name="couleurExpo" id="couleurExpo" value="<?php echo $expo->getCouleurExpo() ?>">
            </div>
            <div>
                <label for="horaireO">Horaire d'ouverture</label>
                <input type="time" name="horaireO" id="horaireO" value="<?php echo $expo->getHoraireO() ?>">
            </div>
            <div>
                <label for="horaireF">Horaire de fermeture</label>
                <input type="time" name="horaireF" id="horaireF" value="<?php echo $expo->getHoraireF() ?>">
            </div>
            
            <div class="langues">
                <label>Langues Disponibles</label>
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
                <label for="fr" class="labelLn">Fr</label>
                <input type="checkbox" name="idLangue[]" id="fr" value="1" <?php if(isset($fr)){echo $fr;} ?> >
                <label for="en" class="labelLn">En</label>
                <input type="checkbox" name="idLangue[]" id="en" value="2" <?php if(isset($en)){echo $en;} ?>>
                <label for="de" class="labelLn">De</label>
                <input type="checkbox" name="idLangue[]" id="de" value="4" <?php if(isset($de)){echo $de;} ?>>
                <label for="cn" class="labelLn">Cn</label>
                <input type="checkbox" name="idLangue[]" id="cn" value="5" <?php if(isset($cn)){echo $cn;} ?>>
                <label for="ru" class="labelLn">Ru</label>
                <input type="checkbox" name="idLangue[]" id="ru" value="3" <?php if(isset($ru)){echo $ru;} ?>>
            </div>
       </fieldset>
        <div class="submit">
            <input type="hidden" name="req" value="updateExpo">
            <input type="hidden" name="idExpo" value="<?php echo $idExpo ?>">
    		<button type="submit">Enregistrer les informations</button>
    		<button><a class="button delExpo" data-idexpo="<?php echo $idExpo ?>" href="../modules/traitementExpo.php?req=deleteExpo&idExpo=<?php echo $idExpo ?>">Supprimer Expo</a></button>
            
        </div>
    </form>
   
    
    <div class="card-form pop-modifTeaser popGestionCard" >
        <div class="closeButton-context closeButton-expo"><i class="ion-android-close"></i></div>
        <form action="../modules/traitementExpo.php" method="POST" enctype="multipart/form-data">
            <div>
                <label for="teaser">Teaser (JPG GIF JPEG PNG| max. 500Ko)</label>
                <input type="file" name="teaser[]" id="teaser" accept=".jpg, .jpeg, .gif, .png">
                <input type="hidden" id="maxSize" name="MAX_FILE_SIZE" value="500000">       
            </div>
            <div class="submit">
                <input type="hidden" name="req" value="updateTeaser">
                <input type="hidden" name="idExpo" value="<?php echo $idExpo ?>"> 

                <button type="submit">Enregistrer le teaser</button>
            </div>
        </form>
    </div>

    <div class="card-form pop-modifAffiche popGestionCard">
        <div class="closeButton-context closeButton-expo"><i class="ion-android-close"></i></div>
        <form action="../modules/traitementExpo.php" method="POST" enctype="multipart/form-data"> 
            <div>
                <label for="affiche">Affiche (JPG GIF JPEG PNG| max. 500Ko)</label>
                <input type="file" name="affiche[]" id="affiche" accept=".jpg, .jpeg, .gif, .png">
                <input type="hidden" id="maxSize" name="MAX_FILE_SIZE" value="500000">         
            </div>
            <div class="submit">
                <input type="hidden" name="req" value="updateAffiche">
                <input type="hidden" name="idExpo" value="<?php echo $idExpo ?>">
                <button type="submit">Enregistrer l'affiche'</button>
            </div>
        </form>
    </div>

</div>