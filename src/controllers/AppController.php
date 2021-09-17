<?php

class AppController
{

    public static function index()
    {

        $produits = Produit::findAll();
        include(VIEWS . 'app/index.php');
    }

    public static function add()
    {
        $produit = Produit::find([
            'id' => $_POST['id']
        ]);

        $_SESSION['panier']['id'][] = $produit['id'];
        $_SESSION['panier']['photo'][] = $produit['photo'];
        $_SESSION['panier']['prix'][] = $produit['prix'];
        $_SESSION['panier']['nom'][] = $produit['nom'];
        $_SESSION['panier']['quantite'][] = $_POST['quantite'];

        header('location:../');
        exit();
    }

    public static function list()
    {
        if (isset($_GET['action'])) :
            unset($_SESSION['panier']);
            header('location:../');
        endif;

        include(VIEWS . 'app/panier.php');
    }

    public static function inscription()
    {
        if (!empty($_POST)) :
            $error = 0;
            if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) :
                $error++;
                $_SESSION['messages']['danger'][] = 'L\'email n\'est pas valide';

            endif;
            if (!isset($_POST['cp']) || !preg_match('#^[0-9]{5}$#', $_POST['cp'])) :
                $error++;
                $_SESSION['messages']['danger'][] = 'Le code postal n\'est pas valide';
            endif;

            $user = Utilisateur::find(['email' => $_POST['email']]);



            if (!empty($user['nom'])) :
                $error++;
                $_SESSION['messages']['danger'][] = 'Un compte existe déjà à cette adresse mail';
            endif;

            if ($error !== 0) :


                header('location:../user/inscription');
                exit();

            else :


                $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
                Utilisateur::create(
                    [
                        'id' => $_POST['id'],
                        'nom' => $_POST['nom'],
                        'prenom' => $_POST['prenom'],
                        'email' => $_POST['email'],
                        'mdp' => $mdp,
                        'adresse' => $_POST['adresse'],
                        'cp' => $_POST['cp'],
                        'ville' => $_POST['ville'],
                        'tel' => $_POST['tel'],
                        'role' => 'ROLE_USER',

                    ]
                );

                header('location:../user/connexion');
                exit();
            endif;

        endif;


        include(VIEWS . 'app/inscription.php');
    }

    public static function connexion()
    {

        $commande = false;
        if (!empty($_GET['commande'])) :
            $commande = true;
        endif;

        if (!empty($_POST)) :
            $user = Utilisateur::find(['email' => $_POST['email']]);
            if (!empty($user)) :
                if (password_verify($_POST['mdp'], $user['mdp'])) :
                    $_SESSION['membre'] = $user;
                    $_SESSION['messages']['success'][] = 'Bienvenue ' . $user['prenom'] . ' !!!';
                    if ($user['role'] == 'ROLE_USER' && $_POST['commande'] == false) :
                        header('location:../');
                        exit();

                    elseif ($user['role'] == 'ROLE_USER' && $_POST['commande'] == true) :
                        header('location:../panier/list');
                        exit();
                    else :
                        header('location:../produits/list');
                        exit();
                    endif;
                else :
                    $_SESSION['messages']['danger'][] = 'erreur sur le mot de passe';
                    header('location:../user/connexion');
                    exit();
                endif;
            else :
                $_SESSION['messages']['danger'][] = 'Aucun compte a cet adresse mail ';
                header('location:../user/connexion');
                exit();
            endif;

        endif;

        if (!empty($_GET['action'])) :
            unset($_SESSION['membre']);
            unset($_SESSION['panier']);
            $_SESSION['messages']['success'][] = 'A bientot';
            header('location:../');
            exit();
        endif;

        include(VIEWS . 'app/connexion.php');
    }
}
