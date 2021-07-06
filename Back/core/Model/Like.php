<?php

namespace Model;

use PDO;

class Like extends Model
{

    protected $table = "likes";

    public $id;
    public $plat_id;


    /**
     * 
     * Count tout les likes d'un plat
     * 
     */
    function CountByPlat(int $plat_id)
    {

        $resultat =  $this->pdo->prepare('SELECT * FROM likes WHERE plat_id = :plat_id');
        $resultat->execute(["plat_id"=> $plat_id]);

        $nbLike = $resultat->rowCount();

        return $nbLike;
    }

    /**
     * 
     * insert un like d'un plat
     * 
     */

    function insert(int $plat_id)
    {

        $resultat = $this->pdo->prepare("INSERT INTO `likes`(`plat_id`) VALUES (:plat_id)");


        $resultat->execute([
            'plat_id' => $plat_id,
        ]);

    }

}