<?php

namespace Model;

use PDO;

class Plat extends Model
{

    protected $table = "plats";

    public $id;
    public $name;
    public $price;
    public $description;
    public $restaurant_id;


    /**
     * 
     * Select tout les plats d'un restaurant
     * 
     */
    function findAllByRestaurants(int $restaurant_id)
    {

        $resultat =  $this->pdo->prepare('SELECT * FROM plats WHERE restaurant_id = :restaurant_id');
        $resultat->execute(["restaurant_id"=> $restaurant_id]);

        $plats = $resultat->fetchAll( PDO::FETCH_CLASS, \Model\Plat::class);

        return $plats;
    }

}