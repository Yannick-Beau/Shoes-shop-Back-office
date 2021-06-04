<?php

namespace App\Controllers;

use App\Models\Product;

// Si j'ai besoin du Model Category
// use App\Models\Category;

class ProductController extends CoreController {

    /**
     * Liste des catégories
     *
     * @return void
     */
    public function list()
    {
        $products = Product::findAll();
        $this->show('product/list', ['products' => $products]);
    }

    /**
     * Ajout catégorie
     *
     * @return void
     */
    public function add()
    {
        $this->show('product/add');
    }


}
