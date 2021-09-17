<?php 

class AvisController{

    public static function add()
    {

        if (isset($_GET['id'])) :
            $avis = Avis::find([
                'id' => $_GET['id']
            ]);

        endif;

        include(VIEWS . 'avis/add.php');
    }
    public static function save()
    {

          Avis::create([
            'id' => $_POST['id'],
            'commentaire' => $_POST['commentaire'],
            'note' => $_POST['note'],
            'utilisateur_id' => $_POST['utilisateur_id'],
            'produit_id' => $_POST['produit_id'],
            'date' => $_POST['date'],
        ]);

        $_SESSION['messages']['success'][] = 'Commentaire ajouté avec succés ';

        header('location:../avis/commentaires');
        exit();
    }
 public static function recapComm() {

    if (!empty($_GET['id'])):
            

        $avis=Avis::find(['produit_id'=>$_GET['id']]);

    endif;
 }

}

?>