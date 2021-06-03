<?php

namespace App\Controllers;

use \App\Models\Category;
use \App\Models\Product;
// Si j'ai besoin du Model Category
// use App\Models\Category;

class MainController extends CoreController
{

    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function home()
    {
        $modelCategory = new Category;

        $homeCategory = $modelCategory->findAllHomepage();

        $modelProduct = new Product;
        $homeProduct = $modelProduct->findAllHomepage();

        $viewVars =
            [
                'categoryHome' => $homeCategory,
                'productHome' => $homeProduct
            ];
        // On appelle la méthode show() de l'objet courant
        // En argument, on fournit le fichier de Vue
        // Par convention, chaque fichier de vue sera dans un sous-dossier du nom du Controller
        $this->show('main/home', $viewVars);
    }

    public function categories()
    {
        $modelCategory = new Category;
        $categorys = $modelCategory->findAll();
        $viewVars = ['categorys' => $categorys]; // création d'un tableau associatif qui sera donné en paramètre de show pour créer un tableau
        $this->show('main/categories', $viewVars);
    }

    public function categoryAdd()
    {

        $this->show('main/category_add');
    }

    public function product()
    {
        $modelProduct = new Product;
        $products = $modelProduct->findAll();
        $viewVars = ['products' => $products];
        $this->show('main/product', $viewVars);
    }


    public function productAdd()
    {
        $this->show('main/product_add');
    }
}
