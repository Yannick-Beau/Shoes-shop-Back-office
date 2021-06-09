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


}
