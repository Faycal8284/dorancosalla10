<?php include(VIEWS . '_partials/header.php'); 
if(!empty($_SESSION['membre'])&& ($_SESSION['membre']['role']=='ROLE_ADMIN')):

?>

<form action="<?= BASE_PATH.'categories/save' ?>" method="post" enctype="multipart/form-data" >
    <fieldset>
        <input type="hidden" name="id" value="<?php echo  $categorie['id'] ?? 0;?>">
        <div class="form-group">
            <label for="exampleInputPassword1" class="form-label mt-4">Nom</label>
            <input name="nom" type="text" value="<?php echo $categorie['nom'] ?? '';?>"  class="form-control" id="exampleInputPassword1" placeholder="Nom">
        </div>

        <button type="submit" class="btn btn-light mt-2 mb-5">Valider</button>
    </fieldset>
</form>

<?php 
else:
    echo '<h1>Vous n\'avez pas les autorisations pour cette page, <a href="'.BASE_PATH.'" >Retour à l\'acceuil</a>';

endif;

include(VIEWS . '_partials/footer.php'); ?>

