<?php

class Produit extends Db
{
    public static function find($id)
    {
        $request = 'SELECT * FROM produit WHERE id=:id';
        $response = self::getDb()->prepare($request);
        $response->execute($id);
        return $response->fetch(PDO::FETCH_ASSOC);

    } 

    public static function delete($id){

        $request = 'DELETE FROM produit WHERE id=:id';
        $response = self::getDb()->prepare($request);
        return $response->execute($id);

    } 


    public static function findAll()
    {
        $request = 'SELECT * FROM produit';
        $response = self::getDb()->prepare($request);
        $response->execute();
        return $response->fetchAll(PDO::FETCH_ASSOC);

    } 
    public static function create(array $data)
    {
      //die(var_dump($data));
        $request = "REPLACE INTO produit VALUES (:id,:nom ,:descriptif,:photo ,:prix, :stock,:categorie_id  )";
        $response= self::getDb()->prepare($request);
        $response->execute($data);
        return self::getDb()->lastInsertId();
    }
}

