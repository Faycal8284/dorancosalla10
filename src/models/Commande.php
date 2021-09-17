<?php
 
 class Commande extends Db{

    public static function create(array $data)
    {
        $pdo=self::getDb();

        $request="INSERT INTO commande(date, statut, montant, utilisateur_id) VALUES (:date,:statut,:montant,:utilisateur_id)";
        $response=  $pdo->prepare($request);
        $response->execute($data);
        return $pdo->lastInsertId();
        
    }
    public static function findAll()
    {
        $request="SELECT * FROM commande";
        $response=self::getDb()->prepare($request);
        $response->execute();
        return $response->fetchAll(PDO::FETCH_ASSOC);
        
    }
 }
 ?>