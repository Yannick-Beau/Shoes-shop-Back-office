<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Product;

// Si j'ai besoin du Model Category
// use App\Models\Category;

class MainController extends CoreController {

    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function home()
    {
        $this->checkAuthorization(['catalog-manager', 'admin']);

        // On appelle la méthode show() de l'objet courant
        // En argument, on fournit le fichier de Vue
        // Par convention, chaque fichier de vue sera dans un sous-dossier du nom du Controller
        
        
        // c'est ici qu'on va faire appel a nos Models pour 
        // transmettre par la suite des infos a la vue ! 

        // dans un premier temps je fabrique un objet a partir
        // du Model qui m'interesse
       // $categoryModel = new Category();
        // je vais en suite appeller une methode de cette objet qui 
        // puisse nous renvoyer les 3 dernières categories a afficher sur la page 
        // d'accueil du backoffice
        //$categories = $categoryModel->findThreeCategories();

        //! nouveauté 
        // ICI Je viens appeller la methode findThreeCategory()
        // de ma classe Category
        //! SANS AVOIR A INSTANCIER UN NOUVEL OBJET (pas de new ...)
        // Ceci est possible grace au :: (opérateur de résolution de portée // Paamayim Nekudotayim)
        $categories = Category::findThreeCategories();
      
        //$productModel = new Product();
        //$products = $productModel->findThreeProducts();

        
        $products = Product::findThreeProducts();

        $tatayoyo = [
            'categories' => $categories,
            'products' => $products 
        ];

        
        $this->show('main/home', $tatayoyo);
    }
}
