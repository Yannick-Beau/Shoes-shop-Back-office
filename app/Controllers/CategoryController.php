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
        // récupérer les infos du formulaires
        $name = filter_input(INPUT_POST, 'name');
        $subtitle = filter_input(INPUT_POST, 'subtitle', FILTER_SANITIZE_STRING);
        $picture = filter_input(INPUT_POST, 'picture', FILTER_VALIDATE_URL);

        //dd($picture);
        // je fabrique un tableau qui va me permetre de stoquer les eventuelles erreurs
        $errorList = [];

        if(empty($name)){
            $errorList[] = 'Le nom est vide';
        }

        if(empty($subtitle)){
            $errorList[] = 'La description est vide';
        }

        if(empty($picture)){
            $errorList[] = 'L\'image est vide';
        }

        if($picture === false){
            $errorList[] = 'L\'URL d\'image est invalide';
        }

        // si je n'ai aucune erreur, on peut se permetre d'ajouter
        // l'entrée en BDD
        if(empty($errorList)){
            // je veux ajouter l'entrée en BDD
            // je fabrique un objet a partir du model Category
            $category = new Category();
            //! on met a jour les proipriétés de l'instance 
            $category->setName($name);
            $category->setSubtitle($subtitle);
            $category->setPicture($picture);

            
            // la methode insert va renvyer true si tout s'est bien passé
            // ci dessous je pourrais passer par une variable intermédiaire
            // $result = $category->insert()
            // puis j'aurais fait une condition sur result 
            // if( $result === true){ ... }
        
            if($category->insert()){
                // si tout se passe bien je redirige vers la liste des
                // categories 
                header('Location: /category/list');
            }else{
                // dans ce else, la methode insert nous a renvoyé false
                // on a donc eu un pépin lors de l'ajout en BDD.
                $errorList[] = 'La sauvegarde a échoué';
            }
        }


        // si on a eu une erreur sur la route
        if(!empty($errorList)){
            // j'affiche la vue category/add en lui transmettant
            // la liste des erreurs !  
            $this->show('category/add', ['errorList' => $errorList]);
        }




        // verifier si tout est bon
        // pour ajouter la categorie en BDD ! 


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

    /**
     * Modifier catégorie
     *
     * @return void
     */
    public function edit()
    {
        $requestUri = explode( '/', $_SERVER['REQUEST_URI'] );
        $id = end($requestUri);

        $category = new Category();
        $category = Category::find($id);

        $this->show('category/edit', ['category' => $category]);
    }

    /**
     * Modifier catégorie
     *
     * @return void
     */
    public function editPost()
    {
          // récupérer les infos du formulaires
          $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
          $subtitle = filter_input(INPUT_POST, 'subtitle', FILTER_SANITIZE_STRING);
          $picture = filter_input(INPUT_POST, 'picture', FILTER_VALIDATE_URL);
          $homeOrder = filter_input(INPUT_POST, 'homeOrder', FILTER_VALIDATE_INT);
  
          //dd($picture);
          // je fabrique un tableau qui va me permetre de stoquer les eventuelles erreurs
          $errorList = [];
  
          if(empty($name)){
              $errorList[] = 'Le nom est vide';
          }
  
          if(empty($subtitle)){
              $errorList[] = 'La description est vide';
          }
  
          if(empty($picture)){
              $errorList[] = 'L\'image est vide';
          }
  
          if($picture === false){
              $errorList[] = 'L\'URL d\'image est invalide';
          }

          if($homeOrder === false){
            $errorList[] = 'Home order est invalide';
        }
  
          // si je n'ai aucune erreur, on peut se permetre d'ajouter
          // l'entrée en BDD
          if(empty($errorList)){
              // je veux ajouter l'entrée en BDD
              // je fabrique un objet a partir du model Category
              $category = new Category();
              //! on met a jour les proipriétés de l'instance 
              $category->setName($name);
              $category->setSubtitle($subtitle);
              $category->setPicture($picture);
              $category->setHomeOrder($homeOrder);
              
              // la methode insert va renvyer true si tout s'est bien passé
              // ci dessous je pourrais passer par une variable intermédiaire
              // $result = $category->insert()
              // puis j'aurais fait une condition sur result 
              // if( $result === true){ ... }
          
              if($category->update()){
                  // si tout se passe bien je redirige vers la liste des
                  // categories 
                  header('Location: /category/list');
              }else{
                  // dans ce else, la methode insert nous a renvoyé false
                  // on a donc eu un pépin lors de l'ajout en BDD.
                  $errorList[] = 'La sauvegarde a échoué';
              }
          }
  
  
          // si on a eu une erreur sur la route
          if(!empty($errorList)){
              // j'affiche la vue category/add en lui transmettant
              // la liste des erreurs !  
              $this->show("category/edit", ['errorList' => $errorList]);
          }
  
  
  
  
          // verifier si tout est bon
          // pour ajouter la categorie en BDD ! 
    
    }


}
