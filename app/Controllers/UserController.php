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
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);


        $user = AppUser::findByEmail($email);
        if ($user === false) {
            $viewVars = ['error' => "erreur d'email"];
        } else {
            if ($password == $user->getPassword()) {
                $viewVars = ['user' => $user];
            } else {
                $viewVars = ['error' => "erreur de mot de passe"];
            }
        }

        $this->show("main/connexion", $viewVars);
    }
}
