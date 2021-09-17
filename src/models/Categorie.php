<?php

class Categorie extends Db
{

    public static function find($id)
    {
        $request = 'SELECT * FROM categorie WHERE id=:id';
        $response = self::getDb()->prepare($request);
        $response->execute($id);
        return $response->fetch(PDO::FETCH_ASSOC);

    } 

    public static function findAll()
    {
        $request='SELECT * FROM categorie';
        $response= self::getDb()->prepare($request);
        $response->execute();

        return $response->fetchAll(PDO::FETCH_ASSOC);

    }


    public static function create(array $data)
    {
        //die(var_dump($data));
        $request = "REPLACE INTO categorie VALUES (:id,:nom  )";
        $response= self::getDb()->prepare($request);
        $response->execute($data);
        return self::getDb()->lastInsertId();
    }

    public static function delete($id){

        $request = 'DELETE FROM categorie WHERE id=:id';
        $response = self::getDb()->prepare($request);
        return $response->execute($id);

    } 


}
