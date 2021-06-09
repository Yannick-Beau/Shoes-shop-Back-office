<?php


namespace App\Controllers;

use App\Models\AppUser;



class UserController extends CoreController
{

    public function add()
    {
        $this->checkAuthorization(['admin']);
        // ici je viens fabriquer un objet "vide" que je vais transmettre a la vue
        // pour que $category existe bien dans add.tpl.php
        // ce qui nous evite l'apparition d'erreurs
        $user = new AppUser();
        $this->show('user/add', ['user' => $user]);
    }

    public function addPost()
    {
        $this->checkAuthorization(['admin']);
        // récupération des données du formulaire
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');
        $password = password_hash($password, PASSWORD_DEFAULT);
        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
        $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);
        $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);
        

        // preparation du tableau d'erreurs
        $errorList = [];

        // on fait des verifications ! 
        if (empty($email)) {
           $errorList[] = "L'email est vide";
        }

        if ($email === false) {
            $errorList[] = "L'mail' est invalide";
        }

        if (empty($password)) {
            $errorList[] = 'Password est vide';
        }

        if (empty($firstname)) {
            $errorList[] = 'Firstname est vide';
        }

        if (empty($lastname)) {
            $errorList[] = 'Lastname est vide';
        }

        if (empty($role)) {
            $errorList[] = 'Le role est vide';
        }

        if (empty($status)) {
            $errorList[] = 'Le status est vide';
        }
      
        if ($status === false) {
            $errorList[] = 'Le status est invalide';
        }

        // si on a pas eu d'erreurs
        if (empty($errorList)) {
            // On instancie un nouveau modèle de type Product.
            $user = new AppUser();
            // On met à jour les propriétés de l'instance.
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setFirstname($firstname);
            $user->setLastname($lastname);
            $user->setRole($role);
            $user->setStatus($status);

            if ($user->insert()) {
                header('Location: /user/list');
                exit;
            } else {
                $errorList[] = 'La sauvegarde a échoué';
            }
        }
        $user = new AppUser;

        $viewVars = [
            'errorList' => $errorList,
            'user' => $user
        ];

        if (!empty($errorList)) {
            $this->show('user/add', $viewVars);
        }

    }

    public function list()
    {
        $this->checkAuthorization(['admin']);
        $users = AppUser::findAll();
        $this->show('user/list', ['users' => $users]);
    }

    // affichage de la vue login
    public function login()
    {
        $this->show('user/login');
    }

    // reception des données du formulaire
    public function loginPost()
    {

        //TODO Mauvaise pratique
        global $router;

        // 1/ je vais récupérer dans $_POST l'email qui a été donné dans le forumlaire (et le password)
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        // 2/ je vais vérifier si ce mail existe bien dans la table app_user grâce à la methode findByEmail du model AppUser 
        $user = AppUser::findByEmail($email);

        // si l'utilisateur n'a pas été trouvé, $user vaudra false
        if ($user === false) {
            exit('Utilisateur ou mot de passe incorrect');
        }

        // password_hash
        // password_verify

        // apres avoir encrypté les mot de passe en BDD je ne peux plus faire la condition suivante : $password === $user->getPassword()
        // je sais que les mot de passe ont été encryptés grace a la fonction password_hash(), je vais donc vérifier la correpondance en utilisant  
        // une fonction qui s'appelle password_verifiy()

        if (password_verify($password, $user->getPassword())) {

            // ici j'ai un objet $user qui contient toute les inofs du user connecté
            $_SESSION['userObject'] = $user;
            $_SESSION['userId'] = $user->getId();
            header('Location: ' . $router->generate('main-home'));
        } else {
            exit('Utilisateur ou mot de passe incorrect');
        }

        // 3/ Si il existe bien, je compare le mot de passe donné dans le formulaire au mot de passe du user dans la table app_user

    }
}
