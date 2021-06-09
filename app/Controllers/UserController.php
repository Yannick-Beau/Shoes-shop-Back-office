<?php

namespace App\Controllers;

use App\Models\AppUser;


// Si j'ai besoin du Model Category
// use App\Models\Category;

class UserController extends CoreController
{
    public function connexion()
    {
        $this->show("main/connexion");
    }

    public function connexionPost()
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');


        $user = AppUser::findByEmail($email);
        if ($user === false) {
            $viewVars = ['error' => "erreur de connexion"];
        } else {
            if (password_verify($password,$user->getPassword)) {
                $_SESSION['userObject'] = $user;
                $_SESSION['userId'] = $user->getId();
                $viewVars = ['user' => $user];
            } else {
                $viewVars = ['error' => "erreur de connexion"];
            }
        }

        $this->show("main/connexion", $viewVars);
    }
}
