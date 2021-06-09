<?php

namespace App\Controllers;



//Une classe abstraite ne peux pas etre instanciée,
// elle sert juste de base pour les classe enfant.
// coreModel = un MODELE ABSTRAIT / UNE CLASS ABSTRAITE
//---> INTERDICTION D'INSTANCIER UNE CLASSE ABSTRAITE
//---(> SI INSTANCIATION = ERREUR ) 
//Dans une classe abstraite on va pouvoir INDIQUER quel METHODe les enfants doivent IMPLEMENTER
//cad : les enfants de cette classe, ils doivent avoir une methode insert, les enfants de cettes classe ils doivent avoir une methode delete ...etc.
//et si ils ne l'ont pas ce n'est pas mon enfant !

abstract class CoreController {
    /**
     * Méthode permettant d'afficher du code HTML en se basant sur les views
     *
     * @param string $viewName Nom du fichier de vue
     * @param array $viewVars Tableau des données à transmettre aux vues
     * @return void
     */
    protected function show(string $viewName, $viewVars = []) {
        // On globalise $router car on ne sait pas faire mieux pour l'instant
        global $router;

        // Comme $viewVars est déclarée comme paramètre de la méthode show()
        // les vues y ont accès
        // ici une valeur dont on a besoin sur TOUTES les vues
        // donc on la définit dans show()
        $viewVars['currentPage'] = $viewName; 

        // définir l'url absolue pour nos assets
        $viewVars['assetsBaseUri'] = $_SERVER['BASE_URI'] . 'assets/';
        // définir l'url absolue pour la racine du site
        // /!\ != racine projet, ici on parle du répertoire public/
        $viewVars['baseUri'] = $_SERVER['BASE_URI'];

        // On veut désormais accéder aux données de $viewVars, mais sans accéder au tableau
        // La fonction extract permet de créer une variable pour chaque élément du tableau passé en argument
        extract($viewVars);
        // => la variable $currentPage existe désormais, et sa valeur est $viewName
        // => la variable $assetsBaseUri existe désormais, et sa valeur est $_SERVER['BASE_URI'] . '/assets/'
        // => la variable $baseUri existe désormais, et sa valeur est $_SERVER['BASE_URI']
        // => il en va de même pour chaque élément du tableau

        // $viewVars est disponible dans chaque fichier de vue
        require_once __DIR__.'/../views/layout/header.tpl.php';
        require_once __DIR__.'/../views/'.$viewName.'.tpl.php';
        require_once __DIR__.'/../views/layout/footer.tpl.php';
    }




    protected function checkAuthorization($roles=[])
    {
        //TODO MAUVAISE PRATIQUE
        global $router;
        //dd($roles);
        // est ce que l'on a un user connecté ?
        if(isset($_SESSION['userId'])){
            
            // si oui
            // je récupère l'objet user dans une variable : 
            $currentUser = $_SESSION['userObject'];
            //dd($currentUser);
            // et je récupère le role du user
            $currentUserRole = $currentUser->getRole();
            //dd($currentUserRole);
            // maintenant il me faut vérifier si le role du user
            // est présent dans la liste des roles que va recevoir la methode
            // checkAuthorization
            //dd($currentUser);
            if(in_array($currentUserRole, $roles)) {
                return true;
            } else {
                // => on envoie le header "403 Forbidden"
                http_response_code(403);
                // et on affiche la vue err403
                $this->show('error/err403');
                exit();
            }
            

        } else {
            // si l'utilisateur n'est pas connecté
            header('Location: ' . $router->generate('user-login'));
            exit();
        }

    }

}




