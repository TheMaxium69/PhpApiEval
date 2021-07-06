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
}    
