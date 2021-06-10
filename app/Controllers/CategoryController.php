<?php

namespace App\Controllers;

use App\Models\Category;

// Si j'ai besoin du Model Category
// use App\Models\Category;

class CategoryController extends CoreController
{

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


    public function addPost()
    {
        // récupérer les infos du formulaires
        $name = filter_input(INPUT_POST, 'name');
        $subtitle = filter_input(INPUT_POST, 'subtitle', FILTER_SANITIZE_STRING);
        $picture = filter_input(INPUT_POST, 'picture', FILTER_VALIDATE_URL);

        //dd($picture);
        // je fabrique un tableau qui va me permetre de stoquer les eventuelles erreurs
        $errorList = [];

        if (empty($name)) {
            $errorList[] = 'Le nom est vide';
        }

        if (empty($subtitle)) {
            $errorList[] = 'La description est vide';
        }

        if (empty($picture)) {
            $errorList[] = 'L\'image est vide';
        }

        if ($picture === false) {
            $errorList[] = 'L\'URL d\'image est invalide';
        }

        // si je n'ai aucune erreur, on peut se permetre d'ajouter
        // l'entrée en BDD
        if (empty($errorList)) {
            // je veux ajouter l'entrée en BDD
            // je fabrique un objet a partir du model Category
            $category = new Category();
            //! on met a jour les propriétés de l'instance 
            $category->setName($name);
            $category->setSubtitle($subtitle);
            $category->setPicture($picture);


            // la methode insert va renvyer true si tout s'est bien passé
            // ci dessous je pourrais passer par une variable intermédiaire
            // $result = $category->insert()
            // puis j'aurais fait une condition sur result 
            // if( $result === true){ ... }

            if ($category->save()) {
                // si tout se passe bien je redirige vers la liste des
                // categories 
                header('Location: /category/list');
            } else {
                // dans ce else, la methode insert nous a renvoyé false
                // on a donc eu un pépin lors de l'ajout en BDD.
                $errorList[] = 'La sauvegarde a échoué';
            }
        }


        // si on a eu une erreur sur la route
        if (!empty($errorList)) {
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
        $this->generateCSRFToken();
        // ici je viens fabriquer un objet "vide" que je vais transmettre a la vue
        // pour que $category existe bien dans add.tpl.php
        // ce qui nous evite l'apparition d'erreurs
        $category = new Category();
        $this->show('category/add', ['category' => $category]);
    }

    /**
     * Modifier une Categorie
     *
     */
    public function update($categoryId)
    {
        $category =  Category::find($categoryId);
        $this->show('category/add', ['category' => $category]);
    }


    public function updatePost($categoryId)
    {

        // attention ceci n'est pas une bonne pratique 
        global $router;

        // je récupère les données en transit dans POST
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $subtitle = filter_input(INPUT_POST, 'subtitle', FILTER_SANITIZE_STRING);
        $picture = filter_input(INPUT_POST, 'picture', FILTER_VALIDATE_URL);

        //je vais récupérer la categorie concernée
        $category = Category::find($categoryId);

        //! et on met a jour l'objet
        $category->setName($name);
        $category->setSubtitle($subtitle);
        $category->setPicture($picture);

        if ($category->save()) {
            // si l'update s'est bien passé ($category->update() va nous renvoyer true)
            $url = $router->generate('category-list');
            header('Location: ' . $url);
        } else {
            //todo afficher message d'erreur 
        }
    }

    public function delete($categoryId)
    {
        global $router;
        $category = Category::find($categoryId);

        if ($category->delete()) {
            $url = $router->generate('category-list');
            header('Location: ' . $url);
        }
    }

    public function homeOrder()
    {
        $this->generateCSRFToken();
        $categories = Category::findAll();
        $this->show('category/home-order', ['categories' => $categories]);
    }

    public function homeOrderPost()
    {
        
        $emplacement = array_unique($_POST['emplacement']);
        if (count($emplacement) == 5) {
            $idEmplacement1 = $emplacement[0];
            $idEmplacement2 = $emplacement[1];
            $idEmplacement3 = $emplacement[2];
            $idEmplacement4 = $emplacement[3];
            $idEmplacement5 = $emplacement[4];

            $filtervalidate1 = filter_var($idEmplacement1, FILTER_VALIDATE_INT);
            $filtervalidate2 = filter_var($idEmplacement2, FILTER_VALIDATE_INT);
            $filtervalidate3 = filter_var($idEmplacement3, FILTER_VALIDATE_INT);
            $filtervalidate4 = filter_var($idEmplacement4, FILTER_VALIDATE_INT);
            $filtervalidate5 = filter_var($idEmplacement5, FILTER_VALIDATE_INT);

            if (!$filtervalidate1 || !$filtervalidate2 || !$filtervalidate3 || !$filtervalidate4 || !$filtervalidate5) {
                $categories = Category::findAllHomepage();
                $viewVars = [
                'error' => 'erreur de sélection',
                'categories' => $categories
            ];
                $this->show('category/home-order', $viewVars);
            }
        

            $result = Category::updateHomeOrder($_POST['emplacement']);

            if ($result) {
                $categories = Category::findAll();
                $viewVars = [
                'validate' => 'Home order modifié',
                'categories' => $categories
            ];
                $this->show('category/home-order', $viewVars);
            } else {
                $categories = Category::findAll();
                $viewVars = [
                'error' => 'erreur de sélection',
                'categories' => $categories
            ];
                $this->show('category/home-order', $viewVars);
            }
        } else {
            $categories = Category::findAll();
                $viewVars = [
                'error' => 'erreur de sélection',
                'categories' => $categories
            ];
                $this->show('category/home-order', $viewVars);
        }
    }
}
