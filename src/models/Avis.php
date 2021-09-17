<?php

class Avis extends Db
{
    public static function find(array $id)
    {
        $request="SELECT * FROM avis WHERE produit_id= :produit_id";
        $response=self::getDb()->prepare($request);
        $response->execute($id);
        return $response->fetchAll(PDO::FETCH_ASSOC);

    }
    public static function create(array $data)
    {
      //die(var_dump($data));
        $request = "REPLACE INTO avis VALUES (:id,:commentaire,:note,:utilisateur_id ,:produit_id, :date,  )";
        $response= self::getDb()->prepare($request);
        $response->execute($data);
        return self::getDb()->lastInsertId();
    }
}
?>