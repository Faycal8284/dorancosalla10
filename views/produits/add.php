<?php include(VIEWS . '_partials/header.php'); 
if(!empty($_SESSION['membre'])&& ($_SESSION['membre']['role']=='ROLE_ADMIN')):

?>

<form action="<?= BASE_PATH . 'produits/save' ?>" method="post" enctype="multipart/form-data">
    <fieldset>
        <input type="hidden" name="id" value="<?php echo  $produit['id'] ?? 0;?>">
        <div class="form-group">
            <label for="exampleInputPassword1" class="form-label mt-4">Nom</label>
            <input name="nom" type="text" value="<?php echo $produit['nom'] ?? '';?>"  class="form-control" id="exampleInputPassword1" placeholder="Nom">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1" class="form-label mt-2">Prix</label>
            <input name="prix" type="number" value="<?php echo $produit['prix'] ?? '';?>" class="form-control" id="exampleInputPassword1" placeholder="Prix">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1" class="form-label mt-2">Stock</label>
            <input name="stock" type="number" value="<?php echo $produit['stock'] ?? '';?>" class="form-control" id="exampleInputPassword1" placeholder="Stock">
        </div>
        <div class="form-group">
            <label for="exampleSelect1" class="form-label mt-2">Catégorie</label>
            <select    name="categorie_id" class="form-select" id="exampleSelect1">
                <?php foreach ($categories as $categorie ): ?>
                <option <?php if (isset($produit['categorie_id']) && $categorie['id']== $produit['categorie_id']): echo 'selected'; endif; ?> value="<?= $categorie['id']; ?>"><?= $categorie['nom']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="exampleTextarea" class="form-label mt-2">Descriptif</label>
            <textarea name="descriptif"  class="form-control" id="exampleTextarea" rows="3"><?php echo $produit['descriptif'] ?? ''?></textarea>
        </div>
        <?php if (isset($produit) && !empty($produit['photo'])): ?>
            <div class="form-group text-center">
                <label for="formFile" class="form-label mt-2">Photo</label>
                <input type="hidden" name="photo_actuelle" value="<?= $produit['photo'] ?>">
                <input name="photo_update" onchange="loadFile(event)" class="form-control" type="file" id="formFile">
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center">
                        <label  class="mt-3" for="">Photo après changement</label><br>
                    <img id="image" width="90" class="mt-3">
                </div>
                    <div class="col-md-6 text-center">
                        <label  class="mt-3" for="">Photo avant changement</label><br>

                        <img src="<?= '../../upload/' . $produit['photo'] ?>" width="90" class="mt-3"  alt="">

                    </div>
                </div>
            </div>

        <?php else: ?>
        <div class="form-group">
            <label for="formFile" class="form-label mt-2">Photo</label>
            <input name="photo" onchange="loadFile(event)" class="form-control" type="file" id="formFile">
            <div class="row justify-content-center text-center">
                <div class="col-md-6">
                <img id="image" width="200" class="mt-3">
            </div>
            </div>
        </div>
        <?php endif; ?>


        <button type="submit"  class="btn btn-light mt-2 mb-5">Valider</button>
    </fieldset>
</form>
<script>
let loadFile = function(event)
{
let image = document.getElementById('image');

image.src = URL.createObjectURL(event.target.files[0]);
}
</script>

<?php

else:
    echo '<h1>Vous n\'avez pas les autorisations pour cette page, <a href="'.BASE_PATH.'" >Retour à l\'acceuil</a>';

endif;

include(VIEWS . '_partials/footer.php'); ?>

