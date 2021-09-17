<?php include(VIEWS . '_partials/header.php'); ?>




<div class="row">
<!--    --><?php //var_dump($_SESSION['panier']);?>
    <?php foreach ($produits as $produit): ?>
        <div class="col-md-4">
            <div class="card border-secondary mb-3" style="max-width: 20rem;">
                <div class="card-header text-center"><?= $produit['nom'] ?></div>
                <div class="card-body text-center">
                    <img src="<?= PHOTO . $produit['photo'] ?>" width="150" height="150" alt="">
                    <h4 class="card-title text-center"><?= $produit['prix'] ?> €</h4>
                    <p class="card-text text-center"><?= $produit['descriptif'] ?></p>
                </div>
                <div class="card-footer">
                    <form action="<?= BASE_PATH.'panier/add' ?>" method="post" >
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                            <input type="hidden" name="id" value="<?= $produit['id'] ?>">
                            <select name="quantite" class="form-select" id="exampleSelect1">
                                <?php for ($i=1; $i <= $produit['stock']; $i++): ?>
                                <option  value="<?= $i ?>"><?= $i ?></option>
                                <?php endfor; ?>

                            </select></div>
                                <div class="col-md-6">
                            <button class="btn btn-secondary btn-sm " type="submit">Ajouter au panier</button></div></div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php include(VIEWS . '_partials/footer.php'); ?>
