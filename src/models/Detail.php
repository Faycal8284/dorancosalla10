<?php
 
 class Detail extends Db{

    public static function create(array $data)
    {
        $pdo=self::getDb();

        $request="INSERT INTO detail(produit_id, commande_id, montant, quantite) VALUES (:produit_id, :commande_id, :montant,:quantite)";
        $response=  $pdo->prepare($request);
        $response->execute($data);
        return $pdo->lastInsertId();
        
    }

 

    public static function find(array $id)
    {
        $request="SELECT * FROM detail WHERE commande_id= :commande_id";
        $response=self::getDb()->prepare($request);
        $response->execute($id);
        return $response->fetchAll(PDO::FETCH_ASSOC);

    }


    
 }
 ?>