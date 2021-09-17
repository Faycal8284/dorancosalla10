<?php include(VIEWS . '_partials/header.php'); ?>



<?php //var_dump($commande);?>

<form method="post"  action="<?= BASE_PATH.'user/connexion' ?>"  >
    <fieldset>
        <div class="form-group">
            <label for="exampleInputEmail1" class="form-label mt-4">Email</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
        </div>
        <input type="hidden" name="commande" value="<?= $commande; ?>">

        <div class="form-group">
            <label for="exampleInputPassword1" class="form-label mt-4">Mot de passe</label>
            <input type="password" class="form-control" name="mdp" id="exampleInputPassword1" placeholder="Mot de passe">
            <a href="<?= BASE_PATH.'user/inscription' ?>">Pas encore inscrit? cliquez ici</a>
        </div>
        <button type="submit" class="btn btn-primary mt-2 mb-5">Se connecter</button>
    </fieldset>
</form>

<?php include(VIEWS . '_partials/footer.php'); ?>
