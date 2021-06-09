<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Type;
use App\Models\Category;

// Si j'ai besoin du Model Category
// use App\Models\Category;

class ProductController extends CoreController {

    /**
     * Liste des produits
     *
     * @return void
     */
    public function list()
    {
        $this->checkAuthorization(['catalog-manager', 'admin']);
        $products = Product::findAll();
        $this->show('product/list', ['products' => $products]);
    }

    /**
     * Ajout produit
     *
     * @return void
     */
    public function add()
    {
        $this->checkAuthorization(['catalog-manager', 'admin']);
        $product = new Product();

        $categories = Category::findAll();
        $brands = Brand::findAll();
        $types = Type::findAll();

        $viewVars = [
            'product' => $product,
            'categories' => $categories,
            'brands' => $brands,
            'types' => $types
        ];

        $this->show('product/add', $viewVars);
    }

    /**
     * Methode traitement du formulaire ajout produit
     *
     * @return void
     */
    public function addPost()  
    {
        $this->checkAuthorization(['catalog-manager', 'admin']);
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

    /**
     * Update produit (page formulaire)
     *
     * @param [type] $productId
     * @return void
     */
    public function update($productId)
    {
        $this->checkAuthorization(['catalog-manager', 'admin']);
        $product = Product::find($productId);
        $categories = Category::findAll();
        $brands = Brand::findAll();
        $types = Type::findAll();
        $viewVars = [
            'product' => $product,
            'categories' => $categories,
            'brands' => $brands,
            'types' => $types
        ];
         
         $this->show('product/add', $viewVars);
    }

    /**
     * Update produit (traitement données forumlaire)
     */
    public function updatePost($productId)
    {
        $this->checkAuthorization(['catalog-manager', 'admin']);
        global $router;
        // 1/ récupérer les informations du formulaire
        $name = filter_input(INPUT_POST, 'name',  FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST, 'description',  FILTER_SANITIZE_STRING);
        $picture = filter_input(INPUT_POST, 'picture', FILTER_VALIDATE_URL); 
        $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
        $rate = filter_input(INPUT_POST, 'rate', FILTER_VALIDATE_INT);
        $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);
        $brand_id = filter_input(INPUT_POST, 'brand_id', FILTER_VALIDATE_INT);
        $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
        $type_id = filter_input(INPUT_POST, 'type_id', FILTER_VALIDATE_INT);
        // 2/ récupérer les informations du produit
        // concernée (avant modification)
        // (sous la forme d'un objet)
        $product = Product::find($productId);
        // 3/ Mettre a jour l'objet avec les nouvelles infos 
        // (l'objet ET PAS LA BDD (Pas encore...))
        $product->setName($name);
        $product->setDescription($description);
        $product->setPicture($picture);
        $product->setPrice($price);
        $product->setRate($rate);
        $product->setStatus($status);
        $product->setBrandId($brand_id);
        $product->setCategoryId($category_id);
        $product->setTypeId($type_id);
        // 4/ On met a jour la BDD
        if($product->save()){
            // SI TOUT A BIEN MARCHE
            // 5/ Si tout se passe bien -> on redirige
            $url = $router->generate('product-list');
            header('Location: ' .$url);
        } else {
            // SI ON A EU UN PEPIN,
            // SI $category->update() nous a renvoyé false
            //message d'erreur
            // + revenir sur modifier la categorie
        }




    }

    /**
     * Delete de produit 
     *
     * @param [type] $productId
     * @return void
     */
    public function delete($productId)
    {
        $this->checkAuthorization(['catalog-manager', 'admin']);
        global $router;
        // On instancie un objet avec lequel nous 
        // allons récupérer les infos de la categorie voulue
  
        $product = Product::find($productId);

        if($product->delete()){
            $url = $router->generate('product-list');
            header('Location: ' . $url);
        }
    }




}
