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
    public $nbLike;


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

    /**
     * 
     * Create un plat
     * 
     */

    function insert(string $name, int $price, string $description, int $restaurant_id)
    {

        $resultat = $this->pdo->prepare("INSERT INTO `plats`(`name`, `price`, `description`, `restaurant_id`) VALUES (:name, :price, :description, :restaurant_id)");


        $resultat->execute([
            'name' => $name,
            'price' => $price,
            'description' => $description,
            'restaurant_id' => $restaurant_id
        ]);

    }

    function set(Plat $plat, string $nbLikes){
        $plat->nbLike = $nbLikes;
    }

}