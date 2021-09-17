<?php

class Utilisateur extends Db
{


    public static function create(array $data)
    {
      //die(var_dump($data));
        $request = "REPLACE INTO utilisateur VALUES (:id,:nom ,:prenom,:email,:mdp,:adresse,:cp,:ville,:tel,:role )";
        $response= self::getDb()->prepare($request);
        $response->execute($data);
        return self::getDb()->lastInsertId();
    }

    public static function find($email)
    {
        $request = 'SELECT * FROM utilisateur WHERE email=:email';
        $response = self::getDb()->prepare($request);
        $response->execute($email);
        return $response->fetch(PDO::FETCH_ASSOC);

    } 

    public static function findById($id)
    {
        $request = 'SELECT * FROM utilisateur WHERE id=:id';
        $response = self::getDb()->prepare($request);
        $response->execute($id);
        return $response->fetch(PDO::FETCH_ASSOC);

    } 



}

?>