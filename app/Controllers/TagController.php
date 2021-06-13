<?php 

namespace App\Controllers;

use App\Models\Tag;
use App\Models\Product;

class TagController extends CoreController
{
    public function addBind()
    {
        //TODO Mauvause pratique : 
        global $router;
        $this->generateCSRFToken();

        $Tags = Tag::findAll();
        $products = Product::findAll();

        $viewVars = [
            "tags" => $Tags,
            "products" => $products
        ];
        $this->show("tag/add", $viewVars);
    }

    public function addPost()
    {
        //TODO Mauvause pratique : 
        global $router;

        $errors = [];

        // on récupère les données du form
        $name = filter_input(INPUT_POST, 'nameTag', FILTER_SANITIZE_STRING );
        $product = filter_input(INPUT_POST, 'product', FILTER_VALIDATE_INT);

        // si un seul des champs n'est pas fournit 
        if(!$name || !$product ){
        // alors j'ajoute ce message d'erreur $errorList
        $errors[] = 'Tous les champs sont obligatoires pour ajouter un tag';
        }
    
        //! petit nouveauté : filter_var
        // https://www.php.net/manual/fr/function.filter-var.php
        // il faut d'abord vérifier que l'email est valide, c'est à dire contient bien "@", puis un nom de domaine... bref, a bien une forme d'email, quoi.
        // on utilise filter_var() pour vérifier la validité de l'email. Si l'email est valide, filter_var() renvoie la valeur, false sinon
        // voir https://www.php.net/manual/fr/function.filter-var.php

    

        // ici, on veut empêcher la fonction de continuer normalement si une erreur a eu lieu, 
        // c'est à dire si le tableau $errors n'est pas vide
        if(count($errors) > 0){
        dump($errors);
        exit();
        }

        /* --------------------
        -- ENREGISTREMENT --
        -------------------- */
        // on crée le model et on renseigne les valeurs des propriétés via les setters
        $newTag = new Tag;
        $newTag->setName($name);
        // on sauvegarde le model en BDD
        $newTag->save();

        $newTag->bindByProductId($product);

        // on redirige sur la page de liste
        header('Location: ' . $router->generate('tag-addBind'));
        exit();

    }

    public function bindPost()
    {
          //TODO Mauvause pratique : 
          global $router;

          $errors = [];
  
          // on récupère les données du form
          $tag = filter_input(INPUT_POST, 'tagId', FILTER_VALIDATE_INT);
          $product = filter_input(INPUT_POST, 'productId', FILTER_VALIDATE_INT);


          // si un seul des champs n'est pas fournit 
          if(!$tag || !$product ){
          // alors j'ajoute ce message d'erreur $errorList
          $errors[] = 'Tous les champs sont obligatoires pour lier un produit';
          }
      
          //! petit nouveauté : filter_var
          // https://www.php.net/manual/fr/function.filter-var.php
          // il faut d'abord vérifier que l'email est valide, c'est à dire contient bien "@", puis un nom de domaine... bref, a bien une forme d'email, quoi.
          // on utilise filter_var() pour vérifier la validité de l'email. Si l'email est valide, filter_var() renvoie la valeur, false sinon
          // voir https://www.php.net/manual/fr/function.filter-var.php
  
      
  
          // ici, on veut empêcher la fonction de continuer normalement si une erreur a eu lieu, 
          // c'est à dire si le tableau $errors n'est pas vide
          if(count($errors) > 0){
          dump($errors);
          exit();
          }
  
          /* --------------------
          -- ENREGISTREMENT --
          -------------------- */
          // on crée le model et on renseigne les valeurs des propriétés via les setters
          $newTag = Tag::find($tag);

          $newTag->bindByProductId($product);
  
          // on redirige sur la page de liste
          header('Location: ' . $router->generate('tag-addBind'));
          exit();
    }

    public function list()
    {
        $products = Product::findAll();
        
        $this->show('tag/list', ['products' => $products]);
    }
}