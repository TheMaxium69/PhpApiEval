<?php

namespace Controllers;

class Restaurant extends Controller
{

    protected $modelName = \Model\Restaurant::class;
    


    /**
     * afficher tout les restaurants
     *
     */

    public function indexApi()
    {

        $restaurants = $this->model->findAll($this->modelName);

        header('Access-Control-Allow-Origin: *');

        //Json
        echo json_encode($restaurants);

    }

    /**
     * afficher un restaurant
     *
     */
    public function showApi(){

        $restaurant_id = null;

        if(!empty($_GET['id']) && ctype_digit($_GET['id'])){

            $restaurant_id = $_GET['id'];
        }

        if(!$restaurant_id){
            die("il faut absolument entrer un id dans l'url pour que le script fonctionne");
        }

        $restaurant = $this->model->find($restaurant_id);

        $modelPlat = new \Model\Plat();
        $plats = $modelPlat->findAllByRestaurants($restaurant_id);


        header("Access-Control-Allow-Origin: *");

        //Json
        echo json_encode(['restaurant' => $restaurant, 
                          'plats' => $plats]);
    }
}    
