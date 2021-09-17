<?php

class ProduitsController
{

    public static function add()
    {

        if (isset($_GET['id'])) :
            $produit = Produit::find([
                'id' => $_GET['id']
            ]);

        endif;

        $categories = Categorie::findAll();

        include(VIEWS . 'produits/add.php');
    }

    public static function save()
    {

        // $_FILES contient toutes les informations des inputs type FILE, var_dump() nous permet de les afficher et die() permet de stopper le traitement en cours
        //die(var_dump($_FILES));

        if (!empty($_FILES['photo']['name'])) :

            $photoname = $_FILES['photo']['name'];
            copy($_FILES['photo']['tmp_name'], PUBLIC_FOLDER . '/upload/' . $_FILES['photo']['name']);
        endif;
        if (!empty($_FILES['photo_update']['name'])) :

            $photoname = $_FILES['photo_update']['name'];
            copy($_FILES['photo_update']['tmp_name'], PUBLIC_FOLDER . '/upload/' . $_FILES['photo_update']['name']);
            unlink(PUBLIC_FOLDER . '/upload/' . $_POST['photo_actuelle']);
        endif;



        Produit::create([
            'id' => $_POST['id'],
            'nom' => $_POST['nom'],
            'descriptif' => $_POST['descriptif'],
            'photo' => $photoname,
            'prix' => $_POST['prix'],
            'stock' => $_POST['stock'],
            'categorie_id' => $_POST['categorie_id']
        ]);

        $_SESSION['messages']['success'][] = 'Produit ajouté avec succés ';

        header('location:../produits/list');
        exit();
    }

    public static function list()
    {

        $categories = Categorie::findAll();
        $produits = Produit::findAll();

        include(VIEWS . 'produits/list.php');
    }

    public static function delete()
    {

        Produit::delete(['id' => $_GET['id']]);

        $_SESSION['messages']['success'][] = 'Produit supprimé avec succés ';

        header('location:../produits/list');
        exit();
    }


    public static function commande()
    {
        $total = 0;
        for ($i = 0; $i < count($_SESSION['panier']['id']); $i++) :
            $total += $_SESSION['panier']['prix'][$i] * $_SESSION['panier']['quantite'][$i];
        endfor;

        $date = date_format(new DateTime('now'), 'Y-m-d');
        $reponse = Commande::create([
            'date' => $date,
            'statut' => 0,
            'montant' => $total,
            'utilisateur_id' => $_SESSION['membre']['id']
        ]);

        //die(var_dump($reponse));
        for ($i = 0; $i < count($_SESSION['panier']['id']); $i++) :
        
        Detail::create([

            'produit_id'=>$_SESSION['panier']['id'][$i],
            'commande_id'=>$reponse,
            'montant' => $_SESSION['panier']['prix'][$i] * $_SESSION['panier']['quantite'][$i],
            'quantite'=>$_SESSION['panier']['quantite'][$i]
        ]);
        endfor;

        unset($_SESSION['panier']);
        $_SESSION['messages']['success'][]='merci dde votre confiance';
        header('location:../');
    
    
    //die(var_dump($reponse));
    }
    public static function recap()
    {
        $commandes= Commande::findAll();

        // on initialise un tableau videsur lequel on effectuera des conditions dans recap.php
        $details=[];

        //ici in verifie la presence d'un parametre en GET (dans l'url) en l'occurence id qui interviendra lorsque l'on clique sur afficher details dans recap.php
        //cet id correspondant a l'id de la commande dont on souhaite afficher le details
        if (!empty($_GET['id'])):
            
            //si cet id est present on appelle la methode find presente dans le model detail.php qui permet de recuperer tous les achats(details )lié a cet id de commande (commande_id dans la table details)

            $details=Detail::find(['commande_id'=>$_GET['id']]);

        endif;
        //ici on verifie la presence d'un parametre en get 'action'
        //si ce parametre est présent on vide le tableau detail 
        if (!empty($_GET['action'])):

            $details=[];
        endif;

        include(VIEWS.'produits/recap.php');

}
}