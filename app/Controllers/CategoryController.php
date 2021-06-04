<?php

namespace App\Controllers;
use App\Models\Category;

// Si j'ai besoin du Model Category
// use App\Models\Category;

class CategoryController extends CoreController {

    /**
     * Liste des catégories
     *
     * @return void
     */
    public function list()
    {
        // transmettre a la vue la liste des categories.
        $categories = Category::findAll();

        // sur la ligne ci dessous, plutot que de fabriquer une petite boite de rangement (tableau associatif) que je vais donner a ma vue grâce au deuxieme argument de la methode show, 
        //! je fabrique DIRECTEMENT la petite boite a la place du deuxieme argument
        

        $this->show('category/list', ['categories' => $categories]);
    }

    public function addPost(){
        echo "j'ai validé mon form YATA";
        dd($_POST);
    }

    /**
     * Ajout catégorie
     *
     * @return void
     */
    public function add()
    {
        $this->show('category/add');
    }


}
