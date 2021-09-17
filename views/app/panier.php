<?php include(VIEWS . '_partials/header.php');

if (empty($_SESSION['panier'])):
echo '<p>Votre panier est vide, remplissez le vite <a class="btn btn-success" href="'. BASE_PATH .'">Accès boutique</a> </p>';
else:
?>

<table class="table table-dark">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Nom</th>
        <th scope="col">Prix</th>
        <th scope="col">Quantité</th>
        <th scope="col">Photo</th>
    </tr>
    </thead>
    <tbody>
    <?php  $total=0; for($i=0; $i < count($_SESSION['panier']['id']); $i++): ?>
        <tr>
            <th scope="row"><?= $_SESSION['panier']['id'][$i] ?></th>
            <td><?= $_SESSION['panier']['nom'][$i] ?></td>
            <td><?= $_SESSION['panier']['prix'][$i] ?></td>
            <td><?= $_SESSION['panier']['quantite'][$i] ?></td>
            <td><img src="<?= '../../upload/' . $_SESSION['panier']['photo'][$i] ?>" width="40" height="40" alt=""></td>
        </tr>
    <?php $total += $_SESSION['panier']['prix'][$i]* $_SESSION['panier']['quantite'][$i] ;
    endfor; ?>

    </tbody>
</table>
<h3>Montant total: <?= $total ?> €</h3>
<a href="<?= BASE_PATH.'panier/list?action=vider' ?>" class="btn btn-secondary">Vider le panier</a>

    <?php if (!empty($_SESSION['membre'])): ?>
<a href="<?= BASE_PATH.'produits/commande' ?>" class="btn btn-warning">Confirmer la commande</a>
        <?php else: ?>
    <a href="<?= BASE_PATH.'user/connexion?commande=true' ?>" class="btn btn-warning">Connectez vous pour passer à la commande</a>
        <?php endif; ?>

<?php include(VIEWS . '_partials/footer.php'); endif;?>
