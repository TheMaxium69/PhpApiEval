<?php

namespace Controllers;

class Like extends Controller
{

    protected $modelName = \Model\Like::class;
    
     /**
     *
     *count les likes d'un plat
     *
     */
    public function countApi(){


        if(!empty($_POST['id']) && ctype_digit($_POST['id'])){
            $plat_id = $_POST['id'];
        }
        if(!$plat_id){
            die("il faut entrer un id valide en paramtre dans l'url");
        }


        $nbLikes = $this->model->CountByPlat($plat_id);

        if(!$nbLikes){
            $nbLikes = 0;
        }

        header("Access-Control-Allow-Origin: *");

        //Json
        echo json_encode($nbLikes);
    }

    /**
     *
     *create d'un like
     *
     */
    public function insertApi(){

        if(!empty($_POST['plat_id']) && ctype_digit($_POST['plat_id'])){
            
            $plat_id = $_POST['plat_id'];

            $this->model->insert($plat_id);
        }else{
            die("il faut un id");
        }

    }
   
}    
