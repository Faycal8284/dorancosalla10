<?php include(VIEWS . '_partials/header.php');
if(!empty($_SESSION['membre'])&& ($_SESSION['membre']['role']=='ROLE_ADMIN')):

?>
<?php //var_dump($details);?>
 <!-- on boucle ici sur toutes nos commandes presentes en bdd, pour chaque lige de commande on fait un nouveau tableau -->
<?php foreach ($commandes as $commande): 
    
    ?>
<table class="table table-dark mb-0">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Date</th>
        <th scope="col">Montant</th>
        <th scope="col">Statut</th>
        <th scope="col">Détail</th>
    </tr>
    <tr>
    <tr>
            <th class="text-center" colspan="6">Commande passée par: </th>
            <td><?php $user= Utilisateur::findById(['id'=>$commande['utilisateur_id']]) ?><?= $user['prenom'].$user['nom']?></td>
        </tr>
    </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row"><?= $commande['id'] ?></th>
            <td><?= date('d-m-Y', strtotime($commande['date'])) ?></td>
            <td><?= $commande['montant'] ?> €</td>
            <td><?= $commande['statut'] ?></td>


        <!-- ici on pose la conditions d'affichage de notre bouton 'afficher le detail' qui apparait uniquement si le tableau $detail
        n'est pas vide(si on a pas effectuer le requete dans detail.php find() qui nous retourne tous les achats en liens avec
        cet id de commande)  -->
            <?php if (empty($details)): ?>
            <td>
                <a href="<?= BASE_PATH.'produits/recap?id='.$commande['id'] ?>" class="btn btn-light">Afficher le détail</a>

            </td>
            <!-- sinon, si$details est rempli ce qui signifie que l'on a cliqué sur le bouton afficher le detail et que
             l'id de commande a ete transmis en get et que l'on a ainsi recuperer tous nos achats lié a cet id de  commande.
             On modifie le bouton proposant de cacher le detail de la commande avec un parametre en  get action =vider qui reaffecte a $details un tableau vide -->
        <?php else:
        // ici on s'assure que l'entree 0 de notre $details a  bien pour command_id la meme valeur que l'id de la commande 
            if ($details[0]['commande_id']== $commande['id']):    ?>

                <td>
                    <a href="<?= BASE_PATH.'produits/recap?action=vider' ?>" class="btn btn-light">Cacher le détail</a>

                </td>
                <?php 
            // si l'id de la ligne du tableau commande ne correspond pas au commande_idde $details c'est que le detail ne 
            // correspond pas a cette commande et donc on maintient la possibliter d'afficher
            // // le detail pour cette commande précisement
            else: ?>
                <td>
                    <a href="<?= BASE_PATH.'produits/recap?id='.$commande['id'] ?>" class="btn btn-light">Afficher le détail</a>

                </td>
        <?php endif; endif; ?>
        </tr>
    </tbody>
</table>
<!-- // ici on genere le tableau d'affichade du detail de nos produits en lien avec la commande -->
<!-- on pose la condition si notre tableau $details n'est pas vide et a nouveau si l'ide de la ligne de commande du tableau 
est le meme que le commande_ide de nos achats present dans $details -->
    <?php if(!empty($details) && $details[0]['commande_id']== $commande['id']):?>
<table class="table table-dark mt-0">
    <thead>
    <tr>
        <th scope="col">Produit photo</th>
        <th scope="col">Produit nom</th>
        <th scope="col">Montant</th>
        <th scope="col">quantite</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($details as $detail): ?>
    <tr>
        <!-- dans la table detail nous avont accés a la propriété produit_id ainsi pour obtenir le detail de notre produit 
        on appelle la methode find du model produit.php a laquel on transmet de produit_id de notre ligne de detail en parametre
        et accedons directement a la propriete souhaiter du produit -->
        <td><img src="<?= '../../upload/'.Produit::find(['id'=>$detail['produit_id']])['photo'] ?>" width="50" height="50"  alt=""></td>
        <td><?= Produit::find(['id'=>$detail['produit_id']])['nom']  ?></td>
        <td><?= $detail['montant'] ?> €</td>
        <td><?= $detail['quantite'] ?></td>

    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php endif; endforeach; ?>




<?php 
else:
    echo '<h1>Vous n\'avez pas les autorisations pour cette page, <a href="'.BASE_PATH.'" >Retour à l\'acceuil</a>';

endif;

include(VIEWS . '_partials/footer.php'); ?>
