<?php

namespace Controllers;

class Plat extends Controller
{

    protected $modelName = \Model\Plat::class;
    
    /**
     *
     *suppression d'un plat
     *
     */
    public function suppApi(){


        if(!empty($_POST['id']) && ctype_digit($_POST['id'])){
            $plat_id = $_POST['id'];
        }
        if(!$plat_id){
            die("il faut entrer un id valide en paramtre dans l'url");
        }


        $plat = $this->model->find($plat_id);

        if(!$plat){
            die("cette recette est inexistante");
        }

        $this->model->delete($plat_id);
    }

    /**
     *
     *create d'un plat
     *
     */
    public function insertApi(){

        if(!empty($_POST['price']) && ctype_digit($_POST['price']) && 
           !empty($_POST['name']) && !empty($_POST['description']) && 
           !empty($_POST['restaurant_id']) && ctype_digit($_POST['restaurant_id'])){
            
            $name = htmlspecialchars($_POST['name']);
            $price = $_POST['price'];
            $description = htmlspecialchars($_POST['description']);
            $restaurant_id = $_POST['restaurant_id'];

            $this->model->insert($name , $price, $description, $restaurant_id);
        }else{
            die("il faut entrer tout le formulaire");
        }

    }
}    
