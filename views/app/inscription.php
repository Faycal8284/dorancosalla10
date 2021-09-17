<?php include(VIEWS . '_partials/header.php'); ?>




<form method="post" action="<?= BASE_PATH.'user/inscription' ?>">
  <fieldset>

      <input type="hidden" name="id" value="<?= 0 ?>">
    <div class="form-group">
      <label for="exampleInputEmail1" class="form-label mt-4">Email</label>
      <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1" class="form-label mt-4">Mot de passe</label>
      <input type="password" class="form-control" name="mdp" id="exampleInputPassword1" placeholder="Mot de passe">
    </div>
      <div class="form-group">
          <label for="exampleInputPassword1" class="form-label mt-4">Nom</label>
          <input type="text" class="form-control" name="nom" id="exampleInputPassword1" placeholder="Nom">
      </div>
      <div class="form-group">
          <label for="exampleInputPassword1" class="form-label mt-4">Prenom</label>
          <input type="text" class="form-control" name="prenom" id="exampleInputPassword1" placeholder="Prenom">
      </div>
      <div class="form-group">
          <label for="exampleInputPassword1" class="form-label mt-4">Adresse</label>
          <input type="text" class="form-control" name="adresse" id="exampleInputPassword1" placeholder="Adresse">
      </div>
      <div class="form-group">
          <label for="exampleInputPassword1" class="form-label mt-4">Code postal</label>
          <input type="text" class="form-control" name="cp" id="exampleInputPassword1" placeholder="Code postal">
      </div>
      <div class="form-group">
          <label for="exampleInputPassword1" class="form-label mt-4">Ville</label>
          <input type="text" class="form-control" name="ville" id="exampleInputPassword1" placeholder="Ville">
      </div>
      <div class="form-group">
          <label for="exampleInputPassword1" class="form-label mt-4">Numéro de téléphone</label>
          <input type="text" class="form-control" name="tel" id="exampleInputPassword1" placeholder="Numéro de téléphone">
          <div class="mt-2">
          <a  href="<?= BASE_PATH.'user/connexion' ?>">Déjà inscrit? connectez vous</a>
          </div>
      </div>


    <button type="submit" class="btn btn-primary mt-2 mb-5">S'inscrire</button>
  </fieldset>
</form>

<?php include(VIEWS . '_partials/footer.php'); ?>
