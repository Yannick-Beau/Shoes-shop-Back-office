<?php


namespace App\Controllers;

use App\Models\AppUser;



class UserController extends CoreController {


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
    if($user === false){
      exit('Utilisateur ou mot de passe incorrect');
    }

    // password_hash
    // password_verify

    // apres avoir encrypté les mot de passe en BDD je ne peux plus faire la condition suivante : $password === $user->getPassword()
    // je sais que les mot de passe ont été encryptés grace a la fonction password_hash(), je vais donc vérifier la correpondance en utilisant  
    // une fonction qui s'appelle password_verifiy()

    if(password_verify($password, $user->getPassword())){
      
      // ici j'ai un objet $user qui contient toute les inofs du user connecté
      $_SESSION['userObject'] = $user;
      $_SESSION['userId'] = $user->getId();
      header('Location: ' . $router->generate('main-home'));

    } else {
      exit('Utilisateur ou mot de passe incorrect');
    }




    // 3/ Si il existe bien, je compare le mot de passe donné dans le formulaire au mot de passe du user dans la table app_user





  }


  public function list()
  {

    //$this->checkAuthorization(['admin']);

    // Aller chercher tous les utilisateurs en BDD (Grace au Model AppUser)
    $users = AppUser::findAll();
    // Et afficher une vue user/list en lui transmettant la liste des users

    $this->show('user/list', ['users' => $users]);
  }

  public function add()
  {
    $this->generateCSRFToken();
    //$this->checkAuthorization(['admin']);
    $this->show('user/add');
  }

  public function addPost()
  {
    // on vérifie que l'utilisateur a le droit d'envoyer des données sur cette route !
    $this->checkAuthorization(['admin']);

    //TODO Mauvause pratique : 
    global $router;



    $errors = [];

    // on récupère les données du form
    $email = filter_input(INPUT_POST, 'email' );
    $password = filter_input(INPUT_POST, 'password');
    $firstname = filter_input(INPUT_POST, 'firstname');
    $lastname = filter_input(INPUT_POST, 'lastname');
    $role = filter_input(INPUT_POST, 'role');
    $status = filter_input(INPUT_POST, 'status');



    // si un seul des champs n'est pas fournit 
    if(!$email || !$password || !$firstname || !$lastname || !$role || !$status){
      // alors j'ajoute ce message d'erreur $errorList
      $errors[] = 'Tous les champs sont obligatoires';
    }
 

    //! petit nouveauté : filter_var
    // https://www.php.net/manual/fr/function.filter-var.php
    // il faut d'abord vérifier que l'email est valide, c'est à dire contient bien "@", puis un nom de domaine... bref, a bien une forme d'email, quoi.
    // on utilise filter_var() pour vérifier la validité de l'email. Si l'email est valide, filter_var() renvoie la valeur, false sinon
    // voir https://www.php.net/manual/fr/function.filter-var.php

    $emailFilter = filter_var($email, FILTER_VALIDATE_EMAIL);
    if($emailFilter === false ){
      $errors[] = 'Le format de l\'email n\'est pas valide.';
    }

    if(strlen($password) < 8){
      $errors[] = 'Le mot de passe doit contenir au moins 8 caractères.';
    }

    // ici, on veut empêcher la fonction de continuer normalement si une erreur a eu lieu, 
    // c'est à dire si le tableau $errors n'est pas vide
    if(count($errors) > 0){
      dump($errors);
      exit();
    }

    /* --------------------
    -- ENREGISTREMENT --
    -------------------- */

    // on prépare le hash du mot de passe (on ne stocke aucun mot de passe en clair !)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    // on crée le model et on renseigne les valeurs des propriétés via les setters
    $newUser = new AppUser;
    $newUser->setEmail($email);
    $newUser->setPassword($hashedPassword);
    $newUser->setFirstname($firstname);
    $newUser->setLastname($lastname);
    $newUser->setRole($role);
    $newUser->setStatus($status);

    // on sauvegarde le model en BDD
    $newUser->save();

    // on redirige sur la page de liste
    header('Location: ' . $router->generate('user-list'));
    exit();




  }

  public function logout()
  {
    //TODO MAUVAISE PRATIQUE
    global $router;
    unset($_SESSION['userId']);
    unset($_SESSION['userObject']);
    header('Location: ' . $router->generate('user-login'));
  }



}
