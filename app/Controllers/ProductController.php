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

    public function addPost()  
    {
        // récupération des données du formulaire
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
        $picture = filter_input(INPUT_POST, 'picture', FILTER_VALIDATE_URL);
        $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
        $rate = filter_input(INPUT_POST, 'rate', FILTER_VALIDATE_INT);
        $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);
        $brand_id = filter_input(INPUT_POST, 'brand_id',  FILTER_VALIDATE_INT);
        $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
        $type_id = filter_input(INPUT_POST, 'type_id', FILTER_VALIDATE_INT);

        // preparation du tableau d'erreurs
        $errorList = [];

        // on fait des verifications ! 
        if(empty($name)){
            $errorList[] = 'Le nom est vide';
        }

        if(empty($description)){
            $errorList[] = 'La description vide';
        }

        if(empty($picture)){
            $errorList[] = 'L\'image est vide';
        }

        if($picture === false){
            $errorList[] = 'L\'URL d\'image est invalide';
        }

        if ($price === false) {
            $errorList[] = 'Le prix est invalide';
        }
        if ($rate === false) {
            $errorList[] = 'La note est invalide';
        }
        if ($status === false) {
            $errorList[] = 'Le statut est invalide';
        }
        if ($brand_id === false) {
            $errorList[] = 'La marque est invalide';
        }
        if ($category_id === false) {
            $errorList[] = 'La catégorie est invalide';
        }
        if ($type_id === false) {
            $errorList[] = 'Le type est invalide';
        }

        // si on a pas eu d'erreurs
        if(empty($errorList)){
            // On instancie un nouveau modèle de type Product.
            $product = new Product();
            // On met à jour les propriétés de l'instance.
            $product->setName($name);
            $product->setDescription($description);
            $product->setPicture($picture);
            $product->setPrice($price);
            $product->setRate($rate);
            $product->setStatus($status);
            $product->setBrandId($brand_id);
            $product->setCategoryId($category_id);
            $product->setTypeId($type_id);

            if($product->insert()){
                header('Location: /product/list');
                exit;
            } else {
                $errorList[] = 'La sauvegarde a échoué';
            }

        }

        if(!empty($errorList)){
            $this->show('product/add', ['errorList' => $errorList]);
        }




    }

    public function editPost()  
    {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
        $picture = filter_input(INPUT_POST, 'picture', FILTER_VALIDATE_URL);
        $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
        $rate = filter_input(INPUT_POST, 'rate', FILTER_VALIDATE_INT);
        $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);
        $brand_id = filter_input(INPUT_POST, 'brand_id',  FILTER_VALIDATE_INT);
        $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
        $type_id = filter_input(INPUT_POST, 'type_id', FILTER_VALIDATE_INT);

        $errorList = [];

        if(empty($name)){
            $errorList[] = 'Le nom est vide';
        }

        if(empty($description)){
            $errorList[] = 'La description vide';
        }

        if(empty($picture)){
            $errorList[] = 'L\'image est vide';
        }

        if($picture === false){
            $errorList[] = 'L\'URL d\'image est invalide';
        }

        if ($price === false) {
            $errorList[] = 'Le prix est invalide';
        }
        if ($rate === false) {
            $errorList[] = 'La note est invalide';
        }
        if ($status === false) {
            $errorList[] = 'Le statut est invalide';
        }
        if ($brand_id === false) {
            $errorList[] = 'La marque est invalide';
        }
        if ($category_id === false) {
            $errorList[] = 'La catégorie est invalide';
        }
        if ($type_id === false) {
            $errorList[] = 'Le type est invalide';
        }

        if(empty($errorList)){
            $product = new Product();
            $product->setName($name);
            $product->setDescription($description);
            $product->setPicture($picture);
            $product->setPrice($price);
            $product->setRate($rate);
            $product->setStatus($status);
            $product->setBrandId($brand_id);
            $product->setCategoryId($category_id);
            $product->setTypeId($type_id);

            if($product->update()){
                header('Location: /product/list');
                exit;
            } else {
                $errorList[] = 'La sauvegarde a échoué';
            }
        }

        if(!empty($errorList)){
            $this->show('product/edit', ['errorList' => $errorList]);
        }
    }

    public function edit()
    {
        $requestUri = explode ( "/", $_SERVER['REQUEST_URI'] );
        $requestId = end($requestUri);

        $product = new Product();
        $product = Product::find($requestId);

        $this->show('product/edit', ['product' => $product]);
    }


}
