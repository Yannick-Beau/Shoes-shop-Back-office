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


    // ici nous sommes en train de faire un constructeur "commum" a tous les
    // contrôleurs ! 
    // a chaque fois que l'on va executer une methode d'un contrôleur,
    // ce constructeur va s'executer juste avant ! 
    public function __construct()
    {
        //TODO MAUVAISE PRATIQUE
        global $match;
        // je récupère le nom de la route sur laquelle je suis 
        $routeName = $match['name'];
        //dump($routeName);

        // ici on vient définir notre ACL ( Acces Control List ) 
        $acl = [
            'main-home' => ['admin', 'catalog-manager'],
            'user-list' => ['admin'],
            'user-add' => ['admin'],
            'category-list' => ['admin'],
            'product-list' => ['catalog-manager']
            
        ];

        // est ce que la route sur laquelle je suis est une route présente
        // dans le tableau ACL ?
        // array_Key_Exists me permet de verifier si une clé existe ou pas dans 
        // un tableau associatif 
        if(array_key_exists($routeName, $acl)){
            // je récupère le tableau des roles autorisés
            $authorizedRoles = $acl[$routeName];
            $this->checkAuthorization($authorizedRoles);
        }


        //! suite E06 mise en place sécu CSRF

        // dans ce tableau nous avons la liste des nom de routes
        // vulnérables a la faille CSRF

        $csrfTokenToCheckInPost = [
            'user-addPost',
            'category-addPost'
        ];

        // et je viens verifier si la route sur laquelle je suis 
        // est présente dans le tableau des routes vulnérable a la CSRF
        if(in_array($routeName, $csrfTokenToCheckInPost)){
            // Si je suis sur une route vulnérable, je lance la methode
            // checkCSRFToken() qui va me permettre de vérifier 
            // si le token dans le formulaire correspond bien
            // au token en session ! 
            $this->checkCSRFToken();
        }


    }


    public function checkCSRFToken()
    {
        // est ce que le token qui est en transit dans le formulaire
        // correspond bien au token que j'ai gardé dans mon "coffre fort" (en SESSION)
        $postToken = filter_input(INPUT_POST, 'token');
        $sessionToken = $_SESSION['csrfToken'];

        if(empty($postToken) || empty($sessionToken) || $sessionToken != $postToken){
            //si le token dans le forumlaire est vide OU
            // si le token en session est vide OU
            // si les tokens ne sont pas egaux
            // alors on a un pépin ! 
            http_response_code(403);
            $this->show('error/err403');
            exit();
        } 

    }



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




    public function generateCSRFToken()
    {
        $bytes = random_bytes(5);
        $csrfToken = bin2hex($bytes);
        // petit mécanisme gourmand craquant pour générer
        // 10 caractères de manière aléatoire. (qui vont contenir chiffres de 0 à 9 et lettres de a à f)

        $_SESSION['csrfToken'] = $csrfToken;
        return $csrfToken;
        
    }




}




